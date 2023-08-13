-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 02:46 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imbagramdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `contentId` char(10) NOT NULL,
  `caption` text DEFAULT NULL,
  `fileLocation` text NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `timeDeleted` timestamp NULL DEFAULT NULL,
  `comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `likes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `userId` char(10) NOT NULL,
  `contentLocation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`contentId`, `caption`, `fileLocation`, `timeCreated`, `timeDeleted`, `comments`, `likes`, `userId`, `contentLocation`) VALUES
('766tAdRQ4z', 'hayo gue yang mana', 'vE_DznSGpm766tAdRQ4z1643257117.jpg', '2022-01-27 04:18:37', NULL, '{\"userId\":\"c7CLdghJjc\",\"comment\":\"tesbimbing\",\"timeCreated\":1643272291}', NULL, 'vE_DznSGpm', ''),
('bHbfOoqQ8r', 'Salam cuan', 'QXHvf3Z-HkbHbfOoqQ8r1643258190.jpg', '2022-01-27 04:36:30', NULL, NULL, '[\"QXHvf3Z-Hk\"]', 'QXHvf3Z-Hk', 'Cikole'),
('cjaoErbzOM', 'Lebih indah dari kenangan mantan', 'vE_DznSGpmcjaoErbzOM1643257040.jpg', '2022-01-27 04:17:20', NULL, '[{\"userId\":\"n5GN81XKXg\",\"comment\":\"foto ini sangat bagus\",\"timeCreated\":1643257651},{\"userId\":\"QXHvf3Z-Hk\",\"comment\":\"Saya juga suka foto ini\",\"timeCreated\":1643257798}]', '[\"QXHvf3Z-Hk\",\"n5GN81XKXg\"]', 'vE_DznSGpm', 'Kantin payung'),
('cvovB6LUd7', 'Makan makan', 'vE_DznSGpmcvovB6LUd71643257097.jpg', '2022-01-27 04:18:17', NULL, NULL, NULL, 'vE_DznSGpm', 'Shabu Hachi gatsu'),
('mHj1p6GHpf', 'Jadwal', 'mHj1p6GHpf.png', '2022-01-30 03:18:32', NULL, '[{\"userId\":\"n5GN81XKXg\",\"comment\":\"foto ini sangat bagus\",\"timeCreated\":1643257651},{\"userId\":\"QXHvf3Z-Hk\",\"comment\":\"Saya juga suka foto ini\",\"timeCreated\":1643257798},{\"userId\":\"_R84M-8iTh\",\"comment\":\"tes\",\"timeCreated\":1643517030},{\"userId\":\"_R84M-8iTh\",\"comment\":\"\",\"timeCreated\":1643517054},{\"userId\":\"_R84M-8iTh\",\"comment\":\"\",\"timeCreated\":1643517097}]', '[]', '_R84M-8iTh', 'Tangerang'),
('rmZTImgF2u', '', 'n5GN81XKXgrmZTImgF2u1643257296.jpg', '2022-01-27 04:21:36', NULL, NULL, NULL, 'n5GN81XKXg', ''),
('SbRLMAqE5Q', 'Gua merem :(', '5P71Q8WQBVSbRLMAqE5Q1643259734.jpg', '2022-01-27 05:02:14', NULL, NULL, NULL, '5P71Q8WQBV', ''),
('XoL4_-iwZO', 'Angkatan kami hobinya ngangkat', '5P71Q8WQBVXoL4_-iwZO1643258259.jpg', '2022-01-27 04:37:39', NULL, NULL, '[\"Bb4qU_l3EX\"]', '5P71Q8WQBV', 'Cikole'),
('_tTX3RkeOQ', 'tepar', '5P71Q8WQBV_tTX3RkeOQ1643258359.jpg', '2022-01-27 04:39:19', NULL, NULL, '[\"5P71Q8WQBV\"]', '5P71Q8WQBV', 'Binus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` char(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profilePicture` text NOT NULL,
  `bio` varchar(255) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `timeDeleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `name`, `profilePicture`, `bio`, `timeCreated`, `timeDeleted`) VALUES
('05UVIobo_r', 'so201', '$2y$10$4SBaFRXmc2kHbVv.UOgVeOQ7z54FDi3VS9RiA1Lz7114OL0U2NrOK', 'so201@binus.edu', 'Andrew Wiseson Tanjaya', '05UVIobo_r1643256570.png', '', '2022-01-27 04:09:30', NULL),
('2Wny-8fpjT', 'mw201', '$2y$10$mC.qx30yDV4nZxikJNNni.TpttB4ewJP2eZfHeR3CQwvyn2WoEggy', 'mw201@binus.edu', 'Martin Wijaya', '2Wny-8fpjT1643256502.png', 'Mbeek', '2022-01-27 04:08:22', NULL),
('5P71Q8WQBV', 'ab201', '$2y$10$7lxCMUOyCAwNCCfQb0XLZuDHVcDGsTlU/Ou0B.j0VWFXfecgPS48a', 'ab201@binus.edu', 'Alberic Aptatio Astri', '5P71Q8WQBV1643256051.png', 'Hello World!', '2022-01-27 04:00:52', NULL),
('8Y2s7RRU6e', 'jf201', '$2y$10$ni3kHzlXdNMVsCkQZwsSiuf5SVUvZLUdx77uYYfe5rR6bzWJZ/vVq', 'jf201@binus.edu', 'Jeff Laurent Lee', '8Y2s7RRU6e1643256383.png', 'H E L L O', '2022-01-27 04:06:23', NULL),
('Bb4qU_l3EX', 'admin', '$2y$10$uBlfeNcEp618IGz4UWMEOeMIQsZdvPz5UcMz3fUkW6YBhv.ZNkRDG', 'admin@admin.com', 'admin', 'Bb4qU_l3EX1643264273.jpg', 'admin', '2022-01-27 06:17:53', NULL),
('eUVo5XP1qU', 'jh201', '$2y$10$QU3q6nJh7EbHVKpYWdtsAOmmYgJYqzPlMwYho7Kv6qBKdZTuRBgD2', 'jh201@binus.edu', 'Jonathan Adrian', 'eUVo5XP1qU1643256404.png', 'Hello i\\\'m Adrian No 3', '2022-01-27 04:06:44', NULL),
('iv-p-plNyx', 'rr201', '$2y$10$VtAoADKxVsYGOgCTbNOhO.uATONBHuigi7o03lyXbgw/s0tnlk4Y2', 'rr201@binus.edu', 'Richardles', 'iv-p-plNyx1643256547.png', '', '2022-01-27 04:09:07', NULL),
('jUG1_22Wc7', 'lo201', '$2y$10$0JfV4xnmDCs67l37pkHmBuLU0EHVnywB1IlDXo2mRWj0Aap8ovSXi', 'lo201@binus.edu', 'Leonardo', 'jUG1_22Wc71643256466.png', 'no bio', '2022-01-27 04:07:46', NULL),
('KbtpbjLi5L', 'cv201', '$2y$10$/1kbbstyCnNUp2natygr8uKFDHatLwbZnGwA5crolGUP9iogjhPqe', 'cv201@binus.edu', 'Calvin', 'KbtpbjLi5L1643256177.png', 'Hello i like crypto', '2022-01-27 04:02:57', NULL),
('lJ7tPnyq8y', 'fs201', '$2y$10$bSoK.8SNTFFEXo2dfYsutOJcOn88/zIpoLssKZ9rko/p5PAZiJZHy', 'fs201@binus.edu', 'Luis Frentzen Salim', 'lJ7tPnyq8y1643256351.png', 'nobio', '2022-01-27 04:05:51', NULL),
('MKFNRqtZtt', 'du201', '$2y$10$.TyK7SuVQXEZC85S3vnXyOEiDc2.XsIW7MlpffWGzXjxdLEM4S.rm', 'du201@binus.edu', 'Daniel Fujiono', 'MKFNRqtZtt1643256261.png', 'CEO', '2022-01-27 04:04:21', NULL),
('n5GN81XKXg', 'ka201', '$2y$10$4/lxK5HZsOoc8Wt58VyNBe4CACI3SYhlSztHQedAeNwZFgE7roJei', 'ka201@binus.edu', 'Kimberly Atalya Arquette Lontoh', 'n5GN81XKXg1643256441.png', 'I like anime', '2022-01-27 04:07:21', NULL),
('oH5FFeHg7E', 'jy201', '$2y$10$n3/FkFUTEhvRu.2mUG9rTe5Z7LEk2Rf4KCSJX9auS47hQKTHcUI.y', 'jy201@binus.edu', 'Revaldi Mijaya', 'oH5FFeHg7E1643256422.png', 'JY adalah angkatan, angkatan adalah JY', '2022-01-27 04:07:02', NULL),
('qVo14QPn6Q', 'fg201', '$2y$10$I4MW68plBy4/W/GZE/gKM.4zT/JkdCtAdV7xfYS6ygwbFWrANyFkC', 'fg201@binus.edu', 'Ferdinand Gunawan', 'user.png', 'Database Admin 8)', '2022-01-27 04:05:34', NULL),
('QXHvf3Z-Hk', 'dx201', '$2y$10$njSw.OEUnM3i0Gv38thYw.v4PZwc.SIgYSKZeUMzE6MB6BymrkZDq', 'dx201@binus.edu', 'Adrian', 'QXHvf3Z-Hk1643256286.png', 'I\\\'m adrian 1', '2022-01-27 04:04:46', NULL),
('R0v62qIt1c', 'dp201', '$2y$10$6vrLxcW419DBRFFayU3MB.1JILosV5RhOayYYn7IyqUVtX5fujO/O', 'dp201@binus.edu', 'Doddie Prawarjito', 'R0v62qIt1c1643256231.png', 'Hello i\\\'m doddie', '2022-01-27 04:03:51', NULL),
('rWBeXphsBB', 'AldiTheOne', '$2y$10$WrMiCSnbhEDBFrqVHt.Td.UYDG4KPuR5cVIaEG0d4HtZzOnvqkkFm', 'Aldi The One', 'aldi@gmail.com', 'rWBeXphsBB.jpg', 'Coba register dengan foto', '2022-01-30 04:43:57', NULL),
('UoEs7Nw4Os', 'dz201', '$2y$10$KOBnFJwhPYoGcf.G/o0xzuckCl78Uu1x1EctHAs0/J6TmFhU6/34u', 'dz201@binus.edu', 'Adrian', 'UoEs7Nw4Os1643256309.png', 'I\\\'m adrian from Medan', '2022-01-27 04:05:09', NULL),
('vE_DznSGpm', 'wa201', '$2y$10$s3bEPnXKqam7PyRiSyHg8.eIt2LRF3NbtWSRqSd9kS66MHFrTl1Oq', 'wa201@binus.edu', 'Wawan', 'vE_DznSGpm1643256699.png', 'I\'m wawan', '2022-01-27 04:11:39', NULL),
('VgDx5b1gGS', 'lt201', '$2y$10$itfZF9fmsZ3iOBQ2KqGdCeIFpbYXmHZafU5.Fqgf3ZUCyD3Z3kjq6', 'lt201@binus.edu', 'Lukas Tanto Kurniawan', 'VgDx5b1gGS1643256483.png', 'Astdevvvvv', '2022-01-27 04:08:03', NULL),
('x9zJa1EFsX', 'ph201', '$2y$10$vZm5sLUlPyC0x/I5/QH3FOO.zCSt87MZ4kldyKKBy07OPgiXwKQBy', 'ph201@binus.edu', 'STEPHANUS ADITYA PRATAMA HARJONO', 'x9zJa1EFsX1643256528.png', 'Hello', '2022-01-27 04:08:48', NULL),
('_R84M-8iTh', 'ficopang', '$2y$10$AVIhaqGitR72z9iAZAZdVeM/wygTFrmmqMNl3SJ9SEtSvmJk.0VnK', 'Fico Pangestu', 'fico@gmail.com', 'user.png', 'be yourself', '2022-01-29 09:49:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`contentId`),
  ADD KEY `fk_user_content` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_user_content` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
