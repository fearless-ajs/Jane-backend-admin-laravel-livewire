<?php


namespace App\Traits;


use App\Models\CompanyPermission;
use App\Models\CompanyPermissionUser;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait CompanyRoleBasedAccessControl
{
    public function userHasRole($role_name){
        $role = CompanyRole::where('name', Str::slug($role_name))->where('company_id', Auth::user()->company_id)->first();
        if (!$role){
            return false;
        }
        $roleUser = CompanyRoleUser::where('user_id', Auth::user()->id)->where('company_role_id', $role->id)->where('company_id', Auth::user()->company_id)->first();
        if ($roleUser){
            return true;
        }
        return false;
    }

    public function userHasPermission($permission_name){
        $permission = CompanyPermission::where('name', Str::slug($permission_name))->where('company_id', Auth::user()->company_id)->first();
        if (!$permission){
            return false;
        }
        $permissionUser = CompanyPermissionUser::where('user_id', Auth::user()->id)->where('company_permission_id', $permission->id)->where('company_id', Auth::user()->company_id)->first();
        if ($permissionUser){
            return true;
        }
        return false;
    }

//    public function roleHasPermissions($permission_name){
//        $allowed = false;
//        // Fetch all user roles and loop to check for permissions
//        $userRoles = CompanyRoleuser::where('user_id', Auth::user()->id)->where('company_id', Auth::user()->company_id)->get();
//        if (!$userRoles){
//            $allowed = false;
//            return false;
//        }
//
//        // Loop through roles
//        foreach ($userRoles as $role){
//
//        }
//
//
//
//        $permission = CompanyPermission::where('name', Str::slug($permission_name))->where('company_id', Auth::user()->company_id)->first();
//        if (!$permission){
//            return false;
//        }
//    }
}
