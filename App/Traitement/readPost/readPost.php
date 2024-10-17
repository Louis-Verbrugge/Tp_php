
<?php

require "../../Config/dataBase.php";
require "../../Database/postRepository.php";



if (array_key_exists('id', $_GET)) {



    $connextionBDD = new DataBase() ;
    $bdd = $connextionBDD->getConnection();
    $dataBasepost = new postRepository($bdd);  


    $dataPost = $dataBasepost->read($_GET['id']);




    foreach ($dataPost as $elem) {
        echo $elem['title'] . '</br>';
        echo $elem['description'] . '</br>';
        $temp = $elem['media_object'];
        echo '<p> ' . $temp. '</p>';

        echo "<img src=\"../../../uploads/post/{$temp}\" alt=\"image\" width=\"200\" height=\"200\"></br>";
    }

} else {
    echo "pas de id";
}
?>
