<?php
session_start();
unset($_SESSION['senha']);
unset($_SESSION['email']);
$msg = $_SESSION['msg'] ?? "Login";
$msgerr = $_SESSION['msgerr'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="login bg-dark">
        <?php echo "<h1>$msg</h1>";
        unset($_SESSION['msg']); ?>
        <form action="./logar.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"><b>Email:</b></label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu e-mail corporativo..." name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"><b>Senha:</b></label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Sua senha..." name="senha">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <?php echo $msgerr;
        unset($_SESSION['msgerr']); ?>
    </div>
</body>

</html>
<style>
    div.login {
        display: flex;
        margin: 0 auto;
        margin-left: 30%;
        margin-right: 30%;
        padding: 20px;
        border-radius: 10px;
        margin-top: 9%;
        justify-content: center;
        flex-direction: column;
    }

    button {
        margin-left: 45%;
        margin-right: 50%;
    }

    h1 {
        text-align: center;
    }

    body {
        background-color: #0E0E0E;
        color: white;
    }
</style>
<script>
    alert("LOGIN ADM \nusuário: admin@chalesma.com \nsenha: admin123");
    alert("LOGIN FUNCIONÁRIO \nusuário: funcionario@chalesma.com \nsenha: funcionario123");
</script>