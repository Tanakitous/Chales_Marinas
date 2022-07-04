<?php
if (isset($_POST) && !empty($_POST)) {
    session_start();
    include('../conexão.php');
    extract($_POST);
    $cpf2 = $_GET['CPF'];
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
        $sql = $conx->prepare("SELECT * FROM chale.cliente where CPF='$cpf' and CPF!='$cpf2'");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $msgErr = "Tentativa de alterar CPF de outro usuário";
            $_SESSION['msgerr'] = $msgErr;
            header('Location: ./clienteview.php');
        } else {
            $update = $conx->prepare("UPDATE chale.cliente set nome='$nome', email='$email', telefone='$tel', sexo='$sexo', cep='$cep', rua='$rua', num='$num', bairro='$bairro', cidade='$cidade', estado='$estado', complemento='$complemento'  where CPF='$cpf'");
            $update->execute();
            header("Location: ./clienteview.php");
        }            // Volta para o início...
    } catch (PDOException $e) {
        $msgErr = "Erro no update:<br />";
        $_SESSION['msgerr'] = $msgErr;
        header('Location: ./clienteview.php');              // Volta para o início...
    }
} else {
    $msgErr = "Erro no update 2:<br />";
    $_SESSION['msgerr'] = $msgErr;
    header('Location: ./clienteview.php');
    // Se o botão não foi clicado, voltar para o início...
}
