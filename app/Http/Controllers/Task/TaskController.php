<?php

namespace App\Http\Controllers\Task;

use App\Models\Project;
use App\Models\Task;
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
        $data['tasks'] = Task::with('project', 'assignBy', 'assignTo')->orderBy('id','desc')->get();
        return view('task.index')->with($data);
    }


    public function create()
    {
        $data['projects'] = Project::orderBy('id','desc')->get();
        $data['users'] = User::orderBy('id','desc')->get();
        return view('task.create')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'task_title' => 'required|max:255',
            'project_name' => 'required|max:255',
            'task_type' => 'required|max:255',
            'task_start_date' => 'required|date_format:Y-m-d',
            'task_end_date' => 'required|date_format:Y-m-d',
            'task_status' => 'required|max:255',
            'task_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,ppt|max:4000',
        ]);
        try {
            $taks = new Task;
            $taks->task_title = $request->task_title;
            $taks->project_id = $request->project_name;
            $taks->task_type = $request->task_type;
            $taks->task_start_date = $request->task_start_date;
            $taks->task_end_date = $request->task_end_date;
            $taks->task_details = $request->task_details;
            $taks->task_status = $request->task_status;
            $taks->assign_by = $request->assign_by;
            $taks->assign_to = $request->assign_to;
            if($request->hasFile('task_document')){
                $fileName = time().'.'.$request->task_document->extension();
                $uploadPath = public_path('uploads/tasks');
                $request->task_document->move($uploadPath, $fileName);
                $taks->task_doc = $fileName;
            }
            $taks->save();

            $request->session()->flash('msg_success', 'Task successfully added.');
            return redirect('tasks');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Task not added.');
            return redirect()->back();
        }
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
            'task_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,ppt|max:4000',
        ]);

        try{
            $taks = Task::find($request->task);
            $taks->task_title = $request->task_title;
            $taks->project_id = $request->project_name;
            $taks->task_type = $request->task_type;
            $taks->task_start_date = $request->task_start_date;
            $taks->task_end_date = $request->task_end_date;
            $taks->task_details = $request->task_details;
            $taks->task_status = $request->task_status;
            $taks->assign_by = $request->assign_by;
            $taks->assign_to = $request->assign_to;
            if($request->hasFile('task_document')){
                $fileName = time().'.'.$request->task_document->extension();
                $uploadPath = public_path('uploads/tasks');
                $request->task_document->move($uploadPath, $fileName);
                $taks->task_doc = $fileName;
            }
            $taks->save();

            $request->session()->flash('msg_success', 'Task successfully updated.');
            return redirect('tasks');
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Task not updated.');
            return redirect()->back();
        }
    }


    public function destroy(Request $request)
    {
        try{
            Task::where('id', $request->task)->delete();
            $request->session()->flash('msg_success', 'Task successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Task not deleted.');
            return redirect()->back();
        }
    }


}
