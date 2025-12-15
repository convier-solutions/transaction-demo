-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2023 at 10:45 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `portal_users`
--

DROP TABLE IF EXISTS `portal_users`;
CREATE TABLE IF NOT EXISTS `portal_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `modules` varchar(255) NOT NULL,
  `created_by` int NOT NULL,
  `created_date` varchar(255) NOT NULL,
  `updated_date` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portal_users`
--

INSERT INTO `portal_users` (`id`, `first_name`, `last_name`, `password`, `email`, `modules`, `created_by`, `created_date`, `updated_date`, `status`) VALUES
(4, 'jamal', 'anjum', '12345678912', 'jamal@gmail.com', '[\"1\",\"2\",\"3\"]', 3, '03-03-2023', '03-06-2023', 'Y'),
(3, 'Super', 'Admin', '12345678', 'admin@fandex.com', '[\"1\",\"2\",\"3\"]', 4, '03-03-2023', '03-06-2023', 'Y'),
(5, 'usama12', 'rasheed12', '12345678', 'jamal1@gmail.com', '[\"2\"]', 3, '03-06-2023', '03-06-2023', 'Y'),
(7, 'qew', 'eqw', '123456', 'test@gmail.com', '[\"1\",\"2\",\"3\"]', 4, '03-06-2023', '', 'Y'),
(8, 'ewr', '12', '2312', 'jamal1q@gmail.com', 'null', 3, '03-06-2023', '', 'Y'),
(9, 'erwr', 'wrew', '12345', 'rwer@gmail.com', '[\"1\",\"2\",\"3\"]', 3, '03-06-2023', '03-06-2023', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `purchase_id` varchar(100) NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `user` int NOT NULL,
  `amount` float NOT NULL,
  `pay_out` float NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `purchase_id`, `transaction_type`, `transaction_date`, `user`, `amount`, `pay_out`, `created_date`, `created_by`) VALUES
(9, 'us12', 'us1212', '', '2023-02-28 00:00:00', 7, 1212, 0, '2023-03-06 05:23:16', 3),
(3, 'test', 'ew122321', 'test', '2023-03-02 00:00:00', 7, 65, 0, '2023-03-02 10:00:08', 4),
(4, 'rand1', '', 'rand1', '2023-03-02 10:00:34', 3, 123, 0, '2023-03-02 10:00:34', 1),
(5, 'xyz123', '', 'xyz', '2023-03-02 10:02:03', 1, 123, 0, '2023-03-02 10:02:03', 1),
(6, 'user1id', '', 'user1', '2023-03-02 10:02:26', 5, 1234, 0, '2023-03-02 10:02:26', 1),
(7, 'abc3', '', 'abc3', '2023-03-02 11:02:06', 1, 35, 0, '2023-03-02 11:02:06', 1),
(8, 'dsd', '', 'dss2', '2023-03-17 00:00:00', 1, 132, 0, '2023-03-02 11:15:55', 1),
(12, 'test123', 'test123', '', '2023-02-28 00:00:00', 7, 123, 0, '2023-03-06 06:56:05', 3),
(13, 'wer', 'wer', '', '2023-02-28 00:00:00', 7, 234, 0, '2023-03-06 09:53:50', 4),
(14, 'wer', 'wer', '', '2023-02-28 00:00:00', 7, 234, 0, '2023-03-06 09:54:50', 4),
(15, 'sdf', '32rew', '', '2023-02-26 00:00:00', 7, 324, 0, '2023-03-06 09:55:10', 4),
(16, 'erw', 'wer', '', '2023-02-26 00:00:00', 7, 324, 0, '2023-03-06 09:55:24', 4),
(17, 'us1', '212', '', '2023-02-27 00:00:00', 7, 12, 0, '2023-03-06 11:08:51', 4),
(18, '111', '111', '', '2023-03-07 00:00:00', 7, 111, 200, '2023-03-07 05:31:59', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`) VALUES
(2, 'omer dev', 'omerobaid58@gmail.com', '123123123', '', 1, '2021-02-11 11:40:24', 15, '2022-11-30 10:03:22'),
(3, 'Piedica', 'controlerpiedica@gmail.com', '123SensorUSA', '', 11, '2021-03-01 12:46:36', 21, '2022-12-02 16:11:35'),
(4, 'Karson Howard', 'karsonhoward@gmail.com', '1555Feet', '', 11, '2021-06-09 11:52:21', 21, '2022-12-02 00:54:25'),
(5, 'Kendon Howard', 'kdho@vertexorthopedic.com', '2166Kdho', '', 11, '2021-10-06 12:04:02', 21, '2022-12-02 00:13:42'),
(6, 'Kooper Howard ', 'kooperhoward20@gmail.com', 'Vertex123$', '', 21, '2022-08-25 17:05:58', 21, '2022-12-02 00:16:45'),
(7, 'usama', 'admin@fandex.com', 'Usama@12', '', 15, '2023-01-05 04:49:44', 3, '2023-03-06 11:31:44'),
(30, NULL, 'test1@gmail.com', 'Test@123', 'Y', 3, '2023-03-06 06:56:55', 3, '2023-03-06 06:57:15'),
(31, NULL, 'adm1in@fandex.com', '12345678', 'Y', 4, '2023-03-06 09:53:32', 0, '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
