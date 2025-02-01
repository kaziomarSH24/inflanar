<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\PaymentGateway\Entities\PaymongoPayment;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymongo_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('currency_id')->default(0);
            $table->text('secret_key');
            $table->text('public_key');
            $table->text('webhook_sig')->nullable();
            $table->integer('status')->default(1);
            $table->string('paymongo_image')->nullable();
            $table->string('grabpay_image')->nullable();
            $table->string('gcash_image')->nullable();
            $table->timestamps();
        });

        if(!PaymongoPayment::first()){
            $info = new PaymongoPayment();
            $info->secret_key = 'secret_key';
            $info->public_key = 'public_key';
            $info->webhook_sig = 'webhook_sig';
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
        Schema::dropIfExists('paymongo_payments');
    }
};
