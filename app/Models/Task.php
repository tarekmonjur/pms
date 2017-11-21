<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function assignBy()
    {
        return $this->belongsTo('App\Models\User', 'assign_by', 'id');
    }

    public function assignTo()
    {
        return $this->belongsTo('App\Models\User', 'assign_to', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\TaskComment');
    }
}
