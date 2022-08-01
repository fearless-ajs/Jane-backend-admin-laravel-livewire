<?php

namespace App\Http\Livewire;

use App\Models\CartOrderCatalogue;
use App\Traits\EmailProvider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyOrderList extends LiveNotify
{

    use WithPagination, EmailProvider;

    public $company;

    public $from;
    public $to;

    public $searchResult;

    protected $listeners = [
      'delete'              =>  'cancelOrder',
      'refreshOrderList'    => '$refresh'
    ];

    public function mount($company){
        $this->company = $company;
    }

    public function updated(){
        if ($this->from && $this->to){
            $from = Carbon::parse($this->from);
            $to   = Carbon::parse($this->to);

            $searchResult = CartOrderCatalogue::orderBy('created_at', 'DESC')->where('company_id',  $this->company->id)->whereBetween('created_at', [$from, $to])->get();

            if (!$searchResult){
                $this->emit('alert', ['type' => 'error', 'message' => 'No record between that range']);
            }else{
//                dd($searchResult);
                $this->searchResult = $searchResult;
            }
        }

    }

    public function clearFilter(){
        $this->to           = null;
        $this->from         = null;
        $this->searchResult = null;
    }

    public function cancel($order_id){
        return $this->confirmDelete('warning', 'Do you want to cancel this order', 'Press ok to continue', $order_id);
    }

    public function cancelOrder($order_id){
        $item = CartOrderCatalogue::find($order_id);
        if ($item->type == 'service'){
            $item->terminated = true;
            $this->sendPipelineEmail($item->cartOrder->user, $item, 'SERVICE RESUMED',
                'Your service has been resumed, Thank you for trusting us.
            ');
        }

        if ($item->type == 'product'){
            $this->sendPipelineEmail($item->cartOrder->user, $item, 'ORDER CANCELLED',
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
        $item = CartOrderCatalogue::find($order_id);

        if ($item->type == 'service'){
            $item->terminated = false;
            $this->sendPipelineEmail($item->cartOrder->user, $item, 'SERVICE RESUMED',
                'Your service has been resumed, Thank you for trusting us.
            ');
        }

        if ($item->type == 'product'){
            $item->pipeline = 'order_in_progress';
            $this->sendPipelineEmail($item->cartOrder->user, $item, 'ORDER RESUMED',
                'Your order is now active, you will be notified when it is ready for shipping, thanks for choosing us.
            ');
        }

        $item->save();

        $this->emit('refreshOrderDetails');
        return $this->alert('success', 'Order resumed', 'Press ok to continue');
    }

    public function render()
    {
        if ($this->from && $this->to && $this->searchResult){
            return view('livewire.company.components.company-order-list', [
                'orders'    =>  $this->searchResult
            ]);
        }else{
            return view('livewire.company.components.company-order-list', [
                'orders'    =>  CartOrderCatalogue::orderBy('id', 'DESC')->where('company_id',  $this->company->id)->paginate(12)
            ]);
        }
    }
}
