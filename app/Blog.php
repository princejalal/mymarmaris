<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model {
    protected $primaryKey = 'blog_id';

    protected $table = 'blog';

    protected $fillable = [
      'title','content','summary',
        'image','view','lang_id','destination_id'
    ];

}
