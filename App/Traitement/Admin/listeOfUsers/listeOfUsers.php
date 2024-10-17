
<?php


require "../../../Config/dataBase.php";
require "../../../Database/UserRepository.php";
require "../../../Validator/ValidatorInput.php";


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
    $dataBaseUser = new UserRepository($bdd);  
    
    $listeUser = $dataBaseUser->readAll();

    //affiche la liste des utilisateurs
    echo '<table border="1" id="table">';
    echo '<tr><th>Id</th><th>username</th><th>email</th><th>photo de profil</th><th>Supprime</th>';

    foreach($listeUser as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td> <img src="../../../../uploads/' . $row['media_object'] . '" alt="photo de profil" width="100" height="100"> </td>';

        echo '<td>' . "<a href='../../delete.php?id=" . $row['id'] . "'onClick=\"return window.confirm('Êtes-vous sûr de vouloir supprimer ?')\"><button>Supprime</button></a> </td>";


        echo '</tr>';
    }   


    echo '</table>';

}




?>