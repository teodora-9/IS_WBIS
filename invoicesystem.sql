-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 02:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoicesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Connection issues'),
(2, 'Equipment issues'),
(3, 'Technical questions');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateUpdated` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `dateCreated`, `dateUpdated`, `name`, `address`, `number`, `email`, `description`, `active`) VALUES
(1, '2021-02-06', '0000-00-00', 'John', 'Bakiceva', '06246465', 'customer@custom.com', 'nestoooooooooooooo', 1),
(2, '2021-02-04', '0000-00-00', 'Necaa', 'Beograd', '013456', 'mail@mail.com', '', 0),
(3, '2021-02-06', '2021-02-06', 'Tea', 'Vozdovac', '645987515', 'tea@tea.com', '', 1),
(4, '2021-02-07', '2021-02-07', 'Nikola', 'Beograd', '385131', 'nikola@nikola.com', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateUpdated` date NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `dateCreated`, `dateUpdated`, `idUser`, `idCustomer`, `active`, `total`) VALUES
(1, '2021-02-06', '2021-02-06', 1, 1, 1, '800'),
(2, '2021-02-09', '2021-02-09', 1, 1, 1, '765'),
(3, '2021-01-10', '2021-02-10', 1, 1, 1, '200'),
(4, '2021-01-10', '2021-02-10', 1, 1, 1, '10'),
(5, '2020-03-10', '2021-02-10', 1, 1, 1, '25'),
(6, '2021-02-10', '2021-02-10', 1, 1, 1, '200');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateUpdated` date NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `idInvoice` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `dateCreated`, `dateUpdated`, `idProduct`, `quantity`, `idInvoice`, `active`) VALUES
(1, '2021-02-06', '2021-02-06', 2, '2', 1, 1),
(2, '2021-02-06', '2021-02-06', 2, '2', 1, 1),
(3, '2021-02-09', '2021-02-09', 4, '1', 2, 1),
(4, '2021-02-09', '2021-02-09', 4, '1', 2, 1),
(5, '2021-02-09', '2021-02-09', 3, '3', 2, 1),
(6, '2021-02-09', '2021-02-09', 6, '2', 2, 1),
(7, '2021-02-10', '2021-02-10', 2, '1', 3, 1),
(8, '2021-02-10', '2021-02-10', 3, '2', 4, 1),
(9, '2021-02-10', '2021-02-10', 6, '1', 5, 1),
(10, '2021-02-10', '2021-02-10', 2, '1', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateUpdated` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(45) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `dateCreated`, `dateUpdated`, `name`, `unit`, `price`, `description`, `active`) VALUES
(2, '2021-02-06', '2021-02-06', 'Laptopp', '22', '200', '', 1),
(3, '2021-02-06', '2021-02-06', 'Mouse', '3', '5', '', 0),
(4, '2021-02-06', '2021-02-06', 'Playstation 3', '150', '350', '', 1),
(5, '2021-02-06', '2021-02-06', 'Wii', '52', '250', '', 1),
(6, '2021-02-06', '2021-02-06', 'proizvod test', '2', '25', '', 0),
(7, '2021-02-07', '2021-02-07', 'Mfgsd', '10', '20', '', 0),
(8, '2021-02-07', '2021-02-07', 'gzd', '4', '10', '', 1),
(9, '2021-02-07', '2021-02-07', 'ku', '20', '100', '', 1),
(10, '2021-02-07', '2021-02-07', 'lhjl', '45', '21', '', 0),
(11, '2021-02-07', '2021-02-07', 'vkhu', '44', '25', '', 1),
(12, '2021-02-07', '2021-02-07', 'lkj', '10', '200', '', 1),
(13, '2021-02-07', '2021-02-07', 'vku', '25', '25', '', 0),
(14, '2021-02-09', '2021-02-09', 'Sony 2', '5', '50', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleName`, `active`) VALUES
(1, 'Korisnik', 1),
(2, 'Administrator', 1),
(3, 'SuperAdministrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstName`, `lastName`, `active`) VALUES
(1, 'admin@admin.com', '$2y$10$Fw4brhnIQfB2kGIZEQAlZO.T46Xlyy8e0SMLMX2qVRGS.qKFAsihC', 'Jovan', 'Zunic', 1),
(2, 'test@tesst.com', '$2y$10$tMgVNrCGNvshq/2B7f.KyednwHRdjo0nMLv7uQXccCcb0kvgiL/JK', 'Pera', 'Peric', 1),
(3, 'profil@profil.com', '$2y$10$n9q0WFmx7Xk5DD//xW9NBe8Vchizg2Ny/7dZav1J0rN6iRaLWcv.W', '', '', 1),
(4, 'mail@mail.com', '$2y$10$OS55iX4dtnVDVlT3z9eVHuCw5p3moekRgvBXrvcJANY5HDNuoVsFG', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `idRole` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `idRole`, `idUser`) VALUES
(1, 3, 1),
(2, 2, 2),
(3, 1, 3),
(4, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`) USING BTREE;

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role` (`idRole`),
  ADD KEY `fk_user` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
