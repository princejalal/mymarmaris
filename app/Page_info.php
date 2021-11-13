<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page_info extends Model {

    protected $primaryKey = 'page_info_id';

    protected $table = 'page_info';

    protected $fillable = [
      'page_id','page_name','lang_id','header','url','content','description','scrolling_text','title','meta_desc','meta_tags'
    ];

}
