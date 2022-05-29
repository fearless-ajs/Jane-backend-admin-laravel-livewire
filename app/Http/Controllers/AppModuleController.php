<?php

namespace App\Http\Controllers;

use App\Models\CompanyModule;

class AppModuleController extends Controller
{
    public function createCompanyModules(){
        // Invoice Module
        if (!CompanyModule::where('name', 'invoice')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'invoice',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'invoice')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'invoice',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'invoice')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'invoice',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'invoice')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'invoice',
                'access' => 'read'
            ]);
        }


        // Contact CompanyModule
        if (!CompanyModule::where('name', 'contact')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'contact',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'contact')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'contact',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'contact')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'contact',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'contact')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'contact',
                'access' => 'read'
            ]);
        }


        // Product CompanyModule
        if (!CompanyModule::where('name', 'product')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'product',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'product')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'product',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'product')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'product',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'product')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'product',
                'access' => 'read'
            ]);
        }


        // Service CompanyModule
        if (!CompanyModule::where('name', 'service')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'service',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'service')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'service',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'service')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'service',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'service')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'service',
                'access' => 'read'
            ]);
        }


        // Category CompanyModule
        if (!CompanyModule::where('name', 'category')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'category',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'category')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'category',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'category')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'category',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'category')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'category',
                'access' => 'read'
            ]);
        }


        // User CompanyModule
        if (!CompanyModule::where('name', 'user')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'user',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'user')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'user',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'user')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'user',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'user')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'user',
                'access' => 'read'
            ]);
        }

        // Roles and permission CompanyModule
        if (!CompanyModule::where('name', 'role')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'role',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'role')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'role',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'role')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'role',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'role')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'role',
                'access' => 'read'
            ]);
        }



        // Roles and permission SystemModule
        if (!CompanyModule::where('name', 'system')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'system',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'system')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'system',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'system')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'system',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'system')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'system',
                'access' => 'read'
            ]);
        }

        // Roles and permission SystemModule
        if (!CompanyModule::where('name', 'email')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'email',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'email')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'email',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'email')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'email',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'email')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'email',
                'access' => 'read'
            ]);
        }


    }
}
