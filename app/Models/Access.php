<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Access extends Model
{

    protected $connection = 'mongodb';

    protected $collection = 'accesses';


    public static function get_access_project_by_user_id($user_id)
    {
        return Access::where('user_id', $user_id)
            ->groupBy('project_id')
            ->pluck('project_id')
            ->toArray();
    }

    public static function get_access_story_by_user_id_project_id($user_id, $project_id)
    {
        return Access::where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->groupBy('story_id')
            ->pluck('story_id')
            ->toArray();
    }

    public static function get_access_task_by_user_id_story_id($user_id, $story_id)
    {
        return Access::where('user_id', $user_id)
            ->where('story_id', $story_id)
            ->groupBy('task_id')
            ->pluck('task_id')
            ->toArray();
    }

}
