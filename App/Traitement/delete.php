<?php

require "../Config/dataBase.php";
require "../Database/UserRepository.php";


if (array_key_exists('id', $_GET)) {

    echo 'voici ID: ' . $_GET['id'];

    $connextionBDD = new DataBase() ;
    $bdd = $connextionBDD->getConnection();
    $dataBaseUser = new UserRepository($bdd);


    $sql = "SELECT * FROM user WHERE id= " . $_GET['id'];
    $res = $bdd -> query($sql);

    $rows = $res->fetchAll(PDO::FETCH_ASSOC);

    if ($rows[0]['media_object'] !== NULL && $rows[0]['media_object'] !== "") {
        //supprime l'image dans le fichier

        $path = "../../uploads/" . $rows[0]['media_object'];
    
    
        if (file_exists($path)) {
            echo "image existe";
            unlink($path);
        } else {
            echo "image pas la..";
        }
    
    
    }


    $dataBaseUser->delete($_GET['id']);
    header('Refresh: 0; url=../../index.php');



}


?>