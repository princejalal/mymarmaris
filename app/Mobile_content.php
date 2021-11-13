<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobile_content extends Model {

    protected $table = 'mobile_content';

    protected $fillable = [
      'content','lang_id'
    ];


    public $timestamps = false;

}
