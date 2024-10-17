

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
    require "../../Database/postRepository.php";
    require "../../Database/TableLikeRepository.php";
    require "../../Database/CommentaireRepository.php";


    $connextionBDD = new DataBase() ;
    $bdd = $connextionBDD->getConnection();
    $dataBasepost = new postRepository($bdd);
    $dataBaseTableLike = new TableLikeRepository($bdd);
    $dataBaseTableCommentaire = new CommentaireRepository($bdd);  

    session_start();

    $dataOfPost = $dataBasepost->readOnePost($_GET['post_id']);

    echo '<div class="buttonAdmin">';
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"]) {
            echo "comme tu as le role admin tu peux supprimer ce post avec ce bouton</br>";
            echo "<a href='../Admin/deletePost/deletePost.php?id_post={$_GET['post_id']}'><button>supprime le post</button></a>";
        }
    }
    echo '</div>';




    if (!isset($_SESSION["AccountID"])) {
        header('Refresh: 1; url=../Login/login.php');

    }else if (isset($_GET['post_id'])) {


        

        foreach ($dataOfPost as $elem) {

            echo "<div class='post'>";


                echo '<img src="../../../uploads/'. $elem['media_object_user'] . '" alt="image" width="50" height="50"></br>';


                
                if ($dataBaseTableLike->hasLiked($elem['id'], $_SESSION["AccountID"])) {
                    echo '<a href="../likePost/likePost.php?post_id='. $elem['id'] .'"><button>dislike</button></a>';
                } else {
                    echo '<a href="../likePost/likePost.php?post_id='. $elem['id'] .'"><button>like</button></a>';
                }
                

                echo '<p>nombre de like: ' . $dataBaseTableLike->countLike($elem['id']) . '</p>';
                
                echo '<p>username:  ' . $elem['username'] . '</p>';

                echo '<p>titre: ' . $elem['title'] . '</p>';
                echo '<p>description: ' . $elem['description'] . '</p>';
                
                echo "<img src=\"../../../uploads/post/{$elem['media_object']}\" alt=\"image\" width=\"200\" height=\"200\"></br>";
                
            echo "</div>";
        }
    } else {
        header('Refresh: 1; url../../../../../index.php');

    }
    ?>

    <h1>Commentaire:</h1>

    <?php

    $dataOfComment = $dataBaseTableCommentaire->readAllComment($_GET['post_id']);

    foreach ($dataOfComment as $elem) {

        echo "<div class='commentaire'>";

            echo "<div class='row'>";   
                echo '<p>' . $elem['username'] . '</p>';
                echo "<img src=\"../../../uploads/{$elem['media_object_user']}\" alt=\"image\"></br>";
            echo "</div>";

            echo '<p>commentaire: ' . $elem['comment'] . '</p>';
        echo "</div>";
    }

    ?>


    <h1>ajouter Commentaire:</h1>

    <form action="traitementCommentaire.php?post_id=<?php echo $_GET['post_id'] ?>" method="post" enctype="multipart/form-data">
        
        commentaire: <textarea name="comment" id="comment" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Envoyer">
    </form>
        

    

</body>
</html>