<?php

//index.php est la page d’accueil dynamique du site.
//Elle récupère les œuvres stockées dans la base de données MySQL grâce
// à PDO, puis les affiche automatiquement avec une boucle PHP.

// Importe le fichier bdd.php
// pour avoir accès à la fonction connexion()
require 'bdd.php';


// Appelle la fonction connexion()
// et stocke la connexion PDO dans la variable $bdd
$bdd = connexion();


// Exécute une requête SQL
// SELECT * signifie : récupérer toutes les colonnes
// FROM oeuvres signifie : depuis la table oeuvres
$requete = $bdd->query('SELECT * FROM oeuvres');


// fetchAll() récupère tous les résultats SQL
// et les transforme en tableau PHP
$oeuvres = $requete->fetchAll();

?>

<!-- Importe le header commun du site -->
<?php require 'header.php'; ?>

<main>

    <!-- Titre principal de la page -->
    <h1>Liste des œuvres</h1>

    <!-- Conteneur principal des cartes -->
    <div class="oeuvres-grid">

        <?php
        // Boucle foreach :
        // parcourt chaque œuvre du tableau $oeuvres
        foreach ($oeuvres as $oeuvre) {
        ?>

            <!-- Carte d’une œuvre -->
            <div class="oeuvre-card">

                <h2>

                    <!--
                    Lien vers la page détail de l’œuvre
                    On transmet l’id dans l’URL :
                    oeuvre.php?id=1
                    -->
                    <a href="oeuvre.php?id=<?php echo htmlspecialchars($oeuvre['id']); ?>">

                        <!--
                        Affiche le titre de l’œuvre
                        htmlspecialchars protège contre le HTML malveillant
                        -->
                        <?php echo htmlspecialchars($oeuvre['titre']); ?>

                    </a>

                </h2>

                <!-- Affiche le nom de l’auteur -->
                <p>
                    <?php echo htmlspecialchars($oeuvre['auteur']); ?>
                </p>

                <!--
                L’image est également cliquable
                pour ouvrir la page détail
                -->
                <a href="oeuvre.php?id=<?php echo htmlspecialchars($oeuvre['id']); ?>">

                    <img

                        <!--
                        src contient le chemin de l’image
                        stocké dans la base de données
                        -->
                        src="<?php echo htmlspecialchars($oeuvre['image']); ?>"

                        <!--
                        alt est important pour :
                        - accessibilité
                        - SEO
                        - affichage si image absente
                        -->
                        alt="<?php echo htmlspecialchars($oeuvre['titre']); ?>"
                    >

                </a>

                <!-- Affiche la description de l’œuvre -->
                <p>
                    <?php echo htmlspecialchars($oeuvre['description']); ?>
                </p>

            </div>

        <?php } ?>

    </div>

</main>

<!-- Importe le footer commun -->
<?php require 'footer.php'; ?>