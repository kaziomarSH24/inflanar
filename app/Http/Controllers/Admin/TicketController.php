<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\MessageDocument;
use Auth;
use File;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $tickets = Ticket::with('user')->orderBy('id','desc')->get();

        return view('admin.ticket', compact('tickets'));
    }

    public function show($id){
        $ticket = Ticket::with('user')->where('ticket_id', $id)->first();
        TicketMessage::where('ticket_id', $ticket->id)->update(['unseen_admin' => 1]);
        $messages = TicketMessage::where('ticket_id', $ticket->id)->get();

        return view('admin.ticket_show', compact('ticket','messages'));
    }

    public function destroy($id){
        Ticket::where('id', $id)->delete();
        $messages = TicketMessage::where('ticket_id', $id)->get();
        foreach($messages as $message){
            $documents = MessageDocument::where('ticket_message_id', $message->id)->get();
            foreach($documents as $document){
                $exist_file_name = $document->file_name;
                if($exist_file_name){
                    if(File::exists(public_path('uploads/custom-images').'/'.$exist_file_name))unlink(public_path('uploads/custom-images').'/'.$exist_file_name);
                }

                $document->delete();
            }
            $message->delete();
        }

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.ticket')->with($notification);
    }

    public function closed($id){
        $ticket = Ticket::where('id', $id)->first();
        $ticket->status = 'closed';
        $ticket->save();

        $notification= trans('admin_validation.Closed Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.ticket')->with($notification);
    }

    public function store_message(Request $request){
        $rules = [
            'ticket_id'=>'required',
            'message'=>'required',
            'user_id'=>'required',
            'documents' => 'max:2048'
        ];
        $customMessages = [
            'message.required' => trans('admin_validation.Message is required'),
            'ticket_id.required' => trans('admin_validation.Ticket is required'),
            'user_id.required' => trans('admin_validation.User is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $admin = Auth::guard('admin')->user();
        $message = new TicketMessage();
        $message->ticket_id = $request->ticket_id;
        $message->admin_id = $admin->id;
        $message->user_id = $request->user_id;
        $message->message = $request->message;
        $message->message_from = 'admin';
        $message->unseen_admin = 1;
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

        $firstSmsExist = TicketMessage::where('admin_id', '!=' , 0)->where('ticket_id',$request->ticket_id)->count();

        if($firstSmsExist == 1){
            $ticket = Ticket::where(['id' => $request->ticket_id])->first();
            $ticket->status = 'in_progress';
            $ticket->save();
        }

        $notification = trans('admin_validation.Message Send Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
