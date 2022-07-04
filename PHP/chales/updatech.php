<?php
if (isset($_POST) && !empty($_POST)) {
    session_start();
    include("../conexão.php");
    extract($_POST);
    echo print_r($_POST);
    $num = $_POST['numapto'];
    $ramal = $_POST['ramal'];
    $ramal = str_replace("-", "", $ramal);
    $preço = $_POST['diaria'];
    $tipo = $_POST['tipo'];
    try {
        $upd = $conx->prepare("UPDATE chale.chales set tipo='$tipo', ramal='$ramal', diária='$preço' where num_apto='$num'");
        $upd->execute();
        header("Location: ./chale.php");
    } catch (PDOException $e) {
        $_SESSION['msgerr'] = "Erro Update";
        header("Location: ./chale.php");
    }
} else {
    $_SESSION['msgerr'] = "ERRO: Não pode acessar por URL ou Sem clicar";
    header("Location: ./chale.php");
}
