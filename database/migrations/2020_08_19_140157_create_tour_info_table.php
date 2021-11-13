<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_info', function (Blueprint $table) {
            $table->id('info_id');
            $table->foreignId('lang_id')->references('lang_id')->on('language')->onDelete('cascade');
            $table->foreignId('tour_id')->references('tour_id')->on('tour')->onDelete('cascade');
            $table->string('tour_name',300)->nullable();
            $table->string('tour_header',2000)->nullable();
            $table->string('url',1000)->nullable();
            $table->text('tour_difference')->nullable();
            $table->string('scrolling_text',2000)->nullable();
            $table->text('tour_explain')->nullable();
            $table->text('content')->nullable();
            $table->char('title',200)->nullable();
            $table->string('meta_desc',170)->nullable();
            $table->string('meta_tags',300)->nullable();
            $table->char('tour_phone',20)->nullable();
            $table->string('cloud_tags',600)->nullable();
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
        Schema::dropIfExists('tour_info');
    }
}
