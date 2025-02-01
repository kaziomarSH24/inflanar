<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\HomePage;
use Modules\Page\Entities\HomePageTranslation;
use Image, File, Str;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $home_page = HomePage::first();
        $translate = HomePageTranslation::where(['home_page_id' => $home_page->id, 'lang_code' => $request->lang_code])->first();

        return view('page::home_page', compact('home_page','translate'));
    }

    public function update(Request $request)
    {

        $translate = HomePageTranslation::where(['id' => $request->translate_id])->first();

        $translate->category_title = $request->category_title;
        $translate->category_header = $request->category_header;
        $translate->feature_title = $request->feature_title;
        $translate->feature_header = $request->feature_header;
        $translate->influencer_title = $request->influencer_title;
        $translate->influencer_header = $request->influencer_header;
        $translate->service_title = $request->service_title;
        $translate->service_header = $request->service_header;
        $translate->working_title = $request->working_title;
        $translate->working_header = $request->working_header;
        $translate->video_title = $request->video_title;
        $translate->video_description = $request->video_description;
        $translate->partner_title = $request->partner_title;
        $translate->partner_description = $request->partner_description;
        $translate->faq_title = $request->faq_title;
        $translate->faq_header = $request->faq_header;
        $translate->faq_description = $request->faq_description;
        $translate->testimonial_title = $request->testimonial_title;
        $translate->testimonial_header = $request->testimonial_header;
        $translate->blog_title = $request->blog_title;
        $translate->blog_header = $request->blog_header;
        $translate->provider_joining_title = $request->provider_joining_title;
        $translate->save();

        if(admin_lang() == $request->lang_code){
            $home_page = HomePage::first();
            $home_page->video_id = $request->video_id;
            $home_page->facebook_follower = $request->facebook_follower;
            $home_page->twitter_follower = $request->twitter_follower;
            $home_page->tiktok_follower = $request->tiktok_follower;
            $home_page->instagram_follower = $request->instagram_follower;
            $home_page->save();
        }


        if($request->video_image){
            $old_image = $home_page->video_image;
            $image_name = 'video-image'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->video_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $home_page->video_image = $image_name;
            $home_page->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->faq_image){
            $old_image = $home_page->faq_image;
            $image_name = 'faq-image'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->faq_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $home_page->faq_image = $image_name;
            $home_page->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->provider_joining_image){
            $old_image = $home_page->provider_joining_image;
            $image_name = 'provider-joining-image'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_name ='uploads/website-images/'.$image_name;
            Image::make($request->provider_joining_image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_name);
            $home_page->provider_joining_image = $image_name;
            $home_page->save();

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        if($request->facebook_image){
            $exist_banner = $home_page->facebook_image;
            $extention = $request->facebook_image->getClientOriginalExtension();
            $banner_name = 'facebook-icon'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->facebook_image->move(public_path('uploads/website-images/'),$banner_name);
            $home_page->facebook_image = $banner_name;
            $home_page->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->twitter_image){
            $exist_banner = $home_page->twitter_image;
            $extention = $request->twitter_image->getClientOriginalExtension();
            $banner_name = 'twitter-icon'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->twitter_image->move(public_path('uploads/website-images/'),$banner_name);
            $home_page->twitter_image = $banner_name;
            $home_page->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->tiktok_image){
            $exist_banner = $home_page->tiktok_image;
            $extention = $request->tiktok_image->getClientOriginalExtension();
            $banner_name = 'twitter-icon'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->tiktok_image->move(public_path('uploads/website-images/'),$banner_name);
            $home_page->tiktok_image = $banner_name;
            $home_page->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        if($request->instagram_image){
            $exist_banner = $home_page->instagram_image;
            $extention = $request->instagram_image->getClientOriginalExtension();
            $banner_name = 'twitter-icon'.date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $banner_name = 'uploads/website-images/'.$banner_name;
            $request->instagram_image->move(public_path('uploads/website-images/'),$banner_name);
            $home_page->instagram_image = $banner_name;
            $home_page->save();

            if($exist_banner){
                if(File::exists(public_path().'/'.$exist_banner))unlink(public_path().'/'.$exist_banner);
            }
        }

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function assign_language($lang_code){

        $home_translate = HomePageTranslation::where(['lang_code' => admin_lang()])->first();

        $translate = new HomePageTranslation();
        $translate->home_page_id = $home_translate->home_page_id;
        $translate->lang_code = $lang_code;
        $translate->category_title = $home_translate->category_title;
        $translate->category_header = $home_translate->category_header;
        $translate->feature_title = $home_translate->feature_title;
        $translate->feature_header = $home_translate->feature_header;
        $translate->influencer_title = $home_translate->influencer_title;
        $translate->influencer_header = $home_translate->influencer_header;
        $translate->service_title = $home_translate->service_title;
        $translate->service_header = $home_translate->service_header;
        $translate->working_title = $home_translate->working_title;
        $translate->working_header = $home_translate->working_header;
        $translate->video_title = $home_translate->video_title;
        $translate->video_description = $home_translate->video_description;
        $translate->partner_title = $home_translate->partner_title;
        $translate->partner_description = $home_translate->partner_description;
        $translate->faq_title = $home_translate->faq_title;
        $translate->faq_header = $home_translate->faq_header;
        $translate->faq_description = $home_translate->faq_description;
        $translate->testimonial_title = $home_translate->testimonial_title;
        $translate->testimonial_header = $home_translate->testimonial_header;
        $translate->blog_title = $home_translate->blog_title;
        $translate->blog_header = $home_translate->blog_header;
        $translate->provider_joining_title = $home_translate->provider_joining_title;
        $translate->save();

    }


}
