<?php

require 'bdd.php';

$titre = trim($_POST['titre'] ?? '');
$auteur = trim($_POST['auteur'] ?? '');
$image = trim($_POST['image'] ?? '');
$description = trim($_POST['description'] ?? '');

if (
    empty($titre) ||
    empty($auteur) ||
    empty($image) ||
    empty($description)
) {
    die('Tous les champs sont obligatoires.');
}

if (strlen($description) < 3) {
    die('La description est trop courte.');
}

if (strlen($image) < 3) {
    die('Le lien de l’image est invalide.');
}

$titre = htmlspecialchars($titre);
$auteur = htmlspecialchars($auteur);
$image = htmlspecialchars($image);
$description = htmlspecialchars($description);

$bdd = connexion();

$requete = $bdd->prepare('
    INSERT INTO oeuvres(titre, auteur, image, description)
    VALUES(:titre, :auteur, :image, :description)
');

$requete->execute([
    'titre' => $titre,
    'auteur' => $auteur,
    'image' => $image,
    'description' => $description
]);

header('Location: index.php');
exit;