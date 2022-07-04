<?php
if (isset($_POST['submit'])) {
    session_start();
    try {
        include("../conexão.php");
        extract($_POST);
        $situação = "Ativo";
        $id = $_POST['reserva'];
        $_SESSION['id'] = $id;
        $sql = $conx->prepare("SELECT * FROM chale.reserva where id='$id' and situação='$situação'");
        $sql->execute();
        if ($sql->rowCount() == 1) {
            header("Location: ./cadastrackout.php");
        } else {
            $_SESSION['msgerr'] = "Reserva não encontrada ou já ativa ou fechada";
            header("Location: ./ckout.php");
        }
    } catch (PDOException $e) {
        $_SESSION['msgerr'] = "CPF não encontrado";
        header("Location: ./ckout.php");
    }
} else {
    $_SESSION['msgerr'] = "CPF não encontrado";
    header("Location: ./ckout.php");
}
