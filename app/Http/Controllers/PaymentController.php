<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\AdditionalService;
use App\Models\AppointmentSchedule;
use App\Models\Coupon;
use App\Models\Order;
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
use App\Models\Setting;
use Session, Auth, Stripe, Mail, Str, Exception, Redirect;
use Razorpay\Api\Api;
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

    public function service_booking($slug){
        $service = Service::with('category','influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        $additionals = AdditionalService::where('service_id', $service->id)->get();

        return view('service_booking')->with([
            'service' => $service,
            'additionals' => $additionals,

        ]);

    }

    public function get_available_schedule(Request $request){
        $day = date('l',strtotime($request->date));
        $appointment_schedules = AppointmentSchedule::where(['user_id' => $request->influencer_id, 'day' => $day, 'status' => 1])->get();

        $available_schedule_arr = array();
        foreach($appointment_schedules as $appointment_schedule){
            $exist = Order::where(['influencer_id' => $request->influencer_id, 'appointment_schedule_id' => $appointment_schedule->id, 'booking_date' => $request->date])->count();
            if($exist == 0){
                $available_schedule_arr[] = $appointment_schedule->id;
            }
        }

        $available_schedules = AppointmentSchedule::whereIn('id', $available_schedule_arr)->orderBy('start_time','asc')->get();

        $is_available = $available_schedules->count() > 0 ? true : false;
        $html = "<option value=''>".trans('admin_validation.Select')."</option>";
        foreach($available_schedules as $index=> $schedule){
            $html.='<option value="'.$schedule->id.'">'.strtoupper(date('h:i A', strtotime($schedule->start_time))).' - '.strtoupper(date('h:i A', strtotime($schedule->end_time))).'</option>';
        }

        return response()->json(['is_available' => $is_available, 'available_schedules' => $html]);
    }

    public function store_booking_info_to_session(Request $request){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $booking_info = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'names' => $request->names,
            'extra_total' => $request->extra_total,
            'sub_total' => $request->sub_total,
            'total' => $request->total,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'order_note' => $request->order_note,
        );

        Session::put('booking_info', $booking_info);

        return response()->json(['status' => 'success']);
    }

    public function payment($slug){

        $setting = Setting::first();
        if ($setting->commission_type == 'subscription') {
            $json_module_data = file_get_contents(base_path('modules_statuses.json'));
            $module_status = json_decode($json_module_data);

          $service = Service::with('category','influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

            if(!$service)abort(404);

            $booking_info = Session::get('booking_info');
            if(!$booking_info){
                $notification = trans('admin_validation.Something went wrong, please try again');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('booking-service', $slug)->with($notification);
            }

            $discount = 0.00;
            if(Session::get('coupon_code') && Session::get('offer_percentage')) {
                $offer_percentage = Session::get('offer_percentage');
                $discount = ($offer_percentage / 100) * $booking_info->total;
            }

            $grand_total = $booking_info->total - $discount;

            $user = Auth::guard('web')->user();

            $paypal = PaypalPayment::first();
            $stripe = StripePayment::first();
            $razorpay = RazorpayPayment::first();
            $flutterwave = Flutterwave::first();
            $bank = BankPayment::first();
            $paystackAndMollie = PaystackAndMollie::first();
            $instamojo = InstamojoPayment::first();

            $json_module_data = file_get_contents(base_path('modules_statuses.json'));
            $module_status = json_decode($json_module_data);

            $paymongo = '';
            $iyzico = '';
            $mercado = '';
            if($service->influencer_id){
                $provider_stripe = ProviderStripe::where('provider_id', $service->influencer_id)->first();
                $provider_paypal = ProviderPaypal::where('provider_id', $service->influencer_id)->first();
                $provider_razorpay = ProviderRazorpay::where('provider_id', $service->influencer_id)->first();
                $provider_flutterwave = ProviderFlutterwave::where('provider_id', $service->influencer_id)->first();
                $provider_paystack = ProviderPaystack::where('provider_id', $service->influencer_id)->first();
                $provider_mollie = ProviderMollie::where('provider_id', $service->influencer_id)->first();
                $provider_instamojo = ProviderInstamojo::where('provider_id', $service->influencer_id)->first();
                $provider_bank_handcash = ProviderBankHandcash::where('provider_id', $service->influencer_id)->first();
            }else{
                $provider_stripe = '';
                $provider_paypal = '';
                $provider_razorpay = '';
                $provider_flutterwave = '';
                $provider_paystack = '';
                $provider_mollie = '';
                $provider_instamojo = '';
                $provider_bank_handcash = '';
            }
            if($module_status->PaymentGateway){
                $paymongo = PaymongoPayment::first();
                $iyzico = IyzicoPayment::first();
                $mercado = MercadoPagoPayment::first();
            }

            return view('subscription::payment', [
                'service' => $service,
                'booking_info' => $booking_info,
                'discount' => $discount,
                'grand_total' => $grand_total,
                'paypal' => $paypal,
                'bank' => $bank,
                'stripe' => $stripe,
                'razorpay' => $razorpay,
                'flutterwave' => $flutterwave,
                'paystack' => $paystackAndMollie,
                'mollie' => $paystackAndMollie,
                'instamojo' => $instamojo,
                'user' => $user,
                'paymongo' => $paymongo,
                'iyzico' => $iyzico,
                'mercado' => $mercado,
                'provider_stripe' => $provider_stripe,
                'provider_paypal' => $provider_paypal,
                'provider_razorpay' => $provider_razorpay,
                'provider_flutterwave' => $provider_flutterwave,
                'provider_paystack' => $provider_paystack,
                'provider_mollie' => $provider_mollie,
                'provider_instamojo' => $provider_instamojo,
                'provider_bank_handcash' => $provider_bank_handcash,
            ]);


        }else{
            $service = Service::with('category','influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

            if(!$service)abort(404);

            $booking_info = Session::get('booking_info');
            if(!$booking_info){
                $notification = trans('admin_validation.Something went wrong, please try again');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->route('booking-service', $slug)->with($notification);
            }

            $discount = 0.00;
            if(Session::get('coupon_code') && Session::get('offer_percentage')) {
                $offer_percentage = Session::get('offer_percentage');
                $discount = ($offer_percentage / 100) * $booking_info->total;
            }

            $grand_total = $booking_info->total - $discount;

            $user = Auth::guard('web')->user();

            $paypal = PaypalPayment::first();
            $stripe = StripePayment::first();
            $razorpay = RazorpayPayment::first();
            $flutterwave = Flutterwave::first();
            $bank = BankPayment::first();
            $paystackAndMollie = PaystackAndMollie::first();
            $instamojo = InstamojoPayment::first();

            $json_module_data = file_get_contents(base_path('modules_statuses.json'));
            $module_status = json_decode($json_module_data);

            $paymongo = '';
            $iyzico = '';
            $mercado = '';

            if($module_status->PaymentGateway){
                $paymongo = PaymongoPayment::first();
                $iyzico = IyzicoPayment::first();
                $mercado = MercadoPagoPayment::first();
            }

            return view('payment', [
                'service' => $service,
                'booking_info' => $booking_info,
                'discount' => $discount,
                'grand_total' => $grand_total,
                'paypal' => $paypal,
                'bank' => $bank,
                'stripe' => $stripe,
                'razorpay' => $razorpay,
                'flutterwave' => $flutterwave,
                'paystack' => $paystackAndMollie,
                'mollie' => $paystackAndMollie,
                'instamojo' => $instamojo,
                'user' => $user,
                'paymongo' => $paymongo,
                'iyzico' => $iyzico,
                'mercado' => $mercado,
            ]);
        }
        }


    public function apply_coupon(Request $request){

        $rules = [
            'coupon'=>'required',
        ];
        $customMessages = [
            'coupon.required' => trans('admin_validation.Coupon is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $coupon = Coupon::where(['coupon_code' => $request->coupon, 'status' => 1])->first();

        if(!$coupon){
            $notification = trans('admin_validation.Invalid coupon');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($coupon->expired_date < date('Y-m-d')){
            $notification = trans('admin_validation.Coupon already expired');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        if($coupon->influencer_id != 0){
            if($coupon->influencer_id != $request->influencer_id){
                $notification = trans('admin_validation.You can not apply another provider coupon');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }

        Session::put('coupon_code', $coupon->coupon_code);
        Session::put('offer_percentage', $coupon->offer_percentage);

        $notification = trans('admin_validation.Coupon applied successful');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function pay_via_bank(Request $request, $slug){

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

    public function pay_via_stripe(Request $request, $slug){

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
        $payable_amount = round(($booking_info->total - $coupon_discount) * $stripe->currency->currency_rate,2);
        Stripe\Stripe::setApiKey($stripe->stripe_secret);

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

    public function pay_via_razorpay(Request $request, $slug){
        $razorpay = RazorpayPayment::first();
        $input = $request->all();
        $api = new Api($razorpay->key,$razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $payId = $response->id;

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

    public function pay_via_flutterwave(Request $request, $slug){

        $flutterwave = Flutterwave::first();
        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $flutterwave->secret_key;
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
            $notification = trans('admin_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }

    public function pay_via_payStack(Request $request, $slug){

        $paystack = PaystackAndMollie::first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $paystack->paystack_secret_key;
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

    public function pay_via_mollie(Request $request, $slug){

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
        $price = ($booking_info->total - $coupon_discount) * $mollie->mollie_currency->currency_rate;
        $price = sprintf('%0.2f', $price);

        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency->currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$price.'',
            ],
            'description' => 'payment',
            'redirectUrl' => route('mollie-payment-success'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('service',$service);
        session()->put('current_slug',$slug);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function mollie_payment_success(Request $request){

        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
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

    public function pay_via_instamojo(Request $request, $slug){

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
        $price = ($booking_info->total - $coupon_discount) * $instamojoPayment->currency->currency_rate;
        $price = round($price,2);

        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

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
            'redirect_url' => route('response-instamojo'),
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

    public function instamojo_response(Request $request){

        $input = $request->all();
        $instamojoPayment = InstamojoPayment::first();
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

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

    public function pay_with_grabpay($slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $user = Auth::guard('web')->user();


        $booking_info = Session::get('booking_info');
        $discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $discount = ($offer_percentage / 100) * $booking_info->total;
        }

        $grand_total = $booking_info->total - $discount;

        $total_amount = $grand_total;

        $paymongo = PaymongoPayment::first();
        $paymongo_currency = MultiCurrency::find($paymongo->currency_id);

        $public_key = $paymongo->public_key;
        $secret_key = $paymongo->secret_key;
        $webhook_sig = $paymongo->webhook_isg;

        $payable_amount = $total_amount * $paymongo_currency->currency_rate;
        $payable_currency = $paymongo_currency->currency_code;

        if($payable_amount < 100){
            $notification = trans('admin_validation.Amount cannot be less than 100₱');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $after_success_url = route('payment-addon-success');
        $after_faild_url = route('payment-addon-faild');

        session()->put('current_slug',$slug);

        $grabpay_payment = new PaymentGatewayController();
        return $grabpay_payment->pay_with_grabpay($public_key, $secret_key, $webhook_sig, $payable_amount, $payable_currency, $after_success_url, $after_faild_url);

    }

    public function pay_with_gcash($slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

       $user = Auth::guard('web')->user();


       $booking_info = Session::get('booking_info');
       $discount = 0.00;
       if(Session::get('coupon_code') && Session::get('offer_percentage')) {
           $offer_percentage = Session::get('offer_percentage');
           $discount = ($offer_percentage / 100) * $booking_info->total;
       }

       $grand_total = $booking_info->total - $discount;

       $total_amount = $grand_total;

        $paymongo = PaymongoPayment::first();
        $paymongo_currency = MultiCurrency::find($paymongo->currency_id);

        $public_key = $paymongo->public_key;
        $secret_key = $paymongo->secret_key;
        $webhook_sig = $paymongo->webhook_isg;

        $payable_amount = $total_amount * $paymongo_currency->currency_rate;
        $payable_currency = $paymongo_currency->currency_code;

        if($payable_amount < 100){
            $notification = trans('admin_validation.Amount cannot be less than 100₱');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $after_success_url = route('payment-addon-success');
        $after_faild_url = route('payment-addon-faild');

        session()->put('current_slug',$slug);

        $gcash_payment = new PaymentGatewayController();
        return $gcash_payment->pay_with_gcash($public_key, $secret_key, $webhook_sig, $payable_amount, $payable_currency, $after_success_url, $after_faild_url);

    }

    public function pay_with_paymongo(Request $request, $slug){

        $request->validate([
            'card_number' => 'required|numeric',
            'cvc' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
        ],[
            'card_number' => trans('admin_validation.Card is required'),
            'cvc' => trans('admin_validation.CVC is required'),
            'month' => trans('admin_validation.Month is required'),
            'year' => trans('admin_validation.Year is required'),
        ]);

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

       $user = Auth::guard('web')->user();

       $booking_info = Session::get('booking_info');
       $discount = 0.00;
       if(Session::get('coupon_code') && Session::get('offer_percentage')) {
           $offer_percentage = Session::get('offer_percentage');
           $discount = ($offer_percentage / 100) * $booking_info->total;
       }

       $grand_total = $booking_info->total - $discount;

       $total_amount = $grand_total;

        $paymongo = PaymongoPayment::first();
        $paymongo_currency = MultiCurrency::find($paymongo->currency_id);

        $public_key = $paymongo->public_key;
        $secret_key = $paymongo->secret_key;
        $webhook_sig = $paymongo->webhook_isg;

        $payable_amount = $total_amount * $paymongo_currency->currency_rate;
        $payable_currency = $paymongo_currency->currency_code;

        if($payable_amount < 100){
            $notification = trans('admin_validation.Amount cannot be less than 100₱');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $after_success_url = route('payment-addon-success');
        $after_faild_url = route('payment-addon-faild');

        $card_info = array();
        $card_info['card_number'] = $request->card_number;

        $card_info['cvc'] = $request->cvc;
        $month = $request->month;
        $card_info['month'] = (int)$month;
        $year = substr($request->year, -2);
        $card_info['year'] = (int)$year;

        session()->put('current_slug',$slug);

        $paymongo_payment = new PaymentGatewayController();
        return $paymongo_payment->pay_with_paymongo($public_key, $secret_key, $webhook_sig, $payable_amount, $payable_currency, $after_success_url, $after_faild_url, $card_info);

    }

    public function pay_with_iyzico(Request $client_request, $slug){
        require_once('vendor/autoload.php');
        $user = Auth::guard('web')->user();

        $booking_info = Session::get('booking_info');
        $discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $discount = ($offer_percentage / 100) * $booking_info->total;
        }

        $grand_total = $booking_info->total - $discount;

        $payable_amount = $grand_total;
        $payable_currency = 'TL';

        $iyzico = IyzicoPayment::first();

        $iyzipay_api_key = $iyzico->api_key;
        $iyzipay_secret_key = $iyzico->secret_key;
        $iyzipay_account_mode = $iyzico->account_mode;

        $after_success_url = route('payment-addon-success');
        $after_faild_url = route('payment-addon-faild');

        $service = Service::where(['slug' => $slug])->first();
        $custom_items = array();
        $single_item = (object)array(
            'id' => $service->id,
            'name' => $service->title,
            'price' => $service->price,
            'category' => $service?->category?->name,
        );
        $custom_items[] = $single_item;

        session()->put('current_slug',$slug);

        $iyzico_payment = new PaymentGatewayController();
        return $iyzico_payment->pay_with_iyzico($client_request, $iyzipay_api_key, $iyzipay_secret_key, $iyzipay_account_mode, $payable_amount, $payable_currency, $after_success_url, $after_faild_url, $user, $custom_items);

    }

    public function pay_with_mercadopago(Request $request, $slug){

        $user = Auth::guard('web')->user();

        $booking_info = Session::get('booking_info');
        $discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $discount = ($offer_percentage / 100) * $booking_info->total;
        }

        $grand_total = $booking_info->total - $discount;

        $total_amount = $grand_total;

        $mercado = MercadoPagoPayment::first();
        $mercado_currency = MultiCurrency::find($mercado->currency_id);

        $public_key = $mercado->public_key;
        $access_token = $mercado->access_token;

        $payable_amount = $total_amount * $mercado_currency->currency_rate;
        $payable_currency = $mercado_currency->currency_code;

        $after_success_url = route('payment-addon-success');
        $after_faild_url = route('payment-addon-faild');

        session()->put('current_slug',$slug);

        $mercado_payment = new PaymentGatewayController();
        return $mercado_payment->pay_with_mercadopago($request, $public_key, $access_token, $payable_amount, $payable_currency, $after_success_url, $after_faild_url, $user);

    }

    public function payment_addon_success(){

        $after_success_gateway = Session::get('after_success_gateway');
        $after_success_transaction = Session::get('after_success_transaction');

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

        $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, $after_success_gateway, 'success', $after_success_transaction);

        $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('user.orders')->with($notification);

    }

    public function payment_addon_faild(){

        $current_slug = Session::get('current_slug');

        $notification = trans('admin_validation.Something went wrong, please try again');
        $notification = array('messege'=>$notification,'alert-type'=>'error');
        return redirect()->route('booking-service', $current_slug)->with($notification);
    }


}
