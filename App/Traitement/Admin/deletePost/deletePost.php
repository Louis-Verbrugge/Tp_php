
<?php

require "../../../Config/dataBase.php";
require "../../../Database/postRepository.php";


if (array_key_exists('id_post', $_GET)) {

    echo 'voici ID: ' . $_GET['id_post'];

    session_start(); 

    if (!isset($_SESSION["admin"])) {
        
        echo "non admin";
        header('Refresh: 1; url=../../../../index.php');
    
    } else if ($_SESSION["admin"] == false) {
        echo "non admin";
        header('Refresh: 1; url=../../../../index.php');
    
    } else {    

        $connextionBDD = new DataBase() ;
        $bdd = $connextionBDD->getConnection();
        $dataBasePost = new postRepository($bdd);


        $sql = "SELECT * FROM post WHERE id= " . $_GET['id_post'];
        $res = $bdd -> query($sql);

        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        if ($rows[0]['media_object'] !== NULL && $rows[0]['media_object'] !== "") {
            //supprime l'image dans le fichier

            $path = "../../../../uploads/post/" . $rows[0]['media_object'];
            
        
            if (file_exists($path)) {
                echo "image existe";
                unlink($path);
            } else {
                echo "image pas la..";
                echo $path;
            }
        
        
        }


        $dataBasePost->delete($_GET['id_post']);

        //header('Refresh: 0; url=../../index.php');
    }


}


?>