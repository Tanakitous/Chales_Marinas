<?php
if (isset($_POST["tipo"])) {
    include("../conexão.php");
    // Capture selected country
    $tipo = $_POST["tipo"];

    // Define country and city array
    try {
        $sql = $conx->prepare("SELECT * FROM chale.tipo where tipo='$tipo'");
        $sql->execute();

        $result = $sql->fetchAll();
        foreach ($result as $key => $value) {
            echo "<option value = " . $value['preço'] . " >" . $value['preço'] . "</option>";
        }
    } catch (PDOException $e) {
        echo "erro";
    }
}
