<?php

use Modules\PaymentGateway\Http\Controllers\PaymentGatewayController;
use Modules\PaymentGateway\Http\Controllers\GatewayInformationController;


Route::prefix('paymentgateway')->group(function() {
    Route::get('/', 'PaymentGatewayController@index');
});


Route::group(['as'=> 'admin.', 'prefix' => 'admin'],function (){
    Route::get('/payment-addon', [GatewayInformationController::class, 'payment_addon'])->name('payment-addon');
    Route::put('/update-paymongo', [GatewayInformationController::class, 'update_paymongo'])->name('update-paymongo');
    Route::put('/update-iyzico', [GatewayInformationController::class, 'update_iyzico'])->name('update-iyzico');
    Route::put('/update-mercado', [GatewayInformationController::class, 'update_mercado'])->name('update-mercado');
});


Route::get('/paymongo-verify', [PaymentGatewayController::class, 'paymongo_verify'])->name('paymongo-verify');

Route::get('/paymongo-payment-success', [PaymentGatewayController::class, 'paymongo_payment_success'])->name('paymongo-payment-success');

Route::get('/paymongo-payment-cancled', [PaymentGatewayController::class, 'paymongo_payment_cancled'])->name('paymongo-payment-cancled');

Route::get('/paymongo-weebhook', [PaymentGatewayController::class, 'paymongoWeebHook'])->name('paymongo-weebhook');

