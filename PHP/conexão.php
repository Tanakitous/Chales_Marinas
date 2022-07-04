<?php

$home = "localhost";
$pass = "";
$user = "root";
$bd = "chale";
$tb = "login";
$tb2 = "cliente";
$tb3 = "";

try {
    $conx = new PDO('mysql:home=' . $home . ';dbname=' . $bd, $user, $pass);
    $conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $msgerr = "Falha de conexão" . $e->getMessage();
    $_SESSION['msgerr'] = $msgerr;
}

/*
cores = #0E0E0E 
        #171717
        #757575


#EBCE07
*/