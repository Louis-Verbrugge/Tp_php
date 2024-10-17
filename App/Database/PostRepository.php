<?php

//namespace App\Database;

//use \PDO;

class postRepository {

    private $db;

    
    public function __construct($db) {

        $this->db = $db;
    }



    public function delete($idDelete) {

        $sql = "DELETE FROM post WHERE id= :id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([':id' => $idDelete]); 

    }


    public function created($title, $description, $media_object, $user_id) {


        $sql = "INSERT INTO post (title, description, media_object, user_id) VALUES 
        (:title, :description, :media_object, :user_id)";
        $res = $this->db->prepare($sql);
        
        $exec = $res->execute(array(":title"=>$title,":description"=>$description, ":media_object"=>$media_object, "user_id"=>$user_id));
        // vérifier si la requête d'insertion a réussix
        if($exec){
            echo 'Données insérées';
        }else{
            echo "Échec de l'opération d'insertion";
        }
        
    }


    public function update($title, $description, $media_object, $id) {


        $sql = "UPDATE post SET title= :title, description= :description, media_object= :media_object WHERE id= :id";
        $stmt= $this->db->prepare($sql);

        $stmt->execute([':title' => $title, ':description' => $description, ':media_object' => $media_object, ':id' => $id]);

    }

    public function readAllPost() {
        $sql = "SELECT post.*, user.username AS username, user.media_object AS media_object_user
                FROM post 
                JOIN user ON post.user_id = user.id
                ORDER BY post.id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function readOnePost($id) {
        $sql = "SELECT post.*, user.username AS username, user.media_object AS media_object_user
                FROM post 
                JOIN user ON post.user_id = user.id
                Where post.id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }


}

?>