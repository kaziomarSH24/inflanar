<?php

use Modules\Page\Http\Controllers\AboutUsController;
use Modules\Page\Http\Controllers\ContactUsController;
use Modules\Page\Http\Controllers\CustomPageController;
use Modules\Page\Http\Controllers\TermsConditionController;
use Modules\Page\Http\Controllers\PrivacyPolicyController;
use Modules\Page\Http\Controllers\FaqController;
use Modules\Page\Http\Controllers\HomePageController;

Route::group(['middleware' => ['XSS','DEMO']], function () {

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::controller(AboutUsController::class)->group(function () {
            Route::get('about-us', 'index')->name('about-us');
            Route::put('update-about-us', 'update')->name('update-about-us');
        });

        Route::controller(ContactUsController::class)->group(function () {
            Route::get('contact-us', 'index')->name('contact-us');
            Route::put('update-contact-us', 'update')->name('update-contact-us');
        });

        Route::resources([
            'custom-page' => CustomPageController::class,
            'faq' => FaqController::class,
        ]);

        Route::controller(TermsConditionController::class)->group(function () {
            Route::get('terms-and-conditions', 'index')->name('terms-and-conditions');
            Route::put('update-terms-and-conditions', 'update')->name('update-terms-and-conditions');
        });

        Route::controller(PrivacyPolicyController::class)->group(function () {
            Route::get('privacy-policy', 'index')->name('privacy-policy');
            Route::put('update-privacy-policy', 'update')->name('update-privacy-policy');
        });

        Route::controller(HomePageController::class)->group(function () {
            Route::get('home-page', 'index')->name('home-page');
            Route::put('home-page-update', 'update')->name('home-page-update');
        });

    });
});
