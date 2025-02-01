<?php

namespace App\Http\Controllers\Api\User;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;
use App\Models\Message;
use App\Models\Setting;
use App\Events\LiveChat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(){

        $buyer = Auth::guard('api')->user();

        $providers = Message::where(['buyer_id' => $buyer->id])->select('provider_id')->groupBy('provider_id')->orderBy('id','desc')->get();

        $provider_list = array();
        foreach($providers as $index => $seller_row){

            $user = User::find($seller_row->provider_id);

            $unread_message = Message:: where(['provider_id' => $seller_row->provider_id, 'buyer_id' => $buyer->id, 'buyer_read_msg' => 0])->count();

            $provider = (object) array(
                'id' => $seller_row->provider_id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'image' => $user->image,
                'designation' => $user->designation,
                'unread_message' => $unread_message,
            );
            $provider_list[] = $provider;
        }



        return response()->json([
            'providers' => $provider_list,
        ]);

        $sellers = Message::where(['buyer_id' => $buyer->id])->select('provider_id')->groupBy('provider_id')->orderBy('id','desc')->get();

        $seller_list = array();
        foreach($sellers as $index => $seller_row){
            $user = User::with('seller')->find($seller_row->seller_id);
            $messages = Message::with('product')->where(['customer_id' => $auth_user->id, 'seller_id' => $seller_row->seller_id])->get();
            $unread_message = $messages->where('send_by','seller')->where('customer_read_msg', 0)->count();
            $shop_detail = (object) array(
                'shop_owner_id' => $seller_row->seller_id,
                'shop_owner' => $user->name,
                'shop_name' => $user->seller->shop_name,
                'shop_or_vendor_id' => $user->seller->id,
                'shop_slug' => $user->seller->slug,
                'shop_logo' => $user->seller->logo,
                'unread_message' => $unread_message,
                'messages' => $messages
            );
            $seller_list[] = $shop_detail;
        }




        return response()->json([
            'providers' => $providers,
        ]);
    }


    public function get_message_list(Request $request, $provider_id){

        $buyer = Auth::guard('api')->user();

        $messages =  Message::with('service')->where(['buyer_id' => $buyer->id, 'provider_id' => $provider_id])->get();

        Message::where(['buyer_id' => $buyer->id, 'provider_id' => $provider_id])->update(['buyer_read_msg' => 1]);

        return response()->json([
            'messages' => $messages,
        ]);

    }

    public function load_chat_box($id){
        $buyer = Auth::guard('api')->user();

        $provider = User::find($id);

        $messages =  Message::with('service')->where(['buyer_id' => $buyer->id, 'provider_id' => $id])->get();

        Message::where(['buyer_id' => $buyer->id, 'provider_id' => $id])->update(['buyer_read_msg' => 1]);

        return view('chat_box')->with(['messages' => $messages, 'buyer' => $buyer, 'provider' => $provider]);

    }

    public function send_message_to_provider(Request $request){

        $buyer = Auth::guard('api')->user();

        $message = new Message();
        $message->provider_id = $request->provider_id;
        $message->buyer_id = $buyer->id;
        $message->message = $request->message;
        $message->provider_read_msg = 0;
        $message->buyer_read_msg = 1;
        $message->send_by = 'buyer';
        $message->service_id = $request->service_id ? $request->service_id : 0;
        $message->save();

        $provider = User::find($request->provider_id);

        $data = array([
            'buyer_id' => $buyer->id,
            'message_id' => $message->id
        ]);

        event(new LiveChat($provider, $data));

        $latest_message = Message::with('service')->find($message->id);

        return response()->json([
            'message' => $latest_message,
        ]);

    }
}
