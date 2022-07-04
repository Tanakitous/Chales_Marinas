<?php
if (isset($_POST['btnInclui'])) {
    session_start();
    include('../conexão.php');
    extract($_POST);
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $datai = $_POST['datai'];
    $dataf = $_POST['dataf'];
    $num = $_POST['chales'];
    $preço = $_POST['preço'];
    $situação = "Aberto";
    if (($preço != 0 || $preço != '0') && ($datai < $dataf)) {
        $sql = $conx->prepare("SELECT * FROM chale.reserva where id_chale='$num' and ((data_ck_in='$datai' or data_ck_out='$dataf') or (data_ck_in='$dataf' or data_ck_out='$datai'))");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $_SESSION['msgerr'] = "Datas Já Reservadas";
            header("Location: ./reserva.php");
        } else {
            try {

                $conx->query("INSERT INTO chale.reserva VALUES (null, '$cpf', '$num', '$nome', '$datai', '$dataf','$situação', '$preço')");

                header("Location: ./reserva.php");
            } catch (PDOException $e) {
                $_SESSION['msgerr'] = "Erro na Inclusão1";
                header("Location: ./reserva.php");
            }
        }
    } else {
        $_SESSION['msgerr'] = "PREÇO FINAL NÃO PODE SER 0 E VERIFIQUE O TEMPO DAS DATAS";
        header("Location: ./reserva.php");
    }
} else {
    $_SESSION['msgerr'] = "Erro na Inclusão2";
    header("Location: ./reserva.php");
}
