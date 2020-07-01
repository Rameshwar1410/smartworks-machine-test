-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2020 at 11:05 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.3.19-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `smartWorks_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_lame` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `job` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `collage_name` varchar(100) DEFAULT NULL,
  `marks` float UNSIGNED DEFAULT NULL,
  `percentage` float UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;