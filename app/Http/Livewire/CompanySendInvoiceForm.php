<?php

namespace App\Http\Livewire;

use App\Mail\InvoiceMail;
use App\Models\InvoiceMessage;
use App\Models\InvoiceNessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CompanySendInvoiceForm extends LiveNotify
{
    public $invoice;
    public $to;
    public $from;
    public $subject;
    public $message;

    public function mount($invoice){
        $this->invoice = $invoice;
        $this->generateDefaultMessage();
    }

    public function generateDefaultMessage(){
        $this->subject = 'INVOICE NOTICE';
        $this->from    = $this->invoice->company->email;
    }

    public function updated($field){
        $this->validateOnly($field, [
           'to'            => 'required|email',
           'from'          => 'required|email',
           'subject'       => 'required|string|max:255',
           'message'       => 'required|string|max:4000'
        ]);
    }

    public function sendMessage(){
        $this->validate([
            'to'            => 'required|email',
            'from'          => 'required|email',
            'subject'       => 'required|string|max:255',
            'message'       => 'required|string|max:4000'
        ]);

        $data = [
          'to'          => $this->to,
          'from'        => $this->from,
          'subject'     => $this->subject,
          'message'     => $this->message
        ];

        // Send the message and keep a copy of the message in the database
        Mail::to($this->to)->send(new InvoiceMail($this->invoice, $data));

        InvoiceMessage::create([
            'user_id'       => Auth::user()->id,
            'to'            => $this->to,
            'from'          => $this->from,
            'subject'       => $this->subject,
            'message'       => $this->message
        ]);

        $this->reset();
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Invoice notice sent']);
    }

    public function render()
    {
        return view('livewire.company.components.company-send-invoice-form');
    }
}
