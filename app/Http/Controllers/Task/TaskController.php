<?php

namespace App\Http\Controllers\Task;

use App\Jobs\TaskCreateActivityJob;
use App\Jobs\TaskUpdateActivityJob;
use App\Models\Activity;
use App\Models\Project;
use App\Models\Story;
use App\Models\Task;
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
        return view('task.index')->with($data);
    }


    public function create(Request $request)
    {
        $data['projects'] = Project::orderBy('id','desc')->get();
        $data['users'] = User::orderBy('id','desc')->get();

        if(!empty($request->project)){
            $data['project_id'] = $request->project;
            $data['stories'] = Story::where('project_id', $request->project)->get();
        }else{
            $data['project_id'] = null;
            $data['stories'] = [];
        }
        $data['story_id'] = (!empty($request->story))?$request->story:null;

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
            'task_status' => 'required|max:255',
            'task_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
        ]);
        try {
            $task = new Task;
            $task->task_title = $request->task_title;
            $task->project_id = $request->project_name;
            $task->story_id = $request->story_name;
            $task->task_type = $request->task_type;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            $task->task_details = $request->task_details;
            $task->task_status = $request->task_status;
            $task->assign_by = $request->assign_by;
            $task->assign_to = $request->assign_to;
            if($request->hasFile('task_document')){
                $fileName = time().'.'.$request->task_document->extension();
                $uploadPath = public_path('uploads/tasks');
                $request->task_document->move($uploadPath, $fileName);
                $task->task_doc = $fileName;
            }
            $task->created_by = $this->auth->id;
            $task->save();

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
        $data['task'] = Task::with('comments.user', 'assignTo', 'assignBy')
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
            'task_status' => 'required|max:255',
            'task_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
        ]);

        try{
            $task = Task::find($request->task);
            $task->task_title = $request->task_title;
            $task->project_id = $request->project_name;
            $task->task_type = $request->task_type;
            $task->task_start_date = $request->task_start_date;
            $task->task_end_date = $request->task_end_date;
            $task->task_details = $request->task_details;
            $task->task_status = $request->task_status;
            $task->assign_by = $request->assign_by;
            $task->assign_to = $request->assign_to;
            if($request->hasFile('task_document')){
                $fileName = time().'.'.$request->task_document->extension();
                $uploadPath = public_path('uploads/tasks');
                $request->task_document->move($uploadPath, $fileName);
                $task->task_doc = $fileName;
            }
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


}
