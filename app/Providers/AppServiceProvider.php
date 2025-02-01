<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Modules\Language\Entities\Language;
use Modules\Page\Entities\HomePage;
use Modules\Page\Entities\CustomPage;
use App\Models\GoogleRecaptcha;
use App\Models\GoogleAnalytic;
use App\Models\FacebookPixel;
use App\Models\TawkChat;
use App\Models\CookieConsent;
use App\Models\MultiCurrency;
use View;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Session::put('admin_lang', 'en');

        View::composer('*', function($view){
            $setting = Setting::first();
            $language_list = Language::where('status', 1)->get();
            $home_page = HomePage::first();
            $google_recaptcha = GoogleRecaptcha::first();
            $custom_pages = CustomPage::where('status', 1)->get();
            $google_analytic = GoogleAnalytic::first();
            $facebook_pixel = FacebookPixel::first();
            $tawk_chat = TawkChat::first();
            $cookie_consent = CookieConsent::first();
            $currency_list = MultiCurrency::where('status', 'active')->get();

            $view->with('currency_icon', $setting->currency_icon);
            $view->with('breadcrumb', $setting->breadcrumb_image);
            $view->with('setting', $setting);
            $view->with('language_list', $language_list);
            $view->with('home_page', $home_page);
            $view->with('google_recaptcha', $google_recaptcha);
            $view->with('custom_pages', $custom_pages);
            $view->with('google_analytic', $google_analytic);
            $view->with('facebook_pixel', $facebook_pixel);
            $view->with('tawk_chat', $tawk_chat);
            $view->with('cookie_consent', $cookie_consent);
            $view->with('currency_list', $currency_list);
        });
    }
}
