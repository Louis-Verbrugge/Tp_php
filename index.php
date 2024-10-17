<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="styless.css"/>
</head>
<body>

    <div class="page">

        <?php 
            session_start(); 

            if (isset($_SESSION["admin"])) {
                
                if ($_SESSION["admin"]) {
                    echo "<a href='App/Traitement/Admin/listeOfUsers/listeOfUsers.php'><button>page admin</button></a>";
                }
        
            }

        
        ?>

    


        <h1>post:</h1>


        <?php

        require "App/Entity/Utilisateur.php";
        require "App/Config/dataBase.php";
        require "App/Database/UserRepository.php";
        require "App/Database/postRepository.php";
        require "App/Database/TableLikeRepository.php";


        $connextionBDD = new DataBase() ;
        $bdd = $connextionBDD->getConnection();
        $dataBasepost = new postRepository($bdd);

        $dataBaseTableLike = new TableLikeRepository($bdd);
        
        
        if (!isset($_SESSION["AccountID"])) {
            header('Refresh: 1; url=./App/Traitement/Login/login.php');

        }
        ?>

        <div class="navBar">
            <?php
            if (isset($_SESSION["admin"])) {
                if ($_SESSION["admin"]) {
                    echo "<a href='App/Traitement/Admin/listeOfUsers/listeOfUsers.php'><button>page admin</button></a>";
                }
            }
            echo "<a href='App/Traitement/deconnection/deconnection.php'><button>deconnection</button></a>";
            echo '<a href="App/Traitement/update/update.php"><button>UPDATE</button></a>';
            echo "<a href='App/Traitement/addpost/addpost.php?id=" . $_SESSION["AccountID"] . "' ' class='addUser'><button>ajoute post</button></a>";
            ?>
        </div>


        <div class='blockpost'>

        <?php
        $dataOfPost = $dataBasepost->readAllPost();

        foreach ($dataOfPost as $elem) {
            echo "<div class='post' onClick=\"window.location.href='./App/Traitement/detailOfPost/detailOfPost.php?post_id={$elem['id']}'\">";
        
            echo '<div class="heahPost">';
                echo '<img class="photoPorfil" src="uploads/' . htmlspecialchars($elem['media_object_user'], ENT_QUOTES, 'UTF-8') . '" alt="image"></br>';
                echo '<button class="buttonProfil" onClick="event.stopPropagation(); window.location.href=\'App/Traitement/readUser/readUser.php?id=' . htmlspecialchars($elem['user_id'], ENT_QUOTES, 'UTF-8') . '\'">'. $elem['username'] .'</button>';
            echo "</div>";
        
            echo '<p>nombre de like: ' . htmlspecialchars($dataBaseTableLike->countLike($elem['id']), ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p>titre: ' . htmlspecialchars($elem['title'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo "<img class='imagePost' src=\"./uploads/post/" . htmlspecialchars($elem['media_object'], ENT_QUOTES, 'UTF-8') . "\" alt=\"image\" width=\"200\" height=\"200\"></br>";
        
            echo "</div>";
        }
        ?>
        </div>


    </div>
    
</body>
</html>

