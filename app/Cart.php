<?php

namespace App;

class Cart
{

    public $produtos = null;
    public $totalQtd = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->produtos = $oldCart->produtos;
            $this->totalQtd = $oldCart->totalQtd;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($produto, $id){
        $storedProduto = ['qtd'=>0, 'price'=>$produto->preco, 'produto'=>$produto];
        if($this->produtos){
            if(array_key_exists($id, $this->produtos)){
                $storedProduto = $this->produtos[$id];
            }
        }
        $storedProduto['qtd']++;
        $storedProduto['price'] = $produto->preco * $storedProduto['qtd'];
        $this->produtos[$id] = $storedProduto;
        $this->totalQtd++;
        $this->totalPrice += $produto->preco;
    }

    public function remove($produto, $id){
        if($this->produtos){
            if(array_key_exists($id, $this->produtos)){
                $storedProduto = $this->produtos[$id];
            }
        }
        $storedProduto['qtd']--;
        $storedProduto['price'] = $produto->preco * $storedProduto['qtd'];
        $this->produtos[$id] = $storedProduto;
        $this->totalQtd--;
        $this->totalPrice -= $produto->preco;
        if($storedProduto['qtd']==0){
            unset($this->produtos[$id]);
        }
        
    }

}