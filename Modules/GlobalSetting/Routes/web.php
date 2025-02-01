<?php

use Modules\GlobalSetting\Http\Controllers\SettingController;
use Modules\GlobalSetting\Http\Controllers\EmailSettingController;
use Modules\GlobalSetting\Http\Controllers\ContactMessageController;
use Modules\GlobalSetting\Http\Controllers\SubscriberController;
use Modules\GlobalSetting\Http\Controllers\PaymentMethodController;

Route::group(['middleware' => ['XSS','DEMO']], function () {

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::controller(SettingController::class)->group(function () {

            Route::get('general-setting', 'general_setting')->name('general-setting');
            Route::put('update-general-setting', 'update_general_setting')->name('update-general-setting');

            Route::get('logo-favicon', 'logo_favicon')->name('logo-favicon');
            Route::put('update-logo-favicon', 'update_logo_favicon')->name('update-logo-favicon');

            Route::get('cookie-consent', 'cookie_consent')->name('cookie-consent');
            Route::put('update-cookie-consent', 'update_cookie_consent')->name('update-cookie-consent');

            Route::get('google-captcha', 'google_captcha')->name('google-captcha');
            Route::put('update-google-captcha', 'update_google_captcha')->name('update-google-captcha');

            Route::get('tawk-chat', 'tawk_chat')->name('tawk-chat');
            Route::put('update-tawk-chat', 'update_tawk_chat')->name('update-tawk-chat');

            Route::get('google-analytic', 'google_analytic')->name('google-analytic');
            Route::put('update-google-analytic', 'update_google_analytic')->name('update-google-analytic');

            Route::get('facebook-pixel', 'facebook_pixel')->name('facebook-pixel');
            Route::put('update-facebook-pixel', 'update_facebook_pixel')->name('update-facebook-pixel');

            Route::get('custom-pagination', 'custom_pagination')->name('custom-pagination');
            Route::put('update-custom-pagination', 'update_custom_pagination')->name('update-custom-pagination');

            Route::get('error-image', 'error_image')->name('error-image');
            Route::put('update-error-image', 'update_error_image')->name('update-error-image');

            Route::get('login-image', 'login_image')->name('login-image');
            Route::put('update-login-image', 'update_login_image')->name('update-login-image');

            Route::get('database-generate', 'database_generate')->name('database-generate');
            Route::put('update-database-generate', 'update_database')->name('update-database-generate');

            Route::get('social-login', 'social_login')->name('social-login');
            Route::put('update-social-login', 'update_social_login')->name('update-social-login');

            Route::get('header-footer', 'header_footer')->name('header-footer');
            Route::put('update-header-footer', 'update_header_footer')->name('update-header-footer');

            Route::get('default-avatar', 'default_avatar')->name('default-avatar');
            Route::put('update-default-avatar', 'update_default_avatar')->name('update-default-avatar');

            Route::get('breadcrumb', 'breadcrumb')->name('breadcrumb');
            Route::put('update-breadcrumb', 'update_breadcrumb')->name('update-breadcrumb');

            Route::get('cache-clear', 'cache_clear')->name('cache-clear');

            Route::get('database-clear', 'database_clear')->name('database-clear');
            Route::delete('database-clear-success', 'database_clear_success')->name('database-clear-success');

            Route::get('seo-setting', 'seo_setting')->name('seo-setting');
            Route::put('update-seo-setting/{id}', 'update_seo_setting')->name('update-seo-setting');

        });

        Route::controller(EmailSettingController::class)->group(function () {

            Route::get('email-configuration', 'email_config')->name('email-configuration');
            Route::put('update-email-configuration', 'update_email_config')->name('update-email-configuration');

            Route::get('email-template', 'email_template')->name('email-template');
            Route::get('edit-email-template/{id}', 'edit_email_template')->name('edit-email-template');
            Route::put('update-email-template/{id}', 'update_email_template')->name('update-email-template');

        });

        Route::controller(ContactMessageController::class)->group(function () {
            Route::get('contact-message', 'contact_message')->name('contact-message');
            Route::get('show-message/{id}', 'show_message')->name('show-message');
            Route::delete('delete-contact-message/{id}', 'delete_message')->name('delete-contact-message');
            Route::put('contact-message-setting', 'contact_message_setting')->name('contact-message-setting');
        });

        Route::controller(SubscriberController::class)->group(function () {
            Route::get('subscriber-list', 'subscriber_list')->name('subscriber-list');
            Route::post('send-subscriber-email', 'send_subscriber_email')->name('send-subscriber-email');
            Route::delete('delete-subscriber/{id}', 'delete_subscriber')->name('delete-subscriber');

        });

        Route::controller(PaymentMethodController::class)->group(function () {
            Route::get('payment-method', 'index')->name('payment-method');
            Route::put('update-paypal', 'updatePaypal')->name('update-paypal');
            Route::put('update-stripe', 'updateStripe')->name('update-stripe');
            Route::put('update-razorpay', 'updateRazorpay')->name('update-razorpay');
            Route::put('update-bank', 'updateBank')->name('update-bank');
            Route::put('update-mollie', 'updateMollie')->name('update-mollie');
            Route::put('update-paystack', 'updatePayStack')->name('update-paystack');
            Route::put('update-flutterwave', 'updateflutterwave')->name('update-flutterwave');
            Route::put('update-instamojo', 'updateInstamojo')->name('update-instamojo');
            Route::put('update-paymongo', 'updatePaymongo')->name('update-paymongo');
            Route::put('update-cash-on-delivery', 'updateCashOnDelivery')->name('update-cash-on-delivery');
        });

    });
});



