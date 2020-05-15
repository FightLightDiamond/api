<?php

namespace App\Notifications;

use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\OneSignal\OneSignalWebButton;
use Illuminate\Notifications\Notification;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            ->subject("Your {$notifiable->service} account was approved!")
            ->body("Click here to see details.")
            ->url('http://onesignal.com')
            ->webButton(
                OneSignalWebButton::create('link-1')
                    ->text('Click here')
                    ->icon('https://upload.wikimedia.org/wikipedia/commons/4/4f/Laravel_logo.png')
                    ->url('http://laravel.com')
            );
    }
//
//    public function routeNotificationForOneSignal()
//    {
//        return 'ONE_SIGNAL_PLAYER_ID';
//    }
//
//    public function routeNotificationForOneSignal()
//    {
//        return ['email' => 'example@example.com'];
//    }
//
//    public function routeNotificationForOneSignal()
//    {
//        return ['tags' => ['key' => 'device_uuid', 'relation' => '=', 'value' => '1234567890-abcdefgh-1234567']];
//    }
}
