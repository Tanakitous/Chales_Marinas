<?php
session_start();
include('../conexão.php');
include("../header.php");
if (isset($_SESSION['msgerr'])) {
    if ($_SESSION['msgerr'] == "CPF não encontrado") {
        echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
        echo "<script>if(confirm(\"Quer Cadastrar esse cliente?\")) window.location.href = \"../cliente/cliente.php\" </script>";
        unset($_SESSION['msgerr']);
    } else {
        echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
        unset($_SESSION['msgerr']);
    }
}
?>

<<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#cpf').mask('000.000.000-00');
            });
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <body>
        <div class=" w-auto ml-5 mr-5 pt-2 pb-2 text-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Chalé</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Saída</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Situação</th>
                        <th scope='col'> <button id="cadastrar" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success">Cadastrar</button></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = $conx->prepare("SELECT * FROM chale.reserva order by id");
                        $sql->execute();

                        $query = $sql->fetchAll();
                        foreach ($query as $key => $value) {
                            echo "<tr class='resultado'>";
                            echo "<td>" . $value['id'] . "</td>";
                            echo "<td>" . $value['id_cliente'] . "</td>";
                            /*$cpf = $value['id_cpf'];
                            $sql2 = $conx->prepare("SELECT * FROM chale.cliente where CPF='$cpf'");
                            $sql2->execute();
                            $result = $sql2->fetch();*/
                            echo "<td>" . $value['nome'] . "</td>";
                            echo "<td>" . $value['id_chale'] . "</td>";
                            echo "<td>" . $value['data_ck_in'] . "</td>";
                            echo "<td>" . $value['data_ck_out'] . "</td>";
                            echo "<td>" . $value['preço'] . "</td>";
                            echo "<td>" . $value['situação'] . "</td>";
                            echo "<td>
                                    <a href='./viewre.php?id=" . $value['id'] . "'  name='btnView'  class='btn btn-secondary'>Detalhes</a>
                                    <a href='./editare.php?id=" . $value['id'] . "'name='btnEditar' class='btn btn-warning'>Editar</a>
                                    <a href='./excluire.php?id=" . $value['id'] . "'name='btnExclui' onclick='return confirm(\"Deseja excluir a reserva #" . $value['id'] .  ", de " . $value['nome'] . "?\")' class='btn btn-danger'>Excluir</a></td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <form action="./cadastrare.php" method="POST">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content bg-dark">
                        <div class="modal-header border-0">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Busca de Clientes</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body border-0">
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="123.456.789-01" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Insira o formato correto de CPF">
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    if (isset($_SESSION['msgerr'])) {
        echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
        unset($_SESSION['msgerr']);
    }
    ?>