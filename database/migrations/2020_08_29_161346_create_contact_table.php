<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contact_info', function (Blueprint $table) {
            $table->id('contact_id');
            $table->foreignId('lang_id')->references('lang_id')->on('language');
            $table->char('name');
            $table->string('contact_value');
            $table->enum('kind', ['Phone', 'socialMedia', 'email', 'DefaultMessage','address']);
            $table->tinyInteger('showOnTop')->default(0);
            $table->tinyInteger('ShowOnFooter')->default(0);
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contact_info');
    }
}
