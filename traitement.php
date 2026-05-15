<?php

require 'bdd.php';

$titre = trim($_POST['titre'] ?? '');
$artiste = trim($_POST['artiste'] ?? '');
$image = trim($_POST['image'] ?? '');
$description = trim($_POST['description'] ?? '');

if (
    empty($titre) ||
    empty($artiste) ||
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
$artiste = htmlspecialchars($artiste);
$image = htmlspecialchars($image);
$description = htmlspecialchars($description);

$bdd = connexion();

$requete = $bdd->prepare('
    INSERT INTO oeuvres(titre, artiste, image, description)
    VALUES(:titre, :artiste, :image, :description)
');

$requete->execute([
    'titre' => $titre,
    'artiste' => $artiste,
    'image' => $image,
    'description' => $description
]);

header('Location: index.php');
exit;