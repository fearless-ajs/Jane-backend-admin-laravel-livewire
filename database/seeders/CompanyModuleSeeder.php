<?php

namespace Database\Seeders;

use App\Models\CompanyModule;
use Illuminate\Database\Seeder;

class CompanyModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        // Roles and permission EmailModule
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


        // Roles and permission Catalogue
        if (!CompanyModule::where('name', 'catalogue')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'catalogue',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'catalogue')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'catalogue',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'catalogue')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'catalogue',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'catalogue')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'catalogue',
                'access' => 'read'
            ]);
        }


        // Roles and permission Billing Cycle
        if (!CompanyModule::where('name', 'billing-cycle')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'billing-cycle',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'billing-cycle')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'billing-cycle',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'billing-cycle')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'billing-cycle',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'billing-cycle')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'billing-cycle',
                'access' => 'read'
            ]);
        }


        // Roles and permission Taxes
        if (!CompanyModule::where('name', 'tax')->where('access', 'create')->first()){
            CompanyModule::create([
                'name'   => 'tax',
                'access' => 'create'
            ]);
        }

        if (!CompanyModule::where('name', 'tax')->where('access', 'edit')->first()){
            CompanyModule::create([
                'name'   => 'tax',
                'access' => 'edit'
            ]);
        }

        if (!CompanyModule::where('name', 'tax')->where('access', 'delete')->first()){
            CompanyModule::create([
                'name'   => 'tax',
                'access' => 'delete'
            ]);
        }

        if (!CompanyModule::where('name', 'tax')->where('access', 'read')->first()){
            CompanyModule::create([
                'name'   => 'tax',
                'access' => 'read'
            ]);
        }
    }
}
