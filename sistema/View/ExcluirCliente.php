<?php

require ('../Model/Cliente.php');

$cli = new Cliente('', '', '');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "ID Recebido: " . $id;

    $result = $cli->excluir($id);

    if ($result) {
        echo '<script>alert("Cliente excluído com sucesso!!")</script>';
        header('Location: ../View/ListarCliente.php');
        exit();
    } else {
        echo '<script>alert("Erro ao excluir!!")</script>';
    }
} else {

}
?>
