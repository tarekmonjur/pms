<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    public function createdBy(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function stories()
    {
        return $this->hasMany('App\Models\Story');
    }


}
