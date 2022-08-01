<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->data = [
            'email_title'   =>  'ACCOUNT VERIFICATION LINK'
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('ACCOUNT VERIFICATION LINK')->markdown('emails.email-verification-link');
    }
}
