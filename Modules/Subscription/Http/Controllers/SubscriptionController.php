<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\BreadcrumbImage;
use App\Models\Language;
use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Entities\PurchaseHistory;
use App\Models\BankPayment;
use App\Models\StripePayment;
use App\Models\PaypalPayment;
use App\Models\RazorpayPayment;
use App\Models\Flutterwave;
use App\Models\PaystackAndMollie;
use App\Models\InstamojoPayment;
use App\Models\SslcommerzPayment;
use Session;
use Auth;

class SubscriptionController extends Controller
{

    public function pricing_plan()
    {
        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->get();

        return view('subscription::pricing_plan', compact('plans'));
    }


    public function subscription_payment($id){

        $user = Auth::guard('web')->user();

        if($user){
            $plan = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->where('id', $id)->first();

            $bank_payment = BankPayment::select('id','status','account_info','image')->first();
            $stripe = StripePayment::first();
            $paypal = PaypalPayment::first();

            $razorpay = RazorpayPayment::first();
            $flutterwave = Flutterwave::first();
            $mollie = PaystackAndMollie::first();
            $paystack = $mollie;
            $instamojo = InstamojoPayment::first();

            return view('subscription::user.provider.subscription_payment', compact('plan','stripe','paypal','razorpay','flutterwave','paystack','mollie','instamojo','bank_payment','user'));
        }else{
            return view('auth.login');
        }


    }


    public function free_enroll(Request $request, $id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $user = Auth::guard('web')->user();
        if($user){
            $free_exist = PurchaseHistory::where('provider_id', $user->id)->where(['payment_method' => 'Free'])->count();

            if($free_exist == 0){
                $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();
                $this->store_subscription($user, $plan, 'Free', 'free_enroll', 'success');

                $notification = trans('admin_validation.Enrolled Successfully');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('influencer.purchase-history')->with($notification);

            }else{
                $notification = trans('admin_validation.You have already enrolled trail version');

                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }else{
            return view('auth.login');
        }
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
