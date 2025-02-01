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
        Schema::create('why_choose_us_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('why_choose_us_id');
            $table->string('lang_code');
            $table->string('home2_title')->nullable();
            $table->string('home2_header')->nullable();
            $table->text('home2_description')->nullable();
            $table->text('home2_item1')->nullable();
            $table->text('home2_item2')->nullable();
            $table->text('home2_item3')->nullable();
            $table->text('home2_des1')->nullable();
            $table->text('home2_des2')->nullable();
            $table->text('home2_des3')->nullable();

            $table->string('home3_title')->nullable();
            $table->string('home3_header')->nullable();
            $table->text('home3_description')->nullable();
            $table->text('home3_item1')->nullable();
            $table->text('home3_item2')->nullable();
            $table->text('home3_item3')->nullable();
            $table->text('home3_des1')->nullable();
            $table->text('home3_des2')->nullable();
            $table->text('home3_des3')->nullable();

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
        Schema::dropIfExists('why_choose_us_translations');
    }
};
