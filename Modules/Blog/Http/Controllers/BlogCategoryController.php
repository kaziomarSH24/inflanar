<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\BlogCategoryTranslation;
use Modules\Language\Entities\Language;
use Session;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = BlogCategory::with('translate')->get();

        return view('blog::blog_category',compact('categories'));
    }

    public function create()
    {
        return view('blog::create_blog_category');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|unique:blog_category_translations',
            'slug'=>'required|unique:blog_categories',
            'status'=>'required',
        ];
        $customMessages = [
            'name.required' => trans('admin_validation.Name is required'),
            'name.unique' => trans('admin_validation.Name already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
        ];
        $request->validate($rules,$customMessages);

        $category = new BlogCategory();
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $languages = Language::all();
        foreach($languages as $language){
            $category_translation = new BlogCategoryTranslation();
            $category_translation->lang_code = $language->lang_code;
            $category_translation->blog_category_id = $category->id;
            $category_translation->name = $request->name;
            $category_translation->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog-category.edit', ['blog_category' => $category->id, 'lang_code' => admin_lang()])->with($notification);
    }

    public function edit(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        $cat_translate = BlogCategoryTranslation::where(['blog_category_id' => $id, 'lang_code' => $request->lang_code])->first();

        return view('blog::edit_blog_category',compact('category','cat_translate'));
    }


    public function update(Request $request,$id)
    {
        $category = BlogCategory::findOrFail($id);

        if($request->lang_code == admin_lang()){
            $rules = [
                'name'=>'required',
                'slug'=> 'required|unique:blog_categories,slug,'.$category->id,
                'status'=>'required',
            ];
            $customMessages = [
                'name.required' => trans('admin_validation.Name is required'),
                'name.unique' => trans('admin_validation.Name already exist'),
                'slug.required' => trans('admin_validation.Slug is required'),
                'slug.unique' => trans('admin_validation.Slug already exist'),
            ];
            $request->validate($rules,$customMessages);

            $category = BlogCategory::find($id);
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $category_translation = BlogCategoryTranslation::findOrFail($request->translate_id);
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

            $category_translation = BlogCategoryTranslation::findOrFail($request->translate_id);
            $category_translation->name = $request->name;
            $category_translation->save();
        }

        $notification= trans('admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $blog_count = Blog::where('blog_category_id', $id)->count();
        if($blog_count > 0){
            $notification= trans('admin_validation.You can not delete this category, multiple blog available under this category');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('admin.blog-category.index')->with($notification);
        }

        $category = BlogCategory::find($id);
        $category->delete();

        BlogCategoryTranslation::where('blog_category_id', $id)->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function assign_language($lang_code){
        $cat_translates = BlogCategoryTranslation::where('lang_code', admin_lang())->get();
        foreach($cat_translates as $cat_translate){
            $blog_cat_translate = new BlogCategoryTranslation();
            $blog_cat_translate->lang_code = $lang_code;
            $blog_cat_translate->blog_category_id = $cat_translate->blog_category_id;
            $blog_cat_translate->name = $cat_translate->name;
            $blog_cat_translate->save();
        }
    }

}
