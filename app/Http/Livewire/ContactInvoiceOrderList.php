<?php

namespace App\Http\Livewire;

use App\Models\InvoiceOrder;
use App\Models\InvoiceOrderCatalogue;
use Livewire\Component;

class ContactInvoiceOrderList extends LiveNotify
{
    public $invoice_id;
    public $orders = [];

    protected $listeners = [
        'delete'      =>  'cancelOrder',
        'refreshOrderList'   =>  '$refresh'
    ];


    public function mount($invoice_id){
        $this->invoice_id = $invoice_id;
        $this->fetchInvoiceOrders();
    }

    public function fetchInvoiceOrders(){
        $invoiceOrder = InvoiceOrder::where('invoice_id', $this->invoice_id)->first();
        if ($invoiceOrder){
            $this->orders = InvoiceOrderCatalogue::where('invoice_order_id', $invoiceOrder->id)->get();
        }
    }

    public function cancel($order_id){
        return $this->confirmDelete('warning', 'Do you want to cancel this order', 'Press ok to continue', $order_id);
    }

    public function cancelOrder($order_id){
        $item = InvoiceOrderCatalogue::find($order_id);
        if ($item->type == 'service'){
            $item->terminated = true;
        }
        $item->pipeline = 'cancelled';
        $item->save();

        $this->emit('refreshOrderList');
        return $this->alert('success', 'Order cancelled', 'Press ok to continue');
    }


    public function resume($order_id){
        $item = InvoiceOrderCatalogue::find($order_id);
        if ($item->type == 'service'){
            $item->terminated = false;
        }
        $item->pipeline = 'order_placed';
        $item->save();

        $this->emit('refreshOrderList');
        return $this->alert('success', 'Order resumed', 'Press ok to continue');
    }

    public function render()
    {
        return view('livewire.contact.components.contact-invoice-order-list');
    }
}
