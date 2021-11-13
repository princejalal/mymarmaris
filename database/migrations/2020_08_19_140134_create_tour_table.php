<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour', function (Blueprint $table) {
            $table->id('tour_id');
            $table->string('tour_name',200);
            $table->integer('order')->nullable();
            $table->integer('class')->nullable();
            $table->integer('max_child')->nullable();
            $table->integer('min_child')->nullable();
            $table->tinyInteger('ShowRecommended')->defualt(0);
            $table->tinyInteger('mostPreferred')->defualt(0);
            $table->tinyInteger('no_child')->default(0);
            $table->tinyInteger('publish')->default(1);
            $table->integer('parent_id')->default(0);
            $table->enum('kind',['child','history','district','recreation','sea']);
            $table->string('tour_summary',3000)->nullable();
            $table->integer('tour_tag')->nullable();
            $table->integer('lng_id')->nullable();
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
        Schema::dropIfExists('tour');
    }
}
