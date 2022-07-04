<?php
session_start();
include('../conexão.php');
include("../header.php");
if (isset($_SESSION['msgerr'])) {
    echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
    unset($_SESSION['msgerr']);
}
try {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = $conx->prepare("SELECT * FROM chale.chales where num_apto=$id");
        $sql->execute();
        $result = $sql->fetch();


        $diária = $result['diária'];
        $tipo = $result['tipo'];
        $num_apto = $result['num_apto'];
        $ramal = $result['ramal'];
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
    <title>Document</title>
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ramal').mask('0000-0000');
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="chale">
    <h1 id="txt1">CADASTRO<h1>
            <main class="cliente">
                <form method="POST" action="./chale.php">
                    <legend>Dados</legend>
                    <div class="row">
                        <div class="inputbox">
                            <label for="numapto">Número</label>
                            <input type="text" id="numapto" name="numapto" pattern="[\d]{1,2}" title="Insira o número do chalé" value="<?php echo $num_apto ?>" placeholder="01" maxlength="2" disabled required>
                        </div>
                        <div class="inputbox">
                            <label for="ramal">Ramal</label>
                            <input type="text" id="ramal" placeholder="1234-5678" pattern="[\d]{4}-[\d]{4}" title="Insira o formato correto de ramal..." value="<?php echo $ramal ?>" name="ramal" disabled required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="tipo">Tipo</label>
                            <select id="tipo" name="tipo" disabled required>
                                <option></option>
                                <option value="Grande" <?php echo ($tipo == "G") ? "selected" : "" ?>>Grande</option>
                                <option value="Médio" <?php echo ($tipo == "M") ? "selected" : "" ?>>Médio</option>
                                <option value="Pequeno" <?php echo ($tipo == "P") ? "selected" : "" ?>>Pequeno</option>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="diaria">Diária</label>
                            <select id="diaria" name="diaria" disabled required>
                                <option></option>
                                <option value="300.00" <?php echo ($diária == "300.00") ? "selected" : "" ?>>300.00</option>
                                <option value="220.00" <?php echo ($diária == "220.00") ? "selected" : "" ?>>220.00</option>
                                <option value="150.00" <?php echo ($diária == "150.00") ? "selected" : "" ?>>150.00</option>
                            </select>
                        </div>
                    </div>

                    <div id="submit">
                        <input type="submit" id="submit" value="Voltar" name="btnInclui">
                    </div>
                </form>
            </main>
</body>

</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    body.chale {
        background-color: #0E0E0E;
        display: flex;
        justify-content: center;
        flex-direction: column;

    }

    .cliente {
        display: flex;
        justify-content: center;
        flex-direction: column;
        flex-grow: 3;
        padding: 20px;
        margin-left: 20%;
        margin-right: 20%;

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

    div#submit {
        margin-top: 5px;
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
<script>
    const valida = () => {
        const tamanho = document.getElementById('tipo').value;
        console.log(tamanho);
        if (tamanho == "G")
            document.getElementById('diaria').value = "300.00";
        if (tamanho == "M") {
            document.getElementById('diaria').value = "220,00";
        } else
            document.getElementById('diaria').value = "150,00";
    };
    document.getElementById('tipo').addEventListener("", valida);
</script>