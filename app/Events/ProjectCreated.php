<?php

namespace App\Events;

use App\Models\Project;
use App\Models\Access;

use App\Models\TeamMember;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProjectCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $project;

    /**
     * Create a new event instance.
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;

        $accesses[] = [
            'user_id' => $this->project->created_by,
            'user_type' => $this->project->createdBy->user_type,
            'project_id' => $this->project->id,
            'story_id' => '',
            'task_id' => '',
        ];

        if(!empty($this->project->project_team)){
            $team_members = TeamMember::select('users.*')
                ->whereRaw("team_id in (".$this->project->project_team.")")
                ->join('users','users.id','=','team_members.user_id')
                ->get();
            if(count($team_members)>0){
                foreach($team_members as $team_member){
                    if($this->project->created_by != $team_member->id){
                        $accesses[] = ['user_id' => $team_member->id, 'user_type' => $team_member->user_type, 'project_id' => $this->project->id, 'story_id' => '', 'task_id' => '',];
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
