<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    protected $table = "produtos";
    protected $fillable = ['nome', 'imagem', 'descricao', 'preco', 'categoria', 'informacoes', 'parcelamento', 'emPromo', 'promo', 'valorDescontado'];

    public function setNomeAttribute($value){
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);

    }

    public function pedido_produtos(){
        return $this->hasMany('App\PedidoProduto')
        ->select(\DB::raw('produto_id, sum(desconto) as descontos, sum(valor) as valores, count(1) as qtd'))
        ->groupBy('produto_id')
        ->orderBy('qtd','desc');
    }

    public function cat(){
        return $this->hasOne('App\Categoria','id','categoria');
    }

}
