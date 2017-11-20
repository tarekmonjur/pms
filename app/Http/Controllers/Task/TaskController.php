<?php

namespace App\Http\Controllers\Task;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Task/TaskController
    |--------------------------------------------------------------------------
    |
    | @Description : Task Management Controller
    | @Author : IDDL.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('task.index');
    }


    public function create()
    {
        $data['projects'] = Project::orderBy('id','desc')->get();
        $data['users'] = User::orderBy('id','desc')->get();
        return view('task.create')->with($data);
    }


}
