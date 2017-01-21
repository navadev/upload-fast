-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2017 at 11:12 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upload`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `originalname` varchar(500) NOT NULL,
  `randomname` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `timeuploaded` datetime NOT NULL,
  `private` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `username`, `originalname`, `randomname`, `type`, `size`, `timeuploaded`, `private`) VALUES
(91, 'tester', 'sample_picture09.jpg', '7486f.jpg', 'image/jpeg', '29876', '2009-02-14 17:47:36', 0),
(90, '127.0.0.1', 'sample_picture07.jpg', '38276.jpg', 'image/jpeg', '49606', '2009-02-14 17:47:28', 0),
(89, '127.0.0.1', 'sample_picture01.jpg', 'b92a1.jpg', 'image/jpeg', '37643', '2009-02-14 17:47:17', 0),
(88, '127.0.0.1', 'winter.jpg', '736f5.jpg', 'image/jpeg', '105542', '2009-02-14 17:47:05', 1),
(87, '127.0.0.1', 'blue hills.jpg', '3423e.jpg', 'image/jpeg', '28521', '2009-02-14 17:46:56', 0),
(86, '127.0.0.1', 'fish.jpg', '0c153.jpg', 'image/jpeg', '483118', '2009-02-14 17:46:46', 0),
(92, '127.0.0.1', 'img_3747.jpg', 'b54dc.jpg', 'image/jpeg', '856380', '2016-12-30 12:39:53', 0),
(93, '127.0.0.1', 'crest_speeds.jpg', 'b94d9.jpg', 'image/jpeg', '23449', '2016-12-31 14:37:31', 1),
(94, '127.0.0.1', 'how-to-get-xy-fdmap.png', '7fde1.png', 'image/png', '626857', '2016-12-31 14:39:20', 1),
(95, '127.0.0.1', 'surge.jpg', 'c8cb5.jpg', 'image/jpeg', '176062', '2016-12-31 14:40:29', 1),
(96, 'tester', 'results.png', '4334b.png', 'image/png', '18011', '2016-12-31 14:47:23', 1),
(97, 'tester', 'gabrielnavaberkeleyfalltuitiondues.png', '2e451.png', 'image/png', '166105', '2016-12-31 14:49:21', 0),
(98, 'tester', 'results.png', '4334b.png', 'image/png', '18011', '2017-01-05 11:56:04', 1),
(99, 'tester', 'selection_001.png', 'f7bbf.png', 'image/png', '26969', '2017-01-05 11:56:12', 1),
(100, '127.0.0.1', 'misfitconstantu0changes.png', '36f24.png', '3', '14643', '2017-01-05 22:39:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time_registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `ip`, `time_registered`) VALUES
(1, 'tester', '$2y$10$HMulcrPHTT4TnPMV0Pt.reJtSmUmKC.saltandhashmodifiedH8lIcELt2cq6Dud6', 'tester@mail.com', '127.0.0.1', '2016-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
