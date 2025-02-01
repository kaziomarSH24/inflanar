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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('logo');
            $table->string('favicon');
            $table->string('text_direction')->default('LTR');
            $table->string('timezone')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('currency_icon')->nullable();
            $table->string('currency_rate')->nullable();
            $table->string('default_avatar')->nullable();
            $table->string('selected_theme')->default('theme_one');
            $table->string('currency_position')->default('before_price');
            $table->string('commission_type')->default('commission');
            $table->string('live_chat')->default('disable');
            $table->string('app_version')->default('Version - 1.1');
            $table->string('show_provider_contact_info')->default('enable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
