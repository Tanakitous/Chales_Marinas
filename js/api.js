'use strict';
const preencheformulario = (endereco) => {
    document.getElementById('rua').value = endereco.logradouro;
    document.getElementById('bairro').value = endereco.bairro;
    document.getElementById('estado').value = endereco.uf;
    document.getElementById('cidade').value = endereco.localidade;
}


const pesquisaCep = async () => {
    const cep2 = document.getElementById('CEP').value;
    const cep = cep2.replace("-", "");
    console.log(cep);
    const url = "http://viacep.com.br/ws/" + cep + "/json/";
    const dados = await fetch(url);
    const endereco = await dados.json();
    preencheformulario(endereco);
}


document.getElementById('CEP').addEventListener('focusout', pesquisaCep);
