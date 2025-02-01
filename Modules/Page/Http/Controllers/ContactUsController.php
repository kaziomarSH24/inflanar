<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\ContactUs;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $contact_us = ContactUs::first();
        return view('page::contact_us', compact('contact_us'));
    }

    public function update(Request $request)
    {
        $rules = [
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'map_code' => 'required',
        ];
        $customMessages = [
            'email.required' => trans('admin_validation.Email is required'),
            'phone.unique' => trans('admin_validation.Phone is required'),
            'address.unique' => trans('admin_validation.Address is required'),
            'map_code.unique' => trans('admin_validation.Google Map is required')
        ];
        $request->validate($rules,$customMessages);

        $contact_us = ContactUs::first();
        $contact_us->email = $request->email;
        $contact_us->phone = $request->phone;
        $contact_us->address = $request->address;
        $contact_us->map_code = $request->map_code;
        $contact_us->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
