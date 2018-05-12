<?php

namespace App\Events;

use App\Models\Access;
use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $task;

    /**
     * Create a new event instance.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;

        $accesses = [
            [
                'user_id' => $this->task->created_by,
                'user_type' => $this->task->createdBy->user_type,
                'project_id' => $this->task->project_id,
                'story_id' => $this->task->story_id,
                'task_id' => $this->task->id,
            ],
            [
                'user_id' => $this->task->assign_by,
                'user_type' => $this->task->assignBy->user_type,
                'project_id' => $this->task->project_id,
                'story_id' => $this->task->story_id,
                'task_id' => $this->task->id,
            ],
            [
                'user_id' => $this->task->assign_to,
                'user_type' => $this->task->assignTo->user_type,
                'project_id' => $this->task->project_id,
                'story_id' => $this->task->story_id,
                'task_id' => $this->task->id,
            ]
        ];

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
