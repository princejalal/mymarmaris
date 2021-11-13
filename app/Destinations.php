<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destinations extends Model {

    protected $fillable = [
      'destination_name','image','map','order'
    ];

    protected $primaryKey = 'destination_id';


    public function DestInfo() {
        $this->hasMany('App\Destination_info','destination_id','destination_id');
    }
}
