<?php

namespace App\Events;

use App\Models\Access;
use App\Models\Story;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StoryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $story;

    /**
     * Create a new event instance.
     *
     * @param Story $story
     */
    public function __construct(Story $story)
    {
        $this->story = $story;

        $accesses[] = [
            'user_id' => $this->story->created_by,
            'user_type' => $this->story->createdBy->user_type,
            'project_id' => $this->story->project_id,
            'story_id' => $this->story->id,
            'task_id' => 0,
        ];

        if(!empty($this->story->story_member)){
            $team_members = User::whereRaw("id in (".$this->story->story_member.")")->get();
            if(count($team_members)>0){
                foreach($team_members as $team_member){
                    if($this->story->created_by != $team_member->id) {
                        $accesses[] = ['user_id' => $team_member->id, 'user_type' => $team_member->user_type, 'project_id' => $this->story->project_id, 'story_id' => $this->story->id, 'task_id' => 0,];
                    }
                }
            }
        }

        Access::insert($accesses);

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
