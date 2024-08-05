-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 01:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweatlab`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `addLine1` varchar(100) NOT NULL,
  `addLine2` varchar(100) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `userName`, `email`, `password`, `gender`, `contactNo`, `addLine1`, `addLine2`, `postcode`, `city`, `state`, `country`, `status`) VALUES
(2, 'peh', 'peh@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$bmhKWGdveTlmU3pBQlVrLw$Kb1nHACjvmw6zkHE2udOWZ8KO6dDjqTfUMliy6scTw8', 'M', '', '', '', '', '', '', '', 'Active'),
(3, 'cypeh', 'choonyangpeh@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$NlhlS1l1aVJrUkV6QS5iUA$cJVHQZ9MPRoXzVdHc237H6uKiYYKnb0pk+5aMVpoO3Y', 'M', '0177384766', '', '', '', '', '', '', 'Active'),
(5, 'Lin', 'lim@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$WThHTW0yV0F2M01RZEQuLg$G05YPMPJWnIgl3Tv55FxezWugVlGBau8Ah8pzcU3Wig', 'F', '0123456789', '11 Solok Nenas', 'Taman Eng Sanga', '14001', 'BM', 'Selangor', 'Malaysia', 'Active'),
(7, 'peh0918', 'cypeh@gmail.com', '$argon2id$v=19$m=1024,t=2,p=2$N1RVS2FEUHlpMHM5YUU1eQ$Fvhy2pNPCCHF1fcf1q+gYDBZCRjIiqlxTY6iuf2eqcQ', 'M', '0177384766', '9 Solok Nenas', 'Taman Eng Seng', '14000', 'BM', 'Selangor', 'Malaysia', 'Active'),
(8, 'Vincent', 'xiaoke@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NG5ab3pnNU44am1lQVRGeg$d4rBlZJNTqo2jo6GENcViTYcLCWitlUfGHSSsAJ31cg', 'M', '0175942833', '123 taman abc', 'jalan abc', '05050', 'alor setar', 'Kedah', 'Malaysia', 'Active'),
(9, 'peh', 'choonyangpeh123@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VFE4bWJLR0dHTWc4cWNONg$PvWYeq+V0M655poTg3B1AKu/M0VYk8A2bCUz80DWysk', 'M', '', '', '', '', '', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `custorder`
--

CREATE TABLE `custorder` (
  `orderID` int(11) NOT NULL,
  `orderStatus` varchar(30) NOT NULL,
  `custID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `custorder`
--

INSERT INTO `custorder` (`orderID`, `orderStatus`, `custID`) VALUES
(1, 'Order Received', 4),
(2, 'Order Received', 4),
(3, 'Order Received', 4),
(4, 'Order Received', 4),
(5, 'Order Received', 0),
(6, 'Order Received', 7),
(7, 'Order Received', 7),
(8, 'Order Received', 7),
(9, 'Order Received', 7),
(10, 'Order Received', 7),
(11, 'Order Received', 7),
(12, 'Order Received', 7),
(13, 'Order Received', 8),
(14, 'Order Received', 8),
(15, 'Order Received', 8),
(16, 'Order Received', 3),
(17, 'Order Received', 8),
(18, 'Order Received', 8),
(19, 'Order Received', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `orderTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`, `productQuantity`, `orderDate`, `orderTime`) VALUES
(2, 7, 4, '2023-04-23', '20:33:21'),
(2, 8, 4, '2023-04-23', '20:33:21'),
(2, 9, 5, '2023-04-23', '20:33:21'),
(3, 9, 7, '2023-04-23', '20:37:37'),
(3, 11, 4, '2023-04-23', '20:37:37'),
(4, 7, 1, '2023-04-23', '20:40:28'),
(4, 11, 2, '2023-04-23', '20:40:28'),
(4, 10, 1, '2023-04-23', '20:40:28'),
(5, 7, 4, '2023-05-05', '13:01:45'),
(6, 7, 3, '2023-05-05', '13:38:05'),
(7, 7, 3, '2023-05-05', '13:38:16'),
(8, 9, 1, '2023-05-05', '13:39:30'),
(8, 13, 5, '2023-05-05', '13:39:30'),
(9, 7, 3, '2023-05-05', '13:41:17'),
(9, 8, 3, '2023-05-05', '13:41:17'),
(9, 9, 2, '2023-05-05', '13:41:17'),
(10, 7, 1, '2023-05-05', '15:15:44'),
(10, 9, 3, '2023-05-05', '15:15:44'),
(10, 8, 4, '2023-05-05', '15:15:44'),
(11, 7, 3, '2023-05-05', '15:15:59'),
(11, 10, 2, '2023-05-05', '15:15:59'),
(11, 8, 3, '2023-05-05', '15:15:59'),
(12, 7, 3, '2023-05-05', '15:16:10'),
(12, 9, 6, '2023-05-05', '15:16:10'),
(13, 46, 1, '2023-05-09', '16:32:35'),
(14, 46, 4, '2023-05-09', '20:16:05'),
(15, 49, 1, '2023-05-11', '10:32:08'),
(17, 50, 6, '2023-05-12', '12:36:57'),
(18, 50, 10, '2023-05-12', '12:40:20'),
(19, 50, 1002, '2023-05-12', '12:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL,
  `paymentAmount` double NOT NULL,
  `paymentMethod` varchar(30) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentTime` time NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `paymentAmount`, `paymentMethod`, `paymentDate`, `paymentTime`, `orderID`) VALUES
(1, 682.52, 'Online Banking', '2023-05-05', '13:41:17', 9),
(2, 912.03, 'Online Banking', '2023-05-05', '15:15:44', 10),
(3, 681.5, 'Online Banking', '2023-05-05', '15:15:59', 11),
(4, 634.56, 'Online Banking', '2023-05-05', '15:16:10', 12),
(5, 100, 'Online Banking', '2023-05-09', '16:32:35', 13),
(6, 400, 'Online Banking', '2023-05-09', '20:16:05', 14),
(7, 69, 'Online Banking', '2023-05-11', '10:32:08', 15),
(8, 0, 'Online Banking', '2023-05-11', '20:44:35', 16),
(9, 41814, 'Online Banking', '2023-05-12', '12:36:57', 17),
(10, 69690, 'Online Banking', '2023-05-12', '12:40:20', 18),
(11, 6982938, 'Online Banking', '2023-05-12', '12:40:43', 19);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` double NOT NULL,
  `productDesc` varchar(200) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `productImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productPrice`, `productDesc`, `stockQuantity`, `productImage`) VALUES
(46, 'Basketball ', 100, '678', 1001, '../ProductImages/OIP.png'),
(47, 'Football ', 100, '100', 1001, '../ProductImages/download.png'),
(48, 'Shuttlecock', 89, 'Shuttlecock\r\n', 500, '../ProductImages/shuttlecock.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `contactNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `email`, `password`, `gender`, `contactNo`) VALUES
(15, 'Wong', 'wong@gmail.com', '$argon2i$v=19$m=1024,t=2,p=2$dU82V0l6UjJzZy54QmszMA$bP3roJ5DvwXUe6XJChNJwf8TyVgaeQ78Oa7LDvcKYVc', 'M', '0177384766'),
(19, 'Hei', 'heh@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WU9rZmpjZEFtSlZvN0wxSA$tZKVw5gVWZuPHK/Clpad8qeY318pz3BhoQvscPRqSJM', 'F', '0175942834'),
(21, 'Andrew', 'a@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WDdRbFk3bmtpaDlobGNLMw$jKXc9/okmGkFAWCw0SgsQVyRoR7ySuIapMWe74SAXmM', 'M', '0175942833');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`name`) VALUES
('hello'),
('hello'),
('hello'),
('hello');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `custorder`
--
ALTER TABLE `custorder`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `custorder`
--
ALTER TABLE `custorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
