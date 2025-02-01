<?php

namespace Modules\Section\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Section\Entities\WhyChooseUs;
use Modules\Section\Entities\WhyChooseUsTranslation;
use Image;
use File;
use Str;

class WhyChooseUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $why_choose_us = WhyChooseUs::first();
        $translate = WhyChooseUsTranslation::where(['lang_code' => $request->lang_code, 'why_choose_us_id' => $why_choose_us->id])->first();

        return view('section::why_choose_us', compact('why_choose_us','translate'));
    }


    public function home2_why_choose_us(Request $request)
    {
        $request->validate([
            'home2_title' => 'required',
            'home2_header' => 'required',
            'home2_description' => 'required',
            'home2_item1' => 'required',
            'home2_des1' => 'required',
            'home2_item2' => 'required',
            'home2_des2' => 'required',

        ],[
            'home2_title.required' => trans('admin_validation.Title is required'),
            'home2_header.required' => trans('admin_validation.Header is required'),
            'home2_description.required' => trans('admin_validation.Description is required'),
            'home2_item1.required' => trans('admin_validation.Item is required'),
            'home2_des1.required' => trans('admin_validation.Description is required'),
            'home2_item2.required' => trans('admin_validation.Item is required'),
            'home2_des2.required' => trans('admin_validation.Description is required'),

        ]);

        $translate = WhyChooseUsTranslation::where(['id' => $request->translate_id])->first();

        $translate->home2_title = $request->home2_title;
        $translate->home2_header = $request->home2_header;
        $translate->home2_description = $request->home2_description;
        $translate->home2_item1 = $request->home2_item1;
        $translate->home2_des1 = $request->home2_des1;
        $translate->home2_item2 = $request->home2_item2;
        $translate->home2_des2 = $request->home2_des2;
        $translate->home2_item3 = $request->home2_item3;
        $translate->home2_des3 = $request->home2_des3;
        $translate->save();

        $why_choose_us = WhyChooseUs::first();

        if($request->home2_image){
            $exist_banner = $why_choose_us->home2_image;
            $extention = $request->home2_image->getClientOriginalExtension();
            $banner_name = 'why_choose_us2'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home2_image->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home2_image = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home2_foreground1){
            $exist_banner = $why_choose_us->home2_foreground1;
            $extention = $request->home2_foreground1->getClientOriginalExtension();
            $banner_name = 'why_choose_us_forg'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home2_foreground1->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home2_foreground1 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home2_foreground2){
            $exist_banner = $why_choose_us->home2_foreground2;
            $extention = $request->home2_foreground2->getClientOriginalExtension();
            $banner_name = 'why_choose_us_forg'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home2_foreground2->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home2_foreground2 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home2_icon1){
            $exist_banner = $why_choose_us->home2_icon1;
            $extention = $request->home2_icon1->getClientOriginalExtension();
            $banner_name = 'why_choose_us-item'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home2_icon1->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home2_icon1 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home2_icon2){
            $exist_banner = $why_choose_us->home2_icon2;
            $extention = $request->home2_icon2->getClientOriginalExtension();
            $banner_name = 'why_choose_us-item'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home2_icon2->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home2_icon2 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home2_icon3){
            $exist_banner = $why_choose_us->home2_icon3;
            $extention = $request->home2_icon3->getClientOriginalExtension();
            $banner_name = 'why_choose_us-item'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home2_icon3->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home2_icon3 = $banner_name;
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
            'home3_title' => 'required',
            'home3_header' => 'required',
            'home3_description' => 'required',
            'home3_item1' => 'required',
            'home3_des1' => 'required',
            'home3_item2' => 'required',
            'home3_des2' => 'required',

        ],[
            'home3_title.required' => trans('admin_validation.Title is required'),
            'home3_header.required' => trans('admin_validation.Header is required'),
            'home3_description.required' => trans('admin_validation.Description is required'),
            'home3_item1.required' => trans('admin_validation.Item is required'),
            'home3_des1.required' => trans('admin_validation.Description is required'),
            'home3_item2.required' => trans('admin_validation.Item is required'),
            'home3_des2.required' => trans('admin_validation.Description is required'),

        ]);

        $translate = WhyChooseUsTranslation::where(['id' => $request->translate_id])->first();

        $translate->home3_title = $request->home3_title;
        $translate->home3_header = $request->home3_header;
        $translate->home3_description = $request->home3_description;
        $translate->home3_item1 = $request->home3_item1;
        $translate->home3_des1 = $request->home3_des1;
        $translate->home3_item2 = $request->home3_item2;
        $translate->home3_des2 = $request->home3_des2;
        $translate->home3_item3 = $request->home3_item3;
        $translate->home3_des3 = $request->home3_des3;
        $translate->save();

        $why_choose_us = WhyChooseUs::first();

        if($request->home3_image){
            $exist_banner = $why_choose_us->home3_image;
            $extention = $request->home3_image->getClientOriginalExtension();
            $banner_name = 'why_choose_us2'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_image->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_image = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home3_icon1){
            $exist_banner = $why_choose_us->home3_icon1;
            $extention = $request->home3_icon1->getClientOriginalExtension();
            $banner_name = 'why_choose_us-item'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_icon1->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_icon1 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home3_icon2){
            $exist_banner = $why_choose_us->home3_icon2;
            $extention = $request->home3_icon2->getClientOriginalExtension();
            $banner_name = 'why_choose_us-item'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_icon2->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_icon2 = $banner_name;
            $why_choose_us->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->home3_icon3){
            $exist_banner = $why_choose_us->home3_icon3;
            $extention = $request->home3_icon3->getClientOriginalExtension();
            $banner_name = 'why_choose_us-item'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->home3_icon3->move(public_path('uploads/website-images/'),$banner_name);
            $why_choose_us->home3_icon3 = $banner_name;
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
        $why_translate = WhyChooseUsTranslation::where('lang_code', admin_lang())->first();
        $translate = new WhyChooseUsTranslation();

        $translate->why_choose_us_id = $why_translate->why_choose_us_id;
        $translate->lang_code = $lang_code;
        $translate->home2_title = $why_translate->home2_title;
        $translate->home2_header = $why_translate->home2_header;
        $translate->home2_description = $why_translate->home2_description;
        $translate->home2_item1 = $why_translate->home2_item1;
        $translate->home2_des1 = $why_translate->home2_des1;
        $translate->home2_item2 = $why_translate->home2_item2;
        $translate->home2_des2 = $why_translate->home2_des2;
        $translate->home2_item3 = $why_translate->home2_item3;
        $translate->home2_des3 = $why_translate->home2_des3;
        $translate->home3_title = $why_translate->home3_title;
        $translate->home3_header = $why_translate->home3_header;
        $translate->home3_description = $why_translate->home3_description;
        $translate->home3_item1 = $why_translate->home3_item1;
        $translate->home3_des1 = $why_translate->home3_des1;
        $translate->home3_item2 = $why_translate->home3_item2;
        $translate->home3_des2 = $why_translate->home3_des2;
        $translate->home3_item3 = $why_translate->home3_item3;
        $translate->home3_des3 = $why_translate->home3_des3;
        $translate->save();
    }



}
