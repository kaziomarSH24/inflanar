<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('booking_date');
            $table->integer('appointment_schedule_id');
            $table->string('schedule_time_slot');
            $table->integer('client_id');
            $table->integer('influencer_id');
            $table->integer('service_id');
            $table->decimal('package_amount', 8, 2);
            $table->decimal('additional_amount', 8, 2)->default(0.00);
            $table->decimal('coupon_discount', 8, 2)->default(0.00);
            $table->decimal('total_amount', 8, 2);
            $table->string('payment_method');
            $table->string('transection_id');
            $table->string('payment_status');
            $table->string('order_status')->default('awaiting_for_influencer_approval');
            $table->text('package_features')->nullable();
            $table->text('additional_services')->nullable();
            $table->text('order_note')->nullable();
            $table->text('client_address');
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
