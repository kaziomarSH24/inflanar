<?php

use Modules\Language\Http\Controllers\LanguageController;

Route::group(['middleware' => ['XSS','DEMO']], function () {
    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
        Route::resource('language', LanguageController::class);
        Route::get('theme-language', [LanguageController::class, 'theme_language'])->name('theme-language');
        Route::post('update-theme-language', [LanguageController::class, 'update_theme_language'])->name('update-theme-language');

        Route::get('validation-language', [LanguageController::class, 'validation_language'])->name('validation-language');
        Route::post('update-validation-language', [LanguageController::class, 'update_validation_language'])->name('update-validation-language');

    });
});

