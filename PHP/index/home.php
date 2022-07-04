<?php
session_start();
include('../conexão.php');
include('../header.php');
if (isset($_SESSION['msgerr'])) {
    echo "<script> alert('" . $_SESSION['msgerr'] . "')</script>";
    unset($_SESSION['msgerr']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <video poster="./poster.JPG" autoplay loop muted plays-inline class="back-video">
        <source src="./imagem/production ID_4913027.mp4" type="video/mp4">
    </video>
    <div class="hero">
        <div class="content">
            <h2>Chalé Marina's</h2>
            <div class="container">
                <h4>Live, laugh, love.</h4>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    video {
        position: fixed;
        z-index: -1;
    }

    @media(min-aspect-ratio: 16/9) {
        video {
            width: 100%;
            height: auto;
        }
    }

    @media(max-aspect-ratio:16/9) {
        video {
            width: 100%;
            height: auto;
        }
    }


    .hero {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'sans-serif';
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .content {
        text-align: center;
        margin-top: 13%;
    }

    .content h2 {
        font-size: 120px;
        color: #fff;
        font-weight: 00;
        transition: 0.7s;
    }

    .content h2:hover {
        -webkit-text-stroke: 2px #fff;
        color: transparent;

    }

    .content a {
        text-decoration: none;
        display: inline-block;
        color: #fff;
        font-size: 24px;
        border: 2px solid #fff;
        padding: 14px 70px;
        border-radius: 50px;
        margin-top: 20px;
    }

    .container h4 {

        color: #fff;
    }
</style>