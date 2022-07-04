<?php
if (isset($_POST['btnInclui']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
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
        $sql = $conx->prepare("SELECT * FROM chale.reserva where (id_chale='$num' and id!='$id')and ((data_ck_in='$datai' or data_ck_out='$dataf') or (data_ck_in='$dataf' or data_ck_out='$datai'))");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $_SESSION['msgerr'] = "Datas Já Reservadas";
            header("Location: ./reserva.php");
        } else {
            try {
                $upd = $conx->prepare("UPDATE chale.reserva set id_cliente='$cpf', id_chale='$num', nome='$nome', data_ck_in='$datai', data_ck_out='$dataf',situação='$situação', preço='$preço' where id='$id'");
                $upd->execute();
                header("Location: ./reserva.php");
            } catch (PDOException $e) {
                $_SESSION['msgerr'] = "Erro na Inclusão1";
                print_r($_POST);
                print($e);
                header("Location: ./reserva.php");
            }
        }
    } else {
        $_SESSION['msgerr'] = "PREÇO FINAL NÃO PODE SER 0 E VERIFIQUE O TEMPO DAS DATAS";
        header("Location: ./reserva.php");
    }
} else {
    $_SESSION['msgerr'] = "Erro na Inclusão";
    header("Location: ./reserva.php");
}
