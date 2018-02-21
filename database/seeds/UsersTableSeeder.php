<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Configuration;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_author = Role::where('name', 'Author')->first();
        $role_admin = Role::where('name', 'Admin')->first();

        // $user1 = new App\User();
        // $user1->email = 'cdavila@multicam.com';
        // $user1->name = 'Chris Davila';
        // $user1->password = Hash::make('multicam1');
        // $user1->save();
        // $user1->roles()->attach($role_admin);

        // $user2 = new App\User();
        // $user2->email = 'richard@multicam.com';
        // $user2->name = 'Richard Humphrey';
        // $user2->password = Hash::make('multicam2');
        // $user2->save();
        // $user2->roles()->attach($role_admin);

        // $user3 = new App\User();
        // $user3->email = 'dwight@multicam.com';
        // $user3->name = 'Dwight Altman';
        // $user3->password = Hash::make('multicam3');
        // $user3->save();
        // $user3->roles()->attach($role_admin);

        // $user4 = new App\User();
        // $user4->email = 'tony@multicam.com';
        // $user4->name = 'Tony McGrew';
        // $user4->password = Hash::make('multicam4');
        // $user4->save();
        // $user4->roles()->attach($role_admin);

        // $user5 = new App\User();
        // $user5->email = 'sales@multicam.com';
        // $user5->name = 'Sales';
        // $user5->password = Hash::make('multicam5');
        // $user5->save();
        // $user5->roles()->attach($role_author);

        $user6 = new App\User();
        $user6->email = 'author@multicam.com';
        $user6->name = 'Author';
        $user6->password = Hash::make('multicam6');
        $user6->save();
        $user6->roles()->attach($role_author);        
    }
}
