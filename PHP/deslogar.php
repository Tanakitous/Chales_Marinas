<?php
session_start();
session_destroy();
$_SESSION['msg'] = 'Deslogado com sucesso';
header("Location: ./login/login.php");
