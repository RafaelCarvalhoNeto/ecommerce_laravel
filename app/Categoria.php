<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['tipo, imagem'];

    public function setTipoAttribute($value){
        $this->attributes['tipo'] = $value;
        $this->attributes['slug'] = Str::slug($value);

    }
}
