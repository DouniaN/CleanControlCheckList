-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 07 sep. 2020 à 10:20
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cccl`
--

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id_action` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_categorie_action` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id_action`, `action`, `id_categorie_action`, `created_at`, `updated_at`) VALUES
(1, 'dépoussiérer', 1, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(2, 'balayer', 1, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(3, 'Nettoyer', 1, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(4, 'réparer', 2, '2020-07-07 23:00:00', '2020-07-07 23:00:00'),
(7, 'désinfecter les surfaces', 1, '2020-07-07 23:00:00', '2020-07-07 23:00:00'),
(9, 'vider les poubelles', 1, '2020-07-07 23:00:00', '2020-07-07 23:00:00'),
(10, 'Ramasser déchets', 1, NULL, NULL),
(11, 'Vider Poubelles', 1, NULL, NULL),
(12, 'Placer Poubelles', 1, NULL, NULL),
(13, 'changer Biens', 1, NULL, NULL),
(20, 'brillants les miroirs', 1, NULL, NULL),
(21, 'Le remplacement des résistances sur les plaques de cuisson', 2, NULL, NULL),
(22, 'Le changement des prises de téléphone', 2, NULL, NULL),
(23, 'essuyer et nettoyer ', 1, NULL, NULL),
(24, 'vider et nettoyer ', 1, NULL, NULL),
(25, 'ramasser les détritus', 1, NULL, NULL),
(26, 'Détartrer les appareils sanitaires', 1, NULL, NULL),
(27, '\r\nLe changement des ampoules, des néons\r\n', 2, NULL, NULL),
(28, 'Le remplacement des prises de courant et des interrupteurs', 2, NULL, NULL),
(29, 'Le remplacement des résistances des cumulus', 2, NULL, NULL),
(30, 'Le remplacement des résistances des cumulus', 2, NULL, NULL),
(31, 'Le détartrage des résistances', 2, NULL, NULL),
(32, 'Le remplacement de la robinetterie', 2, NULL, NULL),
(33, 'Le débouchage de la tuyauterie intérieure', 2, NULL, NULL),
(34, 'La réfection des joints', 2, NULL, NULL),
(35, 'Le changement des barillets de portes intérieures', 2, NULL, NULL),
(36, 'La peinture', 2, NULL, NULL),
(37, 'La peinture et les retouches', 2, NULL, NULL),
(38, 'La plaquisterie', 2, NULL, NULL),
(39, '\r\nL’installation de séparation\r\n', 2, NULL, NULL),
(40, 'Le remplacement des résistances sur les plaques de cuisson', 3, NULL, NULL),
(41, 'Le remplacement des prises de courant et des interrupteurs', 3, NULL, NULL),
(42, 'Le changement des ampoules, des néons', 3, NULL, NULL),
(43, 'Le changement des prises de téléphone', 3, NULL, NULL),
(44, 'Le remplacement des résistances des cumulus', 4, NULL, NULL),
(45, 'Le détartrage des résistances', 4, NULL, NULL),
(46, 'Le remplacement de la robinetterie', 4, NULL, NULL),
(47, 'Le débouchage de la tuyauterie intérieure', 4, NULL, NULL),
(48, 'La réfection des joints', 4, NULL, NULL),
(49, 'Le changement des barillets de portes intérieures', 5, NULL, NULL),
(50, 'La peinture', 5, NULL, NULL),
(51, 'La peinture et les retouches', 5, NULL, NULL),
(52, 'La plaquisterie', 5, NULL, NULL),
(53, 'L’installation de séparation', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `action_checks`
--

CREATE TABLE `action_checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_action` bigint(20) UNSIGNED NOT NULL,
  `id_check` bigint(20) UNSIGNED NOT NULL,
  `validation_operateur` int(11) NOT NULL DEFAULT '0',
  `commentaire_operateur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_controleur` int(11) NOT NULL DEFAULT '0',
  `commentaire_controlleur` text COLLATE utf8mb4_unicode_ci,
  `Date_action` datetime NOT NULL,
  `Date_action_operateur` datetime DEFAULT NULL,
  `Date_Satisfaction_Controlleur` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `action_checks`
--

INSERT INTO `action_checks` (`id`, `id_action`, `id_check`, `validation_operateur`, `commentaire_operateur`, `validation_controleur`, `commentaire_controlleur`, `Date_action`, `Date_action_operateur`, `Date_Satisfaction_Controlleur`, `created_at`, `updated_at`) VALUES
(146, 4, 501, 0, '', 0, NULL, '2020-09-01 21:09:00', '2020-09-01 21:12:35', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `agents`
--

CREATE TABLE `agents` (
  `id_agent` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Num_tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_division` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agents`
--

INSERT INTO `agents` (`id_agent`, `nom`, `prenom`, `cin`, `Num_tel`, `id_division`, `created_at`, `updated_at`) VALUES
(1, 'Yasmini', 'Yasmin', 'FA122222', '06222332', 3, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(2, 'Akrami', 'Ikram', 'FA22222', '07222222', 2, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(3, 'yazidi', 'FAtiha', 'FA12222', '0222222', 1, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(4, 'Fathi', 'Yasmin', 'FA111', '0666666666', 1, '2020-07-03 23:00:00', '2020-07-03 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `categorie`, `created_at`, `updated_at`) VALUES
(1, 'consistance', NULL, NULL),
(2, 'accessoires', NULL, NULL),
(3, 'equipement', NULL, NULL),
(4, 'mobiliers', NULL, NULL),
(7, 'Fournitures', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_actions`
--

CREATE TABLE `categorie_actions` (
  `id_categorie_action` int(11) NOT NULL,
  `categorie_action` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie_actions`
--

INSERT INTO `categorie_actions` (`id_categorie_action`, `categorie_action`) VALUES
(1, 'Actions de nettoyage '),
(2, 'Actions de maintenance'),
(3, 'Electricité'),
(4, 'Plomberie'),
(5, 'Serrurerie');

-- --------------------------------------------------------

--
-- Structure de la table `checks`
--

CREATE TABLE `checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_etat` datetime DEFAULT NULL,
  `etat_propre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ReferenceSalle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_etat` bigint(20) UNSIGNED DEFAULT NULL,
  `id_remarque` bigint(11) NOT NULL DEFAULT '3',
  `id_action` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `id_division` bigint(20) UNSIGNED DEFAULT NULL,
  `id_categorie` int(10) UNSIGNED DEFAULT NULL,
  `id_materiel` int(10) UNSIGNED DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `action_check` int(11) NOT NULL DEFAULT '0',
  `designationBiens` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Note_Nettoiement` int(11) NOT NULL DEFAULT '20',
  `Pricision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satisfaction_conservateur` int(11) NOT NULL DEFAULT '0',
  `checks_EnCours` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `checks`
--

INSERT INTO `checks` (`id`, `date_etat`, `etat_propre`, `image`, `ReferenceSalle`, `id_etat`, `id_remarque`, `id_action`, `id_division`, `id_categorie`, `id_materiel`, `commentaire`, `action_check`, `designationBiens`, `Note_Nettoiement`, `Pricision`, `satisfaction_conservateur`, `checks_EnCours`, `created_at`, `updated_at`) VALUES
(501, '2020-09-01 21:08:17', '', 'climatiseurendomager_1598994497.jpg', 'N°3', 3, 3, 1, 9, 2, 34, '', 0, '4', 20, '', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `divisions`
--

CREATE TABLE `divisions` (
  `id_division` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `divisions`
--

INSERT INTO `divisions` (`id_division`, `division`, `created_at`, `updated_at`) VALUES
(1, 'DGNI', '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(2, 'DASDH', '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(3, 'DACS', '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(4, 'DAROAC', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(5, 'DCMCCI', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(6, 'DETU', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(7, 'DGRL', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(8, 'DCTAJ', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(9, 'Cabinet', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(10, 'DAI', '2020-07-08 23:00:00', '2020-07-08 23:00:00'),
(11, 'DSG', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `id_etat` bigint(20) UNSIGNED NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etats`
--

INSERT INTO `etats` (`id_etat`, `etat`, `points`, `created_at`, `updated_at`) VALUES
(2, 'propreté', 2, '2020-07-03 23:00:00', '2020-07-03 23:00:00'),
(3, 'Endommagé', 0, '2020-07-04 23:00:00', '2020-07-04 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `materiels`
--

CREATE TABLE `materiels` (
  `id_materiel` bigint(20) UNSIGNED NOT NULL,
  `materiel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiels`
--

INSERT INTO `materiels` (`id_materiel`, `materiel`, `id_categorie`, `created_at`, `updated_at`) VALUES
(26, 'couloir', 1, NULL, NULL),
(27, 'cuisine', 1, NULL, NULL),
(28, 'balcon', 1, NULL, NULL),
(29, 'escalier', 1, NULL, NULL),
(30, 'Hall', 1, NULL, NULL),
(31, 'bureau', 1, NULL, NULL),
(32, 'sanitaire', 1, NULL, NULL),
(33, 'lustre', 2, NULL, NULL),
(34, 'climatiseur', 2, NULL, NULL),
(35, 'tableaux', 2, NULL, NULL),
(36, 'poubelle', 2, NULL, NULL),
(37, 'livres', 2, NULL, NULL),
(38, 'rideaux', 2, NULL, NULL),
(39, 'porte', 3, NULL, NULL),
(40, 'fenetre', 3, NULL, NULL),
(41, 'murs', 3, NULL, NULL),
(42, 'interrupteur', 3, NULL, NULL),
(43, 'Bureau', 4, NULL, NULL),
(44, 'chaise', 4, NULL, NULL),
(45, 'table', 4, NULL, NULL),
(46, 'fauteuil', 4, NULL, NULL),
(47, 'table', 4, NULL, NULL),
(48, 'ecran TV', 4, NULL, NULL),
(49, 'bibliothèque', 4, NULL, NULL),
(50, 'Materiel informatique', 4, NULL, NULL),
(51, 'teste ADD', 2, NULL, NULL),
(52, 'testerrrrr', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_07_04_175553_create_actions_table', 1),
(2, '2020_07_04_180609_create_etats_table', 2),
(3, '2020_07_04_181008_create_divisions_table', 3),
(4, '2020_07_04_181322_create_agents_table', 4),
(5, '2020_07_04_182544_create_categories_table', 5),
(6, '2020_07_04_182924_create_materiels_table', 6),
(7, '2020_07_10_101720_action_checks', 7),
(8, '2020_07_10_104746_create_action_checks_table', 8),
(9, '2020_08_01_081800_create_roles_table', 9),
(10, '2020_08_01_082257_roles', 9);

-- --------------------------------------------------------

--
-- Structure de la table `remarques`
--

CREATE TABLE `remarques` (
  `id_remarque` int(11) NOT NULL,
  `remarque` varchar(255) NOT NULL,
  `id_etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `remarques`
--

INSERT INTO `remarques` (`id_remarque`, `remarque`, `id_etat`) VALUES
(1, 'Présence de poussière', 2),
(2, 'Présence de tache', 2),
(3, 'pas de remarque', 3),
(4, 'Poubelle non vidée', 2);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_role`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'controlleur', NULL, NULL),
(3, 'operateur', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_role`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin@gmail.com', NULL, '$2y$10$a3vWaKnmPEknaZGAnDm7L.8Hl4gMYB1wUCrJLWtxAESVxqBMbKKt.', 1, NULL, '2020-08-02 07:02:47', '2020-08-02 07:02:47'),
(4, 'operateurProprote', 'Operateur_Proprote@gmail.com', NULL, '$2y$10$fNH5nPjTdAQ3WLolYT6LVuGg6gSX5yN.A/2I3Ng9rbxlO64/StVlq', 3, NULL, '2020-08-03 08:37:55', '2020-08-03 08:37:55'),
(7, 'operateurMaintenance', 'Operateur_Maintenance@gmail.com', NULL, '$2y$10$fNH5nPjTdAQ3WLolYT6LVuGg6gSX5yN.A/2I3Ng9rbxlO64/StVlq', 3, NULL, '2020-08-03 08:37:55', '2020-08-03 08:37:55'),
(8, 'Controlleur', 'Controlleur@gmail.com', NULL, '$2y$10$a3vWaKnmPEknaZGAnDm7L.8Hl4gMYB1wUCrJLWtxAESVxqBMbKKt.', 1, NULL, '2020-08-02 07:02:47', '2020-08-02 07:02:47');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id_action`);

--
-- Index pour la table `action_checks`
--
ALTER TABLE `action_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_checks_id_action_foreign` (`id_action`),
  ADD KEY `action_checks_id_action_check_foreign` (`id_check`);

--
-- Index pour la table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`),
  ADD KEY `agents_id_division_foreign` (`id_division`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `categorie_actions`
--
ALTER TABLE `categorie_actions`
  ADD PRIMARY KEY (`id_categorie_action`);

--
-- Index pour la table `checks`
--
ALTER TABLE `checks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id_division`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `materiels`
--
ALTER TABLE `materiels`
  ADD PRIMARY KEY (`id_materiel`),
  ADD KEY `materiels_id_categorie_foreign` (`id_categorie`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `remarques`
--
ALTER TABLE `remarques`
  ADD PRIMARY KEY (`id_remarque`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id_action` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `action_checks`
--
ALTER TABLE `action_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT pour la table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie_actions`
--
ALTER TABLE `categorie_actions`
  MODIFY `id_categorie_action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `checks`
--
ALTER TABLE `checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;

--
-- AUTO_INCREMENT pour la table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id_division` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `id_etat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `materiels`
--
ALTER TABLE `materiels`
  MODIFY `id_materiel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `remarques`
--
ALTER TABLE `remarques`
  MODIFY `id_remarque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `action_checks`
--
ALTER TABLE `action_checks`
  ADD CONSTRAINT `action_checks_id_action_check_foreign` FOREIGN KEY (`id_check`) REFERENCES `checks` (`id`),
  ADD CONSTRAINT `action_checks_id_action_foreign` FOREIGN KEY (`id_action`) REFERENCES `actions` (`id_action`);

--
-- Contraintes pour la table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_id_division_foreign` FOREIGN KEY (`id_division`) REFERENCES `divisions` (`id_division`);

--
-- Contraintes pour la table `materiels`
--
ALTER TABLE `materiels`
  ADD CONSTRAINT `materiels_id_categorie_foreign` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
