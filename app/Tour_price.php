<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_price extends Model {

    protected $primaryKey = 'price_id';
    protected $table = 'tour_price';
    protected $fillable = ['tour_id', 'currency_id', 'price', 'age_range'];
    public $timestamps = false;
}
