<?php

namespace Modules\Section\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Section\Entities\Partner;
use  Image;
use File;
use Str;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $partners = Partner::all();
        return view('section::partner',compact('partners'));
    }

    public function create()
    {
        return view('section::create_partner');
    }


    public function store(Request $request)
    {
        $rules = [
            'logo' => 'required'
        ];
        $customMessages = [
            'logo.required' => trans('admin_validation.Logo is required')
        ];
        $request->validate($rules,$customMessages);

        $partner = new Partner();
        if($request->logo){
            $extention = $request->logo->getClientOriginalExtension();
            $logo_name = 'our-partner'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;
            $request->logo->move(public_path('uploads/custom-images/'),$logo_name);
            $partner->logo=$logo_name;
        }
        $partner->link = $request->link;
        $partner->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }


    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('section::edit_partner',compact('partner'));
    }


    public function update(Request $request, $id)
    {
        $partner = Partner::find($id);

        if($request->logo){
            $old_logo = $partner->logo;
            $extention = $request->logo->getClientOriginalExtension();
            $logo_name = 'Partner'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $logo_name = 'uploads/custom-images/'.$logo_name;

            $request->logo->move(public_path('uploads/custom-images/'),$logo_name);

            $partner->logo = $logo_name;
            $partner->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $partner->link = $request->link;
        $partner->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }


    public function destroy($id)
    {
        $partner = Partner::find($id);
        $old_logo = $partner->logo;
        $partner->delete();
        if($old_logo){
            if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.partner.index')->with($notification);
    }

    public function changeStatus($id){
        $partner = Partner::find($id);
        if($partner->status == 1){
            $partner->status = 0;
            $partner->save();
            $message = trans('admin_validation.InActive Successfully');
        }else{
            $partner->status = 1;
            $partner->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
