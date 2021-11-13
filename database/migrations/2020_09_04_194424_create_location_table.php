<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_table', function (Blueprint $table) {
            $table->integer('location_id');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
        });

        DB::table('location_table')->insert([
           'location_id'=>1
        ]);
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_table');
    }
}
