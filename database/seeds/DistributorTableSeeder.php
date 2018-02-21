<?php

use Illuminate\Database\Seeder;
use App\User;

class DistributorTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Distributor::class, 10)->create();
	}
}