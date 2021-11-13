<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model {

    protected $primaryKey = 'tour_id';

    protected $table = 'tour';

    protected $fillable = [
        'max_child',
        'tour_name',
        'order',
        'class',
        'min_child',
        'no_child',
        'destination_id',
        'district_id',
        'publish',
        'parent_id',
        'tour_summary',
        'ShowRecommended',
        'mostPreferred',
        'lng_id',
        'kind'
    ];


    public function photo() {
        return $this->belongsTo('App\Photo', 'tour_id', 'tour_id');
    }

    public function info() {
        return $this->belongsTo('App\Tour_info', 'tour_id', 'tour_id');
    }

    public function price() {
        return $this->belongsTo('App\Tour_price', 'tour_id', 'tour_id');
    }

    public function program() {
        return $this->belongsTo('App\Tour_program', 'tour_id', 'tour_id');
    }

}
