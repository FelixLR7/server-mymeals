<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Meal;
use Faker\Generator as Faker;

$factory->define(Meal::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence(),
        'category_id' => $faker->numberBetween(1, 5)
    ];
});
