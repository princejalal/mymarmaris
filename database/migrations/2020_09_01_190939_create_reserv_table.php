<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserv_table', function (Blueprint $table) {
            $table->id('reserve_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('tour_date');
            $table->integer('adult');
            $table->integer('child');
            $table->integer('infant');
            $table->integer('room_number');
            $table->string('pick_up_place');
            $table->string('message');
            $table->char('user_lang');
            $table->char('ip_address');
            $table->tinyInteger('is_read')->default(0);
            $table->tinyInteger('confirm')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->foreignId('tour_id')->references('tour_id')->on('tour')->onDelete('cascade');
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
        Schema::dropIfExists('reserv_table');
    }
}
