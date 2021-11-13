<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour_program extends Model {

    protected $primaryKey = 'program_id';

    protected $table = 'tour_program';

    protected $fillable = [
      'tour_id','lang_id','tour_days','tour_hours','tour_includes','tour_excludes','dont_forget','tour_program'
    ];

}
