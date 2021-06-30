<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Counter::class, function (Faker $faker) {
    return [
        'Name' => $faker->name,
        'Box_id' => $faker->numberBetween(1, 20),
        'is_active' => $faker->numberBetween(0, 1),

    ];
});
