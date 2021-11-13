<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_info extends Model
{
    protected $table = 'site_info';


    protected $fillable = [
        'site_name','meta_desc','google_tag','favico','email','meta_tags','keywords','phone'
    ];

    public $timestamps = false;

}
