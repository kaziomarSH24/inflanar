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
        Schema::create('why_choose_us', function (Blueprint $table) {
            $table->id();
            $table->string('home2_image')->nullable();
            $table->string('home2_foreground1')->nullable();
            $table->string('home2_foreground2')->nullable();
            $table->string('home3_image')->nullable();
            $table->string('home2_icon1')->nullable();
            $table->string('home2_icon2')->nullable();
            $table->string('home2_icon3')->nullable();
            $table->string('home3_icon1')->nullable();
            $table->string('home3_icon2')->nullable();
            $table->string('home3_icon3')->nullable();
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
        Schema::dropIfExists('why_choose_us');
    }
};
