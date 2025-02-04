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
        Schema::create('subscription_fees', function (Blueprint $table) {
            $table->id();
            $table->enum('fees_type',['fixed','percentage']);
            $table->string('fees');
            $table->enum('user_type',['business','influencer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_fees');
    }
};
