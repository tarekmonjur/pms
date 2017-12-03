<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Activity extends Model
{

    protected $connection = 'mongodb';

    protected $collection = 'activities';

//    public function user(){
//        return $this->belongsTo('App\Models\User', 'user_id', 'id');
//    }
}
