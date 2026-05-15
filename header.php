<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>ArtBox</title>
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header>
    <h1>ArtBox</h1>

    <nav>
    <a href="index.php">Accueil</a> |
    <a href="ajout.php">Ajouter une œuvre</a> |

    <?php if (isset($_SESSION['user'])) { ?>
        Bonjour <?php echo htmlspecialchars($_SESSION['user']['pseudo']); ?> |
        <a href="deconnexion.php">Déconnexion</a>
    <?php } else { ?>
        <a href="inscription.php">Inscription</a> |
        <a href="connexion.php">Connexion</a>
    <?php } ?>
</nav>

</header>