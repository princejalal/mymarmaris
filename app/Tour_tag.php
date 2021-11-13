<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_tag extends Model {
    protected $primaryKey = 'tag_id';
    protected $table = 'tour_tag';
    protected $fillable = [
      'tag_name','parent','lang_id'
    ];

    public $timestamps = false;
}
