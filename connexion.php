<?php

// Démarre la session PHP
// Permet de stocker les informations utilisateur connecté
session_start();


// Importe le fichier de connexion à la base de données
require 'bdd.php';


// Variable qui contiendra les messages d’erreur
$message = '';


// Vérifie si le formulaire a été envoyé en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupère l’email saisi
    // trim() supprime les espaces inutiles
    $email = trim($_POST['email'] ?? '');

    // Récupère le mot de passe saisi
    $password = trim($_POST['password'] ?? '');


    // Vérifie si un champ est vide
    if (empty($email) || empty($password)) {

        // Message d’erreur
        $message = 'Tous les champs sont obligatoires.';

    } else {

        // Connexion à la base de données
        $bdd = connexion();


        // Prépare une requête SQL sécurisée
        // pour rechercher un utilisateur avec cet email
        $requete = $bdd->prepare('SELECT * FROM users WHERE email = :email');


        // Exécute la requête
        $requete->execute([
            'email' => $email
        ]);


        // Récupère l’utilisateur trouvé
        $user = $requete->fetch();


        // Vérifie :
        // - que l’utilisateur existe
        // - que le mot de passe est correct
        if ($user && password_verify($password, $user['password'])) {


            // Stocke les informations utilisateur en session
            $_SESSION['user'] = [

                'id' => $user['id'],

                'pseudo' => $user['pseudo']

            ];


            // Redirection vers l’accueil après connexion
            header('Location: index.php');

            // Arrête le script
            exit;

        } else {

            // Message erreur si connexion incorrecte
            $message = 'Email ou mot de passe incorrect.';
        }
    }
}


// Importe le header commun
require 'header.php';

?>

<main>

    <!-- Titre principal -->
    <h1>Connexion</h1>


    <!-- Affiche les messages d’erreur -->
    <p class="message">
        <?php echo $message; ?>
    </p>


    <!-- Formulaire de connexion -->
    <form method="post">

        <div>

            <label for="email">
                Email
            </label>

            <br>

            <!-- Champ email -->
            <input
                type="email"
                id="email"
                name="email"
                required
            >

        </div>

        <br>

        <div>

            <label for="password">
                Mot de passe
            </label>

            <br>

            <!-- Champ mot de passe -->
            <input
                type="password"
                id="password"
                name="password"
                required
            >

        </div>

        <br>

        <!-- Bouton connexion -->
        <button type="submit">

            Connexion

        </button>

    </form>

</main>


<!-- Importe le footer -->
<?php require 'footer.php'; ?>