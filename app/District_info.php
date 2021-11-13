<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District_info extends Model {
    protected $table = 'district_info';

    protected $primaryKey = 'district_info_id';

    protected $fillable = ['district_id', 'lang_id', 'district_name', 'url', 'header', 'menu_header', 'content', 'descripation', 'scrolling_text', 'title', 'meta_desc', 'meta_tags'];

    public $timestamps = false;
}
