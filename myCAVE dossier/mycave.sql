-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : ven. 11 juin 2021 à 11:57
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mycave`
--

-- --------------------------------------------------------

--
-- Structure de la table `bottle`
--

DROP TABLE IF EXISTS `bottle`;
CREATE TABLE IF NOT EXISTS `bottle` (
  `id_bottle` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cepage` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_to_user` smallint(6) NOT NULL,
  `id_to_category` smallint(6) NOT NULL,
  PRIMARY KEY (`id_bottle`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bottle`
--

INSERT INTO `bottle` (`id_bottle`, `nom`, `cepage`, `region`, `pays`, `id_to_user`, `id_to_category`) VALUES
(1, 'CHATEAU DE SAINT COSME', 'Grenache / Syrah', 'Southern Rhone / Gigondas', 'France', 1, 1),
(2, 'LAN RIOJA CRIANZA', 'Tempranillo', 'Rioja', 'Spain', 1, 1),
(3, 'MARGERUM SYBARITE', 'Sauvignon Blanc', 'California Central Cosat', 'USA', 1, 2),
(4, 'OWEN ROE \"EX UMBRIS\"', 'Syrah', 'Washington', 'USA', 1, 1),
(5, 'REX HILL', 'Pinot Noir', 'Oregon', 'USA', 1, 1),
(6, 'VITICCIO CLASSICO RISERVA', 'Sangiovese Merlot', 'Tuscany', 'Italy', 1, 1),
(7, 'CHATEAU LE DOYENNE', 'Merlot', 'Bordeaux', 'France', 1, 1),
(8, 'DOMAINE DU BOUSCAT', 'Merlot', 'Bordeaux', 'France', 1, 1),
(9, 'BLOCK NINE', 'Pinot Noir', 'California', 'USA', 1, 1),
(10, 'DOMAINE SERENE', 'Pinot Noir', 'Oregon', 'USA', 1, 1),
(11, 'BODEGA LURTON', 'Pinot Gris', 'Mendoza', 'Argentina', 1, 2),
(12, 'LES MORIZOTTES', 'Chardonnay', 'Burgundy', 'France', 1, 2),
(13, 'CHATEAU PIQUETTE', 'Pinot cul', 'Rh&ocirc;ne-alpes', 'France', 1, 3),
(14, 'CHATEAU PIQUETTE2', '', '', '', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` smallint(6) NOT NULL,
  `type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `type`) VALUES
(1, 'rouge'),
(2, 'blanc'),
(3, 'rosé');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` smallint(6) NOT NULL,
  `role` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'éditeur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` smallint(6) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mot_de_passe` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_to_role` smallint(6) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `identifiant` (`identifiant`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `identifiant`, `mot_de_passe`, `id_to_role`) VALUES
(1, 'admin', '$2y$10$zUZ13YpEBvfbnP/1wDG95eOCdxN.A.XhOW35CpLp2Al2iCMiTHspO', 1),
(4, 'test', '$2y$10$RVkrBxrJ1EjRhxdaeqD.MO7fu96sBlzTqc6TXqOA4ro8zQjZ.19V6', 2),
(5, 'test2', '$2y$10$7pa/mirbT50Vkjc8VPBTUuhPs1YadEPonv7vHUCoayMJ.4/F09d.2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `year`
--

DROP TABLE IF EXISTS `year`;
CREATE TABLE IF NOT EXISTS `year` (
  `id_year` smallint(6) NOT NULL AUTO_INCREMENT,
  `annee` year(4) NOT NULL,
  `stock` smallint(6) NOT NULL DEFAULT 1,
  `descri` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` tinytext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'generic.jpg',
  `id_to_bottle` smallint(6) NOT NULL,
  PRIMARY KEY (`id_year`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `year`
--

INSERT INTO `year` (`id_year`, `annee`, `stock`, `descri`, `photo`, `id_to_bottle`) VALUES
(1, 2009, 1, 'The aromas of fruit and spice give one a hint of the light drinkability of this lovely wine, which makes an excellent complement to fish dishes.', 'saint_cosme.jpg', 1),
(2, 2006, 1, 'A resurgence of interest in boutique vineyards has opened the door for this excellent foray into the dessert wine market. Light and bouncy, with a hint of black truffle, this wine will not fail to tickle the taste buds.', 'lan_rioja.jpg', 2),
(3, 2010, 1, 'The cache of a fine Cabernet in ones wine cellar can now be replaced with a childishly playful wine bubbling over with tempting tastes of\r\nblack cherry and licorice. This is a taste sure to transport you back in time.', 'margerum.jpg', 3),
(4, 2009, 1, 'A one-two punch of black pepper and jalapeno will send your senses reeling, as the orange essence snaps you back to reality. Don\'t miss\r\nthis award-winning taste sensation.', 'ex_umbris.jpg', 4),
(5, 2009, 1, 'One cannot doubt that this will be the wine served at the Hollywood award shows, because it has undeniable star power. Be the first to catch\r\nthe debut that everyone will be talking about tomorrow.', 'rex_hill.jpg', 5),
(6, 2007, 1, 'Though soft and rounded in texture, the body of this wine is full and rich and oh-so-appealing. This delivery is even more impressive when one takes note of the tender tannins that leave the taste buds wholly satisfied.', 'viticcio.jpg', 6),
(7, 2005, 1, 'Though dense and chewy, this wine does not overpower with its finely balanced depth and structure. It is a truly luxurious experience for the\r\nsenses.', 'le_doyenne.jpg', 7),
(8, 2009, 1, 'The light golden color of this wine belies the bright flavor it holds. A true summer wine, it begs for a picnic lunch in a sun-soaked vineyard.', 'bouscat.jpg', 8),
(9, 2009, 1, 'With hints of ginger and spice, this wine makes an excellent complement to light appetizer and dessert fare for a holiday gathering.', 'block_nine.jpg', 9),
(10, 2007, 1, 'Though subtle in its complexities, this wine is sure to please a wide range of enthusiasts. Notes of pomegranate will delight as the nutty finish completes the picture of a fine sipping experience.', 'domaine_serene.jpg', 10),
(11, 2011, 1, 'Solid notes of black currant blended with a light citrus make this wine an easy pour for varied palates.', 'bodega_lurton.jpg', 11),
(12, 2009, 1, 'Breaking the mold of the classics, this offering will surprise and undoubtedly get tongues wagging with the hints of coffee and tobacco in\r\nperfect alignment with more traditional notes. Breaking the mold of the classics, this offering will surprise and\r\nundoubtedly get tongues wagging with the hints of coffee and tobacco in\r\nperfect alignment with more traditional notes. Sure to please the late-night crowd with the slight jolt of adrenaline it brings.', 'morizottes.jpg', 12),
(13, 2018, 1, 'tu le sent passer dans le gossier', '60c22b9351c76_zobie.jpg', 13),
(14, 0000, 1, '', 'generic.jpg', 14);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
