<?php

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    session_start();
    include('../conexão.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $sql = $conx->prepare("SELECT * FROM login WHERE email = :email AND senha = :senha");
    $sql->bindParam(':email', $email);
    $sql->bindParam(':senha', $senha);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header("Location: ../index/home.php");
    } else {
        $_SESSION['msgerr'] = "Login não existente...<p>Realize um novo login</p>";
        header("Location: ./login.php");
    }
} else {
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        $_SESSION['msgerr'] = "Mensagem* Email não informado...";
        header("Location: ./login.php");
    }
    if (!isset($_POST['senha']) || empty($_POST['senha'])) {
        $_SESSION['msgerr'] = "Mensagem* Senha não informada...";
        header("Location: ./login.php");
    } else {
        header("Location: ./login.php");
    }
}
