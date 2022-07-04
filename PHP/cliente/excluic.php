<?php
if (!empty($_GET['CPF'])) {
    try {
        session_start();
        include("../conexão.php");
        $cpf = $_GET['CPF'];
        $del = $conx->prepare("DELETE FROM $bd.$tb2 where CPF='$cpf'");
        $del->execute();
        $msgerr = "Excluido com sucesso";
        $_SESSION['msgerr'] = $msgerr;
        header("Location:./clienteview.php");
    } catch (PDOException $e) {
        $msgerr = "Erro na Exclusão";
        $_SESSION['msgerr'] = $msgerr;
        header("Location: ./clienteview.php");
    }
}
