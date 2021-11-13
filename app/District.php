<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model {
    protected $fillable = [
        'district_name','destination_id','image','map','order'
    ];

    protected $primaryKey = 'district_id';

    function distInfo(){

        $this->belongsTo('App\District_info','district_id','district_id');

    }

}
