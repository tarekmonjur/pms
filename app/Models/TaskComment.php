<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{

    public function getFullAttachAttribute(){
        if($this->attach) {
            return asset('/uploads/tasks/' . $this->attach);
        }else{
            return '';
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
