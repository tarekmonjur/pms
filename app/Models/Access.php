<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Access extends Model
{

    protected $connection = 'mongodb';

    protected $collection = 'accesses';

}
