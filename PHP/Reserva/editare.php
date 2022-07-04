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
        $sql = $conx->prepare("SELECT * FROM chale.reserva where id=$id");
        $sql->execute();
        $result = $sql->fetch();
        $cpf = $result['id_cliente'];
        $nome = $result['nome'];
        $datai = $result['data_ck_in'];
        $dataf = $result['data_ck_out'];
        $num = $result['id_chale'];
        $preço = $result['preço'];
        $situação = $result['situação'];
    }
} catch (PDOException $e) {
}
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
    <title>Document</title>
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cpf').prop('readonly', true);
            $('#preço').prop('readonly', true);
            $('#diaria').prop('readonly', true);
            $("#nome").change(function() {
                var selectedchale = $("#nome option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "consultacpf.php",
                    data: {
                        nome: selectedchale
                    }
                }).done(function(data) {
                    $("#cpf").html(data);
                });
            });
            $("#chales").change(function() {
                var selectedchale = $("#chales option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "consultapreço.php",
                    data: {
                        chales: selectedchale
                    }
                }).done(function(data) {
                    $("#diaria").html(data);
                });
            });
            $("#chales").change(function() {
                var selectedchale = $("#chales option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "consultachale.php",
                    data: {
                        chales: selectedchale
                    }
                }).done(function(data) {
                    $("#tipo").html(data);
                });
            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="chale">
    <h1 id="txt1">Editar<h1>
            <main class="cliente">
                <form method="POST" action="./updatere.php?id=<?php echo $id ?>">
                    <legend>Dados</legend>
                    <div class="row">
                        <div class=" inputbox">
                            <label for="nome">Nome</label>
                            <select id="nome" name="nome" required>
                                <?php
                                $sql = $conx->prepare("SELECT * FROM cliente");
                                $sql->execute();
                                $result3 = $sql->fetchAll();
                                foreach ($result3 as $key => $value) {

                                ?>
                                    <option value="<?php echo $value['nome'] ?> " <?php echo ($value['nome'] == $nome) ? "selected" : "" ?>><?php echo $value['nome'] ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="cpf">CPF</label>
                            <select name="cpf" id="cpf" required>
                                <option><?php echo $cpf ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="inputbox">
                            <label for="datai">Entrada</label>
                            <input type="date" id="datai" name="datai" value="<?php echo $datai ?>" min="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="inputbox">
                            <label for="dataf">Saída</label>
                            <input type="date" id="dataf" name="dataf" value="<?php echo $dataf ?>" min="<?php echo date("Y-m-d") ?>" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="chales">Número chale</label>
                            <select id="chales" name="chales" required>
                                <option></option>
                                <?php
                                $conn = mysqli_connect($home, $user, $pass, $bd);
                                $sql = "SELECT * FROM chales";

                                $result3 = mysqli_query($conn, $sql);
                                while ($dados = mysqli_fetch_assoc($result3)) {
                                ?>
                                    <option value="<?php echo $dados['num_apto'] ?>" <?php echo ($dados['num_apto'] == $num) ? "selected" : "" ?>><?php echo $dados['num_apto'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for="tipo">tipo</label>
                            <?php
                            $sql = $conx->prepare("SELECT * FROM chales where num_apto='$num'");
                            $sql->execute();
                            $result3 = $sql->fetch();
                            $tipo = $result3['tipo'];
                            ?>
                            <select id="tipo" name="tipo" required>
                                <option><?php echo $tipo ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="inputbox">
                            <label for="diaria">Diária</label>
                            <?php
                            $sql = $conx->prepare("SELECT * FROM chales where num_apto='$num'");
                            $sql->execute();
                            $result3 = $sql->fetch();
                            $diaria = $result3['diária'];
                            ?>
                            <select id="diaria" name="diaria" required>
                                <option><?php echo $diaria ?></option>
                            </select>
                        </div>


                        <div class="inputbox">
                            <label for="preço">Preço Final</label>
                            <input type="number" id="preço" name="preço" value="<?php echo $preço ?>" pattern="[\d]{1,6}" title="Necessita do preço" required>
                        </div>
                    </div>
                    <div id="submit">
                        <input type="submit" id="submit" value="Editar" name="btnInclui">
                    </div>
                </form>
                <p id="teste"></p>
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
<script type="text/javascript">
    function calculateDays() {
        var d1 = document.getElementById("datai").value;
        var d2 = document.getElementById("dataf").value;
        const dateOne = new Date(d1);
        const dateTwo = new Date(d2);
        const time = Math.abs(dateTwo - dateOne);
        const days = Math.ceil(time / (1000 * 60 * 60 * 24));
        document.getElementById("preço").value = days * parseInt(document.getElementById('diaria').value);
    }
    document.getElementById('chales').addEventListener('focusout', calculateDays);
    document.getElementById('submit').addEventListener('click', calculateDays);
</script>