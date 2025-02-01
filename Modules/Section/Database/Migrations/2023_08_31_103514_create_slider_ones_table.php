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
        Schema::create('slider_ones', function (Blueprint $table) {
            $table->id();
            $table->text('tags')->nullable();
            $table->string('client_qty')->nullable();
            $table->string('client_image')->nullable();
            $table->string('home1_feature_image')->nullable();
            $table->string('home2_feature_image')->nullable();
            $table->string('home3_feature_image')->nullable();
            $table->string('home2_bg')->nullable();
            $table->string('social1')->nullable();
            $table->string('social2')->nullable();
            $table->string('social3')->nullable();
            $table->string('social4')->nullable();
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
        Schema::dropIfExists('slider_ones');
    }
};






