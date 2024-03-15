<?php
namespace App\Model;
use \PDO;


Class User{
    private $pdo;

    public function __construct(){

        $this->pdo = new \PDO("mysql:host=localhost;dbname=pomme_d_api", "anais", "");
    }

    public function create($login, $password){
       $smt= $this->pdo->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
         $smt->execute([
              ":login" => $login,
              ":password" => $password
         ]);
        
    }

    public function select ($login , $password=null){
        $smt = $this->pdo->prepare("SELECT * FROM user WHERE login = :login");
        $smt->execute([
            ":login" => $login
        ]);
        $result = $smt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

?>