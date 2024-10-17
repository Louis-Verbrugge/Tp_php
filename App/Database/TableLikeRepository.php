<?php

class TableLikeRepository {

    private $db;


    public function __construct($db) {

        $this->db = $db;
    }

    public function created($post_id, $user_id) {

        $sql = "INSERT INTO tableLike (post_id, user_id) VALUES 
        (:post_id, :user_id)";
        $res = $this->db->prepare($sql);
        
        $exec = $res->execute(array(":post_id"=>$post_id,":user_id"=>$user_id));
        // vérifier si la requête d'insertion a réussix
        if($exec){
            echo 'Données insérées';
        }else{
            echo "Échec de l'opération d'insertion";
        }

    }

    public function hasLiked($post_id, $user_id) {

        $sql = "SELECT * FROM tableLike WHERE post_id= :post_id AND user_id= :user_id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([':post_id' => $post_id, ':user_id' => $user_id]); 

        //var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));

    
        return $stmt->rowCount() > 0;

        //return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete($post_id, $user_id) {

        $sql = "DELETE FROM tableLike WHERE post_id= :post_id AND user_id= :user_id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([':post_id' => $post_id, ':user_id' => $user_id]); 

    }
    
    public function countLike($post_id) {
        $sql = "SELECT * FROM tableLike WHERE post_id= :post_id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([':post_id' => $post_id]); 

        return $stmt->rowCount();
    }



}


?>