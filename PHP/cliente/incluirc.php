<?php
if (isset($_POST) && !empty($_POST)) {
    session_start();
    include('../conexão.php');
    extract($_POST);
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $tel = str_replace('(', '', $tel);
    $tel = str_replace(')', '', $tel);
    $tel = str_replace('-', '', $tel);
    $email = $_POST['email'];
    $cpf = $_POST['CPF'];
    $cpf = str_replace('-', '', $cpf);
    $cpf = str_replace('.', '', $cpf);
    $sexo = $_POST['genero'];
    $cep = $_POST['CEP'];
    $cep = str_replace('-', '', $cep);
    $num = $_POST['num'];
    $rua  = $_POST['rua'];
    $bairro  = $_POST['bairro'];
    $cidade  = $_POST['cidade'];
    $estado  = $_POST['estado'];
    $complemento = $_POST['complemento'];

    try {
        $ins = $conx->prepare("INSERT INTO chale.cliente (CPF, nome, email, telefone, sexo, cep, rua, num, bairro, cidade, estado, complemento) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $ins->execute(array($cpf, $nome, $email, $tel, $sexo, $cep, $rua, $num, $bairro, $cidade, $estado, $complemento));
        header("Location: ./clienteview.php");             // Volta para o início...
    } catch (PDOException $e) {
        $msgErr = "CPF JÁ INCLUIDO";
        $_SESSION['msgerr'] = $msgErr;
        header('Location: ./clienteview.php');              // Volta para o início...
    }
} else {
    header('Location: ./clienteview.php');
    // Se o botão não foi clicado, voltar para o início...
}
