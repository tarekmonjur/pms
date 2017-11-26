<?php

namespace App\Http\Controllers\Project;

use App\Models\Project;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    protected $auth;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->auth = Auth::user();
            return $next($request);
        });
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


    public function store(Request $request)
    {
        $request->validate([
           'project_title' => 'required|max:255',
           'project_start_date' => 'required|date_format:Y-m-d',
           'project_end_date' => 'required|date_format:Y-m-d',
            'project_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
            'project_status' => 'required',
        ]);
        try {
            $project = new Project;
            $project->project_title = $request->project_title;
            $project->project_start_date = $request->project_start_date;
            $project->project_end_date = $request->project_end_date;
            $project->project_status = $request->project_status;
            $project->project_details = $request->project_details;
            if($request->hasFile('project_document')){
                $fileName = time().'.'.$request->project_document->extension();
                $uploadPath = public_path('uploads/projects');
                $request->project_document->move($uploadPath, $fileName);
                $project->project_doc = $fileName;
            }
            $project->created_by = $this->auth->id;
            $project->save();

            $request->session()->flash('msg_success', 'Project successfully added.');
            return redirect()->back();
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Project not added.');
            return redirect()->back();
        }
    }


    public function show($project)
    {
        $data['project'] = Project::with('tasks', 'stories')->find($project);
//        $data['tasks'] = $data['project']->tasks()
//            ->selectRaw("task_title as title, DATE_FORMAT(task_start_date, '%Y,%m,%d') as start, DATE_FORMAT(task_end_date, '%Y,%m,%d') as end,
//            (CASE WHEN task_status = 'pending' THEN '#f39c12' WHEN task_status = 'progress' THEN '#00c0ef' WHEN task_status = 'postponed' THEN '#f56954' WHEN task_status = 'done' THEN '#00a65a' END) as backgroundColor")
//            ->get()->toJson();
        $tasks = [];
        foreach($data['project']->tasks as $task){
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
//        dd($tasks);
        $data['tasks'] = json_encode($tasks);
        return view('project.show')->with($data);
    }


    public function edit(Request $request)
    {
        if($request->ajax()){
            if($request->project) {
                $stories = Story::where('project_id', $request->project)->get();
                $html = "<option value=''>--- Select Story ---</option>";
                foreach ($stories as $story) {
                    $html .= "<option value=".$story->id.">".$story->story_title."</option>";
                }
            }else{
                $html = "<option value=''>--- No Story Found---</option>";
            }
            return $html;
        }

        $data['project'] = Project::find($request->project);
        return view('project.edit')->with($data);
    }


    public function update(Request $request)
    {
        $request->validate([
            'project_title' => 'required|max:255',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',
            'project_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
            'project_status' => 'required',
        ]);

        try{
            $project = Project::find($request->project);
            $project->project_title = $request->project_title;
            $project->project_start_date = $request->project_start_date;
            $project->project_end_date = $request->project_end_date;
            $project->project_status = $request->project_status;
            $project->project_details = $request->project_details;
            if($request->hasFile('project_document')){
                $fileName = time().'.'.$request->project_document->extension();
                $uploadPath = public_path('uploads/projects');
                $request->project_document->move($uploadPath, $fileName);
                $project->project_doc = $fileName;
            }
            $project->save();

            $request->session()->flash('msg_success', 'Project successfully updated.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Project not updated.');
            return redirect()->back();
        }
    }


    public function destroy(Request $request)
    {
        try{
            Project::where('id', $request->project)->delete();
            $request->session()->flash('msg_success', 'Project successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Project not deleted.');
            return redirect()->back();
        }
    }

}
