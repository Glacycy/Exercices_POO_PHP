<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
</head>
<body>
    <h1>Ajouter un commentaire</h1>
    <form action="" method="POST">
        <label for="name">Votre nom :</label>
        <input name="name" type="text" placeholder="Saisissez votre nom" id="name" required><br>
        <label for="comment">Commentaire :</label><br>
        <textarea name="comment"  placeholder="Votre commentaire" id="comment" required></textarea><br>
        <button type="submit">Envoyer</button>
    </form>

    <?php
    // Nom du fichier JSON
    $file = 'commentsV2.json';
 
 function getAllComments() {
    
    $file = 'commentsV2.json';
    // Vérifie si le fichier existe, sinon crée un fichier JSON vide
    //C'est une fonction PHP qui vérifie si un fichier ou un répertoire existe à l'emplacement spécifié ou pas
    if (file_exists($file)) {
        $comments = json_decode(file_get_contents($file), true);
        if (!is_array($comments)) {
            $comments = []; // Si le contenu du fichier n'est pas un tableau, initialise un tableau vide
        }
    } else {
        $comments = []; // Initialise $comments comme un tableau vide si le fichier n'existe pas
        file_put_contents($file, json_encode($comments)); // Crée un fichier JSON vide
    }
}

$comments = json_decode(file_get_contents($file), true);

    // Vérifie si un commentaire a été soumis
    //!empty(trim($_POST['comment'])): Vérifie si le champ de formulaire nommé comment contient une valeur non vide après avoir supprimé les espaces inutiles avec trim.
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['name'])) && !empty(trim($_POST['comment']))) {

        $newName = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);
        // Récupère le commentaire soumis
        //ENT_QUOTES indique que toutes les guillemets, simples et doubles, doivent être convertis en entités HTML. Cela rend le texte plus sûr à afficher sur une page web, en évitant certaines attaques comme l'injection de code malveillant (XSS).
        $newComment = htmlspecialchars(trim($_POST['comment']), ENT_QUOTES); //Utilisation de htmlspecialchars pour sécuriser les entrées utilisateur et éviter les injections HTML.


        // Charge les commentaires existants
        //file_get_contents(): Lit le contenu du fichier JSON où sont stockés les commentaires.
        // $comments = json_decode(file_get_contents($file), true); //json_decode()> fct convertit une chaîne JSON en structure PHP (tableau ou objet).

        // Ajoute le nouveau commentaire
        //Cette ligne ajoute un nouvel élément au tableau $comments.
        $comments[] = [
            'name' => $newName,
            'comment' => $newComment,
        ];

        // Écrit les commentaires mis à jour dans le fichier
        //Ajout de l'option JSON_PRETTY_PRINT pour rendre le fichier json plus lisible.
        //LOCK_EX permet de verrouiller un fichier pendant son écriture, afin qu'aucun autre processus ou script ne puisse le modifier en même temps. Cela garantit l'intégrité des données.
        //file_put_contents: Écrit le JSON encodé dans le fichier spécifié.
        file_put_contents($file, json_encode($comments, JSON_PRETTY_PRINT | LOCK_EX)); //json_encode convertit une structure PHP (tableau ou objet) en chaîne de caractères au format JSON.

         // Rediriger pour éviter le double ajout
         header('Location: ' . $_SERVER['PHP_SELF']);
         die;
         
    } ?>
    
    <h2>Liste des commentaires</h2>
    <ul>
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $entry): ?>
                <li>
                    <strong><?= htmlspecialchars($entry['name'], ENT_QUOTES); ?></strong> : 
                    <?= htmlspecialchars($entry['comment'], ENT_QUOTES); ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucun commentaire pour le moment.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
