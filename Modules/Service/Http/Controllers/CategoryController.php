<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\CategoryTranslation;
use Modules\Language\Entities\Language;
use Session, Image, File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::with('translate')->get();

        return view('service::category',compact('categories'));
    }

    public function create()
    {
        return view('service::create_category');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|unique:category_translations',
            'slug'=>'required|unique:categories',
            'status'=>'required',
            'icon'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'icon.required' => trans('admin_validation.Icon is required'),
        ];
        $request->validate($rules,$customMessages);

        $category = new Category();

        if($request->icon){
            $extention = $request->icon->getClientOriginalExtension();
            $banner_name = 'service-cat'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/custom-images/'.$banner_name;
            $request->icon->move(public_path('uploads/custom-images/'),$banner_name);
            $category->icon = $banner_name;
        }

        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $languages = Language::all();
        foreach($languages as $language){
            $category_translation = new CategoryTranslation();
            $category_translation->lang_code = $language->lang_code;
            $category_translation->category_id = $category->id;
            $category_translation->name = $request->name;
            $category_translation->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.service-category.edit', ['service_category' => $category->id, 'lang_code' => admin_lang()])->with($notification);
    }

    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $cat_translate = CategoryTranslation::where(['category_id' => $id, 'lang_code' => $request->lang_code])->first();

        return view('service::edit_category',compact('category','cat_translate'));
    }


    public function update(Request $request,$id)
    {
        $category = Category::findOrFail($id);

        if($request->lang_code == admin_lang()){
            $rules = [
                'name'=>'required',
                'slug'=> 'required|unique:categories,slug,'.$category->id,
                'status'=>'required',
            ];
            $customMessages = [
                'name.required' => trans('admin_validation.Name is required'),
                'name.unique' => trans('admin_validation.Name already exist'),
                'slug.required' => trans('admin_validation.Slug is required'),
                'slug.unique' => trans('admin_validation.Slug already exist'),
            ];
            $request->validate($rules,$customMessages);

            $category = Category::find($id);
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            if($request->icon){
                $exist_banner = $category->icon;
                $extention = $request->icon->getClientOriginalExtension();
                $banner_name = 'service-cat'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
                $banner_name = 'uploads/custom-images/'.$banner_name;
                $request->icon->move(public_path('uploads/custom-images/'),$banner_name);
                $category->icon = $banner_name;
                $category->save();

                if($exist_banner){
                    if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
                }
            }

            $category_translation = CategoryTranslation::findOrFail($request->translate_id);
            $category_translation->name = $request->name;
            $category_translation->save();

        }else{
            $rules = [
                'name'=>'required',
            ];
            $customMessages = [
                'name.required' => trans('admin_validation.Name is required'),
            ];
            $request->validate($rules,$customMessages);

            $category_translation = CategoryTranslation::findOrFail($request->translate_id);
            $category_translation->name = $request->name;
            $category_translation->save();
        }

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $service_count = Service::where('category_id', $id)->count();
        if($service_count > 0){
            $notification= trans('admin_validation.You can not delete this category, multiple service available under this category');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $category = Category::find($id);
        $exist_banner = $category->icon;
        if($exist_banner){
            if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
        }
        $category->delete();

        CategoryTranslation::where('category_id', $id)->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.service-category.index')->with($notification);
    }

    public function assign_language($lang_code){
        $cat_translates = CategoryTranslation::where('lang_code', admin_lang())->get();
        foreach($cat_translates as $cat_translate){
            $blog_cat_translate = new CategoryTranslation();
            $blog_cat_translate->lang_code = $lang_code;
            $blog_cat_translate->category_id = $cat_translate->category_id;
            $blog_cat_translate->name = $cat_translate->name;
            $blog_cat_translate->save();
        }
    }
}
