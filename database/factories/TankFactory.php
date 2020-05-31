<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tank;
use Faker\Generator as Faker;



$factory->define(Tank::class, function (Faker $faker) {

    return [
        'volume' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'location_id' => function() {
            return factory(\App\Models\Location::class)->create()->id;
        },
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
//        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
