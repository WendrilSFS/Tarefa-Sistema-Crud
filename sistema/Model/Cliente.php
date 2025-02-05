<?php

require ('../DB/Database.php');

class Cliente{

    public int $id;
    public string $nome;
    public string $cpf;
    public string $email;

    public function __construct(string $nome, string $cpf, string $email){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
    }

    public function cadastrar(){
        $db = new Database('cliente');
        $result =  $db->insert(
                            [
                            'nome' => $this->nome,
                            'cpf' => $this->cpf,
                            'email' => $this->email,
                            ]
                        );
        
        if($result) {
            return true;
        }
        else{
            return false;
        }
    }

    public static function buscar($where=null,$order=null,$limit=null){
        //FETCHALL
        return (new Database('cliente'))->select()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id){
        return (new Database('cliente'))->delete('id = '.$id);
    }

}