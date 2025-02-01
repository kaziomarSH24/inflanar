<?php

namespace App\Http\Controllers\Api\Influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\InfluencerWithdraw;
use Modules\Service\Entities\Service;
use App\Models\Setting;
use App\Models\RefundRequest;

use Auth, Str, Image, File, Hash;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Wishlist;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\MessageDocument;
use App\Models\Message;
use App\Models\Review;
use App\Rules\Captcha;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function dashboard(){

        $influencer = Auth::guard('api')->user();

        $today_orders = Order::orderBy('id','desc')->where('influencer_id', $influencer->id)->whereDay('created_at', now()->day)->get();

        $today_total_order = $today_orders->count();
        $today_total_awating_order = $today_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $today_approved_order = $today_orders->where('order_status','approved_by_influencer')->count();
        $today_complete_order = $today_orders->where('order_status','complete')->count();
        $today_declined_order = $today_orders->where('order_status','order_decliened_by_influencer')->count();

        $today_total_earning = $today_orders->where('payment_status','success')->sum('total_amount');

        $today_withdraws = InfluencerWithdraw::whereDay('created_at', now()->day)->where('status',1)->where('influencer_id', $influencer->id)->get();
        $today_withdraw_request = $today_withdraws->sum('total_amount');

        // end today

        // start this month

        $monthly_orders = Order::orderBy('id','desc')->where('influencer_id', $influencer->id)->whereMonth('created_at', now()->month)->get();

        $monthly_total_order = $monthly_orders->count();
        $monthly_total_awating_order = $monthly_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $monthly_approved_order = $monthly_orders->where('order_status','approved_by_influencer')->count();
        $monthly_complete_order = $monthly_orders->where('order_status','complete')->count();
        $monthly_declined_order = $monthly_orders->where('order_status','order_decliened_by_influencer')->count();

        $monthly_total_earning = $monthly_orders->where('payment_status','success')->sum('total_amount');

        $monthly_withdraws = InfluencerWithdraw::whereMonth('created_at', now()->month)->where('status',1)->where('influencer_id', $influencer->id)->get();
        $monthly_withdraw_request = $today_withdraws->sum('total_amount');

        // end monthly

        // start yearly

        $yearly_orders = Order::orderBy('id','desc')->where('influencer_id', $influencer->id)->whereYear('created_at', now()->year)->get();

        $yearly_total_order = $yearly_orders->count();
        $yearly_total_awating_order = $yearly_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $yearly_approved_order = $yearly_orders->where('order_status','approved_by_influencer')->count();
        $yearly_complete_order = $yearly_orders->where('order_status','complete')->count();
        $yearly_declined_order = $yearly_orders->where('order_status','order_decliened_by_influencer')->count();

        $yearly_total_earning = $yearly_orders->where('payment_status','success')->sum('total_amount');

        $yearly_withdraws = InfluencerWithdraw::whereYear('created_at', now()->year)->where('status',1)->where('influencer_id', $influencer->id)->get();
        $yearly_withdraw_request = $today_withdraws->sum('total_amount');
        // end yarly


        // start total
        $total_orders = Order::orderBy('id','desc')->where('influencer_id', $influencer->id)->get();
        $total_total_order = $total_orders->count();
        $total_total_awating_order = $total_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $total_approved_order = $total_orders->where('order_status','approved_by_influencer')->count();
        $total_complete_order = $total_orders->where('order_status','complete')->count();
        $total_declined_order = $total_orders->where('order_status','order_decliened_by_influencer')->count();

        $total_total_earning = $total_orders->where('payment_status','success')->sum('total_amount');

        $total_withdraws = InfluencerWithdraw::where('status',1)->where('influencer_id', $influencer->id)->get();
        $total_withdraw_request = $today_withdraws->sum('total_amount');

        $total_service = Service::where('influencer_id', $influencer->id)->count();
        // end total

        $orders = Order::where('influencer_id', $influencer->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = InfluencerWithdraw::where('influencer_id', $influencer->id)->sum('total_amount');
        
        $withdraws = InfluencerWithdraw::where('influencer_id',$influencer->id)->orderBy('id','desc')->get();

        $current_balance = $total_balance - $total_withdraw;

        return response()->json([
            'today_total_order' => $today_total_order,
            'today_total_awating_order' => $today_total_awating_order,
            'today_approved_order' => $today_approved_order,
            'today_complete_order' => $today_complete_order,
            'today_declined_order' => $today_declined_order,
            'today_total_earning' => $today_total_earning,
            'today_withdraw_request' => $today_withdraw_request,
            'monthly_total_order' => $monthly_total_order,
            'monthly_total_awating_order' => $monthly_total_awating_order,
            'monthly_approved_order' => $monthly_approved_order,
            'monthly_complete_order' => $monthly_complete_order,
            'monthly_declined_order' => $monthly_declined_order,
            'monthly_total_earning' => $monthly_total_earning,
            'monthly_withdraw_request' => $monthly_withdraw_request,
            'yearly_total_order' => $yearly_total_order,
            'yearly_total_awating_order' => $yearly_total_awating_order,
            'yearly_approved_order' => $yearly_approved_order,
            'yearly_complete_order' => $yearly_complete_order,
            'yearly_declined_order' => $yearly_declined_order,
            'yearly_total_earning' => $yearly_total_earning,
            'yearly_withdraw_request' => $yearly_withdraw_request,
            'total_total_order' => $total_total_order,
            'total_total_awating_order' => $total_total_awating_order,
            'total_approved_order' => $total_approved_order,
            'total_complete_order' => $total_complete_order,
            'total_declined_order' => $total_declined_order,
            'total_total_earning' => $total_total_earning,
            'total_withdraw_request' => $total_withdraw_request,
            'total_service' => $total_service,
            'user' => $influencer,
            'total_withdraw' => $total_withdraw,
            'current_balance' => $current_balance,
            'total_balance' => $total_balance,
             'withdraws' => $withdraws,
        ]);

    }

    public function edit_profile(){

        $influencer = Auth::guard('api')->user();

        $orders = Order::where('influencer_id', $influencer->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = InfluencerWithdraw::where('influencer_id', $influencer->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $services = Service::where('influencer_id', $influencer->id)->get();
        $total_service = $services->count();

        return response()->json([
            'user' => $influencer,
            'total_sold_service' => $total_sold_service,
            'total_withdraw' => $total_withdraw,
            'current_balance' => $current_balance,
            'total_service' => $total_service,
            'total_balance' => $total_balance,
        ]);
    }

    public function profile_update(Request $request){
        $user = Auth::guard('api')->user();

        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'phone'=>'required',
            'country'=>'required',
            'designation'=>'required',
            'address'=>'required',
            'about_me'=>'required',
            'total_follower'=>'required',
            'total_following'=>'required',
            'tags'=>'required',
            'school_name'=>'max:250',
            'school_year'=>'max:250',
            'varsity_name'=>'max:250',
            'varsity_year'=>'max:250',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'email.unique' => trans('admin_validation.Email already exist'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'country.required' => trans('admin_validation.Country or region is required'),
            'designation.required' => trans('admin_validation.Desgination is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'about_me.required' => trans('admin_validation.About is required'),
            'tags.required' => trans('admin_validation.Skill is required'),
            'total_follower.required' => trans('admin_validation.Follower is required'),
            'total_following.required' => trans('admin_validation.Following is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->designation = $request->designation;
        $user->about_me = $request->about_me;
        $user->tags = $request->tags;
        $user->school_name = $request->school_name;
        $user->school_year = $request->school_year;
        $user->varsity_name = $request->varsity_name;
        $user->varsity_year = $request->varsity_year;
        $user->total_follower = $request->total_follower;
        $user->total_following = $request->total_following;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->tiktok = $request->tiktok;
        $user->save();

        if($request->file('image')){
            $old_image=$user->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $user->image=$image_name;
            $user->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification= trans('admin_validation.Update Successfully');
        return response()->json([
            'message' => $notification
        ]);
    }



    public function update_password(Request $request)
    {
        $rules = [
            'current_password'=>'required',
            'password'=>'required|min:4|confirmed',
        ];
        $customMessages = [
            'current_password.required' => trans('admin_validation.Current password is required'),
            'password.required' => trans('admin_validation.Password is required'),
            'password.min' => trans('admin_validation.Password minimum 4 character'),
            'password.confirmed' => trans('admin_validation.Confirm password does not match'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();
        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            $notification = trans('admin_validation.Password change successfully');
            return response()->json([
                'message' => $notification
            ]);

        }else{
            $notification = trans('admin_validation.Current password does not match');
            return response()->json([
                'message' => $notification
            ]);
        }
    }

}
