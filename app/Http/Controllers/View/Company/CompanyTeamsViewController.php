<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyTeamsViewController extends Controller
{
    public function teams (){
        $data = [
            'title'       => 'Teams',
            'keywords'    => 'Company teams',
            'description' => 'Company teams'
        ];
        return view('livewire.Company.pages.Company-teams-page', ['data' => $data]);
    }
}
