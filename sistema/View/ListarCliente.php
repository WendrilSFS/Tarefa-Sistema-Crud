<?php

require('../DB/Database.php'); 

$database = "sistema";
$host = "localhost";  // IP DO BANCO DE DADOS
$user = "root";
$password = "";

$conn = new mysqli($host,$user,$password,$database);

if($conn->connect_error){
    die("Falha na Conexão" . mysqli_error($conn));
}


$sql = "SELECT * FROM cliente";
$result = mysqli_query($conn, $sql);


if ($result) {

} else {
    echo "Error: " . mysqli_error($conn);
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABELA</title>
    <link rel="stylesheet" href="../Public/form.css">

    
</head>
<body>
    <h1> CLIENTES CADASTRADOS </h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CPF</th>
                <th>E-MAIL</th>
                <th>EDITAR</th>
                <th>EXCLUIR</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($result){
                while( $row = mysqli_fetch_assoc($result) ){
                    $id = $row['id'];
                    $nome = $row['nome'];
                    $cpf = $row['cpf'];
                    $email = $row['email'];
            
                    echo '<tr>
                    <td>'.$id .'</td>
                    <td>'.$nome .'</td>
                    <td>'.$cpf .'</td>
                    <td>'.$email .'</td>
                    <td> <a href="../View/EditarCliente.php?id='.$id.'"> Editar </a> </td>
                    <td> <a href="../View/ExcluirCliente.php?id='.$id.'"> Excluir </a> </td>
                    </tr>';
                }
            }
        ?>
        </tbody>

    </table>

</body>
</html>
