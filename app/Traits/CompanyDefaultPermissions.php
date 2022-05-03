<?php


namespace App\Traits;


use App\Models\CompanyPermission;

trait CompanyDefaultPermissions
{

    public function createDefaultPermissions($company_id){
        CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Invoice',
            'name'          => 'manage-invoice',
            'description'   => 'This permission allows invoice to be managed',
            'type'          => 'default'
        ]);

         CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Contacts',
            'name'          => 'manage-contact',
            'description'   => 'This permission allows user to manage contacts',
            'type'          => 'default'
        ]);

        CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Product',
            'name'          => 'manage-product',
            'description'   => 'This permission allows product management',
            'type'          => 'default'
        ]);

       CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Users',
            'name'          => 'manage-users',
            'description'   => 'This permission allows users to be managed',
            'type'          => 'default'
        ]);

        CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage roles',
            'name'          => 'manage-roles',
            'description'   => 'This permission allows roles and permissions to be managed',
            'type'          => 'default'
        ]);

         CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage System',
            'name'          => 'manage-system',
            'description'   => 'This permission allows user to manage all aspects of the system',
            'type'          => 'default'
        ]);

        CompanyPermission::create([
            'company_id'    => $company_id,
            'display_name'  => 'Manage Email',
            'name'          => 'manage-emails',
            'description'   => 'This permission allows user to manage emails',
            'type'          => 'default'
        ]);

    }





}
