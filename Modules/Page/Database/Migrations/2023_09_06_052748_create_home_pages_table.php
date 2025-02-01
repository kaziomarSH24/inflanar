<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            $table->string('video_image')->nullable();
            $table->string('video_id')->nullable();
            $table->string('facebook_image')->nullable();
            $table->string('facebook_follower')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('twitter_follower')->nullable();
            $table->string('tiktok_image')->nullable();
            $table->string('tiktok_follower')->nullable();
            $table->string('instagram_image')->nullable();
            $table->string('instagram_follower')->nullable();
            $table->string('faq_image')->nullable();
            $table->string('provider_joining_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_pages');
    }
};
