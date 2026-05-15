<?php

require 'bdd.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pseudo = trim($_POST['pseudo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($pseudo) || empty($email) || empty($password)) {

        $message = 'Tous les champs sont obligatoires.';

    } else {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $bdd = connexion();

        $requete = $bdd->prepare('
            INSERT INTO users(pseudo, email, password)
            VALUES(:pseudo, :email, :password)
        ');

        $requete->execute([
            'pseudo' => htmlspecialchars($pseudo),
            'email' => htmlspecialchars($email),
            'password' => $passwordHash
        ]);

        $message = 'Compte créé avec succès.';
    }
}

require 'header.php';

?>

<main>

<h1>Inscription</h1>

<p class="message"><?php echo $message; ?></p>

<form method="post">

    <div>
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" required>
    </div>

    <br>

    <div>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required>
    </div>

    <br>

    <div>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" required>
    </div>

    <br>

    <button type="submit">Créer un compte</button>

</form>

</main>

<?php require 'footer.php'; ?>