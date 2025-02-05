<?php
     
    require ('../Model/Cliente.php');
    include ('../menu.php');


    $dados = new Cliente('','','');
    $cliente = $dados->buscar();

    if(isset($_POST['Cadastrar'])){
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];

        $cliente = new Cliente($nome, $cpf, $email);
        $result = $cliente->cadastrar();
        if($result){
            echo '<script> alert("CLIENTE CADASTRADO COM SUCESSO!!!") </script>';
            
            header('location: ../View/ListarCliente.php');
        }else{
            echo 'ERROR';

        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="../Public/form.css">
    <link rel="stylesheet" href="../Public/menu.css">
</head>
<body>
    <h1>CADASTRAR CLIENTE</h1>

    <form method="POST">
        <label for="nome">NOME</label>
        <input type="text" name="nome" id="nome" placeholder="digite seu nome"><br>
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" placeholder="digite seu cpf"><br>
        <label for="email">EMAIL</label>
        <input type="text" name="email" id="email" placeholder="digite seu e-mail"><br>
        <input class="botao" type="submit" name="Cadastrar" value="Cadastrar">
    </form>

 