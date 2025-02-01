<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $privacy_policy = PrivacyPolicy::where('lang_code', $request->lang_code)->first();

        return view('page::privacy_policy', compact('privacy_policy'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ],[
            'description.required' => trans('admin_validation.Privacy policy is required')
        ]);

        $privacy_policy = PrivacyPolicy::findOrFail($request->translate_id);
        $privacy_policy->description = $request->description;
        $privacy_policy->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function assign_language($lang_code){
        $privacy_policy_translates = PrivacyPolicy::where('lang_code', admin_lang())->first();

        $privacy_policy = new PrivacyPolicy();
        $privacy_policy->lang_code = $lang_code;
        $privacy_policy->description = $privacy_policy_translates->description;
        $privacy_policy->save();
    }
}
