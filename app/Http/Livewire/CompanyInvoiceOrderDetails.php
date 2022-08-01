<?php

namespace App\Http\Livewire;

use App\Traits\EmailProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyInvoiceOrderDetails extends LiveNotify
{
    use EmailProvider;
    public $item;

    protected $listeners = [
        'delete'      =>  'cancelOrder',
        'refreshOrderDetails'   =>  '$refresh'
    ];

    public function mount($item){
        $this->item = $item;
    }

    public function cancel($order_id){
        return $this->confirmDelete('warning', 'Do you want to cancel this order', 'Press ok to continue', $order_id);
    }


    public function cancelService(){
        $this->item->pipeline = 'cancelled';
        $this->item->terminated = true;

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'SERVICE TERMINATED',
            'Your service has been terminated, You can always resume anytime, Thanks for choosing us.
            ');

        $this->item->save();

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Service cancelled', 'Press ok to continue');
    }

    public function resumeService(){
        $this->item->pipeline = 'order_in_progress';
        $this->item->terminated = false;

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'SERVICE RESUMED',
            'Your service has been resumed, Thank you for trusting us.
            ');

        $this->item->save();

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Service resumed', 'Press ok to continue');
    }

    public function cancelOrder($order_id){
        $this->item->pipeline = 'cancelled';
        $this->item->save();

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'ORDER CANCELLED',
            'Your order has has been cancelled, you can always re-order the item anytime,
            thanks for choosing us.
            ');

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order cancelled', 'Press ok to continue');
    }

    public function resume($order_id){
        $this->item->pipeline = 'order_in_progress';
        $this->item->save();

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'ORDER RESUMED',
            'Your order is now active, you will be notified when it is ready for shipping, thanks for choosing us.
            ');

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order resumed', 'Press ok to continue');
    }


    public function confirmOrder(){
        $this->item->pipeline = 'order_in_progress';
        $this->item->save();

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'ORDER CONFIRMED',
            'Your order has been confirmed successfully, you will be notified when it is ready for shipping.
            ');

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order confirmed', 'Press ok to continue');
    }

    public function shipOrder(){
        $this->item->pipeline = 'shipped';
        $this->item->save();

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'ODER READY FOR SHIPPING',
            'Your order has has been packed and ready for shipping, you will be notified whenever it is ready to be dispatched.
            ');

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order shipped', 'Press ok to continue');
    }

    public function moveOrderForDelivery(){
        $this->item->pipeline = 'out_for_delivery';
        $this->item->save();

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'ORDER MOVED OUT FOR DELIVERY',
            'Your order has has been moved out for delivery, you will be contact shortly by the delivery agent.
                Please keep your phone active so you can be reachable by our agent.
            ');

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order moved out for delivery', 'Press ok to continue');
    }


    public function orderDelivered(){
        $this->item->pipeline = 'delivered';
        $this->item->save();

        $this->sendPipelineEmail($this->item->invoiceOrder->user, $this->item, 'ODER DELIVERED',
            'Your order has has been delivered successfully, Thank you for choosing and trusting us.
            ');

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order delivered', 'Press ok to continue');
    }

    public function render()
    {
        return view('livewire.company.components.company-invoice-order-details');
    }
}
