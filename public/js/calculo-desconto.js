function fazerCalculo(i){
    let qtdDesconto = document.querySelectorAll('.promoDesc')[i]
    let valDesconto = document.querySelectorAll('.valorDesc')[i];
    let totDesconto = document.querySelectorAll('.totalDesconto')[i];
    let inpDesconto = document.querySelectorAll('.inputDesconto')[i];
    let valOriginal = Number(document.querySelectorAll('.valorOriginalHid')[i].innerText);

     let qtd = qtdDesconto.value
     let desconto = (valOriginal*(1-qtd/100))
     valDesconto.innerHTML = desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
     totDesconto.innerHTML = (valOriginal - desconto).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
     
     inpDesconto.value = desconto

 }