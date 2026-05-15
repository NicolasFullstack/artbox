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

            <img src="<?php echo $oeuvre['image']; ?>" width="300">

            <p><?php echo htmlspecialchars($oeuvre['description']); ?></p>

        </div>

        <hr>

    <?php } ?>

<?php require 'footer.php'; ?>