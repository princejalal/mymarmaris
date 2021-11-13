<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_info extends Model {

    protected $primaryKey = 'info_id';

    protected $table = 'tour_info';

    protected $fillable = [
        'lang_id', 'tour_id', 'tour_name', 'tour_header', 'url', 'tour_difference', 'scrolling_text',
        'tour_explain', 'content', 'title', 'meta_desc', 'meta_tags', 'tour_phone', 'cloud_tags'
    ];

}
