<?php

namespace App\Models;

use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $dispatchesEvents = [
        'saved' => TaskCreated::class
    ];


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

    public function story()
    {
        return $this->belongsTo('App\Models\Story');
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

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }

    public function works()
    {
        return $this->hasMany('App\Models\TaskWork');
    }
}
