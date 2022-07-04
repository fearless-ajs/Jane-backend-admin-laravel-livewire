<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCurrencyList extends LiveNotify
{
    use WithPagination;

    public $search;
    public $searchResult;

    protected $listeners = [
      'refreshAdminCurrencyList'        =>  '$refresh',
       'delete'                         =>  'delete'
    ];

    public function updated(){
        if ($this->search){
            $this->searchResult = Currency::where('country', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function remove($id){
        return $this->confirmDelete('warning', 'Do you really want to delete', 'Press ok to continue', $id);
    }

    public function delete($id){
        Currency::find($id)->delete();

        $this->emit('refreshAdminCurrencyList');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Currency deleted from the system']);
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-currency-list', [
                'currencies' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-currency-list', [
                'currencies' => Currency::orderBy('id', 'DESC')->paginate(10)
            ]);
        }

    }
}
