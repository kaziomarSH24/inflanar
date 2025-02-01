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
        Schema::create('home_page_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('home_page_id');
            $table->string('lang_code');
            $table->string('feature_title')->nullable();
            $table->string('feature_header')->nullable();
            $table->string('influencer_title')->nullable();
            $table->string('influencer_header')->nullable();
            $table->string('service_title')->nullable();
            $table->string('service_header')->nullable();
            $table->string('working_title')->nullable();
            $table->string('working_header')->nullable();
            $table->string('video_title')->nullable();
            $table->text('video_description')->nullable();
            $table->string('partner_title')->nullable();
            $table->text('partner_description')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->string('testimonial_header')->nullable();
            $table->string('faq_title')->nullable();
            $table->string('faq_header')->nullable();
            $table->text('faq_description')->nullable();
            $table->string('blog_title')->nullable();
            $table->string('blog_header')->nullable();
            $table->text('provider_joining_title')->nullable();
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
        Schema::dropIfExists('home_page_translations');
    }
};
