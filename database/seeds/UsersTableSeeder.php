<?php

use Illuminate\Database\Seeder;
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
        $user1 = new App\User();
        $user1->email = 'cdavila@multicam.com';
        $user1->name = 'Chris Davila';
        $user1->password = Hash::make('multicam1');
        $user1->save();

        $user2 = new App\User();
        $user2->email = 'richard@multicam.com';
        $user2->name = 'Richard Humphrey';
        $user2->password = Hash::make('multicam2');
        $user2->save();

        $user3 = new App\User();
        $user3->email = 'dwight@multicam.com';
        $user3->name = 'Dwight Altman';
        $user3->password = Hash::make('multicam3');
        $user3->save();

        $user4 = new App\User();
        $user4->email = 'tony@multicam.com';
        $user4->name = 'Tony McGrew';
        $user4->password = Hash::make('multicam4');
        $user4->save();
    }
}
