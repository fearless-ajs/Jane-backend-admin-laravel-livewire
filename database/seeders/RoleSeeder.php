<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'            => 'customer',
                'display_name'    => 'Customer',
                'description'     => 'This is the role of customers or contacts on the system'
            ],
            [
                'name'            => 'company',
                'display_name'    => 'Company',
                'description'     => 'This is the role of company creators on the system'
            ],
            [
                'name'            => 'super-admin',
                'display_name'    => 'Super Administrator',
                'description'     => 'This is the role of the system super administrator overseer'
            ]
        ];
        foreach ($roles as $role){
            DB::table('roles')->insert(
                array(
                    'name'              => $role['name'],
                    'display_name'      => $role['display_name'],
                    'description'       => $role['description']
                )
            );
        }
    }
}
