<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

    protected $primaryKey = 'photo_id';

    protected $table = 'tour_photo';

    protected $fillable = [
      'tour_id','gif','cover','photo_path','photo_order'
    ];


}
