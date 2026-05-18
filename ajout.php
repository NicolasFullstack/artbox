<?php

session_start();

if (!isset($_SESSION['user'])) {

    header('Location: connexion.php');
    exit;
}

require 'header.php';

?>

<main>

<h1>Ajouter une nouvelle œuvre</h1>

<form action="traitement.php" method="post">

    <div>
        <label for="titre">Nom de l’œuvre</label><br>
        <input type="text" id="titre" name="titre" required>
    </div>

    <br>

    <div>
        <label for="auteur">Nom de l’auteur</label><br>
        <input type="text" id="auteur" name="auteur" required>
    </div>

    <br>

    <div>
        <label for="image">Lien vers l’image</label><br>
        <input type="text" id="image" name="image" required>
    </div>

    <br>

    <div>
        <label for="description">Description</label><br>
        <textarea id="description" name="description" required></textarea>
    </div>

    <br>

    <button type="submit">Ajouter l’œuvre</button>

</form>

<p>
    <a href="index.php">Retour à l’accueil</a>
</p>

</main>

<?php require 'footer.php'; ?>