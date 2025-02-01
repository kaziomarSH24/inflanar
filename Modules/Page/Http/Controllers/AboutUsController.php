<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\AboutUs;
use Modules\Page\Entities\AboutUsTranslation;
use Image, File, Str;

class AboutUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $about_us = AboutUs::first();
        $translate = AboutUsTranslation::where('lang_code', $request->lang_code)->first();

        return view('page::about_us', compact('about_us','translate'));
    }


    public function update(Request $request)
    {
        $rules = [
            'header'=>'required',
            'title'=>'required',
            'description'=>'required',
            'ceo_name'=>'required',
            'ceo_designation'=>'required',
        ];
        $customMessages = [
            'header.required' => trans('admin_validation.Header is required'),
            'title.required' => trans('admin_validation.Title is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'ceo_name.required' => trans('admin_validation.CEO name is required'),
            'ceo_designation.required' => trans('admin_validation.CEO designation is required'),
        ];
        $request->validate($rules,$customMessages);

        $about_us = AboutUs::first();

        if($request->about_image){
            $old_image = $about_us->about_image;
            $image_name = 'about-us'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->about_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $about_us->about_image = $image_name;
            $about_us->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->ceo_avatar){
            $old_image = $about_us->ceo_avatar;
            $image_name = 'ceo-avatar'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->ceo_avatar)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $about_us->ceo_avatar = $image_name;
            $about_us->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->ceo_signeture){
            $old_image = $about_us->ceo_signeture;
            $image_name = 'ceo-signature'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->ceo_signeture)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $about_us->ceo_signeture = $image_name;
            $about_us->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $translate = AboutUsTranslation::where('lang_code', $request->lang_code)->first();
        $translate->header = $request->header;
        $translate->title = $request->title;
        $translate->description = $request->description;
        $translate->ceo_name = $request->ceo_name;
        $translate->ceo_designation = $request->ceo_designation;
        $translate->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function assign_language($lang_code){
        $about_translates = AboutUsTranslation::where('lang_code', admin_lang())->get();
        foreach($about_translates as $about_translate){
            $translate = new AboutUsTranslation();
            $translate->about_us_id = $about_translate->about_us_id;
            $translate->lang_code = $lang_code;
            $translate->header = $about_translate->header;
            $translate->title = $about_translate->title;
            $translate->description = $about_translate->description;
            $translate->ceo_name = $about_translate->ceo_name;
            $translate->ceo_designation = $about_translate->ceo_designation;
            $translate->save();
        }
    }

}
