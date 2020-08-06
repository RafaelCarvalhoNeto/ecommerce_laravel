function fazerCalculo(i){
    let qtdDesconto = document.querySelectorAll('.promoDesc')[i]
    let valDesconto = document.querySelectorAll('.valorDesc')[i];
    let totDesconto = document.querySelectorAll('.totalDesconto')[i];
    let inpDesconto = document.querySelectorAll('.inputDesconto')[i];
    let valOriginal = Number(document.querySelectorAll('.valorOriginalHid')[i].innerText);

    let qtd = qtdDesconto.value.replace(/\D/g,'')
    let desconto = (valOriginal*(1-qtd/100))
    valDesconto.innerHTML = desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
    totDesconto.innerHTML = (valOriginal - desconto).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
    
    inpDesconto.value = desconto

    if(qtdDesconto.value > 100){
        qtdDesconto.value = 100
    }
    if(qtdDesconto.hasAttribute('disabled')==false){
        if(qtdDesconto.value <= 0){
            qtdDesconto.value = 1
        }
    }

}

function zerar(z){
    let qtdDesconto = document.querySelectorAll('.promoDesc')[z]
    let selectPromo = document.querySelectorAll('.select-promo')[z]
    if (selectPromo.value ==0){
        qtdDesconto.value = 0;
        qtdDesconto.setAttribute('disabled', true)
        qtdDesconto.classList.add('dados-promo')
        qtdDesconto.style.background = 'darkgrey'
        qtdDesconto.style.color = 'white'
    } else {
        qtdDesconto.value = 1;
        qtdDesconto.removeAttribute('disabled')
        qtdDesconto.classList.remove('dados-promo')
        qtdDesconto.style.background = '#f0f0f5'
        qtdDesconto.style.color = '#495057'
    }
}
