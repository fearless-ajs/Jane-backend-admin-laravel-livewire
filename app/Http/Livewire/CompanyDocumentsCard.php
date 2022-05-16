<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyDocument;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyDocumentsCard extends Component
{
    use WithFileUploads;

    public $company;
    public $documents;

    public $title;
    public $file;

    protected $listeners = [
      'refreshCompanyDocuments'     => 'fetchDocuments'
    ];

    public function mount($company){
        $this->company = $company;
        $this->fetchDocuments();
    }

    public function fetchDocuments(){
        $this->documents = CompanyDocument::where('company_id', $this->company->id)->get();
    }

    public function updated($field){
        $this->validateOnly($field, [
           'title'  => 'required|string|max:255',
           'file'   => 'required|file|mimes:pdf'
        ]);
    }

    public function saveDocument(){
        $this->validate([
            'title'  => 'required|string|max:255',
            'file'   => 'required|file|mimes:pdf'
        ]);

        $this->file = $this->file->store('/', 'documents');

        CompanyDocument::create([
           'company_id' => $this->company->id,
           'title'      => $this->title,
           'file'       => $this->file
        ]);

        $this->resetExcept(['documents', 'company']);
        $this->emit('refreshCompanyDocuments');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Document saved']);
    }

    public function removeDocument($id){
        $doc = CompanyDocument::find($id);

        File::delete(public_path("uploads/docs/$doc->file"));

        $doc->delete();
        $this->emit('refreshCompanyDocuments');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Document deleted']);
    }

    public function render()
    {
        return view('livewire.company.components.company-documents-card');
    }
}
