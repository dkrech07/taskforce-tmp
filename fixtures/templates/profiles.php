<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'user_id' => $index + 1,
    'address' => $faker->address(),
    'bd' => $faker->date(),
    'about' => $faker->sentence(10, true),
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'skype' => substr($faker->e164PhoneNumber, 1, 11),
    'messanger' => $faker->email(),
    'average_rating' => $faker->numberBetween(1, 5),
    'avatar_link' => '/img/avatars/' . $faker->numberBetween(1, 5) . '.png'
];
