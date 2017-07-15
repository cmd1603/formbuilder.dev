<?php

use Illuminate\Database\Seeder;
use App\User;

class ConfigurationsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Configuration::class, 20)->create();
	}
}