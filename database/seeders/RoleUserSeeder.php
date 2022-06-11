<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user  = User::where('email', 'admin@sandpiper.damilarebinutu.com')->first();
        $role  = Role::where('name', 'super-admin')->first();
        DB::table('role_user')->insert(
            array(
                'role_id'   => $role->id,
                'user_id'   => $user->id,
                'user_type' => 'App\Models\User'
            )
        );
    }
}
