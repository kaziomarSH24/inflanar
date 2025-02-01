<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
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

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('webview_razorpay_payment_verify','pay_with_flutterwave_web_view','webview_payment_faild','webview_payment_success','mollie_payment_success','pay_with_paystack','instamojo_response');
    }

    public function service_booking($slug){
        $service = Service::with('category','influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        $additionals = AdditionalService::where('service_id', $service->id)->get();

        return response()->json([
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
        // $html = "<option value=''>".trans('admin_validation.Select')."</option>";
        // foreach($available_schedules as $index=> $schedule){
        //     $html.='<option value="'.$schedule->id.'">'.strtoupper(date('h:i A', strtotime($schedule->start_time))).' - '.strtoupper(date('h:i A', strtotime($schedule->end_time))).'</option>';
        // }

        return response()->json(['is_available' => $is_available, 'available_schedules' => $available_schedules]);
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


        $service = Service::with('category','influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);



        $user = Auth::guard('api')->user();

        $paypal = PaypalPayment::first();
        $stripe = StripePayment::first();
        $razorpay = RazorpayPayment::first();
        $flutterwave = Flutterwave::first();
        $bank = BankPayment::first();
        $paystackAndMollie = PaystackAndMollie::first();
        $instamojo = InstamojoPayment::first();

        $json_module_data = file_get_contents(base_path('modules_statuses.json'));
        $module_status = json_decode($json_module_data);


        return response()->json([
            'service' => $service,
            'paypal' => $paypal,
            'bank' => $bank,
            'stripe' => $stripe,
            'razorpay' => $razorpay,
            'flutterwave' => $flutterwave,
            'paystack' => $paystackAndMollie,
            'mollie' => $paystackAndMollie,
            'instamojo' => $instamojo,
            'user' => $user,
        ]);
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

        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'tnx_info'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'tnx_info.required' => trans('admin_validation.Transaction is required'),
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




        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);


        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('booking-service', $slug)->with($notification);
        }



        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;


        $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Bank Payment', 'pending', $request->tnx_info);

        $notification = trans('admin_validation.Your order has been placed. please wait for admin payment approval');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function pay_via_stripe(Request $request, $slug){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'card_number'=>'required',
            'month'=>'required',
            'year'=>'required',
            'cvc'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'tnx_info.required' => trans('admin_validation.Transaction is required'),
            'tnx_info.required' => trans('admin_validation.Transaction is required'),
            'tnx_info.required' => trans('admin_validation.Transaction is required'),
            'card_number.required' => trans('admin_validation.Card number is required'),
            'year.required' => trans('admin_validation.Year is required'),
            'month.required' => trans('admin_validation.Month is required'),
            'cvc.required' => trans('admin_validation.Cvc is required'),
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

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

        if(!$service)abort(404);

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }

        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;


        $stripe = StripePayment::first();
        $payable_amount = round(($booking_info->total - $coupon_discount) * $stripe->currency->currency_rate,2);
        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        try{
            $token = Stripe\Token::create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->month,
                    'exp_year' => $request->year,
                    'cvc' => $request->cvc,
                ],
            ]);
        }catch (Exception $e) {
            return response()->json(['error' => 'Please provide valid card information'],403);
        }

        if (!isset($token['id'])) {
            return response()->json(['error' => 'Payment faild'],403);
        }

        $result = Stripe\Charge::create([
            'card' => $token['id'],
            'currency' => $stripe->currency->currency_code,
            'amount' => $payable_amount * 100,
            'description' => env('APP_NAME'),
        ]);

        if($result['status'] != 'succeeded') {
            return response()->json(['error' => 'Payment faild'],403);
        }

        $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Stripe', 'success', $result->balance_transaction);

        $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
        return response()->json([
            'message' => $notification
        ]);
    }



    public function payWithInstamojo(Request $request, $slug){



        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user = Auth::guard('web')->user();
        $order_info = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $total_price = $service->price + $order_info->extra_price;

        $instamojoPayment = InstamojoPayment::first();
        $price = $total_price * $instamojoPayment->currency_rate;
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
        return redirect($response->payment_request->longurl);
    }

    public function instamojoResponse(Request $request){

        Session::put('return_from_mollie','payment_faild');
        $service = Session::get('service');

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
            $notification = trans('user_validation.Payment Faild');
            return response()->json([
                'message' => $notification
            ]);
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {

                $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
                $user = Auth::guard('web')->user();
                $order_info = Session::get('order_info');
                $provider_id = $service->provider_id;
                $client_id = $user->id;

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Instamojo', 'success', $request->get('payment_id'));

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                Session::forget('order_info');
                Session::forget('return_from_mollie');
                Session::forget('service');

                $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
                return response()->json([
                    'message' => $notification
                ]);
            }
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json([
                'message' => $notification
            ]);
        }
    }

    public function razorpay_create_token(Request $request){

        $rules = [
            'slug'=>'required'
        ];
        $this->validate($request, $rules);

        $user = Auth::guard('api')->user();


        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $total_price = $service->price + $extra_price;
        $razorpay = RazorpayPayment::first();
        $payable_amount = $total_price * $razorpay->currency_rate;

        $payable_amount = round($payable_amount, 2);
        $api = new Api($razorpay->key,$razorpay->secret_key);
        $order = $api->order->create(
            array('receipt' => '123', 'amount' => ($payable_amount * 100), 'currency' => $razorpay->currency_code)
        );

        $data = [
            "key"               => $razorpay->key,
            "amount"            => $payable_amount * 100,
            "order_id"          => $order->id,
          ];

        return response()->json($data, 200);
    }


    public function razorpay_web_view(Request $request){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'slug'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
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
            'slug' => $request->slug,
        );

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $request->slug])->first();

        if(!$service)abort(404);

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }

        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;

        $razorpay = RazorpayPayment::first();
        $grand_total = $request->total_amount;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($booking_info);
        Session::put('order_info', $order_info);

        $slug =  $request->slug;

        return view('razorpay_webview', compact('razorpay','grand_total','frontend_success_url','frontend_faild_url','request_from','token','slug'));
    }

    public function webview_schedule_not_available(){
        $notification = trans('user_validation.This schedule already booked. please choose another schedule');
        return response()->json(['message' => $notification]);
    }

    public function webview_payment_faild(){
        $notification = trans('user_validation.Payment Faild');
        return response()->json(['message' => $notification]);
    }

    public function webview_payment_success(){
        $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
        return response()->json(['message' => $notification]);
    }

    public function webview_razorpay_payment_verify(Request $request, $slug){
        $razorpay = RazorpayPayment::first();
        $input = $request->all();
        $api = new Api($razorpay->key,$razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {

            try {

                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

                $payId = $response->id;


               $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

               $booking_info = Session::get('order_info');
               $booking_info = json_decode($booking_info);

               $user = Auth::guard('api')->user();



                $influencer_id = $service->influencer_id;
                $client_id = $user->id;

                $order = $this->create_order($user, $service, $booking_info, $influencer_id, $client_id, 'Razorpay', 'success', $payId);

                $notification = trans('admin_validation.Your order has been placed. Thanks for your new order');
                return response()->json([
                    'message' => $notification
                ]);

            }catch (Exception $e) {
                $notification = trans('admin_validation.Something went wrong, please try again');
                return response()->json([
                    'message' => $notification
                ]);
            }
        }else{
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }
    }


    public function flutterwave_web_view(Request $request){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'slug'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $booking_info = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'names' => $request->names,
            'extra_total' => $request->extra_total,
            'total_amount' => $request->total_amount,
            'total' => $request->total,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'order_note' => $request->order_note,
            'slug' => $request->slug,
        );

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $request->slug])->first();

        if(!$service)abort(404);

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }

        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;

       $flutterwave = Flutterwave::first();
        $grand_total = $request->total_amount;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($booking_info);
        Session::put('order_info', $order_info);

        $slug =  $request->slug;

        return view('flutterwave_webview', compact('flutterwave','grand_total','frontend_success_url','frontend_faild_url','request_from','token','slug','user'));

    }


    public function pay_with_flutterwave_web_view(Request $request){
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
            $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 'enable', 'status' => 'active', 'is_banned' => 'disable'])->first();
            $user = Auth::guard('api')->user();
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->create_order($user, $service, $order_info, $provider_id, $client_id, 'Razorpay', 'success', $tnx_id);

            $provider = $service->provider;
            // $this->sendMailToClient($user, $order);
            // $this->sendMailToProvider($provider, $order);


            return response()->json(['status' => 'success' , 'message' => 'successfull'],200);
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification],403);
        }
    }

    public function pay_with_mollie_webview(Request $request){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'slug'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $booking_info = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'names' => $request->names,
            'extra_total' => $request->extra_total,
            'total_amount' => $request->total_amount,
            'total' => $request->total,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'order_note' => $request->order_note,
            'slug' => $request->slug,
        );

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $request->slug])->first();

        if(!$service)abort(404);

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }

        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;

        $grand_total = $request->total_amount;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($booking_info);
        Session::put('order_info', $order_info);

        $slug =  $request->slug;

        Session::put('slug', $slug);
        Session::put('request_from', $request_from);
        Session::put('user', $user);
        Session::put('frontend_success_url', $request->frontend_success_url);
        Session::put('frontend_faild_url', $request->frontend_faild_url);

        $mollie = PaystackAndMollie::first();
        $price = $grand_total * $mollie->mollie_currency->currency_rate;
        $price = round($price,2);
        $price = sprintf('%0.2f', $price);

        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$price.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('mollie-payment-success-webview'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('service',$service);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function mollie_payment_success(Request $request){

        $service = Session::get('service');

        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){
            $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 'enable', 'status' => 'active', 'is_banned' => 'disable'])->first();
            $user = Session::get('user');
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->influencer_id;
            $client_id = $user->id;
            $order = $this->create_order($user, $service, $order_info, $provider_id, $client_id, 'Mollie', 'success', session()->get('payment_id'));
            $provider = $service->provider;

            Session::forget('order_info');
            Session::forget('slug');
            Session::forget('request_from');
            Session::forget('user');
            Session::forget('frontend_success_url');
            Session::forget('frontend_faild_url');

            return redirect()->route('webview-payment-success');
        }else{
            return redirect()->route('webview-payment-faild');
        }


    }

    public function paystack_web_view(Request $request){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'slug'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $booking_info = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'names' => $request->names,
            'extra_total' => $request->extra_total,
            'total_amount' => $request->total_amount,
            'total' => $request->total,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'order_note' => $request->order_note,
            'slug' => $request->slug,
        );

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $request->slug])->first();

        if(!$service)abort(404);

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }

        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;

        $paystack = PaystackAndMollie::first();
        $grand_total = $request->total_amount;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($booking_info);
        Session::put('order_info', $order_info);

        $slug =  $request->slug;

        return view('paystack_webview', compact('paystack','grand_total','frontend_success_url','frontend_faild_url','request_from','token','slug','user'));

    }

    public function pay_with_paystack(Request $request){
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
            $slug = $request->slug;
            $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            $user = Auth::guard('api')->user();
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paystack', 'success', $transaction);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            return response()->json(['status' => 'success' , 'message' => 'successfull']);
        }else{

            return response()->json(['status' => 'faild' , 'message' => 'faild']);
        }
    }

    public function pay_with_instamojo(Request $request){
        $rules = [
            'address'=>'required',
            'date'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'schedule_time_slot'=>'required',
            'slug'=>'required',
        ];
        $customMessages = [
            'address.required' => trans('admin_validation.Address is required'),
            'date.required' => trans('admin_validation.Schedule date is required'),
            'name.required' => trans('admin_validation.Name is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'schedule_time_slot.required' => trans('admin_validation.Schedule slot is required'),
            'slug.required' => trans('admin_validation.Slug is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $booking_info = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'names' => $request->names,
            'extra_total' => $request->extra_total,
            'total_amount' => $request->total_amount,
            'total' => $request->total,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'order_note' => $request->order_note,
            'slug' => $request->slug,
        );

        $service = Service::where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $request->slug])->first();

        if(!$service)abort(404);

        if(!$booking_info){
            $notification = trans('admin_validation.Something went wrong, please try again');
            return response()->json([
                'message' => $notification
            ]);
        }

        $user = Auth::guard('api')->user();

        $influencer_id = $service->influencer_id;
        $client_id = $user->id;

        $coupon_discount = 0.00;

        $paystack = PaystackAndMollie::first();
        $grand_total = $request->total_amount;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($booking_info);
        Session::put('order_info', $order_info);

        $slug =  $request->slug;

        Session::put('slug', $slug);
        Session::put('request_from', $request_from);
        Session::put('user', $user);
        Session::put('frontend_success_url', $request->frontend_success_url);
        Session::put('frontend_faild_url', $request->frontend_faild_url);



        $instamojoPayment = InstamojoPayment::first();
        $price = $grand_total * $instamojoPayment->currency->currency_rate;
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
            'redirect_url' => route('instamojo-response-webview'),
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
        return redirect($response->payment_request->longurl);
    }

    public function instamojo_response(Request $request){
        $service = Session::get('service');

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
            return redirect()->route('webview-payment-faild');
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {

                $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 'enable', 'status' => 'active', 'is_banned' => 'disable'])->first();
                $user = Session::get('user');
                $order_info = Session::get('order_info');
                $order_info = json_decode($order_info);
                $provider_id = $service->influencer_id;
                $client_id = $user->id;

                $order = $this->create_order($user, $service, $order_info, $provider_id, $client_id, 'Instamojo', 'success', $request->get('payment_id'));

                $provider = $service->influencer_id;

                Session::forget('order_info');
                Session::forget('service');
                Session::forget('user');

                return redirect()->route('webview-payment-success');
            }
        }else{
            return redirect()->route('webview-payment-faild');
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
        $order->payment_status = $payment_status ;
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

        return $order;
    }


}
