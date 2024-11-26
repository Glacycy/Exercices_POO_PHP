<?php

$age = array(18);

foreach ($age as $a)
{
    if($a >= 18){
        echo 'majeur';
    }
    else echo 'mineur';
} ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="form">
        <form action="" method="POST">
            Prénom: <input type="text" name="name" /><br>
        <input type="submit" value="envoyer"/>
        <?php
        if(isset($_POST["name"])){
            $p= $_POST["name"];
            echo 'Bienvenue ' . htmlspecialchars($p);
        };
        ?>
        </form>
    </div>
</body>
</html>