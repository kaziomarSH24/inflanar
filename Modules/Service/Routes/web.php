<?php

use Modules\Service\Http\Controllers\CategoryController;
use Modules\Service\Http\Controllers\ServiceController;

Route::group(['middleware' => ['XSS','DEMO']], function () {

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::resources([
            'service-category' => CategoryController::class,
            'service' => ServiceController::class,
        ]);

        Route::controller(ServiceController::class)->group(function () {
            Route::get('additional-service/{id}', 'additional_service')->name('additional-service');
            Route::get('additional-create/{id}', 'additional_create')->name('additional-create');
            Route::post('additional-store/{id}', 'additional_store')->name('additional-store');
            Route::get('additional-edit/{id}', 'additional_edit')->name('additional-edit');
            Route::put('additional-update/{id}', 'additional_update')->name('additional-update');
            Route::delete('additional-delete/{id}', 'additional_delete')->name('additional-delete');

            Route::get('awaiting-for-approval-service', 'awaiting_for_approval_service')->name('awaiting-for-approval-service');
            Route::get('active-service', 'active_service')->name('active-service');
            Route::get('banned-service', 'banned_service')->name('banned-service');

            Route::get('review-list', 'review_list')->name('review-list');
            Route::get('show-review/{id}', 'show_review')->name('show-review');
            Route::delete('delete-service-review/{id}', 'delete_review')->name('delete-service-review');
            Route::put('update-review/{id}', 'update_review')->name('update-review');
        });
    });
});
