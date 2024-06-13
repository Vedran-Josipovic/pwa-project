-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 13, 2024 at 10:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt_pwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanci`
--

CREATE TABLE `clanci` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `naslov` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `sazetak` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `tekst` text CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `slika` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `kategorija` varchar(64) CHARACTER SET latin2 COLLATE latin2_croatian_ci NOT NULL,
  `arhiva` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clanci`
--

INSERT INTO `clanci` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '13-06-2024', 'rdr2', 'Cowboy igrica', 'Arthur Morgan, John Marston', 'dutch.jpg', 'Igrice', 1),
(2, '13-06-2024', 'Witcher 3', 'Gelato de Riviera', 'Gwent.\r\nCiri.\r\nGwent.', '666b20548a127_witcher.jpg', 'Igrice', 1),
(3, '13-06-2024', 'Overwatch', 'Moira', '5v5', '666b208fbf791_overwatch.jpg', 'Igrice', 1),
(4, '13-06-2024', 'Cities Skylines', 'Gradovi', 'Gradim grad. Proširujem Branimirovu.', '666b21785422c_skylines.jpg', 'Igrice', 1),
(5, '13-06-2024', 'Knjiga o zagrebu', 'wbfdcjhsbcjds', 'Gradi se', '666b219b8fa0d_skylines.jpg', 'Knjige', 1),
(6, '13-06-2024', 'Harry Potter', 'Harry Potter', 'Harry Potter', '666b21c937d2a_harry-potter.jpg', 'Knjige', 0),
(7, '13-06-2024', 'THE LORD OF THE RINGS', 'Gospodar prstenova', 'Novi zeland', '666b221be7e22_lotr.jpg', 'Knjige', 1),
(8, '13-06-2024', 'Uncharted 4', 'Nathan Drake', 'A thiefs end', '666b2be537d73_uncharted.jpg', 'Igrice', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(32) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Vedran', 'Josipovic', 'admin', '$2y$10$gcfcNKlrWwta5UOT5lF65.gQO7WhJkYhh2k89WtiUYUJIxe/E8B.6', 1),
(2, 'user', 'name', 'a', '$2y$10$vxdRgPGbPU3FHYJNJbeMp.232InMnYiiyhRAsEQmcA3lKYld.avcu', 0),
(3, 'b', 'b', 'b', '$2y$10$QpWT5r1CR57g7Xsyn.gHB.VVDneLMU4.Brfud29niitHAAdR/Jg/q', 0),
(4, 'c', 'c', 'c', '$2y$10$erkqHSRQAPTn0t2DnG0qg.fDHRwmkLFJpdVx.EYBA7W.bInLK2esO', 0),
(5, 'd', 'd', 'd', '$2y$10$hJ4eHATCTXAG4naapd2wo.AYRxdg4ViZcsSERqkzh9K5ms4hG5OVW', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanci`
--
ALTER TABLE `clanci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clanci`
--
ALTER TABLE `clanci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
