<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyCreateCategoryForm extends Component
{
    public $name;

    public function addCategory(){
        $this->validate([
           'name'   =>  'required|string|max:255'
        ]);

        // Check if category exist in company's record
        if (Category::where('company_id', Auth::user()->company_id)->where('name', $this->name)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Category exist']);
        }

        Category::create([
            'company_id'    => Auth::user()->company_id,
            'name'          => $this->name
        ]);

        $this->reset();
        $this->emit('refreshCompanyCategoryList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Category created']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-category-form');
    }
}
