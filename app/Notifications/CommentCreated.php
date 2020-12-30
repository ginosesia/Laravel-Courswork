<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use App\Post;
use App\Comment;


class CommentCreated extends Notification
{
    use Queueable;
    public $user;
    public $post;
    public $comment;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post, Comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->post = $post;

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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Commented on your post.')
            ->subject('New Comment')
            ->action('Open Post', url('/posts'));
    }



    public function toBroadcast($notifiable)
    {
        return [
            
        ];
    }

    public static function query() {

        return 3;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            'comment_id' => $this->comment->id,
            'data' => [
                'name' => $this->user->name,
                'date' => $this->comment->created_at,
                'email' => $this->user->email,
                'post' => $this->comment->post_id,
                'body' => $this->comment->comment,
            ],
            'message' => $this->user->name. ' commented on your post',
        ];

    }
}