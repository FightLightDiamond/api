<?php

namespace ACL\Notifications;

use App\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewAccountEmail extends Notification
{
    /**
     * The password
     *
     * @var string
     */
    public $password, $role;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($password, $role)
    {
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return [
            'mail'
        ];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->greeting('Hello!')
            ->line('You have been invited to join Ilab Test Management System as ' .
                $this->role.
                '. Below is your account detail: ')
            ->line('User email: '.$notifiable->email)
            ->line('User pasword: '.$this->password)
            ->line('Click below to login')
            ->action('Login', url('login'));
    }
}
