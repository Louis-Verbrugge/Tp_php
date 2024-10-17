<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



</head>
<body>

    <h1>ajouter post:</h1>

    <form action="traitement.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
        
        title: <input type="text" name="title" id="title"><br>
        description: <input type="text" name="description" id="description"><br>

        image: <input type="file" name="fileToUpload" id="fileToUpload"><br>

        <input type="submit" value="Envoyer">
    </form>
        
</body>
</html>