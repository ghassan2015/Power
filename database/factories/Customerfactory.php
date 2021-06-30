<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Customer::class, function (Faker $faker) {
    return [
        'Name' => $faker->name,
        'Email' => $faker->unique()->safeEmail,
        'Password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'Phone' => $faker->phoneNumber,
        'Price' => $faker->randomNumber(3, 4),
        'Address' => $faker->address,
        'State_id' => $faker->numberBetween(1, 4),
        'Counter_id' => $faker->numberBetween(1, 50),
        'Box_id' => $faker->numberBetween(1, 20),
        'Status' => $faker->numberBetween(0, 1),
    ];
});
