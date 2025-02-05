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


$sql = "SELECT * FROM produto";
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
    <title>Tabela</title>
    <link rel="stylesheet" href="../Public/form.css">

    
</head>
<body>
    <h1> Produtos Cadastrados </h1>

    <table border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>nome</th>
                <th>valor</th>
                <th>quantidade</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if($result){
                while( $row = mysqli_fetch_assoc($result) ){
                    $id = $row['id'];
                    $nome = $row['nome'];
                    $valor = $row['valor'];
                    $quantidade = $row['quantidade'];
            
                    echo '<tr>
                    <td>'.$id .'</td>
                    <td>'.$nome .'</td>
                    <td>'.$valor .'</td>
                    <td>'.$quantidade .'</td>
                    <td> <a href="../View/EditarProduto.php?id='.$id.'"> Editar </a> </td>
                    <td> <a href="../View/ExcluirProduto.php?id='.$id.'"> Excluir </a> </td>
                    </tr>';
                }
            }
        ?>
        </tbody>

    </table>

</body>
</html>
