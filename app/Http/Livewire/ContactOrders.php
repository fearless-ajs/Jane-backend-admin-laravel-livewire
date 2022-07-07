<?php

namespace App\Http\Livewire;

use App\Models\CartOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactOrders extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.contact.components.contact-orders', [
            'orders'    =>  CartOrder::orderBy('fulfilled', 'ASC')->orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->paginate(12)
        ]);
    }
}
