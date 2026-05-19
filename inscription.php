<?php

// Importe le fichier de connexion à la base de données
require 'bdd.php';


// Variable utilisée pour afficher un message à l’utilisateur
$message = '';


// Vérifie si le formulaire a été envoyé en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Récupère le pseudo envoyé par le formulaire
    // ?? '' évite une erreur si la valeur n’existe pas
    // trim() supprime les espaces inutiles au début et à la fin
    $pseudo = trim($_POST['pseudo'] ?? '');


    // Récupère l’email envoyé par le formulaire
    $email = trim($_POST['email'] ?? '');


    // Récupère le mot de passe envoyé par le formulaire
    $password = trim($_POST['password'] ?? '');


    // Vérifie si un des champs est vide
    if (empty($pseudo) || empty($email) || empty($password)) {


        // Message d’erreur si un champ est manquant
        $message = 'Tous les champs sont obligatoires.';


    } else {


        // Hash du mot de passe avant stockage en base
        // On ne stocke jamais un mot de passe en clair
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        // Connexion à la base de données
        $bdd = connexion();


        // Prépare une requête SQL sécurisée pour créer un utilisateur
        $requete = $bdd->prepare('
            INSERT INTO users(pseudo, email, password)
            VALUES(:pseudo, :email, :password)
        ');


        // Exécute la requête avec les valeurs du formulaire
        $requete->execute([

            // Sécurise le pseudo avant insertion
            'pseudo' => htmlspecialchars($pseudo),

            // Sécurise l’email avant insertion
            'email' => htmlspecialchars($email),

            // Enregistre le mot de passe hashé
            'password' => $passwordHash

        ]);


        // Message de confirmation
        $message = 'Compte créé avec succès.';
    }
}


// Importe le header commun du site
require 'header.php';

?>

<main>

    <!-- Titre principal de la page -->
    <h1>Inscription</h1>


    <!-- Affiche le message d’erreur ou de succès -->
    <p class="message">
        <?php echo $message; ?>
    </p>


    <!-- Formulaire d’inscription -->
    <form method="post">


        <!-- Champ pseudo -->
        <div>

            <label for="pseudo">
                Pseudo
            </label>

            <br>

            <input
                type="text"
                id="pseudo"
                name="pseudo"
                required
            >

        </div>

        <br>


        <!-- Champ email -->
        <div>

            <label for="email">
                Email
            </label>

            <br>

            <input
                type="email"
                id="email"
                name="email"
                required
            >

        </div>

        <br>


        <!-- Champ mot de passe -->
        <div>

            <label for="password">
                Mot de passe
            </label>

            <br>

            <input
                type="password"
                id="password"
                name="password"
                required
            >

        </div>

        <br>


        <!-- Bouton de validation -->
        <button type="submit">
            Créer un compte
        </button>

    </form>

</main>

<!-- Importe le footer commun du site -->
<?php require 'footer.php'; ?>