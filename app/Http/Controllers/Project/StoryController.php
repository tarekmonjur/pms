<?php

namespace App\Http\Controllers\Project;

use App\Models\Story;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Project/StoryController
    |--------------------------------------------------------------------------
    |
    | @Description : Story Management Controller
    | @Author : IDDL.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    protected $auth;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->auth = Auth::user();
            return $next($request);
        });
    }


    public function index()
    {

    }


    public function store(Request $request, $project)
    {
        try {
            $story = new Story;
            $story->project_id = $project;
            $story->story_title = $request->story_title;
            $story->story_status = $request->story_status;
            $story->story_details = $request->story_details;
            $story->created_by = $this->auth->id;
            $story->save();

            $request->session()->flash('msg_success', 'Story successfully added.');
            return redirect()->back();
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Story not added.');
            return redirect()->back();
        }
    }


    public function show($project, $story)
    {
        $data['story'] = Story::with('project','tasks','tasks.assignBy', 'tasks.assignTo')->find($story);
        $story_start_end =  Task::with('story')->where('story_id', $story)->selectRaw("story_id, MIN(task_start_date) as start_date, MAX(task_end_date) as end_date")->groupBy('story_id')->first();

        if($story_start_end) {
            $calender_tasks = [];
            $data['story_start'] = $story_start_end->start_date;
            $data['story_end'] = $story_start_end->end_date;
            foreach ($data['story']->tasks as $task) {
                $background = "";
                if ($task->task_status == "pending") {
                    $background = "#f39c12";
                } elseif ($task->task_status == "progress") {
                    $background = "#00c0ef";
                } elseif ($task->task_status == "postponed") {
                    $background = "#f56954";
                } elseif ($task->task_status == "done") {
                    $background = "#00a65a";
                }
                $calender_tasks[] = ['title' => $task->task_title,
                    'start' => $task->task_start_date,
                    'end' => $task->task_end_date,
                    'backgroundColor' => $background,
                    'className' => 'task_event',
                    'url' => url('projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)
                ];
            }
            $data['calender_tasks'] = json_encode($calender_tasks);
        }else{
            $data['story_start'] = '';
            $data['story_end'] = '';
            $data['calender_tasks'] = json_encode([]);
        }

        return view('story.show')->with($data);
    }


    public function edit($project, $story)
    {
        $data['story'] = Story::find($story);
        return view('story.edit')->with($data);
    }


    public function update(Request $request)
    {
        try {
            $story = Story::find($request->story);
            $story->project_id = $request->project_id;
            $story->story_title = $request->story_title;
            $story->story_status = $request->story_status;
            $story->story_details = $request->story_details;
            $story->updated_by = $this->auth->id;
            $story->save();

            $request->session()->flash('msg_success', 'Story successfully Updated.');
            return redirect()->back();
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Story not Updated.');
            return redirect()->back();
        }
    }


    public function destroy(Request $request)
    {
        try{
            Story::where('id', $request->story)->delete();
            $request->session()->flash('msg_success', 'Story successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Story not deleted.');
            return redirect()->back();
        }
    }



}
