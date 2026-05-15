<?php

require 'bdd.php';

$bdd = connexion();

$requete = $bdd->query('SELECT * FROM oeuvres');

$oeuvres = $requete->fetchAll();

?>
<?php require 'header.php'; ?>

    <h1>Liste des œuvres</h1>

    <div class="oeuvres-grid">

    <?php foreach ($oeuvres as $oeuvre) { ?>

        <div class="oeuvre-card">

    <h2>
        <a href="oeuvre.php?id=<?php echo $oeuvre['id']; ?>">
            <?php echo htmlspecialchars($oeuvre['titre']); ?>
        </a>
    </h2>

    <p><?php echo htmlspecialchars($oeuvre['artiste']); ?></p>

    <img class="oeuvre-image" src="<?php echo htmlspecialchars($oeuvre['image']); ?>" alt="<?php echo htmlspecialchars($oeuvre['titre']); ?>">

    <p class="oeuvre-description"><?php echo htmlspecialchars($oeuvre['description']); ?></p>

</div>

    <?php } ?>

    </div>

<?php require 'footer.php'; ?>