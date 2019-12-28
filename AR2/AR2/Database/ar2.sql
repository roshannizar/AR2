-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 20, 2017 at 10:24 AM
-- Server version: 5.6.36
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ar2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billno` int(11) NOT NULL,
  `stockid` varchar(100) NOT NULL,
  `customerid` int(11) NOT NULL,
  `invoiceno` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `invoicedate` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `shopname` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactno1` bigint(20) NOT NULL,
  `contactno2` bigint(20) NOT NULL,
  `amountobepaid` float NOT NULL,
  `amountpaid` float NOT NULL,
  `lastdate` date NOT NULL,
  `paymentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `shopname`, `address`, `email`, `contactno1`, `contactno2`, `amountobepaid`, `amountpaid`, `lastdate`, `paymentdate`) VALUES
(2, 'Ahmed', 'Ahmed PVT LTD', 'Grandpass Colombo - 14', 'ahmed@gmail.com', 778542123, 751245789, 25000, 5000, '2017-11-30', '2017-12-02'),
(4, 'Sumba', 'Sumba Enterprise', 'kollupitiya Colombo - 07', 'sumba@yahoo.com', 778549123, 778541234, 1000, 200, '2017-01-01', '2017-01-01'),
(5, 'Lumala', 'lumala PVT LTD', 'bamba hehe', 'lumala123@gmail.com', 778542456, 724587456, 0, 0, '2017-01-01', '2017-01-01'),
(7, 'Dell', 'Dell', 'Colombo - 01', 'dell@dell.com', 778549123, 727875457, 0, 0, '2017-01-01', '2017-01-01'),
(8, 'Havlett Packard', 'HP', 'Colombo - 10', 'hp@gmail.com', 778541254, 777548682, 0, 0, '2017-01-01', '2017-01-01'),
(9, 'Cubic Raymond', 'Cubic', 'Colombo - 11', 'cubic@gmail.com', 751245369, 75456158, 0, 0, '2017-01-01', '2017-01-01'),
(10, 'Romer Rayan', 'Romer Rayan PVT LTD', 'Colombo - 12', 'rr@gmail.com', 778452367, 778541247, 0, 0, '2017-01-01', '2017-01-01'),
(11, 'Nawzath', 'Nawzath', 'applewatta', 'nawzath2@gmail.com', 778542456, 724587456, 0, 0, '2017-01-01', '2017-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesid` int(11) NOT NULL,
  `stockid` varchar(100) NOT NULL,
  `customerid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockid` varchar(100) NOT NULL,
  `stockname` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `stockname`, `description`, `supplierid`, `quantity`, `price`) VALUES
('x4001000', 'Oil Filter', 'Filters for all kinds of vehicles', 1, 45, 460);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierid` int(11) NOT NULL,
  `suppliername` varchar(100) NOT NULL,
  `shopname` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactno1` bigint(20) NOT NULL,
  `contactno2` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `suppliername`, `shopname`, `address`, `email`, `contactno1`, `contactno2`) VALUES
(1, 'Ahmed', 'Ahmed Enterprise', 'Kollupitiya', 'ahmed@gmail.com', 778964123, 112345456),
(2, 'Kumar', 'Alwin Stores', 'Maradana colombo - 10', 'alwinstores@gmail.com', 774521456, 774589654);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contactno` bigint(20) NOT NULL,
  `accountype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `username`, `email`, `password`, `contactno`, `accountype`) VALUES
('Asheef', 'Asudeen', 'asheef', 'asheef@gmail.com', 'asheef123', 772001913, 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billno`),
  ADD KEY `fk_bill_stockid` (`stockid`),
  ADD KEY `fk_bill_customerid` (`customerid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesid`),
  ADD KEY `fk_sales_stockid` (`stockid`),
  ADD KEY `fk_sales_customerid` (`customerid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockid`),
  ADD KEY `fk_stock_supplierid` (`supplierid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `billno` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_bill_customerid` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`),
  ADD CONSTRAINT `fk_bill_stockid` FOREIGN KEY (`stockid`) REFERENCES `stock` (`stockid`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_customerid` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`),
  ADD CONSTRAINT `fk_sales_stockid` FOREIGN KEY (`stockid`) REFERENCES `stock` (`stockid`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_supplierid` FOREIGN KEY (`supplierid`) REFERENCES `supplier` (`supplierid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
