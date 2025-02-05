<?php

require ('../Model/Produto.php');
require_once '../DB/Database.php';

$database = "sistema";
$host = "localhost";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$produto = new Produto('', '', '', $conn);

if (isset($_POST['registrar_entrada'])) {
    $id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $result = $produto->registrarEntrada($id, $quantidade);

    if ($result) {
        echo '<script>alert("Entrada registrada com sucesso!");</script>';

        header('Location: ListarProduto.php');
    } else {
        echo 'Erro ao registrar entrada.';
    }
}

if (isset($_POST['registrar_saida'])) {
    $id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $result = $produto->registrarSaida($id, $quantidade);

    if ($result) {
        echo '<script>alert("Saída registrada com sucesso!");</script>';
        
        header('Location: ../View/ListarProduto.php');
    } else {
        echo 'Erro ao registrar saída.';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRAR ENTRADA E SAÍDA</title>
    <link rel="stylesheet" href="../Public/form.css">
</head>
<body>

<h1>REGISTRO DE EBTRADA/SAÍDA</h1>

<form method="post" action="entrada_saida.php">
    <label for="produto_id">PRODUTO:</label>
    <input id="produto_id" name="produto_id">
        <?php
        $sql = "SELECT id, nome FROM produto";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            // echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
        }
        ?>
    </select><br>

    <label for="quantidade">QUANTIDADE:</label>
    <input type="number" id="quantidade" name="quantidade"><br>

    <input type="submit" name="registrar_entrada" value="Registrar Entrada">
    <input type="submit" name="registrar_saida" value="Registrar Saída">
</form>

</body>
</html>

