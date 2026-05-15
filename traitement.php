<?php

require 'bdd.php';

if (
    empty($_POST['titre']) ||
    empty($_POST['artiste']) ||
    empty($_POST['image']) ||
    empty($_POST['description'])
) {
    die('Tous les champs sont obligatoires.');
}

$titre = htmlspecialchars($_POST['titre']);
$artiste = htmlspecialchars($_POST['artiste']);
$image = htmlspecialchars($_POST['image']);
$description = htmlspecialchars($_POST['description']);

if (strlen($description) < 3) {
    die('La description est trop courte.');
}

if (strlen($image) < 3) {
    die('Le lien de l’image est invalide.');
}

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