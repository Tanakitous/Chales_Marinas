<?php
if (isset($_POST['submit'])) {
    session_start();
    try {
        include("../conexão.php");
        extract($_POST);
        $situação = "Aberto";
        $id = $_SESSION['id'];
        $sql = $conx->prepare("SELECT * FROM chale.reserva where id='$id' and situação='$situação'");
        $sql->execute();
        if ($sql->rowCount() == 1) {
            $situação = "Ativo";
            $sql2 = $conx->prepare("UPDATE chale.reserva set situação='$situação' where id='$id'");
            $sql2->execute();
            $_SESSION['msgerr'] = "Check-In realizado com Sucesso";
            unset($_SESSION['id']);
            header("Location: ./ckin.php");
        } else {
            $_SESSION['msgerr'] = "Reserva não encontrada ou já ativa ou fechada";
            unset($_SESSION['id']);
            header("Location: ../reserva/reserva.php");
        }
    } catch (PDOException $e) {
        $_SESSION['msgerr'] = "CPF não encontrado";
        header("Location: ../reserva/reserva.php");
    }
} else {
    $_SESSION['msgerr'] = "CPF não encontrado";
    header("Location: ../reserva/reserva.php");
}
