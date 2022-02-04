<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'dt_add' => $faker->date(),
    'rate' => $faker->randomNumber(4, false),
    'description' => $faker->sentence(10, true),
    'executor_id' => $faker->numberBetween(1, 10),
    'task_id' => $index + 1,
];
