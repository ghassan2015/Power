<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Box::class, function (Faker $faker) {
    return [
        'Name' => $faker->name,
        'Location' => $faker->address,
        'State_id' => $faker->numberBetween(1, 4),
    ];
});
