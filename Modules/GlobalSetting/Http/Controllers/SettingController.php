<?php

namespace Modules\GlobalSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\CookieConsent;
use App\Models\GoogleRecaptcha;
use App\Models\TawkChat;
use App\Models\GoogleAnalytic;
use App\Models\FacebookPixel;
use App\Models\CustomPagination;
use App\Models\SocialLoginInfo;
use Image, Str, File, Artisan;
use App\Models\AppointmentSchedule;
use App\Models\CompleteRequest;
use App\Models\ContactMessage;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\InfluencerWithdraw;
use App\Models\MessageDocument;
use App\Models\Order;
use App\Models\RefundRequest;
use App\Models\Review;
use App\Models\Subscriber;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\SeoSetting;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\WithdrawMethod;
use App\Models\WorkingProccess;
use App\Models\Admin;
use Modules\Service\Entities\AdditionalService;
use Modules\Service\Entities\AdditionalServiceTranslation;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\CategoryTranslation;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\ServiceTranslation;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\BlogTranslation;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\BlogCategoryTranslation;
use Modules\Blog\Entities\BlogComment;
use Modules\Page\Entities\CustomPage;
use Modules\Page\Entities\CustomPageTranslation;
use Modules\Page\Entities\Faq;
use Modules\Page\Entities\FaqTranslate;
use Modules\Page\Entities\HomePage;
use Modules\Page\Entities\AboutUs;
use Modules\Page\Entities\PrivacyPolicy;
use Modules\Page\Entities\TermAndCondition;
use Modules\Page\Entities\HomePageTranslation;
use Modules\Page\Entities\AboutUsTranslation;
use Modules\Language\Entities\Language;
use Modules\Section\Entities\OurFeature;
use Modules\Section\Entities\Partner;
use Modules\Section\Entities\SliderOne;
use Modules\Section\Entities\Testimonial;
use Modules\Section\Entities\TestimonialTranslation;
use Modules\Section\Entities\WhyChooseUs;
use Modules\Section\Entities\OurFeatureTranslation;
use Modules\Section\Entities\SliderOneTranslation;
use Modules\Section\Entities\WhyChooseUsTranslation;
use Modules\Section\Entities\WorkingProccessTranslation;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function general_setting()
    {
        $setting = Setting::first();
        $currencies = Currency::orderBy('name','asc')->get();

        return view('globalsetting::general_setting', compact('setting', 'currencies'));
    }

    public function update_general_setting(Request $request){

        $request->validate([
            'app_name' => 'required',
            'currency_icon' => 'required',
        ],[
            'app_name.required' => trans('admin_validation.App name is required'),
            'currency_icon.required' => trans('admin_validation.Currency icon is required'),
        ]);

        $setting = Setting::first();
        $setting->app_name = $request->app_name;
        $setting->selected_theme = $request->selected_theme;
        $setting->text_direction = $request->layout;
        $setting->currency_name = $request->currency_name;
        $setting->currency_icon = $request->currency_icon;
        $setting->currency_position = $request->currency_position;
        $setting->timezone = $request->timezone;
        $setting->show_provider_contact_info  = $request->show_provider_contact_info ;
        $setting->commission_type  = $request->commission_type ;
        $setting->live_chat  = $request->live_chat ;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function logo_favicon(){
        $setting = Setting::first();
        return view('globalsetting::logo_favicon', compact('setting'));
    }

    public function update_logo_favicon(Request $request){

        $setting = Setting::first();
        if($request->logo){
            $old_logo = $setting->logo;
            $image = $request->logo;
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name = 'uploads/website-images/'.$logo_name;
            $logo = Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->logo = $logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        if($request->footer_logo){
            $old_logo=$setting->footer_logo;
            $image=$request->footer_logo;
            $ext=$image->getClientOriginalExtension();
            $logo_name= 'logo-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name='uploads/website-images/'.$logo_name;
            $logo=Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->footer_logo=$logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        if($request->favicon){
            $old_favicon = $setting->favicon;
            $favicon = $request->favicon;
            $ext = $favicon->getClientOriginalExtension();
            $favicon_name = 'favicon-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $favicon_name = 'uploads/website-images/'.$favicon_name;
            Image::make($favicon)
                    ->save(public_path().'/'.$favicon_name);
            $setting->favicon = $favicon_name;
            $setting->save();
            if($old_favicon){
                if(File::exists(public_path().'/'.$old_favicon))unlink(public_path().'/'.$old_favicon);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function cookie_consent(){
        $cookie_consent = CookieConsent::first();
        return view('globalsetting::cookie_consent', compact('cookie_consent'));

    }

    public function update_cookie_consent(Request $request){

        $request->validate([
            'allow' => 'required',
            'border' => 'required',
            'corners' => 'required',
            'background_color' => 'required',
            'text_color' => 'required',
            'border_color' => 'required',
            'button_color' => 'required',
            'btn_text_color' => 'required',
            'link_text' => 'required',
            'btn_text' => 'required',
            'message' => 'required',
        ],[
            'allow.required' => trans('admin_validation.Allow is required'),
            'border.required' => trans('admin_validation.Border is required'),
            'corners.required' => trans('admin_validation.Corner is required'),
            'background_color.required' => trans('admin_validation.Background color is required'),
            'text_color.required' => trans('admin_validation.Text color is required'),
            'border_color.required' => trans('admin_validation.Border Color is required'),
            'button_color.required' => trans('admin_validation.Button color is required'),
            'btn_text_color.required' => trans('admin_validation.Button text color is required'),
            'link_text.required' => trans('admin_validation.Link text is required'),
            'btn_text.required' => trans('admin_validation.Button text is required'),
            'message.required' => trans('admin_validation.Message is required'),
        ]);

        $cookie_consent = CookieConsent::first();
        $cookie_consent->status = $request->allow;
        $cookie_consent->border = $request->border;
        $cookie_consent->corners = $request->corners;
        $cookie_consent->background_color = $request->background_color;
        $cookie_consent->text_color = $request->text_color;
        $cookie_consent->border_color = $request->border_color;
        $cookie_consent->btn_bg_color = $request->button_color;
        $cookie_consent->btn_text_color = $request->btn_text_color;
        $cookie_consent->link_text = $request->link_text;
        $cookie_consent->btn_text = $request->btn_text;
        $cookie_consent->message = $request->message;
        $cookie_consent->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function google_captcha(){
        $google_recaptcha = GoogleRecaptcha::first();
        return view('globalsetting::google_captcha', compact('google_recaptcha'));
    }

    public function update_google_captcha(Request $request){

        $request->validate([
            'site_key' => $request->allow == 1 ?  'required' : '',
            'secret_key' => $request->allow == 1 ?  'required' : '',
            'allow' => 'required',
        ],[
            'site_key.required' => trans('admin_validation.Site key is required'),
            'secret_key.required' => trans('admin_validation.Secret key is required'),
            'allow.required' => trans('admin_validation.Allow is required'),
        ]);

        $google_recaptcha = GoogleRecaptcha::first();
        $google_recaptcha->status = $request->allow;
        $google_recaptcha->site_key = $request->site_key;
        $google_recaptcha->secret_key = $request->secret_key;
        $google_recaptcha->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function tawk_chat(){
        $tawk_chat = TawkChat::first();
        return view('globalsetting::tawk_chat', compact('tawk_chat'));
    }

    public function update_tawk_chat(Request $request){

        $request->validate([
            'allow' => 'required',
            'chat_link' => $request->allow == 1 ?  'required' : ''
        ],[
            'allow.required' => trans('admin_validation.Allow is required'),
            'chat_link.required' => trans('admin_validation.Chat link is required'),
        ]);

        $tawk_chat = TawkChat::first();
        $tawk_chat->status = $request->allow;
        $tawk_chat->chat_link = $request->chat_link;
        $tawk_chat->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function google_analytic(){

        $google_analytic = GoogleAnalytic::first();

        return view('globalsetting::google_analytic', compact('google_analytic'));
    }

    public function update_google_analytic(Request $request){

        $request->validate([
            'allow' => 'required',
            'analytic_id' => $request->allow == 1 ?  'required' : ''
        ],[
            'allow.required' => trans('admin_validation.Allow is required'),
            'analytic_id.required' => trans('admin_validation.Analytic id is required'),
        ]);

        $google_analytic = GoogleAnalytic::first();
        $google_analytic->status = $request->allow;
        $google_analytic->analytic_id = $request->analytic_id;
        $google_analytic->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function facebook_pixel(){

        $facebook_pixel = FacebookPixel::first();

        return view('globalsetting::facebook_pixel', compact('facebook_pixel'));
    }

    public function update_facebook_pixel(Request $request){

        $request->validate([
            'app_id' => $request->allow_facebook_pixel ?  'required' : '',
        ],[
            'app_id.required' => trans('admin_validation.App id is required'),
        ]);

        $facebook_pixel = FacebookPixel::first();
        $facebook_pixel->app_id = $request->app_id;
        $facebook_pixel->status = $request->allow_facebook_pixel ? 1 : 0;
        $facebook_pixel->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function custom_pagination(){

        $custom_paginations = CustomPagination::all();

        return view('globalsetting::custom_pagination', compact('custom_paginations'));
    }

    public function update_custom_pagination(Request $request){

        foreach($request->quantities as $index => $quantity){
            if($request->quantities[$index] == ''){
                $notification=array(
                    'messege'=> trans('admin_validation.Every field is required'),
                    'alert-type'=>'error'
                );

                return redirect()->back()->with($notification);
            }

            $custom_pagination = CustomPagination::find($request->ids[$index]);
            $custom_pagination->qty = $request->quantities[$index];
            $custom_pagination->save();
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function database_generate(){

        return view('globalsetting::database_generate');

    }

    public function update_database(){
        Artisan::call('migrate');
        Artisan::call('optimize:clear');

        $setting = Setting::first();
        $setting->app_version = 'Version : 1.1';
        $setting->save();

        $notification = trans('admin_validation.Database updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function error_image(){
        $setting = Setting::first();
        return view('globalsetting::error_image', compact('setting'));
    }

    public function update_error_image(Request $request){

        $setting = Setting::first();
        if($request->error_image){
            $old_logo = $setting->error_image;
            $image = $request->error_image;
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'error-image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name = 'uploads/website-images/'.$logo_name;
            $logo = Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->error_image = $logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function login_image(){
        $setting = Setting::first();
        return view('globalsetting::login_image', compact('setting'));
    }

    public function update_login_image(Request $request){

        $setting = Setting::first();
        if($request->login_page_bg){
            $old_logo = $setting->login_page_bg;
            $image = $request->login_page_bg;
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'login-image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name = 'uploads/website-images/'.$logo_name;
            $logo = Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->login_page_bg = $logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function social_login(){
        $login_info = SocialLoginInfo::first();

        return view('globalsetting::social_login', ['login_info' => $login_info]);
    }

    public function update_social_login(Request $request){

        $rules = [
            'facebook_app_id' => $request->allow_facebook_login ?  'required' : '',
            'facebook_app_secret' => $request->allow_facebook_login ?  'required' : '',
            'gmail_client_id' => $request->allow_gmail_login ?  'required' : '',
            'gmail_secret_id' => $request->allow_gmail_login ?  'required' : '',
            'gmail_redirect_url' => $request->allow_gmail_login ?  'required' : '',
            'facebook_redirect_url' => $request->allow_gmail_login ?  'required' : '',
        ];
        $customMessages = [
            'facebook_app_id.required' => trans('admin_validation.Facebook app id is required'),
            'facebook_app_secret.required' => trans('admin_validation.Facebook app secret is required'),
            'gmail_client_id.required' => trans('admin_validation.Gmail client id is required'),
            'gmail_secret_id.required' => trans('admin_validation.Gmail secret id is required'),
            'gmail_redirect_url.required' => trans('admin_validation.Gmail redirect url is required'),
            'facebook_redirect_url.required' => trans('admin_validation.Facebook redirect url is required'),
        ];
        $request->validate($rules,$customMessages);

        $login_info = SocialLoginInfo::first();

        $login_info->is_facebook = $request->allow_facebook_login ? 1 : 0;
        $login_info->facebook_client_id = $request->facebook_app_id;
        $login_info->facebook_secret_id = $request->facebook_app_secret;
        $login_info->facebook_redirect_url = $request->facebook_redirect_url;
        $login_info->is_gmail = $request->allow_gmail_login ? 1 : 0;
        $login_info->gmail_client_id = $request->gmail_client_id;
        $login_info->gmail_secret_id = $request->gmail_secret_id;
        $login_info->gmail_redirect_url = $request->gmail_redirect_url;
        $login_info->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function header_footer(){

        $setting = Setting::first();

        return view('globalsetting::header_footer', compact('setting'));
    }

    public function update_header_footer(Request $request){

        $setting = Setting::first();

        $request->validate([
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'open_day' => 'required',
            'closed_day' => 'required',
            'about_us' => 'required',
            'copyright' => 'required',
        ],[
            'email.required' => trans('admin_validation.Email is required'),
            'phone.required' => trans('admin_validation.Phone is required'),
            'address.required' => trans('admin_validation.Address is required'),
            'open_day.required' => trans('admin_validation.Opening day is required'),
            'closed_day.required' => trans('admin_validation.Closed day is required'),
            'about_us.required' => trans('admin_validation.Closed day is required'),
            'copyright.required' => trans('admin_validation.Copyright required'),
        ]);

        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->open_day = $request->open_day;
        $setting->closed_day = $request->closed_day;
        $setting->about_us = $request->about_us;
        $setting->copyright = $request->copyright;
        $setting->twitter = $request->twitter;
        $setting->behance = $request->behance;
        $setting->instagram = $request->instagram;
        $setting->linkedin = $request->linkedin;
        $setting->facebook = $request->facebook;
        $setting->save();

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function default_avatar(){
        $setting = Setting::first();

        return view('globalsetting::default_avatar', compact('setting'));
    }

    public function update_default_avatar(Request $request){
        $setting = Setting::first();

        if($request->default_avatar){
            $old_logo = $setting->default_avatar;
            $image = $request->default_avatar;
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'default-avatar-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name = 'uploads/website-images/'.$logo_name;
            $logo = Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->default_avatar = $logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function breadcrumb(){
        $setting = Setting::first();

        return view('globalsetting::breadcrumb', compact('setting'));
    }


    public function update_breadcrumb(Request $request){
        $setting = Setting::first();

        if($request->breadcrumb_image){
            $old_logo = $setting->breadcrumb_image;
            $image = $request->breadcrumb_image;
            $ext = $image->getClientOriginalExtension();
            $logo_name = 'breadcrumb-image-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$ext;
            $logo_name = 'uploads/website-images/'.$logo_name;
            $logo = Image::make($image)
                    ->save(public_path().'/'.$logo_name);
            $setting->breadcrumb_image = $logo_name;
            $setting->save();
            if($old_logo){
                if(File::exists(public_path().'/'.$old_logo))unlink(public_path().'/'.$old_logo);
            }
        }

        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function cache_clear(){

        Artisan::call('optimize:clear');

        $notification = trans('admin_validation.Cache cleared successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function database_clear(){
        return view('globalsetting::database_clear');
    }

    public function database_clear_success(){

        AdditionalService::truncate();
        AdditionalServiceTranslation::truncate();
        AppointmentSchedule::truncate();
        Blog::truncate();
        BlogTranslation::truncate();
        BlogCategory::truncate();
        BlogCategoryTranslation::truncate();
        BlogComment::truncate();
        Category::truncate();
        CategoryTranslation::truncate();
        CompleteRequest::truncate();
        ContactMessage::truncate();
        Coupon::truncate();
        CouponHistory::truncate();
        CustomPage::truncate();
        CustomPageTranslation::truncate();
        Faq::truncate();
        FaqTranslate::truncate();
        InfluencerWithdraw::truncate();
        MessageDocument::truncate();
        Order::truncate();
        Partner::truncate();
        RefundRequest::truncate();
        Review::truncate();
        Service::truncate();
        ServiceTranslation::truncate();
        Subscriber::truncate();
        Testimonial::truncate();
        TestimonialTranslation::truncate();
        Ticket::truncate();
        TicketMessage::truncate();
        User::truncate();
        Wishlist::truncate();
        WithdrawMethod::truncate();

        $languages = Language::where('id', '!=', 1)->get();

        foreach($languages as $language){
            OurFeatureTranslation::where('lang_code', $language->lang_code)->delete();
            HomePageTranslation::where('lang_code', $language->lang_code)->delete();
            AboutUsTranslation::where('lang_code', $language->lang_code)->delete();
            PrivacyPolicy::where('lang_code', $language->lang_code)->delete();
            SliderOneTranslation::where('lang_code', $language->lang_code)->delete();
            TermAndCondition::where('lang_code', $language->lang_code)->delete();
            WhyChooseUsTranslation::where('lang_code', $language->lang_code)->delete();
            WorkingProccessTranslation::where('lang_code', $language->lang_code)->delete();

            $path = base_path().'/lang'.'/'.$language->lang_code;

            if (File::exists($path)) {
                File::deleteDirectory($path);
            }

            $language->delete();
        }

        Language::where('id', 1)->update(['is_default' => 'yes']);


        $admins = Admin::where('id', '!=', 1)->get();
        foreach($admins as $admin){
            $admin_image = $admin->image;
            $admin->delete();
            if($admin_image){
                if(File::exists(public_path().'/'.$admin_image))unlink(public_path().'/'.$admin_image);
            }
        }

        $folderPath = public_path('uploads/custom-images');
        $response = File::deleteDirectory($folderPath);

        $path = public_path('uploads/custom-images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $notification = trans('admin_validation.Database Cleared Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function seo_setting(){

        $pages = SeoSetting::all();

        return view('globalsetting::seo_setting', compact('pages'));
    }

    public function update_seo_setting(Request $request, $id){
        $rules = [
            'seo_title' => 'required',
            'seo_description' => 'required'
        ];
        $customMessages = [
            'seo_title.required' => trans('admin_validation.SEO title is required'),
            'seo_description.required' => trans('admin_validation.SEO description is required'),
        ];
        $request->validate($rules,$customMessages);

        $page = SeoSetting::find($id);
        $page->seo_title = $request->seo_title;
        $page->seo_description = $request->seo_description;
        $page->save();

        $notification = trans('admin_validation.admin_validation.Update Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

}
