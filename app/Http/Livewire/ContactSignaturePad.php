<?php

namespace App\Http\Livewire;

use App\Mail\ContactSignedInvoiceMail;
use App\Models\InvoiceContactSignature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ContactSignaturePad extends LiveNotify
{
    public $invoice;

    public $signature;

    protected $listeners = [
      'refreshContactInvoiceSignaturePad' => '$refresh',
      'acceptSignature'                   => 'submitSignature'
    ];


    public function submit()
    {
        $this->confirmContactSignatureRequest('warning', 'Do you want to submit your signature', 'Press ok to continue');
    }


    public function submitSignature()
    {

        if (!$this->signature){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Please enter your signature']);
        }
        $filename = Str::random(40).'.'.'png';
        \Storage::disk('signatures')->put($filename, base64_decode(Str::of($this->signature)->after(',')));

        // Save filename to databse
        InvoiceContactSignature::create([
            'invoice_id' =>  $this->invoice->id,
            'contact_id' =>  Auth::user()->contact->id,
            'filename'   =>  $filename
        ]);

        $this->invoice->signed = true;
        $this->invoice->save();


        // Mail the company of the signed invoice
        $data = [
            'user'          =>  Auth::user(),
            'subject'       => 'INVOICE SIGNED',
            'name'          => $this->invoice->company->name,
            'invoice'       => $this->invoice
        ];

        Mail::to($this->invoice->company->email)->send(new ContactSignedInvoiceMail($data));

        $this->emit('refreshContactInvoicePreview');
        $this->emit('refreshContactInvoiceSignaturePad');
        return $this->alert('success', 'Invoice signed', 'Press ok to continue');
    }

    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.contact.components.contact-signature-pad');
    }
}
