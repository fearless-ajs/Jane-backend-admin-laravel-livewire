<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyCategoryList extends LiveNotify
{
    use WithPagination;
    protected $listeners = [
        'refreshCompanyCategoryList' => '$refresh',
        'delete'                     => 'delete'
    ];

    public $search;
    public $searchResult;

    public $totalCategories;
    public $company;

    public function mount($company){
       $this->company = $company;
    }

    public function updated(){
        if ($this->search){
            $this->searchResult = Category::where('company_id', $this->company->id)->where('name', 'LIKE', "%{$this->search}%")->get();
        }
    }


    public function remove($id){
       return $this->confirmDelete('warning', 'Are really sure to delete?', 'Press ok to continue', $id);
    }

    public function delete($id){
        Category::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Category deleted']);
        return  $this->emit('refreshCompanyCategoryList');
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.company.components.company-category-list', [
                'categories' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.company.components.company-category-list', [
                'categories' => Category::orderBy('id', 'DESC')->where('company_id', $this->company->id)->paginate(20)
            ]);
        }
    }
}
