<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\PaymentGateway\Entities\IyzicoPayment;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iyzico_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('currency_id')->default(0);
            $table->text('api_key');
            $table->text('secret_key');
            $table->integer('status')->default(1);
            $table->string('iyzico_image')->nullable();
            $table->string('account_mode')->default('Sandbox');
            $table->timestamps();
        });

        if(!IyzicoPayment::first()){
            $info = new IyzicoPayment();
            $info->api_key = 'api_key';
            $info->secret_key = 'secret_key';
            $info->status = 1;
            $info->account_mode = 'Sandbox';
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
        Schema::dropIfExists('iyzico_payments');
    }
};
