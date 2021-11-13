<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_photo', function (Blueprint $table) {
            $table->id('photo_id');
            $table->foreignId('tour_id')->references('tour_id')->on('tour')->onDelete('cascade');
            $table->string('photo_path',500);
            $table->integer('photo_order')->nullable();
            $table->tinyInteger('cover')->default(0);
            $table->tinyInteger('gif')->default(0);
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
        Schema::dropIfExists('tour_photp');
    }
}
