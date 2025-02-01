<?php

use Modules\Blog\Http\Controllers\BlogCategoryController;
use Modules\Blog\Http\Controllers\BlogController;

Route::group(['middleware' => ['XSS','DEMO']], function () {
    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::resources([
            'blog-category' => BlogCategoryController::class,
            'blog' => BlogController::class,
        ]);

        Route::controller(BlogController::class)->group(function () {
            Route::put('blog-status/{id}', 'blog_status')->name('blog-status');
            Route::get('show-comment/{id}', 'show_comment')->name('show-comment');
            Route::get('blog-comment', 'blog_comment')->name('blog-comment');
            Route::delete('delete-blog-comment/{id}', 'destroy_comment')->name('delete-blog-comment');
            Route::put('blog-comment-status/{id}', 'blog_comment_status')->name('blog-comment-status');
        });

    });
});
