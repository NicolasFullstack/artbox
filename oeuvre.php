<?php

//Cette page affiche le détail d’une oeuvre.
//Elle récupère l’oeuvre grâce à son id transmis dans l’URL.
//La page affiche également les commentaires liés à l’oeuvre
//et permet aux utilisateurs connectés d’ajouter un commentaire.

// Vérifie si une session PHP est déjà active
// Si aucune session n’existe, on la démarre
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Importe le fichier de connexion à la base de données
require 'bdd.php';


// Crée la connexion PDO
$bdd = connexion();


// Vérifie si l’id est présent dans l’URL
// Exemple : oeuvre.php?id=3
if (!isset($_GET['id']) || empty($_GET['id'])) {

    // Redirige vers l’accueil si aucun id n’est fourni
    header('Location: index.php');

    // Arrête immédiatement le script
    exit;
}


// Convertit l’id en entier pour sécuriser la donnée
$id = (int) $_GET['id'];


// Prépare une requête SQL sécurisée
// pour récupérer une oeuvre selon son id
$requete = $bdd->prepare('SELECT * FROM oeuvres WHERE id = :id');


// Exécute la requête
// :id reçoit la valeur de $id
$requete->execute([
    'id' => $id
]);


// fetch() récupère une seule ligne SQL
$oeuvre = $requete->fetch();


// Si aucune oeuvre n’existe avec cet id
if ($oeuvre === false) {

    // Retour à l’accueil
    header('Location: index.php');

    exit;
}


// Prépare une requête pour récupérer les commentaires
// liés à cette oeuvre
$requeteCommentaires = $bdd->prepare('

    SELECT commentaires.contenu,
           commentaires.created_at,
           users.pseudo

    FROM commentaires

    INNER JOIN users
    ON commentaires.user_id = users.id

    WHERE commentaires.oeuvre_id = :oeuvre_id

    ORDER BY commentaires.created_at DESC

');


// Exécute la requête commentaires
$requeteCommentaires->execute([
    'oeuvre_id' => $id
]);


// Récupère tous les commentaires
$commentaires = $requeteCommentaires->fetchAll();


// Importe le header commun
require 'header.php';

?>

<main>

    <!-- Affiche le titre de l’œuvre -->
    <h1>
        <?php echo htmlspecialchars($oeuvre['titre']); ?>
    </h1>


    <!-- Affiche l’auteur -->
    <p>
        <?php echo htmlspecialchars($oeuvre['auteur']); ?>
    </p>


    <!-- Affiche l’image de l’œuvre -->
    <img

        class="oeuvre-detail-image"

        src="<?php echo htmlspecialchars($oeuvre['image']); ?>"

        alt="<?php echo htmlspecialchars($oeuvre['titre']); ?>"
    >


    <!-- Affiche la description -->
    <p>
        <?php echo htmlspecialchars($oeuvre['description']); ?>
    </p>


    <!-- Lien retour accueil -->
    <p>
        <a href="index.php">Retour à l’accueil</a>
    </p>


    <!-- Titre section commentaires -->
    <h2>Commentaires</h2>


    <?php
    // Vérifie si aucun commentaire n’existe
    if (empty($commentaires)) {
    ?>

        <p>Aucun commentaire pour le moment.</p>

    <?php } else { ?>

        <?php
        // Parcourt tous les commentaires
        foreach ($commentaires as $commentaire) {
        ?>

            <div class="commentaire">

                <p>

                    <!-- Affiche le pseudo -->
                    <strong>
                        <?php echo htmlspecialchars($commentaire['pseudo']); ?>
                    </strong>

                    —

                    <!-- Affiche la date -->
                    <?php echo htmlspecialchars($commentaire['created_at']); ?>

                </p>


                <!-- Affiche le contenu du commentaire -->
                <p>
                    <?php echo htmlspecialchars($commentaire['contenu']); ?>
                </p>

            </div>

        <?php } ?>

    <?php } ?>


    <?php
    // Vérifie si un utilisateur est connecté
    if (isset($_SESSION['user'])) {
    ?>

        <h2>Ajouter un commentaire</h2>


        <!-- Formulaire d’ajout commentaire -->
        <form action="commentaire.php" method="post">


            <!-- Champ caché contenant l’id de l’œuvre -->
            <input
                type="hidden"
                name="oeuvre_id"
                value="<?php echo htmlspecialchars($oeuvre['id']); ?>"
            >


            <div>

                <label for="contenu">
                    Votre commentaire
                </label>

                <br>

                <!-- Zone de texte -->
                <textarea
                    id="contenu"
                    name="contenu"
                    required
                ></textarea>

            </div>

            <br>

            <!-- Bouton envoi -->
            <button type="submit">
                Publier
            </button>

        </form>

    <?php } else { ?>

        <!-- Message si utilisateur non connecté -->
        <p>

            <a href="connexion.php">
                Connectez-vous
            </a>

            pour commenter cette œuvre.

        </p>

    <?php } ?>

</main>


<!-- Importe le footer -->
<?php require 'footer.php'; ?>