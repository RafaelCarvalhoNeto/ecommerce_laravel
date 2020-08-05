let grupo = document.querySelector('#infos-tecnica')
let add = document.querySelector('#add-espec');

add.addEventListener('click', adicionarCampo)

function adicionarCampo(){
    
    let bloco =  document.getElementsByClassName('campos-info');
    let qtd = bloco.length
    qtd = qtd+1

    let row = document.createElement('div');
    row.setAttribute('class', 'form-row campos-info border my-2')
    let text = document.createElement('p')
    text.setAttribute('class','d-block col-md-12 text-center p-2 p-1 m-0 border-bottom bg-info text-white campo-info-text')
    text.innerText = 'Info '+qtd
    let divTitulo = document.createElement('div');
    divTitulo.setAttribute('class','form-group col-md-12 text-center my-2')
    let titulo = document.createElement('input');
    titulo.setAttribute('class','form-control')
    titulo.setAttribute('type','text')
    titulo.setAttribute('name','inputTitulo'+qtd)
    titulo.setAttribute('placeholder','Titulo')
    let divConteudo = document.createElement('div');
    divConteudo.setAttribute('class','form-group col-md-12 text-center')
    let conteudo = document.createElement('input');
    conteudo.setAttribute('class','form-control')
    conteudo.setAttribute('type','text')
    conteudo.setAttribute('name','inputConteudo'+qtd)
    conteudo.setAttribute('placeholder','Conteudo')
    
    divTitulo.appendChild(titulo)
    divConteudo.appendChild(conteudo)
    row.appendChild(text)
    row.appendChild(divTitulo)
    row.appendChild(divConteudo)
    grupo.appendChild(row);

    document.querySelector('#infosQtd').value = qtd
    
    
}