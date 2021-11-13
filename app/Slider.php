<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';


    protected $primaryKey = 'slider_id';

    protected $fillable = [
        'image','slider_name'
    ];


}
