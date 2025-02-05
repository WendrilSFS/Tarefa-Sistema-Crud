<?php

$database = "sistema";
$host = "localhost";
$user = "root";
$password = "";

require('../DB/Database.php');

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sql = "SELECT nota.numero, nota.data, cliente.nome AS cliente_nome, produto.nome AS produto_nome, nota.quantidade, nota.valor_total
        FROM nota
        JOIN cliente ON nota.cliente_id = cliente.id
        JOIN produto ON nota.produto_id = produto.id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Notas Fiscais</title>
    <link rel="stylesheet" href="../Public/form.css">
</head>
<body>

<h1>Notas Fiscais</h1>

<table border="1">
    <tr>
        <th>Número</th>
        <th>Data</th>
        <th>Cliente</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor Total</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['numero'] . "</td>";
            echo "<td>" . $row['data'] . "</td>";
            echo "<td>" . $row['cliente_nome'] . "</td>";
            echo "<td>" . $row['produto_nome'] . "</td>";
            echo "<td>" . $row['quantidade'] . "</td>";
            echo "<td>" . $row['valor_total'] . "</td>";
            echo "</tr>";

        }
    } else {
        echo "<tr><td colspan='6'>Nenhuma nota fiscal encontrada.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
