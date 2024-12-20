-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 05:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ci_bsms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_code` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `category_code` int(11) NOT NULL,
  `price` int(25) NOT NULL,
  `book_img` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `writer` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_code`, `book_title`, `year`, `category_code`, `price`, `book_img`, `publisher`, `writer`, `stock`) VALUES
(1, 'Sample Book 101', 2018, 1, 350, 'book1.jpg', 'Publisher 1', 'Author 1 et. al.', 5),
(2, 'Sample Book 102', 2018, 2, 450, 'book2.jpg', 'Publisher 2', 'Author 2 et. al.', 9),
(3, 'Sample Book 103', 2020, 3, 750, 'book3.jpg', 'Publisher 3', 'Author 3 et. al.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `category_code` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`category_code`, `category_name`) VALUES
(1, 'Educational'),
(2, 'Fiction'),
(3, 'Fantasy'),
(4, 'Horror'),
(5, 'Sample 101');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_code` int(11) NOT NULL,
  `user_code` int(11) NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `bookname` varchar(255) NOT NULL,
  `book_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_code`, `user_code`, `buyer_name`, `total`, `tgl`, `bookname`, `book_qty`) VALUES
(1, 1, 'Customer 101', 450, '2022-10-11', 'Sample Book 102', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `transaction_code` int(11) NOT NULL,
  `book_code` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`transaction_code`, `book_code`, `amount`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_code` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_code`, `fullname`, `username`, `password`, `level`) VALUES
(1, 'Administrator', 'admin', '8d804a5c53b69a7342c5c3c7ddc5364d', 'admin'),
(2, 'Samantha Lou', 'sam', '56fafa8964024efa410773781a5f9e93', 'cashier'),
(3, 'Mark Cooper', 'mcooper', 'c7162ff89c647f444fcaa5c635dac8c3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_code`),
  ADD KEY `kode_kategori` (`category_code`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`category_code`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_code`),
  ADD KEY `kode_user` (`user_code`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD KEY `kode_transaksi` (`transaction_code`),
  ADD KEY `kode_buku` (`book_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`category_code`) REFERENCES `book_category` (`category_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`user_code`) REFERENCES `user` (`user_code`);

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_1` FOREIGN KEY (`transaction_code`) REFERENCES `transaction` (`transaction_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_2` FOREIGN KEY (`book_code`) REFERENCES `book` (`book_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
