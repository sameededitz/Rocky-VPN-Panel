<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $verificationUrl
     * @return void
     */
    public function __construct($user, $verificationUrl)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewInBrowserUrl = route('email.verification.view', [
            'id' => $this->user->id,
            'hash' => sha1($this->user->getEmailForVerification()),
        ]);

        return $this->to($this->user->email)->view('email.custom-email-verfication')
            ->subject('Verify Your Email Address')
            ->with([
                'user' => $this->user,
                'verificationUrl' => $this->verificationUrl,
                'viewInBrowserUrl' => $viewInBrowserUrl,
            ]);
    }
}
