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
        $storedProduto = ['qtd'=>0, 'price'=>$produto->precoFinal, 'produto'=>$produto];
        if($this->produtos){
            if(array_key_exists($id, $this->produtos)){
                $storedProduto = $this->produtos[$id];
            }
        }
        $storedProduto['qtd']++;
        $storedProduto['price'] = $produto->precoFinal * $storedProduto['qtd'];
        $this->produtos[$id] = $storedProduto;
        $this->totalQtd++;
        $this->totalPrice += $produto->precoFinal;
    }

    public function remove($produto, $id, $item){
        if($this->produtos){
            if(array_key_exists($id, $this->produtos)){
                $storedProduto = $this->produtos[$id];
            }
        }
        if($item == false){
            $this->produtos[$id] = $storedProduto;
            $this->totalQtd -= $storedProduto['qtd'];
            $this->totalPrice -= $produto->precoFinal * $storedProduto['qtd'];
            unset($this->produtos[$id]);
        } else {

            $storedProduto['qtd']--;
            $storedProduto['price'] = $produto->precoFinal * $storedProduto['qtd'];
            $this->produtos[$id] = $storedProduto;
            $this->totalQtd--;
            $this->totalPrice -= $produto->precoFinal;
            if($storedProduto['qtd']==0){
                unset($this->produtos[$id]);
            }
        }
        
    }

}