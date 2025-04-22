<?php

namespace App\Notifications;

use App\Mail\CustomResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        return config('app.frontend_url') . '/reset-password?token=' . $this->token . '&email=' . urlencode(encrypt($notifiable->getEmailForPasswordReset()));
    }
}
