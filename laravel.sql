-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 11:27 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE DATABASE laravel;
USE laravel;

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `login` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(512) NOT NULL,
  `salt` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `login`, `email`, `password`, `salt`) VALUES
(1, 'hlep', 'heniek@bruh.y', '6a1a778143e4672886991729035807cabeb75ad42a3fe4bf580cfbdf5cea7c476705d878af5f0fd0dc07d19f2959e224b21788e561f046177f6752b4bcc59e2c', '12');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `level` int(3) NOT NULL,
  `cost_brick` int(10) NOT NULL,
  `cost_wood` int(10) NOT NULL,
  `build_time` time(6) NOT NULL,
  `points` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `level`, `cost_brick`, `cost_wood`, `build_time`, `points`) VALUES
(1, 'ratusz', 2, 100, 100, '00:01:00.000000', 100),
(2, 'ratusz', 3, 200, 200, '00:02:00.000000', 200),
(3, 'ratusz', 4, 400, 400, '00:40:00.000000', 500),
(4, 'ratusz', 5, 1600, 1600, '01:30:00.000000', 1500),
(5, 'tartak', 2, 100, 100, '00:01:00.000000', 100),
(6, 'tartak', 3, 200, 200, '00:03:00.000000', 150),
(7, 'tartak', 4, 300, 300, '00:05:00.000000', 200),
(8, 'tartak', 5, 400, 400, '00:12:00.000000', 400),
(9, 'huta', 2, 100, 100, '00:01:00.000000', 100),
(10, 'huta', 3, 100, 100, '00:03:00.000000', 150),
(11, 'huta', 4, 200, 200, '00:05:00.000000', 200),
(12, 'huta', 5, 300, 300, '00:12:00.000000', 400),
(13, 'cegielnia', 2, 100, 100, '00:01:00.000000', 100),
(14, 'cegielnia', 3, 200, 200, '00:03:00.000000', 150),
(15, 'cegielnia', 4, 300, 300, '00:05:00.000000', 200),
(16, 'cegielnia', 5, 400, 400, '00:12:00.000000', 400),
(17, 'koszary', 1, 300, 300, '00:30:00.000000', 300),
(18, 'koszary', 2, 500, 500, '00:30:00.000000', 300),
(19, 'koszary', 3, 1000, 1000, '01:00:00.000000', 1000),
(20, 'koszary', 4, 1500, 1500, '01:30:00.000000', 1300),
(21, 'pałac', 1, 2000, 2000, '02:00:00.000000', 2000),
(22, 'pałac', 2, 5000, 5000, '03:00:00.000000', 5000),
(23, 'pałac', 3, 10000, 10000, '04:00:00.000000', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `build_queue`
--

CREATE TABLE `build_queue` (
  `id_village` int(10) NOT NULL,
  `seq_number` int(10) NOT NULL,
  `id_building` int(10) NOT NULL,
  `started` datetime NOT NULL,
  `completed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guilds`
--

CREATE TABLE `guilds` (
  `id` int(10) NOT NULL,
  `id_leader` int(10) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guilds_diplomacy`
--

CREATE TABLE `guilds_diplomacy` (
  `id1` int(10) NOT NULL,
  `id2` int(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `id_inviting` int(10) NOT NULL,
  `id_invited` int(10) NOT NULL,
  `time` datetime NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invitation_status`
--

CREATE TABLE `invitation_status` (
  `id` int(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `subject` varchar(55) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_from` int(10) NOT NULL,
  `id_to` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `content`) VALUES
(1, '2020-09-23', 'Dodano autoinkrementację tabeli \'news\'. '),
(2, '2020-09-23', 'Dodano poprawne wyświetlanie ostatnich aktualności. '),
(3, '2020-12-16', 'Wykonano większość funkcjonalności.');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(10) NOT NULL,
  `login` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(512) NOT NULL,
  `points` int(10) NOT NULL,
  `id_guild` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `login`, `email`, `password`, `points`, `id_guild`) VALUES
(1, 'heniwk', 'bartosz_bochenski@gmail.com', '25b71c5cbece9c7d61d758cc27b592e5700e2a0fb7f13e4fd8daed9b33cf98f5d8f1d6701c0a0098fe548d8fe1d506f8969595974e7e9b69bc0f65a9522305d0', 1, NULL),
(3, 'maciej', 'maciejsojka@gmail.com', '554ce39b28175c6287dbaf9f8cb75b3a282eb5e918c40c21f844542fbced7d67e3933b56b9ec2b00837232342fc20122d2d966ecf30c5fd86634346c87250cf9', 17, NULL),
(8, 'zb', 'zbignie@w.pl', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0, NULL),
(9, 'helga15', 'helga@gmail.pl', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0, NULL),
(10, 'jan', 'janus@o2.pl', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) NOT NULL,
  `type` varchar(55) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_source` int(10) NOT NULL,
  `id_target` int(10) NOT NULL,
  `sent` datetime NOT NULL,
  `arrival` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `cost_steel` int(10) NOT NULL,
  `cost_wood` int(10) NOT NULL,
  `recruit_time` time(6) NOT NULL,
  `attack` int(10) NOT NULL,
  `defense` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `cost_steel`, `cost_wood`, `recruit_time`, `attack`, `defense`) VALUES
(1, 'pikinier', 50, 50, '00:10:00.000000', 50, 50),
(2, 'miecznik', 100, 50, '00:15:00.000000', 40, 120),
(3, 'topornik', 50, 100, '00:15:00.000000', 100, 60),
(4, 'rycerz', 200, 200, '00:30:00.000000', 160, 160),
(5, 'osadnik', 2000, 2000, '02:00:00.000000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_queue`
--

CREATE TABLE `unit_queue` (
  `id_village` int(10) NOT NULL,
  `seq_number` int(10) NOT NULL,
  `id_unit` int(10) NOT NULL,
  `number` int(10) NOT NULL,
  `started` datetime NOT NULL,
  `completed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` int(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `x_coordinate` int(10) NOT NULL,
  `y_coordinate` int(10) NOT NULL,
  `points` int(10) NOT NULL,
  `id_player` int(10) DEFAULT NULL,
  `steel` int(10) NOT NULL,
  `wood` int(10) NOT NULL,
  `brick` int(10) NOT NULL,
  `last_collected` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `name`, `x_coordinate`, `y_coordinate`, `points`, `id_player`, `steel`, `wood`, `brick`, `last_collected`) VALUES
(13, 'wioska 1 gracza zb', 1, 15, 0, 8, 0, 0, 0, '2020-12-14 07:16:43'),
(14, 'wioska 1 gracza helga15', 1, 14, 0, 9, 0, 0, 0, '2020-12-14 07:27:39'),
(16, 'wioska 1 gracza jan', 2, 15, 0, 10, 0, 0, 0, '2020-12-14 07:53:19'),
(17, 'wioska 2 gracza helga15', 31, 22, 0, 9, 0, 0, 0, '2020-12-14 08:13:07'),
(18, 'wioska 3 gracza helga15', 18, 15, 0, 9, 0, 0, 0, '2020-12-14 10:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `village_buildings`
--

CREATE TABLE `village_buildings` (
  `id_building` int(10) NOT NULL,
  `level` int(3) DEFAULT NULL,
  `id_village` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `village_buildings`
--

INSERT INTO `village_buildings` (`id_building`, `level`, `id_village`) VALUES
(1, 1, 13),
(1, 1, 14),
(1, 1, 16),
(1, 1, 17),
(1, 1, 18),
(5, 1, 13),
(5, 1, 14),
(5, 1, 16),
(5, 1, 17),
(5, 1, 18),
(9, 1, 13),
(9, 1, 14),
(9, 1, 16),
(9, 1, 17),
(9, 1, 18),
(13, 1, 13),
(13, 1, 14),
(13, 1, 16),
(13, 1, 17),
(13, 1, 18),
(17, 1, 13),
(17, 1, 14),
(17, 1, 16),
(17, 1, 17),
(17, 1, 18),
(21, 1, 13),
(21, 1, 14),
(21, 1, 16),
(21, 1, 17),
(21, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `village_units`
--

CREATE TABLE `village_units` (
  `id_unit` int(10) NOT NULL,
  `number` int(10) DEFAULT NULL,
  `available` int(10) DEFAULT NULL,
  `id_village` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `village_units`
--

INSERT INTO `village_units` (`id_unit`, `number`, `available`, `id_village`) VALUES
(1, 1, 0, 13),
(1, 0, 0, 14),
(1, 0, 0, 16),
(1, 0, 0, 17),
(1, 0, 0, 18),
(2, 0, 0, 13),
(2, 29310, 0, 14),
(2, 0, 0, 16),
(2, 0, 0, 17),
(2, 0, 0, 18),
(3, 0, 0, 13),
(3, 0, 0, 14),
(3, 0, 0, 16),
(3, 0, 0, 17),
(3, 0, 0, 18),
(4, 0, 0, 13),
(4, 0, 0, 14),
(4, 0, 0, 16),
(4, 0, 0, 17),
(4, 0, 0, 18),
(5, 0, 0, 13),
(5, 0, 0, 14),
(5, 1, 0, 16),
(5, 0, 0, 17),
(5, 0, 0, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `build_queue`
--
ALTER TABLE `build_queue`
  ADD UNIQUE KEY `id_village` (`id_village`),
  ADD UNIQUE KEY `id_building` (`id_building`);

--
-- Indexes for table `guilds`
--
ALTER TABLE `guilds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `LEADER` (`id_leader`);

--
-- Indexes for table `guilds_diplomacy`
--
ALTER TABLE `guilds_diplomacy`
  ADD PRIMARY KEY (`id1`,`id2`),
  ADD KEY `FOREIGN` (`id1`,`id2`) USING BTREE,
  ADD KEY `2` (`id2`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_inviting` (`id_inviting`),
  ADD UNIQUE KEY `id_invited` (`id_invited`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indexes for table `invitation_status`
--
ALTER TABLE `invitation_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_from` (`id_from`),
  ADD KEY `id_to` (`id_to`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_guild` (`id_guild`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_source` (`id_source`),
  ADD KEY `id_target` (`id_target`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_queue`
--
ALTER TABLE `unit_queue`
  ADD UNIQUE KEY `id_village` (`id_village`),
  ADD UNIQUE KEY `id_unit` (`id_unit`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PLAYER` (`id_player`);

--
-- Indexes for table `village_buildings`
--
ALTER TABLE `village_buildings`
  ADD PRIMARY KEY (`id_building`,`id_village`),
  ADD KEY `VILLAGE` (`id_village`);

--
-- Indexes for table `village_units`
--
ALTER TABLE `village_units`
  ADD PRIMARY KEY (`id_unit`,`id_village`),
  ADD KEY `VLLG` (`id_village`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `guilds`
--
ALTER TABLE `guilds`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitation_status`
--
ALTER TABLE `invitation_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `build_queue`
--
ALTER TABLE `build_queue`
  ADD CONSTRAINT `B` FOREIGN KEY (`id_building`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `V` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);

--
-- Constraints for table `guilds`
--
ALTER TABLE `guilds`
  ADD CONSTRAINT `LEADER` FOREIGN KEY (`id_leader`) REFERENCES `players` (`id`);

--
-- Constraints for table `guilds_diplomacy`
--
ALTER TABLE `guilds_diplomacy`
  ADD CONSTRAINT `1` FOREIGN KEY (`id1`) REFERENCES `guilds` (`id`),
  ADD CONSTRAINT `2` FOREIGN KEY (`id2`) REFERENCES `guilds` (`id`);

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `INVITED` FOREIGN KEY (`id_invited`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `INVITING` FOREIGN KEY (`id_inviting`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `STATUS` FOREIGN KEY (`status`) REFERENCES `players` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FROM` FOREIGN KEY (`id_from`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `TO` FOREIGN KEY (`id_to`) REFERENCES `players` (`id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `G` FOREIGN KEY (`id_guild`) REFERENCES `guilds` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `SOURCE` FOREIGN KEY (`id_source`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `TARGET` FOREIGN KEY (`id_target`) REFERENCES `players` (`id`);

--
-- Constraints for table `unit_queue`
--
ALTER TABLE `unit_queue`
  ADD CONSTRAINT `UNIT` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `VLG` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);

--
-- Constraints for table `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `PLAYER` FOREIGN KEY (`id_player`) REFERENCES `players` (`id`);

--
-- Constraints for table `village_buildings`
--
ALTER TABLE `village_buildings`
  ADD CONSTRAINT `BUILDING` FOREIGN KEY (`id_building`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `VILLAGE` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);

--
-- Constraints for table `village_units`
--
ALTER TABLE `village_units`
  ADD CONSTRAINT `UNT` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `VLLG` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
