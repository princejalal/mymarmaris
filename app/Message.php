<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $primaryKey = 'message_id';

    protected $fillable = [
      'name','email','phone','message','user_lang','ip_address'
    ];


    protected $table = 'messages';

}
