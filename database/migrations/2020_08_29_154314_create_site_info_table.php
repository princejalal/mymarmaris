<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateSiteInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_info', function (Blueprint $table) {
            $table->integer('id');
            $table->string('site_name')->nullable();
            $table->string('phone',30)->nullable();
            $table->string('meta_desc',200)->nullable();
            $table->string('google_tag')->nullable();
            $table->string('favico',200)->nullable();
            $table->string('email',200)->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('keywords')->nullable();
        });

        DB::table('site_info')->insert([
           'site_name' => env('SITE_NAME')
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_info');
    }
}
