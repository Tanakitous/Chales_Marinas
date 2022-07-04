<?php
session_start();
include('../conexão.php');
include("../header.php");

if (isset($_SESSION['msgerr'])) {
    echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
    unset($_SESSION['msgerr']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#CEP').mask('00000-000');
            $('#CPF').mask('000.000.000-00');
            $('#tel').mask('(00)00000-0000');
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <h1 id="txt1">Cadastrar<h1>
            <main class="cliente">
                <form method="POST" action="./incluirc.php">
                    <legend>Dados Pessoais</legend>
                    <div class="row">
                        <div class="inputbox">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" placeholder="Nome..." pattern="[A-Za-zÀ-ú ]{1,50}" maxlength="50" name="nome" required>

                        </div>
                        <div class="inputbox">
                            <label for="tel">Telefone</label>
                            <input type="text" id="tel" placeholder="(12)93456-7890" pattern="(\d{2})[9]{1}[\d]{4}-[\d]{4})" title="Insira o formato correto de telefone celular..." name="tel" required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="email">Email</label>
                            <input type="text" id="emailc" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="50" placeholder="Email..." name="email" required>

                        </div>
                        <div class="inputbox">
                            <label for="CPF">CPF</label>
                            <input type="text" id="CPF" placeholder="123.456.789-01" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Insira o Formato Correto" name="CPF" required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="genero">Sexo</label>
                            <select id="genero" name="genero" required>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="B">Não Binário</option>
                                <option value="O">Outros</option>
                            </select>

                        </div>
                    </div>
                    <legend>Endereço</legend>
                    <div class="row">
                        <div class="inputbox">
                            <label for="CEP">CEP</label>
                            <input type="text" id="CEP" placeholder="12345-678" pattern="\d{5}-?\d{3}" maxlength="8" title="Insira o formato correto do CEP" name="CEP" required>

                        </div>
                        <div class="inputbox">
                            <label for="rua">Rua</label>
                            <input type="text" id="rua" name="rua" pattern="[A-Za-zÀ-ú ]{1,50}" title="Digite a Rua" required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="num">Número</label>
                            <input type="text" id="num" pattern="\d*" maxlength="5" title="Insira pelo menos um número" size="10" name="num" required>
                        </div>
                        <div class="inputbox">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" pattern="[A-Za-zÀ-ú ]{1,50}" title="Digite o Bairro" name="bairro" required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" pattern="[A-Za-zÀ-ú ]{1,50}" maxlength="50" required>
                        </div>
                        <div class="inputbox">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" required>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" name="complemento" maxlength="50">
                        </div>
                    </div>
                    <input type="submit" id="submit" value="Cadastrar" name="btnInclui">

                </form>
            </main>
</body>

</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    body {
        background-color: #0E0E0E;
        display: flex;
        justify-content: center;
        flex-direction: column;
        min-height: 100vh;
    }

    .cliente {
        display: flex;
        justify-content: center;
        flex-direction: column;
        flex-grow: 3;
        padding: 20px;
        margin-left: 20%;
        margin-right: 20%;


        background-color: alightcoral;
    }


    #txt1 {
        font-family: 'Poppins', sans-serif;
        text-align: center;
        color: #FDFDFD;
        font-weight: bold;
    }

    .row {
        width: 100%;
        padding: 5px;
        display: grid;
        grid-template-columns: repeat(2, minmax(50%, 1fr));
    }

    input#submit {
        background-color: #EBCE07;
        border-radius: 10px;
        border-color: #EBCE07;
        border-style: none;
        margin: auto;
        margin-left: 40%;
        margin-bottom: 10px;
        font-size: 20px;
        width: 15%;
        margin-right: 45%;

    }

    .inputbox {
        position: relative;
        display: flex;
        height: 40px;
        flex-direction: column;
        margin: 10px;
        width: 80%;

    }

    form {
        background-color: #171717;
        border-radius: 10px;
    }

    legend {
        color: white;
        margin: 10px;
    }

    label {
        position: relative;
        cursor: text;
        font-size: 20px;
        color: white;
        transition: .5s;

    }

    .inputbox input,
    .inputbox select {
        position: relative;
        background-color: #171717;
        margin-right: 10px;
        width: 100%;
        bottom: 0;
        box-shadow: none;
        border: 1px solid #757575;
        outline: none;
        border-radius: 6px;
        transition: .5s;
        font-size: 20px;
        font-weight: bold;

        color: white;
    }
</style>
<script type="text/javascript" src="../../js/api.js"></script>