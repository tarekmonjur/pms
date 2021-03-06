<?php

namespace App\Http\Controllers\Project;

use App\Jobs\ProjectCreateActivityJob;
use App\Jobs\ProjectUpdateActivityJob;
use App\Models\Access;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Project;
use App\Models\Story;
use App\Models\Task;
use App\Models\Team;
use App\Models\TeamMember;
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
//        $this->middleware('permission', ['only' => ['create']]);
        $this->middleware('permission')->except(["index", "show"]);
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
        if(canAccess("projects")) {
            $data['projects'] = Project::orderBy('id', 'desc')->get();
        }else{
            $project_access = Access::get_access_project_by_user_id($this->auth->id);
            $data['projects'] = Project::whereIn('id', $project_access)->orderBy('id', 'desc')->get();
        }
        return view('project.index')->with($data);
    }


    public function create()
    {
        $data['teams'] = Team::orderBy('id', 'desc')->get();
        return view('project.create')->with($data);
    }


    public function store(Request $request)
    {
        $request->validate([
           'project_title' => 'required|max:255',
           'project_teams' => 'required',
           'project_start_date' => 'required|date_format:Y-m-d',
           'project_end_date' => 'required|date_format:Y-m-d',
           'project_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
           'project_status' => 'required',
        ]);
        try {
            $project = new Project;
            $project->project_title = $request->project_title;
            $project->project_team = implode(',', $request->project_teams);
            $project->project_start_date = $request->project_start_date;
            $project->project_end_date = $request->project_end_date;
            $project->project_status = $request->project_status;
            $project->project_details = $request->project_details;
            $project->created_by = $this->auth->id;
            $project->save();

            if($request->hasFile('project_document')){
                $fileName = time().'.'.$request->project_document->extension();
                $uploadPath = public_path('uploads/projects');
                $request->project_document->move($uploadPath, $fileName);
                $document = new Document;
                $document->project_id = $project->id;
                $document->document = $fileName;
                $document->save();
            }

            ProjectCreateActivityJob::dispatch($project);

            $request->session()->flash('msg_success', 'Project successfully added.');
            return redirect()->back();
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Project not added.');
            return redirect()->back();
        }
    }


    public function show($project)
    {
        if(canAccess("projects/stories"))
        {
            $data['project'] = Project::with('documents.story','documents.task','stories','tasks')
                ->find($project);

            if(!$data['project']){return redirect('projects');}

            $calender_stories =  Task::with('story')->where('project_id', $project)
                ->selectRaw("story_id, MIN(task_start_date) as start_date, MAX(task_end_date) as end_date")
                ->groupBy('story_id')
                ->get();
        }
        else
        {
            $is_project_owner = (Project::where('created_by', $this->auth->id)->count() > 0) ? true : false;
            $project_access = Access::get_access_project_by_user_id($this->auth->id);

            if ($is_project_owner === false) {
                $story_access = Access::get_access_story_by_user_id_project_id($this->auth->id, $project);
            } else {
                $story_access = [];
            }

            $data['project'] = Project::with(['documents.story','documents.task','stories' => function($q)use($story_access, $is_project_owner){
                if($is_project_owner === false) {
                    $q->whereIn('id', $story_access);
                }
            },'tasks'])
                ->whereIn('id', $project_access)
                ->find($project);

            if(!$data['project']){return redirect('projects');}

            $calender_stories =  Task::with('story')
                ->where('project_id', $project);
            if($is_project_owner === false) {
                $calender_stories->whereIn('story_id', $story_access);
            }
            $calender_stories = $calender_stories->selectRaw("story_id, MIN(task_start_date) as start_date, MAX(task_end_date) as end_date")
                ->groupBy('story_id')
                ->get();
        }


        $calender_story = [];
        foreach($calender_stories as $story){
            $background = "";
            if($story->story->story_status == "pending"){
                $background = "#f39c12";
            }elseif($story->story->story_status == "progress"){
                $background = "#00c0ef";
            }elseif($story->story->story_status == "postponed"){
                $background = "#f56954";
            }elseif($story->story->story_status == "done"){
                $background = "#00a65a";
            }
            $calender_story[] = [
                'title' => $story->story->story_title,
                'start' => $story->start_date,
                'end' => $story->end_date,
                'backgroundColor' => $background,
                'story_id' => $story->story_id,
                'className' => 'task_event',
                'url' => url('projects/'.$project.'/stories/'.$story->story_id)
            ];
        }
        $data['activities'] = Activity::where('project_id', (int)$project)->get();
        $data['calender_story'] = json_encode($calender_story);

        $data['team_members'] = TeamMember::select('users.*')
            ->whereRaw("team_id in (".$data['project']->project_team.")")
            ->join('users','users.id','=','team_members.user_id')
            ->get();

        return view('project.show')->with($data);
    }


    public function edit(Request $request)
    {
        $data['teams'] = Team::orderBy('id', 'desc')->get();
        $data['project'] = Project::find($request->project);
        return view('project.edit')->with($data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'project_title' => 'required|max:255',
            'project_teams' => 'required',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',
            'project_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
            'project_status' => 'required',
        ]);

        try{
            $project = Project::find($request->project);
            $project->project_team = implode(',', $request->project_teams);
            $project->project_title = $request->project_title;
            $project->project_start_date = $request->project_start_date;
            $project->project_end_date = $request->project_end_date;
            $project->project_status = $request->project_status;
            $project->project_details = $request->project_details;
            $project->updated_by = $this->auth->id;
            $project->save();

            ProjectUpdateActivityJob::dispatch($project);

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
            $project = Project::find($request->project);
            $project->delete();

            $fullname = $this->auth->fullname;
            $activity = "<a><strong>".$fullname."</strong></a> deleted <strong>".$project->project_title."</strong> project.";
            Activity::insert([
                'user_id' => $this->auth->id,
                'project_id' => $project->id,
                'story_id' => null,
                'task_id' => null,
                'activity' => $activity,
                'date' => date('Y-m-d h:i:s')
            ]);

            $request->session()->flash('msg_success', 'Project successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Project not deleted.');
            return redirect()->back();
        }
    }

}
