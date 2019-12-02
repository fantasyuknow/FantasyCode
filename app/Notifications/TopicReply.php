<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reply;

class TopicReply extends Notification implements ShouldQueue
{
    use Queueable;

    public $reply;
    public $topic;
    public $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
        $this->topic = $this->reply->topic;
        $this->link  = route('topics.show', $this->reply->topic_id) . "?#reply{$this->reply->id}";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type'          => 'reply',
            'reply_id'      => $this->reply->id,
            'reply_content' => $this->reply->body,
            'user_id'       => $this->reply->user_id,
            'user_name'     => $this->reply->user->name,
            'user_avatar'   => $this->reply->user->userAvatar,
            'topic_link'    => $this->link,
            'topic_id'      => $this->topic->id,
            'topic_title'   => $this->topic->title,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('文章回复')
            ->line('有人给你的 <<' . $this->topic->title . '>> 评论哦！赶紧去瞧瞧吧~')
            ->action('查看回复', $this->link)
            ->line('感谢您使用FantasyCode');
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
