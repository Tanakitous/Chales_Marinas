<?php
if (!empty($_GET['id'])) {
    try {
        session_start();
        include("../conexão.php");
        $id = $_GET['id'];
        $del = $conx->prepare("DELETE FROM chale.reserva where id='$id'");
        $del->execute();
        $msgerr = "Excluido com sucesso";
        $_SESSION['msgerr'] = $msgerr;
        header("Location: ./reserva.php");
    } catch (PDOException $e) {
        $msgerr = "Erro na Exclusão";
        $_SESSION['msgerr'] = $msgerr;
        print($e);
        header("Location: ./reserva.php");
    }
}
