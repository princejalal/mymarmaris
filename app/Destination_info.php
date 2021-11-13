<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination_info extends Model {

    protected $table = 'destination_info';

    protected $primaryKey = 'info_id';

    protected $fillable = [
        'destination_id','lang_id','destination_name','url','header','menu_header','content','descripation','best_hotels','antalya_distance_center',
        'analya_airport_distance','gazipasa_airport_distance','analya_center_distance','population','famous_beaches',
        'nearby_place','shoping_center','public_baazar','info_text','scrolling_text','title','meta_desc','meta_tags'
    ];

    public $timestamps = false;

}
