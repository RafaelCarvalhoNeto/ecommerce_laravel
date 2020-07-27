<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'status'=>'Não lido',
        'nome' => $faker->firstName,
        'sobrenome' => $faker->LastName,
        'email' => $faker->unique()->safeEmail,
        'assunto'=> $faker->sentence($nbWords = 2, $variableNbWords = true),
        'conteudo' => $faker->text($maxNbChars = 200)  
    ];
});
