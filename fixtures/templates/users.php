<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'email' => $faker->email(),
    'name' => $faker->firstName(),
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'dt_add' => $faker->date(),
    'role' => $faker->numberBetween(0, 1),
    'city_id' => $faker->numberBetween(1, 10),
];
