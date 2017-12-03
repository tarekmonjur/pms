<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    public function createdBy(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }


    public function updatedBy(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }


    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }


    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
