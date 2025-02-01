<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Helpers\MailHelper;
use Mail, Session, Str, Auth, Hash;

use App\Mail\UserForgetPassword;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Models\User;
use App\Rules\Captcha;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ],[
            'email.required' => trans('admin_validation.Email is required')
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

        MailHelper::setMailConfig();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $notification= trans('admin_validation.A password reset link has been send to your mail');
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status), $notification)
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }


    public function custom_forget_password(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'g-recaptcha-response'=>new Captcha()
        ],[
            'email.required' => trans('admin_validation.Email is required')
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){
            $user->forget_password_token = Str::random(100);
            $user->save();

            MailHelper::setMailConfig();
            $template = EmailTemplate::where('id',1)->first();
            $subject = $template->subject;
            $message = $template->description;
            $message = str_replace('{{name}}',$user->name,$message);
            Mail::to($user->email)->send(new UserForgetPassword($message,$subject,$user));

            $notification= trans('admin_validation.A password reset link has been send to your mail');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);

        }else{
            $notification = trans('admin_validation.Email does not exist');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }


        MailHelper::setMailConfig();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        $notification= trans('admin_validation.A password reset link has been send to your mail');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
    }
}
