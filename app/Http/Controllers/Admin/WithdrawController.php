<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Models\InfluencerWithdraw;
use App\Models\EmailTemplate;
use App\Models\Setting;
use App\Helpers\MailHelper;
use App\Mail\InfluencerWithdrawApproval;
use Mail;
use Auth;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $methods = WithdrawMethod::all();

        return view('admin.withdraw_method', compact('methods'));
    }

    public function create(){
        return view('admin.withdraw_method_create');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required',
            'withdraw_charge' => 'required',
            'description' => 'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'minimum_amount.required' => trans('admin_validation.Min amount is required'),
            'maximum_amount.required' => trans('admin_validation.Max amount is required'),
            'withdraw_charge.required' => trans('admin_validation.Charge is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $method = new WithdrawMethod();
        $method->name = $request->name;
        $method->min_amount = $request->minimum_amount;
        $method->max_amount = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description = $request->description;
        $method->status = 1;
        $method->save();

        $notification=trans('admin_validation.Create Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.withdraw-method.index')->with($notification);
    }

    public function edit($id){
        $method = WithdrawMethod::find($id);
        return view('admin.withdraw_method_edit', compact('method'));
    }

    public function update(Request $request, $id){

        $rules = [
            'name' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required',
            'withdraw_charge' => 'required',
            'description' => 'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'minimum_amount.required' => trans('admin_validation.Min amount is required'),
            'maximum_amount.required' => trans('admin_validation.Max amount is required'),
            'withdraw_charge.required' => trans('admin_validation.Charge is required'),
            'description.required' => trans('admin_validation.Description is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $method = WithdrawMethod::find($id);
        $method->name = $request->name;
        $method->min_amount = $request->minimum_amount;
        $method->max_amount = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description = $request->description;
        $method->status = $request->status;
        $method->save();

        $notification=trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.withdraw-method.index')->with($notification);
    }

    public function destroy($id){

        $method = WithdrawMethod::find($id);
        $method->delete();

        $notification=trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.withdraw-method.index')->with($notification);
    }

    public function influencer_withdraw(Request $request){
        $withdraws = InfluencerWithdraw::with('influencer')->orderBy('id','desc');

        if($request->influencer_id){
            $withdraws->where('influencer_id', $request->influencer_id);
        }

        $withdraws = $withdraws->get();

        return view('admin.withdraw_list', compact('withdraws'));
    }

    public function pending_withdraw(){
        $withdraws = InfluencerWithdraw::with('influencer')->orderBy('id','desc')->where('status',0)->get();

        return view('admin.withdraw_list', compact('withdraws'));
    }

    public function show_withdraw($id){

        $withdraw = InfluencerWithdraw::find($id);

        return view('admin.withdraw_show', compact('withdraw'));
    }

    public function destroy_withdraw($id){

        $withdraw = InfluencerWithdraw::find($id);
        $withdraw->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.influencer-withdraw')->with($notification);
    }

    public function approved_withdraw($id){

        $withdraw = InfluencerWithdraw::find($id);
        $withdraw->status = 1;
        $withdraw->approved_date = date('Y-m-d');
        $withdraw->save();

        $setting = Setting::first();

        $user = $withdraw->influencer;
        $template = EmailTemplate::where('id',5)->first();
        $message = $template->description;
        $subject = $template->subject;
        $message = str_replace('{{influencer_name}}',$user->name,$message);
        $message = str_replace('{{withdraw_method}}',$withdraw->method,$message);
        $message = str_replace('{{total_amount}}',$setting->currency_icon .$withdraw->total_amount,$message);
        $message = str_replace('{{withdraw_charge}}',$setting->currency_icon .($withdraw->total_amount - $withdraw->withdraw_amount),$message);
        $message = str_replace('{{withdraw_amount}}',$setting->currency_icon .$withdraw->withdraw_amount,$message);
        $message = str_replace('{{approval_date}}',$withdraw->approved_date,$message);
        MailHelper::setMailConfig();
        Mail::to($user->email)->send(new InfluencerWithdrawApproval($subject,$message));

        $notification = trans('admin_validation.Withdraw request approval successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.influencer-withdraw')->with($notification);

    }
}
