-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 19 Février 2026 à 00:00
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ggnator`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) NOT NULL,
  `result_id` int(10) NOT NULL,
  `win` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `date`, `user_id`, `result_id`, `win`) VALUES
(38, '2026-02-19 00:58:33', 6, 6, 0),
(39, '2026-02-19 00:58:40', 6, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `question` varchar(255) NOT NULL,
  `is_first` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `question`, `is_first`) VALUES
(1, 'Le jeu est-il principalement multijoueur ?', 1),
(2, 'Le jeu adopte-t-il un style réaliste ?', 0),
(3, 'Est-il possible de construire des structures dans le jeu ?', 0),
(4, 'Le réalisme du jeu est-il très poussé (type simulation militaire) ?', 0),
(5, 'Le jeu possède-t-il un style graphique cartoon ?', 0),
(6, 'S’agit-il d’un jeu de plateforme ?', 0),
(7, 'L’histoire se déroule-t-elle dans un monde moderne ?', 0);

-- --------------------------------------------------------

--
-- Structure de la table `response`
--

CREATE TABLE `response` (
  `id` int(10) NOT NULL,
  `content` varchar(255) NOT NULL,
  `question_id` int(10) NOT NULL,
  `next_question_id` int(10) DEFAULT NULL,
  `result_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `response`
--

INSERT INTO `response` (`id`, `content`, `question_id`, `next_question_id`, `result_id`) VALUES
(1, 'Oui', 1, 2, NULL),
(2, 'Non', 1, 5, NULL),
(3, 'Oui', 2, 4, NULL),
(4, 'Non', 2, 3, NULL),
(5, 'Oui', 3, NULL, 1),
(6, 'Non', 3, NULL, 2),
(7, 'Oui', 4, NULL, 3),
(8, 'Non', 4, NULL, 4),
(9, 'Oui', 5, 6, NULL),
(10, 'Non', 5, 7, NULL),
(11, 'Oui', 6, NULL, 5),
(12, 'Non', 6, NULL, 6),
(13, 'Oui', 7, NULL, 7),
(14, 'Non', 7, NULL, 8);

-- --------------------------------------------------------

--
-- Structure de la table `result`
--

CREATE TABLE `result` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `result`
--

INSERT INTO `result` (`id`, `name`, `description`, `image`) VALUES
(1, 'Fortnite', 'Battle Royale multijoueur avec construction et style semi-cartoon.', 'fortnite.jpg'),
(2, 'Overwatch', 'Jeu de tir multijoueur en équipe avec un style coloré.', 'overwatch.jpg'),
(3, 'Battlefield', 'Jeu de guerre réaliste avec de grandes batailles multijoueur.', 'battlefield.jpg'),
(4, 'Call of Duty', 'FPS moderne avec un réalisme poussé et modes multijoueur.', 'cod.jpg'),
(5, 'Mario', 'Jeu de plateforme iconique dans un univers coloré.', 'mario.jpg'),
(6, 'Zelda', 'Jeu d’aventure dans un univers fantastique.', 'zelda.jpg'),
(7, 'The Last of Us', 'Jeu narratif post-apocalyptique dans un monde moderne.', 'tlou.jpg'),
(8, 'Dark Souls', 'RPG exigeant dans un univers sombre et médiéval.', 'darksouls.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `register_date`) VALUES
(6, 'gab', 'gabcab1002@gmail.com', '$2y$10$4vILcelx3ziQ1ffeTC.v9OsvEi1b22zOC8vDJ65WHW8uqy12SzC1S', '2026-02-18');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `result_id` (`result_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `response`
--
ALTER TABLE `response`
  ADD KEY `question_id` (`question_id`),
  ADD KEY `next_question_id` (`next_question_id`),
  ADD KEY `result_id` (`result_id`);

--
-- Index pour la table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`result_id`) REFERENCES `result` (`id`);

--
-- Contraintes pour la table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`result_id`) REFERENCES `result` (`id`),
  ADD CONSTRAINT `response_ibfk_3` FOREIGN KEY (`next_question_id`) REFERENCES `questions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
