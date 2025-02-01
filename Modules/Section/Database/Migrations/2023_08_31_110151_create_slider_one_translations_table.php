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
        Schema::create('slider_one_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('slider_one_id');
            $table->string('lang_code');
            $table->text('home1_title')->nullable();
            $table->text('home1_header')->nullable();
            $table->text('home2_title')->nullable();
            $table->text('home2_header')->nullable();
            $table->text('home3_title')->nullable();
            $table->text('home3_header')->nullable();
            $table->text('home3_item1')->nullable();
            $table->text('home3_item2')->nullable();
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
        Schema::dropIfExists('slider_one_translations');
    }
};
