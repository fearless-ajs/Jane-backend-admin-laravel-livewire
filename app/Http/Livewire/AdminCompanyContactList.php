<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyContactList extends LiveNotify
{
    public $company;

    use WithPagination;

    public $search;
    public $searchResult;

    protected $listeners = [
        'delete'    =>  'delete',
        'refreshAdminContactList'   =>  '$refresh'
    ];

    public function updated(){
        if ($this->search){
            $this->searchResult = Contact::where('company_id', $this->company->id)->where('lastname', 'LIKE', "%{$this->search}%")->orWhere('firstname', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function mount($company){
        $this->company = $company;
    }

    public function delete($contact_id){
        $contact = Contact::find($contact_id);

        // Delete the contact transactions
//        $contact->transactions->each->delete();

        // Delete contact itself
        $contact->delete();

        $this->emit('refreshContactList');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Contact deleted']);
    }

    public function remove($contact_id){
        return $this->confirmDelete('warning', 'Do you really want to delete?', 'Press ok to continue', $contact_id);
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-company-contact-list', [
                'contacts' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-company-contact-list', [
                'contacts' => Contact::where('company_id', $this->company->id)->paginate(10)
            ]);
        }
    }
}
