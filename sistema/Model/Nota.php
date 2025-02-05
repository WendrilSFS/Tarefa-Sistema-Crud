<?php
class Nota {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function emitirNota($numero, $data, $cliente_id, $produto_id, $quantidade) {
        $produto_sql = "SELECT valor FROM produto WHERE id = $produto_id";
        $produto_result = $this->conn->query($produto_sql);
        $produto_row = $produto_result->fetch_assoc();
        $valor_unitario = $produto_row['valor'];
        
        $valor_total = $valor_unitario * $quantidade;

        $sql = "INSERT INTO notas (numero, data, cliente_id, produto_id, quantidade, valor_total) 
                VALUES ('$numero', '$data', '$cliente_id', '$produto_id', '$quantidade', '$valor_total')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function listarNotas() {
        $sql = "SELECT notas.id, notas.numero, notas.data, cliente.nome AS cliente_nome, produto.nome AS produto_nome, notas.quantidade, notas.valor_total 
                FROM notas
                JOIN cliente ON notas.cliente_id = cliente.id
                JOIN produto ON notas.produto_id = produto.id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}
?>
