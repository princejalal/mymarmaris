<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model {

    protected $primaryKey = 'page_id';

    protected $table = 'pages';

    protected $fillable = [
      'page_name','MainMenu','showFooter','showRightPage',
        'order','static','publish','kind'
    ];


}
