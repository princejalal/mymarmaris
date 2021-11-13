<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_info extends Model {
     protected $table = 'contact_info';

     protected $primaryKey = 'contact_id';

     protected $fillable = [
        'lang_id','name','kind','contact_value'
     ];
}
