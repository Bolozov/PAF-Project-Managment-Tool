<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class TaskSubmittedForValidation extends Notification
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
            'notification_text' => ' a soumis une demande de validation pour la tâche: ',
            'task_name' => $this->task->name,
            'task_id' => $this->task->id,
            'username' => $this->task->user->name,
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
