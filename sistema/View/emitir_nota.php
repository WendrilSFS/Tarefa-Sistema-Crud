<?php

$database = "sistema";
$host = "localhost";
$user = "root";
$password = "";

require('../DB/Database.php');
require ('../Model/Estoque.php');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $data = isset($_POST['data']) ? $_POST['data'] : '';
    $cliente_id = isset($_POST['cliente_id']) ? $_POST['cliente_id'] : '';
    $produto_id = isset($_POST['produto_id']) ? $_POST['produto_id'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';

    // Calcular o valor total com base no preço do produto e a quantidade
    $produto_query = "SELECT valor FROM produto WHERE id = $produto_id";
    $produto_result = $conn->query($produto_query);
    if ($produto_result->num_rows == 1) {
        $produto_row = $produto_result->fetch_assoc();
        $valor_total = $produto_row['valor'] * $quantidade;
    } else {
        echo "Produto não encontrado.";
        $valor_total = 0;
    }

    $sql = "INSERT INTO nota (numero, data, cliente_id, produto_id, quantidade, valor_total) VALUES ('$numero', '$data', '$cliente_id', '$produto_id', '$quantidade', '$valor_total')";

    if ($conn->query($sql) === TRUE) {

       
        header('location: ../View/ListarNotas.php');
        
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMITIR NOTA FISCAL</title>
    <link rel="stylesheet" href="../Public/form.css">
</head>
<body>

<form method="post" action="emitir_nota.php">
    <label for="numero">NÚMERO DA NOTA:</label>
    <input type="text" id="numero" name="numero"><br>

    <label for="data">DATA:</label>
    <input type="date" id="data" name="data"><br>

    <label for="cliente_id">CLIENTE:</label>
    <input id="cliente_id" name="cliente_id">
    
    </select><br>

    <label for="produto_id">PRODUTO:</label>
    <input id="produto_id" name="produto_id">

    </select><br>

    <label for="quantidade">QUANTIDADE:</label>
    <input type="number" id="quantidade" name="quantidade"><br>

    <input type="submit" name="emitir" value="Emitir Nota Fiscal">
</form>

</body>
</html>
