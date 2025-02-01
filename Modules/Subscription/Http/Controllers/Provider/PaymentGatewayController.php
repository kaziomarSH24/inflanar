<?php

namespace Modules\Subscription\Http\Controllers\Provider;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Language;

use Modules\Subscription\Entities\ProviderStripe;
use Modules\Subscription\Entities\ProviderRazorpay;
use Modules\Subscription\Entities\ProviderFlutterwave;
use Modules\Subscription\Entities\ProviderPaystack;
use Modules\Subscription\Entities\ProviderMollie;
use Modules\Subscription\Entities\ProviderInstamojo;
use Modules\Subscription\Entities\ProviderBankHandcash;
use Modules\Subscription\Entities\ProviderPaypal;
use App\Models\CurrencyCountry;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\MultiCurrency;
use Image;
use File;
use Auth;
use Session;

class PaymentGatewayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(){
        $user = Auth::guard('web')->user();
        $paypal = ProviderPaypal::where('provider_id', $user->id)->first();
        $stripe = ProviderStripe::where('provider_id', $user->id)->first();
        $razorpay = ProviderRazorpay::where('provider_id', $user->id)->first();
        $flutterwave = ProviderFlutterwave::where('provider_id', $user->id)->first();
        $bank = ProviderBankHandcash::where('provider_id', $user->id)->first();
        $paystack = ProviderPaystack::where('provider_id', $user->id)->first();
        $mollie = ProviderMollie::where('provider_id', $user->id)->first();
        $instamojo = ProviderInstamojo::where('provider_id', $user->id)->first();

        $countires = CurrencyCountry::orderBy('name','asc')->get();
        $currencies = Currency::orderBy('name','asc')->get();
        $setting = Setting::first();

        $currency_list = MultiCurrency::get();

        return view('subscription::user.provider.payment', compact('paypal','stripe','razorpay','bank','paystack','mollie','flutterwave','instamojo','countires','currencies','setting','currency_list'));
    }

    public function store_paypal_gateway(Request $request){
        $request->validate([
            'client_id' => 'required',
            'secret_id' => 'required',
        ],[
            'client_id.required' => trans('admin_validation.Client id is required'),
            'secret_id.required' => trans('admin_validation.Secret id is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        $paypal = ProviderPaypal::where('provider_id', $auth_user->id)->first();

        if($paypal){
            $paypal->client_id = $request->client_id;
            $paypal->secret_id = $request->secret_id;
            $paypal->status = $request->status ? 1 : 0;
            $paypal->account_mode = 'live';
            $paypal->save();
        }else{
            $new_paypal = new ProviderPaypal();
            $new_paypal->provider_id = $auth_user->id;
            $new_paypal->client_id = $request->client_id;
            $new_paypal->secret_id = $request->secret_id;
            $new_paypal->status = $request->status ? 1 : 0;
            $new_paypal->account_mode = 'live';
            $new_paypal->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_stripe_gateway(Request $request){

        $request->validate([
            'stripe_key' => 'required',
            'stripe_secret' => 'required',
        ],[
            'stripe_key.required' => trans('admin_validation.Publishable key is required'),
            'stripe_secret.required' => trans('admin_validation.Secret key is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        $stripe = ProviderStripe::where('provider_id', $auth_user->id)->first();

        if($stripe){
            $stripe->stripe_key = $request->stripe_key;
            $stripe->stripe_secret = $request->stripe_secret;
            $stripe->status = $request->status ? 1 : 0;
            $stripe->save();
        }else{
            $new_stripe = new ProviderStripe();
            $new_stripe->provider_id = $auth_user->id;
            $new_stripe->stripe_key = $request->stripe_key;
            $new_stripe->stripe_secret = $request->stripe_secret;
            $new_stripe->status = $request->status ? 1 : 0;
            $new_stripe->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_razorpay_gateway(Request $request){

        $request->validate([
            'key' => 'required',
            'secret_key' => 'required',
        ],[
            'key.required' => trans('admin_validation.Key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        $razorpay = ProviderRazorpay::where('provider_id', $auth_user->id)->first();

        if($razorpay){
            $razorpay->key = $request->key;
            $razorpay->secret_key = $request->secret_key;
            $razorpay->status = $request->status ? 1 : 0;
            $razorpay->save();
        }else{
            $new_razorpay = new ProviderRazorpay();
            $new_razorpay->provider_id = $auth_user->id;
            $new_razorpay->key = $request->key;
            $new_razorpay->secret_key = $request->secret_key;
            $new_razorpay->status = $request->status ? 1 : 0;
            $new_razorpay->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_flutterwave_gateway(Request $request){

        $request->validate([
            'public_key' => 'required',
            'secret_key' => 'required',
        ],[
            'public_key.required' => trans('admin_validation.Public key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        $flutterwave = ProviderFlutterwave::where('provider_id', $auth_user->id)->first();

        if($flutterwave){
            $flutterwave->public_key = $request->public_key;
            $flutterwave->secret_key = $request->secret_key;
            $flutterwave->status = $request->status ? 1 : 0;
            $flutterwave->save();
        }else{
            $new_flutterwave = new ProviderFlutterwave();
            $new_flutterwave->provider_id = $auth_user->id;
            $new_flutterwave->public_key = $request->public_key;
            $new_flutterwave->secret_key = $request->secret_key;
            $new_flutterwave->status = $request->status ? 1 : 0;
            $new_flutterwave->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_paystack_gateway(Request $request){

        $request->validate([
            'public_key' => 'required',
            'secret_key' => 'required',
        ],[
            'public_key.required' => trans('admin_validation.Public key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        $paystack = ProviderPaystack::where('provider_id', $auth_user->id)->first();

        if($paystack){
            $paystack->public_key = $request->public_key;
            $paystack->secret_key = $request->secret_key;
            $paystack->status = $request->status ? 1 : 0;
            $paystack->save();
        }else{
            $new_paystack = new ProviderPaystack();
            $new_paystack->provider_id = $auth_user->id;
            $new_paystack->public_key = $request->public_key;
            $new_paystack->secret_key = $request->secret_key;
            $new_paystack->status = $request->status ? 1 : 0;
            $new_paystack->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_mollie_gateway(Request $request){
        $request->validate([
            'mollie_key' => 'required',
        ],[
            'mollie_key.required' => trans('admin_validation.Mollie key is required')

        ]);

        $auth_user = Auth::guard('web')->user();

        $mollie = ProviderMollie::where('provider_id', $auth_user->id)->first();

        if($mollie){
            $mollie->mollie_key = $request->mollie_key;
            $mollie->status = $request->status ? 1 : 0;
            $mollie->save();
        }else{
            $new_mollie = new ProviderMollie();
            $new_mollie->provider_id = $auth_user->id;
            $new_mollie->mollie_key = $request->mollie_key;
            $new_mollie->status = $request->status ? 1 : 0;
            $new_mollie->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_instamojo_gateway(Request $request){

        $request->validate([
            'account_mode' => 'required',
            'api_key' => 'required',
            'auth_token' => 'required',
        ],[
            'api_key.required' => trans('admin_validation.Api key is required'),
            'auth_token.required' => trans('admin_validation.Auth token is required'),
        ]);

        $auth_user = Auth::guard('web')->user();

        $instamojo = ProviderInstamojo::where('provider_id', $auth_user->id)->first();

        if($instamojo){
            $instamojo->account_mode = $request->account_mode;
            $instamojo->api_key = $request->api_key;
            $instamojo->auth_token = $request->auth_token;
            $instamojo->status = $request->status ? 1 : 0;
            $instamojo->save();
        }else{
            $new_instamojo = new ProviderInstamojo();
            $new_instamojo->provider_id = $auth_user->id;
            $new_instamojo->account_mode = $request->account_mode;
            $new_instamojo->api_key = $request->api_key;
            $new_instamojo->auth_token = $request->auth_token;
            $new_instamojo->status = $request->status ? 1 : 0;
            $new_instamojo->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function store_bank_handcash_gateway(Request $request){

        $request->validate([
            'bank_instruction' => 'required',
        ],[
            'bank_instruction.required' => trans('admin_validation.Bank instruction is required')
        ]);

        $auth_user = Auth::guard('web')->user();

        $bank_handcash = ProviderBankHandcash::where('provider_id', $auth_user->id)->first();

        if($bank_handcash){
            $bank_handcash->bank_status = $request->bank_status ? 1 : 0;
            $bank_handcash->bank_instruction = $request->bank_instruction;
            $bank_handcash->save();
        }else{
            $new_bank_handcash = new ProviderBankHandcash();
            $new_bank_handcash->provider_id = $auth_user->id;
            $new_bank_handcash->bank_status = $request->bank_status ? 1 : 0;
            $new_bank_handcash->bank_instruction = $request->bank_instruction;
            $new_bank_handcash->save();
        }

        $notification = trans('admin_validation.Data Save successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
