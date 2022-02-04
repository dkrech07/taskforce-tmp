<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->jobTitle(),
    'icon' => $faker->image(null, 640, 480, 'pictures', true),
];
