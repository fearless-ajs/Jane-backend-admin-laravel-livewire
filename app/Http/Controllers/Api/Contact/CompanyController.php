<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->showAll(Company::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($company_id)
    {
        $company = Company::findOrFail($company_id);
        return $this->showOne($company);
    }

    public function fetchCompanyCatalogue($company_id){
        // Check if company Exist
        Company::findOrFail($company_id);
        $catalogues = CompanyCatalogue::where('company_id', $company_id)->get();
        return $this->showAll($catalogues);
    }

}
