<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DocumentController
    |--------------------------------------------------------------------------
    |
    | @Description : Document Management Controller
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


    public function documentUpload(Request $request)
    {
        $request->validate([
            'document' => 'mimes:jpg,jpeg,png,gif,psd,pdf,doc,docx,pptx|max:4000',
        ]);

        try {
            if ($request->hasFile('document')) {
                if ($request->has('project_id')) {
                    if ($request->has('story_id')) {
                        if ($request->has('task_id')) {
                            $task = new Document;
                            $task->project_id = $request->project_id;
                            $task->story_id = $request->story_id;
                            $task->task_id = $request->task_id;
                            $task->document = $this->upload($request);
                            $task->save();
                            $request->session()->flash('msg_success', 'Task document successfully upload.');
                        } else {
                            $story = new Document;
                            $story->project_id = $request->project_id;
                            $story->story_id = $request->story_id;
                            $story->document = $this->upload($request);
                            $story->save();
                            $request->session()->flash('msg_success', 'Story document successfully upload.');
                        }
                    } else {
                        $project = new Document;
                        $project->project_id = $request->project_id;
                        $project->document = $this->upload($request);
                        $project->save();
                        $request->session()->flash('msg_success', 'Project document successfully upload.');
                    }
                }
            }
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Document not upload.');
        }

        return redirect()->back();
    }


    private function upload($request)
    {
        if($request->has('document_name') && !empty($request->document_name)){
            $string = str_replace(' ', '-', $request->document_name);
            $fileName =  preg_replace('/[^A-Za-z0-9\-]/', '', $string).'.'.$request->document->extension();
        }else {
            $fileName = time() . '.' . $request->document->extension();
        }
        $uploadPath = public_path('uploads/projects');
        $request->document->move($uploadPath, $fileName);
        return $fileName;
    }


    public function destroy(Request $request)
    {
        try{
            $document = Document::find($request->id);
            if($document){
                $file = public_path('uploads/projects/'.$document->document);
                if(file_exists($file))
                    unlink($file);

                $document->delete();
            }
            $request->session()->flash('msg_success', 'Document successfully deleted.');
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Document not deleted.');
        }
        return redirect()->back();
    }

}
