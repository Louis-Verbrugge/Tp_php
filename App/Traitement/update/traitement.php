<?php

require "../../Config/dataBase.php";
require "../../Database/UserRepository.php";
require "../../Validator/ValidatorInput.php";

$validator = new ValidatorInput();


function verifImage() {
    
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
            
        $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
        $fileName = $_FILES['fileToUpload']['name'];
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileType = $_FILES['fileToUpload']['type'];
        

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $extensionsPossible = array("jpg", "jpeg", "png");

        if (in_array($fileExtension, $extensionsPossible)) {

            if ($fileSize  < 2000000) {
                $uploadFileDir = '../../../uploads/';

                $fileName = uniqid() . $fileName;

                $dest_path = $uploadFileDir . $fileName;

                echo "l'image et ici : " . $dest_path;

                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    die();
                }

                return array(true, $fileName);

            } else {
                //echo "fichier trop lourd";
                return array(false, "fichier trop lourd");
            }

         
        } else {
            //echo "tu n'as pas le bon format";
            return array(false, "tu n'as pas le bon format");

        }

    }   else {
        echo "pas de fichier";  

        return array(true, "image_defaut.png");

    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!array_key_exists('id', $_GET)) {
        echo "aucun id";
        header('Refresh: 2; url=./update.php');
    }

    $messageErreur = [];


    if ($validator->checkText($_POST['username'])){
        array_push($messageErreur, "pas de username");
    }   

    if ($validator->checkText($_POST['email'])){
        array_push($messageErreur, "pas de email");     
    }  

    if ($validator->checkPassword($_POST['password'])) {
        array_push($messageErreur, "le password est trop court");
    }

    
    echo 'voici ID: ' . $_GET['id'];

    if (count($messageErreur) == 0) {

        $connextionBDD = new DataBase() ;
        $bdd = $connextionBDD->getConnection();
        $dataBaseUser = new UserRepository($bdd);   

        $listeReturn = verifImage();

        if (!$listeReturn[0]) {
            echo $listeReturn[1];
        } else {

            $password = $dataBaseUser->cryptPassord($_POST["password"]);

            $dataBaseUser->update($_POST["username"], $_POST["email"], $password, $listeReturn[1], $_GET['id']);
            

        }
    } else {
        echo "<h1>problème:</h1>";
        foreach ($messageErreur as $elem) {
            echo '<h4>' . $elem . '</h4>';
        }

        header('Refresh: 2; url=./created.php');
    }

    echo "modif";
    //header('Refresh: 2; url=../../../index.php');


    
}

?>


