-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2023 at 03:53 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forfaits-api`
--

-- --------------------------------------------------------

--
-- Table structure for table `forfaits`
--

CREATE TABLE `forfaits` (
  `id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `code` int NOT NULL,
  `statut` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nom_etablissement` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `courriel` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `site_web` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description_etablissement` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `prix` int NOT NULL,
  `nouveau_prix` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forfaits`
--

INSERT INTO `forfaits` (`id`, `image`, `nom`, `description`, `code`, `statut`, `nom_etablissement`, `adresse`, `ville`, `telephone`, `courriel`, `site_web`, `description_etablissement`, `date_debut`, `date_fin`, `prix`, `nouveau_prix`) VALUES
(1, 'https://picsum.photos/200/200', 'Expédition Nature', 'Venez vivre une expérience unique en nature avec notre excursion guidé de 2 jours et 2 nuits dans les bois. Faune, flore, nuits étoilées sous la tente, déconnexion digitale. Idéal pour les amateurs de plein air. Réservez maintenant !', 5437, 'premium', 'Parc de la Vérendry', '1070, 3e avenue Est', 'Val-d’Or', '819 435-2216', 'info@sepaq.com', 'laverendryeoutaouais@sepaq.com', 'Avec plus de 4000 lacs, l’eau est une richesse inouïe pour la réserve faunique La Vérendrye. Elle englobe le Grand lac Victoria et deux gigantesques réservoirs, Dozois et Cabonga, qu’alimentent des rivières aux noms évocateurs des cultures locales.', '2023-08-03', '2023-08-05', 400, 375),
(2, 'https://picsum.photos/200/200', 'Forfait pêche familiale', 'S\'amuser au bord de l\'eau, guimauves sur feu de camp, moments en famille. On vous propose des secteurs faciles d\'accès et espace pour les enfants. Venez créer des souvenirs inoubliables !', 2578, '', 'Réserve faunique Rouge‑Matawin', '2002, chemin du Lac Macaza', 'La Macaza', '819 275-1140', 'info@sepaq.com', 'rougematawin@sepaq.com', 'Partagée entre les régions de Lanaudière et des Laurentides, la réserve faunique Rouge-Matawin présente une dualité bien marquée.', '2023-07-27', '2023-07-30', 499, 450),
(3, 'https://picsum.photos/200/200', 'Chasse au petit gibier', 'Forfaits de chasse au cerf de Virginie dans la réserve faunique de Papineau-Labelle.’ Pister le cerf demande cran, patience et observation. Réservez dès maintenant.', 2519, 'premium', 'Réserve faunique Rouge‑Matawin', '5000, chemin du Lac-Gagnon Ouest (route 6)', 'Duhamel, Québec', ' 819 428-7510', 'info@sepaq.com', 'papineau@sepaq.com', 'Partagée entre les régions de l\'Outaouais et des Laurentides, la réserve faunique de Papineau-Labelle se caractérise, notamment, par sa position géographique qui fait d\'elle la réserve faunique la plus au sud du Québec.', '2023-10-06', '2023-10-12', 585, 500),
(4, 'https://picsum.photos/200/200', 'Arbraska', 'Profitez de 2 nuitées en chalet et d’Un parcours d\'aventure aérien offrant une vue imprenable sur le lac Saint-Joseph! Venez vivre une expérience aérienne inoubliable à la cime des arbres et au rythme de la nature!', 6985, '', 'Station touristique Duchesnay', '140, montée de l’Auberge', 'Sainte-Catherine', '418 875-2122', 'info@sepaq.com', 'duchesnay@sepaq.com\'', 'Duchesnay est situé à 30 minutes de la ville de Québec, dans la région de la Capitale-Nationale, ainsi qu\'en bordure du magnifique lac Saint-Joseph.', '2023-08-12', '2023-08-14', 285, 250),
(5, 'https://picsum.photos/200/200', 'Casino Royale', 'Profitez de 2 nuitées en chalet et d’Un parcours d\'aventure aérien offrant une vue imprenable sur le lac Saint-Joseph! Venez vivre une expérience aérienne inoubliable à la cime des arbres et au rythme de la nature!', 2646, 'premium', 'Canot-camping', '99, chemin de la Matawin', 'Trois-Rives, Québec', '819 646-5680', 'info@sepaq.com', 'stmaurice@sepaq.com', 'Profitez de 2 nuitées en chalet et d’Un parcours d\'aventure aérien offrant une vue imprenable sur le lac Saint-Joseph! Venez vivre une expérience aérienne inoubliable à la cime des arbres et au rythme de la nature!', '2023-07-21', '2023-07-24', 285, 250),
(6, 'https://picsum.photos/200/200', 'Séjour Chic-Chocs', 'Profitez de 3 nuitées dans le  grand confort quatre étoiles à l’Auberge de montagne des Chic-Chocs.', 5486, '', 'Rés. faunique Rouge‑Matawin', '90, boulevard Sainte-Anne Ouest, bureau 101', 'Sainte-Anne-des-Monts', '1 800 665-3091', 'info@sepaq.com', 'auberge.chicchocs@sepaq.com', 'Unique dans l’est du Canada, elle est perchée à 615 m d’altitude, au cœur de la réserve faunique de Matane.', '2023-08-03', '2023-08-06', 800, 715),
(7, 'https://picsum.photos/200/200', ' AJOUT Expédition Nature', 'AJOUT Venez vivre une expérience unique en nature avec notre excursion guidé de 2 jours et 2 nuits dans les bois. Faune, flore, nuits étoilées sous la tente, déconnexion digitale. Idéal pour les amateurs de plein air. Réservez maintenant !', 5437, 'premium', 'AJOUT Expédition Nature', '1070, 3e avenue E.', ' AJOUT Val-d’Or', '819 435-2216', 'info@sepaq.com', 'laverendryeoutaouais@sepaq.com', ' AJOUT Venez vivre une expérience unique en nature avec notre excursion guidé de 2 jours et 2 nuits dans les bois. Faune, flore, nuits étoilées sous la tente, déconnexion digitale. Idéal pour les amateurs de plein air. Réservez maintenant !', '2023-08-03', '2023-08-05', 400, 375);

-- --------------------------------------------------------

--
-- Table structure for table `meteo`
--

CREATE TABLE `meteo` (
  `id` int NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `temperature` int NOT NULL,
  `condition` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forfaits`
--
ALTER TABLE `forfaits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meteo`
--
ALTER TABLE `meteo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forfaits`
--
ALTER TABLE `forfaits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meteo`
--
ALTER TABLE `meteo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
