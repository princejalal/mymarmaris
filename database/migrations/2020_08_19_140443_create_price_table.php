<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tour_price', function (Blueprint $table) {
            $table->id('price_id');
            $table->foreignId('tour_id')->references('tour_id')->on('tour')->onDelete('cascade');
            $table->foreignId('currency_id')->references('currency_id')->on('currency')->onDelete('cascade');
            $table->string('price');
            $table->enum('age_range',['infants','child','adult','passenger']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tour_price');
    }
}
