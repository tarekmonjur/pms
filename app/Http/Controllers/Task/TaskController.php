<?php

namespace App\Http\Controllers\Task;

use App\Jobs\TaskCreateActivityJob;
use App\Jobs\TaskUpdateActivityJob;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Project;
use App\Models\Story;
use App\Models\Task;
use App\Models\TaskWork;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    protected $auth;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission')->except('taskWorkTracking');
        $this->middleware(function($request, $next){
            $this->auth = Auth::user();
            return $next($request);
        });
    }


    public function index($project,$story)
    {
        $data['tasks'] = Task::with('project','story','assignBy', 'assignTo')
            ->where('project_id', $project)
            ->where('story_id', $story)
            ->get();

        $data['project_id'] = $project;
        $data['story_id'] = $story;

        $data['project'] = Project::find($project);
        $data['story'] = Story::find($story);

        return view('task.index')->with($data);
    }


    public function create(Request $request)
    {
        $data['projects'] = Project::orderBy('id','desc')->get();

        if(!empty($request->story)){
            $data['story_id'] = $request->story;
            $data['story'] = Story::find($request->story);
            $data['members'] = $data['story']->members($data['story']->story_member);
            $data['users'] = $data['story']->members($data['story']->story_member.','.$this->auth->id);
        }else{
            $data['story_id'] = null;
            $data['story'] = (object)[];
            $data['users'] = $data['members'] = User::orderBy('id','desc')->get();
        }

        if(!empty($request->project)){
            $data['project_id'] = $request->project;
            $data['stories'] = Story::where('project_id', $request->project)->get();
            $data['project'] = Project::find($request->project);
        }else{
            $data['project_id'] = null;
            $data['stories'] = [];
            $data['project'] = (object)[];
        }

        return view('task.create')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required|max:255',
            'project_name' => 'required|max:255',
            'story_name' => 'required|max:255',
            'task_type' => 'required|max:255',
            'task_start_date' => 'required|date_format:Y-m-d',
            'task_end_date' => 'required|date_format:Y-m-d',
            'task_work_hour' => 'required|numeric|min:0',
            'task_status' => 'required|max:255',
            'task_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
            'assign_by' => 'required',
            'assign_to' => 'required',
        ]);
        try {
            $task = new Task;
            $task->task_title = $request->task_title;
            $task->project_id = $request->project_name;
            $task->story_id = $request->story_name;
            $task->task_type = $request->task_type;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            $task->task_work_hour = $request->task_work_hour;
            $task->task_details = $request->task_details;
            $task->task_status = $request->task_status;
            $task->assign_by = $request->assign_by;
            $task->assign_to = $request->assign_to;
            $task->created_by = $this->auth->id;
            $task->save();

            if($request->hasFile('task_document')){
                $fileName = time().'.'.$request->task_document->extension();
                $uploadPath = public_path('uploads/projects');
                $request->task_document->move($uploadPath, $fileName);
                $document = new Document;
                $document->project_id = $task->project_id;
                $document->story_id = $task->story_id;
                $document->task_id = $task->id;
                $document->document = $fileName;
                $document->save();
            }

            TaskCreateActivityJob::dispatch($task);

            $request->session()->flash('msg_success', 'Task successfully added.');
            return redirect()->back();
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Task not added.');
            return redirect()->back();
        }
    }


    public function show(Request $request)
    {
        $data['task'] = Task::with('works','documents.project','documents.story','documents.task','comments.user', 'assignTo', 'assignBy')
            ->where('project_id', $request->project)
            ->where('story_id', $request->story)
            ->find($request->task);

        $teams = User::get();
        $team_list = [];
        foreach($teams as $team){
            $team_list[] = [
                'id' => $team->id,
                'name' => $team->fullname,
                'avatar' => $team->fullphoto,
                'info'  => 'contact',
                'href' =>'#'
            ];
        }
        $data['teams'] = json_encode($team_list);
        $data['activities'] = Activity::where('task_id', (int)$request->task)->get();
//dd($data['activities']);
        return view('task.show')->with($data);
    }


    public function edit(Request $request)
    {
        $data['projects'] = Project::orderBy('id','desc')->get();
        $data['users'] = User::orderBy('id','desc')->get();
        $data['task'] = Task::find($request->task);
        $data['stories'] = Story::where('id', $data['task']->project_id)->get();
        return view('task.edit')->with($data);
    }


    public function update(Request $request)
    {
        $request->validate([
            'task_title' => 'required|max:255',
            'project_name' => 'required|max:255',
            'task_type' => 'required|max:255',
            'task_start_date' => 'required|date_format:Y-m-d',
            'task_end_date' => 'required|date_format:Y-m-d',
            'task_work_hour' => 'required|numeric|min:0',
            'task_status' => 'required|max:255',
            'task_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
            'assign_by' => 'required',
            'assign_to' => 'required',
        ]);

        try{
            $task = Task::find($request->task);
            $task->task_title = $request->task_title;
            $task->project_id = $request->project_name;
            $task->task_type = $request->task_type;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            $task->task_work_hour = $request->task_work_hour;
            $task->task_details = $request->task_details;
            $task->task_status = $request->task_status;
            $task->assign_by = $request->assign_by;
            $task->assign_to = $request->assign_to;
            $task->updated_by = $this->auth->id;
            $task->save();

            TaskUpdateActivityJob::dispatch($task);

            $request->session()->flash('msg_success', 'Task successfully updated.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Task not updated.');
            return redirect()->back();
        }
    }


    public function destroy(Request $request)
    {
        try{
            $task = Task::find($request->task);
            $task->delete();

            $fullname = $this->auth->fullname;
            $activity = "<a><strong>".$fullname."</strong></a> deleted <strong>".$task->task_title."</strong> task.";
            Activity::insert([
                'user_id' => $this->auth->id,
                'project_id' => $task->project_id,
                'story_id' => $task->story_id,
                'task_id' => $task->id,
                'activity' => $activity,
                'date' => date('Y-m-d h:i:s')
            ]);

            $request->session()->flash('msg_success', 'Task successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Task not deleted.');
            return redirect()->back();
        }
    }


    public function taskWorkTracking(Request $request)
    {
        if($request->status == "start")
        {
            $task_work = new TaskWork;
            $task_work->task_id = $request->task;
            $task_work->start_time = date("Y-m-d h:i:s");
            $task_work->save();

            Task::where('id', $request->task)->update(['task_status' => 'progress']);
            $request->session()->flash("msg_success", "Task time counter start.");
        }
        else if($request->status == "end")
        {
            $task_work = TaskWork::where('task_id', $request->task)->orderBy('id','desc')->first();
            $task_work->end_time = date("Y-m-d h:i:s");
            $diff = date_diff(date_create($task_work->start_time),date_create());
            $total_time = $diff->h.'.'.$diff->i;
            $task_work->total_time = $total_time;
            $task_work->save();

            Task::where('id', $request->task)->update(['task_status' => 'paused']);
            $request->session()->flash("msg_success", "Task time counter stop.");
        }else if($request->status == "done"){
            Task::where('id', $request->task)->update(['task_status' => 'done']);
            $request->session()->flash("msg_success", "Task status changed to Done.");
        }
        return redirect()->back();
    }


}
