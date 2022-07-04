<?php
if (isset($_POST["chales"])) {
    include("../conexão.php");
    // Capture selected country
    $chales = $_POST["chales"];

    // Define country and city array
    try {
        $sql = $conx->prepare("SELECT * FROM chale.chales where num_apto='$chales'");
        $sql->execute();

        $result = $sql->fetchAll();
        foreach ($result as $key => $value) {
            echo "<option value = " . $value['diária'] . " >" . $value['diária'] . "</option>";
        }
    } catch (PDOException $e) {
        echo "erro";
    }
}
