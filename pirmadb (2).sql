-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 10:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pirmadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `komandos`
--

CREATE TABLE `komandos` (
  `Kodas` varchar(255) NOT NULL,
  `Pavadinimas` varchar(255) DEFAULT NULL,
  `Miestas` varchar(255) DEFAULT NULL,
  `Šalis` varchar(255) DEFAULT NULL,
  `Įkurta_nuo` date DEFAULT NULL,
  `Biudžetas` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `komandos`
--

INSERT INTO `komandos` (`Kodas`, `Pavadinimas`, `Miestas`, `Šalis`, `Įkurta_nuo`, `Biudžetas`) VALUES
('0000', 'Žalgiris', 'Kaunas', 'Lietuva', '1944-01-01', '9000000'),
('0001', 'Maccabi Tel Aviv B.C.', 'Tel Avivas', 'Izraelis', '1932-04-02', '12000000'),
('0002', 'BC Barcelona', 'Barcelona', 'Ispanija', '1926-05-04', '21000000'),
('0003', 'Anadolu Efes S.K.', 'Stambulas', 'Turkija', '1976-02-03', '19000000'),
('1003', 'Lietuvos Rytas', 'Vilnius', 'Lietuva', '1955-05-06', '0');

-- --------------------------------------------------------

--
-- Table structure for table `komandos_lygos`
--

CREATE TABLE `komandos_lygos` (
  `fk_Lyga` varchar(255) NOT NULL,
  `fk_Komanda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `komandos_lygos`
--

INSERT INTO `komandos_lygos` (`fk_Lyga`, `fk_Komanda`) VALUES
('Eurolyga', '0000'),
('Eurolyga', '0001'),
('Eurolyga', '0002'),
('Eurolyga', '0003'),
('Lietuvos krepšinio lyga', '0000'),
('Lietuvos krepšinio lyga', '1003');

-- --------------------------------------------------------

--
-- Table structure for table `lygos`
--

CREATE TABLE `lygos` (
  `Pavadinimas` varchar(255) NOT NULL,
  `fk_lygos_tipas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `lygos`
--

INSERT INTO `lygos` (`Pavadinimas`, `fk_lygos_tipas`) VALUES
('Lietuvos krepšinio lyga', 1),
('Eurolyga', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lygos_tipas`
--

CREATE TABLE `lygos_tipas` (
  `id_Lygos_tipas` int(11) NOT NULL,
  `name` char(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `lygos_tipas`
--

INSERT INTO `lygos_tipas` (`id_Lygos_tipas`, `name`) VALUES
(1, 'Atkrintamosios varžybos'),
(2, 'Finalo ketvertas'),
(3, 'Reguliarus sezonas');

-- --------------------------------------------------------

--
-- Table structure for table `pozicija`
--

CREATE TABLE `pozicija` (
  `id_Pozicija` int(11) NOT NULL,
  `name` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `pozicija`
--

INSERT INTO `pozicija` (`id_Pozicija`, `name`) VALUES
(1, 'Įžaidėjas'),
(2, 'Atakuojantis gynėjas'),
(3, 'Lengvasis krašto puolėjas'),
(4, 'Sunkusis krašto puolėjas'),
(5, 'Vidurio puolėjas');

-- --------------------------------------------------------

--
-- Table structure for table `sveikatos_būsena`
--

CREATE TABLE `sveikatos_būsena` (
  `id_Sveikatos_būsena` int(11) NOT NULL,
  `name` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `sveikatos_būsena`
--

INSERT INTO `sveikatos_būsena` (`id_Sveikatos_būsena`, `name`) VALUES
(1, 'Sveikas'),
(2, 'Traumuotas');

-- --------------------------------------------------------

--
-- Table structure for table `teisėjai`
--

CREATE TABLE `teisėjai` (
  `Kodas` varchar(255) NOT NULL,
  `Vardas` varchar(255) DEFAULT NULL,
  `Pavardė` varchar(255) DEFAULT NULL,
  `Telefono_numeris` varchar(255) DEFAULT NULL,
  `Patirtis` int(11) DEFAULT NULL,
  `El_paštas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `teisėjai`
--

INSERT INTO `teisėjai` (`Kodas`, `Vardas`, `Pavardė`, `Telefono_numeris`, `Patirtis`, `El_paštas`) VALUES
('0001', 'Lukas', 'Jasinskas', '86555512', 3, 'lukas.jasinskas@gmail.com'),
('0002', 'Aurimas', 'Kazlauskas', '861150058', 2, 'aurimas.kazlauskas@gmail.com'),
('0003', 'Paulius', 'Jasauskas', '86150096', 3, 'paulius.jasauskas@gmail.com'),
('0004', 'Laurynas', 'Paulauskas', '86100256', 1, 'laurynas.paulauskas@gmail.com'),
('0005', 'Rimantas', 'Jasavicius', '86999547', 1, 'rimantas.jasavicius@gmail.com'),
('0006', 'Arnas', 'Lukauskis', '86545217', 5, 'arnas.lukauskis@gmail.com'),
('0007', 'Antanas', 'Jovaiša', '861950068', 3, 'antanas.jovaisa@gmail.com'),
('0008', 'Paulius', 'Jurgutis', '869523154', 3, 'paulius.jurgutis@gmail.com'),
('0009', 'Antonijus', 'Kaliausias', '86547123', 9, 'antonijus.kaliausias@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `titulai`
--

CREATE TABLE `titulai` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Piniginė_išmoka` int(11) NOT NULL,
  `fk_lyga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `titulai`
--

INSERT INTO `titulai` (`Pavadinimas`, `Piniginė_išmoka`, `fk_lyga`) VALUES
('Eurolygos', 1000000, 'Eurolyga'),
('Karaliaus Mindaugo taurė', 50000, 'Lietuvos krepšinio lyga'),
('LKL ', 200000, 'Lietuvos krepšinio lyga');

-- --------------------------------------------------------

--
-- Table structure for table `treneriai`
--

CREATE TABLE `treneriai` (
  `id` int(11) NOT NULL,
  `Vardas` varchar(255) NOT NULL,
  `Pavardė` varchar(255) NOT NULL,
  `Patirtis` int(11) DEFAULT NULL,
  `Telefono_numeris` varchar(255) DEFAULT NULL,
  `fk_Komanda` varchar(255) NOT NULL,
  `fk_Pareigos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `treneriai`
--

INSERT INTO `treneriai` (`id`, `Vardas`, `Pavardė`, `Patirtis`, `Telefono_numeris`, `fk_Komanda`, `fk_Pareigos`) VALUES
(0, 'Ergin', 'Ataman', 6, '', '0003', 1),
(1, 'Algirdas', 'Janavičius', 5, '861254987', '1003', 4),
(2, 'Šarūnas', 'Jasikevičius', 5, '', '0002', 1),
(3, 'Anton', 'Jonvacius', 6, NULL, '0003', 2),
(4, 'Oded', 'Kattash', 5, '', '0001', 1),
(5, 'Kazys', 'Maskvytis', 6, '+370545687', '0000', 1),
(6, 'Darius', 'Moskoliūnas', 5, '', '0002', 2),
(7, 'Paulius', 'Nojūnas', 6, NULL, '0000', 3),
(8, 'Jagrym', 'Pinau', 2, NULL, '0003', 4),
(9, 'Martynas', 'Pirmūnas', 4, '86214125', '0000', 4),
(10, 'Marius', 'Pupauskas', 3, '+370615248', '1003', 4),
(11, 'Nojus', 'Pupauskas', 9, '+370645268', '1003', 2),
(12, 'Tautvydas', 'Sabonis', 1, '869571234', '0000', 2),
(13, 'Ponium', 'Zinau', 7, NULL, '0003', 3),
(14, 'Linas', 'Ziurovas', 2, NULL, '0002', 4),
(15, 'Giedrius', 'Žibėnas', 7, '86956545', '1003', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trenerio_pareigos`
--

CREATE TABLE `trenerio_pareigos` (
  `id_Trenerio_pareigos` int(11) NOT NULL,
  `name` char(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `trenerio_pareigos`
--

INSERT INTO `trenerio_pareigos` (`id_Trenerio_pareigos`, `name`) VALUES
(1, 'Pagrindinis'),
(2, 'Asistentas'),
(3, 'Fizinio parengimo'),
(4, 'Taktikos');

-- --------------------------------------------------------

--
-- Table structure for table `varžyboms_teisėjauja`
--

CREATE TABLE `varžyboms_teisėjauja` (
  `fk_Varžybos` varchar(255) NOT NULL,
  `fk_Teisėjas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `varžyboms_teisėjauja`
--

INSERT INTO `varžyboms_teisėjauja` (`fk_Varžybos`, `fk_Teisėjas`) VALUES
('EU0001', '0001'),
('EU0001', '0002'),
('EU0001', '0003'),
('EU0002', '0003'),
('EU0002', '0004'),
('EU0002', '0005'),
('LKL0001', '0001'),
('LKL0001', '0002'),
('LKL0001', '0006');

-- --------------------------------------------------------

--
-- Table structure for table `varžybos`
--

CREATE TABLE `varžybos` (
  `Id` varchar(255) NOT NULL,
  `Data` date DEFAULT NULL,
  `Adresas` varchar(255) DEFAULT NULL,
  `fk_Svečias` varchar(255) NOT NULL,
  `fk_Šeimininkas` varchar(255) NOT NULL,
  `fk_Varzybu_tipas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `varžybos`
--

INSERT INTO `varžybos` (`Id`, `Data`, `Adresas`, `fk_Svečias`, `fk_Šeimininkas`, `fk_Varzybu_tipas`) VALUES
('EU0001', '2023-03-01', 'Karaliaus Mindaugo pr. 50, 44334 Kaunas, Lietuva', '0002', '0001', 1),
('EU0002', '2023-03-05', 'Av. de Joan XXIII, s/n, 08028 Barcelona, Spain', '0003', '0002', 1),
('LKL0001', '2023-03-09', 'Karaliaus Mindaugo pr. 50, 44334 Kaunas, Lietuva', '1003', '0000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `varžybų_rezultatas`
--

CREATE TABLE `varžybų_rezultatas` (
  `id_Varžybų_rezultatas` int(11) NOT NULL,
  `name` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `varžybų_rezultatas`
--

INSERT INTO `varžybų_rezultatas` (`id_Varžybų_rezultatas`, `name`) VALUES
(1, 'Pergalė'),
(2, 'Pralaimėjimas');

-- --------------------------------------------------------

--
-- Table structure for table `varžybų_tipas`
--

CREATE TABLE `varžybų_tipas` (
  `id_Varžybų_tipas` int(11) NOT NULL,
  `name` char(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `varžybų_tipas`
--

INSERT INTO `varžybų_tipas` (`id_Varžybų_tipas`, `name`) VALUES
(1, 'Reguliarus sezonas'),
(2, 'Aštunfinalis'),
(3, 'Ketvirtfinalis'),
(4, 'Pusfinalis'),
(5, 'Finalas');

-- --------------------------------------------------------

--
-- Table structure for table `žaidėjai`
--

CREATE TABLE `žaidėjai` (
  `Žaidėjo_Kodas` varchar(255) NOT NULL,
  `Vardas` varchar(255) NOT NULL,
  `Numeris` int(11) NOT NULL,
  `Pavardė` varchar(255) NOT NULL,
  `Ūgis` float DEFAULT NULL,
  `Svoris` float NOT NULL,
  `Gimimo_data` date NOT NULL,
  `Kaina` int(11) NOT NULL,
  `fk_Komanda` varchar(255) NOT NULL,
  `fk_Pozicija` int(11) DEFAULT NULL,
  `fk_Sveikatos_būsena` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `žaidėjai`
--

INSERT INTO `žaidėjai` (`Žaidėjo_Kodas`, `Vardas`, `Numeris`, `Pavardė`, `Ūgis`, `Svoris`, `Gimimo_data`, `Kaina`, `fk_Komanda`, `fk_Pozicija`, `fk_Sveikatos_būsena`) VALUES
('BADAS12', 'Oscar', 12, 'Da Silva', 206, 194.5, '1999-05-09', 535000, '0001', 2, 1),
('BAHIG24', 'Cory', 24, 'Higgins', 196, 196, '1990-11-10', 750000, '0002', 2, 1),
('BAJOK5', 'Rokas', 5, 'Jokūbaitis', 193, 87, '2000-05-06', 720000, '0002', 1, 1),
('BALAP27', 'Nicolas', 27, 'Laprovittola', 192, 79, '1991-04-24', 600000, '0002', 1, 1),
('BAMIR54', 'Nikola', 54, 'Mirotic', 208, 94, '1991-02-03', 2000000, '0002', 4, 1),
('BASAT14', 'Tomas', 14, 'Satoransky', 201, 89, '1992-01-08', 1100000, '0002', 1, 1),
('BAVES1', 'Jan', 1, 'Vesely', 210, 111, '1992-03-05', 1500000, '0002', 5, 1),
('EFEBRY26', 'Elijah', 26, 'Bryant', 196, 84, '1996-09-03', 450000, '0003', 2, 1),
('EFECLY20', 'Will', 20, 'Clyburn', 201, 97, '1993-06-09', 2000000, '0003', 3, 1),
('EFELAR3', 'Shane', 3, 'Larkin', 182, 81, '1992-04-01', 1500000, '0003', 1, 1),
('EFEMIC21', 'Vasilije', 21, 'Micic', 198, 91, '1996-04-08', 2500000, '0003', 1, 1),
('EFEPLE74', 'Tibor', 74, 'Pleiss', 221, 116, '1990-02-05', 750000, '0003', 5, 1),
('EFEZIZ8', 'Ante', 8, 'Zizic', 210, 114, '1997-06-07', 1200000, '0003', 5, 1),
('MACBAL12', 'Wade', 12, 'Baldwin', 193, 86, '1995-04-18', 900000, '0001', 2, 1),
('MACBRO6', 'Lorenzo', 6, 'Brown', 189, 80, '1992-01-05', 1600000, '0001', 1, 1),
('MACHIL78', 'Darrun', 78, 'Hilliard', 198, 87, '1993-12-23', 700000, '0001', 2, 2),
('MACNEB9', 'Josh', 9, 'Nebo', 205, 107, '1998-11-09', 950000, '0001', 5, 1),
('MACPOY63', 'Alex', 63, 'Poythress', 206, 102, '1992-10-09', 800000, '0001', 5, 1),
('RYTBAB3', 'Modestas', 3, 'Babraitis', 193, 84, '1996-08-09', 200000, '1003', 4, 2),
('RYTLEK45', 'Tomas', 45, 'Lekūnas', 198, 100, '1997-08-09', 150000, '1003', 3, 1),
('RYTNORM2', 'Margiris', 2, 'Normantas', 194, 94, '1999-02-08', 250000, '1003', 2, 1),
('RYTRAD7', 'Gytis', 7, 'Radzevičius', 197, 90, '1992-05-05', 100000, '1003', 2, 1),
('RYTULE10', 'Lukas', 10, 'Uleckas', 199, 90, '1998-08-03', 150000, '1003', 3, 1),
('RYTWIL4', 'Jarvis', 4, 'Williamsas', 203, 98, '1997-02-08', 200000, '1003', 4, 1),
('ZABRA0', 'Ignas', 0, 'Brazdeikis', 197, 92, '1999-01-08', 500000, '0000', 2, 1),
('ZABUT12', 'Arnas', 12, 'Butkevičius', 200, 96, '1996-04-09', 400000, '0000', 3, 1),
('ZAEVA1', 'Keenan', 1, 'Evans', 190, 81, '1998-04-05', 750000, '0000', 1, 2),
('ZAHAY26', 'Kevarrius', 26, 'Hayes', 206, 105, '1998-05-06', 400000, '0000', 5, 1),
('ZALEK23', 'Lukas', 23, 'Lekavičius', 180, 81, '1994-03-30', 450000, '0000', 1, 1),
('ZASMIT5', 'Rolands', 5, 'Smits', 207, 115, '1995-04-03', 500000, '0000', 4, 1),
('ZAULA92', 'Edgaras', 92, 'Ulanovas', 200, 96, '1997-03-05', 530000, '0000', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komandos`
--
ALTER TABLE `komandos`
  ADD PRIMARY KEY (`Kodas`);

--
-- Indexes for table `komandos_lygos`
--
ALTER TABLE `komandos_lygos`
  ADD PRIMARY KEY (`fk_Lyga`,`fk_Komanda`),
  ADD KEY `LygaPriklausoKomandai` (`fk_Komanda`);

--
-- Indexes for table `lygos`
--
ALTER TABLE `lygos`
  ADD PRIMARY KEY (`Pavadinimas`),
  ADD KEY `Yra_Tipo` (`fk_lygos_tipas`);

--
-- Indexes for table `lygos_tipas`
--
ALTER TABLE `lygos_tipas`
  ADD PRIMARY KEY (`id_Lygos_tipas`);

--
-- Indexes for table `pozicija`
--
ALTER TABLE `pozicija`
  ADD PRIMARY KEY (`id_Pozicija`);

--
-- Indexes for table `sveikatos_būsena`
--
ALTER TABLE `sveikatos_būsena`
  ADD PRIMARY KEY (`id_Sveikatos_būsena`);

--
-- Indexes for table `teisėjai`
--
ALTER TABLE `teisėjai`
  ADD PRIMARY KEY (`Kodas`);

--
-- Indexes for table `titulai`
--
ALTER TABLE `titulai`
  ADD PRIMARY KEY (`Pavadinimas`,`fk_lyga`),
  ADD KEY `fk_LygosPav` (`fk_lyga`);

--
-- Indexes for table `treneriai`
--
ALTER TABLE `treneriai`
  ADD PRIMARY KEY (`Pavardė`,`Vardas`,`fk_Komanda`),
  ADD KEY `fkc_Pareigos` (`fk_Pareigos`),
  ADD KEY `fkc_KomandaID` (`fk_Komanda`);

--
-- Indexes for table `trenerio_pareigos`
--
ALTER TABLE `trenerio_pareigos`
  ADD PRIMARY KEY (`id_Trenerio_pareigos`);

--
-- Indexes for table `varžyboms_teisėjauja`
--
ALTER TABLE `varžyboms_teisėjauja`
  ADD PRIMARY KEY (`fk_Varžybos`,`fk_Teisėjas`),
  ADD KEY `fkc_Teisėjas` (`fk_Teisėjas`);

--
-- Indexes for table `varžybos`
--
ALTER TABLE `varžybos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Svečias_Žaidžia` (`fk_Svečias`),
  ADD KEY `Šeimininkas_Žaidžia` (`fk_Šeimininkas`),
  ADD KEY `fkc_Varzybu_tipas` (`fk_Varzybu_tipas`);

--
-- Indexes for table `varžybų_rezultatas`
--
ALTER TABLE `varžybų_rezultatas`
  ADD PRIMARY KEY (`id_Varžybų_rezultatas`);

--
-- Indexes for table `varžybų_tipas`
--
ALTER TABLE `varžybų_tipas`
  ADD PRIMARY KEY (`id_Varžybų_tipas`);

--
-- Indexes for table `žaidėjai`
--
ALTER TABLE `žaidėjai`
  ADD PRIMARY KEY (`Žaidėjo_Kodas`) USING BTREE,
  ADD KEY `Yra_Busenos` (`fk_Sveikatos_būsena`),
  ADD KEY `fkc_Pozicija` (`fk_Pozicija`),
  ADD KEY `fkc_KomandosPav` (`fk_Komanda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lygos_tipas`
--
ALTER TABLE `lygos_tipas`
  MODIFY `id_Lygos_tipas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pozicija`
--
ALTER TABLE `pozicija`
  MODIFY `id_Pozicija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sveikatos_būsena`
--
ALTER TABLE `sveikatos_būsena`
  MODIFY `id_Sveikatos_būsena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trenerio_pareigos`
--
ALTER TABLE `trenerio_pareigos`
  MODIFY `id_Trenerio_pareigos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `varžybų_rezultatas`
--
ALTER TABLE `varžybų_rezultatas`
  MODIFY `id_Varžybų_rezultatas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `varžybų_tipas`
--
ALTER TABLE `varžybų_tipas`
  MODIFY `id_Varžybų_tipas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komandos_lygos`
--
ALTER TABLE `komandos_lygos`
  ADD CONSTRAINT `KomandaPriklausoLygai` FOREIGN KEY (`fk_Lyga`) REFERENCES `lygos` (`Pavadinimas`),
  ADD CONSTRAINT `LygaPriklausoKomandai` FOREIGN KEY (`fk_Komanda`) REFERENCES `komandos` (`Kodas`);

--
-- Constraints for table `lygos`
--
ALTER TABLE `lygos`
  ADD CONSTRAINT `Yra_Tipo` FOREIGN KEY (`fk_lygos_tipas`) REFERENCES `lygos_tipas` (`id_Lygos_tipas`);

--
-- Constraints for table `titulai`
--
ALTER TABLE `titulai`
  ADD CONSTRAINT `fk_LygosPav` FOREIGN KEY (`fk_lyga`) REFERENCES `lygos` (`Pavadinimas`);

--
-- Constraints for table `treneriai`
--
ALTER TABLE `treneriai`
  ADD CONSTRAINT `fkc_KomandaID` FOREIGN KEY (`fk_Komanda`) REFERENCES `komandos` (`Kodas`),
  ADD CONSTRAINT `fkc_Pareigos` FOREIGN KEY (`fk_Pareigos`) REFERENCES `trenerio_pareigos` (`id_Trenerio_pareigos`);

--
-- Constraints for table `varžyboms_teisėjauja`
--
ALTER TABLE `varžyboms_teisėjauja`
  ADD CONSTRAINT `fkc_Teisėjas` FOREIGN KEY (`fk_Teisėjas`) REFERENCES `teisėjai` (`Kodas`),
  ADD CONSTRAINT `fkc_varzybuKodas` FOREIGN KEY (`fk_Varžybos`) REFERENCES `varžybos` (`Id`);

--
-- Constraints for table `varžybos`
--
ALTER TABLE `varžybos`
  ADD CONSTRAINT `Svečias_Žaidžia` FOREIGN KEY (`fk_Svečias`) REFERENCES `komandos` (`Kodas`),
  ADD CONSTRAINT `fkc_Varzybu_tipas` FOREIGN KEY (`fk_Varzybu_tipas`) REFERENCES `varžybų_tipas` (`id_Varžybų_tipas`),
  ADD CONSTRAINT `Šeimininkas_Žaidžia` FOREIGN KEY (`fk_Šeimininkas`) REFERENCES `komandos` (`Kodas`);

--
-- Constraints for table `žaidėjai`
--
ALTER TABLE `žaidėjai`
  ADD CONSTRAINT `Yra_Busenos` FOREIGN KEY (`fk_Sveikatos_būsena`) REFERENCES `sveikatos_būsena` (`id_Sveikatos_būsena`),
  ADD CONSTRAINT `fkc_KomandosPav` FOREIGN KEY (`fk_Komanda`) REFERENCES `komandos` (`Kodas`),
  ADD CONSTRAINT `fkc_Pozicija` FOREIGN KEY (`fk_Pozicija`) REFERENCES `pozicija` (`id_Pozicija`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
