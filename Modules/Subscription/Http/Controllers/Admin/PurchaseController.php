<?php
/**
 * Quick note: here change the user rore ( influencer means business provider, client means influencer)
 */
namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Entities\PurchaseHistory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class PurchaseController extends Controller
{

    public function index()
    {
        //bootstrap pagination
        Paginator::useBootstrap();


        $histories = PurchaseHistory::with('provider')->orderBy('id','desc')->paginate(20);

        return view('subscription::admin.purchase_history', compact('histories'));
    }

    public function pending_payment()
    {
        $histories = PurchaseHistory::with('provider')->orderBy('id','desc')->where('payment_status','pending')->paginate(20);

        return view('subscription::admin.purchase_history', compact('histories'));
    }

    public function create()
    {
        $business_plans = SubscriptionPlan::where('status', 1)
                        ->where('type', 'business')
                        ->orderBy('serial','asc')->get();
        $influencer_plans = SubscriptionPlan::where('status', 1)
                        ->where('type', 'influencer')
                        ->orderBy('serial','asc')->get();

        // $plans = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->get();

        $business_providers = User::where('is_influencer','yes')->get(); //here influencer means business provider

        // dd($influencers);
        $business_providers = [
            'user_type' => 'business',
            'users' => $business_providers
        ];

        $influencers = User::where('is_influencer','no')->get(); //client (normal user) means influencer

        $influencers = [
            'user_type' => 'influencer',
            'users' => $influencers
        ];

        // return view('subscription::admin.assign_plan', compact('plans','providers'));
        return view('subscription::admin.assign_plan', compact('business_plans','influencer_plans','business_providers', 'influencers'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'type' => 'required',
            $request->type == 'business' ? 'provider_id' : 'influncer_id' => 'required',
            'plan_id' => 'required',
            'maximum_service' => 'required|numeric',  //If type is influencer then it will be maximum_applies
        ],[
            'type.required' => "User type is required",
            'maximum_service.required' => $request->type == 'influencer' ? 'Maximum applies is required' : 'Maximum service is required',
            // 'provider_id.required' => trans('admin_validation.Provider is required'),
            'provider_id.required' => 'Business Provider is required',
            'influncer_id.required' => 'Influencer is required',
            'plan_id.required' => trans('admin_validation.Plan is required'),
        ]);

        $plan = SubscriptionPlan::find($request->plan_id);

        if($request->has('expiration_date')){
            if($request->expiration_date == 'daily'){
                $expiration_date = date('Y-m-d', strtotime('1 days'));
            }elseif($request->expiration_date == 'monthly'){
                $expiration_date = date('Y-m-d', strtotime('30 days'));
            }elseif($request->expiration_date == 'yearly'){
                $expiration_date = date('Y-m-d', strtotime('365 days'));
            }elseif($request->expiration_date == 'lifetime'){
                $expiration_date = 'lifetime';
            }
        }else{
            if($plan->expiration_date == 'daily'){
                $expiration_date = date('Y-m-d', strtotime('1 days'));
            }
            elseif($plan->expiration_date == 'monthly'){
                $expiration_date = date('Y-m-d', strtotime('30 days'));
            }elseif($plan->expiration_date == 'yearly'){
                $expiration_date = date('Y-m-d', strtotime('365 days'));
            }elseif($plan->expiration_date == 'lifetime'){
                $expiration_date = 'lifetime';
            }
            return $expiration_date;
        }



        PurchaseHistory::where('provider_id', $request->provider_id)->update(['status' => 'expired']);

        $purchase = new PurchaseHistory();

        $purchase->provider_id = $request->type == 'business' ? $request->provider_id : $request->influncer_id;
        $purchase->plan_id = $request->plan_id;
        $purchase->plan_name = $plan->plan_name;
        $purchase->plan_price = $plan->plan_price;
        $purchase->expiration = $plan->expiration_date;
        $purchase->expiration_date = $expiration_date;
        $purchase->maximum_service = $request->maximum_service ?? $plan->maximum_service;
        $purchase->status = 'active';
        $purchase->payment_method = 'handcash';
        $purchase->payment_status = 'success';
        $purchase->transaction = 'hand_cash';
        $purchase->type = $request->type; //user type (influencer or business)
        $purchase->save();

        $notification = trans('admin_validation.Assign Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function show($id)
    {

        $history = PurchaseHistory::with('provider')->where('id', $id)->first();

        return view('subscription::admin.purchase_history_show', compact('history'));
    }


    public function approved_plan_payment($id){

        $history = PurchaseHistory::with('provider')->where('id', $id)->first();

        PurchaseHistory::where('provider_id', $history->provider_id)->update(['status' => 'expired']);

        $history = PurchaseHistory::with('provider')->where('id', $id)->first();
        $history->payment_status = 'success';
        $history->status = 'active';
        $history->save();

        $notification = trans('admin_validation.Approved Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.purchase-history')->with($notification);
    }


    public function delete_plan_payment($id)
    {
        $history = PurchaseHistory::with('provider')->where('id', $id)->first();
        $history->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.purchase-history')->with($notification);

    }
}
