<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUserAccountCreationMail extends Mailable
{
    use Queueable, SerializesModels;

    public object $user;
    public object $company;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $company
     */
    public function __construct($user, $company)
    {
        $this->user    = $user;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to crm')->markdown('emails.contact-user-account-creation', ['contact' => $this->user]);
    }
}
