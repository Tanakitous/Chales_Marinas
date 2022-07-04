<?php
session_start();
include('../conexão.php');
include("../header.php");

if (isset($_SESSION['msgerr'])) {
    echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
    unset($_SESSION['msgerr']);
}
?>

< <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <body>
        <div class=" col-6 m-auto ml-5 mr-5 pt-2 pb-2 text-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ramal</th>
                        <th scope="col">Diária</th>
                        <th scope='col'><?php if ($_SESSION['email'] == "admin@chalesma.com") { ?> <a href="./cadastrach.php" class="btn btn-success">Cadastrar</a><?php } ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = $conx->prepare("SELECT * FROM chale.chales order by num_apto");
                        $sql->execute();

                        $query = $sql->fetchAll();
                        foreach ($query as $key => $value) {
                            echo "<tr class='resultado'>";
                            echo "<td>" . $value['num_apto'] . "</td>";
                            echo "<td>" . $value['tipo'] . "</td>";
                            echo "<td>" . $value['ramal'] . "</td>";
                            echo "<td>" . $value['diária'] . "</td>";
                            echo "<td>
                                    <a href='./viewch.php?id=" . $value['num_apto'] . "'  name='btnView'  class='btn btn-secondary'>Detalhes</a> ";
                            if ($_SESSION['email'] == "admin@chalesma.com") {
                                echo "<a href='./editach.php?id=" . $value['num_apto'] . "'name='btnEditar' class='btn btn-warning'>Editar</a>
                                <a href='./excluich.php?id=" . $value['num_apto'] . "'name='btnExclui' onclick='return confirm(\"Deseja excluir o chalé " . $value['tipo'] .  ", com número: " . $value['num_apto'] . "?\")' class='btn btn-danger'>Excluir</a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>

    <style>
        body {
            background-color: #171717;
        }

        .resultado {
            background-color: white;
        }
    </style>
    <?php
    $msg = $_SESSION['msg'] ?? "Bem vindo, " . $_SESSION['email'];

    if (isset($_SESSION['msgerr'])) {
        echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
        unset($_SESSION['msgerr']);
    }

    ?>