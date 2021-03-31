-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 04:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `id` bigint(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `en_name` varchar(200) NOT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `location` varchar(200) NOT NULL,
  `height` int(11) NOT NULL,
  `img` text NOT NULL,
  `info` text NOT NULL,
  `slug` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `parent_id` bigint(11) UNSIGNED DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `parent_id`, `slug`) VALUES
(16, 'dasdsa', 'dasd\r\n                                    das', NULL, 'dasdas'),
(17, 'dat2', 'dat2', NULL, 'dat2'),
(18, 'dat222', 'dsadas', NULL, 'dat222'),
(19, 'dasdadas dasdsa', 'dasd', NULL, 'dasdadas-dasdsa'),
(20, '32d asdsad', 'dsad asdsa', NULL, '32d-asdsad');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `country_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `description`, `country_order`) VALUES
(1, 'Viet Nam', 'Viet Nam', 0),
(2, 'Thai Land', 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `episode`
--

CREATE TABLE `episode` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `movie_id` bigint(20) NOT NULL,
  `url` text NOT NULL,
  `note` varchar(200) NOT NULL,
  `season_id` bigint(11) UNSIGNED DEFAULT NULL,
  `slug` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `menu_type` bigint(20) NOT NULL,
  `parent_menu` bigint(20) UNSIGNED DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `en_name` varchar(200) DEFAULT NULL,
  `img` text NOT NULL,
  `director_id` bigint(11) DEFAULT NULL,
  `bg_img` text DEFAULT NULL,
  `description` text NOT NULL,
  `is_free` int(11) DEFAULT NULL,
  `country` bigint(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 1,
  `category_id` bigint(11) UNSIGNED DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `imdb` float NOT NULL DEFAULT 1,
  `is_movie18` int(11) NOT NULL DEFAULT 0,
  `is_finished` int(11) NOT NULL DEFAULT 0,
  `is_movie_series` int(11) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `is_on_cinema` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `name`, `en_name`, `img`, `director_id`, `bg_img`, `description`, `is_free`, `country`, `duration`, `view_count`, `category_id`, `slug`, `imdb`, `is_movie18`, `is_finished`, `is_movie_series`, `published_at`, `is_on_cinema`, `created_at`, `created_by`) VALUES
(4, 'dsada', NULL, '/storage/uploads/28.jpg', NULL, NULL, 'dasdas', NULL, NULL, NULL, 1, NULL, 'dsada', 0, 0, 1, 0, NULL, 1, '2021-03-26 08:07:15', NULL),
(6, 'dasd', 'dasd', '/storage/uploads/12.jpg', NULL, NULL, 'dsdad', NULL, 12, NULL, 1, NULL, 'dasd', 23, 1, 1, 1, NULL, 1, '2021-03-26 08:55:10', NULL),
(7, 'dsad', 'dsad', '/storage/uploads/22.jpg', NULL, NULL, 'dasd', NULL, 12, NULL, 1, NULL, 'dsad', 32, 1, 1, 1, NULL, 1, '2021-03-26 08:56:22', NULL),
(8, 'dasdsa', 'dasdsadsadsa', '/storage/uploads/28.jpg', NULL, NULL, 'dsadasds', NULL, 12, NULL, 1, NULL, 'dasdsa', 23, 1, 0, 0, NULL, 1, '2021-03-26 09:12:44', NULL),
(10, 'dasd', 'dasdas', '/storage/uploads/21.jpg', NULL, NULL, 'dsadas', NULL, 12, NULL, 1, 12, 'dasd-1', 23, 0, 1, 1, NULL, 0, '2021-03-29 18:33:44', NULL),
(11, 'sdad', 'dasd', '/storage/uploads/9.jpg', NULL, NULL, 'dsad', NULL, 12, NULL, 1, 12, 'sdad', 23, 0, 1, 1, NULL, 0, '2021-03-29 18:33:55', NULL),
(12, 'test4', NULL, '/storage/uploads/24.jpg', NULL, 'C:\\xampp\\tmp\\phpB715.tmp', 'dsadas', NULL, 1, NULL, 1, NULL, 'test4', 3, 1, 1, 0, NULL, 0, '2021-03-31 08:48:45', NULL),
(13, 'dsadas', NULL, '/storage/uploads/16.jpg', NULL, 'C:\\xampp\\tmp\\php4CEF.tmp', 'dasda', NULL, 1, NULL, 1, NULL, 'dsadas', 3, 0, 1, 0, NULL, 0, '2021-03-31 09:00:18', NULL),
(14, 'tesat bg', NULL, '/storage/uploads/27.jpg', NULL, '/storage/uploads/13.jpg', 'dasd', NULL, 1, NULL, 1, NULL, 'tesat-bg', 32, 1, 1, 0, NULL, 0, '2021-03-31 09:02:12', NULL),
(15, 'test slug 1', NULL, '/storage/images/test-slug-1/test-slug-1.jpg', NULL, '/storage/images/test-slug-1/test-slug-1.jpg', 'dasdas', NULL, 1, NULL, 1, NULL, 'test-slug-1', 434, 1, 1, 1, NULL, 0, '2021-03-31 09:12:59', NULL),
(16, 'test 3', 'test 3', '/storage/images/test-3/test-3.jpg', NULL, '/storage/images/test-3/test-3.jpg', 'dasdsa', NULL, 1, NULL, 1, NULL, 'test-3', 42, 0, 1, 1, NULL, 0, '2021-03-31 09:14:48', NULL),
(17, 'dasdas', 'dasdas', '/storage/images/dasdas/dasdas.jpg', NULL, '/storage/images/dasdas/dasdas.jpg', 'dasdsa', NULL, 1, NULL, 1, NULL, 'dasdas', 32, 1, 1, 0, NULL, 0, '2021-03-31 09:33:38', NULL),
(18, 'dasda', 'dasd', '/storage/images/dasda/dasda.jpg', NULL, '/storage/images/dasda/dasda.jpg', 'dsad', NULL, 1, NULL, 1, NULL, 'dasda', 23, 1, 1, 0, NULL, 0, '2021-03-31 09:34:22', NULL),
(19, 'is free', 'dasd', '/storage/images/is-free/is-free.jpg', NULL, '/storage/images/is-free/is-free.jpg', 'dasd', NULL, 1, NULL, 1, NULL, 'is-free', 23, 1, 1, 0, NULL, 0, '2021-03-31 09:35:32', NULL),
(20, 'dasdas', 'dsadadasdas', '/storage/images/dasdas/dasdas.jpg', NULL, '/storage/images/dasdas/dasdas.jpg', 'dsad', 1, 2, NULL, 1, NULL, 'dasdas-1', 23, 1, 1, 0, NULL, 0, '2021-03-31 09:38:55', NULL),
(21, 'asdas', 'ddasd', '/storage/images/asdas/asdas.jpg', NULL, '/storage/images/asdas/asdas.jpg', 'dsa', 1, 1, NULL, 1, NULL, 'asdas', 23, 0, 1, 1, NULL, 0, '2021-03-31 09:40:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_category`
--

CREATE TABLE `movie_category` (
  `id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `movie_rating`
--

CREATE TABLE `movie_rating` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `movie_id` bigint(11) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `rating_point` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `movie_tag`
--

CREATE TABLE `movie_tag` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `movie_id` bigint(11) UNSIGNED NOT NULL,
  `tag_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `season`
--

CREATE TABLE `season` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `descripton` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image_url` text NOT NULL,
  `display_order` int(11) NOT NULL,
  `target_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `number_of_day` int(11) NOT NULL,
  `date_expired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `active`) VALUES
(1, 'van dat', 'mynameisdat6@gmail.com', '$2y$10$GIY0OVhfA55Yz4fAWd7U/ey1VzGidjiQzb7LVbcANSArTCTDhbZtO', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie_on_cate_id` (`category_id`);

--
-- Indexes for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_rating`
--
ALTER TABLE `movie_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_tag`
--
ALTER TABLE `movie_tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uni_movieId_tagId` (`movie_id`,`tag_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `episode`
--
ALTER TABLE `episode`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `movie_category`
--
ALTER TABLE `movie_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_rating`
--
ALTER TABLE `movie_rating`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_tag`
--
ALTER TABLE `movie_tag`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season`
--
ALTER TABLE `season`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
