<?php
class Produto {
    private $nome;
    private $valor;
    private $quantidade;
    private $conn;

    public function __construct($nome, $valor, $quantidade, $conn) {
        $this->nome = $nome;
        $this->valor = $valor;
        $this->quantidade = $quantidade;
        $this->conn = $conn;
    }

    public function cadastrar() {
        $stmt = $this->conn->prepare("INSERT INTO produto (nome, valor, quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $this->nome, $this->valor, $this->quantidade);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function buscar() {
        $sql = "SELECT * FROM produto";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function atualizar($id, $nome, $valor, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produto SET nome = ?, valor = ?, quantidade = ? WHERE id = ?");
        $stmt->bind_param("sdii", $nome, $valor, $quantidade, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM produto WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function registrarEntrada($id, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produto SET quantidade = quantidade + ? WHERE id = ?");
        $stmt->bind_param("ii", $quantidade, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function registrarSaida($id, $quantidade) {
        $stmt = $this->conn->prepare("UPDATE produto SET quantidade = quantidade - ? WHERE id = ?");
        $stmt->bind_param("ii", $quantidade, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>
