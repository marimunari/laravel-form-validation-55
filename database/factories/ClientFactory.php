<?php

use App\Client;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

require_once __DIR__ . '/../faker_data/document.php';

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'defaulter' => rand(0, 1),
    ];
});

$factory->state(Client::class, Client::TYPE_INDIVIDUAL, function (Faker $faker) {
    $cpfs = cpfs();
    return [
        'document' => $cpfs[array_rand($cpfs, 1)],
        'dateBirth' => $faker->date(),
        'gender' => rand(1, 10) % 2 == 0 ? 'm' : 'f',
        'maritalStatus' => rand(1, 3),
        'physicalDisability' => rand(1, 10) % 2 == 0 ? $faker->word : null,
        'clientType' => Client::TYPE_INDIVIDUAL,
    ];
});

$factory->state(Client::class, Client::TYPE_LEGAL, function (Faker $faker) {
    $cnpjs = cnpjs();
    return [
        'document' => $cnpjs[array_rand($cnpjs, 1)],
        'companyName' => $faker->company,
        'clientType' => Client::TYPE_LEGAL,
    ];
});
