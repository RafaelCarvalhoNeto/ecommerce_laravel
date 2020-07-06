<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
        'sobrenome' => $faker->lastName,
        'cpf' => $faker->numberBetween($min = 100000000, $max = 900000000),
        'rg' => $faker->numberBetween($min = 100000, $max = 900000),
        'endereco' => $faker->address,
        'cep' => $faker->postcode,
        'cidade' => $faker->city,
        'uf' => $faker->stateAbbr,


    ];
});
