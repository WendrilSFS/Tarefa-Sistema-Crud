<?php

class Database{
    public $conn;
    public string $local="localhost";
    public string $db="sistema";
    public string $user = "root";
    public string $password = "";
    public $table;


   public function __construct($table = null){
        $this->table = $table;
        $result = $this->conecta();
    }

    public function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $err) {
            die("Connection Failed: " . $err->getMessage());
        }
    }

    
    public function execute($query,$binds = []){
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        }catch (PDOException $err) {
            die("Connection Failed " . $err->getMessage());
        }
    }

    public function insert($values){
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        $query = 'INSERT INTO ' . $this->table .'  (' .implode(',',$fields). ') VALUES (' .implode(',',$binds).')';
        $result = $this->execute($query,array_values($values));
        
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function select($where = null,$order = null,$limit = null, $fields = '*'){
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT '.$fields. ' FROM ' .$this->table. ' '.$where;
        return $this->execute($query);
    }


    public function delete($id){

        $sql = 'DELETE FROM '.$this->table.' WHERE '.$id;

        $result = $this->execute($sql);

        return true;
    }


}