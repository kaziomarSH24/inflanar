<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\Captcha;
use Auth;
use App\Mail\UserRegistrationForOTP;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\BreadcrumbImage;
use App\Models\GoogleRecaptcha;
use App\Models\SocialLoginInformation;
use App\Mail\UserRegistration;
use Mail;
use Str;
use Session;
class RegisterController extends Controller
{

    use RegistersUsers;


    protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('guest:api');
    }

    public function storeRegister(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:4',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Email is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.min' => trans('admin_validation.Password must be 4 characters'),
            'password.confirmed' => trans('admin_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->forget_password_otp = random_int(100000, 999999);
        $user->save();

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',10)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{user_name}}',$request->name,$message);
        Mail::to($user->email)->send(new UserRegistrationForOTP($message,$subject,$user));

        $notification = trans('admin_validation.Register Successfully. Please Verify your email');
        return response()->json(['message' => $notification]);
    }


    public function storeInfluncerRegister(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:4', 'max:100'],
            'phone' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'designation' => ['required'],
            'g-recaptcha-response'=>new Captcha()

        ],[
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'country.required' => trans('admin_validation.Country is required'),
            'designation.required' => trans('admin_validation.Designation is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.confirmed' => trans('admin_validation.Confirm password does not match'),
            'password.min' => trans('admin_validation.You have to provide minimum 4 character password'),
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => Str::slug($request->name).'-'.date('Ymdhis'),
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'address' => $request->address,
            'designation' => $request->designation,
            'status' => 'enable',
            'is_banned' => 'no',
            'is_influencer' => 'yes',
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(100),
            'forget_password_otp' => random_int(100000, 999999)
        ]);

        MailHelper::setMailConfig();

        $template=EmailTemplate::where('id',4)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{user_name}}',$request->name,$message);
        Mail::to($user->email)->send(new UserRegistrationForOTP($message,$subject,$user));

        $notification= trans('admin_validation.Register Successfully. Please Verify your email');
        return response()->json(['message' => $notification]);
    }

    public function resendRegisterCode(Request $request){
        $rules = [
            'email'=>'required',
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = User::where('email', $request->email)->first();
        if($user){
            if($user->email_verified == 0){
                MailHelper::setMailConfig();

                $template=EmailTemplate::where('id',10)->first();
                $subject=$template->subject;
                $message=$template->description;
                $message = str_replace('{{user_name}}',$user->name,$message);
                Mail::to($user->email)->send(new UserRegistrationForOTP($message,$subject,$user));

                $notification = trans('admin_validation.Otp Resend Successfully. Please Verify your email');
                return response()->json(['notification' => $notification]);

            }else{
                $notification = trans('admin_validation.Already verfied your account');
                return response()->json(['notification' => $notification],403);
            }
        }else{
            $notification = trans('admin_validation.Email does not exist');
            return response()->json(['notification' => $notification],403);
        }

    }

    public function userVerification($otp){
        $user = User::where('forget_password_otp',$otp)->first();
        if($user){
            $user->forget_password_otp = null;
            $user->status = 'enable';
            $user->email_verified = 1;
            $user->save();
            $notification = trans('admin_validation.Verification Successfully');
            return response()->json(['message' => $notification]);
        }else{
            $notification = trans('admin_validation.Invalid otp');
            return response()->json(['message' => $notification],403);
        }
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
