<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'location' => $faker->randomDigit,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
//        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
