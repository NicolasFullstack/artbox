<?php

// Importe le fichier contenant la connexion à la base de données
require 'bdd.php';


// Récupère le titre envoyé par le formulaire
// trim() supprime les espaces inutiles
$titre = trim($_POST['titre'] ?? '');


// Récupère l’auteur envoyé par le formulaire
$auteur = trim($_POST['auteur'] ?? '');


// Récupère le chemin ou lien de l’image
$image = trim($_POST['image'] ?? '');


// Récupère la description
$description = trim($_POST['description'] ?? '');


// Vérifie que tous les champs sont remplis
if (

    empty($titre) ||

    empty($auteur) ||

    empty($image) ||

    empty($description)

) {

    // Arrête le script avec un message d’erreur
    die('Tous les champs sont obligatoires.');
}


// Vérifie que la description contient au moins 3 caractères
if (strlen($description) < 3) {

    // Arrête le script si description trop courte
    die('La description est trop courte.');
}


// Vérifie que le lien image contient au moins 3 caractères
if (strlen($image) < 3) {

    // Arrête le script si le lien semble invalide
    die('Le lien de l’image est invalide.');
}


// Sécurise le titre contre les injections HTML
$titre = htmlspecialchars($titre);


// Sécurise l’auteur
$auteur = htmlspecialchars($auteur);


// Sécurise le lien image
$image = htmlspecialchars($image);


// Sécurise la description
$description = htmlspecialchars($description);


// Connexion à la base de données
$bdd = connexion();


// Prépare une requête SQL sécurisée
// pour ajouter une œuvre dans la table oeuvres
$requete = $bdd->prepare('

    INSERT INTO oeuvres(titre, auteur, image, description)

    VALUES(:titre, :auteur, :image, :description)

');


// Exécute la requête avec les données du formulaire
$requete->execute([

    'titre' => $titre,

    'auteur' => $auteur,

    'image' => $image,

    'description' => $description

]);


// Redirige vers la page d’accueil après ajout
header('Location: index.php');


// Arrête immédiatement le script
exit;