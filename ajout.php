<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une œuvre</title>
</head>

<body>

    <h1>Ajouter une nouvelle œuvre</h1>

    <form action="traitement.php" method="post">

        <div>
            <label for="titre">Nom de l’œuvre</label><br>
            <input type="text" id="titre" name="titre">
        </div>

        <br>

        <div>
            <label for="artiste">Nom de l’artiste</label><br>
            <input type="text" id="artiste" name="artiste">
        </div>

        <br>

        <div>
            <label for="image">Lien vers l’image</label><br>
            <input type="text" id="image" name="image">
        </div>

        <br>

        <div>
            <label for="description">Description</label><br>
            <textarea id="description" name="description"></textarea>
        </div>

        <br>

        <button type="submit">Ajouter l’œuvre</button>

    </form>

    <p>
        <a href="index.php">Retour à l’accueil</a>
    </p>

</body>
</html>