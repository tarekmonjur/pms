<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
