<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProjectCreateActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $project;

    /**
     * Create a new job instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fullname = ($this->project->createdBy->fullname)?:'unknown user';
        $activity = "<a><strong>".$fullname."</strong></a> created <strong>".$this->project->project_title."</strong> project.";
        Activity::insert([
            'user_id' => $this->project->created_by,
            'project_id' => $this->project->id,
            'story_id' => 0,
            'task_id' => 0,
            'activity' => $activity,
            'date' => $this->project->created_at
        ]);
    }
}
