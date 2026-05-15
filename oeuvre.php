<?php


require 'bdd.php';

$bdd = connexion();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
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

?>
<?php require 'header.php'; ?>

    <h1><?php echo $oeuvre['titre']; ?></h1>

    <p><?php echo $oeuvre['artiste']; ?></p>

    <img src="<?php echo $oeuvre['image']; ?>" width="500">

    <p><?php echo $oeuvre['description']; ?></p>

    <p>
        <a href="index.php">Retour à l’accueil</a>
    </p>

<?php require 'footer.php'; ?>