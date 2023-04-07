<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Notifications\Notification;

use App\Models\{
    User,
    Post
};

class PostLikeNotification extends Notification implements ShouldBroadcast
{
    use Queueable;
    protected $user;
    protected $post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    
    public function toArray($notifiable)
    {
        return [
            'user_id'   =>$this->user->id,
            'user_name'   =>$this->user->name,
        ];
    }

    public function toBroadcast($notifiable){
        $notification = [
            "data" => [
                "user_name" => $this->user->name,
            ]
        ];

        return new BroadcastMessage([
            'notification' => $notification
        ]);
    }
}
