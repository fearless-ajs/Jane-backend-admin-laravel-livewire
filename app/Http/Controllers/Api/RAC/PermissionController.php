<?php

namespace App\Http\Controllers\Api\RAC;

use App\Http\Controllers\Api\ApiController;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->showAll(Permission::all());
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
            'name'          => 'required|string|unique:permissions,name|max:255',
            'display_name'  => 'required|string|max:255',
            'description'   => 'required|string|max:255',
        ]);

        $permission = Permission::create($request->all());
        return $this->showOne($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission)
    {
        return $this->showOne($permission);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'          => 'string|unique:permissions,name,'. $permission->id .'|max:255',
            'display_name'  => 'string|max:255',
            'description'   => 'string|max:255',
        ]);

        $permission->fill($request->only([
            'name',
            'display_name',
            'description',
        ]));

        if (!$permission->isDirty()){
            return $this->errorResponse([
                'errorCode' => 'UNCHANGED_DATA',
                'message'   => 'You need to supply a different value to be updated'
            ], 422);
        }

        $permission->save();

        return $this->showOne($permission, 202);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return $this->successResponse([
            'errorCode'  => 'SUCCESS',
            'message'    => "$permission->name permission deleted"
        ], 202);
    }
}
