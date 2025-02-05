<?php

require ('../Model/Produto.php');

$cli = new Produto('', '', '');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "ID Recebido: " . $id;

    $result = $cli->excluir($id);

    if ($result) {
        echo '<script>alert("Produto excluído com sucesso!!")</script>';
        header('Location: ../View/ListarProduto.php');
        exit();
    } else {
        echo '<script>alert("Erro ao excluir!!")</script>';
    }
} else {

}
?>