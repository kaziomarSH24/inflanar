<?php

namespace App\Http\Controllers\Api\Influencer;
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

        $provider = Auth::guard('api')->user();

        $buyers = Message::where(['provider_id' => $provider->id])->select('buyer_id')->groupBy('buyer_id')->orderBy('id','desc')->get();

        $buyer_list = array();
        foreach($buyers as $index => $seller_row){

            $user = User::find($seller_row->buyer_id);

            $unread_message = Message:: where(['buyer_id' => $seller_row->buyer_id, 'provider_id' => $provider->id, 'provider_read_msg' => 0])->count();

            $buyer = (object) array(
                'id' => $seller_row->buyer_id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'image' => $user->image,
                'designation' => $user->designation,
                'unread_message' => $unread_message,
            );
            $buyer_list[] = $buyer;
        }


        return response()->json([
            'buyers' => $buyer_list,
        ]);


    }


    public function get_message_list(Request $request, $buyer_id){

        $provider = Auth::guard('api')->user();

        $messages =  Message::with('service')->where(['provider_id' => $provider->id, 'buyer_id' => $buyer_id])->get();

        Message::where(['provider_id' => $provider->id, 'buyer_id' => $buyer_id])->update(['provider_read_msg' => 1]);

        return response()->json([
            'messages' => $messages,
        ]);

    }


    public function send_message_to_buyer(Request $request){

        $provider = Auth::guard('api')->user();

        $message = new Message();
        $message->buyer_id = $request->buyer_id;
        $message->provider_id = $provider->id;
        $message->message = $request->message;
        $message->provider_read_msg = 1;
        $message->buyer_read_msg = 0;
        $message->send_by = 'provider';
        $message->service_id = $request->service_id ? $request->service_id : 0;
        $message->save();

        $data = array([
            'buyer_id' => $request->buyer_id,
            'provider_id' => $provider->id,
            'message_id' => $message->id
        ]);

        $buyer = User::find($request->buyer_id);

        event(new LiveChat($buyer, $data));

        $latest_message = Message::with('service')->find($message->id);

        return response()->json([
            'message' => $latest_message,
        ]);

    }
}
