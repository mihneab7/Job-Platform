-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2022 at 03:11 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplicatii`
--

CREATE TABLE `aplicatii` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT 1,
  `job_id` smallint(6) NOT NULL,
  `candidat_id` smallint(6) DEFAULT NULL,
  `cv_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aplicatii_test`
--

CREATE TABLE `aplicatii_test` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT 1,
  `job_id` smallint(6) NOT NULL,
  `candidat_id` smallint(6) DEFAULT NULL,
  `cv_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aplicatii_test`
--

INSERT INTO `aplicatii_test` (`id`, `data`, `email`, `status`, `job_id`, `candidat_id`, `cv_id`) VALUES
(1, '2022-01-17', 'candidat2@gmail.com', 1, 21, 2, 2),
(2, '2022-01-17', 'candidat1@gmail.com', 1, 11, 1, 4),
(3, '2022-01-17', 'candidat3@gmail.com', 1, 20, 3, 5),
(4, '2022-01-17', 'candidat3@gmail.com', 1, 14, 3, 5),
(5, '2022-01-18', 'aro@aro.ro', 1, 23, NULL, 6),
(6, '2022-01-18', 'asd@asd.ro', 1, 23, NULL, 7),
(7, '2022-01-18', 'candidat1@gmail.com', 1, 3, 1, 4),
(8, '2022-01-18', 'arpagan@yahoo.net', 1, 23, NULL, 8),
(9, '2022-01-19', 'test19jan@yahoo.com', 3, 23, NULL, 9),
(10, '2022-01-21', 'candidat1@gmail.com', 1, 24, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `conturi`
--

CREATE TABLE `conturi` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parola` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rol_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conturi`
--

INSERT INTO `conturi` (`id`, `nume`, `prenume`, `email`, `parola`, `status`, `rol_id`) VALUES
(1, 'Popescu', 'Ion', 'ion.popescu@flanco.ro', 'asd123', 1, 1),
(2, 'Paka', 'Gion', 'gion.paka@flanco.ro', 'parola1', 1, 2),
(3, 'Bulearcă', 'Mihnea-Gabriel', 'mihnea.bulearca@flanco.ro', '123', 1, 2),
(4, 'Tipătescu', 'Traian', 'traian.tipatescu@flanco.ro', '123', 1, 2),
(5, 'Zanidache', 'Zany', 'zanny@flanco.ro', '123', 1, 2),
(6, 'Caragiale', 'Ion-Luca', 'ion.caragiale@flanco.ro', '123', 1, 2),
(7, 'Alien', 'Vilgax', 'vilgax@flanco.ro', 'ben10', 1, 2),
(8, 'Stark', 'Tony', 'tony.stark@flanco.ro', 'ironman', 1, 2),
(9, 'Rogers', 'Steve', 'steve.rogers@flanco.ro', 'amurica', 1, 2),
(10, 'Parker', 'Peter', 'peter.parker@flanco.ro', 'spoderman', 1, 2),
(11, 'Banner', 'Bruce', 'bruce.banner@flanco.ro', 'halc', 1, 2),
(12, 'John', 'Cena', 'john.cena@flanco.ro', 'qwe', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `conturi_candidati`
--

CREATE TABLE `conturi_candidati` (
  `id` smallint(6) NOT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parola` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rol_id` tinyint(4) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conturi_candidati`
--

INSERT INTO `conturi_candidati` (`id`, `nume`, `prenume`, `email`, `parola`, `status`, `rol_id`) VALUES
(1, 'Candidat', 'Numarul 1', 'candidat1@gmail.com', '123', 1, 3),
(2, 'Candidat', 'Numarul 2', 'candidat2@gmail.com', '123', 1, 3),
(3, 'Candidat', 'Numarul 3', 'candidat3@gmail.com', '123', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `conturi_candidati_test`
--

CREATE TABLE `conturi_candidati_test` (
  `id` smallint(6) NOT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parola` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rol_id` tinyint(4) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conturi_candidati_test`
--

INSERT INTO `conturi_candidati_test` (`id`, `nume`, `prenume`, `email`, `parola`, `status`, `rol_id`) VALUES
(1, 'Candidat', 'Numarul 1', 'candidat1@gmail.com', '123', 1, 3),
(2, 'Candidat', 'Numarul 2', 'candidat2@gmail.com', '123', 1, 3),
(3, 'Candidat', 'Numarul 3', 'candidat3@gmail.com', '123', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `conturi_test`
--

CREATE TABLE `conturi_test` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parola` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rol_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conturi_test`
--

INSERT INTO `conturi_test` (`id`, `nume`, `prenume`, `email`, `parola`, `status`, `rol_id`) VALUES
(1, 'Popescu', 'Ion', 'ion.popescu@flanco.ro', 'asd123', 1, 1),
(2, 'Paka', 'Gion', 'gion.paka@flanco.ro', 'parola1', 1, 2),
(3, 'Bulearcă', 'Mihnea-Gabriel', 'mihnea.bulearca@flanco.ro', '123', 1, 2),
(4, 'Tipătescu', 'Traian', 'traian.tipatescu@flanco.ro', '123', 1, 2),
(5, 'Zanidache', 'Zany', 'zanny@flanco.ro', '123', 1, 2),
(6, 'Caragiale', 'Ion-Luca', 'ion.caragiale@flanco.ro', '123', 1, 2),
(7, 'Alien', 'Vilgax', 'vilgax@flanco.ro', 'ben10', 1, 2),
(8, 'Stark', 'Tony', 'tony.stark@flanco.ro', 'ironman', 1, 2),
(9, 'Rogers', 'Steve', 'steve.rogers@flanco.ro', 'amurica', 1, 2),
(10, 'Parker', 'Peter', 'peter.parker@flanco.ro', 'spoderman', 1, 2),
(11, 'Banner', 'Bruce', 'bruce.banner@flanco.ro', 'halc', 1, 2),
(12, 'John', 'Cena', 'john.cena@flanco.ro', 'qwe', 1, 2),
(13, 'Bule', 'Mihnea', 'mihnea.bule@flanco.ro', '123', 1, 1),
(14, 'Andrei', 'Andrei', 'andrei.andrei@flanco.ro', '123', 1, 3),
(15, 'Dobre', 'Adrian', 'adi.dobre@flanco.ro', '123', 1, 2),
(16, 'Dobre', 'Adrian', 'adi.dobre@flanco.ro', '123', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `conturi_test2`
--

CREATE TABLE `conturi_test2` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parola` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rol_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conturi_test2`
--

INSERT INTO `conturi_test2` (`id`, `nume`, `prenume`, `email`, `parola`, `status`, `rol_id`) VALUES
(1, 'Popescu', 'Ion', 'ion.popescu@flanco.ro', 'asd123', 1, 1),
(2, 'Paka', 'Gion', 'gion.paka@flanco.ro', 'parola1', 1, 2),
(3, 'Bulearcă', 'Mihnea-Gabriel', 'mihnea.bulearca@flanco.ro', '123', 1, 2),
(4, 'Tipătescu', 'Traian', 'traian.tipatescu@flanco.ro', '123', 1, 2),
(5, 'Zanidache', 'Zany', 'zanny@flanco.ro', '123', 1, 2),
(6, 'Caragiale', 'Ion-Luca', 'ion.caragiale@flanco.ro', '123', 1, 2),
(7, 'Alien', 'Vilgax', 'vilgax@flanco.ro', 'ben10', 1, 2),
(8, 'Stark', 'Tony', 'tony.stark@flanco.ro', 'ironman', 1, 2),
(9, 'Rogers', 'Steve', 'steve.rogers@flanco.ro', 'amurica', 1, 2),
(10, 'Parker', 'Peter', 'peter.parker@flanco.ro', 'spoderman', 1, 2),
(11, 'Banner', 'Bruce', 'bruce.banner@flanco.ro', 'halc', 1, 2),
(12, 'John', 'Cena', 'john.cena@flanco.ro', 'qwe', 1, 2),
(13, 'Bule', 'Mihnea', 'mihnea.bule@flanco.ro', '123', 1, 1),
(15, 'ContDe', 'Candidat', 'cont.candidat@flanco.ro', '123', 1, 3),
(16, 'ContDe', 'Candidat2', 'cont.candidat2@flanco.ro', '123', 1, 3),
(17, 'ContDe', 'HaserPunct', 'cont.haser@flanco.ro', '123', 1, 2),
(18, 'blabla atentie EdiT', 'altceva frate ce se aude nimic', 'asd@flanco.ro', '123', 1, 3),
(22, 'Test', 'Constante', 'test.constante@flanco.ro', '123', 1, 2),
(23, 'Test Candidat', 'Rol-Constant', 'candi.ct@flanco.ro', '123', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` smallint(6) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `date` date NOT NULL,
  `candidat_id` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cvs_test`
--

CREATE TABLE `cvs_test` (
  `id` smallint(6) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `date` date NOT NULL,
  `candidat_id` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cvs_test`
--

INSERT INTO `cvs_test` (`id`, `path`, `size`, `date`, `candidat_id`) VALUES
(1, 'uploads/CV_test_1.pdf', 30813, '2022-01-17', 1),
(2, 'uploads/CV_test_candi2_2.pdf', 30813, '2022-01-17', 2),
(3, 'uploads/CV_test_second_2.pdf', 30813, '2022-01-17', 2),
(4, 'uploads/CV_test_first_1.pdf', 30813, '2022-01-17', 1),
(5, 'uploads/CV_test_third_3.pdf', 30813, '2022-01-17', 3),
(6, 'uploads/CV_test_unk_null546463pdf', 30813, '2022-01-18', NULL),
(7, 'uploads/CV_test_unk_null190678pdf', 30813, '2022-01-18', NULL),
(8, 'uploads/CV_test_unk_null822723pdf', 30813, '2022-01-18', NULL),
(9, 'uploads/CV_test_19jan_null417030.pdf', 30813, '2022-01-19', NULL),
(10, 'uploads/CV_alt_test_1.pdf', 30672, '2022-01-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `demo_cities`
--

CREATE TABLE `demo_cities` (
  `id` int(11) NOT NULL,
  `state_id` int(12) NOT NULL,
  `name` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo_cities`
--

INSERT INTO `demo_cities` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Surat', '2021-12-17 13:08:42', '0000-00-00 00:00:00'),
(2, 1, 'Rajkot', '2021-12-17 13:08:42', '0000-00-00 00:00:00'),
(3, 1, 'Botad', '2021-12-17 13:08:42', '0000-00-00 00:00:00'),
(4, 2, 'Mumbai', '2021-12-17 13:08:42', '0000-00-00 00:00:00'),
(5, 3, 'Jaypur', '2021-12-17 13:08:42', '0000-00-00 00:00:00'),
(6, 3, 'Udaypur', '2021-12-17 13:08:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `demo_state`
--

CREATE TABLE `demo_state` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo_state`
--

INSERT INTO `demo_state` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gujarat', '2021-12-17 13:06:05', '0000-00-00 00:00:00'),
(2, 'Maharastra', '2021-12-17 13:06:05', '0000-00-00 00:00:00'),
(3, 'Rajasthan', '2021-12-17 13:06:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `joburi`
--

CREATE TABLE `joburi` (
  `id` smallint(6) NOT NULL,
  `titlu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `judet` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oras` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valabilitate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `joburi`
--

INSERT INTO `joburi` (`id`, `titlu`, `descriere`, `judet`, `oras`, `valabilitate`, `status`, `tags`) VALUES
(1, 'Software Developer', 'Cerinte:\r\n- cerinta 1\r\n- cerinta 2\r\n- cerinta 3\r\n\r\nBeneficii:\r\n- beneficiul 1\r\n- beneficiul 2\r\n- beneficiul 3', 'BT', 'Botosani', '2021-12-25', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `joburi_test`
--

CREATE TABLE `joburi_test` (
  `id` smallint(6) NOT NULL,
  `titlu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `judet` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oras` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valabilitate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `joburi_test`
--

INSERT INTO `joburi_test` (`id`, `titlu`, `descriere`, `judet`, `oras`, `valabilitate`, `status`, `tags`) VALUES
(1, 'titlu blabla', 'descriere\r\nbla\r\nbla\r\nbla\r\nbla\r\nbla\r\ndescriere pe live\r\ngesgdfhgw\r\n432432', 'AR', 'Suceava', '2022-03-10', 1, 'good vibes, french'),
(2, 'titlufdsaf', 'descrierea bietii frate aici \n sadiasoipaosfia', 'PH', 'Ploiesti', '2021-12-25', 1, 'descriere, mancare'),
(4, 'Internship PHP', 'What we expect of you in terms of job requirements?\r\n\r\nWe are looking for an enthusiastic developer with some practical experience and the drive to succeed in a demanding and professional team environment.\r\n\r\n● no development experience whatsoever, but the understanding thе technologies and languages which power thе web such as HTML, CSS and JavaScript (a course made, a genuine curiosity or a proven exposure to this kind of technologies).\r\n● strong analytical thinking and a hunger for improvement\r\n\r\n● Bachelor Degree in Computer Science or technical studies.\r\n\r\nAs Our Internship PHP you will:\r\n\r\n● learn and take part in integrate of user-facing elements developed by a front-end developer with server-side logic\r\n\r\n● learn how to build reusable code and libraries for future use\r\n\r\n● take part in developing eCommerce solutions including but not limited to unit testing, code and requirements analysis, performance tuning, improvement, balancing, usability, and automation\r\n\r\nWhat we offer?\r\n\r\nA period of training on the job and induction in the community, in which you will acquire PHP development skills.\r\n\r\nA pleasant and modern work environment, where you will take part in challenging projects.\r\n\r\nThe opportunity to grow both professionally and as a person.\r\n\r\nFixed salary \r\n\r\nWork from Home after the end of the initial training period.\r\n\r\nAt this company, we offer you an environment in which you can grow, you can create, put your ideas into practice and to innovate. The pace of online is really alert these days so you will have the opportunity to be on the wave of changes and daily improvements. You will have the opportunity to learn and work with a variety of technologies and processes, in a growing and trendy industry.\r\n\r\nApply now and let\'s meet!', 'B', 'Bucuresti', '2021-12-31', 1, 'internship, php, viitor'),
(6, 'sdgdfgdaf', 'herqh34hreh\r\n43gre\r\nhqeb\r\n2\r\nqbh5\r\ng45\r\nh65h\r\nj', 'AB', 'Alba Iulia', '2021-12-28', 1, 'mancare, petrecere'),
(7, 'gdsgdfhf', 'dhjjgdhjhgd\r\nj\r\ngdhj\r\ndhg\r\nj\r\nghj\r\ndj\r\nstrjts\r\nu5\r\nehd\r\n', 'AB', 'Alba Iulia', '2021-12-31', 1, 'craciun, sarbatoare'),
(8, 'Titlu', 'Test\r\nTest\r\nTestuletz', 'AB', 'Alba Iulia', '2022-02-04', 1, 'tag1, tag2, tag3'),
(9, 'Test2', 'Test2\r\nfasfa\r\nTest2', 'AB', 'Alba Iulia', '2022-01-26', 1, 'tag1,tag2'),
(10, 'Testul3', '3\r\n3\r\n34241\r\n421', 'AB', 'Alba Iulia', '2022-01-23', 1, 'taguri,tags'),
(11, 'altTest', 'dsopjfksd\r\ngfsdhispofdhi\r\ngsdfgosdfgd\r\ng32542', 'AB', 'Alba Iulia', '2022-01-30', 1, 'tag'),
(14, 'test la ora 5', 'test 5', 'GL', 'Slobozia', '2022-02-05', 1, 'tag asd'),
(15, 'Umplere 1', 'job de umplere\r\nnumarul 1', 'SV', 'Braila', '2022-03-29', 1, 'umplere tag ceva'),
(16, 'Umplere 2', 'job de umplere 2\r\nnumarul doi', 'BV', 'Alexandria', '2022-03-03', 1, 'deodorant tag mancare'),
(19, 'Test constante', 'aici testez rolurile\r\nfolosind constante', 'NT', 'Botosani', '2022-05-25', 1, 'const tag constante constant'),
(20, 'Test adevarat', 'aici chiar testez cand am\r\nrolurile drept constante', 'NT', 'Zalau', '2021-11-12', 1, 'constante tag constant'),
(22, 'Job de final', 'test\r\nalt test\r\naltul', 'CV', 'Ploiesti', '2022-01-30', 1, 'tag1 tag2'),
(23, 'Fnal', 'fdsofisdop\r\nfdsopfis\r\nr032fjoew', 'AB', 'Alba Iulia', '2022-02-03', 1, 'tagul'),
(24, 'live', 'test\r\npe\r\nlive', 'SB', 'Targu Mures', '2022-06-09', 1, 'tag live');

-- --------------------------------------------------------

--
-- Table structure for table `judete`
--

CREATE TABLE `judete` (
  `id` tinyint(4) NOT NULL,
  `nume` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `judete`
--

INSERT INTO `judete` (`id`, `nume`) VALUES
(1, 'Alba'),
(2, 'Arad'),
(3, 'Arges'),
(4, 'Bacau'),
(5, 'Bihor'),
(6, 'Botosani'),
(7, 'Brasov'),
(8, 'Braila'),
(9, 'Bucuresti'),
(10, 'Buzau'),
(11, 'Caras-Severin'),
(12, 'Calarasi'),
(13, 'Cluj'),
(14, 'Constanta'),
(15, 'Covasna'),
(16, 'Dambovita'),
(17, 'Dolj'),
(18, 'Galati'),
(19, 'Giurgiu'),
(20, 'Gorj'),
(21, 'Harghita'),
(22, 'Hunedoara'),
(23, 'Ialomita'),
(24, 'Iasi'),
(25, 'Ilfov'),
(26, 'Maramures'),
(27, 'Mehedinti'),
(28, 'Mures'),
(29, 'Neamt'),
(30, 'Olt'),
(31, 'Prahova'),
(32, 'Satu-Mare'),
(33, 'Salaj'),
(34, 'Sibiu'),
(35, 'Suceava'),
(36, 'Teleorman'),
(37, 'Timis'),
(38, 'Tulcea'),
(39, 'Vaslui'),
(40, 'Valcea'),
(41, 'Vrancea');

-- --------------------------------------------------------

--
-- Table structure for table `localitati`
--

CREATE TABLE `localitati` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judet_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localitati`
--

INSERT INTO `localitati` (`id`, `nume`, `judet_id`) VALUES
(1, 'Alba-Iulia', 1),
(2, 'Aiud', 1),
(3, 'Blaj', 1),
(4, 'Arad', 2),
(5, 'Pecica', 2),
(6, 'Pitesti', 3),
(7, 'Campulung', 3),
(8, 'Curtea-de-Arges', 3),
(15, 'Bacau', 4),
(16, 'Onesti', 4),
(17, 'Mionesti', 4),
(18, 'Oradea', 5),
(19, 'Beius', 5),
(20, 'Marghita', 5),
(21, 'Botosani', 6),
(22, 'Dorohoi', 6),
(23, 'Brasov', 7),
(24, 'Fagaras', 7),
(25, 'Braila', 8),
(26, 'Faurei', 8),
(27, 'Bucuresti', 9),
(28, 'Buzau', 10),
(29, 'Ramnicu-Sarat', 10),
(30, 'Resita', 11),
(31, 'Caransebes', 11),
(32, 'Calarsi', 12),
(33, 'Oltenita', 12),
(34, 'Cluj-Napoca', 13),
(35, 'Turda', 13),
(36, 'Constanta', 14),
(37, 'Cernavoda', 14),
(38, 'Sfantu-Gheorghe', 15),
(39, 'Targu-Secuiesc', 15),
(40, 'Sfantu-Gheorghe', 15),
(41, 'Targu-Secuiesc', 15),
(42, 'Targoviste', 16),
(43, 'Moreni', 16),
(44, 'Craiova', 17),
(45, 'Bailesti', 17),
(46, 'Galati', 18),
(47, 'Tecuci', 18),
(48, 'Giurgiu', 19),
(49, 'Bolintin-Vale', 19),
(50, 'Targu-Jiu', 20),
(51, 'Motru', 20),
(52, 'Miercurea-Ciuc', 21),
(53, 'Odorheiu-Secuiesc', 21),
(54, 'Deva', 22),
(55, 'Hunedoara', 22),
(56, 'Slobozia', 23),
(57, 'Fetesti', 23),
(58, 'Iasi', 24),
(59, 'Pascani', 24),
(60, 'Popest-Leordeni', 25),
(61, 'Otopeni', 25),
(62, 'Baia-Mare', 26),
(63, 'Sighetu-Marmatiei', 26),
(64, 'Drobeta-Turnu-Severin', 27),
(65, 'Orsova', 27),
(66, 'Targu Mures', 28),
(67, 'Reghin', 28),
(68, 'Piatra-Neamt', 29),
(69, 'Roman', 29),
(70, 'Slatina', 30),
(71, 'Caracal', 30),
(72, 'Corabia', 30),
(73, 'Ploiesti', 31),
(74, 'Baicoi', 31),
(75, 'Boldesti-Scaieni', 31),
(76, 'Satu-Mare', 32),
(77, 'Carei', 32),
(78, 'Zalau', 33),
(79, 'Simleu-Silvaniei', 33),
(80, 'Sibiu', 34),
(81, 'Medias', 34),
(82, 'Suceava', 35),
(83, 'Falticeni', 35),
(84, 'Alexandria', 36),
(85, 'Rosiorii-de-Vede', 36),
(86, 'Timisoara', 37),
(87, 'Lugoj', 37),
(88, 'Tulcea', 38),
(89, 'Macin', 38),
(90, 'Vaslui', 39),
(91, 'Barlad', 39),
(92, 'Ramnicu-Valcea', 40),
(93, 'Dragasani', 40),
(94, 'Focsani', 41),
(95, 'Adjud', 41);

-- --------------------------------------------------------

--
-- Table structure for table `roluri`
--

CREATE TABLE `roluri` (
  `id` tinyint(4) NOT NULL,
  `nume` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roluri`
--

INSERT INTO `roluri` (`id`, `nume`) VALUES
(1, 'admin'),
(2, 'hr'),
(3, 'candidat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplicatii`
--
ALTER TABLE `aplicatii`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id_fk` (`job_id`),
  ADD KEY `cv_id_fk` (`cv_id`),
  ADD KEY `candidat_id` (`candidat_id`);

--
-- Indexes for table `aplicatii_test`
--
ALTER TABLE `aplicatii_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id_fk` (`job_id`),
  ADD KEY `cv_id_fk` (`cv_id`),
  ADD KEY `candidat_id` (`candidat_id`);

--
-- Indexes for table `conturi`
--
ALTER TABLE `conturi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id_fk` (`rol_id`);

--
-- Indexes for table `conturi_candidati`
--
ALTER TABLE `conturi_candidati`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conturi_candidati_test`
--
ALTER TABLE `conturi_candidati_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conturi_test`
--
ALTER TABLE `conturi_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id_fk` (`rol_id`);

--
-- Indexes for table `conturi_test2`
--
ALTER TABLE `conturi_test2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id_fk` (`rol_id`);

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidat_id_fk` (`candidat_id`);

--
-- Indexes for table `cvs_test`
--
ALTER TABLE `cvs_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidat_id_fk` (`candidat_id`);

--
-- Indexes for table `joburi`
--
ALTER TABLE `joburi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joburi_test`
--
ALTER TABLE `joburi_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judete`
--
ALTER TABLE `judete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localitati`
--
ALTER TABLE `localitati`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judet_id_fk` (`judet_id`);

--
-- Indexes for table `roluri`
--
ALTER TABLE `roluri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplicatii`
--
ALTER TABLE `aplicatii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aplicatii_test`
--
ALTER TABLE `aplicatii_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conturi`
--
ALTER TABLE `conturi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `conturi_candidati`
--
ALTER TABLE `conturi_candidati`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conturi_candidati_test`
--
ALTER TABLE `conturi_candidati_test`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conturi_test`
--
ALTER TABLE `conturi_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `conturi_test2`
--
ALTER TABLE `conturi_test2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cvs_test`
--
ALTER TABLE `cvs_test`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `joburi`
--
ALTER TABLE `joburi`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `joburi_test`
--
ALTER TABLE `joburi_test`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `judete`
--
ALTER TABLE `judete`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `roluri`
--
ALTER TABLE `roluri`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aplicatii`
--
ALTER TABLE `aplicatii`
  ADD CONSTRAINT `aplicatii_ibfk_1` FOREIGN KEY (`candidat_id`) REFERENCES `conturi_candidati` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cv_id_fk` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_id_fk` FOREIGN KEY (`job_id`) REFERENCES `joburi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conturi`
--
ALTER TABLE `conturi`
  ADD CONSTRAINT `rol_id_fk` FOREIGN KEY (`rol_id`) REFERENCES `roluri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cvs`
--
ALTER TABLE `cvs`
  ADD CONSTRAINT `candidat_id_fk` FOREIGN KEY (`candidat_id`) REFERENCES `conturi_candidati` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `localitati`
--
ALTER TABLE `localitati`
  ADD CONSTRAINT `judet_id_fk` FOREIGN KEY (`judet_id`) REFERENCES `judete` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
