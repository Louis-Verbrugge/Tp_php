<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="styless.css"/>

</head>
<body>

    <?php

    require "../../Config/dataBase.php";
    require "../../Database/UserRepository.php";
    require "../../Database/postRepository.php";



    if (array_key_exists('id', $_GET)) {


        $connextionBDD = new DataBase() ;
        $bdd = $connextionBDD->getConnection();
        $dataBaseUser = new UserRepository($bdd);  
        $dataBasepost = new postRepository($bdd);  

        $dataUser = $dataBaseUser->read($_GET['id']);



        echo '<div class="presentationUser">';
        foreach ($dataUser as $elem) {
            echo '<h2>' . $elem['username'] .  '</h2>';
            echo "<img src=\"../../../uploads/{$elem['media_object']}\" alt=\"image\" width=\"200\" height=\"200\">";
        }

        echo '</div>';



    } else {
        echo "pas de id";
        header('Refresh: 1; url=../../../index.php');

    }
    ?>

    <h2>Les posts de cette utilisateur:</h2>

    

    <div class="blockPost">

        <?php

        $dataPost = $dataBasepost->readAllPost($_GET['id']);

        foreach ($dataPost as $elem) {

            echo '<div class="post" onClick="window.location.href=\'../detailOfPost/detailOfPost.php?post_id=' . htmlspecialchars($elem['id'], ENT_QUOTES, 'UTF-8') . '\'">';

                echo 'titre: ' . $elem['title'] . '</br>';
                echo 'description: ' . $elem['description'] . ' </br>';
                $temp = $elem['media_object'];

                echo "<img src=\"../../../uploads/post/{$temp}\" alt=\"image\" width=\"200\" height=\"200\"></br>";
            echo '</div>';

        }

        ?>

    </div>
    



    
</body>
</html>
