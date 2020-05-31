<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NewVolume;
use Faker\Generator as Faker;

$factory->define(NewVolume::class, function (Faker $faker) {

    return [
        'volume' => $faker->randomDigitNotNull,
        'tank_id' => function() {
            return factory(\App\Models\Tank::class)->create()->id;
        },
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
//        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
