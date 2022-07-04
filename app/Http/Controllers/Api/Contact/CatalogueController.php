<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Models\CompanyCatalogue;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $catalogue = CompanyCatalogue::all();
        return $this->showAll($catalogue);
    }

    /**
     * Display the specified resource.
     *
     * @param $catalogue_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($catalogue_id)
    {
        $catalogue = CompanyCatalogue::findOrFail($catalogue_id);
        return $this->showOne($catalogue);
    }


}
