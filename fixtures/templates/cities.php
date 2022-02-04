<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'city' => $faker->city(),
    'latitude' => $faker->randomFloat(8, 0, 90),
    'longitude' => $faker->randomFloat(8, -180, 180),
];
