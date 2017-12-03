<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\TaskComment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CommentUpdateActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task_comment;

    /**
     * Create a new job instance.
     *
     * @param TaskComment $task_comment
     */
    public function __construct(TaskComment $task_comment)
    {
        $this->task_comment = $task_comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fullname = ($this->task_comment->user->fullname)?:'unknown user';
        $task = $this->task_comment->task;
        $activity = "<a><strong>".$fullname."</strong></a> updated <strong>".$task->task_title."</strong> comments.";
        Activity::insert([
            'user_id' => $this->task_comment->user_id,
            'project_id' => $task->project_id,
            'story_id' => $task->story_id,
            'task_id' =>$task->id,
            'activity' => $activity,
            'date' => $this->task_comment->updated_at
        ]);
    }
}
