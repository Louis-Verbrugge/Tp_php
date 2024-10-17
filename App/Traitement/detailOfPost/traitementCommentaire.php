
<?php

require "../../Config/dataBase.php";
require "../../Database/CommentaireRepository.php";


session_start();


if (!isset($_SESSION["AccountID"])) {
    header('Refresh: 1; url=./App/Traitement/Login/login.php');

} else {

    $connextionBDD = new DataBase() ;
    $bdd = $connextionBDD->getConnection();
    $dataBaseTableCommentaire = new CommentaireRepository($bdd);  


    $dataBaseTableCommentaire->created($_POST['comment'], $_SESSION["AccountID"], $_GET['post_id']);

    header('Refresh: 0; url=./detailOfPost.php?post_id=' . $_GET['post_id']);


}





?>