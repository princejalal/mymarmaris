<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    protected $table= 'language';

    protected $primaryKey = 'lang_id';

    public $timestamps = false;

    protected $fillable = [
      'lang_name','lang_short_name','flag','lang_eng_name','currency_id'
    ];

}
