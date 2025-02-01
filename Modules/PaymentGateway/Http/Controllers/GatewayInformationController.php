<?php

namespace Modules\PaymentGateway\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PaymentGateway\Entities\PaymongoPayment;
use Modules\PaymentGateway\Entities\IyzicoPayment;
use Modules\PaymentGateway\Entities\MercadoPagoPayment;
use App\Models\MultiCurrency;
use Image, File, Str;

class GatewayInformationController extends Controller
{

    public function payment_addon()
    {
        $currencies = MultiCurrency::orderBy('currency_name','asc')->get();
        $paymongo = PaymongoPayment::first();
        $iyzico = IyzicoPayment::first();
        $mercado = MercadoPagoPayment::first();

        return view('paymentgateway::payment_info', compact('currencies','paymongo','iyzico','mercado'));
    }

    public function update_paymongo(Request $request){

        $rules = [
            'currency_id' => 'required',
            'public_key' => 'required',
            'secret_key' => 'required',
            'webhook_sig' => 'required',

        ];
        $customMessages = [
            'currency_id.required' => trans('admin_validation.Currency is required'),
            'public_key.required' => trans('admin_validation.Public key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
            'webhook_sig.required' => trans('admin_validation.Webhook is required'),
        ];
        $request->validate($rules,$customMessages);

        $paymongo = PaymongoPayment::first();
        $paymongo->currency_id = $request->currency_id;
        $paymongo->public_key = $request->public_key;
        $paymongo->secret_key = $request->secret_key;
        $paymongo->webhook_sig = $request->webhook_sig;
        $paymongo->status = $request->status;
        $paymongo->save();

        if($request->file('paymongo_image')){
            $old_image = $paymongo->image;
            $user_image = $request->paymongo_image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = 'paymongo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $paymongo->paymongo_image=$image_name;
            $paymongo->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->file('grabpay_image')){
            $old_image = $paymongo->image;
            $user_image = $request->grabpay_image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = 'paymongo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $paymongo->grabpay_image=$image_name;
            $paymongo->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->file('gcash_image')){
            $old_image = $paymongo->image;
            $user_image = $request->gcash_image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = 'paymongo'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $paymongo->gcash_image=$image_name;
            $paymongo->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function update_iyzico(Request $request){
        $rules = [
            'currency_id' => 'required',
            'api_key' => 'required',
            'secret_key' => 'required',
        ];
        $customMessages = [
            'currency_id.required' => trans('admin_validation.Currency is required'),
            'api_key.required' => trans('admin_validation.API key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
        ];
        $request->validate($rules,$customMessages);

        $iyzico = IyzicoPayment::first();
        $iyzico->currency_id = $request->currency_id;
        $iyzico->api_key = $request->api_key;
        $iyzico->secret_key = $request->secret_key;
        $iyzico->status = $request->status;
        $iyzico->account_mode = $request->account_mode;
        $iyzico->save();

        if($request->file('iyzico_image')){
            $old_image = $iyzico->image;
            $user_image = $request->iyzico_image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = 'iyzico'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $iyzico->iyzico_image=$image_name;
            $iyzico->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function update_mercado(Request $request){
        $rules = [
            'currency_id' => 'required',
            'public_key' => 'required',
            'access_token' => 'required',
        ];
        $customMessages = [
            'currency_id.required' => trans('admin_validation.Currency is required'),
            'public_key.required' => trans('admin_validation.Public key is required'),
            'access_token.required' => trans('admin_validation.Access token is required'),
        ];
        $request->validate($rules,$customMessages);

        $mercado = MercadoPagoPayment::first();
        $mercado->currency_id = $request->currency_id;
        $mercado->public_key = $request->public_key;
        $mercado->access_token = $request->access_token;
        $mercado->status = $request->status;
        $mercado->save();

        if($request->file('mercado_image')){
            $old_image = $mercado->image;
            $user_image = $request->mercado_image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = 'iyzico'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/website-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $mercado->mercado_image=$image_name;
            $mercado->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification=trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }



}
