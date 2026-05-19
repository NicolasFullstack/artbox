<?php

// Démarre la session PHP
// Obligatoire pour accéder à la session utilisateur
session_start();


// Supprime toutes les données de session
// L’utilisateur est donc déconnecté
session_destroy();


// Redirige vers la page d’accueil
header('Location: index.php');


// Stoppe immédiatement le script
exit;