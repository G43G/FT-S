-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 08:55 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snappic`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(50) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `snap` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `snap`, `user`, `created_at`, `updated_at`) VALUES
(118, 'Hej majstore, pazi sad!', 34, 1, '2019-08-08 20:19:07', '2019-08-19 20:12:47'),
(120, 'Pazi sad ovako.', 38, 1, '2019-08-08 20:29:13', NULL),
(121, 'Test komentar, ali izmenjen.', 38, 1, '2019-08-08 20:29:17', '2019-08-08 20:29:24'),
(124, 'Ajmo.', 36, 1, '2019-08-12 19:29:36', NULL),
(126, 'Opa!', 34, 1, '2019-08-19 20:12:58', NULL),
(127, 'Evo i mene.', 38, 7, '2019-08-19 20:13:21', NULL),
(128, 'Dobra slika.', 42, 1, '2019-08-19 20:32:28', NULL),
(131, 'I also love nVidia! :)', 60, 1, '2019-09-05 19:14:31', NULL),
(132, 'Test!!!', 36, 1, '2019-09-11 18:24:35', '2019-09-11 18:24:41'),
(133, 'asdas', 60, 7, '2019-09-14 13:12:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `id` int(2) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `name`, `class`, `created_at`, `updated_at`) VALUES
(1, 'None', 'filter-transparent', '2019-06-25 17:38:47', NULL),
(2, 'Red', 'filter-red', '2019-05-28 22:10:33', NULL),
(3, 'Blue', 'filter-blue', '2019-05-29 21:03:38', NULL),
(4, 'Yellow', 'filter-yellow', '2019-05-29 21:03:38', NULL),
(5, 'Black', 'filter-black', '2019-05-29 21:03:58', NULL),
(6, 'White', 'filter-white', '2019-05-29 21:03:58', NULL),
(7, 'Purple', 'filter-purple', '2019-05-29 21:04:21', NULL),
(8, 'Brown', 'filter-brown', '2019-05-29 21:04:21', NULL),
(9, 'Grey', 'filter-grey', '2019-05-29 21:04:36', NULL),
(10, 'Orange', 'filter-orange', '2019-05-29 21:04:36', NULL),
(11, 'Green', 'filter-green', '2019-05-28 22:10:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(100) NOT NULL,
  `snap` int(10) NOT NULL,
  `user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `snap`, `user`) VALUES
(305, 36, 9),
(306, 36, 7),
(336, 38, 1),
(338, 34, 1),
(358, 40, 1),
(359, 36, 1),
(362, 42, 1),
(368, 58, 8),
(369, 57, 8),
(370, 42, 8),
(371, 40, 8),
(372, 36, 8),
(373, 34, 8),
(374, 59, 7),
(375, 58, 7),
(376, 57, 7),
(377, 42, 7),
(378, 38, 7),
(379, 34, 7),
(380, 60, 9),
(381, 59, 9),
(382, 57, 9),
(383, 38, 9),
(390, 60, 1),
(391, 57, 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id` int(1) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `auth` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `name`, `path`, `icon`, `auth`, `created_at`, `updated_at`) VALUES
(2, 'Home', '/', 'fa-home', 'no', '2019-05-27 19:47:47', NULL),
(3, 'Discover', 'discover', 'fa-compass', 'no', '2019-05-27 19:47:47', NULL),
(4, 'Profile', 'auth', 'fa-user', 'no', '2019-05-27 19:47:47', NULL),
(5, 'Profile', 'profile', 'fa-user', 'yes', '2019-05-27 19:47:47', NULL),
(6, 'About Me', 'about', 'fa-book', 'no', '2019-05-27 19:47:47', NULL),
(7, 'Admin Panel', 'admin-panel/users', 'fa-cogs', 'yes', '2019-05-27 19:47:47', NULL),
(8, 'Log Out', 'logout', 'fa-sign-out', 'yes', '2019-05-27 19:47:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(50) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '2019-05-27 18:19:01', NULL),
(2, 'user', '2019-05-27 18:19:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `snaps`
--

CREATE TABLE `snaps` (
  `id` int(10) NOT NULL,
  `image` int(10) NOT NULL,
  `filter` int(10) DEFAULT NULL,
  `text` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `snaps`
--

INSERT INTO `snaps` (`id`, `image`, `filter`, `text`, `status`, `user`, `created_at`, `updated_at`) VALUES
(34, 45, 10, 'Artistic, why not!', 'public', 1, '2019-08-08 19:51:38', '2019-08-25 17:42:45'),
(36, 47, 1, 'Spiderman is the best!', 'public', 1, '2019-08-08 20:19:48', NULL),
(38, 49, 4, 'Very nice beach.', 'public', 1, '2019-08-08 20:20:17', '2019-08-18 12:52:40'),
(40, 51, 5, 'This is another test image.', 'private', 1, '2019-08-09 13:20:02', '2019-08-19 19:08:01'),
(42, 53, 5, 'This is Nikola\'s most favorite picture!', 'private', 9, '2019-08-18 12:20:57', NULL),
(57, 68, 8, 'I see a red door and I want to paint it black...', 'public', 1, '2019-09-03 21:28:07', NULL),
(58, 69, 1, 'My favorite city.', 'private', 8, '2019-09-03 21:28:48', NULL),
(59, 70, 10, 'Very nice keyboard.', 'public', 7, '2019-09-03 21:30:19', NULL),
(60, 71, 11, 'I love nVidia! :D', 'private', 9, '2019-09-03 21:31:03', NULL),
(69, 80, 1, 'Stan Lee', 'public', 7, '2019-09-14 13:26:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `snap_images`
--

CREATE TABLE `snap_images` (
  `id` int(10) NOT NULL,
  `path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `thumb_path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `snap_images`
--

INSERT INTO `snap_images` (`id`, `path`, `thumb_path`, `created_at`) VALUES
(45, 'img/snaps/Aero (1).jpg.1565293898.jpg', 'img/snaps/thumbs/Aero (1).jpg.1565293898.jpg', '2019-08-08 19:51:38'),
(47, 'img/snaps/Games (12).jpg.1565295588.jpg', 'img/snaps/thumbs/Games (12).jpg.1565295588.jpg', '2019-08-08 20:19:48'),
(49, 'img/snaps/Nature (4).jpg.1565295616.jpg', 'img/snaps/thumbs/Nature (4).jpg.1565295616.jpg', '2019-08-08 20:20:17'),
(51, 'img/snaps/Vintage (10).jpg.1565356802.jpg', 'img/snaps/thumbs/Vintage (10).jpg.1565356802.jpg', '2019-08-09 13:20:02'),
(53, 'img/snaps/Nature (6).jpg.1566130857.jpg', 'img/snaps/thumbs/Nature (6).jpg.1566130857.jpg', '2019-08-18 12:20:57'),
(68, 'img/snaps/Artistic (3).jpg.1567546087.jpg', 'img/snaps/thumbs/Artistic (3).jpg.1567546087.jpg', '2019-09-03 21:28:07'),
(69, 'img/snaps/City (9).jpg.1567546128.jpg', 'img/snaps/thumbs/City (9).jpg.1567546128.jpg', '2019-09-03 21:28:48'),
(70, 'img/snaps/Computers (9).jpg.1567546218.jpg', 'img/snaps/thumbs/Computers (9).jpg.1567546218.jpg', '2019-09-03 21:30:19'),
(71, 'img/snaps/Computers (5).jpg.1567546263.jpg', 'img/snaps/thumbs/Computers (5).jpg.1567546263.jpg', '2019-09-03 21:31:03'),
(76, 'img/snaps/Profile.jpg.1568466947.jpg', 'img/snaps/thumbs/Profile.jpg.1568466947.jpg', '2019-09-14 13:15:47'),
(77, 'img/snaps/Profile.jpg.1568466968.jpg', 'img/snaps/thumbs/Profile.jpg.1568466968.jpg', '2019-09-14 13:16:08'),
(78, 'img/snaps/2019-02-21.png.1568467015.png', 'img/snaps/thumbs/2019-02-21.png.1568467015.png', '2019-09-14 13:16:55'),
(79, 'img/snaps/2019-02-21.png.1568467183.png', 'img/snaps/thumbs/2019-02-21.png.1568467183.png', '2019-09-14 13:19:43'),
(80, 'img/snaps/2019-02-21.png.1568467615.png', 'img/snaps/thumbs/2019-02-21.png.1568467615.png', '2019-09-14 13:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(100) NOT NULL,
  `thread_from` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `thread_to` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `viewer` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `thread_from`, `thread_to`, `viewer`, `created_at`) VALUES
(44, 'sensei', 'bojsa', '0', '2019-08-18 17:44:30'),
(45, 'sensei', 'bogdan92', '0', '2019-08-18 17:47:17'),
(46, 'bogdan92', 'bojsa', '0', '2019-08-18 18:04:23'),
(47, 'bogdan92', 'milicica', '0', '2019-08-25 17:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `thread_messages`
--

CREATE TABLE `thread_messages` (
  `id` int(100) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `thread_id` int(100) NOT NULL,
  `sender` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thread_messages`
--

INSERT INTO `thread_messages` (`id`, `text`, `thread_id`, `sender`, `created_at`) VALUES
(150, 'Brate, ae kod nas.', 44, 'sensei', '2019-08-18 17:58:42'),
(151, 'Mogao si.', 44, 'sensei', '2019-08-18 17:58:47'),
(152, 'Kako ide diplomski?', 45, 'sensei', '2019-08-18 17:58:52'),
(153, 'Ide OK.', 45, 'bogdan92', '2019-08-18 17:58:58'),
(154, 'Tebi?', 45, 'bogdan92', '2019-08-18 17:58:55'),
(155, 'Kad idemo na faks?', 45, 'bogdan92', '2019-08-18 17:59:01'),
(156, 'Tebra?', 46, 'bogdan92', '2019-08-18 18:04:23'),
(157, 'Alo?!', 46, 'bogdan92', '2019-08-18 18:10:05'),
(158, 'Test.', 45, 'bogdan92', '2019-08-18 18:56:30'),
(159, 'Opet test.', 45, 'bogdan92', '2019-08-19 20:30:35'),
(160, 'Test.', 45, 'bogdan92', '2019-08-19 20:30:43'),
(161, 'Nema te dugo!', 46, 'bogdan92', '2019-08-25 17:43:05'),
(162, 'Ajmo u grad sutra?', 47, 'bogdan92', '2019-08-25 17:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `city` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(1) NOT NULL,
  `image` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `name`, `surname`, `birthday`, `city`, `bio`, `role`, `image`, `created_at`, `updated_at`) VALUES
(1, 'bogdan_992@outlook.com', 'bogdan92', 'a99cf69925ccfd736f9ad5d2eb109cb5', 'Bogdan', 'Matorkić', '1992-09-12', 'Smederevska Palanka', ':)', 1, 11, '2019-02-12 23:00:00', '2019-09-12 16:11:02'),
(7, 'nikola.stefanovic.28.13@ict.edu.rs', 'sensei', '75a9ae3c21c2cea8d2eb58b890d705a1', 'Nikola', 'Stefanović', '1994-12-07', 'Brus', NULL, 2, 17, '2019-07-03 21:14:05', '2019-09-11 18:30:10'),
(8, 'milici_ca@hotmail.com', 'milicica', 'b5f57160684c090d50495adb20f5860b', 'Milica', 'Ignjatović', '1992-05-29', 'Kusadak', NULL, 2, 14, '2019-07-03 21:15:58', '2019-09-03 21:29:23'),
(9, 'dusan.karna.128.13@ict.edu.rs', 'bojsa', '322a0f33ad4fcf60d2daf5616fac69b8', 'Dušan', 'Karna', '1994-03-06', 'Valjevo', NULL, 2, 18, '2019-08-04 18:03:15', '2019-09-11 18:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` int(10) NOT NULL,
  `path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `thumb_path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `path`, `thumb_path`, `created_at`) VALUES
(1, 'img/users/avatar.jpg', 'img/users/thumbs/avatar.jpg', '2019-06-25 19:41:23'),
(11, 'img/users/Profile.jpg.1567193170.jpg', 'img/users/thumbs/Profile.jpg.1567193170.jpg', '2019-08-30 19:26:11'),
(14, 'img/users/ICT-PC - WIN_20150210_193005.JPG.1567546163.JPG', 'img/users/thumbs/ICT-PC - WIN_20150210_193005.JPG.1567546163.JPG', '2019-09-03 21:29:23'),
(17, 'img/users/IMG_1056.JPG.1568226609.JPG', 'img/users/thumbs/IMG_1056.JPG.1568226609.JPG', '2019-09-11 18:30:10'),
(18, 'img/users/IMG_E0006.JPG.1568226641.JPG', 'img/users/thumbs/IMG_E0006.JPG.1568226641.JPG', '2019-09-11 18:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(100) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `snap` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `ip`, `snap`) VALUES
(1662, '127.0.0.1', 34),
(1663, '127.0.0.1', 34),
(1664, '127.0.0.1', 34),
(1665, '127.0.0.1', 34),
(1666, '127.0.0.1', 34),
(1667, '127.0.0.1', 34),
(1668, '127.0.0.1', 34),
(1669, '127.0.0.1', 34),
(1670, '127.0.0.1', 38),
(1675, '127.0.0.1', 34),
(1677, '127.0.0.1', 34),
(1678, '127.0.0.1', 36),
(1679, '127.0.0.1', 34),
(1680, '127.0.0.1', 40),
(1681, '127.0.0.1', 40),
(1682, '127.0.0.1', 40),
(1683, '127.0.0.1', 40),
(1684, '127.0.0.1', 40),
(1685, '127.0.0.1', 40),
(1686, '127.0.0.1', 36),
(1687, '127.0.0.1', 36),
(1688, '127.0.0.1', 36),
(1689, '127.0.0.1', 36),
(1690, '127.0.0.1', 36),
(1691, '127.0.0.1', 36),
(1692, '127.0.0.1', 36),
(1693, '127.0.0.1', 36),
(1694, '127.0.0.1', 36),
(1695, '127.0.0.1', 36),
(1696, '127.0.0.1', 36),
(1697, '127.0.0.1', 36),
(1698, '127.0.0.1', 36),
(1699, '127.0.0.1', 34),
(1700, '127.0.0.1', 34),
(1701, '127.0.0.1', 36),
(1702, '127.0.0.1', 36),
(1703, '127.0.0.1', 36),
(1704, '127.0.0.1', 36),
(1706, '127.0.0.1', 34),
(1707, '127.0.0.1', 36),
(1708, '127.0.0.1', 38),
(1710, '127.0.0.1', 34),
(1711, '127.0.0.1', 34),
(1712, '127.0.0.1', 34),
(1713, '127.0.0.1', 34),
(1714, '127.0.0.1', 34),
(1715, '127.0.0.1', 42),
(1717, '127.0.0.1', 38),
(1718, '127.0.0.1', 38),
(1719, '127.0.0.1', 42),
(1720, '127.0.0.1', 42),
(1721, '127.0.0.1', 42),
(1722, '127.0.0.1', 38),
(1723, '127.0.0.1', 42),
(1724, '127.0.0.1', 42),
(1725, '127.0.0.1', 42),
(1726, '127.0.0.1', 42),
(1727, '127.0.0.1', 42),
(1728, '127.0.0.1', 42),
(1729, '127.0.0.1', 42),
(1730, '127.0.0.1', 42),
(1731, '127.0.0.1', 38),
(1732, '127.0.0.1', 38),
(1733, '127.0.0.1', 38),
(1734, '127.0.0.1', 42),
(1735, '127.0.0.1', 38),
(1736, '127.0.0.1', 38),
(1737, '127.0.0.1', 38),
(1738, '127.0.0.1', 38),
(1739, '127.0.0.1', 38),
(1740, '127.0.0.1', 38),
(1741, '127.0.0.1', 38),
(1742, '127.0.0.1', 38),
(1743, '127.0.0.1', 42),
(1744, '127.0.0.1', 42),
(1745, '127.0.0.1', 42),
(1746, '127.0.0.1', 42),
(1747, '127.0.0.1', 42),
(1748, '127.0.0.1', 42),
(1749, '127.0.0.1', 42),
(1750, '127.0.0.1', 42),
(1751, '127.0.0.1', 42),
(1752, '127.0.0.1', 42),
(1753, '127.0.0.1', 38),
(1754, '127.0.0.1', 38),
(1755, '127.0.0.1', 38),
(1756, '127.0.0.1', 38),
(1757, '127.0.0.1', 38),
(1758, '127.0.0.1', 38),
(1759, '127.0.0.1', 38),
(1760, '127.0.0.1', 38),
(1761, '127.0.0.1', 38),
(1762, '127.0.0.1', 38),
(1763, '127.0.0.1', 38),
(1764, '127.0.0.1', 38),
(1765, '127.0.0.1', 38),
(1766, '127.0.0.1', 38),
(1767, '127.0.0.1', 38),
(1768, '127.0.0.1', 38),
(1769, '127.0.0.1', 38),
(1770, '127.0.0.1', 38),
(1771, '127.0.0.1', 38),
(1772, '127.0.0.1', 38),
(1773, '127.0.0.1', 38),
(1774, '127.0.0.1', 38),
(1775, '127.0.0.1', 38),
(1776, '127.0.0.1', 38),
(1777, '127.0.0.1', 38),
(1778, '127.0.0.1', 38),
(1779, '127.0.0.1', 38),
(1780, '127.0.0.1', 38),
(1781, '127.0.0.1', 38),
(1782, '127.0.0.1', 38),
(1783, '127.0.0.1', 38),
(1784, '127.0.0.1', 38),
(1785, '127.0.0.1', 38),
(1786, '127.0.0.1', 38),
(1787, '127.0.0.1', 38),
(1788, '127.0.0.1', 38),
(1789, '127.0.0.1', 38),
(1790, '127.0.0.1', 38),
(1791, '127.0.0.1', 36),
(1792, '127.0.0.1', 42),
(1793, '127.0.0.1', 36),
(1794, '127.0.0.1', 36),
(1795, '127.0.0.1', 42),
(1796, '127.0.0.1', 40),
(1797, '127.0.0.1', 42),
(1798, '127.0.0.1', 42),
(1799, '127.0.0.1', 42),
(1803, '127.0.0.1', 36),
(1804, '127.0.0.1', 36),
(1805, '127.0.0.1', 38),
(1806, '127.0.0.1', 34),
(1807, '127.0.0.1', 36),
(1808, '127.0.0.1', 42),
(1809, '127.0.0.1', 36),
(1810, '127.0.0.1', 34),
(1812, '127.0.0.1', 34),
(1813, '127.0.0.1', 34),
(1814, '127.0.0.1', 34),
(1815, '127.0.0.1', 42),
(1816, '127.0.0.1', 38),
(1817, '127.0.0.1', 38),
(1818, '127.0.0.1', 38),
(1819, '127.0.0.1', 42),
(1820, '127.0.0.1', 36),
(1821, '127.0.0.1', 36),
(1822, '127.0.0.1', 36),
(1823, '127.0.0.1', 36),
(1824, '127.0.0.1', 36),
(1825, '127.0.0.1', 36),
(1826, '127.0.0.1', 36),
(1827, '127.0.0.1', 36),
(1828, '127.0.0.1', 36),
(1829, '127.0.0.1', 36),
(1831, '127.0.0.1', 38),
(1832, '127.0.0.1', 34),
(1833, '127.0.0.1', 34),
(1834, '127.0.0.1', 34),
(1835, '127.0.0.1', 34),
(1836, '127.0.0.1', 34),
(1837, '127.0.0.1', 38),
(1838, '127.0.0.1', 38),
(1839, '127.0.0.1', 38),
(1840, '127.0.0.1', 38),
(1841, '127.0.0.1', 38),
(1842, '127.0.0.1', 42),
(1843, '127.0.0.1', 34),
(1845, '127.0.0.1', 42),
(1848, '127.0.0.1', 42),
(1849, '127.0.0.1', 42),
(1850, '127.0.0.1', 42),
(1851, '127.0.0.1', 42),
(1852, '127.0.0.1', 42),
(1853, '127.0.0.1', 42),
(1854, '127.0.0.1', 42),
(1855, '127.0.0.1', 42),
(1856, '127.0.0.1', 42),
(1857, '127.0.0.1', 42),
(1859, '127.0.0.1', 36),
(1860, '127.0.0.1', 40),
(1863, '127.0.0.1', 34),
(1870, '127.0.0.1', 38),
(1872, '127.0.0.1', 38),
(1874, '127.0.0.1', 38),
(1877, '127.0.0.1', 40),
(1878, '127.0.0.1', 40),
(1879, '127.0.0.1', 40),
(1882, '127.0.0.1', 40),
(1883, '127.0.0.1', 40),
(1884, '127.0.0.1', 40),
(1885, '127.0.0.1', 40),
(1888, '127.0.0.1', 40),
(1889, '127.0.0.1', 40),
(1890, '127.0.0.1', 40),
(1891, '127.0.0.1', 40),
(1892, '127.0.0.1', 40),
(1893, '127.0.0.1', 40),
(1894, '127.0.0.1', 40),
(1896, '127.0.0.1', 40),
(1897, '127.0.0.1', 40),
(1899, '127.0.0.1', 40),
(1901, '127.0.0.1', 40),
(1904, '127.0.0.1', 40),
(1905, '127.0.0.1', 40),
(1906, '127.0.0.1', 40),
(1907, '127.0.0.1', 34),
(1909, '127.0.0.1', 42),
(1915, '127.0.0.1', 38),
(1922, '127.0.0.1', 38),
(1927, '127.0.0.1', 42),
(1928, '127.0.0.1', 36),
(1935, '127.0.0.1', 42),
(1936, '127.0.0.1', 42),
(1958, '127.0.0.1', 40),
(1965, '127.0.0.1', 59),
(1966, '127.0.0.1', 59),
(1967, '127.0.0.1', 58),
(1968, '127.0.0.1', 58),
(1969, '127.0.0.1', 59),
(1970, '127.0.0.1', 59),
(1971, '127.0.0.1', 58),
(1972, '127.0.0.1', 59),
(1973, '127.0.0.1', 58),
(1974, '127.0.0.1', 58),
(1975, '127.0.0.1', 58),
(1976, '127.0.0.1', 58),
(1977, '127.0.0.1', 58),
(1978, '127.0.0.1', 58),
(1979, '127.0.0.1', 58),
(1980, '127.0.0.1', 60),
(1981, '127.0.0.1', 60),
(1982, '127.0.0.1', 858),
(1983, '127.0.0.1', 58),
(1984, '127.0.0.1', 78588),
(1985, '127.0.0.1', 58),
(1986, '127.0.0.1', 59),
(1987, '127.0.0.1', 58),
(1988, '127.0.0.1', 58),
(1989, '127.0.0.1', 58),
(1990, '127.0.0.1', 59),
(1992, '127.0.0.1', 59),
(1993, '127.0.0.1', 59),
(1995, '127.0.0.1', 36),
(1996, '127.0.0.1', 60),
(1997, '127.0.0.1', 59),
(1999, '127.0.0.1', 59),
(2001, '127.0.0.1', 59),
(2002, '127.0.0.1', 59),
(2004, '127.0.0.1', 59),
(2005, '127.0.0.1', 36),
(2006, '127.0.0.1', 38),
(2007, '127.0.0.1', 60),
(2008, '127.0.0.1', 34),
(2009, '127.0.0.1', 57),
(2010, '127.0.0.1', 42),
(2011, '127.0.0.1', 40),
(2012, '127.0.0.1', 42),
(2013, '127.0.0.1', 58),
(2014, '127.0.0.1', 60),
(2015, '127.0.0.1', 42),
(2016, '127.0.0.1', 40),
(2017, '127.0.0.1', 38),
(2018, '127.0.0.1', 40),
(2019, '127.0.0.1', 34),
(2020, '127.0.0.1', 36),
(2021, '127.0.0.1', 57),
(2022, '127.0.0.1', 60),
(2023, '127.0.0.1', 36),
(2025, '127.0.0.1', 59),
(2026, '127.0.0.1', 57),
(2027, '127.0.0.1', 34),
(2028, '127.0.0.1', 34),
(2029, '127.0.0.1', 34),
(2030, '127.0.0.1', 57),
(2031, '127.0.0.1', 42),
(2032, '127.0.0.1', 60),
(2033, '127.0.0.1', 60),
(2034, '127.0.0.1', 38),
(2035, '127.0.0.1', 60),
(2036, '127.0.0.1', 69);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `snap` (`snap`),
  ADD KEY `user_2` (`user`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `snap` (`snap`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snaps`
--
ALTER TABLE `snaps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`),
  ADD KEY `filter` (`filter`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `snap_images`
--
ALTER TABLE `snap_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thread_messages`
--
ALTER TABLE `thread_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `snap` (`snap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `snaps`
--
ALTER TABLE `snaps`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `snap_images`
--
ALTER TABLE `snap_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `thread_messages`
--
ALTER TABLE `thread_messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2037;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
