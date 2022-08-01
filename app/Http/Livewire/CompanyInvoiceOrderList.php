<?php

namespace App\Http\Livewire;

use App\Models\InvoiceOrder;
use App\Models\InvoiceOrderCatalogue;
use App\Traits\EmailProvider;
use Livewire\Component;

class CompanyInvoiceOrderList extends LiveNotify
{
    use EmailProvider;

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
            $this->sendPipelineEmail($item->invoiceOrder->user, $item, 'SERVICE RESUMED',
                'Your service has been resumed, Thank you for trusting us.
            ');
        }

        if ($item->type == 'product'){
            $this->sendPipelineEmail($item->invoiceOrder->user, $item, 'ORDER CANCELLED',
                'Your order has has been cancelled, you can always re-order the item anytime,
            thanks for choosing us.
            ');
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
            $this->sendPipelineEmail($item->invoiceOrder->user, $item, 'SERVICE RESUMED',
                'Your service has been resumed, Thank you for trusting us.
            ');
        }

        if ($item->type == 'product'){
            $item->pipeline = 'order_in_progress';
            $this->sendPipelineEmail($item->invoiceOrder->user, $item, 'ORDER RESUMED',
                'Your order is now active, you will be notified when it is ready for shipping, thanks for choosing us.
            ');
        }

        $item->save();

        $this->emit('refreshOrderList');
        return $this->alert('success', 'Order resumed', 'Press ok to continue');
    }


    public function render()
    {
        return view('livewire.company.components.company-invoice-order-list');
    }
}
