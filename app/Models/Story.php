<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }


    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
