<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->user_id = 1;
        $role_user->role_id = 3;
        $role_user->save();

        $role_author = new Role();
        $role_author->user_id = 2;
        $role_author->role_id = 3;
        $role_author->save();

        $role_admin = new Role();
        $role_admin->user_id = 3;
        $role_admin->role_id = 3;
        $role_admin->save();

        $role_admin = new Role();
        $role_admin->user_id = 4;
        $role_admin->role_id = 3;
        $role_admin->save();

        $role_admin = new Role();
        $role_admin->user_id = 5;
        $role_admin->role_id = 1;
        $role_admin->save();
                    
    }
}
