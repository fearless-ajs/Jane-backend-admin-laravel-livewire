<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUserAccountCreationMail extends Mailable
{
    use Queueable, SerializesModels;

    public object $user;
    public object $company;
    public $settings;

    /**
     * Create a new message instance.
     *
     * @param $user
     *
     * @param $company
     */
    public function __construct($user, $company)
    {
        $this->user    = $user;
        $this->company = $company;
        $this->settings = Setting::first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->settings->app_name)->markdown('emails.contact-user-account-creation', ['contact' => $this->user]);
    }
}
