<?php

namespace App\Models;

use App\Events\ProjectCreated;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $dispatchesEvents = [
        'saved' => ProjectCreated::class
    ];


    public function createdBy(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy(){
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function teams($team_ids){
        if(!empty($team_ids)){
            return Team::whereRaw("id in (".$team_ids.")")->get();
        }
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function stories()
    {
        return $this->hasMany('App\Models\Story');
    }

    public function documents(){
        return $this->hasMany('App\Models\Document');
    }


}
