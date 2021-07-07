<?php

namespace App\Notifications;

use App\User;
use App\Ontology;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class UserNotification extends Notification
{
    use Queueable;

    protected $title, $message, $from, $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification)
    {   
        $this->title = $notification['title'];
        $this->message = $notification['message'];
        $this->from = $notification['from'];
        $this->type = $notification['type'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage);
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
            'title' => $this->title,
            'message'=> $this->message,
            'from' => $this->from,
            'type' => $this->type
        ];
    }
}
