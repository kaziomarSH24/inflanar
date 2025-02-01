<?php

namespace Modules\Subscription\Http\Controllers\Provider;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Gateway;
use App\Models\PaypalPayment;
use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Entities\PurchaseHistory;
use App\Models\Language;
use Auth;
use Session;

use Str;
use Cart;
use Mail;
use Carbon\Carbon;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;

use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;

use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

use PayPal\Auth\OAuthTokenCredential;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{

    public function paypal_payment(Request $request, $id){
        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('admin_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

        Session::put('user_id', $id);

        if(!$plan)abort(404);

        if(!$plan){
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('booking-service', $slug)->with($notification);
        }

        $user = Auth::guard('web')->user();

        $paypal_setting = PaypalPayment::first();
        $total_price = $plan->plan_price;
        $payable_amount = round($total_price * $paypal_setting->currency->currency_rate,2);

        config(['paypal.mode' => $paypal_setting->account_mode]);

        if($paypal_setting->account_mode == 'sandbox'){
            config(['paypal.sandbox.client_id' => $paypal_setting->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_setting->secret_id]);
        }else{
            config(['paypal.sandbox.client_id' => $paypal_setting->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_setting->secret_id]);
            config(['paypal.sandbox.app_id' => 'APP-80W284485P519543T']);
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('subscription.paypal-success-payment'),
                "cancel_url" => route('subscription.paypal-faild-payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $paypal_setting->currency->currency_code,
                        "value" => $payable_amount
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);

        } else {
            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }


    public function paypal_success_payment(Request $request){
        $id = Session::get('user_id');

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

        $paypal_setting = PaypalPayment::first();

        config(['paypal.mode' => $paypal_setting->account_mode]);

        if($paypal_setting->account_mode == 'sandbox'){
            config(['paypal.sandbox.client_id' => $paypal_setting->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_setting->secret_id]);
        }else{
            config(['paypal.sandbox.client_id' => $paypal_setting->client_id]);
            config(['paypal.sandbox.client_secret' => $paypal_setting->secret_id]);
            config(['paypal.sandbox.app_id' => 'APP-80W284485P519543T']);
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $transaction = $request->PayerID;

            $user = Auth::guard('web')->user();
            $this->store_subscription($user, $plan, 'Paypal', $transaction, 'success');

            $notification = trans('admin_validation.Enrolled Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('influencer.purchase-history')->with($notification);

        } else {

            $notification = trans('admin_validation.Something went wrong, please try again');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

    }


    public function paypal_faild_payment(){

        $plan_id = Session::get('plan_id');

        $notification = trans('admin_validation.Something went wrong');
        $notification=array('messege'=>$notification,'alert-type'=>'error');
        return redirect()->route('user.subscription-payment', $plan_id)->with($notification);

    }


    public function store_subscription($user, $subscription_plan, $payment_gateway, $transaction, $payment_status, $bank_payment_proof = null){
        $purchase = new PurchaseHistory();

        if($subscription_plan->expiration_date == 'monthly'){
            $expiration_date = date('Y-m-d', strtotime('30 days'));
        }elseif($subscription_plan->expiration_date == 'yearly'){
            $expiration_date = date('Y-m-d', strtotime('365 days'));
        }elseif($subscription_plan->expiration_date == 'lifetime'){
            $expiration_date = 'lifetime';
        }

        if($payment_status == 'success'){
            PurchaseHistory::where('provider_id', $user->id)->update(['status' => 'expired']);
        }


        $purchase->provider_id = $user->id;
        $purchase->plan_id = $subscription_plan->id;
        $purchase->plan_name = $subscription_plan->plan_name;
        $purchase->plan_price = $subscription_plan->plan_price;
        $purchase->expiration = $subscription_plan->expiration_date;
        $purchase->expiration_date = $expiration_date;
        $purchase->maximum_service = $subscription_plan->maximum_service;
        if($payment_status == 'success'){
            $purchase->status = 'active';
        }else{
            $purchase->status = 'pending';
        }

        $purchase->payment_method = $payment_gateway;
        $purchase->payment_status = $payment_status;
        $purchase->transaction = $transaction;
        $purchase->save();
    }
}
