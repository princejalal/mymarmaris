<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMessengerTypesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('messenger_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->string('icon');
        });

        DB::table('messenger_types')->insert([
            [
                'name' => 'WhatsApp',
                'link' => 'https://wa.me/',
                'icon' => 'fab fa-whatsapp'
            ],
            [
                'name' => 'Facebook-Messenger',
                'link' => 'http://m.me/',
                'icon' => 'fab fa-facebook-messenger'
            ],
            [
                'name' => 'Telegram',
                'link' => 'https://t.me/',
                'icon' => 'fab fa-telegram-plane'
            ],
            [
                'name' => 'Viber',
                'link' => 'viber://chat?number=',
                'icon' => 'fab fa-viber'
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('messenger_types');
    }
}

