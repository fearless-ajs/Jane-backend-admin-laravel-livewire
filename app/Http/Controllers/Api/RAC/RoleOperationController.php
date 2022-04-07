<?php

namespace App\Http\Controllers\Api\RAC;

use App\Http\Controllers\Api\ApiController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class RoleOperationController extends ApiController
{
    public function attachPermissionToRole(Role $role, Permission $permission){
        // Verify if the permission exist for the role
       if ($role->hasPermission($permission->name)){
           return $this->errorResponse([
               'errorCode'  => 'DATA_CONFLICT',
               'message'    => "$role->name role already has permission of $permission->name"
           ], 422);
       }

        $role->attachPermission($permission);
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'message'   => "$role->name role has been assigned permission of $permission->name"
        ], 202);
    }


    public function detachPermissionFromRole(Role $role, Permission $permission){
        if (!$role->hasPermission($permission->name)){
            return $this->errorResponse([
                'errorCode'  => 'DATA_CONFLICT',
                'message'    => "$role->name does not have the permission of $permission->name"
            ], 422);
        }

        $role->detachPermission($permission);
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'message'   => " $permission->name permission has been detached from $role->name role"
        ], 202);
    }

    public function attachRoleToUser(Role $role, User $user){
        // Verify if the permission exist for the role
        if ($user->hasRole($role->name)){
            return $this->errorResponse([
                'errorCode'  => 'DATA_CONFLICT',
                'message'    => "$user->name role already has role of $role->name"
            ], 422);
        }

        $user->attachRole($role);
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'message'   => "$role->name role has been assigned to $user->name"
        ], 202);
    }

    public function detachRoleFromUser(Role $role, User $user){
        // Verify if the permission exist for the role
        if (!$user->hasRole($role->name)){
            return $this->errorResponse([
                'errorCode'  => 'DATA_CONFLICT',
                'message'    => "$user->name does not have the role of $role->name"
            ], 422);
        }

        $user->detachRole($role);
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'message'   => "$role->name role has been detached from $user->name"
        ], 202);
    }
}
