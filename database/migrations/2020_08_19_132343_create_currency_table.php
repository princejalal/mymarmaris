<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->id('currency_id');
            $table->char('currency_name',200);
            $table->char('country',200);
            $table->char('currency_icon')->nullable();
        });


        \Illuminate\Support\Facades\DB::table('currency')->insert([
           'currency_name'=>'dollar',
           'country'=>'US',
           'currency_icon'=>'fas fa-dollor-sign'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency');
    }
}
