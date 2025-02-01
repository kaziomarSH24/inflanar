<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Hash, Session, Str, Config;
use Socialite;

use App\Models\SocialLoginInfo;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'email'=>'required|email',
            'password'=>'required',
            'user_type'=>'required',
        ];

        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'password.required' => trans('admin_validation.Password is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if($request->user_type == 'client'){
            $user = User::where('email',$request->email)->where('is_influencer', 'no')->first();
        }elseif($request->user_type == 'influencer'){
            $user = User::where('email',$request->email)->where('is_influencer', 'yes')->first();
        }

        if($user){
            if($user->status == 'enable'){
                if($user->is_banned == 'no'){

                    if($user->email_verified_at == null){
                        $notification = trans('admin_validation.Please verify your email');
                        $notification = array('messege'=>$notification,'alert-type'=>'error');
                        return redirect()->back()->with($notification);
                    }

                    if(Hash::check($request->password,$user->password)){
                        if(Auth::guard('web')->attempt($credential,$request->remember)){

                            $notification= trans('admin_validation.Login Successfully');
                            $notification=array('messege'=>$notification,'alert-type'=>'success');

                            if($request->user_type == 'client'){
                                return redirect()->intended(route('user.dashboard'))->with($notification);
                            }elseif($request->user_type == 'influencer'){
                                return redirect()->intended(route('influencer.dashboard'))->with($notification);
                            }
                        }
                    }else{
                        $notification= trans('admin_validation.Invalid Password');
                        $notification=array('messege'=>$notification,'alert-type'=>'error');
                        return redirect()->back()->with($notification);
                    }
                }else{
                    $notification= trans('admin_validation.Inactive account');
                    $notification=array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->back()->with($notification);
                }

            }else{
                $notification= trans('admin_validation.Inactive account');
                $notification=array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }else{
            $notification= trans('admin_validation.Invalid Email');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

    }


    public function redirect_to_google(){
        $login_info = SocialLoginInfo::first();

        \Config::set('services.google.client_id', $login_info->gmail_client_id);
        \Config::set('services.google.client_secret', $login_info->gmail_secret_id);
        \Config::set('services.google.redirect', $login_info->gmail_redirect_url);

        Session::put('request_by', 'client');

        return Socialite::driver('google')->redirect();

    }

    public function influencer_redirect_to_google(){
        $login_info = SocialLoginInfo::first();

        \Config::set('services.google.client_id', $login_info->gmail_client_id);
        \Config::set('services.google.client_secret', $login_info->gmail_secret_id);
        \Config::set('services.google.redirect', $login_info->gmail_redirect_url);

        Session::put('request_by', 'influencer');

        return Socialite::driver('google')->redirect();

    }

    public function redirect_to_facebook(){
        $login_info = SocialLoginInfo::first();

        \Config::set('services.facebook.client_id', $login_info->facebook_client_id);
        \Config::set('services.facebook.client_secret', $login_info->facebook_secret_id);
        \Config::set('services.facebook.redirect', $login_info->facebook_redirect_url);

        Session::put('request_by', 'client');

        return Socialite::driver('facebook')->redirect();
    }

    public function influencer_redirect_to_facebook(){
        $login_info = SocialLoginInfo::first();

        \Config::set('services.facebook.client_id', $login_info->facebook_client_id);
        \Config::set('services.facebook.client_secret', $login_info->facebook_secret_id);
        \Config::set('services.facebook.redirect', $login_info->facebook_redirect_url);

        Session::put('request_by', 'influencer');

        return Socialite::driver('facebook')->redirect();
    }

    public function google_callback(){

        $login_info = SocialLoginInfo::first();

        \Config::set('services.google.client_id', $login_info->gmail_client_id);
        \Config::set('services.google.client_secret', $login_info->gmail_secret_id);
        \Config::set('services.google.redirect', $login_info->gmail_redirect_url);

        $user = Socialite::driver('google')->user();
        $user = $this->create_user($user,'google');
        auth()->login($user);

        $notification= trans('admin_validation.Login Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        if(Session::get('request_by') == 'client'){
            return redirect()->intended(route('user.dashboard'))->with($notification);
        }elseif(Session::get('request_by') == 'influencer'){
            return redirect()->intended(route('influencer.dashboard'))->with($notification);
        }

    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $notification= trans('admin_validation.Logout Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('login')->with($notification);

    }

    public function create_user($get_info, $provider){
        $user = User::where('email', $get_info->email)->first();
        if (!$user) {

            if(Session::get('request_by') == 'client'){
                $user = User::create([
                    'name'     => $get_info->name,
                    'email'    => $get_info->email,
                    'provider' => $provider,
                    'provider_id' => $get_info->id,
                    'status' => 'enable',
                    'is_banned' => 'no',
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'verification_token' => null,
                ]);
            }elseif(Session::get('request_by') == 'influencer'){
                $user = User::create([
                    'name'     => $get_info->name,
                    'username' => Str::slug($get_info->name).'-'.date('Ymdhis'),
                    'is_influencer' => 'yes',
                    'email'    => $get_info->email,
                    'provider' => $provider,
                    'provider_id' => $get_info->id,
                    'status' => 'enable',
                    'is_banned' => 'no',
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'verification_token' => null,
                ]);
            }

        }
        return $user;
    }
}
