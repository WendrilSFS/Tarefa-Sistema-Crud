<?php
class Estoque {
    private $conn;

    public function __construct($host, $user, $password, $database) {
        $this->conn = new mysqli($host, $user, $password, $database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function adicionarProduto($nome, $valor, $quantidade) {
        $stmt = $this->conn->prepare("INSERT INTO produto (nome, valor, quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $nome, $valor, $quantidade);
        $stmt->execute();
        $stmt->close();
    }

    public function atualizarProduto($id, $nome, $valor, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produto SET nome = ?, valor = ?, quantidade = ? WHERE id = ?");
        $stmt->bind_param("sdii", $nome, $valor, $quantidade, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function registrarEntrada($produto_id, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produto SET quantidade = quantidade + ? WHERE id = ?");
        $stmt->bind_param("ii", $quantidade, $produto_id);
        $stmt->execute();
        $stmt->close();
    }

    public function registrarSaida($produto_id, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produto SET quantidade = quantidade - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantidade, $produto_id);
        $stmt->execute();
        $stmt->close();
    }

    public function emitirNota($cliente_id, $produto_id, $quantidade) {
        $stmt = $this->conn->prepare("INSERT INTO nota (dia, quan_pro, cliente_id, produto_id) VALUES (NOW(), ?, ?, ?)");
        $stmt->bind_param("iii", $quantidade, $cliente_id, $produto_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>
