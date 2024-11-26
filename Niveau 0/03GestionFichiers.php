<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
</head>
<body>
    <h1>Utilisateurs</h1>
        <form method="POST" action="">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" required>
            <br><br>
            <label for="age">Âge:</label>
            <input type="number" id="age" name="age" min="1" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <button type="submit">Enregistrer</button>
        </form>
</body> -->
<!-- </html> -->
<?php
echo "donner un nom : " . PHP_EOL;
//permet de stocker ce qui affiche dans la console
$nom = trim(fgets(STDIN));
echo "donner un age : " . PHP_EOL;
$age = trim(fgets(STDIN));
echo "donner un email : " . PHP_EOL;
$email = trim(fgets(STDIN));
$contenu = $nom . '.' . $age . '.' . $email . ';' . PHP_EOL;

// echo $nom;
//ressource stock le retour de fopen()
$ressource = fopen('Utilisateurs_Donnees.txt', 'a');
$writed = fwrite($ressource, $contenu . ',');
//pas besoin d'écrire $writed == true, revient à la même chose
if ($writed){
    'fichier créé et écrit' .PHP_EOL;
    //print formatting
    printf('fichier écrit avec %d octets', $writed) .PHP_EOL;
} else {
    'échec de l\'écriture du fichier';
}
//pour éviter fuite de mémoire
fclose($ressource);

if (file_exists('Utilisateurs_Donnees.txt')){
    $ressource = fopen('Utilisateurs_Donnees.txt', 'r');
    while($data = fgets($ressource)){
        echo $data;
    }
} else {
    echo "fichier n'existe pas";
}

// if (isset($_POST['name']) && !empty($_POST['name'])){
//     $name = htmlspecialchars($_POST['name']);
// }
// if (isset($_POST['age']) && !empty($_POST['age'])){
//     $age = htmlspecialchars($_POST['age']);
// }
// if (isset($_POST['email']) && !empty($_POST['email'])){
//     $email = htmlspecialchars($_POST['email']);
// }

// $contenu = $name . '.' . $age . '.' . $email . '.' . PHP_EOL;

// $nomFichier = 'Utilisateurs_Donnees.txt';

// $fichier = fopen($nomFichier, 'a');


// $content = file_get_contents($nomFichier);

// if ($fichier){
//     fwrite($fichier, $content);
//     fclose($fichier);

//     $elements = explode(';', $content);

//     foreach($elements as $el){
//         echo $el . '<br>';
//     }
// } else {
//     echo 'Erreur, fichier pas enregistré';
// }

?>