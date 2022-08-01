<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecurringChargeStatusEmailForOfflineContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $settings;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $company
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['email_title'])->markdown('emails.recurring-charge-status-for-contact');
    }
}
