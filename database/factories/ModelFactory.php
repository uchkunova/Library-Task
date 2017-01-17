<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'is_admin' => rand(0, 1),
    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(1, true),
        'author' => $faker->firstName . ' ' . $faker->lastName,
        'publish_date' => $faker->date(),
        'resume' => $faker->sentences(5, true),
        'format' => $faker->randomElement(['A4', 'A3']),
        'page_count' => $faker->numberBetween(100, 1000),
        'isbn' => $faker->numerify('###-###-##-##-##'),
        'cover_path' => $faker->randomElement([
            'covers/asd587e2c36bb9b4.jpeg',
            'covers/dgdg587e2bfabedec.jpeg',
            'covers/asd587e2be9b27ca.jpeg',
            'covers/asd587e2bd2a53e5.jpeg',
            'covers/asd587e2dd51a0be.jpeg',
        ]),
    ];
});