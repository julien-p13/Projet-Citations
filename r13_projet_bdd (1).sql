-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-r13.alwaysdata.net
-- Generation Time: Nov 06, 2025 at 03:41 PM
-- Server version: 10.11.14-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r13_projet_bdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations` (
  `id_citation` int(11) NOT NULL,
  `texte` text NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `auteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citations`
--

INSERT INTO `citations` (`id_citation`, `texte`, `utilisateur_id`, `auteur`) VALUES
(14, 'La vie, c’est comme une bicyclette, il faut avancer pour ne pas perdre l’équilibre.', 1, 'Albert Einstein'),
(15, 'Le courage n’est pas l’absence de peur, mais la capacité de vaincre ce qui fait peur.', 1, 'Nelson Mandela'),
(16, 'L’expérience, c’est le nom que chacun donne à ses erreurs.', 1, 'Oscar Wilde'),
(17, 'Le bonheur n’est pas quelque chose de prêt à l’emploi. Il vient de vos propres actions.', 1, 'Dalaï Lama'),
(18, 'Ils ne savaient pas que c’était impossible, alors ils l’ont fait.', 1, 'Mark Twain');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('utilisateur','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `mot_de_passe`, `role`) VALUES
(1, 'admin', '$2y$10$7xlK747/bhUtHeAerSMEp./X5bA08w1iezDDGNls8qfRlZlwVXOPm', 'admin'),
(11, 'user', '$2y$10$KHf3oUvuDyKTK0J5ljPQAO.dGLWp1Q2V1SLGvSBbvWpCoQAEM8NbS', 'utilisateur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id_citation`),
  ADD KEY `fk_citations_utilisateur1_idx` (`utilisateur_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE `citations`
  MODIFY `id_citation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citations`
--
ALTER TABLE `citations`
  ADD CONSTRAINT `fk_citations_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
