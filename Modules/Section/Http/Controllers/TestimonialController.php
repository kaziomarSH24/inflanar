<?php

namespace Modules\Section\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Section\Entities\Testimonial;
use Modules\Section\Entities\TestimonialTranslation;
use Modules\Language\Entities\Language;
use File;
use Image;
use Str;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $testimonials = Testimonial::with('translate')->orderBy('id','desc')->get();

        return view('section::testimonial', compact('testimonials'));
    }

    public function create()
    {
        return view('section::testimonial_create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'image' => 'required',
            'status' => 'required',
            'comment' => 'required',
            'logo' => 'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'designation.required' => trans('admin_validation.Designation is required'),
            'image.required' => trans('admin_validation.Image is required'),
            'comment.required' => trans('admin_validation.Comment is required'),
            'logo.required' => trans('admin_validation.Logo is required'),
        ];
        $request->validate($rules,$customMessages);

        $testimonial = new Testimonial();

        if($request->image){
            $extention = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Ymdhis').'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $testimonial->image = $image_name;
        }

        if($request->logo){
            $extention = $request->logo->getClientOriginalExtension();
            $image_name = Str::slug($request->name.'-logo').date('-Ymdhis').'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->logo)
                ->save(public_path().'/'.$image_name);
            $testimonial->logo = $image_name;
        }

        $testimonial->status = $request->status;
        $testimonial->save();

        $languages = Language::all();
        foreach($languages as $language){
            $translate = new TestimonialTranslation();
            $translate->lang_code = $language->lang_code;
            $translate->testimonial_id = $testimonial->id;
            $translate->name = $request->name;
            $translate->designation = $request->designation;
            $translate->comment = $request->comment;
            $translate->save();
        }

        $notification = trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.testimonial.edit', ['testimonial' => $testimonial,'lang_code' => admin_lang()] )->with($notification);
    }


    public function edit(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $translate = TestimonialTranslation::where(['testimonial_id' => $id, 'lang_code' => $request->lang_code])->first();

        return view('section::testimonial_edit', compact('testimonial','translate'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'designation.required' => trans('admin_validation.Designation is required'),
            'image.required' => trans('admin_validation.Image is required'),
            'comment.required' => trans('admin_validation.Comment is required'),
            'logo.required' => trans('admin_validation.Logo is required'),
        ];
        $request->validate($rules,$customMessages);


        $testimonial = Testimonial::findOrFail($id);

        if($request->lang_code == admin_lang()){
            $testimonial->status = $request->status;
            $testimonial->save();
        }

        if($request->image){
            $existing_image = $testimonial->image;
            $extention = $request->image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Ymdhis').'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->save(public_path().'/'.$image_name);
            $testimonial->image = $image_name;
            $testimonial->save();

            if($existing_image){
                if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
            }
        }

        if($request->logo){
            $existing_image = $testimonial->logo;
            $extention = $request->logo->getClientOriginalExtension();
            $image_name = Str::slug($request->name.'-logo').date('-Ymdhis').'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;
            Image::make($request->logo)
                ->save(public_path().'/'.$image_name);
            $testimonial->logo = $image_name;
            $testimonial->save();

            if($existing_image){
                if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
            }
        }

        $translate = TestimonialTranslation::where(['testimonial_id' => $id, 'lang_code' => $request->lang_code])->first();
        $translate->name = $request->name;
        $translate->designation = $request->designation;
        $translate->comment = $request->comment;
        $translate->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        $existing_image = $testimonial->image;
        $existing_logo = $testimonial->logo;

        TestimonialTranslation::where(['testimonial_id' => $id])->delete();

        $testimonial->delete();

        if($existing_image){
            if(File::exists(public_path().'/'.$existing_image))unlink(public_path().'/'.$existing_image);
        }

        if($existing_logo){
            if(File::exists(public_path().'/'.$existing_logo))unlink(public_path().'/'.$existing_logo);
        }

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.testimonial.index')->with($notification);
    }

    public function assign_language($lang_code){
        $testi_translates = TestimonialTranslation::where('lang_code', admin_lang())->get();
        foreach($testi_translates as $testi_translate){
            $translate = new TestimonialTranslation();
            $translate->lang_code = $lang_code;
            $translate->testimonial_id = $testi_translate->testimonial_id;
            $translate->name = $testi_translate->name;
            $translate->designation = $testi_translate->designation;
            $translate->comment = $testi_translate->comment;
            $translate->save();
        }
    }
}
