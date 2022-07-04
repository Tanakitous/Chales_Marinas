<?php
if (isset($_POST['btnInclui'])) {
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
        $sql = $conx->prepare("INSERT INTO chale.chales (num_apto,tipo,ramal,diária) values (?,?,?,?)");
        $sql->execute(array($num, $tipo, $ramal, $preço));
        header("Location: ./chale.php");
    } catch (PDOException $e) {
        $_SESSION['msgerr'] = "Número de Identificação já existe";
        header("Location: ./chale.php");
    }
} else {
    $_SESSION['msgerr'] = "ERRO";
    header("Location: ./chale.php");
}
