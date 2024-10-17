<?php

require "../../Config/dataBase.php";
require "../../Database/TableLikeRepository.php";

session_start();

if (!isset($_SESSION["AccountID"])) {
    header('Refresh: 1; url=../Login/login.php');

} else if (isset($_GET['post_id'])) {
    echo "user_id " . $_SESSION['AccountID'] . "</br>";
    echo "post_id " . $_GET['post_id'] . "</br>";

    $connextionBDD = new DataBase() ;
    $bdd = $connextionBDD->getConnection();
    $dataBaseTableLike = new TableLikeRepository($bdd);  


    if ($dataBaseTableLike->hasLiked($_GET['post_id'], $_SESSION["AccountID"])) {
        $dataBaseTableLike->delete($_GET['post_id'], $_SESSION['AccountID']);
    } else {
        $dataBaseTableLike->created($_GET['post_id'], $_SESSION['AccountID']);
    }

    header('Refresh: 0; url=../detailOfPost/detailOfPost.php?post_id=' . $_GET['post_id']);







    
}



?>
