<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class blogdelete extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $author_name, public $blog_title, public $link = null)

    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "title" => "Blog Deleted",
            "content" => $this->author_name . " ,your Blog is " . $this->blog_title . " deleted by the admin",
            "link" => $this->link,
            "link_text" => "Complete Your Profile",

        ];
    }
}
