<?php
if (!empty($_GET['id'])) {
    try {
        session_start();
        include("../conexão.php");
        $num = $_GET['id'];
        $del = $conx->prepare("DELETE FROM chale.chales where num_apto='$num'");
        $del->execute();
        $msgerr = "Excluido com sucesso";
        $_SESSION['msgerr'] = $msgerr;
        header("Location: ./chale.php");
    } catch (PDOException $e) {
        $msgerr = "Erro na Exclusão";
        $_SESSION['msgerr'] = $msgerr;
        header("Location: ./chale.php");
    }
}
