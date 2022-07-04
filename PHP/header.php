<?php
if ((!isset($_SESSION['email'])) or (!isset($_SESSION['senha']))) {
    session_destroy();
    header('Location: ../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index/home.php"><img src="../chale.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="navbar-brand">
                        <a class="nav-link active" aria-current="page" href="../cliente/clienteview.php">Clientes</a>
                    </li>
                    <li class="navbar-brand">
                        <a class="nav-link active" aria-current="page" href="../chales/chale.php">Chalés</a>
                    </li>
                    <li class="navbar-brand">
                        <a class="nav-link active" aria-current="page" href="../reserva/reserva.php">Reservas</a>
                    </li>
                    <li class="navbar-brand dropdown">
                        <a class="nav-link active dropdown-toggle" aria-current="page" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Atendimento
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item dropdown-toggle" aria-current="page" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Check-In</a>
                                <ul class="dropdown-menu dropdown-submenu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li>
                                        <button id="btnCadastra" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cadastrackin">Cadastrar</button>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../Checkin-out/ckin.php">Listar</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item dropdown-toggle" aria-current="page" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Check-Out</a>
                                <ul class="dropdown-menu dropdown-submenu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li>
                                        <button id="btnCadastra" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cadastrackout">Cadastrar</button>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../Checkin-out/ckout.php">Listar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="../deslogar.php" class="btn btn-danger">Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Modal Check-In -->
    <form action="../Checkin-out/buscackin.php" method="POST">
        <div class="modal fade" id="cadastrackin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Realizar Check-In</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0">
                        <input type="text" class="form-control" id="reserva" name="reserva" placeholder="Id da Reserva..." pattern="\d{1,20}" title="Insira um ID de reserva">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="submit" onclick="return confirm('Deseja Realizar o Check-In dessa reserva?')" class="btn btn-primary">Check-In</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal Check-Out -->
    <form action="../Checkin-out/buscackout.php" method="POST">
        <div class="modal fade" id="cadastrackout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content bg-dark">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Realizar Check-Out</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0">
                        <input type="text" class="form-control" id="reserva" name="reserva" placeholder="Id da Reserva Ativa..." pattern="\d{1,20}" title="Insira um ID de reserva">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="submit" onclick="return confirm('Deseja Realizar o Check-In dessa reserva?')" class="btn btn-primary">Check-Out</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>

<style>
    img {
        height: 50px;
        display: inline-block;
    }

    /* Modify the background color */

    .navbar-custom {
        background-color: lightgreen;
    }

    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .dropdown-submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }

    .dropdown-menu .dropdown-submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu>li:hover>.dropdown-submenu {
        display: block;
    }
</style>