<?php

include ('../DB/Database.php');
include ('../menu.php');

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

    $sql = "SELECT * FROM cliente WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $email = $row['email'];
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    
}


if (isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $update = "UPDATE cliente SET nome = '$nome', cpf = '$cpf', email = '$email' WHERE id = $id";
    $result2 = mysqli_query($conn, $update);

    if ($result2) {
        echo '<script>alert("EDITADO COM SUCESSO!!!")</script>';

        header('Location: ../View/ListarCliente.php');
    } else {
        echo "Erro ao atualizar o cliente: " . mysqli_error($conn);
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Clientes</title>
    <link rel="stylesheet" href="../Public/form.css">
    <link rel="stylesheet" href="../Public/menu.css">
</head>
<body>

    <h1>EDITAR CLIENTES</h1>

    <form id="formulario" method="post">
        <label for="Nome">NOME</label>
        <input placeholder="Atualizar Nome" type="text" name="nome" id="nome">
        <br>
        <label for="CPF">CPF</label>
        <input placeholder="Atualizar cpf" type="text" name="cpf" id="cpf" value="<?php echo isset($cpf) ? $cpf : ''; ?>">
        <br>
        <label for="E-mail">E-MAIL</label>
        <input placeholder="Atualizar email" type="text" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br>
        <input class="botao" type="submit" name="salvar" value="Salvar">
    </form>

</body>
</html>
