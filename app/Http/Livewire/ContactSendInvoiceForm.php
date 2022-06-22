<?php

namespace App\Http\Livewire;

use App\Mail\ContactSendInvoiceMail;
use App\Mail\InvoiceMail;
use App\Models\InvoiceMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactSendInvoiceForm extends Component
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
        $this->to    = $this->invoice->company->email;
        $this->from  = $this->invoice->contactInfo->email;
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

        InvoiceMessage::create([
            'user_id'       => Auth::user()->id,
            'to'            => $this->to,
            'from'          => $this->from,
            'subject'       => $this->subject,
            'message'       => $this->message
        ]);

        // Send the invoice mail
        $data = [
            'to'            => $this->to,
            'from'          => $this->from,
            'user'          => Auth::user(),
            'subject'       => $this->subject,
            'message'       => $this->message,
            'name'          => $this->invoice->company->name,
            'invoice'       => $this->invoice
        ];

        Mail::to($this->to)->send(new ContactSendInvoiceMail($data));

        $this->reset(['message']);
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Invoice notice sent']);
    }

    public function render()
    {
        return view('livewire.contact.components.contact-send-invoice-form');
    }
}
