<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'quantity' => $faker->numberBetween(0, 20),
        'price' => $faker->randomFloat(2,0,999.999),
    ];
});
