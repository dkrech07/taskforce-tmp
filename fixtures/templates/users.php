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
    'profile_id' => $index + 1,
];
