<?php

namespace App\Http\Controllers\Api\Influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Setting;
use Auth;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function coupon_history(){

        $influencer = Auth::guard('api')->user();

        $coupon_histories = CouponHistory::where(['influencer_id' => $influencer->id])->orderBy('id', 'desc')->get();
        $setting = Setting::first();

        return response()->json([
            'coupon_histories' => $coupon_histories,
            'setting' => $setting,
        ]);
    }

    public function index(){

        $influencer = Auth::guard('api')->user();

        $coupons = Coupon::where(['influencer_id' => $influencer->id])->orderBy('id', 'desc')->get();

        return response()->json([
            'coupons' => $coupons
        ]);

    }

    public function store(Request $request){

        $auth_user = Auth::guard('api')->user();

        $rules = [
            'coupon_code'=>'required|unique:coupons',
            'offer_percentage'=>'required',
            'expired_date'=>'required',
        ];
        $customMessages = [
            'coupon_code.required' => trans('admin_validation.Coupon code is required'),
            'coupon_code.unique' => trans('admin_validation.Coupon already exist'),
            'offer_percentage.required' => trans('admin_validation.Offer percentage is required'),
            'expired_date.required' => trans('admin_validation.Expired date is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $coupon = new Coupon();
        $coupon->influencer_id = $auth_user->id;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->offer_percentage = $request->offer_percentage;
        $coupon->expired_date = $request->expired_date;
        $coupon->status = $request->status;
        $coupon->save();

        $notification= trans('admin_validation.Created Successfully');
        return response()->json([
            'message' => $notification
        ]);

    }

    public function show(Request $request, $id)
    {
        $coupon = Coupon::where(['id' => $id])->first();

        return response()->json([
            'coupon' => $coupon,
        ]);

    }

    public function update(Request $request, $id){

        $auth_user = Auth::guard('api')->user();

        $rules = [
            'coupon_code'=>'required|unique:coupons,coupon_code,'.$id,
            'offer_percentage'=>'required',
            'expired_date'=>'required',
        ];
        $customMessages = [
            'coupon_code.required' => trans('admin_validation.Coupon code is required'),
            'coupon_code.unique' => trans('admin_validation.Coupon already exist'),
            'offer_percentage.required' => trans('admin_validation.Offer percentage is required'),
            'expired_date.required' => trans('admin_validation.Expired date is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $coupon = Coupon::find($id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->offer_percentage = $request->offer_percentage;
        $coupon->expired_date = $request->expired_date;
        $coupon->status = $request->status;
        $coupon->save();

        $notification= trans('admin_validation.Updated Successfully');
        return response()->json([
            'message' => $notification
        ]);

    }

    public function destroy($id){
        $coupon = Coupon::find($id);
        $coupon->delete();

        $notification= trans('admin_validation.Deleted Successfully');
        return response()->json([
            'message' => $notification
        ]);

    }
}
