-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2018 at 02:42 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `system_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `MachineId` varchar(255) NOT NULL,
  `SystemInformation_SystemManufacturer` varchar(255) NOT NULL DEFAULT '',
  `SystemInformation_Processor` varchar(255) NOT NULL DEFAULT '',
  `SystemInformation_Memory` varchar(255) NOT NULL DEFAULT '',
  `DisplayDevices_CardName` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`MachineId`);