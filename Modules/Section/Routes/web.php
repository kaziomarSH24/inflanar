<?php

use Modules\Section\Http\Controllers\OurFeatureController;
use Modules\Section\Http\Controllers\SliderController;
use Modules\Section\Http\Controllers\WhyChooseUsController;
use Modules\Section\Http\Controllers\WorkingProcessController;


Route::group(['middleware' => ['XSS','DEMO']], function () {
    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::controller(OurFeatureController::class)->group(function () {
            Route::get('our-feature', 'index')->name('our-feature');
            Route::put('update-our-feature', 'update')->name('update-our-feature');
        });

        Route::resources([
            'testimonial' => TestimonialController::class,
            'partner' => PartnerController::class,
        ]);

        Route::controller(SliderController::class)->group(function () {
            Route::get('slider', 'index')->name('slider');
            Route::put('home1-slider', 'home1_slider')->name('home1-slider');
            Route::put('home2-slider', 'home2_slider')->name('home2-slider');
            Route::put('home3-slider', 'home3_slider')->name('home3-slider');
        });

        Route::controller(WorkingProcessController::class)->group(function () {
            Route::get('working-proccess', 'index')->name('working-proccess');
            Route::put('home1-working-proccess', 'home1_why_choose_us')->name('home1-working-proccess');
            Route::put('home3-working-proccess', 'home3_why_choose_us')->name('home3-working-proccess');
        });

        Route::controller(WhyChooseUsController::class)->group(function () {
            Route::get('why-choose-us', 'index')->name('why-choose-us');
            Route::put('home2-why-choose-us', 'home2_why_choose_us')->name('home2-why-choose-us');
            Route::put('home3-why-choose-us', 'home3_why_choose_us')->name('home3-why-choose-us');
        });
    });
});
