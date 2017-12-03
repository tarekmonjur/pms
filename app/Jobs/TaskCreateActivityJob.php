<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TaskCreateActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;

    /**
     * Create a new job instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fullname = ($this->task->createdBy->fullname)?:'unknown user';
        $activity = "<a><strong>".$fullname."</strong></a> created <strong>".$this->task->task_title."</strong> task.";
        Activity::insert([
            'user_id' => $this->task->created_by,
            'project_id' => $this->task->project_id,
            'story_id' => $this->task->story_id,
            'task_id' => $this->task->id,
            'activity' => $activity,
            'date' => $this->task->created_at
        ]);
    }
}
