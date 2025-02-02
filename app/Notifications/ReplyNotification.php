<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Model\Reply;

class ReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reply = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'reply_id' => $this->reply->id,
            'message' => 'New reply on your question.',
            'link' => $this->reply->question->path,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'reply_id' => $this->reply->id,
            'message' => 'New reply on your question.',
            'link' => $this->reply->question->path,
        ]);
    }
}
