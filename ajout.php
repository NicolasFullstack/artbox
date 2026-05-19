<?php

//Cette page permet d’ajouter une nouvelle œuvre dans la base
//de données.
// Seuls les utilisateurs connectés peuvent accéder au formulaire.
// Si aucun utilisateur n’est connecté, une redirection vers la
//page de connexion est effectuée.


// Démarre la session PHP
// pour accéder aux variables de session
session_start();


// Vérifie si un utilisateur est connecté
// $_SESSION['user'] est créé lors de la connexion
if (!isset($_SESSION['user'])) {

    // Redirige vers la page connexion
    header('Location: connexion.php');

    // Stoppe immédiatement le script
    exit;
}


// Importe le header commun du site
require 'header.php';

?>

<main>

    <!-- Titre principal de la page -->
    <h1>Ajouter une nouvelle œuvre</h1>


    <!--
    Formulaire d’ajout d’œuvre

    action="traitement.php"
    → les données seront envoyées vers traitement.php

    method="post"
    → les données sont envoyées de manière sécurisée
    -->
    <form action="traitement.php" method="post">


        <!-- Champ titre -->
        <div>

            <label for="titre">
                Nom de l’œuvre
            </label>

            <br>

            <input
                type="text"
                id="titre"
                name="titre"
                required
            >

        </div>

        <br>


        <!-- Champ auteur -->
        <div>

            <label for="auteur">
                Nom de l’auteur
            </label>

            <br>

            <input
                type="text"
                id="auteur"
                name="auteur"
                required
            >

        </div>

        <br>


        <!-- Champ image -->
        <div>

            <label for="image">
                Lien vers l’image
            </label>

            <br>

            <input
                type="text"
                id="image"
                name="image"
                required
            >

        </div>

        <br>


        <!-- Champ description -->
        <div>

            <label for="description">
                Description
            </label>

            <br>

            <textarea
                id="description"
                name="description"
                required
            ></textarea>

        </div>

        <br>


        <!-- Bouton de validation -->
        <button type="submit">

            Ajouter l'oeuvre

        </button>

    </form>


    <!-- Lien retour accueil -->
    <p>

        <a href="index.php">
            Retour à l’accueil
        </a>

    </p>

</main>


<!-- Importe le footer commun -->
<?php require 'footer.php'; ?>