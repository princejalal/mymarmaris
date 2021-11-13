<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

    protected $primaryKey = 'currency_id';

    protected $table = 'currency';

    protected $fillable = ['currency_name', 'country', 'currency_icon'];

    public $timestamps = false;

}
