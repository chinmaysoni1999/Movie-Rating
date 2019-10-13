-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2019 at 04:16 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviereviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewed_by` varchar(50) NOT NULL,
  `on_movie` varchar(100) NOT NULL,
  `rating` int(2) NOT NULL,
  `review` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewed_by`, `on_movie`, `rating`, `review`) VALUES
('subodh', '12 Angry Men', 8, 'Nice Movie'),
('subodh', '12 Angry Men', 10, ' good movie'),
('user1', 'andhadhun', 9, 'must watch'),
('subodh', 'Andhadhun', 8, 'nice acting'),
('subodh', '12 Angry Men', 9, 'nice movie'),
('subodh', 'Angry Birds 2', 1, ' not good'),
('subodh', 'Anbe Sivam', 1, ' bad'),
('subodh', 'Anbe Sivam', 10, ' nice'),
('subodh', 'Anbe Sivam', 10, ' nice'),
('subodh', 'Saaho', 7, ' not bad'),
('subodh1', 'Saaho', 8, ' good action');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
