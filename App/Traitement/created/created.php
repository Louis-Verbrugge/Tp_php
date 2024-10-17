<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



</head>
<body>

    <h1>ajouter</h1>

    <form action="traitement.php" method="post" enctype="multipart/form-data">

        username: <input type="text" name="username" id="username"><br>
        email: <input type="text" name="email" id="email"><br>

        password: <input type="password" name="password" id="password"><br>
        image: <input type="file" name="fileToUpload" id="fileToUpload"><br>

        <input type="submit" value="Envoyer">
    </form>
        
</body>
</html>