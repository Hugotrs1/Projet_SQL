-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 déc. 2024 à 09:37
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gta_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `vitesse` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `capacite` int(11) DEFAULT NULL,
  `annee` year(4) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `name`, `vitesse`, `prix`, `image`, `capacite`, `annee`, `categorie`) VALUES
(1, 'Voiture', 'Tezeract', 202, 2000000, 'tezeract.jpg', 2, '2020', 'Supersportive'),
(2, 'Voiture', '811', 240, 2050000, '811.jpg', 2, '2010', 'Supersportive'),
(3, 'Voiture', 'Emerus', 180, 1500000, 'emerus.jpg', 2, '2015', 'Supersportive'),
(4, 'Voiture', 'T20', 230, 2500000, 't20.jpg', 2, '2010', 'Supersportive'),
(5, 'Voiture', 'Tempesta', 215, 2400000, 'tempesta.jpg', 3, '2022', 'Supersportive'),
(6, 'Voiture', 'Autarch', 220, 3000000, 'autarch.jpg', 2, '2017', 'Supersportive'),
(7, 'Voiture', 'Cheetah', 282, 4000000, 'cheetah.jpg', 2, '2024', 'Supersportive'),
(8, 'Voiture', 'Itali GTB', 300, 3000000, 'italigtb.jpg', 2, '2023', 'Supersportive'),
(10, 'Avion', 'P-996 Lazer', 2400, 5000000, 'p996_lazer.jpg', 1, '2013', 'Avion de chasse'),
(11, 'Avion', 'Volatol', 410, 2000000, 'volatol.jpg', 50, '2022', 'Avion de chasse'),
(12, 'Avion', 'Hydra', 2200, 3000000, 'hydra.jpg', 1, '2015', 'Avion de chasse'),
(13, 'Avion', 'Velum', 300, 1200000, 'velum.jpg', 4, '2016', 'Avion privé'),
(15, 'Bateau', 'Dinghy', 80, 150000, 'dinghy.jpg', 4, '2015', 'Bateau léger'),
(16, 'Bateau', 'Kosatka', 95, 250000, 'kosatka.jpg', 20, '2017', 'Sous-marin'),
(17, 'Bateau', 'Toro', 120, 1700000, 'toro.jpg', 6, '2018', 'Bateau de luxe'),
(19, 'Avion', 'Alpha-Z1', 150, 400000, 'alpha.jpg', 1, '2023', 'Avion de voltige'),
(20, 'Avion', 'Avenger', 150, 1500000, 'avenger.jpg', 10, '2013', 'Avion privé'),
(21, 'Avion', '', 1000, 2500000, 'lf22.jpg', 0, '2017', 'Avion de chasse'),
(22, 'Avion', 'RO-86', 1500, 5500000, 'ro86.jpg', 2, '2013', 'Avion de chasse'),
(23, 'Avion', 'Luxor', 500, 5000000, 'luxor.jpg', 50, '2020', 'Avion privé'),
(24, 'Avion', 'Luxor Deluxe', 500, 10000000, 'luxor-deluxe.jpg', 50, '2023', 'Avion privé'),
(25, 'Avion', 'Cuban 800', 200, 100000, 'cuban.jpg', 3, '2018', 'Avion de voltige'),
(26, 'Avion', 'Mammatus', 150, 200000, 'mammatus.jpg', 4, '2011', 'Avion de voltige'),
(27, 'Bateau', 'Dinghy V2', 140, 500000, 'dinghy2.jpg', 7, '2020', 'Bateau léger'),
(28, 'Bateau', 'Dinghy V3', 160, 1000000, 'dinghy3.jpg', 7, '2020', 'Bateau léger'),
(29, 'Bateau', 'Seashark', 100, 100000, 'seashark.jpg', 7, '2020', 'Bateau léger'),
(30, 'Bateau', 'Kraken', 50, 100000, 'kraken.jpg', 3, '2015', 'Sous-marin'),
(31, 'Bateau', 'Kraken Avisa', 60, 150000, 'kraken-avisa.jpg', 3, '2016', 'Sous-marin'),
(32, 'Bateau', 'Submersible', 80, 300000, 'submersible.jpg', 2, '2017', 'Sous-marin'),
(33, 'Bateau', 'Longfin', 120, 600000, 'longfin.jpg', 10, '2019', 'Bateau de luxe'),
(34, 'Bateau', 'Jetmax', 120, 700000, 'jetmax.jpg', 10, '2020', 'Bateau de luxe'),
(35, 'Bateau', 'Squalo', 130, 800000, 'squalo.jpg', 5, '2010', 'Bateau de luxe'),
(36, 'Voiture', '9F Cabrio', 200, 250000, 'cabrio.jpg', 4, '2023', 'Sport'),
(37, 'Voiture', 'Comet', 210, 300000, 'comet.jpg', 4, '2021', 'Sport'),
(38, 'Voiture', 'Coquette', 235, 1520000, 'coquette.jpg', 2, '2023', 'Sport'),
(39, 'Voiture', 'Itali RSX', 200, 1500000, 'italirsx.jpg', 2, '2022', 'Sport'),
(40, 'Voiture', 'Karting', 60, 20000, 'veto.jpg', 2, '2018', 'Sport'),
(41, 'Voiture', 'Buggy Rampe', 180, 600000, 'buggy.jpg', 2, '2016', 'Tout-terrain'),
(42, 'Voiture', 'Everon', 140, 450000, 'everon.jpg', 4, '2014', 'Tout-terrain'),
(43, 'Voiture', 'Insurgent', 120, 4050000, 'insurgent.jpg', 4, '2019', 'Tout-terrain'),
(44, 'Voiture', 'Space Docker', 170, 700000, 'docker.jpg', 2, '2014', 'Tout-terrain'),
(45, 'Voiture', 'BR8', 360, 1000000, 'br8.jpg', 1, '2010', 'Ultralégères'),
(46, 'Voiture', 'DR1', 360, 1200000, 'dr1.jpg', 1, '2015', 'Ultralégères'),
(47, 'Voiture', 'PR4', 355, 2000000, 'pr4.jpg', 1, '2018', 'Ultralégères'),
(48, 'Voiture', 'R88', 370, 10000000, 'r88.jpg', 1, '2020', 'Ultralégères');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
