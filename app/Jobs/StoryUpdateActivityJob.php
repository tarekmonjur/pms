<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\Story;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoryUpdateActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $story;

    /**
     * Create a new job instance.
     *
     * @param Story $story
     */
    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fullname = ($this->story->updatedBy->fullname)?:'unknown user';
        $activity = "<a><strong>".$fullname."</strong></a> updated <strong>".$this->story->story_title."</strong> story.";
        Activity::insert([
            'user_id' => $this->story->updated_by,
            'project_id' => $this->story->project_id,
            'story_id' => $this->story->id,
            'task_id' => 0,
            'activity' => $activity,
            'date' => $this->story->updated_at
        ]);
    }
}
