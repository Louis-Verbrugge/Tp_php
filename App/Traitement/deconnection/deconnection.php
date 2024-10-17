<?php



session_start();

if (isset($_SESSION["AccountID"])) {

    session_unset();
    session_destroy();

    header('Refresh: 1; url=../Login/login.php');


}

header('Refresh: 1; url=../Login/login.php');




?>