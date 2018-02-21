<?php

use Illuminate\Database\Seeder;
use App\User;

class SalesforceProductCodeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return voidS
	 */
	public function run()
	{
		factory(App\Salesforce_Product_Code::class, 10)->create();
	}
}