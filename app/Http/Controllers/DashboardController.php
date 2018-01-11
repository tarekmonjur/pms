<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware(function($request, $next){
            $this->auth = Auth::user();
            return $next($request);
        });
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

        if(canAccess("projects")) {
            $data['projects'] = Project::with('tasks')->get();
        }else{
            $project_access = Access::get_access_project_by_user_id($this->auth->id);
            $data['projects'] = Project::with('tasks')->whereIn('id', $project_access)->get();
        }
        return view('dashboard')->with($data);
    }


}
