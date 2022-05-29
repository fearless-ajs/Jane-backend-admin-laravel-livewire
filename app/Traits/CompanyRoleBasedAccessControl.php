<?php


namespace App\Traits;


use App\Models\CompanyModule;
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

    public function hasModuleAccess($name, $access){
        $status = false;

        // fetch module with that name to retrieve id
        $module = CompanyModule::where('name', $name)->where('access', $access)->first();
        if (!$module){
            // there's no module with that name and access
            $status = false;
            return $status;
        }


        // fetch user permissions to see which of the has the module access
        $userPermissions = Auth::user()->userPermissions;
        if (count($userPermissions) > 0){
            foreach ($userPermissions as $userPermission){
                // check which one has the permission
                if (count($userPermission->permission->permissionModules) > 0){
                    foreach ($userPermission->permission->permissionModules as $permissionModule){
                        if ($module->id == $permissionModule->module->id){
                            $status = true;
                        }

                    }
                }
            }
        }

        // fetch user roles, check which of them has permission that has the module access
        $userRoles = Auth::user()->userRoles;
        if (count($userRoles) > 0){
            foreach ($userRoles as $userRole){
                if (count($userRole->role->rolePermissions) > 0){
                    foreach ($userRole->role->rolePermissions as $rolePermission){
                        if (count($rolePermission->permission->permissionModules) > 0){
                            foreach ($rolePermission->permission->permissionModules as $permissionModule){
                                if ($module->id == $permissionModule->module->id){
                                    $status = true;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $status;
    }
}
