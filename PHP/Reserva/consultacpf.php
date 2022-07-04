<?php
if (isset($_POST["nome"])) {
    include("../conexão.php");
    // Capture selected country
    $nome = $_POST["nome"];

    // Define country and city array
    try {
        $sql = $conx->prepare("SELECT * FROM chale.cliente where nome='$nome'");
        $sql->execute();

        $result = $sql->fetchAll();
        foreach ($result as $key => $value) { ?>
            <option value="<?php echo $value['CPF'] ?>" <?php echo ($value['nome'] == $nome) ? "selected" : "" ?>><?php echo $value['CPF'] ?> </option>
<?php
        }
    } catch (PDOException $e) {
        echo "erro";
    }
}
?>