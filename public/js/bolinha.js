let addCarro = document.querySelector('#add-cart')
let bolinha = document.querySelector('.bolinha')

function animation(){
    bolinha.classList.add('bounce')
}

if(bolinha && addCarro){
    addCarro.addEventListener('click', animation)

}