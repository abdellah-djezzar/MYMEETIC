-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 29 Septembre 2018 à 13:05
-- Version du serveur :  5.7.23-0ubuntu0.16.04.1
-- Version de PHP :  7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `meestycall`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `city`, `email`, `birthdate`, `sexe`, `password`, `pseudo`, `active`) VALUES
(18, 'TEST', 'TEST', 'Paris', 'test@gmail.com', '1999-10-10', 'F', 'aea423da5bf2790005aedd95aa676170e270f0778d0b43c644a97108bbaa101d', 'TEST', 1),
(19, 'TESTO', 'TESTO', 'Lyon', 'testo@gmail.com', '1999-10-10', 'F', '4685d8a31fa26af09c604e40783d616069c6ec9ea2da3d580c45ad9c31ac64a7', 'TESTO', 1),
(21, 'TESTA', 'TESTA', 'Paris', 'testa@gmail.com', '1999-10-10', 'H', 'd13f1fd4bb40e043d4e9100b7e70bcc8f3bbb4aeb61998f0cc08306be3701352', 'TESTA', 1),
(22, 'Jenger', 'Emerick', 'Paris', 'emerick.jenger@gmail.com', '1999-10-10', 'H', 'cba5975b366a30cd0aaa312c2172da0e6eb732db74b161fb9ae71f9a4a5654c6', 'JENGER', 1),
(24, 'BO', 'Leo', 'Lyon', 'leo@g.com', '1998-10-10', 'H', '3fbadfc58fd8383c5ed63a8123f4025bcd89b5ad74ccbefa148afa7665e3d872', 'LeoSSSSSSsssssssss', 1),
(25, 'Lou', 'Lou', 'Marseille', 'lou@gmail.com', '1999-10-10', 'F', 'b70557793dab2a9feabd7f3953efda58a6dd62a083cf09398ad9617188dcf642', 'Lou', 1),
(26, 'Amanda', 'Amanda', 'Lyon', 'amanda@gmail.com', '1992-10-10', 'F', 'ec09b16c2637d9a22137629910a2081d32243b60db4513a0b6ccff0cce1130f7', 'Amanda69', 1),
(27, 'AUBERT', 'Patrick', 'Marseille', 'aubert@g.com', '1960-01-10', 'H', 'd2040c60dc46574665e9caaa5bb42cb266c15fdac105d348c5e7ce6058db3b4f', 'Aubert', 1),
(28, 'berthierr', 'josepfr', 'Lyon', 'jojo@hotmail.fr', '1973-08-01', 'A', 'bd4b0185dfafa1c106e145994b3977b86360707633952416241027f7c674e1ee', 'jojolaflutee', 1),
(29, 'tagada', 'tagada', 'Marseille', 'tagada@gmail.com', '1985-01-01', 'A', '038e404f3ef0d0a409e7180fc319e2f3ecc5c3bd9eaa980a2d313d22e887b13f', 'tagadaaaa', 1),
(31, 'ida', 'ida', 'Lyon', 'ida@g.com', '1990-10-10', 'F', '1a3294bf6468f6a131dbe85318ae974f19b765da7758c882002df97b755ebd23', 'ida', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
