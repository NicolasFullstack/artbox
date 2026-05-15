<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'bdd.php';

$bdd = connexion();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: oeuvre.php?id=' . $oeuvre_id);
    exit;
}

$id = (int) $_GET['id'];

$requete = $bdd->prepare('SELECT * FROM oeuvres WHERE id = :id');

$requete->execute([
    'id' => $id
]);

$oeuvre = $requete->fetch();

if ($oeuvre === false) {
    header('Location: index.php');
    exit;
}

/* commentaires */

$requeteCommentaires = $bdd->prepare('
    SELECT commentaires.contenu, commentaires.created_at, users.pseudo
    FROM commentaires
    INNER JOIN users ON commentaires.user_id = users.id
    WHERE commentaires.oeuvre_id = :oeuvre_id
    ORDER BY commentaires.created_at DESC
');

$requeteCommentaires->execute([
    'oeuvre_id' => $id
]);

$commentaires = $requeteCommentaires->fetchAll();

?>

<?php require 'header.php'; ?>

<main>

    <h1><?php echo htmlspecialchars($oeuvre['titre']); ?></h1>

    <p><?php echo htmlspecialchars($oeuvre['artiste']); ?></p>

    <img
        class="oeuvre-image"
        src="<?php echo htmlspecialchars($oeuvre['image']); ?>"
        width="500"
    >

    <p><?php echo htmlspecialchars($oeuvre['description']); ?></p>

    <p>
        <a href="index.php">Retour à l’accueil</a>
    </p>

    <h2>Commentaires</h2>

    <?php if (empty($commentaires)) { ?>

        <p>Aucun commentaire pour le moment.</p>

    <?php } else { ?>

        <?php foreach ($commentaires as $commentaire) { ?>

            <div class="commentaire">

                <p>
                    <strong>
                        <?php echo htmlspecialchars($commentaire['pseudo']); ?>
                    </strong>

                    —
                    <?php echo htmlspecialchars($commentaire['created_at']); ?>
                </p>

                <p>
                    <?php echo htmlspecialchars($commentaire['contenu']); ?>
                </p>

            </div>

        <?php } ?>

    <?php } ?>

    <?php if (isset($_SESSION['user'])) { ?>

        <h2>Ajouter un commentaire</h2>

        <form action="commentaire.php" method="post">

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

                <textarea
                    id="contenu"
                    name="contenu"
                    required
                ></textarea>

            </div>

            <br>

            <button type="submit">
                Publier
            </button>

        </form>

    <?php } else { ?>

        <p>
            <a href="connexion.php">
                Connectez-vous
            </a>

            pour commenter cette œuvre.
        </p>

    <?php } ?>

</main>

<?php require 'footer.php'; ?>