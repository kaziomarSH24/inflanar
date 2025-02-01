<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Modules\Subscription\Http\Controllers\SubscriptionController as FrontendSubscriptionController;
use Modules\Subscription\Http\Controllers\Admin\SubscriptionController;
use Modules\Subscription\Http\Controllers\Admin\PurchaseController;

use Modules\Subscription\Http\Controllers\User\PaymentController;
use Modules\Subscription\Http\Controllers\User\PaypalController as UserpaypalController;
use Modules\Subscription\Http\Controllers\Provider\PaypalController;
use Modules\Subscription\Http\Controllers\Provider\PaymentGatewayController;
use Modules\Subscription\Http\Controllers\Provider\SslCommerzPaymentController;
use Modules\Subscription\Http\Controllers\Provider\UserOrderController;
// use App\Http\Controllers\Api\SslCommerzPaymentController;
use Modules\Subscription\Http\Controllers\Provider\PurchaseController as ProviderPurchaseController;;

Route::group(['middleware' => ['XSS','DEMO']], function () {

    Route::get('pricing/plan', [FrontendSubscriptionController::class, 'pricing_plan'])->name('pricing-plan');
    Route::get('buy/pricing/plan', [PaymentController::class, 'buy_pricing_plan'])->name('buy-pricing-plan');

    Route::get('/provider/payment/{slug}', [PaymentController::class, 'payment'])->name('provider-payment');
    Route::post('/provider/bank-payment/{slug}', [PaymentController::class, 'bankPayment'])->name('provider-bank-payment');
    Route::post('/provider/pay-with-stripe/{slug}', [PaymentController::class, 'payWithStripe'])->name('provider-pay-with-stripe');
    Route::post('/provider/pay-with-razorpay/{slug}', [PaymentController::class, 'payWithRazorpay'])->name('provider-pay-with-razorpay');
    Route::post('/provider/pay-with-flutterwave/{slug}', [PaymentController::class, 'payWithFlutterwave'])->name('provider-pay-with-flutterwave');
    Route::get('/provider/pay-with-mollie/{slug}', [PaymentController::class, 'payWithMollie'])->name('provider-pay-with-mollie');
    Route::get('/provider/mollie-payment-success', [PaymentController::class, 'molliePaymentSuccess'])->name('provider-mollie-payment-success');
    Route::post('/provider/pay-with-paystack/{slug}', [PaymentController::class, 'payWithPayStack'])->name('provider-pay-with-paystack');
    Route::get('/provider/response-paystack', [PaymentController::class, 'paystackResponse'])->name('provider-response-paystack');
    Route::get('/provider/pay-with-instamojo/{slug}', [PaymentController::class, 'payWithInstamojo'])->name('provider-pay-with-instamojo');
    Route::get('/provider/response-instamojo', [PaymentController::class, 'instamojoResponse'])->name('provider-response-instamojo');

    Route::get('/provider/pay-with-paypal/{slug}', [UserpaypalController::class, 'payWithPaypal'])->name('provider-pay-with-paypal');
    Route::get('/provider/paypal-payment-success', [UserpaypalController::class, 'paypalPaymentSuccess'])->name('provider-paypal-payment-success');
    Route::get('/provider/paypal-payment-cancled', [UserpaypalController::class, 'paypalPaymentCancled'])->name('provider-paypal-payment-cancled');

    Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
        Route::resource('/subscription-plan', SubscriptionController::class);

        Route::get('/purchase-history',[PurchaseController::class, 'index'])->name('purchase-history');
        Route::get('/pending-plan-payment',[PurchaseController::class, 'pending_payment'])->name('pending-plan-payment');

        Route::get('/assign-plan',[PurchaseController::class, 'create'])->name('assign-plan');
        Route::post('/store-assign-plan',[PurchaseController::class, 'store'])->name('store-assign-plan');

        Route::get('/purchase-history-show/{id}',[PurchaseController::class, 'show'])->name('purchase-history-show');
        Route::put('/approved-plan-payment/{id}',[PurchaseController::class, 'approved_plan_payment'])->name('approved-plan-payment');
        Route::delete('/delete-plan-payment/{id}',[PurchaseController::class, 'delete_plan_payment'])->name('delete-plan-payment');

    });

    Route::group(['as'=> 'influencer.', 'prefix' => 'influencer','middleware' => ['auth:web','CheckInfluencer']],function (){

        Route::get('/purchase-history',[ProviderPurchaseController::class, 'index'])->name('purchase-history');
        Route::get('/pending-plan-payment',[ProviderPurchaseController::class, 'pending_payment'])->name('pending-plan-payment');
        Route::get('/purchase-history-show/{id}',[ProviderPurchaseController::class, 'show'])->name('purchase-history-show');

        Route::get('/payment-getway-setup',[PaymentGatewayController::class, 'index'])->name('payment-getway-setup');

        Route::put('/store-paypal-gateway',[PaymentGatewayController::class, 'store_paypal_gateway'])->name('store-paypal-gateway');

        Route::put('/store-stripe-gateway',[PaymentGatewayController::class, 'store_stripe_gateway'])->name('store-stripe-gateway');

        Route::put('/store-razorpay-gateway',[PaymentGatewayController::class, 'store_razorpay_gateway'])->name('store-razorpay-gateway');

        Route::put('/store-flutterwave-gateway',[PaymentGatewayController::class, 'store_flutterwave_gateway'])->name('store-flutterwave-gateway');

        Route::put('/store-paystack-gateway',[PaymentGatewayController::class, 'store_paystack_gateway'])->name('store-paystack-gateway');

        Route::put('/store-mollie-gateway',[PaymentGatewayController::class, 'store_mollie_gateway'])->name('store-mollie-gateway');

        Route::put('/store-instamojo-gateway',[PaymentGatewayController::class, 'store_instamojo_gateway'])->name('store-instamojo-gateway');

        Route::put('/store-bank-handcash-gateway',[PaymentGatewayController::class, 'store_bank_handcash_gateway'])->name('store-bank-handcash-gateway');


    });

        Route::get('/user-subscription-plan',[ProviderPurchaseController::class, 'subscription_plan'])->name('subscription-plan-user');
        Route::get('/subscription-payment/{id}',[FrontendSubscriptionController::class, 'subscription_payment'])->name('subscription-payment');

        Route::group(['as'=> 'subscription.', 'prefix' => 'subscription'],function (){
            Route::get('/free-enroll/{id}',[FrontendSubscriptionController::class, 'free_enroll'])->name('free-enroll');

            Route::post('/stripe-payment/{id}',[ProviderPurchaseController::class, 'stripe_payment'])->name('stripe-payment');

            Route::post('/razorpay-payment/{id}',[ProviderPurchaseController::class, 'razorpay_payment'])->name('razorpay-payment');
            Route::post('/flutterwave-payment',[ProviderPurchaseController::class, 'flutterwave_payment'])->name('flutterwave-payment');
            Route::post('/paystack-payment',[ProviderPurchaseController::class, 'paystack_payment'])->name('paystack-payment');

            Route::get('/mollie-payment/{id}',[ProviderPurchaseController::class, 'mollie_payment'])->name('mollie-payment');
            Route::get('/mollie-success-payment',[ProviderPurchaseController::class, 'mollie_success_payment'])->name('mollie-success-payment');

            Route::get('/instamojo-payment/{id}',[ProviderPurchaseController::class, 'instamojo_payment'])->name('instamojo-payment');
            Route::get('/instamojo-success-payment',[ProviderPurchaseController::class, 'instamojo_success_payment'])->name('instamojo-success-payment');

            Route::post('/bank-payment/{id}',[ProviderPurchaseController::class, 'bank_payment'])->name('bank-payment');

            Route::get('/paypal-payment/{id}',[PaypalController::class, 'paypal_payment'])->name('paypal-payment');
            Route::get('/paypal-success-payment',[PaypalController::class, 'paypal_success_payment'])->name('paypal-success-payment');
            Route::get('/paypal-faild-payment',[PaypalController::class, 'paypal_faild_payment'])->name('paypal-faild-payment');

        });






});
