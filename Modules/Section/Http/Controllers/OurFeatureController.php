<?php

namespace Modules\Section\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Section\Entities\OurFeature;
use Modules\Section\Entities\OurFeatureTranslation;
use File;

class OurFeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $our_feature = OurFeature::with('translate')->first();

        $translate = OurFeatureTranslation::where('lang_code', $request->lang_code)->first();

        return view('section::our_feature', compact('our_feature','translate'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'title3' => 'required',
            'title4' => 'required',
            'description1' => 'required',
            'description2' => 'required',
            'description3' => 'required',
            'description4' => 'required',
        ],[
            'title1.required' => trans('admin_validation.Title is required'),
            'title2.required' => trans('admin_validation.Title is required'),
            'title3.required' => trans('admin_validation.Title is required'),
            'title4.required' => trans('admin_validation.Title is required'),
            'description1.required' => trans('admin_validation.Description is required'),
            'description2.required' => trans('admin_validation.Description is required'),
            'description3.required' => trans('admin_validation.Description is required'),
            'description4.required' => trans('admin_validation.Description is required')
        ]);

        $our_feature = OurFeature::first();

        if($request->icon1){
            $exist_banner = $our_feature->icon1;
            $extention = $request->icon1->getClientOriginalExtension();
            $banner_name = 'our-feature1'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->icon1->move(public_path('uploads/website-images/'),$banner_name);
            $our_feature->icon1 = $banner_name;
            $our_feature->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->icon2){
            $exist_banner = $our_feature->icon2;
            $extention = $request->icon2->getClientOriginalExtension();
            $banner_name = 'our-feature2'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->icon2->move(public_path('uploads/website-images/'),$banner_name);
            $our_feature->icon2 = $banner_name;
            $our_feature->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->icon3){
            $exist_banner = $our_feature->icon3;
            $extention = $request->icon3->getClientOriginalExtension();
            $banner_name = 'our-feature3'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->icon3->move(public_path('uploads/website-images/'),$banner_name);
            $our_feature->icon3 = $banner_name;
            $our_feature->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->icon4){
            $exist_banner = $our_feature->icon4;
            $extention = $request->icon4->getClientOriginalExtension();
            $banner_name = 'our-feature3'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->icon4->move(public_path('uploads/website-images/'),$banner_name);
            $our_feature->icon4 = $banner_name;
            $our_feature->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $translate = OurFeatureTranslation::where('id', $request->translate_id)->first();
        $translate->title1 = $request->title1;
        $translate->description1 = $request->description1;
        $translate->title2 = $request->title2;
        $translate->description2 = $request->description2;
        $translate->title3 = $request->title3;
        $translate->description3 = $request->description3;
        $translate->title4 = $request->title4;
        $translate->description4 = $request->description4;
        $translate->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function assign_language($lang_code){
        $feature_translate = OurFeatureTranslation::where('lang_code', admin_lang())->first();

        $translate = new OurFeatureTranslation();
        $translate->our_feature_id = $feature_translate->our_feature_id;
        $translate->lang_code = $lang_code;
        $translate->title1 = $feature_translate->title1;
        $translate->description1 = $feature_translate->description1;
        $translate->title2 = $feature_translate->title2;
        $translate->description2 = $feature_translate->description2;
        $translate->title3 = $feature_translate->title3;
        $translate->description3 = $feature_translate->description3;
        $translate->title4 = $feature_translate->title4;
        $translate->description4 = $feature_translate->description4;
        $translate->save();

    }


}
