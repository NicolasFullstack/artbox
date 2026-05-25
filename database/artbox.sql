-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 25 mai 2026 à 17:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `artbox`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `oeuvre_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `oeuvre_id`, `user_id`, `contenu`, `created_at`) VALUES
(1, 1, 2, 'Wow bravo Rodin!', '2026-05-15 17:40:07');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres`
--

CREATE TABLE `oeuvres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `oeuvres`
--

INSERT INTO `oeuvres` (`id`, `titre`, `auteur`, `image`, `description`) VALUES
(1, 'Le Penseur', 'Auguste Rodin', 'assets/images/penseur.jpg', 'Sculpture célèbre représentant un homme en réflexion.'),
(3, 'Mona Lisa', 'Léonard de Vinci', 'https://upload.wikimedia.org/wikipedia/commons/6/6a/Mona_Lisa.jpg', 'Portrait célèbre de Léonard de Vinci'),
(6, 'La Jeune Fille à la perle', 'Johannes Vermeer', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/1665_Girl_with_a_Pearl_Earring.jpg/1280px-1665_Girl_with_a_Pearl_Earring.jpg', 'Portrait célèbre d’une jeune femme portant une perle lumineuse.'),
(7, 'Guernica', 'Pablo Picasso', 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Mural_del_Gernika.jpg', 'Fresque monumentale dénonçant les horreurs de la guerre.'),
(8, 'Le Cri', 'Edvard Munch', 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Edvard_Munch%2C_1893%2C_The_Scream%2C_oil%2C_tempera_and_pastel_on_cardboard%2C_91_x_73_cm%2C_National_Gallery_of_Norway.jpg', 'Œuvre expressionniste symbolisant l’angoisse humaine.'),
(9, 'Les Nymphéas', 'Claude Monet', 'assets\\images\\nympheas.jpg', 'Série impressionniste inspirée du jardin de Giverny.'),
(10, 'La Liberté guidant le peuple', 'Eugène Delacroix', 'assets\\images\\liberte.jpg', 'Allégorie de la révolution française de 1830.'),
(11, 'Le Baiser', 'Gustav Klimt', 'assets\\images\\kiss.jpg', 'Tableau doré représentant un couple enlacé.'),
(12, 'American Gothic', 'Grant Wood', 'assets\\images\\american.jpg', 'Portrait emblématique de l’Amérique rurale.'),
(14, 'La Persistance de la mémoire', 'Salvador Dalí', 'assets\\images\\horloges.jpg', 'Tableau surréaliste aux célèbres montres molles.'),
(15, 'Un dimanche après-midi à l’Île de la Grande Jatte', 'Georges Seurat', 'assets\\images\\dimanche.jpg', 'Œuvre majeure du pointillisme.'),
(16, 'Le Fils de l’homme', 'René Magritte', 'assets\\images\\pomme.jpg', 'Homme au chapeau melon caché par une pomme.'),
(17, 'La Création d’Adam', 'Michel-Ange', 'assets\\images\\creation.jpg', 'Fresque emblématique de la chapelle Sixtine.'),
(18, 'Le Radeau de La Méduse', 'Théodore Géricault', 'assets\\images\\radeau.jpg', 'Scène dramatique inspirée d’un naufrage réel.'),
(19, 'La Nuit étoilée', 'Vincent van Gogh', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg/1920px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg', 'Paysage nocturne aux mouvements tourbillonnants.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`) VALUES
(2, 'test', 'n.bestieu@gmail.com', '$2y$10$xIlR6tiMRj/7oCM2YYxrlu/3edFp7hpBcFz2sU4b.SHROhsLiCKXa');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
