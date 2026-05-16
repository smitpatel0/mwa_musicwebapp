-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 06:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `album_title` varchar(255) NOT NULL,
  `album_artist` varchar(255) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `album_cover` varchar(255) DEFAULT NULL,
  `album_audio` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `album_title`, `album_artist`, `genre`, `release_date`, `album_cover`, `album_audio`, `description`, `created_at`) VALUES
(2, 'Chuttamalle', 'Shilpa Rao', 'Romance', '2024-12-01', '../php/uploads/albums/covers/chuttamalle.jpeg', '../php/uploads/albums/audios/Chuttamalle - Devara.mp3', 'Devara Movie Songs ', '2024-07-22 13:32:10'),
(3, 'Ae Dil Hai Mushkil', 'Arijit Singh ,Pritam', 'Romance', '2016-10-28', '../php/uploads/albums/covers/aedilhaimushkil.jpeg', '../php/uploads/albums/audios/Ae Dil Hai Mushkil.mp3', 'Ae Dil Hai Mushkil Movie Song', '2024-07-22 13:36:23'),
(4, 'Bella Ciao', 'Manu Pilas', 'Folk', '2017-05-02', '../php/uploads/albums/covers/bellaciao.jpeg', '../php/uploads/albums/audios/Bella Ciao - La Casa de Papel.mp3', 'La Casa De Papel\r\n', '2024-07-22 13:39:02'),
(5, 'Dooriyan', 'Dino Jemes, Kaprila', 'Indian Hip-Hop', '2020-04-25', '../php/uploads/albums/covers/dooriyan.jpeg', '../php/uploads/albums/audios/Dooriyan - Dino James ft. Kaprila.mp3', 'Album Song', '2024-07-22 13:41:22'),
(6, 'Sari Duniya Jala Denge', 'B Praak ,Jaani', 'Indian Hip-Hop', '2023-12-01', '../php/uploads/albums/covers/sariduniyajaladenge.jpeg', '../php/uploads/albums/audios/Saari Duniya Jalaa Denge.mp3', 'Animal Song', '2024-07-22 13:44:59'),
(7, 'Sajni', 'Arijit Singh ', 'Indian Hip-Hop', '2024-03-01', '../php/uploads/albums/covers/sajni.jpeg', '../php/uploads/albums/audios/Sajni-Laapataa Ladies.mp3', 'Laapata Ladies ', '2024-07-22 13:46:44'),
(8, 'Shayad', 'Arijit Singh ,Pritam,Madhubanti', 'Indian Film-Hop', '2009-07-31', '../php/uploads/albums/covers/shayad.jpeg', '../php/uploads/albums/audios/Shayad - Love Aaj Kal.mp3', 'Love Aaj Kal', '2024-07-22 13:49:15'),
(9, 'Ranjha', 'B Praak ,Jasleen', 'Indian Film-Hop', '2021-08-12', '../php/uploads/albums/covers/ranjha.jpeg', '../php/uploads/albums/audios/Ranjha Official Video Shershaah.mp3', 'Shershah', '2024-07-22 13:50:52'),
(10, 'Peele Peele', 'Manhar Udhas, Suresh Wadkar', 'Indian Film-Pop', '1993-01-29', '../php/uploads/albums/covers/peelepeele.jpeg', '../php/uploads/albums/audios/Peele Peele O Morey Raja.mp3', 'Tiranga', '2024-07-22 13:54:36'),
(11, 'Khulke Jeene Ka', 'Arijit Singh ,A.R.Rahman,Shashaa', 'Indian Film-Pop', '2020-07-24', '../php/uploads/albums/covers/khulkejeeneka.jpeg', '../php/uploads/albums/audios/Dil Bechara- Khulke Jeene Ka.mp3', 'Dil Bechara', '2024-07-22 13:57:43'),
(12, 'Kesariya', 'Arijit Singh', 'Indian Film-Pop', '2022-09-09', '../php/uploads/albums/covers/kesariya.jpeg', '../php/uploads/albums/audios/Kesariya.mp3', 'Brahmastra', '2024-07-22 13:59:49'),
(13, 'Humdard', 'Arijit Singh', 'Indian Film-Pop', '2014-06-27', '../php/uploads/albums/covers/humdard.jpeg', '../php/uploads/albums/audios/Humdard full audio song-Ek Villain.mp3', 'Ek villain', '2024-07-22 14:01:34'),
(14, 'Jaan Nissar', 'Arijit Singh', 'Romance', '2018-12-07', '../php/uploads/albums/covers/jaannissar.jpeg', '../php/uploads/albums/audios/Kedarnath-Jaan Nisaar.mp3', 'Kedarnath', '2024-07-22 14:03:25'),
(15, 'Pal Pal Dil Ke Pass', 'Kalyanji-Anandji', 'Romance', '1973-11-30', '../php/uploads/albums/covers/blackmail.jpeg', '../php/uploads/albums/audios/Blackmail - Pal Pal Dil Ke Paas Tum Rehti Ho.mp3', 'Blackmail', '2024-07-22 14:05:29'),
(16, 'Arabic Kuthu', 'Anirudh Ravichandar', 'Tamil Folk', '2022-04-13', '../php/uploads/albums/covers/arabickuthu.jpeg', '../php/uploads/albums/audios/Arabic Kuthu- Beast.mp3', 'Beast', '2024-07-22 14:07:56'),
(17, 'Gali me chand nikla', 'Alka Yagnik', 'Romance', '1998-12-25', '../php/uploads/albums/covers/galimeaajchand.jpeg', '../php/uploads/albums/audios/Gali Mein Chand nikla.mp3', 'Zakhm(1998)', '2024-07-22 14:10:20'),
(18, 'We Rolin', 'Shubh', 'Dance', '2021-10-22', '../php/uploads/albums/covers/werollin.jpeg', '../php/uploads/albums/audios/We Rollin (Official Audio) - Shubh.mp3', 'Album', '2024-07-22 14:12:19'),
(19, 'Wishlist', 'Dino Jemes, Kaprila', 'Indian Hip-Hop', '2020-03-20', '../php/uploads/albums/covers/whishlist.jpeg', '../php/uploads/albums/audios/Dino James  Wishlist feat Kaprila   Official Music Video.mp3', 'Official Music Audio', '2024-07-22 14:14:39'),
(20, 'Tarasti Hai Nigahein  ', 'Asim, Zenab', 'Romance', '2019-04-25', '../php/uploads/albums/covers/tarastihainigahein.jpeg', '../php/uploads/albums/audios/Ghalat Fehmi (From Super Superstar).mp3', 'Superstar', '2024-07-22 14:18:40'),
(21, 'Srivalli', 'Javed Ali', 'Dance', '2021-12-17', '../php/uploads/albums/covers/srivalli.jpeg', '../php/uploads/albums/audios/Pushpa Srivalli Hindi.mp3', 'Pushpa The Rise', '2024-07-22 14:20:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
