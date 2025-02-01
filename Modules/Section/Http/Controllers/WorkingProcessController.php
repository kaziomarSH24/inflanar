<?php

namespace Modules\Section\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Section\Entities\WorkingProccess;
use Modules\Section\Entities\WorkingProccessTranslation;
use Image;
use File;
use Str;

class WorkingProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $why_choose_us = WorkingProccess::first();
        $translate = WorkingProccessTranslation::where(['lang_code' => $request->lang_code, 'working_proccess_id' => $why_choose_us->id])->first();

        return view('section::working_process', compact('why_choose_us','translate'));
    }


    public function home1_why_choose_us(Request $request)
    {
        $request->validate([
            'home1_title1' => 'required',
            'home1_title2' => 'required',
            'home1_title3' => 'required',
            'home1_title3' => 'required',
            'home1_description1' => 'required',
            'home1_description2' => 'required',
            'home1_description3' => 'required',
            'home1_description4' => 'required',
        ],[
            'home1_title1.required' => trans('admin_validation.Title is required'),
            'home1_title2.required' => trans('admin_validation.Title is required'),
            'home1_title3.required' => trans('admin_validation.Title is required'),
            'home1_title4.required' => trans('admin_validation.Title is required'),
            'home1_description1.required' => trans('admin_validation.Description is required'),
            'home1_description2.required' => trans('admin_validation.Description is required'),
            'home1_description3.required' => trans('admin_validation.Description is required'),
            'home1_description4.required' => trans('admin_validation.Description is required'),
        ]);

        $translate = WorkingProccessTranslation::where(['id' => $request->translate_id])->first();

        $translate->home1_title1 = $request->home1_title1;
        $translate->home1_title2 = $request->home1_title2;
        $translate->home1_title3 = $request->home1_title3;
        $translate->home1_title4 = $request->home1_title4;
        $translate->home1_description1 = $request->home1_description1;
        $translate->home1_description2 = $request->home1_description2;
        $translate->home1_description3 = $request->home1_description3;
        $translate->home1_description4 = $request->home1_description4;
        $translate->save();

        $why_choose_us = WorkingProccess::first();

        if($request->home1_image1){
            $exist_banner = $why_choose_us->home1_image1;
            $extention = $request->home1_image1->getClientOriginalExtension();
            $banner_name = 'why_choose_us1'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home1_image1->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home1_image1 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home1_image2){
            $exist_banner = $why_choose_us->home1_image2;
            $extention = $request->home1_image2->getClientOriginalExtension();
            $banner_name = 'why_choose_us2'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home1_image2->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home1_image2 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home1_image3){
            $exist_banner = $why_choose_us->home1_image3;
            $extention = $request->home1_image3->getClientOriginalExtension();
            $banner_name = 'why_choose_us3'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home1_image3->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home1_image3 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home1_image4){
            $exist_banner = $why_choose_us->home1_image4;
            $extention = $request->home1_image4->getClientOriginalExtension();
            $banner_name = 'why_choose_us3'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home1_image4->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home1_image4 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $notification = trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function home3_why_choose_us(Request $request)
    {
        $request->validate([
            'home3_title1' => 'required',
            'home3_title2' => 'required',
            'home3_title3' => 'required',
            'home3_title3' => 'required',
            'home3_description1' => 'required',
            'home3_description2' => 'required',
            'home3_description3' => 'required',
            'home3_description4' => 'required',
        ],[
            'home3_title1.required' => trans('admin_validation.Title is required'),
            'home3_title2.required' => trans('admin_validation.Title is required'),
            'home3_title3.required' => trans('admin_validation.Title is required'),
            'home3_title4.required' => trans('admin_validation.Title is required'),
            'home3_description1.required' => trans('admin_validation.Description is required'),
            'home3_description2.required' => trans('admin_validation.Description is required'),
            'home3_description3.required' => trans('admin_validation.Description is required'),
            'home3_description4.required' => trans('admin_validation.Description is required'),
        ]);

        $translate = WorkingProccessTranslation::where(['id' => $request->translate_id])->first();

        $translate->home3_title1 = $request->home3_title1;
        $translate->home3_title2 = $request->home3_title2;
        $translate->home3_title3 = $request->home3_title3;
        $translate->home3_title4 = $request->home3_title4;
        $translate->home3_description1 = $request->home3_description1;
        $translate->home3_description2 = $request->home3_description2;
        $translate->home3_description3 = $request->home3_description3;
        $translate->home3_description4 = $request->home3_description4;
        $translate->save();

        $why_choose_us = WorkingProccess::first();

        if($request->home3_image1){
            $exist_banner = $why_choose_us->home3_image1;
            $extention = $request->home3_image1->getClientOriginalExtension();
            $banner_name = 'why_choose_us5'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_image1->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_image1 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home3_image2){
            $exist_banner = $why_choose_us->home3_image2;
            $extention = $request->home3_image2->getClientOriginalExtension();
            $banner_name = 'why_choose_us6'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_image2->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_image2 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home3_image3){
            $exist_banner = $why_choose_us->home3_image3;
            $extention = $request->home3_image3->getClientOriginalExtension();
            $banner_name = 'why_choose_us7'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_image3->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_image3 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home3_image4){
            $exist_banner = $why_choose_us->home3_image4;
            $extention = $request->home3_image4->getClientOriginalExtension();
            $banner_name = 'why_choose_us8'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_image4->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_image4 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $notification = trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function assign_language($lang_code){
        $working_translate = WorkingProccessTranslation::where('lang_code', admin_lang())->first();
        $translate = new WorkingProccessTranslation();
        $translate->working_proccess_id = $working_translate->working_proccess_id;
        $translate->lang_code = $lang_code;
        $translate->home1_title1 = $working_translate->home1_title1;
        $translate->home1_title2 = $working_translate->home1_title2;
        $translate->home1_title3 = $working_translate->home1_title3;
        $translate->home1_title4 = $working_translate->home1_title4;
        $translate->home1_description1 = $working_translate->home1_description1;
        $translate->home1_description2 = $working_translate->home1_description2;
        $translate->home1_description3 = $working_translate->home1_description3;
        $translate->home1_description4 = $working_translate->home1_description4;
        $translate->home3_title1 = $working_translate->home3_title1;
        $translate->home3_title2 = $working_translate->home3_title2;
        $translate->home3_title3 = $working_translate->home3_title3;
        $translate->home3_title4 = $working_translate->home3_title4;
        $translate->home3_description1 = $working_translate->home3_description1;
        $translate->home3_description2 = $working_translate->home3_description2;
        $translate->home3_description3 = $working_translate->home3_description3;
        $translate->home3_description4 = $working_translate->home3_description4;
        $translate->save();
    }
}
