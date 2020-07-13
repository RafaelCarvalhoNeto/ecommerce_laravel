<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' =>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'slug' => $faker->name,
        'categoria' =>$faker->randomDigit,
        'imagem' =>$faker->imageUrl($width = 640, $height = 480),
        'descricao' =>$faker->text,
        'preco' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 3000),
        'informacoes' => $faker->name,
        'parcelamento' => $faker->randomDigit,
    ];
});
