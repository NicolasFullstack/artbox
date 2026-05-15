<?php

session_start();

require 'bdd.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {

        $message = 'Tous les champs sont obligatoires.';

    } else {

        $bdd = connexion();

        $requete = $bdd->prepare('SELECT * FROM users WHERE email = :email');

        $requete->execute([
            'email' => $email
        ]);

        $user = $requete->fetch();

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user'] = [
                'id' => $user['id'],
                'pseudo' => $user['pseudo']
            ];

            header('Location: index.php');
            exit;

        } else {

            $message = 'Email ou mot de passe incorrect.';
        }
    }
}

require 'header.php';

?>

<main>

<h1>Connexion</h1>

<p class="message"><?php echo $message; ?></p>

<form method="post">

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

    <button type="submit">Connexion</button>

</form>

</main>

<?php require 'footer.php'; ?>