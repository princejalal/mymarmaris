<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinarionInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_info', function (Blueprint $table) {
            $table->id('info_id');
            $table->foreignId('destination_id')->references('destination_id')->on('destinations')->onDelete('cascade');
            $table->foreignId('lang_id')->references('lang_id')->on('language')->onDelete('cascade');
            $table->char('destination_name',200)->nullable();
            $table->string('url')->nullable();
            $table->string('header')->nullable();
            $table->string('menu_header')->nullable();
            $table->text('content')->nullable();
            $table->text('descripation')->nullable();
            $table->text('best_hotels')->nullable();
            $table->string('analya_airport_distance')->nullable();
            $table->string('gazipasa_airport_distance')->nullable();
            $table->string('analya_center_distance')->nullable();
            $table->string('antalya_distance_center')->nullable();
            $table->char('population')->nullable();
            $table->char('famous_beaches')->nullable();
            $table->string('nearby_place')->nullable();
            $table->string('shoping_center')->nullable();
            $table->string('public_baazar')->nullable();
            $table->string('info_text',2000)->nullable();
            $table->string('scrolling_text')->nullable();
            $table->string('title',200)->nullable();
            $table->string('meta_desc',170)->nullable();
            $table->string('meta_tags',300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destination_info');
    }
}
