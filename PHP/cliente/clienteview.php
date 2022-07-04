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
        <div class=" w-auto ml-5 mr-5 pt-2 pb-2 text-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">CEP</th>
                        <th scope='col'> <a href="./cliente.php" class="btn btn-success">Cadastrar</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = $conx->prepare("SELECT * FROM chale.cliente order by CPF");
                        $sql->execute();

                        $query = $sql->fetchAll();
                        foreach ($query as $key => $value) {
                            echo "<tr class='resultado'>";
                            echo "<td>" . $value['CPF'] . "</td>";
                            echo "<td>" . $value['nome'] . "</td>";
                            echo "<td>" . $value['email'] . "</td>";
                            echo "<td>" . $value['telefone'] . "</td>";
                            echo "<td>" . $value['sexo'] . "</td>";
                            echo "<td>" . $value['cep'] . "</td>";
                            echo "<td>
                                    <a href='./viewc.php?CPF=" . $value['CPF'] . "'  name='btnView'  class='btn btn-secondary'>Detalhes</a>
                                    <a href='./editarc.php?CPF=" . $value['CPF'] . "'name='btnEditar' class='btn btn-warning'>Editar</a>
                                    <a href='./excluic.php?CPF=" . $value['CPF'] . "'name='btnExclui' onclick='return confirm(\"Deseja excluir " . $value['nome'] .  ", com CPF: " . $value['CPF'] . "?\")' class='btn btn-danger'>Excluir</a></td>";
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