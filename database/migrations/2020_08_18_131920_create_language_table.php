<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->id('lang_id');
            $table->char('lang_name',100);
            $table->char('lang_eng_name',200);
            $table->char('lang_short_name');
            $table->char('flag',200);
            $table->integer('currency_id')->default(1);
            $table->tinyInteger('publish')->default(1);
        });


        DB::table('language')->insert([
            'lang_name' =>'engilish',
            'lang_eng_name' => 'engilish',
            'lang_short_name' => 'en',
            'flag' => '/content/images/united-kingdom.png'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language');
    }
}
