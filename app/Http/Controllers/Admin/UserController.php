<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\InfluencerWithdraw;
use Modules\Service\Entities\Service;

use App\Models\EmailTemplate;
use App\Helpers\MailHelper;
use App\Mail\SingleInfluencerMail;

use App\Models\Wishlist;
use App\Models\CompleteRequest;
use App\Models\RefundRequest;
use App\Models\TicketMessage;
use App\Models\Ticket;
use App\Models\MessageDocument;

use App\Models\AppointmentSchedule;
use Modules\Service\Entities\AdditionalService;
use Modules\Service\Entities\AdditionalServiceTranslation;

use Auth, Str, Image, File, Hash, Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function influencer_list(){

        $influencers = User::where('is_influencer', 'yes')->orderBy('id','desc')->where('status', 'enable')->get();

        $title = trans('admin_validation.Influencer List');

        return view('admin.influencer_list', compact('influencers','title'));
    }

    public function pending_influencer(){

        $influencers = User::where('is_influencer', 'yes')->orderBy('id','desc')->where('status', 'disable')->get();

        $title = trans('admin_validation.Pending Influencer');

        return view('admin.influencer_list', compact('influencers','title'));
    }

    public function influencer_show($id){

        $influencer = User::where('is_influencer', 'yes')->where('id', $id)->first();

        $orders = Order::where('influencer_id', $influencer->id)->where('order_status', 'complete')->get();

        $total_sold_service = $orders->count();

        $total_balance = $orders->sum('total_amount');

        $total_withdraw = InfluencerWithdraw::where('influencer_id', $influencer->id)->sum('total_amount');

        $current_balance = $total_balance - $total_withdraw;

        $services = Service::where('influencer_id', $influencer->id)->get();
        $total_service = $services->count();

        return view('admin.influencer_show', compact('influencer','total_sold_service','total_withdraw','current_balance','total_service','total_balance'));
    }

    public function influencer_update(Request $request, $id){

        $influencer = User::where('is_influencer', 'yes')->where('id', $id)->first();

        $rules = [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$influencer->id,
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

        $influencer->name = $request->name;
        $influencer->phone = $request->phone;
        $influencer->country = $request->country;
        $influencer->address = $request->address;
        $influencer->designation = $request->designation;
        $influencer->about_me = $request->about_me;
        $influencer->tags = $request->tags;
        $influencer->school_name = $request->school_name;
        $influencer->school_year = $request->school_year;
        $influencer->varsity_name = $request->varsity_name;
        $influencer->varsity_year = $request->varsity_year;
        $influencer->total_follower = $request->total_follower;
        $influencer->total_following = $request->total_following;
        $influencer->facebook = $request->facebook;
        $influencer->twitter = $request->twitter;
        $influencer->instagram = $request->instagram;
        $influencer->tiktok = $request->tiktok;
        $influencer->save();

        if($request->file('image')){
            $old_image=$influencer->image;
            $user_image=$request->image;
            $extention=$user_image->getClientOriginalExtension();
            $image_name= Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name='uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $influencer->image=$image_name;
            $influencer->save();
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function send_email_single_influencer ($id){

        $influencer = User::find($id);
        return view('admin.influencer_single_email', compact('influencer'));
    }


    public function send_mail_single_influencer (Request $request, $id){

        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $influencer = User::find($id);

        MailHelper::setMailConfig();

        Mail::to($influencer->email)->send(new SingleInfluencerMail($request->subject,$request->message));

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function send_email_all_influencer (){
        return view('admin.influencer_all_email');
    }

    public function send_mail_to_all_influencer (Request $request){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $influencers = User::where('is_influencer', 'yes')->orderBy('id','desc')->get();

        MailHelper::setMailConfig();

        foreach($influencers as $influencer){
            Mail::to($influencer->email)->send(new SingleInfluencerMail($request->subject,$request->message));
        }

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function inluencer_destroy($id){

        $service_exist = Service::where('influencer_id', $id)->count();

        if($service_exist > 0){
            $notification= trans('admin_validation.You can not delete it, there are mulitple service available under this influencer');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $exist_order = Order::where('influencer_id',$id)->count();

        if($exist_order > 0){
            $notification= trans('admin_validation.You can not delete it, there are mulitple booking available under this influencer');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $inluencer = User::find($id);
        $inluencer_image = $inluencer->image;

        if($inluencer_image){
            if(File::exists(public_path().'/'.$inluencer_image))unlink(public_path().'/'.$inluencer_image);
        }

        AppointmentSchedule::where('user_id',$id)->delete();
        Review::where('influencer_id',$id)->delete();
        InfluencerWithdraw::where('influencer_id',$id)->delete();

        $orders = Order::where('influencer_id',$id)->get();
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
            $service->delete();
        }

        $inluencer->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function influencer_status($id){
        $provider = User::find($id);
        if($provider->status == 'enable'){
            $provider->status = 'disable';
            $provider->save();

            Service::where('influencer_id', $id)->update(['approve_by_admin' => 'enable']);

            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $provider->status = 'enable';
            $provider->save();

            Service::where('influencer_id', $id)->update(['approve_by_admin' => 'disable']);

            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function client_list(){

        $clients = User::where('is_influencer', 'no')->orderBy('id','desc')->where('status', 'enable')->get();

        $title = trans('admin_validation.Client List');

        return view('admin.client_list', compact('clients','title'));
    }

    public function pending_client(){

        $clients = User::where('is_influencer', 'no')->orderBy('id','desc')->where('status', 'disable')->get();

        $title = trans('admin_validation.Pending Client');

        return view('admin.client_list', compact('clients','title'));
    }

    public function client_show($id){

        $client = User::where('id', $id)->first();

        return view('admin.client_show', compact('client'));
    }

    public function client_destroy($id){

        $client = User::find($id);
        $client_image = $client->image;

        if($client_image){
            if(File::exists(public_path().'/'.$client_image))unlink(public_path().'/'.$client_image);
        }

        Review::where('user_id',$id)->delete();
        Wishlist::where('user_id',$id)->delete();
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

        $client->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.client-list')->with($notification);

    }

    public function send_email_to_single_client(Request $request, $id){
        $rules = [
            'subject'=>'required',
            'message'=>'required'
        ];
        $customMessages = [
            'subject.required' => trans('admin_validation.Subject is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $influencer = User::find($id);

        MailHelper::setMailConfig();

        Mail::to($influencer->email)->send(new SingleInfluencerMail($request->subject,$request->message));

        $notification = trans('admin_validation.Email Send Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }



}
