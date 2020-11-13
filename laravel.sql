-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Paź 2020, 21:09
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `laravel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
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
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `login`, `email`, `password`, `salt`) VALUES
(1, 'hlep', 'heniek@bruh.y', 'kek', '12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buildings`
--

CREATE TABLE `buildings` (
  `id` int(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `level` int(3) NOT NULL,
  `cost_brick` int(10) NOT NULL,
  `cost_wood` int(10) NOT NULL,
  `build_time` time(6) NOT NULL,
  `points` int(10) NOT NULL,
  `image_dir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `build_queue`
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
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `id_thread` int(10) NOT NULL,
  `id_player` int(10) NOT NULL,
  `seq_number` int(10) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `guilds`
--

CREATE TABLE `guilds` (
  `id` int(10) NOT NULL,
  `id_leader` int(10) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `guilds_diplomacy`
--

CREATE TABLE `guilds_diplomacy` (
  `id1` int(10) NOT NULL,
  `id2` int(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invitations`
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
-- Struktura tabeli dla tabeli `invitation_status`
--

CREATE TABLE `invitation_status` (
  `id` int(10) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_from` int(10) NOT NULL,
  `id_to` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `date`, `content`) VALUES
(1, '2020-09-23', 'Dodano autoinkrementację tabeli \'news\'. '),
(2, '2020-09-23', 'Dodano poprawne wyświetlanie ostatnich aktualności. ');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `players`
--

CREATE TABLE `players` (
  `id` int(10) NOT NULL,
  `login` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(512) NOT NULL,
  `salt` varchar(512) NOT NULL,
  `points` int(10) NOT NULL,
  `id_guild` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `players`
--

INSERT INTO `players` (`id`, `login`, `email`, `password`, `salt`, `points`, `id_guild`) VALUES
(1, 'heniwk', 'a@a.a', 'kek', '1', 1, NULL),
(2, 'bruh', 'kek@bruh.y', 'asda', '1', 12, NULL),
(3, 'maciej', 'nie@no.nein', 'soo', '512', 17, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reports`
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
-- Struktura tabeli dla tabeli `thread`
--

CREATE TABLE `thread` (
  `id` int(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `id_guild` int(10) NOT NULL,
  `last_seq_num` int(10) NOT NULL,
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `units`
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `unit_queue`
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
-- Struktura tabeli dla tabeli `villages`
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
  `brick` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `villages`
--

INSERT INTO `villages` (`id`, `name`, `x_coordinate`, `y_coordinate`, `points`, `id_player`, `steel`, `wood`, `brick`) VALUES
(1, 'chlebak', 15, 12, 0, 1, 0, 0, 0),
(2, 'bochnia', 5, 14, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `village_buildings`
--

CREATE TABLE `village_buildings` (
  `id_building` int(10) NOT NULL,
  `level` int(3) DEFAULT NULL,
  `id_village` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `village_units`
--

CREATE TABLE `village_units` (
  `id_unit` int(10) NOT NULL,
  `number` int(10) DEFAULT NULL,
  `available` int(10) DEFAULT NULL,
  `id_village` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `build_queue`
--
ALTER TABLE `build_queue`
  ADD UNIQUE KEY `id_village` (`id_village`),
  ADD UNIQUE KEY `id_building` (`id_building`);

--
-- Indeksy dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_thread` (`id_thread`),
  ADD UNIQUE KEY `id_player` (`id_player`);

--
-- Indeksy dla tabeli `guilds`
--
ALTER TABLE `guilds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `LEADER` (`id_leader`);

--
-- Indeksy dla tabeli `guilds_diplomacy`
--
ALTER TABLE `guilds_diplomacy`
  ADD PRIMARY KEY (`id1`,`id2`),
  ADD KEY `FOREIGN` (`id1`,`id2`) USING BTREE,
  ADD KEY `2` (`id2`);

--
-- Indeksy dla tabeli `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_inviting` (`id_inviting`),
  ADD UNIQUE KEY `id_invited` (`id_invited`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Indeksy dla tabeli `invitation_status`
--
ALTER TABLE `invitation_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_from` (`id_from`),
  ADD KEY `id_to` (`id_to`);

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_guild` (`id_guild`);

--
-- Indeksy dla tabeli `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_source` (`id_source`),
  ADD KEY `id_target` (`id_target`);

--
-- Indeksy dla tabeli `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `GUILD` (`id_guild`);

--
-- Indeksy dla tabeli `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `unit_queue`
--
ALTER TABLE `unit_queue`
  ADD UNIQUE KEY `id_village` (`id_village`),
  ADD UNIQUE KEY `id_unit` (`id_unit`);

--
-- Indeksy dla tabeli `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PLAYER` (`id_player`);

--
-- Indeksy dla tabeli `village_buildings`
--
ALTER TABLE `village_buildings`
  ADD PRIMARY KEY (`id_building`,`id_village`),
  ADD KEY `VILLAGE` (`id_village`);

--
-- Indeksy dla tabeli `village_units`
--
ALTER TABLE `village_units`
  ADD PRIMARY KEY (`id_unit`,`id_village`),
  ADD KEY `VLLG` (`id_village`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `guilds`
--
ALTER TABLE `guilds`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `invitation_status`
--
ALTER TABLE `invitation_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `build_queue`
--
ALTER TABLE `build_queue`
  ADD CONSTRAINT `B` FOREIGN KEY (`id_building`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `V` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `COMMENTER` FOREIGN KEY (`id_player`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `THREAD` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id`);

--
-- Ograniczenia dla tabeli `guilds`
--
ALTER TABLE `guilds`
  ADD CONSTRAINT `LEADER` FOREIGN KEY (`id_leader`) REFERENCES `players` (`id`);

--
-- Ograniczenia dla tabeli `guilds_diplomacy`
--
ALTER TABLE `guilds_diplomacy`
  ADD CONSTRAINT `1` FOREIGN KEY (`id1`) REFERENCES `guilds` (`id`),
  ADD CONSTRAINT `2` FOREIGN KEY (`id2`) REFERENCES `guilds` (`id`);

--
-- Ograniczenia dla tabeli `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `INVITED` FOREIGN KEY (`id_invited`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `INVITING` FOREIGN KEY (`id_inviting`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `STATUS` FOREIGN KEY (`status`) REFERENCES `players` (`id`);

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FROM` FOREIGN KEY (`id_from`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `TO` FOREIGN KEY (`id_to`) REFERENCES `players` (`id`);

--
-- Ograniczenia dla tabeli `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `G` FOREIGN KEY (`id_guild`) REFERENCES `guilds` (`id`);

--
-- Ograniczenia dla tabeli `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `SOURCE` FOREIGN KEY (`id_source`) REFERENCES `players` (`id`),
  ADD CONSTRAINT `TARGET` FOREIGN KEY (`id_target`) REFERENCES `players` (`id`);

--
-- Ograniczenia dla tabeli `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `GUILD` FOREIGN KEY (`id_guild`) REFERENCES `guilds` (`id`);

--
-- Ograniczenia dla tabeli `unit_queue`
--
ALTER TABLE `unit_queue`
  ADD CONSTRAINT `UNIT` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `VLG` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);

--
-- Ograniczenia dla tabeli `villages`
--
ALTER TABLE `villages`
  ADD CONSTRAINT `PLAYER` FOREIGN KEY (`id_player`) REFERENCES `players` (`id`);

--
-- Ograniczenia dla tabeli `village_buildings`
--
ALTER TABLE `village_buildings`
  ADD CONSTRAINT `BUILDING` FOREIGN KEY (`id_building`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `VILLAGE` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);

--
-- Ograniczenia dla tabeli `village_units`
--
ALTER TABLE `village_units`
  ADD CONSTRAINT `UNT` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `VLLG` FOREIGN KEY (`id_village`) REFERENCES `villages` (`id`);


--
-- Metadane
--
USE `phpmyadmin`;

--
-- Metadane dla tabeli admin
--

--
-- Metadane dla tabeli buildings
--

--
-- Metadane dla tabeli build_queue
--

--
-- Metadane dla tabeli comment
--

--
-- Metadane dla tabeli guilds
--

--
-- Metadane dla tabeli guilds_diplomacy
--

--
-- Metadane dla tabeli invitations
--

--
-- Metadane dla tabeli invitation_status
--

--
-- Metadane dla tabeli messages
--

--
-- Metadane dla tabeli news
--

--
-- Metadane dla tabeli players
--

--
-- Metadane dla tabeli reports
--

--
-- Metadane dla tabeli thread
--

--
-- Metadane dla tabeli units
--

--
-- Metadane dla tabeli unit_queue
--

--
-- Metadane dla tabeli villages
--

--
-- Metadane dla tabeli village_buildings
--

--
-- Metadane dla tabeli village_units
--

--
-- Metadane dla Bazy danych laravel
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
