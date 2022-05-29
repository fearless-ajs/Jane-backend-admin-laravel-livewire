<?php


namespace App\Traits;


use App\Models\CompanyModule;
use App\Models\CompanyPermission;
use App\Models\CompanyPermissionModule;
use App\Models\CompanyPermissionRole;
use App\Models\CompanyPermissionUser;

trait CompanyDefaultPermissions
{

    public function createDefaultPermissions($company_id, $role, $user){

        // Invoice roles and permissions
        $invoicePermission = CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Invoice',
            'name'          => 'manage-invoice',
            'description'   => 'This permission allows invoice to be managed',
            'type'          => 'default'
        ]);

        $invoiceModules = CompanyModule::where('name', 'invoice')->get();
        if (count($invoiceModules) > 0){
            foreach ($invoiceModules as $module){
                CompanyPermissionModule::create([
                   'company_id'             => $company_id,
                    'company_permission_id' => $invoicePermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }

        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $invoicePermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $invoicePermission->id
        ]);



        // Contact role and permissions
        $contactPermission =  CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Contacts',
            'name'          => 'manage-contact',
            'description'   => 'This permission allows user to manage contacts',
            'type'          => 'default'
        ]);

        $contactModules = CompanyModule::where('name', 'contact')->get();
        if (count($contactModules) > 0){
            foreach ($contactModules as $module){
                CompanyPermissionModule::create([
                    'company_id'    => $company_id,
                    'company_permission_id' => $contactPermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }

        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $contactPermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $contactPermission->id
        ]);



        // Product role and permission
        $productPermission =  CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Product',
            'name'          => 'manage-product',
            'description'   => 'This permission allows product management',
            'type'          => 'default'
        ]);

        $productModules = CompanyModule::where('name', 'product')->get();
        if (count($productModules) > 0){
            foreach ($productModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $productPermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }

        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $productPermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $productPermission->id
        ]);


        // Service role and permissions
        $servicePermission =  CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Service',
            'name'          => 'manage-service',
            'description'   => 'This permission allows service management',
            'type'          => 'default'
        ]);

        $serviceModules = CompanyModule::where('name', 'service')->get();
        if (count($serviceModules) > 0){
            foreach ($serviceModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $servicePermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }
        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $servicePermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $servicePermission->id
        ]);


        // Category role and permission
        $categoryPermission =  CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Category',
            'name'          => 'manage-category',
            'description'   => 'This permission allows category management',
            'type'          => 'default'
        ]);

        // Assign the four module to user
        $categoryModules = CompanyModule::where('name', 'category')->get();
        if (count($categoryModules) > 0){
            foreach ($categoryModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $categoryPermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }

        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $categoryPermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $categoryPermission->id
        ]);



        // user role and permissions
        $usersPermission = CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Users',
            'name'          => 'manage-users',
            'description'   => 'This permission allows users to be managed',
            'type'          => 'default'
        ]);

        $userModules = CompanyModule::where('name', 'user')->get();
        if (count($userModules) > 0){
            foreach ($userModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $usersPermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }
        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $usersPermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $usersPermission->id
        ]);


        // role role and permissions
        $rolePermission =  CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage roles',
            'name'          => 'manage-roles',
            'description'   => 'This permission allows roles and permissions to be managed',
            'type'          => 'default'
        ]);
        $roleModules = CompanyModule::where('name', 'role')->get();
        if (count($roleModules) > 0){
            foreach ($roleModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $rolePermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }

        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $rolePermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $rolePermission->id
        ]);


        // system role and permissions
        $systemPermission = CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage System',
            'name'          => 'manage-system',
            'description'   => 'This permission allows user to manage all aspects of the system',
            'type'          => 'default'
        ]);

        $systemModules = CompanyModule::where('name', 'system')->get();
        if (count($systemModules) > 0){
            foreach ($systemModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $systemPermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }
        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $rolePermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $systemPermission->id
        ]);



        // Email role and permission
        $emailPermission =  CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Email',
            'name'          => 'manage-emails',
            'description'   => 'This permission allows user to manage emails',
            'type'          => 'default'
        ]);

        $emailModules = CompanyModule::where('name', 'email')->get();
        if (count($emailModules) > 0){
            foreach ($emailModules as $module){
                CompanyPermissionModule::create([
                    'company_id'            => $company_id,
                    'company_permission_id' => $emailPermission->id,
                    'company_module_id'     => $module->id
                ]);
            }
        }

        // Attach permission to user
        CompanyPermissionUser::create([
            'company_id'            => $company_id,
            'user_id'               => $user->id,
            'company_permission_id' => $emailPermission->id
        ]);

        // Attach permission to role
        CompanyPermissionRole::create([
            'company_id'            => $company_id,
            'company_role_id'       => $role->id,
            'company_permission_id' => $emailPermission->id
        ]);



    }

    public function attachPermissionToUser($user){

    }





}
