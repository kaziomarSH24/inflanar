<?php

namespace Modules\GlobalSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function contact_message(){

        $contact_messages = ContactMessage::orderBy('id','desc')->get();
        return view('globalsetting::contact_message', compact('contact_messages'));
    }

    public function show_message($id){

        $contact_message = ContactMessage::findOrFail($id);
        return view('globalsetting::show_contact_message', compact('contact_message'));
    }

    public function delete_message($id){

        $contact_message = ContactMessage::findOrFail($id);
        $contact_message->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function contact_message_setting(Request $request){
        $rules = [
            'contact_message_mail' => 'required',
        ];
        $customMessages = [
            'contact_message_mail.required' => trans('admin_validation.Contact email is required'),
        ];
        $request->validate($rules,$customMessages);

        $setting = Setting::first();
        $setting->contact_message_mail = $request->contact_message_mail;
        $setting->send_contact_message = $request->send_contact_message;
        $setting->save_contact_message = $request->save_contact_message;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }





}
