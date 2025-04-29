-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 02:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalagency`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activityId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('order','project','subscription','system') DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `leadId` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `serviceInterested` varchar(100) DEFAULT NULL,
  `status` enum('new','contacted','converted','lost') DEFAULT 'new',
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`leadId`, `name`, `email`, `phone`, `serviceInterested`, `status`, `createdAt`) VALUES
(1, 'Emma Watson', 'emma@lead.com', '01711223344', 'Web Development', 'lost', '2025-04-28 12:07:39'),
(2, 'Chris Evans', 'chris@lead.com', '01712223355', 'SEO', 'contacted', '2025-04-28 12:07:39'),
(3, 'Scarlett Johansson', 'scarlett@lead.com', '01713323366', 'App Development', 'converted', '2025-04-28 12:07:39'),
(4, 'Tom Holland', 'tom@lead.com', '01714423377', 'Digital Marketing', 'new', '2025-04-28 12:07:39'),
(5, 'Zendaya Maree', 'zendaya@lead.com', '01715523388', 'Content Writing', 'lost', '2025-04-28 12:07:39'),
(6, 'Robert Downey', 'robert@lead.com', '01716623399', 'SEO', 'new', '2025-04-28 12:07:39'),
(7, 'Jennifer Lawrence', 'jennifer@lead.com', '01717723400', 'Design', 'contacted', '2025-04-28 12:07:39'),
(8, 'Ryan Reynolds', 'ryan@lead.com', '01718823411', 'Email Marketing', 'converted', '2025-04-28 12:07:39'),
(9, 'Gal Gadot', 'gal@lead.com', '01719923422', 'CRM Development', 'new', '2025-04-28 12:07:39'),
(10, 'Jason Momoa', 'jason@lead.com', '01710023433', 'Web Development', 'lost', '2025-04-28 12:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `orderType` enum('project','subscription','custom_service') DEFAULT NULL,
  `referenceId` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','paid','cancelled','refunded') DEFAULT 'pending',
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `orderType`, `referenceId`, `amount`, `status`, `createdAt`) VALUES
(1, 2, 'project', 1, 5000.00, 'paid', '2025-04-28 12:08:00'),
(2, 4, 'subscription', 1, 49.99, 'paid', '2025-04-28 12:08:00'),
(3, 5, 'project', 3, 12000.00, 'pending', '2025-04-28 12:08:00'),
(4, 6, 'subscription', 4, 299.99, 'paid', '2025-04-28 12:08:00'),
(5, 8, 'project', 5, 8000.00, 'paid', '2025-04-28 12:08:00'),
(6, 10, 'subscription', 6, 149.99, 'pending', '2025-04-28 12:08:00'),
(7, 11, 'project', 7, 1000.00, 'paid', '2025-04-28 12:08:00'),
(8, 12, 'subscription', 8, 299.99, 'cancelled', '2025-04-28 12:08:00'),
(9, 13, 'project', 9, 800.00, 'paid', '2025-04-28 12:08:00'),
(10, 14, 'subscription', 10, 149.99, 'paid', '2025-04-28 12:08:00'),
(11, 15, 'project', 10, 4000.00, 'pending', '2025-04-28 12:08:00'),
(12, 3, 'subscription', 11, 299.99, 'paid', '2025-04-28 12:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentId` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `paymentStatus` enum('pending','completed','failed') DEFAULT 'pending',
  `amount` decimal(10,2) DEFAULT NULL,
  `paidAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentId`, `orderId`, `paymentMethod`, `paymentStatus`, `amount`, `paidAt`, `createdAt`) VALUES
(1, 1, 'Credit Card', 'completed', 5000.00, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(2, 2, 'PayPal', 'completed', 49.99, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(3, 4, 'Stripe', 'completed', 299.99, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(4, 5, 'Bank Transfer', 'completed', 8000.00, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(5, 7, 'Credit Card', 'completed', 1000.00, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(6, 9, 'PayPal', 'completed', 800.00, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(7, 10, 'Stripe', 'completed', 149.99, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(8, 12, 'Credit Card', 'completed', 299.99, '2025-04-28 12:08:23', '2025-04-28 12:08:23'),
(9, 6, 'Stripe', 'pending', 149.99, NULL, '2025-04-28 12:08:23'),
(10, 11, 'Bank Transfer', 'pending', 4000.00, NULL, '2025-04-28 12:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `projectName` varchar(255) DEFAULT NULL,
  `projectType` varchar(100) DEFAULT NULL,
  `status` enum('new','in_progress','completed','on_hold') DEFAULT NULL,
  `budget` decimal(12,2) DEFAULT NULL,
  `progress` int(11) DEFAULT 0,
  `deadline` date DEFAULT NULL,
  `assignedTeam` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`assignedTeam`)),
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectId`, `userId`, `projectName`, `projectType`, `status`, `budget`, `progress`, `deadline`, `assignedTeam`, `createdAt`) VALUES
(1, 2, 'Website Redesign', 'Web Development', 'in_progress', 5000.00, 45, '2024-09-01', NULL, '2025-04-28 12:07:21'),
(2, 4, 'SEO Optimization', 'Digital Marketing', 'completed', 2000.00, 100, '2024-06-10', NULL, '2025-04-28 12:07:21'),
(3, 5, 'Mobile App Build', 'App Development', 'new', 12000.00, 10, '2024-12-31', NULL, '2025-04-28 12:07:21'),
(4, 6, 'Social Media Campaign', 'Marketing', 'on_hold', 3500.00, 25, '2024-11-01', NULL, '2025-04-28 12:07:21'),
(5, 8, 'E-commerce Site', 'Web Development', 'in_progress', 8000.00, 55, '2024-10-15', NULL, '2025-04-28 12:07:21'),
(6, 10, 'Logo & Branding', 'Design', 'completed', 1500.00, 100, '2024-05-20', NULL, '2025-04-28 12:07:21'),
(7, 11, 'Email Marketing Setup', 'Marketing', 'new', 1000.00, 5, '2024-08-01', NULL, '2025-04-28 12:07:21'),
(8, 12, 'Custom CRM System', 'Software Development', 'in_progress', 20000.00, 60, '2025-01-01', NULL, '2025-04-28 12:07:21'),
(9, 13, 'Landing Page', 'Web Development', 'completed', 800.00, 100, '2024-04-30', NULL, '2025-04-28 12:07:21'),
(10, 15, 'App UI/UX Design', 'Design', 'on_hold', 4000.00, 30, '2024-12-01', NULL, '2025-04-28 12:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscriptionId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `planName` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('active','pending','cancelled') DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `renewalDate` date DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscriptionId`, `userId`, `planName`, `price`, `status`, `startDate`, `endDate`, `renewalDate`, `features`, `createdAt`) VALUES
(1, 2, 'Starter Plan', 49.99, 'active', '2024-04-01', '2025-04-01', '2025-04-01', NULL, '2025-04-28 12:07:01'),
(2, 4, 'Business Plan', 149.99, 'active', '2024-02-15', '2025-02-15', '2025-02-15', NULL, '2025-04-28 12:07:01'),
(3, 5, 'Starter Plan', 49.99, 'pending', '2024-05-10', '2025-05-10', '2025-05-10', NULL, '2025-04-28 12:07:01'),
(4, 6, 'Premium Plan', 299.99, 'active', '2024-01-20', '2025-01-20', '2025-01-20', NULL, '2025-04-28 12:07:01'),
(5, 8, 'Starter Plan', 49.99, 'cancelled', '2023-12-01', '2024-12-01', '2024-12-01', NULL, '2025-04-28 12:07:01'),
(6, 10, 'Business Plan', 149.99, 'active', '2024-03-25', '2025-03-25', '2025-03-25', NULL, '2025-04-28 12:07:01'),
(7, 11, 'Starter Plan', 49.99, 'active', '2024-04-15', '2025-04-15', '2025-04-15', NULL, '2025-04-28 12:07:01'),
(8, 12, 'Premium Plan', 299.99, 'pending', '2024-06-05', '2025-06-05', '2025-06-05', NULL, '2025-04-28 12:07:01'),
(9, 13, 'Starter Plan', 49.99, 'active', '2024-02-10', '2025-02-10', '2025-02-10', NULL, '2025-04-28 12:07:01'),
(10, 14, 'Business Plan', 149.99, 'active', '2024-05-01', '2025-05-01', '2025-05-01', NULL, '2025-04-28 12:07:01'),
(11, 15, 'Starter Plan', 49.99, 'cancelled', '2023-11-20', '2024-11-20', '2024-11-20', NULL, '2025-04-28 12:07:01'),
(12, 3, 'Premium Plan', 299.99, 'active', '2024-01-01', '2025-01-01', '2025-01-01', NULL, '2025-04-28 12:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `system_backups`
--

CREATE TABLE `system_backups` (
  `backupId` int(11) NOT NULL,
  `backupFile` varchar(255) DEFAULT NULL,
  `backupDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userAltName` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `passwordHash` varchar(255) DEFAULT NULL,
  `role` enum('admin','client','manager') DEFAULT 'client',
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `lastLoginAt` datetime DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userAltName`, `name`, `userEmail`, `passwordHash`, `role`, `permissions`, `lastLoginAt`, `createdAt`, `updatedAt`) VALUES
(1, 'admin_ahad', 'Ahad Ul Amin', 'kaiidenaadhil@gmail.com', '$2y$10$LtIV4eNyYfK/aPKuVZM7tudDlGeRaYgbBUP4B4i1b2GbYlo5vD9EC', 'admin', NULL, '2025-04-28 12:44:59', '2025-04-28 12:06:42', '2025-04-28 12:44:59'),
(2, 'client_sara', 'Sara Khan', 'sara@client.com', 'hash_sara', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(3, 'manager_ali', 'Ali Hassan', 'ali@agency.com', 'hash_ali', 'manager', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(4, 'client_maria', 'Maria Lopez', 'maria@client.com', 'hash_maria', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(5, 'client_john', 'John Doe', 'john@client.com', 'hash_john', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(6, 'client_emily', 'Emily Stone', 'emily@client.com', 'hash_emily', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(7, 'admin_david', 'David Warner', 'david@agency.com', 'hash_david', 'admin', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(8, 'client_zoe', 'Zoe Clark', 'zoe@client.com', 'hash_zoe', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(9, 'manager_kamal', 'Kamal Uddin', 'kamal@agency.com', 'hash_kamal', 'manager', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(10, 'client_ryan', 'Ryan Smith', 'ryan@client.com', 'hash_ryan', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(11, 'client_hannah', 'Hannah Green', 'hannah@client.com', 'hash_hannah', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(12, 'client_oliver', 'Oliver Twist', 'oliver@client.com', 'hash_oliver', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(13, 'client_nora', 'Nora White', 'nora@client.com', 'hash_nora', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(14, 'admin_simon', 'Simon Peter', 'simon@agency.com', 'hash_simon', 'admin', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42'),
(15, 'client_lucas', 'Lucas Adams', 'lucas@client.com', 'hash_lucas', 'client', NULL, NULL, '2025-04-28 12:06:42', '2025-04-28 12:06:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`leadId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projectId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscriptionId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `system_backups`
--
ALTER TABLE `system_backups`
  ADD PRIMARY KEY (`backupId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userAltName` (`userAltName`),
  ADD UNIQUE KEY `email` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activityId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `leadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscriptionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system_backups`
--
ALTER TABLE `system_backups`
  MODIFY `backupId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
