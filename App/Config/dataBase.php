<?php
class DataBase {

    private PDO $pdo;

    public function __construct() {

        $this->host = "localhost"; //localhost
        $this->database = "testtest"; //testtest
        $this->username = "root"; //root
        $this->password = ""; // ''

        try{
            $this->pdo = new PDO('mysql:host='. $this->host .';dbname='. $this->database, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Voici ton erreur : " . $e->getMessage() . "</br><br/><br/><br/><br/>";
        }

    }

    public function getConnection() {
        return $this->pdo;
    }

}

?>