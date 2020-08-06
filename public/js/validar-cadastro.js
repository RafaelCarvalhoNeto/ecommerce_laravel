const seletor = selecao => document.querySelector(selecao);

const formulario = seletor('#formCadastro'),
    nome = seletor('#inputNome'),
    sobrenome = seletor('#inputSobrenome'),
    emailInput = seletor('#inputEmail'),
    endereco = seletor('#inputEndereco'),
    cep = seletor('#inputCep'),
    cidade = seletor('#inputCidade'),
    estado = seletor('#inputUF'),
    email = seletor('#inputEmail'),
    senha = seletor('#inputSenha'),
    senhaConfirma = seletor('#inputConfirma'),
    senhaAlphaNum = seletor('#senhaAlphaNum'),
    btnEnviar = seletor('#btnEnviar');

// VALIDANDO CPF
function validarCpf() {
    cpfInput = seletor('#inputCPF').value;
    cpf = cpfInput.toString();
    cpfLength = cpf.length;

    if(cpfLength != 11){
        seletor('#erroCpf').style.display = 'block';
    } else {
        seletor('#erroCpf').style.display = 'none';
    }
    
  }

// VALIDANDO RG
function validarRg() {
    rgInput = seletor('#inputRG').value;
    rg = rgInput.toString();
    rgLength = rg.length;

    if(rgLength != 9){
        seletor('#erroRg').style.display = 'block';
    } else {
        seletor('#erroRg').style.display = 'none';
    }

  }

// VALINDANDO CEP
cep.setAttribute('onblur', 'pesquisarCep(this.value)')
cep.setAttribute('minlength', '8')
cep.setAttribute('maxlength', '9')

function pesquisarCep( el ) {
    // Limpando o CEP e deixando apenas números
    let cepLimpo = el.replace(/\D/g,'')

    // Garantindo que o CEP não está vazio e está no formato esperado
    let formatoCep = /^[0-9]{8}$/
    
    if ( cepLimpo !== '' && formatoCep.test(cepLimpo) ) {
    
        // Mostrando que os campos serão populados
        endereco.value = '...'
        cidade.value = '...'
        estado.value = '...'
    
        /**
        * ### IMPORTANTE ###
        * Criando o endpoint do ViaCEP
        * callback=retorno_callback_viacep é o parâmetro (do tipo query param)
        * que chama a nossa função callback a partir do recebimento do retorno
        *
        */
    
        scriptCep = document.createElement('script')
        scriptCep.src = `https://viacep.com.br/ws/${cepLimpo}/json/?callback=retorno_callback_viacep`
        document.querySelector('head').appendChild(scriptCep)
    
    }
    
}

function retorno_callback_viacep(resposta) {
    // Caso não haja erros...
    if ( !('erro' in resposta) ) {
        
        // Populamos os campos
        endereco.value = resposta.logradouro
        cidade.value = resposta.localidade
        
        // E no caso da UF
        let estados = formulario.querySelectorAll('option')
        for(cadaEstado of estados){
        
            cadaEstado.value === resposta.uf
            && cadaEstado.setAttribute('selected','')
        
        }
    
    } else {
        // Se der erro, avisamos o usuário, limpamos os campos e focamos no campo CEP novamente
        alert('\nOps!\n\nInfelizmente não encontramos esse CEP...\n\nPor favor, verifique o CEP inserido\n\n')
        endereco.value = ''
        cidade.value = ''
        estado.value = ''
    }
    
}

// VALIDANDO A SENHA
temMaiuscula = /[+A-Z]/
temMinuscula = /[+a-z]/
temNumero = /[+0-9]/
naoTemEspaco = /\S{6,}/

senha.onblur = e => {
    let senha = e.target.value
    
    if ( temMaiuscula.test(senha) && temMinuscula.test(senha) && temNumero.test(senha) && naoTemEspaco.test(senha) ) {
        e.target.classList.remove('text-danger')
    } else {
        e.target.classList.add('text-danger')
    }

    if ( temMaiuscula.test(senha) && temMinuscula.test(senha) && temNumero.test(senha) ) {
        senhaAlphaNum.classList.add('text-success')
        senhaAlphaNum.classList.remove('text-danger')
    } else {
        senhaAlphaNum.classList.add('text-danger')
        senhaAlphaNum.classList.remove('text-success')
    }
}

// VALIDANDO O FORM
function validarForm(){
    if(rgLength == 9 && cpfLength == 11) {
        return true;
    } else {  
        seletor('#erroForm').style.cssText = 'display: block; text-align: center';
        return false;
    }

  }