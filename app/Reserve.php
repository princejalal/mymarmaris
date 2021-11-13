<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model {
    protected $primaryKey = 'reserve_id';

    protected $table = 'reserv_table';

    protected $fillable = [
      'name','email','phone','tour_date','adult','child','infant','room_number','pick_up_place','message','user_lang','ip_address','tour_id'
    ];
}
