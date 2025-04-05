<?php

namespace App\Notifications;

use App\Mail\CustomResetPassword;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct()
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $resetUrl = $this->resetUrl($notifiable);
        return (new CustomResetPassword($notifiable, $resetUrl, $this->token));
    }

    /**
     * Generate the reset URL.
     */
    protected function resetUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'password.reset',
            Carbon::now()->addMinutes(Config::get('auth.passwords.users.expire')),
            [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]
        );
    }
}
