<?php
if (isset($_POST['submit'])) {
    session_start();
    try {
        include("../conexão.php");
        extract($_POST);
        $situação = "Ativo";
        $id = $_SESSION['id'];
        $sql = $conx->prepare("SELECT * FROM chale.reserva where id='$id' and situação='$situação'");
        $sql->execute();
        if ($sql->rowCount() == 1) {
            $situação = "Fechado";
            $sql2 = $conx->prepare("UPDATE chale.reserva set situação='$situação' where id='$id'");
            $sql2->execute();
            $_SESSION['msgerr'] = "Check-Out realizado com Sucesso";
            unset($_SESSION['id']);
            header("Location: ./ckout.php");
        } else {
            $_SESSION['msgerr'] = "Reserva não encontrada ou já fechada ou aberta";
            unset($_SESSION['id']);
            header("Location: ../reserva/reserva.php");
        }
    } catch (PDOException $e) {
        $_SESSION['msgerr'] = "Erro no Check-Out";
        header("Location: ../reserva/reserva.php");
    }
} else {
    $_SESSION['msgerr'] = "Erro no Chekout";
    header("Location: ../reserva/reserva.php");
}
