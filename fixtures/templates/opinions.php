<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'dt_add' => $faker->date(),
    'rate' => $faker->numberBetween(1, 5),
    'description' => $faker->sentence(10, true),
    'customer_id' => $faker->numberBetween(1, 10),
    'executor_id' => $faker->numberBetween(1, 10),
    'task_id' => $faker->numberBetween(1, 50),
    'rating' => $faker->numberBetween(1, 5),
];
