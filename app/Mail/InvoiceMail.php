<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param $invoice
     * @param $data
     */
    public function __construct($invoice, $data)
    {
        $this->invoice = $invoice;
        $this->data    = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['subject'])->from($this->data['from'])->markdown('emails.invoice-notice');
    }
}
