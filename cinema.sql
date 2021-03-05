-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 01:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `articole`
--

CREATE TABLE `articole` (
  `id` int(11) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `text` longtext NOT NULL,
  `imagine` varchar(50) NOT NULL,
  `autor` varchar(30) NOT NULL,
  `IP` varchar(50) NOT NULL,
  `vizualizari` int(11) NOT NULL,
  `aprecieri` int(11) NOT NULL,
  `taguri` text NOT NULL,
  `data` datetime NOT NULL,
  `ultima_editare` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comentarii`
--

CREATE TABLE `comentarii` (
  `id` int(11) NOT NULL,
  `id_articol` int(11) NOT NULL,
  `id_utilizator` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `parinte` int(11) DEFAULT NULL,
  `data` datetime NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filme`
--

CREATE TABLE `filme` (
  `id` int(11) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `regia` varchar(100) NOT NULL,
  `gen` varchar(100) NOT NULL,
  `descriere` text NOT NULL,
  `url_trailer` varchar(150) NOT NULL,
  `url_imagine` varchar(150) NOT NULL,
  `pret` int(11) NOT NULL,
  `premiera` int(11) NOT NULL DEFAULT 0,
  `inceput` datetime NOT NULL,
  `sfarsit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filme`
--

INSERT INTO `filme` (`id`, `titlu`, `regia`, `gen`, `descriere`, `url_trailer`, `url_imagine`, `pret`, `premiera`, `inceput`, `sfarsit`) VALUES
(4, 'Film de miercuri', '', '', '', '', '', 15, 0, '2021-03-03 07:15:00', '2021-03-03 08:45:00'),
(5, 'Film de joi', '', '', '', '', '', 10, 0, '2021-03-04 08:45:00', '2021-03-04 10:30:00'),
(6, 'Film de vineri', '', '', '', '', '', 19, 0, '2021-03-05 08:00:00', '2021-03-05 09:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `notificari`
--

CREATE TABLE `notificari` (
  `id` int(11) NOT NULL,
  `id_utilizator` int(11) NOT NULL,
  `text` text NOT NULL,
  `culoare` varchar(15) NOT NULL,
  `data` int(11) NOT NULL,
  `vazut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notite`
--

CREATE TABLE `notite` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `stare` tinyint(1) NOT NULL DEFAULT 0,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rezervari`
--

CREATE TABLE `rezervari` (
  `id` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `locuri` varchar(100) NOT NULL,
  `pret` int(11) NOT NULL,
  `data_rezervare` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setari`
--

CREATE TABLE `setari` (
  `url` varchar(100) NOT NULL,
  `titlu` varchar(100) DEFAULT '''NULL''',
  `descriere` text DEFAULT NULL,
  `cuvinte_cheie` text DEFAULT NULL,
  `adresa` varchar(100) DEFAULT '''NULL''',
  `telefon` varchar(15) DEFAULT '''NULL''',
  `email` varchar(50) DEFAULT '''NULL''',
  `pagina_fb` varchar(100) DEFAULT 'NULL',
  `cuvinte_obscene` text DEFAULT NULL,
  `logare` tinyint(1) NOT NULL DEFAULT 1,
  `inregistrare` tinyint(1) NOT NULL DEFAULT 1,
  `comentare` tinyint(1) NOT NULL DEFAULT 1,
  `mentenanta` tinyint(1) NOT NULL DEFAULT 0,
  `rezervare` tinyint(1) NOT NULL DEFAULT 1,
  `articole` varchar(350) NOT NULL DEFAULT '''{ "afisare":[ { "afisare_articole":1, "afisare_vizualizari":1, "afisare_aprecieri":1, "afisare_autor":1, "afisare_data":1, "afisare_comentarii":1, "afisare_categorii":1, "afisare_taguri":1, "afisare_postari":1, "afisare_search":1 } ], "permitere":[ { "permitere_aprecieri":1, "permitere_comentarii":1 } ]}'''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setari`
--

INSERT INTO `setari` (`url`, `titlu`, `descriere`, `cuvinte_cheie`, `adresa`, `telefon`, `email`, `pagina_fb`, `cuvinte_obscene`, `logare`, `inregistrare`, `comentare`, `mentenanta`, `rezervare`, `articole`) VALUES
('http://localhost/cinema/', 'Cinema Melodia', 'Cinema Melodia iti pune la dispozitie un program complet al filmelor, iti poti face rezervari online si ai informatii despre cele mai noi filme.', 'cinema, cinema melodia, cinema dorohoi, filme 2020, filme noi, film, filme, program cinema, premiere cinema, trailere filme, dorohoi', 'Strada Alexandru Ioan Cuza 27, Dorohoi 715200', '0744266999', 'contact@cinema-melodia.ro', 'https://www.facebook.com/cinemamelodia/', 'cuvant1,cuvant3,cuvant5,cuvant2,cuvant4,cuvant4', 1, 1, 1, 0, 1, '{\"afisare\": [{\"afisare_data\": 1, \"afisare_autor\": 1, \"afisare_search\": 0, \"afisare_taguri\": 0, \"afisare_postari\": 0, \"afisare_articole\": 1, \"afisare_aprecieri\": 0, \"afisare_categorii\": 1, \"afisare_comentarii\": 1, \"afisare_vizualizari\": 0}], \"permitere\": [{\"permitere_aprecieri\": 0, \"permitere_comentarii\": 1}]}');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `nume` varchar(40) NOT NULL,
  `prenume` varchar(40) NOT NULL,
  `telefon` varchar(10) NOT NULL,
  `email` varchar(45) NOT NULL,
  `parola` varchar(30) NOT NULL,
  `data_inregistrare` datetime NOT NULL,
  `regIP` varchar(50) NOT NULL,
  `logIP` varchar(500) NOT NULL DEFAULT '[]',
  `ultima_logare` datetime DEFAULT NULL,
  `user_agent_initial` text NOT NULL,
  `user_agent` text NOT NULL,
  `activ` int(11) NOT NULL DEFAULT 0,
  `cod_activare` varchar(100) NOT NULL DEFAULT 'inactiv',
  `cod_resetare` varchar(100) DEFAULT NULL,
  `nrResetari` int(11) NOT NULL DEFAULT 0,
  `acces` int(11) NOT NULL DEFAULT 0,
  `nrRezervari` int(11) NOT NULL DEFAULT 0,
  `ultimele_filmeRez` varchar(500) DEFAULT '[]',
  `puncte` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `nume`, `prenume`, `telefon`, `email`, `parola`, `data_inregistrare`, `regIP`, `logIP`, `ultima_logare`, `user_agent_initial`, `user_agent`, `activ`, `cod_activare`, `cod_resetare`, `nrResetari`, `acces`, `nrRezervari`, `ultimele_filmeRez`, `puncte`) VALUES
(32, 'Cinema', 'Cinema', '', 'admin@admin.admin', 'admin', '0000-00-00 00:00:00', '', '[\"::1\",\"86.122.6.82\",\"86.122.115.20\",\"81.196.229.217\"]', NULL, '', '', 1, '', NULL, 0, 1, 0, '\'[]\'', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articole`
--
ALTER TABLE `articole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentarii`
--
ALTER TABLE `comentarii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificari`
--
ALTER TABLE `notificari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervari`
--
ALTER TABLE `rezervari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articole`
--
ALTER TABLE `articole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comentarii`
--
ALTER TABLE `comentarii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notificari`
--
ALTER TABLE `notificari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rezervari`
--
ALTER TABLE `rezervari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
