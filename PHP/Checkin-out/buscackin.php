<?php
if (isset($_POST['submit'])) {
    session_start();
    try {
        include("../conexão.php");
        extract($_POST);
        $situação = "Aberto";
        $id = $_POST['reserva'];
        $_SESSION['id'] = $id;
        $sql = $conx->prepare("SELECT * FROM chale.reserva where id='$id' and situação='$situação'");
        $sql->execute();
        if ($sql->rowCount() == 1) {
            header("Location: ./cadastrackin.php");
        } else {
            $_SESSION['msgerr'] = "Reserva não encontrada ou já ativa ou fechada";
            header("Location: ./ckin.php");
        }
    } catch (PDOException $e) {
        $_SESSION['msgerr'] = "CPF não encontrado";
        header("Location: ./ckin.php");
    }
} else {
    $_SESSION['msgerr'] = "CPF não encontrado";
    header("Location: ./ckin.php");
}
