-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 14 juil. 2024 à 03:40
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
-- Base de données : `e-learning1`
--

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id_doc` int(11) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_m` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id_doc`, `fichier`, `title`, `id_m`) VALUES
(1, 'p2.pdf', 'fgdgd', 12),
(2, 'p2.pdf', 'fgdgd', 12),
(3, 'p3.pdf', 'gfgfgf', 12),
(4, 'p3.pdf', 'fsdfsdf', 12),
(5, 'p3.pdf', 'fsdfsdf', 12),
(6, 'p2.pdf', 'jhjghj', 13),
(7, 'p2.pdf', '', 12);

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE `feedback` (
  `idfeed` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `Incoming_msg_id` int(11) NOT NULL,
  `Outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `Incoming_msg_id`, `Outgoing_msg_id`, `msg`) VALUES
(8, 2475, 6, 'gdfgfd'),
(9, 6, 6666, 'fsdfsdf'),
(10, 6, 6666, 'fsdfsdfs'),
(11, 1256, 6666, 'sqdsc'),
(12, 1256, 1157055847, 'ddd'),
(13, 666, 5, 'hey'),
(14, 5, 1157055847, 'vsvsdfsdf');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `idmod` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `contenu` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `dateadd` date NOT NULL,
  `id_user` int(20) NOT NULL,
  `formation` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`idmod`, `title`, `contenu`, `description`, `dateadd`, `id_user`, `formation`, `level`) VALUES
(1, 'New Module Title', 'Module Content', 'Module Descriptiofffn', '2024-05-25', 61, '', ''),
(5, 'fsfsdfsdf', 'sdfsdf', 'sdfsfd', '2024-05-25', 54, '', ''),
(6, 'dsqdf', 'qsdqs', 'dqsdqsd', '2024-05-25', 62, '', ''),
(7, 'ffff', 'ffff', 'dsd', '2024-05-25', 62, '', ''),
(8, 'sdfsdf', 'fsdf', 'zaaaa', '2024-05-25', 62, '', ''),
(9, 'ffff', 'fff', 'fff', '2024-05-25', 62, '', ''),
(10, 'fsdfsdf', 'fsdfs', 'dfsd', '2024-05-25', 62, '', ''),
(11, 'fdsfs', 'dfsd', 'abc', '2024-05-25', 62, '', ''),
(12, 'fsf', 'f', 'f', '2024-05-26', 63, '', ''),
(13, 'fsdfsdf', 'fsdfsdf', 'fsdfsdf', '2024-05-26', 63, 'Cycle Préparatoire', '1er année'),
(14, 'aa', 'aa', 'fsdf', '2024-05-26', 63, 'Licences', '1er année'),
(15, 'fdsfsdf', 'fsdf', 'fsdf', '2024-05-26', 63, 'Cycle ingénieur', '2eme année');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prénom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `formation` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `datenaiss` date NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `access` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prénom`, `email`, `password`, `status`, `role`, `formation`, `level`, `datenaiss`, `phone`, `image`, `unique_id`, `access`) VALUES
(54, 'Akrem', 'Homrani', 'amine.homrani@iteam-univ.tn', '$2y$10$4Ukr/PZGHIr./EnwSWTlh.oaGv2vZANzvDB7nxSwSbwX0qYgs0Xl2', 'enable', 'admin', 'Cycle Preparatoire', '1er année', '2024-05-15', '53717752', 'akrem.jpg', 6666, ''),
(61, 'Akrem', 'Homrani', 'akr3m.homrani@iteam-univ.tn', '$2y$10$kpIBdPVxf9rENOi.wDH1QeBsH2ruP0uWemSFMrQlezr6pIv4OE5.K', 'enable', 'user', NULL, NULL, '2024-05-30', '53717752', 'emna.jpg', 5, ''),
(62, 'amira\r\n', 'Homrani', 'amira.homrani@iteam-univ.tn', '$2y$10$4Ukr/PZGHIr./EnwSWTlh.oaGv2vZANzvDB7nxSwSbwX0qYgs0Xl2', 'enable', 'teacher', 'Licences', '1er année', '2024-05-15', '53717752', 'akrem.jpg', 6666, ''),
(63, 'drira\r\n', 'moncef', 'drira.moncef@iteam-univ.tn', '$2y$10$4Ukr/PZGHIr./EnwSWTlh.oaGv2vZANzvDB7nxSwSbwX0qYgs0Xl2', 'enable', 'teacher', 'Cycle Préparatoire', '2eme année', '2024-05-15', '53717752', 'akrem.jpg', 6666, ''),
(64, 'drira\r\n', 'moncef', 'drira.moncef2@iteam-univ.tn', '$2y$10$4Ukr/PZGHIr./EnwSWTlh.oaGv2vZANzvDB7nxSwSbwX0qYgs0Xl2', 'enable', 'teacher', 'Licences', NULL, '2024-05-15', '53717752', 'akrem.jpg', 6666, ''),
(65, 'zine', 'eddin', 'zine.homrani@iteam-univ.tn', '$2y$10$4Ukr/PZGHIr./EnwSWTlh.oaGv2vZANzvDB7nxSwSbwX0qYgs0Xl2', 'enable', 'etudiant', 'Licences', NULL, '2024-05-15', '53717752', 'smayir.jpg', 6666, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `Module` (`id_m`);

--
-- Index pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`idfeed`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`idmod`),
  ADD KEY `fk_module_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `idfeed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `idmod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `fk_module_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
