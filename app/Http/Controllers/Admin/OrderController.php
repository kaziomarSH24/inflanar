<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\RefundRequest;
use App\Models\CompleteRequest;

use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){

        Paginator::useBootstrap();

        $orders = Order::with('client','influencer')->orderBy('id','desc');

        if($request->influencer){
            $orders = $orders->where('influencer_id', $request->influencer);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $orders = $orders->appends($request->all());

        $title = trans('admin_validation.All Bookings');

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        $clients = User::where(['status' => 'enable', 'is_influencer' => 'no'])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','influencers','clients'));
    }

    public function awaiting_booking(Request $request){

        Paginator::useBootstrap();

        $orders = Order::with('client','influencer')->orderBy('id','desc')->where('order_status','awaiting_for_influencer_approval');

        if($request->influencer){
            $orders = $orders->where('influencer_id', $request->influencer);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $orders = $orders->appends($request->all());

        $title = trans('admin_validation.Awaiting for influencer approval');

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        $clients = User::where(['status' => 'enable', 'is_influencer' => 'no'])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','influencers','clients'));
    }

    public function active_booking(Request $request){

        Paginator::useBootstrap();

        $orders = Order::with('client','influencer')->orderBy('id','desc')->where('order_status','approved_by_influencer');

        if($request->influencer){
            $orders = $orders->where('influencer_id', $request->influencer);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $orders = $orders->appends($request->all());

        $title = trans('admin_validation.Active Booking');

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        $clients = User::where(['status' => 'enable', 'is_influencer' => 'no'])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','influencers','clients'));
    }

    public function complete_booking(Request $request){

        Paginator::useBootstrap();

        $orders = Order::with('client','influencer')->orderBy('id','desc')->where('order_status','complete');

        if($request->influencer){
            $orders = $orders->where('influencer_id', $request->influencer);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $orders = $orders->appends($request->all());

        $title = trans('admin_validation.Complete Booking');

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        $clients = User::where(['status' => 'enable', 'is_influencer' => 'no'])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','influencers','clients'));
    }

    public function decline_booking(Request $request){

        Paginator::useBootstrap();

        $orders = Order::with('client','influencer')->orderBy('id','desc')->where('order_status','order_decliened_by_influencer')->orWhere('order_status', 'order_decliened_by_client');

        if($request->influencer){
            $orders = $orders->where('influencer_id', $request->influencer);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $orders = $orders->appends($request->all());

        $title = trans('admin_validation.Complete Booking');

        $influencers = User::where(['status' => 'enable', 'is_influencer' => 'yes'])->orderBy('name','asc')->get();

        $clients = User::where(['status' => 'enable', 'is_influencer' => 'no'])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','influencers','clients'));
    }

    public function complete_request(Request $request){

        $complete_requests = CompleteRequest::WhereHas('order', function($order){
            $order->where('order_status', '!=', 'complete');
        })->with('order','influencer')->orderBy('id','desc')->get();

        return view('admin.complete_request', compact('complete_requests'));
    }


    public function show($order_id){
        $order = Order::with('client','influencer','service')->orderBy('id','desc')->where('order_id',$order_id)->first();

        $package_features = json_decode($order->package_features);

        $client = $order->client;
        $influencer = $order->influencer;

        $refund_request = RefundRequest::where('order_id', $order->id)->first();
        $complete_request = CompleteRequest::where('order_id', $order->id)->first();

        return view('admin.order_show', ['order' => $order, 'client' => $client, 'influencer' => $influencer, 'package_features' => $package_features, 'refund_request' => $refund_request, 'complete_request' => $complete_request]);
    }


    public function mark_as_complete($id){
        $order = Order::find($id);
        $order->order_status = 'complete';
        $order->complete_by_admin = 'Yes';
        $order->save();

        $notification = trans('admin_validation.Mark as a completed successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function mark_as_declined($id){
        $order = Order::find($id);
        $order->order_status = 'order_decliened_by_influencer';
        $order->save();

        $notification = trans('admin_validation.Mark as a declined successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function booking_approved_request($id){
        $order = Order::find($id);
        $order->order_status = 'approved_by_influencer';
        $order->save();

        $notification= trans('admin_validation.Approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function payment_approved($id){
        $order = Order::find($id);
        $order->payment_status = 'success';
        $order->save();

        $notification= trans('admin_validation.Approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function refund_request_approved($id){
        $refund = RefundRequest::find($id);
        $refund->status = 'complete';
        $refund->save();

        $notification= trans('admin_validation.Request approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function refund_request_declined($id){
        $refund = RefundRequest::find($id);
        $refund->status = 'decliened_by_admin';
        $refund->save();

        $notification= trans('admin_validation.Declined Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function refund_request(Request $request){
        $refund_requests = RefundRequest::with('order','client')->orderBy('id','desc')->get();

        return view('admin.refund_request', compact('refund_requests'));
    }

    public function delete_order($id){

        $order = Order::find($id);

        CompleteRequest::where('order_id',$order->id)->delete();
        RefundRequest::where('order_id',$id)->delete();
        $order->delete();

        $notification = trans('admin_validation.Delete successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.all-booking')->with($notification);
    }






}
