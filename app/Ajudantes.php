<?php

use Carbon\Carbon;

function produtoImagem($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/nao-encontrado.jpg');
}

