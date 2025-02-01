<?php

namespace Modules\Subscription\Http\Controllers\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

use Str;
use Auth;


use Cart;
use Mail;
use Session;
use Redirect;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Schedule;


use Illuminate\Http\Request;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\PaypalPayment;
use App\Models\StripePayment;
use App\Models\RazorpayPayment;
use App\Models\Flutterwave;
use App\Models\BankPayment;
use App\Models\PaystackAndMollie;
use App\Models\InstamojoPayment;
use App\Models\CurrencyCountry;
use App\Models\Currency;
use App\Models\User;
use Mollie\Laravel\Facades\Mollie;
use App\Mail\OrderSuccessfully;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;


use Modules\PaymentGateway\Entities\PaymongoPayment;
use Modules\PaymentGateway\Entities\IyzicoPayment;
use Modules\PaymentGateway\Entities\MercadoPagoPayment;

use Modules\PaymentGateway\Http\Controllers\PaymentGatewayController;
use App\Models\MultiCurrency;

use Modules\Subscription\Entities\ProviderStripe;
use Modules\Subscription\Entities\ProviderRazorpay;
use Modules\Subscription\Entities\ProviderFlutterwave;
use Modules\Subscription\Entities\ProviderPaystack;
use Modules\Subscription\Entities\ProviderMollie;
use Modules\Subscription\Entities\ProviderInstamojo;
use Modules\Subscription\Entities\ProviderBankHandcash;
use Modules\Subscription\Entities\ProviderPaypal;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function translator(){
        $front_lang = Session::get('front_lang');
        $language = Language::where('is_default', 'Yes')->first();
        if($front_lang == ''){
            $front_lang = Session::put('front_lang', $language->lang_code);
        }
        config(['app.locale' => $front_lang]);
    }

    public function buy_pricing_plan()
    {
        $this->translator();

        $active_theme = 'layout2';

        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->get();


        return view('subscription::payment', compact('active_theme','plans'));
    }

    public function bankPayment(Request $request ,$slug){
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        $booking_info = Session::get('booking_info');

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('booking-service', $slug)->with($notification);
        }

        $rules = [
            'tnx_info'=>'required',
        ];
        $customMessages = [
            'tnx_info.required' => trans('admin_validation.Transaction is required'),
        ];

        $request->validate($rules,$customMessages);

        $user = Auth::guard('web')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Bank Payment', 'pending', $request->tnx_info);

        $notification = trans('admin_validation.Your order has been placed. please wait for admin payment approval');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.orders')->with($notification);
    }

    public function payWithStripe(Request $request ,$slug){
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        $booking_info = Session::get('booking_info');

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('booking-service', $slug)->with($notification);
        }

        $user = Auth::guard('web')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $booking_info->total;
        }

        $stripe = StripePayment::first();
        $provider_stripe = ProviderStripe::where('provider_id', $influencer_id)->first();
        $payable_amount = round(($booking_info->total - $coupon_discount) * $stripe->currency->currency_rate,2);
        Stripe\Stripe::setApiKey($provider_stripe->stripe_secret);

        $result = Stripe\Charge::create ([
                "amount" => $payable_amount * 100,
                "currency" => $stripe->currency->currency_code,
                "source" => $request->stripeToken,
                "description" => env('APP_NAME')
            ]);

        $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Stripe', 'success', $result->balance_transaction);

        $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.orders')->with($notification);
    }

    public function payWithRazorpay(Request $request,$slug){
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();
        $influencer_id = $service->influencer_id;
        $provider_razerpay = ProviderRazorpay::where('provider_id', $influencer_id)->first();

        $razorpay = RazorpayPayment::first();
        $input = $request->all();
        $api = new Api($provider_razerpay->key,$provider_razerpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $payId = $response->id;



                if(!$service)abort(404);

                $booking_info = Session::get('booking_info');

                if(!$booking_info){
                    $notification = trans('admin_validation.Something went wrong, please try again');
                    $notification = array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->route('booking-service', $slug)->with($notification);
                }

                $user = Auth::guard('web')->user();

                $influencer_id = $service->influencer_id;
                $client_id = $user->id;

                $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Razorpay', 'success', $payId);

                $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('user.orders')->with($notification);


            }catch (Exception $e) {
                $notification = trans('admin_validation.Something went wrong, please try again');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('payment', $slug)->with($notification);
            }
        }else{
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $slug)->with($notification);
        }
    }

    public function payWithFlutterwave(Request $request ,$slug){
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();
        $influencer_id = $service->influencer_id;
        $provider_flutterwave = ProviderFlutterwave::where('provider_id', $influencer_id)->first();

        $flutterwave = Flutterwave::first();
        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $provider_flutterwave->secret_key;
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        if($response->status == 'success'){



            if(!$service){
                $notification = trans('admin_validation.Something went wrong, please try again');
                return response()->json(['status' => 'faild' , 'message' => $notification]);
            };

            $booking_info = Session::get('booking_info');

            if(!$booking_info){
                $notification = trans('admin_validation.Something went wrong, please try again');
                return response()->json(['status' => 'faild' , 'message' => $notification]);
            }

            $user = Auth::guard('web')->user();

            $influencer_id = $service->influencer_id;
            $client_id = $user->id;

            $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Flutterwave', 'success', $tnx_id);

            $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notification = trans('admin_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }

    public function payWithMollie(Request $request,$slug){
        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('admin_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        $booking_info = Session::get('booking_info');

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('booking-service', $slug)->with($notification);
        }

        $user = Auth::guard('web')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $booking_info->total;
        }

        $mollie = PaystackAndMollie::first();
        $provider_mollie = ProviderMollie::where('provider_id', $influencer_id)->first();
        $price = ($booking_info->total - $coupon_discount) * $mollie->mollie_currency->currency_rate;
        $price = sprintf('%0.2f', $price);

        $mollie_api_key = $provider_mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency->currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$price.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('mollie-payment-success'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('service',$service);
        session()->put('current_slug',$slug);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function molliePaymentSuccess(Request $request){
        $mollie = PaystackAndMollie::first();

        $current_slug = Session::get('current_slug');
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $current_slug])->first();
        $influencer_id = $service->influencer_id;
        $provider_mollie = ProviderMollie::where('provider_id', $influencer_id)->first();

        $mollie_api_key = $provider_mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){

            $current_slug = Session::get('current_slug');

            $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $current_slug])->first();

            if(!$service)abort(404);

            $booking_info = Session::get('booking_info');

            if(!$booking_info){
                $notification = trans('admin_validation.Something went wrong, please try again');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('booking-service', $current_slug)->with($notification);
            }

            $user = Auth::guard('web')->user();

            $influencer_id = $service->influencer_id;
            $client_id = $user->id;

            $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Mollie', 'success', session()->get('payment_id'));

            $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('user.orders')->with($notification);
        }else{
            $current_slug = Session::get('current_slug');

            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $current_slug)->with($notification);
        }
    }

    public function payWithPayStack(Request $request){
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();
        $influencer_id = $service->influencer_id;
        $provider_playstack = ProviderPaystack::where('provider_id', $firstAuthorId)->first();

        $paystack = PaystackAndMollie::first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $provider_playstack->paystack_secret_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST =>0,
            CURLOPT_SSL_VERIFYPEER =>0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $final_data = json_decode($response);
        if($final_data->status == true) {

            $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

            if(!$service){
                $notification = trans('admin_validation.Something went wrong, please try again');
                return response()->json(['status' => 'faild' , 'message' => $notification]);
            };

            $booking_info = Session::get('booking_info');

            if(!$booking_info){
                $notification = trans('admin_validation.Something went wrong, please try again');
                return response()->json(['status' => 'faild' , 'message' => $notification]);
            }

            $user = Auth::guard('web')->user();

            $influencer_id = $service->influencer_id;
            $client_id = $user->id;

            $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Flutterwave', 'success', $tnx_id);

            $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }


    public function payWithInstamojo(Request $request,$slug){
        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('admin_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

       $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        $booking_info = Session::get('booking_info');

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('booking-service', $slug)->with($notification);
        }

        $user = Auth::guard('web')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $booking_info->total;
        }

        $instamojoPayment = InstamojoPayment::first();
        $provider_instamojo = ProviderInstamojo::where('provider_id', $influencer_id)->first();
        $price = ($booking_info->total - $coupon_discount) * $instamojoPayment->currency->currency_rate;
        $price = round($price,2);

        $environment = $provider_instamojo->account_mode;
        $api_key = $provider_instamojo->api_key;
        $auth_token = $provider_instamojo->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $payload = Array(
            'purpose' => env("APP_NAME"),
            'amount' => $price,
            'phone' => '918160651749',
            'buyer_name' => Auth::user()->name,
            'redirect_url' => route('provider-response-instamojo'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        Session::put('service', $service);
        session()->put('current_slug',$slug);

        return redirect($response->payment_request->longurl);
    }

    public function instamojoResponse(Request $request){
        $input = $request->all();
        $current_slug = Session::get('current_slug');
        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $current_slug])->first();
        $influencer_id = $service->influencer_id;
        $provider_instamojo = ProviderInstamojo::where('provider_id', $influencer_id)->first();

        $instamojoPayment = InstamojoPayment::first();
        $environment = $provider_instamojo->account_mode;
        $api_key = $provider_instamojo->api_key;
        $auth_token = $provider_instamojo->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $current_slug = Session::get('current_slug');

            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $current_slug)->with($notification);
        } else {
            $data = json_decode($response);
        }


        if($data->success == true) {
            if($data->payment->status == 'Credit') {

                $current_slug = Session::get('current_slug');

                $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $current_slug])->first();

                if(!$service)abort(404);

                $booking_info = Session::get('booking_info');

                if(!$booking_info){
                    $notification = trans('admin_validation.Something went wrong, please try again');
                    $notification = array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->route('booking-service', $current_slug)->with($notification);
                }

                $user = Auth::guard('web')->user();

                $influencer_id = $service->influencer_id;
                $client_id = $user->id;

                $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Instamojo', 'success', $request->get('payment_id'));

                $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('user.orders')->with($notification);

            }
        }else{
            $current_slug = Session::get('current_slug');

            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $current_slug)->with($notification);
        }

    }

    public function create_order($user, $service, $booking_info, $influencer_id, $client_id, $payment_method, $payment_status, $tnx_info){

        $additional_services = array();

        if($booking_info->ids){
            foreach($booking_info->ids as $extra_index => $extra_id){
                $addition = AdditionalService::find($booking_info->ids[$extra_index]);
                if($addition){
                    $single_extra_service = array(
                        'id' => $addition->id,
                        'title' => $addition->title,
                        'price' => $addition->price,
                        'features' => json_decode($addition->features),
                    );
                    $additional_services[] = $single_extra_service;
                }
            }
        }

        $find_schedule = AppointmentSchedule::find($booking_info->schedule_time_slot);
        $time_slot = '';
        if($find_schedule){
            $time_slot = strtoupper(date('h:i A', strtotime($find_schedule->start_time))).' - '.strtoupper(date('h:i A', strtotime($find_schedule->end_time)));
        }

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {

            $coupon = Coupon::where(['coupon_code' => Session::get('coupon_code')])->first();

            if($coupon){
                $offer_percentage = Session::get('offer_percentage');
                $coupon_discount = ($offer_percentage / 100) * ($booking_info->total);

                $history = new CouponHistory();
                $history->user_id = $client_id;
                $history->influencer_id = $coupon->influencer_id;
                $history->coupon_code = $coupon->coupon_code;
                $history->coupon_id = $coupon->id;
                $history->discount_amount = $coupon_discount;
                $history->save();

            }

        }

        $order = new Order();
        $order->order_id = substr(rand(0,time()),0,10);
        $order->booking_date = $booking_info->date;
        $order->appointment_schedule_id = $booking_info->schedule_time_slot;
        $order->schedule_time_slot = $time_slot;
        $order->client_id = $client_id;
        $order->influencer_id = $influencer_id;
        $order->service_id = $service->id;
        $order->package_amount = $service->price;
        $order->additional_amount = $booking_info->extra_total;
        $order->coupon_discount  = $coupon_discount;
        $order->total_amount = $booking_info->total;
        $order->payment_method = $payment_method;
        $order->transection_id = $tnx_info;
        $order->payment_status = $payment_status;
        $order->order_status = 'awaiting_for_influencer_approval';
        $order->package_features = $service->features;
        $order->additional_services = json_encode($additional_services);
        $order->order_note = $booking_info->order_note;
        $order->client_name = $booking_info->name;
        $order->client_phone = $booking_info->phone;
        $order->client_email = $booking_info->email;
        $order->client_address = $booking_info->address;
        $order->save();

        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template=EmailTemplate::where('id',8)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{name}}',$user->name,$message);
        $message = str_replace('{{amount}}',$setting->currency_icon.$order->total_amount,$message);
        $message = str_replace('{{schedule_date}}',$order->booking_date,$message);
        $message = str_replace('{{order_id}}',$order->order_id,$message);
        Mail::to($user->email)->send(new OrderSuccessfully($message,$subject));

        $influencer = User::find($influencer_id);

        $template=EmailTemplate::where('id',9)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{name}}',$influencer->name,$message);
        $message = str_replace('{{amount}}',$setting->currency_icon.$order->total_amount,$message);
        $message = str_replace('{{schedule_date}}',$order->booking_date,$message);
        $message = str_replace('{{order_id}}',$order->order_id,$message);
        Mail::to($influencer->email)->send(new OrderSuccessfully($message,$subject));

        Session::forget('coupon_code');
        Session::forget('offer_percentage');
        Session::forget('booking_info');

        return $order;
    }
}
