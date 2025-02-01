<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController as apiHomeController;

use App\Http\Controllers\Api\User\MessageController;
use App\Http\Controllers\Api\Influencer\MessageController as InfluencerMessageController;

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\PaymentController;
use App\Http\Controllers\Api\User\PaypalController;
use App\Http\Controllers\Api\Influencer\ProfileController as InfluencerProfileController;
use App\Http\Controllers\Api\Influencer\TicketController as InfluencerTicketController;
use App\Http\Controllers\Api\Influencer\AppointmentScheduleController;
use App\Http\Controllers\Api\Influencer\ServiceController as InfluencerServiceController;
use App\Http\Controllers\Api\Influencer\OrderController as InfluencerOrderController;
use App\Http\Controllers\Api\Influencer\WithdrawController;
use App\Http\Controllers\Api\Influencer\CouponController;

Route::group(['middleware' => ['XSS','DEMO']], function () {

    Route::group(['middleware' => ['HtmlSpecialchars']], function () {

        Route::get('website-setup', [apiHomeController::class, 'website_setup'])->name('website-setup');

        Route::group(['middleware' => ['ApiLangSession']], function () {

            Route::controller(apiHomeController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/about-us', 'about_us')->name('about-us');
                Route::get('/contact-us', 'contact_us')->name('contact-us');
                Route::post('/send-contact-message', 'store_contact_message')->name('send-contact-message');
                Route::get('/blogs', 'blogs')->name('blogs');
                Route::get('/blog-show/{slug}', 'blog_show')->name('blog-show');
                Route::post('/store-blog-comment', 'store_comment')->name('store-blog-comment');
                Route::get('/faqs', 'faq')->name('faqs');
                Route::get('/terms-conditions', 'terms_conditions')->name('terms-conditions');
                Route::get('/privacy-policy', 'privacy_policy')->name('privacy-policy');
                Route::get('/services', 'services')->name('services');
                Route::get('/service-show/{slug}', 'service_show')->name('service-show');
                Route::get('/influencers', 'influencers')->name('influencers');
                Route::get('/influencer/{slug}', 'influencer')->name('influencer');
                Route::get('/language-switcher', 'language_switcher')->name('language-switcher');
                Route::get('/currency-switcher', 'currency_switcher')->name('currency-switcher');
            });

            Route::controller(LoginController::class)->group(function () {
                Route::get('/login-page', 'loginPage')->name('login');
                Route::post('/store-login', 'storeLogin')->name('store-login');
                Route::post('/influncer-login', 'storeLoginInfluncer')->name('influncer-login');
                Route::post('/send-forget-password', 'sendForgetPassword')->name('send-forget-password');
                Route::post('/otp-verify-page', 'otpVerifyPage')->name('otp-verify-page');
                Route::post('/set-new-password', 'setNewPasswordPage')->name('set-new-password');
                Route::get('login/google','redirectToGoogle')->name('login-google');
                Route::get('/callback/google', 'googleCallBack')->name('callback-google');
                Route::get('login/facebook', 'redirectToFacebook')->name('login-facebook');
                Route::get('/callback/facebook', 'facebookCallBack')->name('callback-facebook');
                Route::get('logout','userLogout')->name('logout');
            });

            Route::controller(RegisterController::class)->group(function () {
                Route::post('/store-register', 'storeRegister')->name('store-register');
                Route::post('/store-influncer-register', 'storeInfluncerRegister')->name('store-influncer-register');
                Route::get('/user-verification/{otp}', 'userVerification')->name('user-verification');
                Route::post('/resend-register-code', 'resendRegisterCode')->name('resend-register-code');
            });

            Route::group(['as'=> 'user.', 'prefix' => 'user'],function (){

                Route::controller(UserProfileController::class)->group(function () {
                    Route::get('/dashboard', 'dashboard')->name('dashboard');

                    Route::post('/update-profile', 'update')->name('update-profile');
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


                    Route::post('/account-delete', 'account_delete')->name('account-delete');
                });

                Route::controller(PaymentController::class)->group(function () {
                    Route::get('/booking-service/{slug}', 'service_booking')->name('booking-service');
                    Route::get('/get-available-schedule', 'get_available_schedule')->name('get-available-schedule');
                    Route::post('/store-booking-info-to-session', 'store_booking_info_to_session')->name('store-booking-info-to-session');
                    Route::get('/payment/{slug}', 'payment')->name('payment');
                    Route::post('/apply-coupon', 'apply_coupon')->name('apply-coupon');

                    Route::post('/pay_via_bank/{slug}', 'pay_via_bank')->name('pay-via-bank');
                    Route::post('/pay-via-stripe/{slug}', 'pay_via_stripe')->name('pay-via-stripe');

                    Route::post('/pay-with-razorpay/{slug}', 'payWithRazorpay')->name('pay-with-razorpay');
                    Route::post('/pay-with-flutterwave/{slug}', 'payWithFlutterwave')->name('pay-with-flutterwave');
                    Route::get('/pay-with-mollie/{slug}', 'payWithMollie')->name('pay-with-mollie');
                    Route::get('/mollie-payment-success', 'molliePaymentSuccess')->name('mollie-payment-success');
                    Route::get('/pay-with-paystack/{slug}', 'payWithPayStack')->name('pay-with-paystack');
                    Route::get('/pay-with-instamojo/{slug}', 'payWithInstamojo')->name('pay-with-instamojo');
                    Route::get('/response-instamojo', 'instamojoResponse')->name('response-instamojo');
                });

                Route::get('/pay-with-paypal/{slug}', [PaypalController::class, 'payWithPaypal'])->name('pay-with-paypal');
                Route::get('/paypal-payment-success', [PaypalController::class, 'paypalPaymentSuccess'])->name('paypal-payment-success');
                Route::get('/paypal-payment-cancled', [PaypalController::class, 'paypalPaymentCancled'])->name('paypal-payment-cancled');



                Route::get('live-chat', [MessageController::class, 'index'])->name('live-chat');
                Route::get('get-message-list/{provider_id}', [MessageController::class, 'get_message_list'])->name('get-message-list');
                Route::post('send-message-to-provider', [MessageController::class, 'send_message_to_provider'])->name('send-message-to-provider');

            });

            Route::group(['as'=> 'influencers.', 'prefix' => 'influencers'],function (){


                Route::get('live-chat', [InfluencerMessageController::class, 'index'])->name('live-chat');
                Route::get('get-message-list/{user_id}', [InfluencerMessageController::class, 'get_message_list'])->name('get-message-list');
                Route::post('send-message-to-buyer', [InfluencerMessageController::class, 'send_message_to_buyer'])->name('send-message-to-buyer');

                Route::controller(InfluencerProfileController::class)->group(function () {

                    Route::get('/dashboard', 'dashboard')->name('dashboard');
                    Route::get('edit-profile', 'edit_profile')->name('edit-profile');
                    Route::put('profile-update', 'profile_update')->name('profile-update');
                    Route::put('password-update', 'update_password')->name('update-password');
                });

                Route::controller(InfluencerTicketController::class)->group(function () {
                    Route::get('ticket', 'index')->name('ticket');
                    Route::get('ticket-show/{id}','show')->name('ticket-show');
                    Route::post('store-ticket-message', 'store_message')->name('store-ticket-message');
                    Route::post('store-new-ticket', 'store_new_ticket')->name('store-new-ticket');
                });

                Route::resource('coupon', CouponController::class);
                Route::get('coupon-history', [CouponController::class, 'coupon_history'])->name('coupon-history');

                Route::resource('appointment-schedule',AppointmentScheduleController::class);

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

            });

        });
    });

});



