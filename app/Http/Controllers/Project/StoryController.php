<?php

namespace App\Http\Controllers\Project;

use App\Models\Story;
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


    public function store(Request $request)
    {
        try {
            $story = new Story;
            $story->project_id = $request->project_id;
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


    public function show($story)
    {
        $data['story'] = Story::with('project','tasks')->find($story);
        $data['project'] = $data['story']->project;

        $tasks = [];
        foreach($data['story']->tasks as $task){
            $background = "";
            if($task->task_status == "pending"){
                $background = "#f39c12";
            }elseif($task->task_status == "progress"){
                $background = "#00c0ef";
            }elseif($task->task_status == "postponed"){
                $background = "#f56954";
            }elseif($task->task_status == "done"){
                $background = "#00a65a";
            }
            $tasks[] = [
                'title' => $task->task_title,
                'start' => $task->task_start_date,
                'end' => $task->task_end_date,
                'backgroundColor' => $background,
                'task_id' => $task->id,
                'className' => 'task_event'
            ];
        }
        $data['tasks'] = json_encode($tasks);
//        dd($data);
        return view('story.show')->with($data);
    }


    public function edit(Request $request, $story)
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
