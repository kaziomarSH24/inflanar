<?php

namespace App\Http\Controllers\Influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CompleteRequest;
use Auth;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request){
        Paginator::useBootstrap();

        $influencer = Auth::guard('web')->user();

        $orders = Order::with('client','service')->orderBy('id','desc')->where('influencer_id', $influencer->id);

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.All Bookings');

        return view('influencer.order', compact('orders','title'));
    }

    public function awaiting_booking(Request $request){
        Paginator::useBootstrap();

        $influencer = Auth::guard('web')->user();

        $orders = Order::with('client','service')->orderBy('id','desc')->where('influencer_id', $influencer->id)->where('order_status','awaiting_for_influencer_approval');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Awaiting Bookings');

        return view('influencer.order', compact('orders','title'));
    }

    public function active_booking(Request $request){
        Paginator::useBootstrap();

        $influencer = Auth::guard('web')->user();

        $orders = Order::with('client','service')->orderBy('id','desc')->where('influencer_id', $influencer->id)->where('order_status','approved_by_influencer');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Active Bookings');

        return view('influencer.order', compact('orders','title'));
    }

    public function complete_booking(Request $request){
        Paginator::useBootstrap();

        $influencer = Auth::guard('web')->user();

        $orders = Order::with('client','service')->orderBy('id','desc')->where('influencer_id', $influencer->id)->where('order_status','complete');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Complete Bookings');

        return view('influencer.order', compact('orders','title'));
    }

    public function decline_booking(Request $request){
        Paginator::useBootstrap();

        $influencer = Auth::guard('web')->user();

        $orders = Order::with('client','service')->orderBy('id','desc')->where('influencer_id', $influencer->id)->where('order_status','order_decliened_by_influencer')->orWhere('order_status', 'order_decliened_by_client');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Declined Bookings');

        return view('influencer.order', compact('orders','title'));
    }

    public function show($id){
        $order = Order::with('client','service')->where('order_id',$id)->first();

        $client = $order->client;
        $package_features = json_decode($order->package_features);
        $complete_request = CompleteRequest::where('order_id', $order->id)->first();

        return view('influencer.order_show',compact('order','client','package_features','complete_request'));
    }

    public function booking_approved_request($id){
        $order = Order::find($id);
        $order->order_status = 'approved_by_influencer';
        $order->save();

        $notification= trans('admin_validation.Approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function booking_decilend_request($id){
        $order = Order::find($id);
        $order->order_status = 'order_decliened_by_influencer';
        $order->save();

        $notification = trans('admin_validation.Mark as a declined successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function send_complete_request(Request $request, $id){
        $user = Auth::guard('web')->user();
        $rules = [
            'reasone'=>'required',
        ];
        $customMessages = [
            'reasone.required' => trans('admin_validation.Resone is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $data = new CompleteRequest();
        $data->influencer_id = $user->id;
        $data->order_id = $id;
        $data->reasone = $request->reasone;
        $data->save();

        $notification= trans('admin_validation.Request Send Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function complete_request(Request $request){

        Paginator::useBootstrap();

        $influencer = Auth::guard('web')->user();
        $completeRequests = CompleteRequest::where('influencer_id', $influencer->id)->get();
        $order_id_array = array();

        foreach($completeRequests as $completeRequest){
            $order_id_array[] = $completeRequest->order_id;
        }

        $orders = Order::with('client','service')->whereIn('id', $order_id_array)->orderBy('id','desc')->where('influencer_id', $influencer->id)->where('order_status', '!=', 'complete');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Complete Request');

        return view('influencer.order', compact('orders','title'));
    }


}
