<?php

// Vérifie si une session PHP est déjà active
if (session_status() === PHP_SESSION_NONE) {

    // Démarre la session
    session_start();
}


// Importe le fichier de connexion à la base de données
require 'bdd.php';


// Connexion à la base de données avec PDO
$bdd = connexion();


// Vérifie que l’id existe bien dans l’URL
if (!isset($_GET['id']) || empty($_GET['id'])) {

    // Redirige si aucun id n’est présent
    header('Location: oeuvre.php?id=' . $oeuvre_id);

    // Arrête le script
    exit;
}


// Convertit l’id en entier pour sécuriser la donnée
$id = (int) $_GET['id'];


// Prépare une requête SQL sécurisée
$requete = $bdd->prepare('SELECT * FROM oeuvres WHERE id = :id');


// Exécute la requête avec l’id de l’œuvre
$requete->execute([
    'id' => $id
]);


// Récupère une seule œuvre
$oeuvre = $requete->fetch();


// Vérifie si aucune œuvre n’a été trouvée
if ($oeuvre === false) {

    // Retour à l’accueil
    header('Location: index.php');

    exit;
}


/* commentaires */


// Prépare une requête pour récupérer les commentaires
$requeteCommentaires = $bdd->prepare('

    SELECT commentaires.contenu, commentaires.created_at, users.pseudo

    FROM commentaires

    INNER JOIN users ON commentaires.user_id = users.id

    WHERE commentaires.oeuvre_id = :oeuvre_id

    ORDER BY commentaires.created_at DESC

');


// Exécute la requête des commentaires
$requeteCommentaires->execute([
    'oeuvre_id' => $id
]);


// Récupère tous les commentaires
$commentaires = $requeteCommentaires->fetchAll();

?>

<!-- Importe le header commun -->
<?php require 'header.php'; ?>

<main>

    <!-- Affiche le titre -->
    <h1><?php echo htmlspecialchars($oeuvre['titre']); ?></h1>

    <!-- Affiche l’auteur -->
    <p><?php echo htmlspecialchars($oeuvre['auteur']); ?></p>

    <!-- Affiche l’image -->
    <img
        class="oeuvre-image"
        src="<?php echo htmlspecialchars($oeuvre['image']); ?>"
        width="500"
    >

    <!-- Affiche la description -->
    <p><?php echo htmlspecialchars($oeuvre['description']); ?></p>

    <!-- Lien retour accueil -->
    <p>
        <a href="index.php">Retour à l’accueil</a>
    </p>

    <!-- Titre section commentaires -->
    <h2>Commentaires</h2>

    <?php if (empty($commentaires)) { ?>

        <!-- Message si aucun commentaire -->
        <p>Aucun commentaire pour le moment.</p>

    <?php } else { ?>

        <?php foreach ($commentaires as $commentaire) { ?>

            <!-- Bloc commentaire -->
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


    <?php if (isset($_SESSION['user'])) { ?>

        <!-- Formulaire commentaire visible si connecté -->
        <h2>Ajouter un commentaire</h2>

        <form action="commentaire.php" method="post">

            <!-- Champ caché contenant l’id de l’œuvre -->
            <input
                type="hidden"
                name="oeuvre_id"
                value="<?php echo $oeuvre['id']; ?>"
            >

            <div>

                <label for="contenu">
                    Votre commentaire
                </label>

                <br>

                <!-- Zone de texte commentaire -->
                <textarea
                    id="contenu"
                    name="contenu"
                    required
                ></textarea>

            </div>

            <br>

            <!-- Bouton publication -->
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