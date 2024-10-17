<?php

//namespace App\Database;

//use \PDO;

class UserRepository {

    private $db;

    


    public function __construct($db) {

        $this->db = $db;
    }


    public function read($id) {

        $sql = "SELECT * FROM user WHERE id= :id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([':id' => $id]); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function readAll() {

        $sql = "SELECT * FROM user";
        $stmt= $this->db->prepare($sql);
        $stmt->execute(); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function delete($idDelete) {

        $sql = "DELETE FROM user WHERE id= :id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute([':id' => $idDelete]); 

    }

    public function created($username, $email, $password, $mediaObject) {

        date_default_timezone_set('Europe/Paris');

        $sql = "INSERT INTO user (username, email, password, media_object,  created_at) VALUES 
        (:username, :email, :password, :media_object, :created_at)";
        $res = $this->db->prepare($sql);
        $exec = $res->execute(array(":username"=>$username,":email"=>$email, ":password"=>$password, "media_object"=>$mediaObject, "created_at"=>date("Y-m-d H:i:s")));
        // vérifier si la requête d'insertion a réussi
        if($exec){
            echo 'Données insérées';
        }else{
            echo "Échec de l'opération d'insertion";
        }

    }


    public function update($username, $email, $password, $media_object, $id) {


        $sql = "UPDATE user SET username= :username, email= :email, password= :password, media_object= :media_object WHERE id= :id";
        $stmt= $this->db->prepare($sql);

        $stmt->execute([':username' => $username, ':email' => $email, ':password' => $password, ':media_object' => $media_object,':id' => $id]);

    }


    public function login($email, $password) {


        echo "voici ton email ". $email . '</br>';
        //return array(s'il est connecte, id)
    
    
        $sql = "SELECT * FROM user WHERE email= '" . $email . "'";

        $res = $this->db->query($sql);
    
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) >= 1) {
  
            if ($rows[0]['id'] !== NULL && $rows[0]['id'] !== "") {
            

                if ($this->checkPassword($password, $rows[0]['password'])) {
                    return array(true, $rows[0]['id']);
                }
                
                else {
                    return array(false, "pas le bon mot de passe");
                }




        
            }
        }
  
        return array(false, "aucun compte a cette email");
    }




    public function getIDwithEmail($email) {

        //return array(si il y a une erreur, id)

        $sql = "SELECT * FROM user WHERE email= '" . $email . "'";

        $res = $this->db->query($sql);
    
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        if (count($rows) >= 1) {
  
            if ($rows[0]['id'] !== NULL && $rows[0]['id'] !== "") {
            
                return array(false, $rows[0]['id']);
        
            }
        }

        return array(true, "erreur cette email a pas ID");
    }

    public function cryptPassord($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    private function checkPassword($password, $passwordHash) {
        echo $password . '    ii   ' . $passwordHash; 
        if (password_verify($password, $passwordHash)) {
            echo "  | bon mdp ùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùù";
        } else {
            echo " \ pas bon mdr.... ùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùù";
        }
        return (password_verify($password, $passwordHash));
    }


    

}

?>