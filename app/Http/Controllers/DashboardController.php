<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
     /*
     |--------------------------------------------------------------------------
     | Dashboard Controller
     |--------------------------------------------------------------------------
     |
     | @Description : Application Dashboard
     | @Author : IDDL.
     | @Email  : tarekmonjur@gmail.com
     |
     */

    /**
     * DashboardController constructor.
     */
    public function __construct(){
         $this->middleware('auth');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $data['total_project'] =  Project::count();
        $data['total_pending_project'] = Project::where('project_status', "pending")->count();
        $data['total_progress_project'] = Project::where('project_status', "progress")->count();
        $data['total_complete_project'] = Project::where('project_status', "done")->count();

        $data['total_task'] = Task::count();
        $data['total_pending_task'] = Task::where('task_status','pending')->count();
        $data['total_progress_task'] = Task::where('task_status','progress')->count();
        $data['total_complete_task'] = Task::where('task_status','done')->count();
        return view('dashboard')->with($data);
    }


}
