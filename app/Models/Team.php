<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function createdBy(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function members(){
        return $this->hasMany('App\Models\TeamMember');
    }
}
