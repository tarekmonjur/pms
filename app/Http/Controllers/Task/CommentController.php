<?php

namespace App\Http\Controllers\Task;

use App\Jobs\CommentCreateActivityJob;
use App\Jobs\CommentUpdateActivityJob;
use App\Models\Activity;
use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Task/CommentController
    |--------------------------------------------------------------------------
    |
    | @Description : Task Comment Management Controller
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


    public function index($task){
        $data['task'] = Task::with('comments.user', 'assignTo', 'assignBy')->find($task);
        return view('task.comment')->with($data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comments' => 'required',
            'comment_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
        ]);

        if($validator->fails()){
            $data['task'] = Task::with('comments.user', 'assignTo', 'assignBy')->find($request->task);
            return view('task.comment')->withErrors($validator)->with($data);
        }
        else
        {
            $task_comment = new TaskComment;
            $task_comment->task_id = $request->task;
            $task_comment->user_id = $this->auth->id;
            $task_comment->comments = $request->comments;
            if ($request->hasFile('comment_document')) {
                $fileName = time() . '.' . $request->comment_document->extension();
                $uploadPath = public_path('uploads/tasks');
                $request->comment_document->move($uploadPath, $fileName);
                $task_comment->attach = $fileName;
            }
            $task_comment->save();

            CommentCreateActivityJob::dispatch($task_comment);

            return $this->index($request->task);
        }
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comments' => 'required',
            'comment_document' => 'nullable|mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
        ]);

        if($validator->fails()){
            $data['task'] = Task::with('comments.user', 'assignTo', 'assignBy')->find($request->task);
            return view('task.show')->withErrors($validator)->with($data);
        }
        else
        {
            $task_comment = TaskComment::find($request->comment_id);
            $task_comment->user_id = $this->auth->id;
            $task_comment->comments = $request->comments;
            if ($request->hasFile('comment_document')) {
                $fileName = time() . '.' . $request->comment_document->extension();
                $uploadPath = public_path('uploads/tasks');
                $request->comment_document->move($uploadPath, $fileName);
                $task_comment->attach = $fileName;
            }
            $task_comment->save();

            CommentUpdateActivityJob::dispatch($task_comment);

            return $this->index($request->task);
        }
    }


    public function destroy(Request $request)
    {
        $task_comment = TaskComment::find($request->comment);
        $task_comment->delete();

        $task = $task_comment->task;
        $fullname = $this->auth->fullname;
        $activity = "<a><strong>".$fullname."</strong></a> deleted <strong>".$task->task_title."</strong> comments.";
        Activity::insert([
            'user_id' => $this->auth->id,
            'project_id' => $task->project_id,
            'story_id' => $task->story_id,
            'task_id' => $task->id,
            'activity' => $activity,
            'date' => date('Y-m-d h:i:s')
        ]);


        return $this->index($request->task);
    }

}
