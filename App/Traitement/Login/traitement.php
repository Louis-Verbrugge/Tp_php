<?php

require "../../Config/dataBase.php";
require "../../Database/UserRepository.php";
require "../../Validator/ValidatorInput.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $connextionBDD = new DataBase() ;
    $bdd = $connextionBDD->getConnection();
    $dataBaseUser = new UserRepository($bdd);  

    $validator = new ValidatorInput();


    $messageErreur = [];

    if ($validator->checkText($_POST['email'])){
        array_push($messageErreur, "pas de email");     
    }  

    if ($validator->checkPassword($_POST['password'])) {
        array_push($messageErreur, "le password est trop court");
    }


    if (count($messageErreur) == 0) {
        echo "pas de problème : " . $_POST['email'];

        $listReturn = $dataBaseUser->login($_POST['email'], $_POST['password']);
        
        if ($listReturn[0]) {
            echo "CONNECTE A UN COMPTE";


            session_start();
            $_SESSION["AccountID"]=$listReturn[1];

            if ($listReturn[1] == 1) {
                $_SESSION["admin"]=true;
            } else {
                $_SESSION["admin"]=false;
            }

            header('Refresh: 1; url=../../../index.php');

            
        } else {
            

            echo '<h4>' . $listReturn[1] . '</h4>';
            
        }


    } else {
        echo "<h1>problème:</h1>";
        foreach ($messageErreur as $elem) {
            echo '<h4>' . $elem . '</h4>';
        }

        header('Refresh: 1; url=./created.php');
    }

}



?>