<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    protected $table = "produtos";
    protected $fillable = ['nome', 'imagem', 'descricao', 'preco', 'categoria', 'informacoes', 'parcelamento'];

    public function setNomeAttribute($value){
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);

    }
}
