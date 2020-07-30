function carrinhoRemoverProduto(idpedido, idproduto, item){
    document.querySelector('#form-remover-produto input[name="pedido_id"]').value = idpedido;
    document.querySelector('#form-remover-produto input[name="produto_id"]').value = idproduto;
    document.querySelector('#form-remover-produto input[name="item"]').value=item;
    document.querySelector('#form-remover-produto').submit();
}

function carrinhoAdicionarProduto(idproduto){
    document.querySelector('#form-adicionar-produto input[name="id"]').value = idproduto;
    document.querySelector('#form-adicionar-produto').submit();
}
