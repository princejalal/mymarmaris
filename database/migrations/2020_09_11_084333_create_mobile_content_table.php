<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_content', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('lang_id')->references('lang_id')->on('language')->onDelete('cascade');
            $table->tinyInteger('editAble')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_content');
    }
}
