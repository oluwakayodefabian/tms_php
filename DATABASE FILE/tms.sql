-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 06:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(5) NOT NULL,
  `property_assigned` int(5) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_type` enum('agent','super_admin') NOT NULL DEFAULT 'agent',
  `password` text NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `property_assigned`, `first_name`, `last_name`, `admin_email`, `admin_username`, `admin_type`, `password`, `unique_id`, `created_on`) VALUES
(1, NULL, 'Abdulkadri ', 'Zinat', 'oluwakayodefabian4@gmail.com', 'admin', 'super_admin', '$2y$10$h5gdAgLmQdtVVrC20Db0DOVhL1/C8EOKe3LgDU8ifdo7xALFzZmCC', '628f68e2da931PHdnBeq3FT1chgCE', '2022-05-26 12:40:30'),
(2, NULL, 'Oluwakayode', 'Fabian', 'oluwakayodefabian@gmail.com', 'oluwakayode', 'agent', '$2y$10$MHL6BBLOmZ8c5So5WtVSIebgUkwcNgy4Hqp/5RXuq0PGRBXfxXcV2', '628fb1ef01cbf8927572315f24506f9cd7501c67c13ad', '2022-05-27 01:40:30'),
(4, NULL, 'James', 'Brown', 'james@gmail.com', 'james', 'agent', '$2y$10$k70scD//6J0NdCbWgQDtge9rTnb6fqpvKfBHqR1mrlHWpzMeFpcZq', '62947cfb32e4e', '2022-05-30 09:14:51'),
(8, 9, 'Jerry', 'Gibson', 'jerry@gmail.com', 'jerry', 'agent', '$2y$10$84SvESFpf9xoisUfBfWteeWcn3dhy5Fbq4ZnlhIyJ5KvxI/KYiPyS', '62a4446ebab16', '2022-06-11 08:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `application_for_property`
--

CREATE TABLE `application_for_property` (
  `application_id` int(5) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `property_id` int(5) NOT NULL,
  `applicant_state` varchar(50) NOT NULL,
  `applicant_lga` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `applied_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_for_property`
--

INSERT INTO `application_for_property` (`application_id`, `first_name`, `last_name`, `gender`, `email`, `phone_no`, `property_id`, `applicant_state`, `applicant_lga`, `duration`, `applied_on`) VALUES
(1, 'Oluwakayode', 'Fabian', 'male', 'oluwakayodefabian@gmail.com', '2147483647', 5, 'Delta', 'Warri South', 1, '2022-06-08 20:05:53'),
(3, 'Jane', 'Joh', 'female', 'jane@gmail.com', '2147483647', 6, 'Anambra', 'Awka South', 2, '2022-06-10 07:52:59'),
(4, 'kayode', 'Daniels', 'male', 'daniels@gmail.com', '07062360433', 9, 'Cross River', 'Akamkpa', 1, '2022-06-11 08:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `property_id` int(5) NOT NULL,
  `complaint_title` varchar(100) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `tenant_id` int(5) NOT NULL,
  `tenant_fullname` varchar(200) NOT NULL,
  `response` varchar(200) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `response_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `id` int(5) NOT NULL,
  `admin_id` int(5) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`id`, `admin_id`, `agent`, `ip_address`, `login_time`, `logout_time`) VALUES
(24, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0', '127.0.0.1', '2022-06-06 12:35:18', '2022-06-06 13:19:47'),
(25, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0', '127.0.0.1', '2022-06-06 19:22:39', '2022-06-06 19:24:20'),
(26, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0', '127.0.0.1', '2022-06-06 19:26:23', '2022-06-06 19:33:29'),
(27, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:101.0) Gecko/20100101 Firefox/101.0', '127.0.0.1', '2022-06-06 19:47:24', '2022-06-06 19:48:23'),
(28, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-07 16:25:23', '2022-06-07 19:20:32'),
(29, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-08 17:26:19', '2022-06-08 17:46:22'),
(30, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-08 17:46:33', '2022-06-08 18:37:36'),
(31, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-09 07:13:20', '2022-06-09 18:04:55'),
(32, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-09 18:05:09', '2022-06-09 19:07:26'),
(33, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-10 07:03:51', '2022-06-10 07:38:57'),
(34, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-10 07:39:36', '2022-06-10 17:48:44'),
(35, 2, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-10 17:57:22', '2022-06-10 18:54:29'),
(36, 4, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-10 18:54:54', '2022-06-10 18:55:09'),
(37, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-10 18:55:29', '2022-06-10 18:59:41'),
(38, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-11 07:36:24', '2022-06-11 07:54:55'),
(39, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-11 08:01:06', '2022-06-11 08:24:13'),
(40, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-11 08:29:08', '2022-06-11 08:31:29'),
(41, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-11 08:37:53', '2022-06-11 08:39:19'),
(42, 8, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-11 08:59:51', '2022-06-11 09:14:12'),
(43, 8, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1', '2022-06-11 13:52:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(5) NOT NULL,
  `admin_id` int(5) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rent_amount` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `property_status` enum('vacant','occupied') NOT NULL DEFAULT 'vacant',
  `assigned_status` enum('not_assigned','assigned') NOT NULL DEFAULT 'not_assigned',
  `tenant_id` int(5) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `admin_id`, `country`, `state`, `city`, `address`, `description`, `rent_amount`, `image`, `property_status`, `assigned_status`, `tenant_id`, `created_on`) VALUES
(5, 4, 'Nigeria', 'Delta', 'Warri', 'no 28, Orisejafor street', 'This is a brief description on a particular property', '100000.00', 'uploads/house2.jpg', 'occupied', 'assigned', 4, '2022-06-08 18:32:02'),
(6, 2, 'Nigeria', 'Delta', 'Agbor', 'No 34, Okoh Street', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat perferendis recusandae eveniet, iusto porro id.', '50000.00', 'uploads/house3.jpg', 'vacant', 'assigned', NULL, '2022-06-08 18:36:19'),
(9, 8, 'Nigeria', 'Abuja', 'Maitama', 'no 2 Bryan street', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eaque.', '200000.00', 'uploads/house6.jpg', 'occupied', 'assigned', 5, '2022-06-11 08:30:41'),
(10, NULL, 'Nigeria', 'Delta', 'Warri', 'No 3 Ekerede Itsekiri', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eaque.', '100000.00', 'uploads/house4.jpg', 'vacant', 'not_assigned', NULL, '2022-06-11 08:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(5) NOT NULL,
  `property_id` int(5) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinytext NOT NULL,
  `state` tinytext NOT NULL,
  `lga` tinytext NOT NULL,
  `phone_no` tinytext NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `rent_starting_date` datetime DEFAULT NULL,
  `rent_ending_date` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `property_id`, `first_name`, `last_name`, `email`, `gender`, `state`, `lga`, `phone_no`, `amount_paid`, `unique_id`, `rent_starting_date`, `rent_ending_date`, `created_on`) VALUES
(4, 5, 'Oluwakayode', 'Fabian', 'oluwakayodefabian@gmail.com', 'male', 'Delta', 'Warri South', '2147483647', '100000.00', '62a363d24bf33', '2022-06-11 19:30:00', '2023-06-11 19:30:00', '2022-06-10 16:31:30'),
(5, 9, 'kayode', 'Daniels', 'daniels@gmail.com', 'male', 'Cross River', 'Akamkpa', '07062360433', '200000.00', '62a49029935fe', '2022-06-11 20:00:00', '2023-06-11 20:00:00', '2022-06-11 13:52:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`),
  ADD KEY `property_assigned` (`property_assigned`);

--
-- Indexes for table `application_for_property`
--
ALTER TABLE `application_for_property`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `application_for_property`
--
ALTER TABLE `application_for_property`
  MODIFY `application_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD CONSTRAINT `admin_users_ibfk_1` FOREIGN KEY (`property_assigned`) REFERENCES `properties` (`property_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD CONSTRAINT `login_activity_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`admin_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_ibfk_2` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
