<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menu', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name')->unique();
            $table->string('menu_icon');
            $table->integer('menu_position')->default(1);
            $table->tinyInteger('publish')->default(1);
            $table->string('eng_name')->nullable();
            $table->tinyInteger('submenu')->default(0);
            $table->tinyInteger('editable')->default(1);
            $table->string('menu_link')->nullable();
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
        Schema::dropIfExists('admin_menu');
    }
}
