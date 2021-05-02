<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class TaskAssigned extends Notification
{
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'notification_text' => 'Une nouvelle tâche est assigné a vous.',
            'project_name' => $this->task->project->name_project,
            'project_id' => $this->task->project_id,
            'task_name' => $this->task->name,
            'task_id' => $this->task->id
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
