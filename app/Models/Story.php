<?php

namespace App\Models;

use App\Events\StoryCreated;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    protected $dispatchesEvents = [
        'saved' => StoryCreated::class
    ];


    public function createdBy(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }


    public function updatedBy(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }


    public function members($member_ids){
        if(!empty($member_ids)){
            return User::whereRaw("id in (".$member_ids.")")->get();
        }
    }


    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }


    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function documents(){
        return $this->hasMany('App\Models\Document');
    }
}
