<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_info', function (Blueprint $table) {
            $table->id('page_info_id');
            $table->foreignId('page_id')->references('page_id')->on('pages')->onDelete('cascade');
            $table->char('page_name');
            $table->foreignId('lang_id')->references('lang_id')->on('language');
            $table->string('header',3000);
            $table->string('url',200);
            $table->text('content');
            $table->text('description');
            $table->string('scrolling_text',3000);
            $table->char('title',180);
            $table->char('meta_desc',190);
            $table->string('meta_tags',400);
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
        Schema::dropIfExists('page_info');
    }
}
