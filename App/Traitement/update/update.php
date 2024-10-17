<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    
</head>
<body>

    <?php
    session_start();
    ?>


    <h1>modif</h1>

    <form action="traitement.php?id=<?php echo $_SESSION['AccountID']; ?>" method="post" enctype="multipart/form-data">

        <?php   

        $listeDataUser = [];
        require "../../Config/dataBase.php";
        require "../../Database/UserRepository.php";

        $connextionBDD = new DataBase() ;
        $bdd = $connextionBDD->getConnection();
        $dataBaseUser = new UserRepository($bdd); 
        
        if (!array_key_exists('AccountID', $_SESSION)) {
            echo "aucun id";
            header('Refresh: 2; url=../../../index.php');
        } else {
            $listeDataUser = $dataBaseUser->read($_SESSION['AccountID']);

            var_dump($listeDataUser[0]['username']);

            echo "username: <input type='text' name='username' id='username' value='" . $listeDataUser[0]['username'] . "'><br>";
            echo "email: <input type='text' name='email' id='email' value='" . $listeDataUser[0]['email'] . "'><br>";
            echo "password: <input type='password' name='password' id='password'><br>";

            echo "media_object: <input type='file' name='fileToUpload' id='fileToUpload'><br>";

        }


        ?>


        <input type="submit" value="Envoyer">
    </form>

    
</body>
</html>