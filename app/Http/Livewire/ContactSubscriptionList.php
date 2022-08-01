<?php

namespace App\Http\Livewire;

use App\Models\ActiveService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactSubscriptionList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.contact.components.contact-subscription-list', [
            'subs'  =>  ActiveService::orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->paginate(20)
        ]);
    }
}
