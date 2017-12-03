<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProjectUpdateActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $project;

    /**
     * Create a new job instance.
     *
     * @return void
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
        $fullname = ($this->project->updatedBy->fullname)?:'unknown user';
        $activity = "<a><strong>".$fullname."</strong></a> updated <strong>".$this->project->project_title."</strong> project.";
        Activity::insert([
            'user_id' => $this->project->updated_by,
            'project_id' => $this->project->id,
            'story_id' => null,
            'task_id' => null,
            'activity' => $activity,
            'date' => $this->project->updated_at
        ]);
    }
}
