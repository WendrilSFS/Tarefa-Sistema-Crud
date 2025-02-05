<?php

include ('../DB/Database.php');


$database = "sistema";
$host = "localhost";  
$user = "root";
$password = "";


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Falha na Conexão: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM produto WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $valor = $row['valor'];
        $quantidade = $row['quantidade'];
    } else {
        echo "Produto não encontrado.";
    }
} else {
    
}


if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];

    $update = "UPDATE produto SET nome = '$nome', valor = '$valor', quantidade = '$quantidade' WHERE id = $id";
    $result2 = mysqli_query($conn, $update);

    if ($result2) {
        echo '<script>alert("EDITADO COM SUCESSO!!!")</script>';
        header('Location: ../View/ListarProduto.php');
    } else {
        echo "Erro ao atualizar o produto: " . mysqli_error($conn);
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="stylesheet" href="../Public/form.css">
</head>
<body>

    <h1>EDITAR PRODUTO</h1>

    <form id="formulario" method="post">
        <label for="Nome">NOME</label>
        <input type="text" name="nome" id="nome" value="<?php echo isset($nome) ? $nome : ''; ?>">
        <br>
        <label for="CPF">VALOR</label>
        <input type="text" name="valor" id="valor" value="<?php echo isset($valor) ? $valor : ''; ?>">
        <br>
        <label for="Quantidade">QUANTIDADE</label>
        <input type="text" name="quantidade" id="quantidade" value="<?php echo isset($quantidade) ? $quantidade : ''; ?>">
        <br>
        <input class="botao" type="submit" name="salvar" value="Salvar">
    </form>

</body>
</html>