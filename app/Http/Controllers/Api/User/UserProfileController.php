<?php

namespace App\Http\Controllers\Api\User;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Ticket;
use App\Rules\Captcha;
use App\Models\Message;
use App\Models\Wishlist;
use Illuminate\View\View;
use Hash, Image, File, Str;
use Illuminate\Http\Request;
use App\Models\RefundRequest;
use App\Models\TicketMessage;
use App\Models\CompleteRequest;
use App\Models\MessageDocument;
use App\Models\InfluencerWithdraw;
use App\Models\AppointmentSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Modules\Service\Entities\Service;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Modules\Service\Entities\AdditionalService;
use Modules\Service\Entities\ServiceTranslation;
use Modules\Subscription\Entities\ProviderMollie;
use Modules\Subscription\Entities\ProviderPaypal;
use Modules\Subscription\Entities\ProviderStripe;
use Modules\Subscription\Entities\PurchaseHistory;
use Modules\Subscription\Entities\ProviderPaystack;
use Modules\Subscription\Entities\ProviderRazorpay;
use Modules\Subscription\Entities\ProviderInstamojo;
use Modules\Subscription\Entities\ProviderFlutterwave;
use Modules\Subscription\Entities\ProviderBankHandcash;
use Modules\Service\Entities\AdditionalServiceTranslation;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function dashboard(Request $request)
    {
        $user = Auth::guard('api')->user();

        $active_order = Order::where('order_status','approved_by_influencer')->where('client_id', $user->id)->count();

        $complete_order = Order::where('order_status','complete')->where('client_id', $user->id)->count();

        $cancel_order = Order::where('client_id', $user->id)->where('order_status','order_decliened_by_influencer')->orWhere('order_status', 'order_decliened_by_client')->count();

        return response()->json([
            'user' => $user,
            'active_order' => $active_order,
            'complete_order' => $complete_order,
            'cancel_order' => $cancel_order
        ]);
    }


    public function update(Request $request)
    {
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required|max:220',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'email.required' => trans('admin_validation.Email is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'address.required' => trans('admin_validation.Address is required')
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->designation = $request->designation;
        $user->save();

        $notification= trans('admin_validation.Your profile updated successfully');
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

    public function upload_user_avatar(Request $request){
        $user = Auth::guard('api')->user();
        if($request->file('image')){
            $old_image = $user->image;
            $user_image = $request->image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = Str::slug($user->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($user_image)->save(public_path().'/'.$image_name);
            $user->image = $image_name;
            $user->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification = trans('admin_validation.Image updated successfully');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function orders(){

        $user = Auth::guard('api')->user();

        $orders = Order::with('influencer')->select('id','influencer_id','order_id','booking_date','order_status','total_amount','coupon_discount')->where('client_id', $user->id)->orderBy('id','desc')->paginate(10);

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function order_show($order_id){

        $user = Auth::guard('api')->user();

        $order = Order::with('influencer','service')->where('client_id', $user->id)->where('order_id', $order_id)->first();
        if(!$order)abort(404);
        $refund_request = RefundRequest::where('order_id', $order->id)->first();

        return response()->json([
            'order' => $order,
            'refund_request' => $refund_request
        ]);
    }

    public function mark_as_complete($id){
        $order = Order::find($id);
        $order->order_status = 'complete';
        $order->save();

        $notification = trans('admin_validation.Mark as a completed successfully');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function mark_as_declined($id){
        $order = Order::find($id);
        $order->order_status = 'order_decliened_by_client';
        $order->save();

        $notification = trans('admin_validation.Mark as a declined successfully');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function refund_request(Request $request, $id){
        $user = Auth::guard('api')->user();
        $rules = [
            'reasone'=>'required',
            'account_information'=>'required',
        ];
        $customMessages = [
            'order_id.required' => trans('admin_validation.Order id is required'),
            'reasone.required' => trans('admin_validation.Reasone is required'),
            'account_information.required' => trans('admin_validation.Account information is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $refund = new RefundRequest();
        $refund->client_id = $user->id;
        $refund->reasone = $request->reasone;
        $refund->order_id = $id;
        $refund->account_information = $request->account_information;
        $refund->save();

        $notification = trans('admin_validation.Refund request successfully');
        return response()->json([
            'message' => $notification
        ]);
    }


    public function add_to_wishlist($id){
        $user = Auth::guard('api')->user();
        $is_exist = Wishlist::where(['user_id' => $user->id, 'service_id' => $id])->count();
        if($is_exist == 0){

            $wishlist = new Wishlist();
            $wishlist->service_id = $id;
            $wishlist->user_id = $user->id;
            $wishlist->save();

            $message = trans('admin_validation.Item added to favourite list');
            return response()->json([
                'message' => $message
            ]);

        }else{
            $message = trans('admin_validation.Already added to favourite list');
            return response()->json([
                'message' => $message
            ]);
        }

    }

    public function wishlists(){

        $user = Auth::guard('api')->user();
        $wishlists = Wishlist::where(['user_id' => $user->id])->get();
        $wishlist_arr = array();
        foreach($wishlists as $wishlist){
            $wishlist_arr [] = $wishlist->service_id;
        }

        $services = Service::with('category','influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable'])->whereIn('id', $wishlist_arr)->get();

        return response()->json([
            'services' => $services
        ]);

    }

    public function remove_wishlist($id){

        $user = Auth::guard('api')->user();
        Wishlist::where(['user_id' => $user->id, 'service_id' => $id])->delete();

        $notification = trans('admin_validation.Item remove to favourite list');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function reviews(){

        $user = Auth::guard('api')->user();

        $reviews = Review::with('service')->orderBy('id','desc')->where('status', 1)->where('user_id', $user->id)->paginate(10);

        return response()->json([
            'reviews' => $reviews
        ]);
    }

    public function store_review(Request $request){

        $rules = [
            'rating'=>'required',
            'comment'=>'required',
            'g-recaptcha-response'=>new Captcha()
        ];
        $customMessages = [
            'rating.required' => trans('admin_validation.Rating is required'),
            'comment.required' => trans('admin_validation.Review is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();
        $is_exist_order = false;
        $is_exist_order = Order::where(['client_id' => $user->id])->count();

        if($is_exist_order){
            $review = new Review();
            $review->user_id = $user->id;
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->influencer_id = $request->influencer_id;
            $review->service_id = $request->service_id;
            $review->save();

            $message = trans('admin_validation.Review Submited successfully');
            return response()->json([
                'message' => $message
            ]);
        }else{
            $message = trans('admin_validation.Opps! You can not review this service');
            return response()->json([
                'status' => 0,
                'message' => $message
            ]);
        }
    }


    public function support_tickets(){
        $user = Auth::guard('api')->user();

        $tickets = Ticket::where('user_id', $user->id)->orderBy('id','desc')->paginate(10);

        return response()->json([
            'tickets' => $tickets
        ]);

    }

    public function support_tickets_show($ticket_id){

        $user = Auth::guard('api')->user();

        $ticket = Ticket::where('user_id', $user->id)->where('ticket_id', $ticket_id)->orderBy('id','desc')->first();

        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_user' => 1]);

        $messages = TicketMessage::where('ticket_id', $ticket->id)->get();

        return response()->json([
            'ticket' => $ticket,
            'messages' => $messages
        ]);

    }

    public function create_support_ticket(Request $request){

        $rules = [
            'subject'=>'required',
            'message'=>'required',
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();

        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->subject = $request->subject;
        $ticket->ticket_id = substr(rand(0,time()),0,10);
        $ticket->status = 'pending';
        $ticket->ticket_from = 'Client';
        $ticket->save();

        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'client';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        $notification = trans('admin_validation.Ticket created successfully');
        return response()->json([
            'message' => $notification
        ]);
    }

    public function send_ticket_message(Request $request){
        $rules = [
            'ticket_id'=>'required',
            'message'=>'required',
            'documents' => 'max:2048'
        ];
        $customMessages = [
            'message.required' => trans('admin_validation.Message is required'),
            'ticket_id.required' => trans('admin_validation.Ticket is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $user = Auth::guard('api')->user();
        $message = new TicketMessage();
        $message->ticket_id = $request->ticket_id;
        $message->admin_id = 0;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->message_from = 'client';
        $message->unseen_user = 1;
        $message->unseen_admin = 0;
        $message->save();

        if($request->hasFile('documents')){
            foreach($request->documents as $index => $request_file){
                $extention = $request_file->getClientOriginalExtension();
                $file_name = 'support-file-'.time().$index.'.'.$extention;
                $destinationPath = public_path('uploads/custom-images/');
                $request_file->move($destinationPath,$file_name);

                $document = new MessageDocument();
                $document->ticket_message_id = $message->id;
                $document->file_name = $file_name;
                $document->save();
            }
        }

        $notification = trans('admin_validation.Message send successfully');
        return response()->json([
            'message' => $notification
        ]);
    }


    public function account_delete(Request $request){

        $request->validate([
            'password' => 'required'
        ]);

        $user = Auth::guard('api')->user();

        if(Hash::check($request->password, $user->password)){

            try{

                $inluencer = User::find($user->id);
                $inluencer_image = $inluencer->image;

                if($inluencer_image){
                    if(File::exists(public_path().'/'.$inluencer_image))unlink(public_path().'/'.$inluencer_image);
                }

                $id = $user->id;

                AppointmentSchedule::where('user_id',$id)->delete();
                Review::where('influencer_id',$id)->delete();
                Review::where('user_id',$id)->delete();

                InfluencerWithdraw::where('influencer_id',$id)->delete();

                $orders = Order::where('influencer_id',$id)->get();
                foreach($orders as $order){
                    CompleteRequest::where('order_id',$order->id)->delete();
                    RefundRequest::where('order_id',$order->id)->delete();
                    $order->delete();
                }

                $orders = Order::where('client_id',$id)->get();
                foreach($orders as $order){
                    CompleteRequest::where('order_id',$order->id)->delete();
                    RefundRequest::where('order_id',$order->id)->delete();
                    $order->delete();
                }

                $tickets = Ticket::where('user_id', $id)->get();

                foreach($tickets as $ticket){
                    $messages = TicketMessage::where('ticket_id', $ticket->id)->get();
                    foreach($messages as $message){
                        $doucments = MessageDocument::where('ticket_message_id', $message->id)->get();
                        foreach($doucments as $doucment){
                            $document_file = $doucment->file_name;
                            if($document_file){
                                if(File::exists(public_path().'/'.$document_file))unlink(public_path().'/'.$document_file);
                            }
                            $doucment->delete();
                        }
                        $message->delete();
                    }
                    $ticket->delete();
                }


                $services = Service::where('influencer_id', $inluencer->id)->get();

                foreach($services as $service){
                    $additionals = AdditionalService::where('service_id', $service->id)->get();
                    foreach($additionals as $additional){
                        $additional_image = $additional->image;
                        if($additional_image){
                            if(File::exists(public_path().'/'.$additional_image))unlink(public_path().'/'.$additional_image);
                        }

                        AdditionalServiceTranslation::where('additional_service_id', $additional->id)->delete();

                        $additional->delete();
                    }
                    $service_image = $service->image;
                    if($service_image){
                        if(File::exists(public_path().'/'.$service_image))unlink(public_path().'/'.$service_image);
                    }

                    ServiceTranslation::where('service_id', $service->id)->delete();

                    $service->delete();
                }


                $paypal = ProviderPaypal::where('provider_id', $user->id)->first();
                $stripe = ProviderStripe::where('provider_id', $user->id)->first();
                $razorpay = ProviderRazorpay::where('provider_id', $user->id)->first();
                $flutterwave = ProviderFlutterwave::where('provider_id', $user->id)->first();
                $bank = ProviderBankHandcash::where('provider_id', $user->id)->first();
                $paystack = ProviderPaystack::where('provider_id', $user->id)->first();
                $mollie = ProviderMollie::where('provider_id', $user->id)->first();
                $instamojo = ProviderInstamojo::where('provider_id', $user->id)->first();

                PurchaseHistory::where('provider_id', $user->id)->delete();

                $inluencer->delete();


                $notification = trans('Account deleted successful');
                return response()->json([
                    'message' => $notification
                ]);

            }catch(Exception $ex){
                return response()->json([
                    'message' => $ex->getMessage()
                ], 500);
            }

        }else{
            $notification = trans('Please provide valid password');
            return response()->json([
                'message' => $notification
            ], 403);
        }
    }

}
