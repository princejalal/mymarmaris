<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id('page_id');
            $table->char('page_name',195);
            $table->tinyInteger('MainMenu')->default(0);
            $table->tinyInteger('showFooter')->default(0);
            $table->tinyInteger('showRightPage')->default(0);
            $table->integer('order')->nullable();
            $table->integer('static')->nullable();
            $table->enum('kind',['general','child','history','district','recreation','sea']);
            $table->tinyInteger('publish')->default(1);
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
        Schema::dropIfExists('pages');
    }
}
