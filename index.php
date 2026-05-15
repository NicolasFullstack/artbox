<?php

require 'bdd.php';

$bdd = connexion();

$requete = $bdd->query('SELECT * FROM oeuvres');

$oeuvres = $requete->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ArtBox</title>
</head>

<body>

    <h1>Liste des œuvres</h1>

    <?php foreach ($oeuvres as $oeuvre) { ?>

        <div>

            <h2>
    <a href="oeuvre.php?id=<?php echo $oeuvre['id']; ?>">
        <?php echo $oeuvre['titre']; ?>
    </a>
</h2>

            <p><?php echo $oeuvre['artiste']; ?></p>

            <img src="<?php echo $oeuvre['image']; ?>" width="300">

            <p><?php echo $oeuvre['description']; ?></p>

        </div>

        <hr>

    <?php } ?>

</body>

</html>