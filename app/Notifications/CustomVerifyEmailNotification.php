<?php

namespace App\Notifications;

use App\Mail\CustomEmailVerification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        return (new CustomEmailVerification($notifiable, $verificationUrl));
    }

    protected function verificationUrl($notifiable)
    {
        $signedUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.passwords.users.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification())
            ]
        );

        // Parse backend URL
        $parsed = parse_url($signedUrl);
        parse_str($parsed['query'], $query); // contains expires & signature
        $query['id'] = $notifiable->getKey();
        $query['hash'] = sha1($notifiable->getEmailForVerification());

        // Create clean frontend URL
        $frontendBase = config('app.frontend_url') . '/email-verify';
        return $frontendBase . '?' . http_build_query($query);
    }
}
