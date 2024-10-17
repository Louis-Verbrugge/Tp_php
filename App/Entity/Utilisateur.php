<?php

class Utilisateur {

    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $media_object;
    private string $created_at;
    private string $last_connection;


    public function __construct(int $id, string $username, string $email, string $password, string $media_object, string $created_at, string $last_connection) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->media_object = $media_object;
        $this->created_at = $created_at;
        $this->last_connection = $last_connection;

    }


    public function displayNameEmail(): Void {
        echo 'nom: ' . $this->username .  "  |  email: " . $this->email;
    }


    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getMedia_object() { return $this->media_object; }
    public function getCreated_at() { return $this->created_at; }
    public function getLast_connection() { return $this->last_connection; }

    
    //public function setId($newID) { $this->id = $newID; }
    public function setUsername($newUsername) { $this->iunewUsernamesernamed = $username; }
    public function setEmail($newEmail) { $this->email = $newEmail; }
    public function setPassword($newPassword) { $this->password = $newPassword; }
    public function setMedia_object($newMedia_object) { $this->media_object = $newMedia_object; }
    public function setCreated_at($newCreated_at) { $this->created_at = $newCreated_at; }
    public function setLast_connection($newLast_connection) { $this->last_connection = $newLast_connection; }




}




?>