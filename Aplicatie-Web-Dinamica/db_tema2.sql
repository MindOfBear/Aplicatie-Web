-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 05, 2023 la 08:21 PM
-- Versiune server: 10.4.28-MariaDB
-- Versiune PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `db_tema2`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$bh8DRaDdnqccoE5SJgtI.OSpcmPda.opdY8TaVx4toSjK4P77tRs6');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `nume` varchar(256) NOT NULL,
  `tip` varchar(256) NOT NULL,
  `descriere` varchar(512) NOT NULL,
  `poza` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `members`
--

INSERT INTO `members` (`id`, `nume`, `tip`, `descriere`, `poza`) VALUES
(13, 'Romeo Ioan', 'Actor', 'Tranio în Îmblânzirea scorpiei după Shakespeare, regia Radu Iacoban', 'Romeo-Ioan'),
(14, 'Alina Ilea', 'Regizor', 'Mademoiselle Pretiosi în Școala femeilor versus Școala bărbaților, după Molière, regia și coregrafia Gigi Căciuleanu', 'Alina-Ilea'),
(15, 'Bogdan Spiridon', 'Actor', ' Despre dragoste, cu Dragoste regia Ada Lupu Hausvater', 'Bogdan-Spiridon'),
(16, 'Nicolaescu Ovidiu', 'Scenograf', 'Probabil cel mai bun scenograf din Romania sau, de ce nu, din toata Europa!', 'poza1'),
(17, 'Marian Cernea', 'Backstage', 'Cel mai prost jucator de forntnite si rocket league', 'mariandox');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `noutati`
--

CREATE TABLE `noutati` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `descriere` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `noutati`
--

INSERT INTO `noutati` (`id`, `data`, `descriere`) VALUES
(33, '2023-05-02', 'Acesta este un exemplu de anunt unde trebuie sa scriu putin mai mult pentru a se vedea ok ce se intampla cu paragraful'),
(34, '2023-05-02', 'Probabil cel mai bun scenograf din Romania sau, de ce nu, din toata Europa!'),
(35, '2023-05-02', 'Mademoiselle Pretiosi în Școala femeilor versus Școala bărbaților, după Molière, regia și coregrafia Gigi Căciuleanu'),
(36, '2023-05-02', 'ial br cr hau'),
(37, '2023-05-02', 'adwawdawdawd'),
(38, '2023-05-02', 'awdawdawd'),
(39, '2023-05-02', 'aaaaaaaaaa'),
(40, '2023-05-02', 'awdawdawdawdawd'),
(41, '2023-05-02', 'aaaaaaaaaadddddddddddd');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `piesa`
--

CREATE TABLE `piesa` (
  `id` int(11) NOT NULL,
  `id_repertoriu` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `piesa`
--

INSERT INTO `piesa` (`id`, `id_repertoriu`, `nume`) VALUES
(11, 9, 'Dorel Stie'),
(12, 9, 'PiesaTest'),
(13, 10, '123123'),
(14, 10, 'wdadaw');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `id_piesa` int(11) NOT NULL,
  `id_repertoriu` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `program`
--

INSERT INTO `program` (`id`, `id_piesa`, `id_repertoriu`, `data`, `ora`) VALUES
(11, 12, 9, '2023-05-02', '23:03:00'),
(12, 11, 9, '2023-05-09', '22:02:00'),
(13, 12, 9, '2023-05-16', '11:59:00'),
(14, 14, 10, '2023-05-03', '01:03:00'),
(15, 11, 9, '2023-05-02', '11:09:00');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `repertoriu`
--

CREATE TABLE `repertoriu` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `repertoriu`
--

INSERT INTO `repertoriu` (`id`, `nume`) VALUES
(7, 'awd'),
(8, 'awd'),
(9, 'TESTEZ'),
(10, 'Dorel Adauga Repertoriu lung'),
(11, 'Altceva domne Altceva');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `noutati`
--
ALTER TABLE `noutati`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `piesa`
--
ALTER TABLE `piesa`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piesaProgram` (`id_piesa`),
  ADD KEY `repertoriuProgram` (`id_repertoriu`);

--
-- Indexuri pentru tabele `repertoriu`
--
ALTER TABLE `repertoriu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pentru tabele `noutati`
--
ALTER TABLE `noutati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pentru tabele `piesa`
--
ALTER TABLE `piesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pentru tabele `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pentru tabele `repertoriu`
--
ALTER TABLE `repertoriu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `piesaProgram` FOREIGN KEY (`id_piesa`) REFERENCES `piesa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `repertoriuProgram` FOREIGN KEY (`id_repertoriu`) REFERENCES `repertoriu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
