<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Modules\Language\Entities\Language;
use Session, Config, Route;
use App\Models\MultiCurrency;

class ApiLangSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request_lang = Language::where('lang_code', $request->lang_code)->first();

        Session::put('front_lang', $request->lang_code);
        Session::put('lang_dir', $request_lang->lang_direction);

        app()->setLocale($request->lang_code);

        if(!Session::get('front_lang')){
            $default_lang = Language::where('id', 1)->first();
            Session::put('front_lang', $default_lang->lang_code);
            Session::put('lang_dir', $default_lang->lang_direction);

            app()->setLocale($default_lang->lang_code);
        }else{
            $is_exist = Language::where('lang_code', Session::get('front_lang'))->first();
            if(!$is_exist){
                Session::put('front_lang', 'en');
                Session::put('lang_dir', 'left_to_right');
            }

            app()->setLocale(Session::get('front_lang'));
        }


        if(!Route::is('migrate')){
            if(!Session::get('currency_code')){
                $default_currency = MultiCurrency::where('is_default', 'yes')->first();

                Session::put('currency_icon', $default_currency->currency_icon);
                Session::put('currency_code', $default_currency->currency_code);
                Session::put('currency_rate', $default_currency->currency_rate);
                Session::put('currency_position', $default_currency->currency_position);
            }
        }

        return $next($request);
    }
}
