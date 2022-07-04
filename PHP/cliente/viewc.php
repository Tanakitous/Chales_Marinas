<?php
session_start();
include('../conexão.php');
include("../header.php");
if (isset($_SESSION['msgerr'])) {
    echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
    unset($_SESSION['msgerr']);
}

try {
    if (!empty($_GET['CPF'])) {
        $cpf2 = $_GET['CPF'];
        $sql = $conx->prepare("SELECT * FROM chale.cliente where CPF=$cpf2");
        $sql->execute();
        $result = $sql->fetch();


        $nome = $result['nome'];
        $estado = $result['estado'];
        $cidade = $result['cidade'];
        $bairro = $result['bairro'];
        $sexo = $result['sexo'];
        $email = $result['email'];
        $CPF = $result['CPF'];
        $cep = $result['cep'];
        $tel = $result['telefone'];
        $num = $result['num'];
        $rua = $result['rua'];
        $complemento = $result['complemento'];
    }
} catch (PDOException $e) {
    $_SESSION['msgerr'] = "";
    header('Location: ./clienteview.php');
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
    <h1 id="txt1">Visualizar</h1>
    <main class="cliente">
        <form method="POST" action="./clienteview.php">
            <legend>Dados Pessoais</legend>
            <div class="row">
                <div class="inputbox">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" placeholder="Nome..." pattern="/^[a-zA-Z]{1,50}+$/" maxlength="50" name="nome" value="<?php echo $nome ?>" disabled required>

                </div>
                <div class="inputbox">
                    <label for="tel">Telefone</label>
                    <input type="text" id="tel" placeholder="(12)93456-7890" value="<?php echo $tel ?>" pattern="(\d{2})[9]{1}[\d]{4}-[\d]{4})" title="Insira o formato correto de telefone celular..." name="tel" disabled required>

                </div>
            </div>
            <div class="row">
                <div class="inputbox">
                    <label for="email">Email</label>
                    <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" maxlength="50" id="emailc" value="<?php echo $email ?>" placeholder="Email..." name="email" disabled required>

                </div>
                <div class="inputbox">
                    <label for="CPF">CPF</label>
                    <input type="text" id="CPF" placeholder="123.456.789-01" value="<?php echo $CPF ?>" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Insira o Formato Correto" name="CPF" disabled required>

                </div>
            </div>
            <div class="row">
                <div class="inputbox">
                    <label for="genero">Sexo</label>
                    <select id="genero" name="genero" disabled required>
                        <option value="M" <?php echo ($sexo == "M") ? "selected" : "" ?>>Masculino</option>
                        <option value="F" <?php echo ($sexo == "F") ? "selected" : "" ?>>Feminino</option>
                        <option value="B" <?php echo ($sexo == "B") ? "selected" : "" ?>>Não Binário</option>
                        <option value="O" <?php echo ($sexo == "O") ? "selected" : "" ?>>Outros</option>
                    </select>

                </div>
            </div>
            <legend>Endereço</legend>
            <div class="row">
                <div class="inputbox">
                    <label for="CEP">CEP</label>
                    <input type="text" id="CEP" placeholder="12345-678" pattern="\d{5}-?\d{3}" maxlength="8" title="Insira o formato correto do CEP" name="CEP" value="<?php echo $cep ?>" disabled required>

                </div>
                <div class="inputbox">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" name="rua" pattern="/^[a-zA-Z]{1,50}+$/" title="Digite a Rua" value="<?php echo $rua ?>" disabled required>

                </div>
            </div>
            <div class="row">
                <div class="inputbox">
                    <label for="num">Número</label>
                    <input type="text" id="num" pattern="\d*" maxlength="5" title="Insira pelo menos um número" size="10" name="num" value="<?php echo $num ?>" disabled required>
                </div>
                <div class="inputbox">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" pattern="/^[a-zA-Z]{1,50}+$/" title="Digite o Bairro" name="bairro" value="<?php echo $bairro ?>" disabled required>

                </div>
            </div>
            <div class="row">
                <div class="inputbox">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" pattern="/^[a-zA-Z]{1,50}+$/" value="<?php echo $cidade ?>" disabled required>
                </div>
                <div class="inputbox">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" disabled required>
                        <option value="AC" <?php echo ($estado == "AC") ? "selected" : "" ?>>AC</option>
                        <option value="AL" <?php echo ($estado == "AL") ? "selected" : "" ?>>AL</option>
                        <option value="AP" <?php echo ($estado == "AP") ? "selected" : "" ?>>AP</option>
                        <option value="AM" <?php echo ($estado == "AM") ? "selected" : "" ?>>AM</option>
                        <option value="BA" <?php echo ($estado == "BA") ? "selected" : "" ?>>BA</option>
                        <option value="CE" <?php echo ($estado == "CE") ? "selected" : "" ?>>CE</option>
                        <option value="DF" <?php echo ($estado == "DF") ? "selected" : "" ?>>DF</option>
                        <option value="ES" <?php echo ($estado == "ES") ? "selected" : "" ?>>ES</option>
                        <option value="GO" <?php echo ($estado == "GO") ? "selected" : "" ?>>GO</option>
                        <option value="MA" <?php echo ($estado == "MA") ? "selected" : "" ?>>MA</option>
                        <option value="MT" <?php echo ($estado == "MT") ? "selected" : "" ?>>MT</option>
                        <option value="MS" <?php echo ($estado == "MS") ? "selected" : "" ?>>MS</option>
                        <option value="MG" <?php echo ($estado == "MG") ? "selected" : "" ?>>MG</option>
                        <option value="PA" <?php echo ($estado == "PA") ? "selected" : "" ?>>PA</option>
                        <option value="PB" <?php echo ($estado == "PB") ? "selected" : "" ?>>PB</option>
                        <option value="PR" <?php echo ($estado == "PR") ? "selected" : "" ?>>PR</option>
                        <option value="PE" <?php echo ($estado == "PE") ? "selected" : "" ?>>PE</option>
                        <option value="PI" <?php echo ($estado == "PI") ? "selected" : "" ?>>PI</option>
                        <option value="RJ" <?php echo ($estado == "RJ") ? "selected" : "" ?>>RJ</option>
                        <option value="RN" <?php echo ($estado == "RN") ? "selected" : "" ?>>RN</option>
                        <option value="RS" <?php echo ($estado == "RS") ? "selected" : "" ?>>RS</option>
                        <option value="RO" <?php echo ($estado == "RO") ? "selected" : "" ?>>RO</option>
                        <option value="RR" <?php echo ($estado == "RR") ? "selected" : "" ?>>RR</option>
                        <option value="SC" <?php echo ($estado == "SC") ? "selected" : "" ?>>SC</option>
                        <option value="SP" <?php echo ($estado == "SP") ? "selected" : "" ?>>SP</option>
                        <option value="SE" <?php echo ($estado == "SE") ? "selected" : "" ?>>SE</option>
                        <option value="TO" <?php echo ($estado == "TO") ? "selected" : "" ?>>TO</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="inputbox">
                    <label for="complemento">Complemento</label>
                    <input type="text" id="complemento" name="complemento" value="<?php echo $complemento ?>" disabled>
                </div>
            </div>

            <input type="submit" id="submit" value="Voltar" name="btnInclui">

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