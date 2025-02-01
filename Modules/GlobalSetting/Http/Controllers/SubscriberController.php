<?php

namespace Modules\GlobalSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Subscriber;

use App\Helpers\MailHelper;
use App\Mail\SubscirberSendMail;
use Str;
use Mail;
use Hash;
use Auth;

class SubscriberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subscriber_list()
    {
        $subscribers = Subscriber::where('is_verified',1)->get();
        return view('globalsetting::subscriber_list', compact('subscribers'));
    }

    public function send_subscriber_email(Request $request)
    {
        $rules = [
            'subject' => 'required',
            'message' => 'required',
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $request->validate($rules,$customMessages);

        $subscribers = Subscriber::where('is_verified',1)->get();
        if($subscribers->count() > 0){
            MailHelper::setMailConfig();
            foreach($subscribers as $index => $subscriber){
                Mail::to($subscriber->email)->send(new SubscirberSendMail($request->subject,$request->message));
            }

            $notification = trans('admin_validation.Email Send Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }else{

            $notification = trans('admin_validation.Something Went Wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function delete_subscriber($id){
        $subscriber = Subscriber::find($id);
        $subscriber->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
