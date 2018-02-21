<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Configuration::class, function (Faker\Generator $faker) {
	return [
		'directory_label' => $faker->words(5, true),
		'salesforce_product_code' => $faker->words(5, true),
		'configuration' => $faker->sentence(500),
		'workarea_html' => $faker->sentence(500),
		'active' => $faker->numberBetween(0, 1),
		'created_by' => App\User::all()->random()->id,
	];
});

$factory->define(App\Distributor::class, function (Faker\Generator $faker) {
	return [
		'distributor' => $faker->words(2, true),
	];
});

$factory->define(App\Salesforce_Product_Code::class, function (Faker\Generator $faker) {
	return [
		'code' => $faker->words(2, true),
		'description' => $faker->sentence(5),		
	];
});