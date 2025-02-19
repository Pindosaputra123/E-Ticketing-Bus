-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 01:42 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s900_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountNo` int NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `BirthDate` date NOT NULL,
  `AccountRole` varchar(50) NOT NULL DEFAULT 'User',
  `Nationality` varchar(50) NOT NULL DEFAULT 'Malaysia',
  `PhoneNumber` varchar(50) NOT NULL,
  `AccountTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountNo`, `FirstName`, `LastName`, `Email`, `Password`, `Gender`, `BirthDate`, `AccountRole`, `Nationality`, `PhoneNumber`, `AccountTimestamp`) VALUES
(1, 'Admin', 'Ganteng', 'admin@gmail.com', 'admin123', 'male', '1998-04-08', 'Admin', 'Indonesia', '08120987654321', '2025-02-18 13:34:35'),
(2, 'User', 'Ganteng', 'user@gmail.com', 'user123', 'male', '2004-04-09', 'User', 'Indonesia', '081234567890', '2025-02-18 13:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingNo` varchar(50) NOT NULL,
  `AccountNo` int NOT NULL,
  `PromoCode` varchar(50) DEFAULT NULL,
  `ScheduleNo` varchar(50) NOT NULL,
  `Quantity` int NOT NULL DEFAULT '1',
  `BusSeat` int NOT NULL,
  `BusDateTime` datetime NOT NULL,
  `PaymentNo` int NOT NULL,
  `BookingStatus` varchar(50) NOT NULL DEFAULT 'Completed',
  `BookingTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `BusNo` varchar(50) NOT NULL,
  `BusCompany` varchar(50) NOT NULL,
  `BusCapacity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`BusNo`, `BusCompany`, `BusCapacity`) VALUES
('001', 'Pindo Transport', 32),
('002', 'Pindo Transport', 32),
('003', 'Pindo Transport', 32);

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedule`
--

CREATE TABLE `bus_schedule` (
  `ScheduleNo` varchar(50) NOT NULL,
  `BusNo` varchar(50) NOT NULL,
  `ScheduleDepart` varchar(50) NOT NULL,
  `ScheduleArrive` varchar(50) NOT NULL,
  `ScheduleStartTime` time NOT NULL,
  `ScheduleDuration` int NOT NULL,
  `TicketPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bus_schedule`
--

INSERT INTO `bus_schedule` (`ScheduleNo`, `BusNo`, `ScheduleDepart`, `ScheduleArrive`, `ScheduleStartTime`, `ScheduleDuration`, `TicketPrice`) VALUES
('1', '001', 'Semarang‎', 'Serang‎', '16:00:00', 12, 350000),
('2', '002', 'Semarang‎', 'Karawang‎', '16:00:00', 12, 250000),
('3', '003', 'Serang‎', 'Semarang‎', '14:00:00', 12, 350000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentNo` int NOT NULL,
  `PaymentType` varchar(50) NOT NULL,
  `CardName` varchar(50) NOT NULL,
  `CardNumber` varchar(50) NOT NULL,
  `CardExpiration` varchar(50) NOT NULL,
  `CVV` int NOT NULL,
  `AccountNo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `PromoCode` varchar(50) NOT NULL,
  `ScheduleNo` varchar(50) NOT NULL,
  `PromoCodeDescription` varchar(50) NOT NULL,
  `PromoPercentage` int NOT NULL,
  `PromoCodeEndTimestamp` date NOT NULL,
  `PromoCodeStartTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`PromoCode`, `ScheduleNo`, `PromoCodeDescription`, `PromoPercentage`, `PromoCodeEndTimestamp`, `PromoCodeStartTimestamp`) VALUES
('2025', '2', 'Promo Khusus 2025', 10, '2025-12-31', '2024-12-31 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountNo`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingNo`),
  ADD KEY `AccountNo` (`AccountNo`),
  ADD KEY `PromoCode` (`PromoCode`),
  ADD KEY `ScheduleNo` (`ScheduleNo`),
  ADD KEY `PaymentNo` (`PaymentNo`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`BusNo`);

--
-- Indexes for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  ADD PRIMARY KEY (`ScheduleNo`),
  ADD KEY `BusNo` (`BusNo`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentNo`),
  ADD KEY `AccountNo` (`AccountNo`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`PromoCode`),
  ADD KEY `ScheduleNo` (`ScheduleNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountNo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentNo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`AccountNo`) REFERENCES `account` (`AccountNo`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`PromoCode`) REFERENCES `promo_code` (`PromoCode`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`ScheduleNo`) REFERENCES `bus_schedule` (`ScheduleNo`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`PaymentNo`) REFERENCES `payment` (`PaymentNo`);

--
-- Constraints for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  ADD CONSTRAINT `bus_schedule_ibfk_1` FOREIGN KEY (`BusNo`) REFERENCES `bus` (`BusNo`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`AccountNo`) REFERENCES `account` (`AccountNo`);

--
-- Constraints for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD CONSTRAINT `promo_code_ibfk_1` FOREIGN KEY (`ScheduleNo`) REFERENCES `bus_schedule` (`ScheduleNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
