<?php

require ('../Model/Produto.php');
require_once '../DB/Database.php';
include ('../menu.php');

$database = "sistema";
$host = "localhost";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$dados = new Produto('', '', '', $conn);
$produto = $dados->buscar();

if (isset($_POST['Cadastrar'])) { 
    $nome = $_POST['Nome']; 
    $valor = $_POST['Valor']; 
    $quantidade = $_POST['Quantidade']; 

    $produto = new Produto($nome, $valor, $quantidade, $conn); 
    $result = $produto->cadastrar(); 

    if ($result) {
        echo '<script>alert("PRODUTO CADASTRADO COM SUCESSO!!!");</script>';

        header('Location: ../View/ListarProduto.php');
        exit(); 
    } else {
        echo 'ERROR';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRAR PRODUTO</title>
    <link rel="stylesheet" href="../Public/form.css">
    <link rel="stylesheet" href="../Public/menu.css">
</head>
<body>
    <h1> CADASTRAR PRODUTOS</h1>
    <form id="Formulario" method="post">
        <label for="Nome">NOME</label>
        <input type="text" name="Nome" id="Nome" placeholder="Insira o nome do produto">
        <br>
        <label for="Valor">VALOR</label>
        <input type="text" name="Valor" id="Valor" placeholder="Insira o Valor">
        <br>
        <label for="Quantidade">QUANTIDADE</label>
        <input type="text" name="Quantidade" id="Quantidade" placeholder="Insira a Quantidade">
        <br>
        <input class="botao" type="submit" name="Cadastrar" value="Cadastrar">
    </form>
</body>
</html>
