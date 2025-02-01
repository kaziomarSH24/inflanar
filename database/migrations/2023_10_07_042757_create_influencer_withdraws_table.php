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
        Schema::create('influencer_withdraws', function (Blueprint $table) {
            $table->id();
            $table->integer('influencer_id');
            $table->string('method');
            $table->decimal('total_amount', 8, 2)->default(0.00);
            $table->decimal('withdraw_amount', 8, 2)->default(0.00);
            $table->decimal('withdraw_charge', 8, 2)->default(0.00);
            $table->text('account_info');
            $table->integer('status')->default(0);
            $table->string('approved_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencer_withdraws');
    }
};
