<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function story(){
        return $this->belongsTo('App\Models\Story');
    }

    public function task(){
        return $this->belongsTo('App\Models\Task');
    }


}
