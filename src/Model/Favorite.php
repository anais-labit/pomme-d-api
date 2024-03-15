<?php
namespace App\Model;
use \PDO;


Class Favorite{
    private $pdo;

    public function __construct(){

        $this->pdo = new \PDO("mysql:host=localhost;dbname=pomme_d_api", "anais", "");
    }

    public function addProduct($id_product){
     
        $smt = $this->pdo->prepare( "INSERT INTO products (id) VALUES (:id)");
        $smt->bindValue(':id', $id_product, PDO::PARAM_INT);
        $smt->execute();
    }

    public function addToFavorite($id_user, $id_product) {

        $smt = $this->pdo->prepare("INSERT INTO user_product (id_product, id_user) VALUES (:id_product, :id_user)");
        $smt->bindValue(':id_product', $id_product, PDO::PARAM_INT);
        $smt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $smt->execute();
    }

    public function select($id_user) 
    {
        $smt = $this->pdo->prepare("SELECT * FROM user_product WHERE id_user  = :id_user");
        $smt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $smt->execute();
        $result = $smt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    
}

?>