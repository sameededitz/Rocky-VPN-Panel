<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetUrl;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $resetUrl
     * @return void
     */
    public function __construct($user, $resetUrl,$token)
    {
        $this->user = $user;
        $this->resetUrl = $resetUrl;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
            ->view('email.custom-password-reset')
            ->subject('Reset Your Password')
            ->with([
                'user' => $this->user,
                'resetUrl' => $this->resetUrl,
                'viewInBrowserUrl' => null,
            ]);
    }
}
