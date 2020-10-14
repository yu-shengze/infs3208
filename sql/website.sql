-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2020 at 12:24 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `chipsets`
--

CREATE TABLE `chipsets` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chipsets`
--

INSERT INTO `chipsets` (`ID`, `name`, `details`) VALUES
(1, 'amd', 'AMD'),
(2, 'intel', 'Get PC-class performance at an affordable price point. Available in various sizes and packages, desktops with Intel® processors offer impressive media and graphic experiences to meet everyday computing requirements.');

-- --------------------------------------------------------

--
-- Table structure for table `config_steps`
--

CREATE TABLE `config_steps` (
  `ID` int(11) NOT NULL,
  `step_number` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(4096) NOT NULL,
  `heading` varchar(150) NOT NULL,
  `subheading` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_steps`
--

INSERT INTO `config_steps` (`ID`, `step_number`, `name`, `details`, `heading`, `subheading`) VALUES
(1, 1, 'chipset', 'Please select whether you wish to build an Intel or an AMD computer', 'First - Select Intel or AMD platform', ''),
(2, 2, 'motherboard', '', 'Next, Select a motherboard', 'Showing only <?php echo strtoupper($_SESSION[\'chipType\']); ?> motherboards'),
(3, 3, 'cpu', '', 'Now select a CPU', '');

-- --------------------------------------------------------

--
-- Table structure for table `cpus`
--

CREATE TABLE `cpus` (
  `ID` int(11) NOT NULL,
  `socket` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cpus`
--

INSERT INTO `cpus` (`ID`, `socket`, `name`, `details`) VALUES
(1, 'LGA 1151', 'Intel Core i5 9600K Processor', 'Essentials\r\nVertical SegmentDesktop\r\nProduct Collection9th Generation Intel® Core™ i5 Processors\r\nProcessor Number i5-9600K\r\nStatusLaunched\r\nLaunch Date Q4\'18\r\nLithography 14 nm\r\nIncluded ItemsPlease note: The boxed product does not include a fan or heat sink\r\nUse Conditions PC/Client/Tablet\r\nPerformance\r\n# of Cores 6\r\n# of Threads 6\r\nProcessor Base Frequency 3.70 GHz\r\nMax Turbo Frequency 4.60 GHz\r\nCache 9 MB Intel® Smart Cache\r\nBus Speed 8 GT/s\r\nTDP 95 W');

-- --------------------------------------------------------

--
-- Table structure for table `motherboards`
--

CREATE TABLE `motherboards` (
  `ID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `chipset` int(5) NOT NULL,
  `socket` varchar(10) NOT NULL,
  `details` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motherboards`
--

INSERT INTO `motherboards` (`ID`, `name`, `chipset`, `socket`, `details`) VALUES
(1, 'Asus PRIME B450M-K', 1, 'AM4', 'AMD AM4 mATX motherboard with LED lighting, DDR4 4400MHz, M.2, SATA 6Gbps and USB 3.1 Gen 2\r\nFan Xpert: Flexible controls for ultimate cooling and quietness.\r\n5X Protection III: Multiple hardware safeguards for all-round protection\r\nUltrafast connectivity: Supreme flexibility with USB 3.1 Gen 2, Native M.2\r\nLED illumination: Lighting control for both PCIe slot and audio trace paths'),
(2, 'Asus PRIME Z390M-PLUS', 2, 'LGA 1151', 'Intel LGA 1151 mATX motherboard with OptiMem II, DDR4 4266 MHz, Dual M.2, HDMI, Intel Optane memory ready, SATA 6Gb/s, USB 3.1 Gen 2\r\nOptiMem II: Careful routing of traces and vias, plus ground layer optimizations to preserve signal integrity for improved memory overclocking\r\nEnhanced power solution: Premium components provide better power efficiency\r\nUEFI BIOS: New UEFI options include a search function that allows you to find settings easily\r\nIndustry-leading cooling options: Comprehensive controls for fans and AIO pump, via Fan Xpert 4 or the acclaimed UEFI\r\nUltrafast connectivity: Dual native M.2 and NVMe PCIe RAID support for lightning-fast storage speeds\r\n5X Protection III: Multiple hardware safeguards for all-round protection'),
(3, 'Asus ROG STRIX Z390-F GAMING', 2, 'LGA 1151', ''),
(4, 'Gigabyte Z390 UD', 2, 'LGA 1151', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `current_step` int(11) NOT NULL,
  `chipset` varchar(5) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `motherboard` int(11) NOT NULL,
  `cpu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `current_step`, `chipset`, `firstName`, `motherboard`, `cpu`) VALUES
(1, 'fred', 'abc123', 4, '2', 'Fred', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chipsets`
--
ALTER TABLE `chipsets`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `config_steps`
--
ALTER TABLE `config_steps`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `stepNum` (`step_number`);

--
-- Indexes for table `cpus`
--
ALTER TABLE `cpus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `motherboards`
--
ALTER TABLE `motherboards`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chipsets`
--
ALTER TABLE `chipsets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config_steps`
--
ALTER TABLE `config_steps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cpus`
--
ALTER TABLE `cpus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `motherboards`
--
ALTER TABLE `motherboards`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
