<?php

namespace App\Http\Controllers\Project;

use App\Jobs\StoryCreateActivityJob;
use App\Jobs\StoryUpdateActivityJob;
use App\Models\Access;
use App\Models\Activity;
use App\Models\Story;
use App\Models\Task;
use App\Models\TeamMember;
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
//        $this->middleware('permission')->except('store');
        $this->middleware('permission');
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
            $story->story_member = implode(',', $request->story_member);
            $story->story_status = $request->story_status;
            $story->story_details = $request->story_details;
            $story->created_by = $this->auth->id;
            $story->save();

            StoryCreateActivityJob::dispatch($story);

            $request->session()->flash('msg_success', 'Story successfully added.');
            return redirect()->back();
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Story not added.');
            return redirect()->back();
        }
    }


    public function show($project, $story)
    {
        $story_access = Access::get_access_story_by_user_id_project_id($this->auth->id, $project);
        $task_access = Access::get_access_task_by_user_id_story_id($this->auth->id, $story);

        $data['story'] = Story::with(['documents','project','tasks'=>function($q)use($task_access){
                $q->whereIn('id', $task_access);
            },'tasks.assignBy', 'tasks.assignTo'])
            ->whereIn('id', $story_access)
            ->find($story);

        if(!$data['story']){return redirect()->back();}

        $story_start_end =  Task::with('story')
            ->where('story_id', $story)
            ->whereIn('id', $task_access)
            ->selectRaw("story_id, MIN(task_start_date) as start_date, MAX(task_end_date) as end_date")
            ->groupBy('story_id')
            ->first();

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
        $data['activities'] = Activity::where('story_id', (int)$story)->get();
        return view('story.show')->with($data);
    }


    public function edit($project, $story)
    {
        $data['story'] = Story::with('project')->find($story);
        $data['team_members'] = TeamMember::select('users.*')
            ->whereRaw("team_id in (".$data['story']->project->project_team.")")
            ->join('users','users.id','=','team_members.user_id')
            ->get();
        return view('story.edit')->with($data);
    }


    public function update(Request $request)
    {
        try {
            $story = Story::find($request->story);
            $story->project_id = $request->project_id;
            $story->story_title = $request->story_title;
            $story->story_member = implode(',', $request->story_member);
            $story->story_status = $request->story_status;
            $story->story_details = $request->story_details;
            $story->updated_by = $this->auth->id;
            $story->save();

            StoryUpdateActivityJob::dispatch($story);

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
            $story = Story::find($request->story);
            $story->delete();

            $fullname = $this->auth->fullname;
            $activity = "<a><strong>".$fullname."</strong></a> deleted <strong>".$story->story_title."</strong> story.";
            Activity::insert([
                'user_id' => $this->auth->id,
                'project_id' => $story->project_id,
                'story_id' => $story->id,
                'task_id' => null,
                'activity' => $activity,
                'date' => date('Y-m-d h:i:s')
            ]);

            $request->session()->flash('msg_success', 'Story successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Story not deleted.');
            return redirect()->back();
        }
    }



}
