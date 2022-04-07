<?php

namespace App\Http\Controllers\Api\RAC;

use App\Http\Controllers\Api\ApiController;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->showAll(Role::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'          => 'required|string|unique:roles,name|max:255',
           'display_name'  => 'required|string|max:255',
           'description'   => 'required|string|max:255',
        ]);

        $role = Role::create($request->all());
        return $this->showOne($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role)
    {
        return $this->showOne($role, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'          => 'string|unique:roles,name,'. $role->id .'|max:255',
            'display_name'  => 'string|max:255',
            'description'   => 'string|max:255',
        ]);

        $role->fill($request->only([
            'name',
            'display_name',
            'description',
        ]));


        if (!$role->isDirty()){
            return $this->errorResponse([
                'errorCode' => 'UNCHANGED_DATA',
                'message'   => 'You need to supply a different value to be updated'
            ], 422);
        }

        $role->save();

        return $this->showOne($role, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $this->successResponse([
            'errorCode'  => 'SUCCESS',
            'message'    => "$role->name role deleted"
        ], 202);
    }
}
