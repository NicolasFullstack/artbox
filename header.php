<?php

// Vérifie si une session PHP est déjà active
if (session_status() === PHP_SESSION_NONE) {

    // Démarre la session
    session_start();
}

?>

<!DOCTYPE html>

<!-- Début du document HTML -->
<html lang="fr">

<head>

    <!-- Encodage UTF-8 pour les caractères spéciaux -->
    <meta charset="UTF-8">

    <!-- Titre affiché dans l’onglet du navigateur -->
    <title>ArtBox</title>

    <!-- Lien vers la feuille de style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<!-- En-tête du site -->
<header>

    <!-- Titre principal -->
    <h1>ArtBox</h1>


    <!-- Menu de navigation -->
    <nav>

        <!-- Lien accueil -->
        <a href="index.php">
            Accueil
        </a>

        |

        <!-- Lien ajout œuvre -->
        <a href="ajout.php">
            Ajouter une œuvre
        </a>

        |


        <!-- Vérifie si un utilisateur est connecté -->
        <?php if (isset($_SESSION['user'])) { ?>


            <!-- Affiche le pseudo utilisateur -->
            Bonjour

            <?php echo htmlspecialchars($_SESSION['user']['pseudo']); ?>

            |


            <!-- Lien déconnexion -->
            <a href="deconnexion.php">
                Déconnexion
            </a>


        <?php } else { ?>


            <!-- Lien inscription -->
            <a href="inscription.php">
                Inscription
            </a>

            |


            <!-- Lien connexion -->
            <a href="connexion.php">
                Connexion
            </a>

        <?php } ?>

    </nav>

</header>