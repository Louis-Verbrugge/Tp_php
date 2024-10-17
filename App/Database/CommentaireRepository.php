
<?php


class CommentaireRepository {

    private $db;

    
    public function __construct($db) {

        $this->db = $db;
    }


    public function created($comment, $user_id, $post_id) {
        $sql = "INSERT INTO commentaire (comment, user_id, post_id) VALUES (:comment, :user_id, :post_id)";
        $res = $this->db->prepare($sql);
        
        $exec = $res->execute(array(
            ":comment" => $comment,
            ":user_id" => $user_id,
            ":post_id" => $post_id
        ));
        
        // vérifier si la requête d'insertion a réussi
        if ($exec) {
            echo 'Données insérées';
        } else {
            echo "Échec de l'opération d'insertion";
        }
    }


    public function readAllComment($id_post) {
        $sql = "SELECT commentaire.*, user.username AS username, user.media_object AS media_object_user
                FROM commentaire 
                JOIN user ON commentaire.user_id = user.id
                WHERE commentaire.post_id = :id_post
                ORDER BY commentaire.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_post' => $id_post]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}


?>