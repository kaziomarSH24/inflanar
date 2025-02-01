<?php

namespace Modules\Section\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Section\Entities\SliderOne;
use Modules\Section\Entities\SliderOneTranslation;
use Image;
use File;
use Str;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $slider = SliderOne::first();
        $translate = SliderOneTranslation::where(['slider_one_id' => $slider->id, 'lang_code' => $request->lang_code])->first();

        return view('section::slider', compact('slider','translate'));
    }

    public function home1_slider(Request $request)
    {

        $rules = [
            'home1_title' => 'required',
            'home1_header' => 'required'
        ];
        $customMessages = [
            'home1_title.required' => trans('admin_validation.Title is required'),
            'home1_header.required' => trans('admin_validation.Header is is required')
        ];
        $request->validate($rules,$customMessages);

        if($request->lang_code == admin_lang()){
            $slider = SliderOne::first();
            $slider->client_qty = $request->client_qty;
            $slider->tags = $request->tags;
            $slider->save();

            if($request->client_image){
                $existing_image = $slider->client_image;
                $extention = $request->client_image->getClientOriginalExtension();
                $image_name = 'slider-client'.date('-Ymdhis').'.'.$extention;
                $image_name = 'uploads/website-images/'.$image_name;
                Image::make($request->client_image)
                    ->save(public_path().'/'.$image_name);
                $slider->client_image = $image_name;
                $slider->save();

                if($existing_image){
                    if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
                }
            }

            if($request->home1_feature_image){
                $existing_image = $slider->home1_feature_image;
                $extention = $request->home1_feature_image->getClientOriginalExtension();
                $image_name = 'slider-one-feature'.date('-Ymdhis').'.'.$extention;
                $image_name = 'uploads/website-images/'.$image_name;
                Image::make($request->home1_feature_image)
                    ->save(public_path().'/'.$image_name);
                $slider->home1_feature_image = $image_name;
                $slider->save();

                if($existing_image){
                    if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
                }
            }
        }

        $translate = SliderOneTranslation::where(['id' => $request->translate_id])->first();
        $translate->home1_title = $request->home1_title;
        $translate->home1_header = $request->home1_header;
        $translate->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function home2_slider(Request $request)
    {

        $rules = [
            'home2_title' => 'required',
            'home2_header' => 'required'
        ];
        $customMessages = [
            'home2_title.required' => trans('admin_validation.Title is required'),
            'home2_header.required' => trans('admin_validation.Header is is required')
        ];
        $request->validate($rules,$customMessages);

        $slider = SliderOne::first();
        if($request->lang_code == admin_lang()){

            if($request->home2_feature_image){
                $existing_image = $slider->home2_feature_image;
                $extention = $request->home2_feature_image->getClientOriginalExtension();
                $image_name = 'slider2-feature'.date('-Ymdhis').'.'.$extention;
                $image_name = 'uploads/website-images/'.$image_name;
                Image::make($request->home2_feature_image)
                    ->save(public_path().'/'.$image_name);
                $slider->home2_feature_image = $image_name;
                $slider->save();

                if($existing_image){
                    if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
                }
            }

            if($request->home2_bg){
                $existing_image = $slider->home2_bg;
                $extention = $request->home2_bg->getClientOriginalExtension();
                $image_name = 'slider-two-bg'.date('-Ymdhis').'.'.$extention;
                $image_name = 'uploads/website-images/'.$image_name;
                Image::make($request->home2_bg)
                    ->save(public_path().'/'.$image_name);
                $slider->home2_bg = $image_name;
                $slider->save();

                if($existing_image){
                    if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
                }
            }
        }

        $translate = SliderOneTranslation::where(['id' => $request->translate_id])->first();
        $translate->home2_title = $request->home2_title;
        $translate->home2_header = $request->home2_header;
        $translate->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function home3_slider(Request $request)
    {

        $rules = [
            'home3_title' => 'required',
            'home3_header' => 'required'
        ];
        $customMessages = [
            'home3_title.required' => trans('admin_validation.Title is required'),
            'home3_header.required' => trans('admin_validation.Header is is required')
        ];
        $request->validate($rules,$customMessages);

        $slider = SliderOne::first();
        if($request->lang_code == admin_lang()){

            if($request->home3_feature_image){
                $existing_image = $slider->home3_feature_image;
                $extention = $request->home3_feature_image->getClientOriginalExtension();
                $image_name = 'slider3-feature'.date('-Ymdhis').'.'.$extention;
                $image_name = 'uploads/website-images/'.$image_name;
                Image::make($request->home3_feature_image)
                    ->save(public_path().'/'.$image_name);
                $slider->home3_feature_image = $image_name;
                $slider->save();

                if($existing_image){
                    if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
                }
            }
        }

        $translate = SliderOneTranslation::where(['id' => $request->translate_id])->first();
        $translate->home3_title = $request->home3_title;
        $translate->home3_header = $request->home3_header;
        $translate->home3_item1 = $request->home3_item1;
        $translate->home3_item2 = $request->home3_item2;
        $translate->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function assign_language($lang_code){
        $slider_translate = SliderOneTranslation::where('lang_code', admin_lang())->first();
        $translate = new SliderOneTranslation();
        $translate->slider_one_id = $slider_translate->slider_one_id;
        $translate->lang_code = $lang_code;
        $translate->home1_title = $slider_translate->home1_title;
        $translate->home1_header = $slider_translate->home1_header;
        $translate->home2_title = $slider_translate->home2_title;
        $translate->home2_header = $slider_translate->home2_header;
        $translate->home3_title = $slider_translate->home3_title;
        $translate->home3_header = $slider_translate->home3_header;
        $translate->home3_item1 = $slider_translate->home3_item1;
        $translate->home3_item2 = $slider_translate->home3_item2;
        $translate->save();
    }
}
