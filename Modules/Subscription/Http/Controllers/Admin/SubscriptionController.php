<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Subscription\Entities\SubscriptionPlan;
use App\Models\Setting;
use Str;
use File;
use  Image;

class SubscriptionController extends Controller
{
    public function index()
    {

        $business_plans = SubscriptionPlan::where('type','business')
                        ->orderBy('serial','asc')->get();
        $influencer_plans = SubscriptionPlan::where('type','influencer')
                        ->orderBy('serial','asc')->get();

        return view('subscription::admin.subscription', compact('business_plans','influencer_plans'));
    }


    public function create()
    {
        return view('subscription::admin.subscription_create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'plan_name' => 'required',
            'plan_price' => 'required',
            'expiration_date' => 'required',
            'maximum_service' => 'required',
            'serial' => 'required',
            'status' => 'required',
        ],[
            // 'type.required' => trans('admin_validation.Plan Type is required'),
            // 'plan_name.required' => trans('admin_validation.Plan name is required'),
            // 'plan_price.required' => trans('admin_validation.Plan price is required'),
            // 'expiration_date.required' => trans('admin_validation.Expiration date is required'),
            // 'maximum_service.required' => trans('admin_validation.Maximum service is required'),
            // 'serial.required' => trans('admin_validation.Serial is required')
            'type.required' => trans('Plan Type is required'),
            'plan_name.required' => trans('Plan name is required'),
            'plan_price.required' => trans('Plan price is required'),
            'expiration_date.required' => trans('Expiration date is required'),
            'maximum_service.required' => trans('Maximum service is required'),
            'serial.required' => trans('Serial is required')

        ]);

        // dd($request->all());
        $plan = new SubscriptionPlan();
        $plan->type = $request->type;
        $plan->plan_name = $request->plan_name;
        $plan->plan_price = $request->plan_price;
        $plan->expiration_date = $request->expiration_date;
        $plan->maximum_service = $request->maximum_service;
        $plan->serial = $request->serial;
        $plan->status = $request->status;
        $plan->save();

        $notification = trans('admin_validation.Create Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.subscription-plan.index')->with($notification);
    }

    public function show($id)
    {
        return view('subscription::show');
    }

    public function edit($id)
    {

        $plan = SubscriptionPlan::find($id);

        return view('subscription::admin.subscription_edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'plan_name' => 'required',
            'plan_price' => 'required',
            'expiration_date' => 'required',
            'maximum_service' => 'required',
            'serial' => 'required',
            'status' => 'required',
        ],[
            'type.required' => trans('admin_validation.Plan Type is required'),
            'plan_name.required' => trans('admin_validation.Plan name is required'),
            'plan_price.required' => trans('admin_validation.Plan price is required'),
            'expiration_date.required' => trans('admin_validation.Expiration date is required'),
            'maximum_service.required' => trans('admin_validation.Maximum service is required'),
            'serial.required' => trans('admin_validation.Serial is required')

        ]);

        $plan = SubscriptionPlan::find($id);
        $plan->type = $request->type;
        $plan->plan_name = $request->plan_name;
        $plan->plan_price = $request->plan_price;
        $plan->expiration_date = $request->expiration_date;
        $plan->maximum_service = $request->maximum_service;
        $plan->serial = $request->serial;
        $plan->status = $request->status;
        $plan->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.subscription-plan.index')->with($notification);
    }


    public function destroy($id)
    {
        $plan = SubscriptionPlan::find($id);
        $plan->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.subscription-plan.index')->with($notification);

    }
}
