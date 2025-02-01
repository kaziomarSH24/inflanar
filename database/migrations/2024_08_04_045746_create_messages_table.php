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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id')->default();
            $table->integer('provider_id')->default();
            $table->text('message')->nullable();
            $table->integer('buyer_read_msg')->default(0);
            $table->integer('provider_read_msg')->default(0);
            $table->string('send_by')->nullable();
            $table->integer('service_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
