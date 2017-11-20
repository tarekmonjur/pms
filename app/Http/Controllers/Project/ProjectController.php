<?php

namespace App\Http\Controllers\Project;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Project/ProjectController
    |--------------------------------------------------------------------------
    |
    | @Description : Project Management Controller
    | @Author : IDDL.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $data['projects'] = Project::orderBy('id','desc')->get();
        return view('project.index')->with($data);
    }


    public function create()
    {
        return view('project.create');
    }



}
