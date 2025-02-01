<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\PaymentGateway\Entities\MercadoPagoPayment;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mercado_pago_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('currency_id')->default(0);
            $table->text('public_key');
            $table->text('access_token');
            $table->integer('status')->default(1);
            $table->string('mercado_image')->nullable();
            $table->timestamps();
        });

        if(!MercadoPagoPayment::first()){
            $info = new MercadoPagoPayment();
            $info->public_key = 'public_key';
            $info->access_token = 'access_token';
            $info->status = 1;
            $info->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mercado_pago_payments');
    }
};
