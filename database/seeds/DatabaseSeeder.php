<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
    	$this->command->info('Deleting users records');
        DB::table('users')->delete();
        $this->command->info('Deleting configurations records');
        DB::table('configurations')->delete();
        $this->call(UsersTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        Model::reguard();

    }
}
