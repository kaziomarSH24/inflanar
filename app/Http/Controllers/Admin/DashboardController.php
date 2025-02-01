<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Setting;
use App\Models\InfluencerWithdraw;
use App\Models\RefundRequest;
use App\Models\User;

use Modules\Service\Entities\Service;
use Modules\Blog\Entities\Blog;
use File;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard(){

        $today_orders = Order::orderBy('id','desc')->whereDay('created_at', now()->day)->get();

        $today_total_order = $today_orders->count();
        $today_total_awating_order = $today_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $today_approved_order = $today_orders->where('order_status','approved_by_influencer')->count();
        $today_complete_order = $today_orders->where('order_status','complete')->count();
        $today_declined_order = $today_orders->where('order_status','order_decliened_by_influencer')->count();

        $today_total_earning = $today_orders->where('payment_status','success')->sum('total_amount');

        $today_withdraws = InfluencerWithdraw::whereDay('created_at', now()->day)->get();
        $today_withdraw_request = $today_withdraws->sum('total_amount');

        $refund_requests = RefundRequest::with('order')->whereDay('created_at', now()->day)->get();
        $today_total_refund = 0;
        foreach($refund_requests as $refund_request){
            $today_total_refund += $refund_request->order->total_amount;
        }

        $today_users = User::whereDay('created_at', now()->day)->count();

        // end today

        // start this month

        $monthly_orders = Order::orderBy('id','desc')->whereMonth('created_at', now()->month)->get();

        $monthly_total_order = $monthly_orders->count();
        $monthly_total_awating_order = $monthly_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $monthly_approved_order = $monthly_orders->where('order_status','approved_by_influencer')->count();
        $monthly_complete_order = $monthly_orders->where('order_status','complete')->count();
        $monthly_declined_order = $monthly_orders->where('order_status','order_decliened_by_influencer')->count();

        $monthly_total_earning = $monthly_orders->where('payment_status','success')->sum('total_amount');

        $monthly_withdraws = InfluencerWithdraw::whereMonth('created_at', now()->month)->get();
        $monthly_withdraw_request = $today_withdraws->sum('total_amount');

        $refund_requests = RefundRequest::with('order')->whereMonth('created_at', now()->month)->get();

        $monthly_total_refund = 0;
        foreach($refund_requests as $refund_request){
            $monthly_total_refund += $refund_request->order->total_amount;
        }

        $monthly_users = User::whereMonth('created_at', now()->month)->count();

        // end monthly

        // start yearly

        $yearly_orders = Order::orderBy('id','desc')->whereYear('created_at', now()->year)->get();

        $yearly_total_order = $yearly_orders->count();
        $yearly_total_awating_order = $yearly_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $yearly_approved_order = $yearly_orders->where('order_status','approved_by_influencer')->count();
        $yearly_complete_order = $yearly_orders->where('order_status','complete')->count();
        $yearly_declined_order = $yearly_orders->where('order_status','order_decliened_by_influencer')->count();

        $yearly_total_earning = $yearly_orders->where('payment_status','success')->sum('total_amount');

        $yearly_withdraws = InfluencerWithdraw::whereYear('created_at', now()->year)->get();
        $yearly_withdraw_request = $today_withdraws->sum('total_amount');

        $refund_requests = RefundRequest::with('order')->whereYear('created_at', now()->year)->get();

        $yearly_total_refund = 0;
        foreach($refund_requests as $refund_request){
            $yearly_total_refund += $refund_request->order->total_amount;
        }

        $yearly_users = User::whereYear('created_at', now()->year)->count();

        // end yarly

        // start total
        $total_orders = Order::orderBy('id','desc')->get();
        $total_total_order = $total_orders->count();
        $total_total_awating_order = $total_orders->where('order_status','awaiting_for_influencer_approval')->count();
        $total_approved_order = $total_orders->where('order_status','approved_by_influencer')->count();
        $total_complete_order = $total_orders->where('order_status','complete')->count();
        $total_declined_order = $total_orders->where('order_status','order_decliened_by_influencer')->count();

        $total_total_earning = $total_orders->where('payment_status','success')->sum('total_amount');

        $total_withdraws = InfluencerWithdraw::all();
        $total_withdraw_request = $today_withdraws->sum('total_amount');

        $refund_requests = RefundRequest::with('order')->get();

        $total_total_refund = 0;
        foreach($refund_requests as $refund_request){
            $total_total_refund += $refund_request->order->total_amount;
        }

        $total_users = User::count();

        $total_service = Service::count();
        $total_blog = Blog::count();
        $total_influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->count();
        $total_clients = User::where(['status' => 'enable', 'is_influencer' => 'no'])->orderBy('name','asc')->count();
        // end total

        return view('admin.dashboard', compact('today_total_order','today_total_awating_order','today_approved_order','today_complete_order','today_declined_order','today_total_earning','today_withdraw_request','today_total_refund','today_users','monthly_total_order','monthly_total_awating_order','monthly_approved_order','monthly_complete_order','monthly_declined_order','monthly_total_earning','monthly_withdraw_request','monthly_total_refund','monthly_users','yearly_total_order','yearly_total_awating_order','yearly_approved_order','yearly_complete_order','yearly_declined_order','yearly_total_earning','yearly_withdraw_request','yearly_total_refund','yearly_users','total_total_order','total_total_awating_order','total_approved_order','total_complete_order','total_declined_order','total_total_earning','total_withdraw_request','total_total_refund','total_users','total_service','total_blog','total_influencers','total_clients'));
    }

}
