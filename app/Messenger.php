<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;

    protected $fillable = [
      'value','lang_id','type_id'
    ];

    public function type()
    {
        return $this->belongsTo(Messenger_type::class,'type_id','id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class,'lang_id','lang_id');
    }

}
