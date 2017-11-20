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


    public function store(Request $request)
    {
        $request->validate([
           'project_title' => 'required|max:255',
           'project_start_date' => 'required|date_format:Y-m-d',
           'project_end_date' => 'required|date_format:Y-m-d',
            'project_document' => 'nullable|mimes:jpg,jpeg,png,gif,pdf,doc,ppt|max:4000',
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
            $project->save();

            $request->session()->flash('msg_success', 'Project successfully added.');
            return redirect('projects');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Project not added.');
            return redirect()->back();
        }
    }


    public function edit(Request $request)
    {
        $data['project'] = Project::find($request->project);
        return view('project.edit')->with($data);
    }


    public function update(Request $request)
    {
        $request->validate([
            'project_title' => 'required|max:255',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',
            'project_document' => 'nullable|mimes:jpg,jpeg,png,gif,pdf,doc,ppt|max:4000',
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
            return redirect('projects');
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
