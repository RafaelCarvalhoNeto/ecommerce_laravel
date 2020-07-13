<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use Faker\Generator as Faker;

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'tipo' =>$faker->name,
        'imagem' =>$faker->imageUrl($width = 640, $height = 480),
    ];
});
