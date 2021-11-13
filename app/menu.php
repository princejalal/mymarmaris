<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model {

    protected $table= 'admin_menu';


    protected $primaryKey = 'menu_id';


    protected $fillable = [
      'menu_name','menu_icon','menu_position','eng_name','submenu','menu_link',
    ];


}
