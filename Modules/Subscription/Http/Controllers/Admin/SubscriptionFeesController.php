<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Subscription\Entities\SubscriptionFee;

class SubscriptionFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $busisess_fees = SubscriptionFee::where('user_type','business')
                        ->first();
        $influencer_fees =SubscriptionFee::where('user_type','influencer')
                        ->first();
        // dd($subscription_fee);
        if($busisess_fees && $influencer_fees){
            return view('subscription::admin.subscription_fees', compact('busisess_fees','influencer_fees'));
        }elseif($busisess_fees){
            return view('subscription::admin.subscription_fees', compact('busisess_fees'));
        }elseif($influencer_fees){
            return view('subscription::admin.subscription_fees', compact('influencer_fees'));
        }else{
            return view('subscription::admin.subscription_fees');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscription::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_type' => 'required',
            'business_fees_amount' => $request->user_type == 'business' ? 'required' : '',
            'influencer_fees_amount' => $request->user_type == 'influencer' ? 'required' : '',
        ],[
            'business_fees_amount.required ' => 'Fees amount is required',
            'influencer_fees_amount.required ' => 'Fees amount is required',
        ]);

        $subscription_fees = $request->user_type == 'business' ? SubscriptionFee::firstOrNew(['id' => 1]) : SubscriptionFee::firstOrNew(['id' => 2]);
        $subscription_fees->fees_type = $request->fees_type;
        $subscription_fees->fees = $request->user_type == 'business' ? $request->business_fees_amount : $request->influencer_fees_amount;
        $subscription_fees->user_type = $request->user_type;
        $subscription_fees->save();

        $notification = 'Subscription fee updated successfully';
        $notification = array('message' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subscription::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('subscription::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
