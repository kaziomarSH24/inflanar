<?php

use Illuminate\Support\Facades\Route;

/*  Start Admin panel Controller  */

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\WithdrawController as AdminWithdrawController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\MessageController as UserMessageController;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;

/*  End Admin panel Controller  */

/*Start influencer panel controller*/

use App\Http\Controllers\Influencer\ProfileController as InfluencerProfileController;
use App\Http\Controllers\Influencer\TicketController as InfluencerTicketController;
use App\Http\Controllers\Influencer\AppointmentScheduleController;
use App\Http\Controllers\Influencer\CouponController;
use App\Http\Controllers\Influencer\WithdrawController;
use App\Http\Controllers\Influencer\ServiceController as InfluencerServiceController;
use App\Http\Controllers\Influencer\OrderController as InfluencerOrderController;
use App\Http\Controllers\Influencer\MessageController as InfluencerMessageController;

/*Start influencer panel controller*/

// start user panel
use App\Http\Controllers\Auth\PasswordResetLinkController as UserPasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController as UserNewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController as UserRegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController as UserAuthenticatedSessionController;
use App\Http\Controllers\Api\User\PaymentController as ApiPaymentController;
use App\Http\Controllers\Api\User\PaypalController as ApiPaypalController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalController;

use App\Http\Controllers\Influencer\PortfolioController;

// end user panel

use App\Models\MultiCurrency;
use App\Models\Setting;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;


Broadcast::routes(['middleware' => 'auth:web']);
Broadcast::routes(['prefix' => 'influencer' ,'middleware' => 'auth:web']);

Broadcast::routes(['prefix' => 'api', 'middleware' => 'auth:api']);

Route::middleware('auth:web')->post('/broadcasting/auth', function (Request $request) {
    // Log::info('Broadcasting Auth Request:', $request->all());
    Log::info('Authenticated User:', ['user' => Auth::guard('web')->user()]);

    $channelName = $request->input('channel_name');
    $socketId = $request->input('socket_id');

    Log::info('Channel Name:', ['channel_name' => $channelName]);
    Log::info('Socket ID:', ['socket_id' => $socketId]);

    return Broadcast::auth($request);
});


Route::middleware('auth:api')->post('/api/broadcasting/auth', function (Request $request) {
    // Log::info('Broadcasting Auth Request:', $request->all());
    Log::info('Authenticated User:', ['user' => Auth::guard('web')->user()]);

    $channelName = $request->input('channel_name');
    $socketId = $request->input('socket_id');

    Log::info('Channel Name:', ['channel_name' => $channelName]);
    Log::info('Socket ID:', ['socket_id' => $socketId]);

    return Broadcast::auth($request);
});



Route::group(['middleware' => ['XSS','DEMO']], function () {

    Route::group(['middleware' => ['HtmlSpecialchars']], function () {

        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
            Route::get('/about-us', 'about_us')->name('about-us');
            Route::get('/faq', 'faq')->name('faq');
            Route::get('/terms-conditions', 'terms_conditions')->name('terms-conditions');
            Route::get('/privacy-policy', 'privacy_policy')->name('privacy-policy');
            Route::get('/page/{slug}', 'custom_page')->name('custom-page');

            Route::get('/contact-us', 'contact_us')->name('contact-us');
            Route::post('/store-contact-message', 'store_contact_message')->name('store-contact-message');

            Route::get('/services', 'services')->name('services');
            Route::get('/service/{slug}', 'service_show')->name('service');

            Route::get('/blogs', 'blogs')->name('blogs');
            Route::get('/blog/{slug}', 'blog_show')->name('blog');
            Route::post('/store-comment', 'store_comment')->name('store-comment');


            Route::get('/influencers', 'influencers')->name('influencers');
            Route::get('/influencers/{slug}', 'influencer')->name('influencer');

            Route::get('/influencer-joining', 'influencer_joining')->name('influencer-joining');

            Route::get('/download-file/{file}', [HomeController::class, 'download_file'])->name('download-file');

            Route::get('/language-switcher', 'language_switcher')->name('language-switcher');

            Route::get('/currency-switcher', 'currency_switcher')->name('currency-switcher');

        });

        Route::controller(PaymentController::class)->group(function () {
            Route::get('/booking-service/{slug}', 'service_booking')->name('booking-service');
            Route::get('/get-available-schedule', 'get_available_schedule')->name('get-available-schedule');
            Route::post('/store-booking-info-to-session', 'store_booking_info_to_session')->name('store-booking-info-to-session');
            Route::get('/payment/{slug}', 'payment')->name('payment');
            Route::post('/apply-coupon', 'apply_coupon')->name('apply-coupon');

            Route::post('/pay-via-bank/{slug}', 'pay_via_bank')->name('pay-via-bank');
            Route::post('/pay-via-stripe/{slug}', 'pay_via_stripe')->name('pay-via-stripe');
            Route::post('/pay-via-razorpay/{slug}', 'pay_via_razorpay')->name('pay-via-razorpay');
            Route::post('/pay-via-flutterwave/{slug}', 'pay_via_flutterwave')->name('pay-via-flutterwave');
            Route::get('/pay-via-paystack/{slug}', 'pay_via_payStack')->name('pay-via-paystack');
            Route::get('/pay-via-mollie/{slug}', 'pay_via_mollie')->name('pay-via-mollie');
            Route::get('/mollie-payment-success', 'mollie_payment_success')->name('mollie-payment-success');
            Route::get('/pay-via-instamojo/{slug}', 'pay_via_instamojo')->name('pay-via-instamojo');
            Route::get('/response-instamojo', 'instamojo_response')->name('response-instamojo');


            /** start payment addon */

            Route::get('/pay-with-grabpay/{slug}', 'pay_with_grabpay')->name('pay-with-grabpay');

            Route::get('/pay-with-gcash/{slug}', 'pay_with_gcash')->name('pay-with-gcash');

            Route::post('/pay-with-paymongo/{slug}', 'pay_with_paymongo')->name('pay-with-paymongo');

            Route::post('/pay-with-iyzico/{slug}', 'pay_with_iyzico')->name('pay-with-iyzico');

            Route::post('/pay-with-mercadopago/{slug}', 'pay_with_mercadopago')->name('pay-with-mercadopago');

            Route::get('/payment-addon-success', 'payment_addon_success')->name('payment-addon-success');

            Route::get('/payment-addon-faild', 'payment_addon_faild')->name('payment-addon-faild');


            /** end payment addon */

        });

        Route::get('/pay-via-paypal/{slug}',[PaypalController::class, 'pay_via_paypal'])->name('pay-via-paypal');
        Route::get('/paypal-success-payment',[PaypalController::class, 'paypal_success_payment'])->name('paypal-success-payment');
        Route::get('/paypal-faild-payment',[PaypalController::class, 'paypal_faild_payment'])->name('paypal-faild-payment');



        // webview route
        Route::post('/razorpay-create-token', [ApiPaymentController::class, 'razorpay_create_token'])->name('razorpay-create-token');
        Route::get('/razorpay-webview', [ApiPaymentController::class, 'razorpay_web_view'])->name('razorpay-webview');
        Route::get('/webview-schedule-not-available', [ApiPaymentController::class, 'webview_schedule_not_available'])->name('webview-schedule-not-available');
        Route::post('/webview-razorpay-payment-verify/{slug}', [ApiPaymentController::class, 'webview_razorpay_payment_verify'])->name('webview-razorpay-payment-verify');
        Route::get('/webview-payment-faild', [ApiPaymentController::class, 'webview_payment_faild'])->name('webview-payment-faild');
        Route::get('/webview-payment-success', [ApiPaymentController::class, 'webview_payment_success'])->name('webview-payment-success');


        Route::get('/flutterwave-webview', [ApiPaymentController::class, 'flutterwave_web_view'])->name('flutterwave-webview');
        Route::post('/pay-with-flutterwave-webview', [ApiPaymentController::class, 'pay_with_flutterwave_web_view'])->name('pay-with-flutterwave-webview');


        Route::get('/pay-with-mollie-webview', [ApiPaymentController::class, 'pay_with_mollie_webview'])->name('pay-with-mollie-webview');
        Route::get('/mollie-payment-success-webview', [ApiPaymentController::class, 'mollie_payment_success'])->name('mollie-payment-success-webview');

        Route::get('/paystack-web-view', [ApiPaymentController::class, 'paystack_web_view'])->name('paystack-web-view');
        Route::post('/pay-with-paystack-webview', [ApiPaymentController::class, 'pay_with_paystack'])->name('pay-with-paystack-webview');


        Route::get('/pay-with-instamojo-webview', [ApiPaymentController::class, 'pay_with_instamojo'])->name('pay-with-instamojo-webview');

        Route::get('/instamojo-response-webview', [ApiPaymentController::class, 'instamojo_response'])->name('instamojo-response-webview');


        Route::get('/pay-with-paypal-webview', [ApiPaypalController::class, 'payWithPaypal'])->name('pay-with-paypal-webview');
        Route::get('/paypal-payment-success-webview', [ApiPaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success-webview');
        Route::get('/paypal-payment-cancled-webview', [ApiPaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled-webview');



        Route::group(['as'=> 'user.', 'prefix' => 'user','middleware' => ['CheckClient']],function (){

            Route::controller(ProfileController::class)->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');

                Route::get('/edit-profile', 'edit')->name('edit-profile');
                Route::get('/change-password', 'change_password')->name('change-password');
                Route::post('/update-password', 'update_password')->name('update-password');
                Route::post('/upload-user-avatar', 'upload_user_avatar')->name('upload-user-avatar');
                Route::get('/orders', 'orders')->name('orders');
                Route::get('/order/{order_id}', 'order_show')->name('order');
                Route::put('/mark-as-a-complete/{order_id}', 'mark_as_complete')->name('mark-as-a-complete');
                Route::put('/mark-as-a-declined/{order_id}', 'mark_as_declined')->name('mark-as-a-declined');
                Route::post('/send-refund-request/{order_id}', 'refund_request')->name('send-refund-request');

                Route::get('/support-tickets', 'support_tickets')->name('support-tickets');
                Route::get('/support-ticket/{order_id}', 'support_tickets_show')->name('support-ticket');
                Route::post('/create-support-ticket', 'create_support_ticket')->name('create-support-ticket');
                Route::post('/send-ticket-message', 'send_ticket_message')->name('send-ticket-message');

                Route::get('/wishlists', 'wishlists')->name('wishlists');
                Route::get('/add-to-wishlist/{id}', 'add_to_wishlist')->name('add-to-wishlist');
                Route::delete('/remove-wishlist/{id}', 'remove_wishlist')->name('remove-wishlist');

                Route::get('/reviews', 'reviews')->name('reviews');
                Route::post('/store-review', 'store_review')->name('store-review');
            });

            Route::get('live-chat', [UserMessageController::class, 'index'])->name('live-chat');
            Route::get('load-chat-box/{id}', [UserMessageController::class, 'load_chat_box'])->name('load-chat-box');
            Route::post('send-message-to-provider', [UserMessageController::class, 'send_message_to_provider'])->name('send-message-to-provider');

        });

        Route::post('/forget-password', [UserPasswordResetLinkController::class, 'custom_forget_password'])->name('forget-password');
        Route::get('/reset-password-page/{token}', [UserNewPasswordController::class, 'custom_reset_password_page'])->name('reset-password-page');
        Route::post('/reset-password-store/{token}', [UserNewPasswordController::class, 'custom_reset_password_store'])->name('reset-password-store');
        Route::get('/user-verification/{token}', [UserRegisteredUserController::class, 'custom_user_verification'])->name('user-verification');

        Route::post('/influencer-register', [UserRegisteredUserController::class, 'influencer_register'])->name('influencer-register');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        Route::controller(UserAuthenticatedSessionController::class)->group(function () {
            Route::get('login/google', 'redirect_to_google')->name('login-google');
            Route::get('influencer/login/google', 'influencer_redirect_to_google')->name('influencer-login-google');
            Route::get('/callback/google', 'google_callback')->name('callback-google');

            Route::get('login/facebook', 'redirect_to_facebook')->name('login-facebook');
            Route::get('influencer/login/facebook', 'influencer_redirect_to_facebook')->name('influencer-login-facebook');
            Route::get('/callback/facebook', 'facebookCallBack')->name('callback-facebook');
        });

    });

    require __DIR__.'/auth.php';

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){

        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        /* Start admin auth route */
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

        Route::post('store-login', [AuthenticatedSessionController::class, 'store'])->name('store-login');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('logout');

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

        /* End admin auth route */

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::put('update-password', 'update_password')->name('update-password');
        });

        Route::controller(TicketController::class)->group(function () {
            Route::get('ticket', 'index')->name('ticket');
            Route::get('ticket-show/{id}','show')->name('ticket-show');
            Route::delete('ticket-delete/{id}', 'destroy')->name('ticket-delete');
            Route::put('ticket-closed/{id}', 'closed')->name('ticket-closed');
            Route::post('store-ticket-message', 'store_message')->name('store-ticket-message');
        });

        Route::resource('coupon', AdminCouponController::class);
        Route::get('coupon-history', [AdminCouponController::class, 'coupon_history'])->name('coupon-history');

        Route::controller(OrderController::class)->group(function () {
            Route::get('all-booking', 'index')->name('all-booking');
            Route::get('booking-show/{id}', 'show')->name('booking-show');
            Route::put('/mark-as-a-complete/{order_id}', 'mark_as_complete')->name('mark-as-a-complete');
            Route::put('/booking-declined/{order_id}', 'mark_as_declined')->name('booking-declined');
            Route::put('booking-approved/{id}',  'booking_approved_request')->name('booking-approved');
            Route::put('payment-approved/{id}', 'payment_approved')->name('payment-approved');
            Route::delete('delete-order/{id}', 'delete_order')->name('delete-order');
            Route::put('refund-request-approved/{id}', 'refund_request_approved')->name('refund-request-approved');
            Route::put('refund-request-declined/{id}', 'refund_request_declined')->name('refund-request-declined');
            Route::get('awaiting-booking', 'awaiting_booking')->name('awaiting-booking');
            Route::get('active-booking', 'active_booking')->name('active-booking');
            Route::get('completed-booking', 'complete_booking')->name('completed-booking');
            Route::get('declined-booking', 'decline_booking')->name('declined-booking');
            Route::get('complete-request', 'complete_request')->name('complete-request');
            Route::get('refund-request', 'refund_request')->name('refund-request');
        });

        Route::resource('withdraw-method', AdminWithdrawController::class);

        Route::controller(AdminWithdrawController::class)->group(function () {
            Route::get('influencer-withdraw', 'influencer_withdraw')->name('influencer-withdraw');
            Route::get('pending-influencer-withdraw', 'pending_withdraw')->name('pending-influencer-withdraw');

            Route::get('show-influencer-withdraw/{id}', 'show_withdraw')->name('show-influencer-withdraw');
            Route::delete('delete-influencer-withdraw/{id}', 'destroy_withdraw')->name('delete-influencer-withdraw');
            Route::put('approved-influencer-withdraw/{id}', 'approved_withdraw')->name('approved-influencer-withdraw');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('influencer-list', 'influencer_list')->name('influencer-list');
            Route::get('pending-influencer', 'pending_influencer')->name('pending-influencer');
            Route::get('influencer-show/{id}', 'influencer_show')->name('influencer-show');
            Route::put('influencer-update/{id}', 'influencer_update')->name('influencer-update');
            Route::get('send-email-to-influencer/{id}', 'send_email_single_influencer')->name('send-email-to-influencer');
            Route::post('send-mail-to-single-influencer/{id}', 'send_mail_single_influencer')->name('send-mail-to-single-influencer');
            Route::get('send-email-to-all-influencer', 'send_email_all_influencer')->name('send-email-to-all-influencer');
            Route::post('send-mail-to-all-influencer', 'send_mail_to_all_influencer')->name('send-mail-to-all-influencer');

            Route::delete('influencer-delete/{id}', 'inluencer_destroy')->name('influencer-delete');
            Route::put('influencer-status/{id}', 'influencer_status')->name('influencer-status');

            Route::get('client-list', 'client_list')->name('client-list');
            Route::get('pending-client', 'pending_client')->name('pending-client');
            Route::get('client-show/{id}', 'client_show')->name('client-show');
            Route::post('send-mail-to-single-client/{id}', 'send_email_to_single_client')->name('send-mail-to-single-client');
            Route::delete('client-delete/{id}', 'client_destroy')->name('client-delete');

        });

        Route::resource('admin-list', AdminController::class);


    });


    Route::group(['as'=> 'influencer.', 'prefix' => 'influencer','middleware' => ['auth:web','CheckInfluencer']],function (){

        Route::controller(InfluencerProfileController::class)->group(function () {

            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::get('change-password', 'change_password')->name('change-password');
            Route::put('password-update', 'update_password')->name('update-password');
        });

        Route::controller(InfluencerTicketController::class)->group(function () {
            Route::get('ticket', 'index')->name('ticket');
            Route::get('ticket-show/{id}','show')->name('ticket-show');
            Route::post('store-ticket-message', 'store_message')->name('store-ticket-message');
            Route::get('create-new-ticket', 'create_new_ticket')->name('create-new-ticket');
            Route::post('store-new-ticket', 'store_new_ticket')->name('store-new-ticket');
        });

        Route::resource('appointment-schedule',AppointmentScheduleController::class);

        Route::resource('coupon', CouponController::class);
        Route::get('coupon-history', [CouponController::class, 'coupon_history'])->name('coupon-history');

        Route::resource('service', InfluencerServiceController::class);

        Route::controller(InfluencerServiceController::class)->group(function () {
            Route::get('additional-service/{id}', 'additional_service')->name('additional-service');
            Route::get('additional-create/{id}', 'additional_create')->name('additional-create');
            Route::post('additional-store/{id}', 'additional_store')->name('additional-store');
            Route::get('additional-edit/{id}', 'additional_edit')->name('additional-edit');
            Route::put('additional-update/{id}', 'additional_update')->name('additional-update');
            Route::delete('additional-delete/{id}', 'additional_delete')->name('additional-delete');

            Route::get('awaiting-for-approval-service', 'awaiting_for_approval')->name('awaiting-for-approval-service');
            Route::get('active-service', 'active_service')->name('active-service');
            Route::get('banned-service', 'banned_service')->name('banned-service');

            Route::get('review-list', 'review_list')->name('review-list');
            Route::get('show-review/{id}', 'review_show')->name('show-review');

        });

        Route::controller(InfluencerOrderController::class)->group(function () {
            Route::get('all-booking', 'index')->name('all-booking');
            Route::get('booking-show/{id}', 'show')->name('booking-show');
            Route::put('booking-approved/{id}', 'booking_approved_request')->name('booking-approved');
            Route::post('send-order-complete-request/{id}', 'send_complete_request')->name('send-order-complete-request');

            Route::get('awaiting-booking', 'awaiting_booking')->name('awaiting-booking');
            Route::get('active-booking', 'active_booking')->name('active-booking');
            Route::get('completed-booking', 'complete_booking')->name('completed-booking');
            Route::get('declined-booking', 'decline_booking')->name('declined-booking');
            Route::put('booking-declined/{id}', 'booking_decilend_request')->name('booking-declined');
            Route::get('complete-request', 'complete_request')->name('complete-request');
        });

        Route::resource('my-withdraw', WithdrawController::class);
        Route::get('get-withdraw-account-info/{id}', [WithdrawController::class, 'getWithDrawAccountInfo'])->name('get-withdraw-account-info');

        Route::controller(PortfolioController::class)->group(function () {
            Route::get('portfolio-list', 'index')->name('portfolio-list');
            Route::get('portfolio-create','create')->name('portfolio-create');
            Route::post('portfolio-store','store')->name('portfolio-store');
            Route::get('portfolio-edit/{id}','edit')->name('portfolio-edit');
            Route::put('portfolio-update/{id}','update')->name('portfolio-update');
            Route::delete('portfolio-destory/{id}','destroy')->name('portfolio-destory');
        });


        Route::get('live-chat', [InfluencerMessageController::class, 'index'])->name('live-chat');
        Route::get('load-chat-box/{id}', [InfluencerMessageController::class, 'load_chat_box'])->name('load-chat-box');
        Route::post('send-message-to-buyer', [InfluencerMessageController::class, 'send_message_to_buyer'])->name('send-message-to-buyer');

        Route::get('find-new-buyer/{id}', [InfluencerMessageController::class, 'find_new_buyer'])->name('find-new-buyer');

    });

});


Route::get('/migrate-for-addon', function(){
    Artisan::call('migrate');

    Artisan::call('optimize:clear');

    $notification = "Migrate successfully";
    $notification = array('messege' => $notification, 'alert-type' => 'success');
    return redirect()->route('home')->with($notification);
});





Route::get('/migrate', function(){
    Artisan::call('migrate');

    $setting = Setting::first();
    $setting->app_version = '3.1.0';
    $setting->save();



    Artisan::call('optimize:clear');

    $notification = "Your version has been updated successfully";
    $notification = array('messege' => $notification, 'alert-type' => 'success');
    return redirect()->route('home')->with($notification);
});
