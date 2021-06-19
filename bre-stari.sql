-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 11:03 PM
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
-- Database: `bre`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `idAnketa` int(11) NOT NULL,
  `pitanje` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`idAnketa`, `pitanje`) VALUES
(1, 'Da li Vam se sviđa kvalitet majice?');

-- --------------------------------------------------------

--
-- Table structure for table `boje`
--

CREATE TABLE `boje` (
  `idBoja` int(11) NOT NULL,
  `boja` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE `galerija` (
  `idGalerija` int(11) NOT NULL,
  `src` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `alt` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`idGalerija`, `src`, `alt`) VALUES
(1, 'slika1.jpg', 'Bre emocija'),
(2, 'slika2.jpg', 'Vodim te negde'),
(3, 'slika3.jpg', 'Beg iz grada'),
(4, 'slika4.jpg', 'bre'),
(5, 'slika5.jpg', 'bre 2'),
(6, 'slika6.jpg', 'bre 3'),
(7, 'slika7.jpg', 'Voli ga'),
(8, 'slika8.jpg', 'bre 4');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `idKorisnik` int(11) NOT NULL,
  `ime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUloga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnik`, `ime`, `prezime`, `email`, `lozinka`, `datum`, `idUloga`) VALUES
(7, 'Pera', 'Peric', 'pera@gmail.com', 'bf676ed1364b5857fba69b5623c81b64', '2021-03-07 21:05:11', 2),
(8, 'Gordon', 'Freeman', 'gordon@gmail.com', '7a034553a5cdf69f99e47814361b9721', '2021-03-08 17:38:45', 1),
(9, 'Marko', 'Markovic', 'marko@gmail.com', '26c7c9089e23c14396410bbc6675dbdf', '2021-03-09 00:29:36', 1),
(10, 'Zabjelo', 'Stari', 'zabjelo@gmail.com', '5d401481e30a2a4b6fe90300d58dcdf4', '2021-03-09 00:30:29', 2),
(16, 'Carl', 'Johnson', 'carl@gmail.com', '72762cc17009d24ba59beca9d090ba28', '2021-03-09 20:39:05', 2),
(17, 'Tommy', 'Vercetti', 'tommy@gmail.com', 'aeef78208162e12ed9c7f3fb4e6253e5', '2021-03-09 20:39:27', 2),
(19, 'Jovan', 'Jovanovic', 'jova@jovanovic.com', '4e0bad017cd023b8b2ac0103ea9c67c1', '2021-04-19 22:12:46', 2),
(20, 'Dule', 'Dusanovic', 'dule@gmail.com', '860f5e7fa4ed06f386a4c85b4465c083', '2021-04-19 22:17:51', 2),
(21, 'George', 'Lucas', 'george@gmail.com', 'c630878c9717e8fabc0177ff81024b8a', '2021-04-19 22:23:49', 2),
(22, 'Miroslav', 'Miroslavljevic', 'miroslav@gmail.com', '2f461bf3e4d394f3fe7d41f06e111cec', '2021-04-20 09:10:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici_odgovori`
--

CREATE TABLE `korisnici_odgovori` (
  `idKorisnikOdgovori` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `idOdgovor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici_odgovori`
--

INSERT INTO `korisnici_odgovori` (`idKorisnikOdgovori`, `idKorisnik`, `idOdgovor`) VALUES
(1, 7, 1),
(4, 10, 1),
(5, 20, 2),
(7, 21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `navs`
--

CREATE TABLE `navs` (
  `idNav` int(50) NOT NULL,
  `href` varchar(50) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navs`
--

INSERT INTO `navs` (`idNav`, `href`, `naziv`) VALUES
(1, 'index.php', 'Početna'),
(2, 'prodavnica.php', 'Prodavnica'),
(3, 'index.php#work', 'Galerija'),
(4, 'index.php#contact', 'Poruči kartu');

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `idOdgovor` int(11) NOT NULL,
  `odgovor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idAnketa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`idOdgovor`, `odgovor`, `idAnketa`) VALUES
(1, 'Da', 1),
(2, 'Ne', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `idProizvod` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `opis` varchar(150) DEFAULT NULL,
  `idSlika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idProizvod`, `naziv`, `cena`, `opis`, `idSlika`) VALUES
(1, 'Bela majica BRE', '800', 'Bela majica sa crnim natpisom \"BRE\". Odlična za svaku priliku.', 1),
(2, 'Crna majica BRE', '800', 'Crna majica sa belim natpisom \"BRE\". Odlična za svaku priliku. ', 2),
(7, 'Crna majica srce', '1200', NULL, 3),
(8, 'Bela majica srce', '1200', NULL, 4),
(9, 'Kamila bela', '1000', 'Direktno sa bliskog Istoka. Crna majica sa belom kamilom.', 5),
(10, 'Crna kamila', '1000', 'Direktno sa bliskog Istoka. Bela majica crna kamila.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi_velicina`
--

CREATE TABLE `proizvodi_velicina` (
  `idProizvodVelicina` int(11) NOT NULL,
  `idProizvod` int(11) NOT NULL,
  `idVelicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proizvodi_velicina`
--

INSERT INTO `proizvodi_velicina` (`idProizvodVelicina`, `idProizvod`, `idVelicina`) VALUES
(1, 1, 3),
(2, 1, 4),
(6, 2, 4),
(7, 2, 5),
(8, 7, 2),
(4, 8, 3),
(3, 8, 4),
(9, 9, 3),
(5, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `idSlika` int(11) NOT NULL,
  `src` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `alt` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlika`, `src`, `alt`) VALUES
(1, 'bre-bela.jpg', 'Bela majica'),
(2, 'bre-crna.jpg', 'Crna majica'),
(3, 'obicna-crna-crvena.jpg', 'Crna sa crvenim srce'),
(4, 'obicna-crvena.jpg', 'Bela majica sa crvena'),
(5, 'obicna-kamila.jpg', 'Crna majica bela kamila'),
(6, 'obicna-kamila-crna.jpg', 'Bela majica sa crnom kamilom'),
(7, 'obicna-srce-bela.jpg', 'Crna majica belo srce'),
(8, 'polo-bela.jpg', 'Bela bre polo majica'),
(9, 'polo-crna.jpg', 'Crna bre polo majica'),
(10, 'polo-crvena-bela.jpg', 'Bela polo majica crveno srce'),
(11, 'polo-crvena-crna.jpg', 'Crna polo majica crveno srce'),
(12, 'polo-srce-bela.jpg', 'Bela polo majica'),
(13, 'polo-srce-crna,jpg', 'Crna polo majica');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloga` int(50) NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloga`, `naziv`) VALUES
(1, 'admin'),
(2, 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `upload_file_server`
--

CREATE TABLE `upload_file_server` (
  `idUpload` int(11) NOT NULL,
  `name` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idKorisnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_file_server`
--

INSERT INTO `upload_file_server` (`idUpload`, `name`, `size`, `type`, `path`, `idKorisnik`) VALUES
(1, 'ide.jpg', 36146, 'image/jpeg', '../uploads/1619038961-ide.jpg', 7),
(2, 'Boskic.jpg', 73018, 'image/jpeg', '../uploads/1619039677-Boskic.jpg', 7),
(4, 'bugsBunny.png', 375302, 'image/png', '../uploads/1619039873-bugsBunny.png', 7),
(5, 'lebron.jpg', 173066, 'image/jpeg', '../uploads/1619040473-lebron.jpg', 20),
(6, 'jordan.jpg', 135868, 'image/jpeg', '../uploads/1619040503-jordan.jpg', 20),
(8, 'unnamed.png', 77597, 'image/png', '../uploads/1619041092-unnamed.png', 20),
(9, 'unnamed.jpg', 50679, 'image/jpeg', '../uploads/1619041112-unnamed.jpg', 20),
(10, 'bugsBunny.png', 375302, 'image/png', '../uploads/1619124244-bugsBunny.png', 21);

-- --------------------------------------------------------

--
-- Table structure for table `velicina`
--

CREATE TABLE `velicina` (
  `idVelicina` int(11) NOT NULL,
  `velicina` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `velicina`
--

INSERT INTO `velicina` (`idVelicina`, `velicina`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`idAnketa`);

--
-- Indexes for table `boje`
--
ALTER TABLE `boje`
  ADD PRIMARY KEY (`idBoja`);

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`idGalerija`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idUloga` (`idUloga`);

--
-- Indexes for table `korisnici_odgovori`
--
ALTER TABLE `korisnici_odgovori`
  ADD PRIMARY KEY (`idKorisnikOdgovori`),
  ADD KEY `idKorisnik` (`idKorisnik`),
  ADD KEY `idOdgovor` (`idOdgovor`);

--
-- Indexes for table `navs`
--
ALTER TABLE `navs`
  ADD PRIMARY KEY (`idNav`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD PRIMARY KEY (`idOdgovor`),
  ADD KEY `idAnketa` (`idAnketa`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `idSlika` (`idSlika`);

--
-- Indexes for table `proizvodi_velicina`
--
ALTER TABLE `proizvodi_velicina`
  ADD PRIMARY KEY (`idProizvodVelicina`),
  ADD KEY `idProizvod` (`idProizvod`),
  ADD KEY `idVelicina` (`idVelicina`),
  ADD KEY `idProizvod_2` (`idProizvod`,`idVelicina`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`idSlika`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloga`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `upload_file_server`
--
ALTER TABLE `upload_file_server`
  ADD PRIMARY KEY (`idUpload`),
  ADD KEY `idKorisnik` (`idKorisnik`);

--
-- Indexes for table `velicina`
--
ALTER TABLE `velicina`
  ADD PRIMARY KEY (`idVelicina`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `idAnketa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `boje`
--
ALTER TABLE `boje`
  MODIFY `idBoja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
  MODIFY `idGalerija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `idKorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `korisnici_odgovori`
--
ALTER TABLE `korisnici_odgovori`
  MODIFY `idKorisnikOdgovori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `navs`
--
ALTER TABLE `navs`
  MODIFY `idNav` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `idOdgovor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `idProizvod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proizvodi_velicina`
--
ALTER TABLE `proizvodi_velicina`
  MODIFY `idProizvodVelicina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `idSlika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloga` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_file_server`
--
ALTER TABLE `upload_file_server`
  MODIFY `idUpload` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `velicina`
--
ALTER TABLE `velicina`
  MODIFY `idVelicina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`idUloga`) REFERENCES `uloga` (`idUloga`);

--
-- Constraints for table `korisnici_odgovori`
--
ALTER TABLE `korisnici_odgovori`
  ADD CONSTRAINT `korisnici_odgovori_ibfk_1` FOREIGN KEY (`idOdgovor`) REFERENCES `odgovori` (`idOdgovor`),
  ADD CONSTRAINT `korisnici_odgovori_ibfk_2` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`idKorisnik`);

--
-- Constraints for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD CONSTRAINT `odgovori_ibfk_1` FOREIGN KEY (`idAnketa`) REFERENCES `anketa` (`idAnketa`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`idSlika`) REFERENCES `slike` (`idSlika`);

--
-- Constraints for table `proizvodi_velicina`
--
ALTER TABLE `proizvodi_velicina`
  ADD CONSTRAINT `proizvodi_velicina_ibfk_1` FOREIGN KEY (`idVelicina`) REFERENCES `velicina` (`idVelicina`),
  ADD CONSTRAINT `proizvodi_velicina_ibfk_2` FOREIGN KEY (`idProizvod`) REFERENCES `proizvodi` (`idProizvod`);

--
-- Constraints for table `upload_file_server`
--
ALTER TABLE `upload_file_server`
  ADD CONSTRAINT `upload_file_server_ibfk_1` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`idKorisnik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
