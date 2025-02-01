<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\BannerImage;
use Hash, Auth, File;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $logedin_admin = Auth::guard('admin')->user();
        if($logedin_admin->admin_type == 1){
            $admins = Admin::orderBy('id','asc')->get();

            return view('admin.admin_list', compact('admins'));
        }else return abort(404);

    }

    public function create(){
        $logedin_admin = Auth::guard('admin')->user();
        if($logedin_admin->admin_type == 1){
            return view('admin.admin_create');
        }else return abort(404);


    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required|min:4',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.min' => trans('admin_validation.Password Must be 4 characters'),
        ];
        $this->validate($request, $rules,$customMessages);

        $admin = new Admin();
        $admin->name =$request->name;
        $admin->email =$request->email;
        $admin->status =$request->status;
        $admin->password =Hash::make($request->password);
        $admin->save();

        $notification = trans('admin_validation.Create Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.admin-list.index')->with($notification);
    }

    public function edit($id){

        $admin = Admin::find($id);

        return view('admin.admin_edit', compact('admin'));
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$id,
            'password' => $request->password ? 'min:4' : '',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.min' => trans('admin_validation.Password Must be 4 characters'),
        ];
        $this->validate($request, $rules,$customMessages);

        $admin = Admin::find($id);
        $admin->name =$request->name;
        $admin->email =$request->email;
        $admin->status =$request->status;
        if($request->password){
            $admin->password =Hash::make($request->password);
        }
        $admin->save();

        $notification = trans('admin_validation.Create Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.admin-list.index')->with($notification);
    }

    public function destroy($id){
        $admin = Admin::find($id);
        $old_image = $admin->image;
        $admin->delete();
        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

}
