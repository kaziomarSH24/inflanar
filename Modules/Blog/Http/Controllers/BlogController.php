<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\BlogTranslation;
use Modules\Blog\Entities\BlogCategoryTranslation;
use Modules\Blog\Entities\BlogComment;
use Modules\Language\Entities\Language;
use Session, Auth, Image, File, Str;


class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs = Blog::with('translate','category')->orderBy('id','desc')->get();
        return view('blog::blog_list',compact('blogs'));
    }


    public function create()
    {
        $categories = BlogCategory::with('translate')->get();

        return view('blog::create_blog',compact('categories'));
    }


    public function store(Request $request)
    {
        $rules = [
            'title'=>'required|unique:blog_translations',
            'slug'=>'required|unique:blogs',
            'image'=>'required',
            'description'=>'required',
            'category'=>'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            'title.unique' => trans('admin_validation.Title already exist'),
            'slug.required' => trans('admin_validation.Slug is required'),
            'slug.unique' => trans('admin_validation.Slug already exist'),
            'image.required' => trans('admin_validation.Image is required'),
            'description.required' => trans('admin_validation.Description is required'),
            'category.required' => trans('admin_validation.Category is required'),
        ];
        $request->validate($rules,$customMessages);

        $admin = Auth::guard('admin')->user();

        $blog = new Blog();

        if($request->image){
            $image_name = 'blog-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/custom-images/'.$image_name;
            Image::make($request->image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $blog->image = $image_name;
        }

        $blog->admin_id = $admin->id;
        $blog->slug = $request->slug;
        $blog->blog_category_id = $request->category;
        $blog->show_homepage = $request->show_homepage ? 'yes' : 'no';
        $blog->is_popular = $request->is_popular ? 'yes' : 'no';
        $blog->status = $request->status ? 1 : 0;
        $blog->tags =  $request->tags;
        $blog->save();

        $languages = Language::all();
        foreach($languages as $language){
            $blog_translate = new BlogTranslation();
            $blog_translate->lang_code = $language->lang_code;
            $blog_translate->blog_id = $blog->id;
            $blog_translate->title = $request->title;
            $blog_translate->description = $request->description;
            $blog_translate->seo_title = $request->seo_title ? $request->seo_title : $request->title;
            $blog_translate->seo_description = $request->seo_description ? $request->seo_description : $request->title;
            $blog_translate->save();
        }

        $notification= trans('admin_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog.edit', ['blog' => $blog->id, 'lang_code' => admin_lang()])->with($notification);
    }

    public function edit(Request $request, $id)
    {
        $categories = BlogCategory::with('translate')->get();
        $blog = Blog::with('translate')->findOrFail($id);

        $blog_translate = BlogTranslation::where(['blog_id' => $id, 'lang_code' => $request->lang_code])->first();

        return view('blog::edit_blog',compact('categories','blog','blog_translate'));
    }


    public function update(Request $request,$id)
    {
        $blog = Blog::findOrFail($id);

        if($request->lang_code == admin_lang()){
            $rules = [
                'title'=>'required',
                'slug'=>'required|unique:blogs,slug,'.$blog->id,
                'description'=>'required',
                'category'=>'required',
            ];
            $customMessages = [
                'title.required' => trans('admin_validation.Title is required'),
                'title.unique' => trans('admin_validation.Title already exist'),
                'slug.required' => trans('admin_validation.Slug is required'),
                'slug.unique' => trans('admin_validation.Slug already exist'),
                'description.required' => trans('admin_validation.Description is required'),
                'category.required' => trans('admin_validation.Category is required'),
            ];
            $request->validate($rules,$customMessages);

            if($request->image){
                $old_image = $blog->image;
                $image_name = 'blog-'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                $image_name ='uploads/custom-images/'.$image_name;
                Image::make($request->image)
                    ->encode('webp', 80)
                    ->save(public_path().'/'.$image_name);
                $blog->image = $image_name;
                $blog->save();
                if($old_image){
                    if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
                }
            }

            $blog->slug = $request->slug;
            $blog->blog_category_id = $request->category;
            $blog->show_homepage = $request->show_homepage ? 'yes' : 'no';
            $blog->is_popular = $request->is_popular ? 'yes' : 'no';
            $blog->status = $request->status ? 1 : 0;
            $blog->tags =  $request->tags;
            $blog->save();
        }else{
            $rules = [
                'title'=>'required',
                'description'=>'required',
            ];
            $customMessages = [
                'title.required' => trans('admin_validation.Title is required'),
                'title.unique' => trans('admin_validation.Title already exist'),
                'description.required' => trans('admin_validation.Description is required'),
            ];
            $request->validate($rules,$customMessages);
        }

        $blog_translate = BlogTranslation::findOrFail($request->translate_id);
        $blog_translate->title = $request->title;
        $blog_translate->description = $request->description;
        $blog_translate->seo_title = $request->seo_title ? $request->seo_title : $request->title;
        $blog_translate->seo_description = $request->seo_description ? $request->seo_description : $request->title;
        $blog_translate->save();

        $notification= trans('admin_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $old_image = $blog->image;

        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        BlogComment::where('blog_id',$id)->delete();

        $blog->delete();

        $notification=  trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.blog.index')->with($notification);
    }

    public function blog_status($id){
        $blog = Blog::find($id);
        if($blog->status==1){
            $blog->status=0;
            $blog->save();
            $message= trans('admin_validation.Inactive Successfully');
        }else{
            $blog->status=1;
            $blog->save();
            $message= trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function blog_comment(){
        $blog_comments = BlogComment::orderBy('id','desc')->get();

        return view('blog::blog_comment',compact('blog_comments'));
    }

    public function show_comment($id){

        $blog_comment = BlogComment::findOrFail($id);

        return view('blog::show_blog_comment',compact('blog_comment'));
    }



    public function destroy_comment($id)
    {
        $blog_comment = BlogComment::findOrFail($id);
        $blog_comment->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function blog_comment_status($id){
        $blog_comment = BlogComment::find($id);
        if($blog_comment->status == 1){
            $blog_comment->status = 0;
            $blog_comment->save();
            $message = trans('admin_validation.Inactive Successfully');
        }else{
            $blog_comment->status = 1;
            $blog_comment->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }

    public function assign_language($lang_code){
        $blog_translates = BlogTranslation::where('lang_code', admin_lang())->get();

        foreach($blog_translates as $blog_translate){
            $new_blog = new BlogTranslation();
            $new_blog->lang_code = $lang_code;
            $new_blog->blog_id = $blog_translate->blog_id;
            $new_blog->title = $blog_translate->title;
            $new_blog->description = $blog_translate->description;
            $new_blog->seo_title = $blog_translate->seo_title;
            $new_blog->seo_description = $blog_translate->seo_description;
            $new_blog->save();
        }
    }

}
