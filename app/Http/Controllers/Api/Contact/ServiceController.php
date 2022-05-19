<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $services = Service::all();
        return $this->showAll($services);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Service $service)
    {
        return $this->showOne($service);
    }

}
