<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_program', function (Blueprint $table) {
            $table->id('program_id');
            $table->foreignId('tour_id')->references('tour_id')->on('tour')->onDelete('cascade');
            $table->foreignId('lang_id')->references('lang_id')->on('language')->onDelete('cascade');
            $table->string('tour_days',1500)->nullable();
            $table->string('tour_hours',500)->nullable();
            $table->string('tour_includes',2000)->nullable();
            $table->string('tour_excludes',2000)->nullable();
            $table->string('dont_forget',2000)->nullable();
            $table->text('tour_program')->nullable();
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
        Schema::dropIfExists('tour_program');
    }
}
