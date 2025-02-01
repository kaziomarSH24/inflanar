<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\BreadcrumbImage;
use App\Models\GoogleRecaptcha;
use App\Models\User;
use App\Rules\Captcha;
use App\Mail\UserForgetPasswordForOTP;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\SocialLoginInfo;
use App\Models\Setting;
use Mail;
use Str;
use Validator,Redirect,Response,File;
use Socialite;
use Auth;
use Hash;
use Session;
use Carbon\Carbon;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:api')->except('userLogout');
    }

    public function loginPage(){
        $recaptchaSetting = GoogleRecaptcha::first();
        $socialLogin = SocialLoginInfo::first();

        $setting = Setting::first();
        $login_page = array(
            'image' => $setting->login_image
        );
        $login_page = (object) $login_page;

        return response()->json([
            'recaptchaSetting' => $recaptchaSetting,
            'socialLogin' => $socialLogin,
            'login_page' => $login_page,
        ]);
    }

    public function storeLogin(Request $request){
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];
        $user = User::where('email',$request->email)->first();
        if($user){
            if($user->email_verified_at != null){
                if($user->status=='enable'){
                    // if($user->is_influencer == 'yes') {
                    //     if(!$request->login_as_a_provider){
                    //         $notification = trans('admin_validation.You are a influencer, you can not login here');
                    //         return response()->json(['message' => $notification], 403);
                    //     }
                    // }
                    if(Hash::check($request->password,$user->password)){

                        if (! $token = Auth::guard('api')->attempt($credential)) {
                            return response()->json(['error' => 'Unauthorized'], 401);
                        }
                        $user = User::where('email',$request->email)->select('id','name','email','phone','image','status')->first();
                        return $this->respondWithToken($token,$user);

                    }else{
                        $notification = trans('admin_validation.Credentials does not exist');
                        return response()->json(['message' => $notification], 403);
                    }

                }else{
                    $notification = trans('admin_validation.Disabled Account');
                    return response()->json(['message' => $notification], 403);
                }
            }else{
                $notification = trans('admin_validation.Account Not Verified');
                return response()->json(['message' => $notification], 403);
            }
        }else{
            $notification = trans('admin_validation.Email does not exist');
            return response()->json(['message' => $notification], 403);
        }
    }

    public function storeLoginInfluncer(Request $request){
        $rules = [
            'email'=>'required',
            'password'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $credential=[
            'email'=> $request->email,
            'password'=> $request->password
        ];
        $user = User::where('email',$request->email)->first();
        if($user){
                if($user->status=='enable'){
                    if($user->is_influencer == 'no') {
                        if(!$request->login_as_a_provider){
                            $notification = trans('admin_validation.You are a User, you can not login here');
                            return response()->json(['message' => $notification], 403);
                        }
                    }
                    if(Hash::check($request->password,$user->password)){

                        if (! $token = Auth::guard('api')->attempt($credential)) {
                            return response()->json(['error' => 'Unauthorized'], 401);
                        }
                        $user = User::where('email',$request->email)->select('id','name','email','phone','image','status')->first();
                        return $this->respondWithToken($token,$user);

                    }else{
                        $notification = trans('admin_validation.Credentials does not exist');
                        return response()->json(['message' => $notification], 403);
                    }

                }else{
                    $notification = trans('admin_validation.Disabled Account');
                    return response()->json(['message' => $notification], 403);
                }
        }else{
            $notification = trans('admin_validation.Email does not exist');
            return response()->json(['message' => $notification], 403);
        }
    }

    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard('api')->factory()->getTTL() *1440,
            'user' => $user
        ]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }


    public function sendForgetPassword(Request $request){
        $rules = [
            'email'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();

        if($user){
            $user->forget_password_otp = random_int(100000, 999999);
            $user->save();

            MailHelper::setMailConfig();
            $template = EmailTemplate::where('id',11)->first();
            $subject = $template->subject;
            $message = $template->description;
            $message = str_replace('{{name}}',$user->name,$message);
            Mail::to($user->email)->send(new UserForgetPasswordForOTP($message,$subject,$user));

            $notification = trans('admin_validation.Reset password link send to your email.');
            return response()->json(['message' => $notification]);

        }else{
            $notification = trans('admin_validation.Email does not exist');
            return response()->json(['message' => $notification],403);
        }
    }

    public function otpVerifyPage(Request $request){
        $rules = [
            'email'=>'required',
            'otp'=>'required|min:4'
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'otp.required' => trans('admin_validation.otp is required'),
            'password.min' => trans('admin_validation.Password must be 4 characters'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();

        if($user->forget_password_otp == $request->otp){
            $notification = trans('admin_validation.Otp match successfully');
            return response()->json(['message' => $notification],200);
        }else{
            $notification = trans('admin_validation.Otp Not match');
            return response()->json(['message' => $notification],403);
        }
    }

    public function setNewPasswordPage(Request $request){
        $rules = [
            'email'=>'required',
            'password'=>'required|min:4|confirmed',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.min' => trans('admin_validation.Password must be 4 characters'),
            'password.confirmed' => trans('admin_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where(['email' => $request->email])->first();
        if($user){
            $user->password=Hash::make($request->password);
            $user->forget_password_otp=null;
            $user->save();

            $notification = trans('admin_validation.Password Reset successfully');
            return response()->json(['message' => $notification],200);
        }else{
            $notification = trans('admin_validation.Email or token does not exist');
            return response()->json(['message' => $notification],403);
        }
    }

    public function userLogout(){
        Auth::guard('api')->logout();
        $notification= trans('admin_validation.Logout Successfully');
        return response()->json([
            'message' => $notification,
        ]);

    }

    public function redirectToGoogle(){
        $googleInfo = SocialLoginInformation::first();
        \Config::set('services.google.client_id', $googleInfo->gmail_client_id);
        \Config::set('services.google.client_secret', $googleInfo->gmail_secret_id);
        \Config::set('services.google.redirect', $googleInfo->gmail_redirect_url);

        return Socialite::driver('google')->redirect();
    }

    public function googleCallBack(){

        $googleInfo = SocialLoginInformation::first();
        \Config::set('services.google.client_id', $googleInfo->gmail_client_id);
        \Config::set('services.google.client_secret', $googleInfo->gmail_secret_id);
        \Config::set('services.google.redirect', $googleInfo->gmail_redirect_url);

        $user = Socialite::driver('google')->user();
        $user = $this->createUser($user,'google');
        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }

    public function redirectToFacebook(){

        $facebookInfo = SocialLoginInformation::first();
        if($facebookInfo){
            \Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            \Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            \Config::set('services.facebook.redirect', $facebookInfo->facebook_redirect_url);
        }

        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallBack(){
        $facebookInfo = SocialLoginInformation::first();
        if($facebookInfo){
            \Config::set('services.facebook.client_id', $facebookInfo->facebook_client_id);
            \Config::set('services.facebook.client_secret', $facebookInfo->facebook_secret_id);
            \Config::set('services.facebook.redirect', $facebookInfo->facebook_redirect_url);
        }

        $user = Socialite::driver('facebook')->user();
        $user = $this->createUser($user,'facebook');
        auth()->login($user);
        return redirect()->intended(route('dashboard'));
    }



    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'provider_avatar' => $getInfo->avatar,
                'status' => 1,
                'email_verified' => 1,
            ]);
        }
        return $user;
    }
}
