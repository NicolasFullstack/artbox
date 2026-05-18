<?php

//J’ai créé un fichier bdd.php pour centraliser la connexion PDO.
//Cela évite de recopier le code dans chaque page PHP.
//Ainsi, si la configuration de la base change, je n’ai qu’un seul fichier à modifier.

// Création d'une fonction appelée connexion
function connexion()
{

    // Création d'un objet PDO permettant de se connecter à MySQL
    $bdd = new PDO(

        // Informations de connexion :
        // mysql = type de base de données
        // host=localhost = serveur local
        // dbname=artbox = nom de la base
        // charset=utf8 = encodage UTF-8
        'mysql:host=localhost;dbname=artbox;charset=utf8',

        // Nom d'utilisateur MySQL
        'root',

        // Mot de passe MySQL
        // Ici vide car configuration XAMPP locale
        ''
    );

    // Retourne la connexion pour pouvoir l'utiliser ailleurs
    return $bdd;
}