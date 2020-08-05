/* const formulario = document.querySelector('#formCadastro');
const nome = document.querySelector('#inputNome');
const sobrenome = document.querySelector('#inputSobrenome');
const email = document.querySelector('#inputEmail');
const cpf = document.querySelector('#inputCPF');
const rg = document.querySelector('#inputRG');
const endereco = document.querySelector('#inputEndereco');
const cep = document.querySelector('#inputCep');
const estado = document.querySelector('#inputUf');
const email = document.querySelector('#inputEmail');
const senha = document.querySelector('#inputSenha');
const senhaConfirma = document.querySelector('#inputConfirma');
const btnEnviar = document.querySelector('#btnEnviar'); 

    */


// Validando CPF
function validarCpf() {
    cpfInput = document.getElementById('inputCPF').value;
    cpf = cpfInput.toString();
    cpfLength = cpf.length;

    if(cpfLength != 11){
        document.getElementById('erroCpf').style.display = 'block';
    } else {
        document.getElementById('erroCpf').style.display = 'none';
    }
    
  }

// Validando RG
function validarRg() {
    rgInput = document.getElementById('inputRG').value;
    rg = rgInput.toString();
    rgLength = rg.length;

    if(rgLength != 9){
        document.getElementById('erroRg').style.display = 'block';
    } else {
        document.getElementById('erroRg').style.display = 'none';
    }

  }

// Validando o form
function validarForm(){
    if(rgLength == 9 && cpfLength == 11) {
        return true;
    } else {  
        document.getElementById('erroForm').style.cssText = 'display: block; text-align: center';
        return false;
    }

  }