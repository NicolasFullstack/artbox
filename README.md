# ArtBox

Projet PHP / MySQL réalisé dans le cadre de la formation OpenClassrooms.

## Prérequis

Avant de lancer le projet, installer les outils suivants :

- XAMPP
- Git
- Visual Studio Code

## Installation du projet

### 1. Installer XAMPP

Télécharger et installer XAMPP :

https://www.apachefriends.org/fr/index.html

Une fois installé, lancer :

- Apache
- MySQL

depuis le panneau de contrôle XAMPP.



### 2. Cloner le projet avec GitHub

Ouvrir Git Bash ou le terminal VS Code puis taper :


cd /c/xampp/htdocs

git clone https://github.com/NicolasFullstack/artbox.git




### 3. Importer la base de données

Ouvrir phpMyAdmin :

http://localhost/phpmyadmin

Puis :

1. Créer une base de données nommée :


artbox


2. Cliquer sur Importer

3. Sélectionner le fichier :


database/artbox.sql


4. Cliquer sur Exécuter



### 4. Lancer le projet

Ouvrir dans le navigateur :


http://localhost/artbox


## Technologies utilisées

- PHP
- MySQL
- HTML
- CSS
- PDO
- Git / GitHub

## Fonctionnalités

- Affichage dynamique des œuvres
- Détail des œuvres
- Système d’inscription
- Connexion / déconnexion utilisateur
- Ajout d’œuvres
- Système de commentaires
- Utilisation de requêtes préparées PDO
- Protection XSS avec htmlspecialchars()
