<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyCategoryList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshCompanyCategoryList' => '$refresh'];

    public function remove($id){
        Category::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Category deleted']);
        return  $this->emit('refreshCompanyCategoryList');
    }
    public function render()
    {
        return view('livewire.company.components.company-category-list', [
            'categories'    => Category::where('company_id', Auth::user()->company_id)->paginate(500)
        ]);
    }
}
