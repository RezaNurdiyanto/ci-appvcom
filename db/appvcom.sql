-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 08:21 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appvcom`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Stock` ()  NO SQL
with cte as
	(Select h.salesno, h.salesdate, 'O' as salestype,
     i.plu_id, i.Description , (i.Qty * Case when h.SalesType='P' then 1 
     				when h.SalesType='S' then -1
     				else -1 end) as Qty 
        from salesheader h
     		 join salesitem i on h.SalesNo = i.SalesNo
    where h.salesdate < date(now())
    union ALL
    select h.salesno, h.salesdate, h.salestype,
    i.plu_id, i.Description, (i.Qty * Case when h.SalesType='P' then 1 
     				when h.SalesType='S' then -1
     				else -1 end) as Qty
    	from salesheader h 
    	join salesitem i on h.salesno = i.salesno 
    WHERE
    	h.salesdate = date(now())
    ), temp as(
    select 
    	c.plu_id, c.Description , 
        sum(Case when salesdate < date(now()) then Qty else 0 end) as Opening, 
        sum(Case when salesdate < date(now()) then 0
            when salestype ='S' then Qty
           else 0 end) as Sales,
         sum(Case when salesdate < date(now()) then 0
            when salestype='S' then 0
            when salestype='P' then Qty
            else 0 end) as Penerimaan,
         sum(Case when salesdate < date(now()) then 0 
            when salestype='S' then 0
            when salestype='P' then 0
            when salestype='R' then Qty
            else 0 end) as Retur,
        Sum(Qty) as TotQty
    from cte c
    Group By 
        c.plu_id, c.Description )
   select p.plu_id, p.Description,
   		  Opening, Sales, Penerimaan, Retur, TotQty
   	from plu p
    	 left join temp t on p.plu_id = t.plu_id
     Order BY
     	p.plu_id asc$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `plu_cat` int(11) NOT NULL,
  `Description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`plu_cat`, `Description`) VALUES
(13, 'FLASHDISK'),
(14, 'MOUSE'),
(15, 'MATHEBOARD'),
(17, 'CASING CPU');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-04-30-064911', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1588229692, 1),
(2, '2020-04-30-065104', 'App\\Database\\Migrations\\Products', 'default', 'App', 1588229693, 1),
(3, '2020-04-30-065243', 'App\\Database\\Migrations\\Transactions', 'default', 'App', 1588229693, 1),
(4, '2020-04-30-065359', 'App\\Database\\Migrations\\Users', 'default', 'App', 1588229694, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plu`
--

CREATE TABLE `plu` (
  `plu_id` varchar(25) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `Price` int(11) NOT NULL,
  `plu_cat` int(10) NOT NULL,
  `qr_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plu`
--

INSERT INTO `plu` (`plu_id`, `Description`, `satuan`, `Price`, `plu_cat`, `qr_code`) VALUES
('BR000001', 'USB SANDISK 4 GB', 'PCS', 50000, 13, 'BR000001.png'),
('BR000002', 'USB SANDISK 8 GB', 'PCS', 70000, 13, 'BR000002.png'),
('BR000003', 'USB SANDISK 16 GB', 'PCS', 90000, 13, 'BR000003.png'),
('BR000004', 'USB SANDISK 32 GB', 'PCS', 120000, 13, 'BR000004.png'),
('BR000005', 'MOUSE DELUX', 'PCS', 100000, 14, 'BR000005.png'),
('BR000006', 'MOUSE V-TORE', 'PCS', 30000, 14, 'BR000006.png');

-- --------------------------------------------------------

--
-- Table structure for table `salesheader`
--

CREATE TABLE `salesheader` (
  `SalesNo` varchar(20) NOT NULL,
  `SalesType` varchar(1) NOT NULL,
  `SalesDate` date NOT NULL,
  `total_jual` int(11) NOT NULL,
  `total_uang` int(11) NOT NULL,
  `total_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesheader`
--

INSERT INTO `salesheader` (`SalesNo`, `SalesType`, `SalesDate`, `total_jual`, `total_uang`, `total_kembali`) VALUES
('20200903000001', 'S', '2020-09-03', 50000, 50000, 0),
('20200903000002', 'P', '2020-09-03', 200000, 200000, 0),
('20200903000003', 'P', '2020-09-03', 130000, 500000, 370000),
('20200903000004', 'R', '2020-09-03', 200000, 200000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salesitem`
--

CREATE TABLE `salesitem` (
  `SalesNo` varchar(20) NOT NULL,
  `plu_id` varchar(10) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Uprice` int(11) NOT NULL,
  `NetPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesitem`
--

INSERT INTO `salesitem` (`SalesNo`, `plu_id`, `Description`, `Qty`, `Uprice`, `NetPrice`) VALUES
('20200903000001', 'BR000001', 'USB SANDISK 4 GB', 1, 50000, 50000),
('20200903000002', 'BR000005', 'MOUSE DELUX', 2, 100000, 200000),
('20200903000003', 'BR000006', 'MOUSE V-TORE', 2, 30000, 60000),
('20200903000003', 'BR000002', 'USB SANDISK 8 GB', 1, 70000, 70000),
('20200903000004', 'BR000002', 'USB SANDISK 8 GB', 1, 70000, 70000),
('20200903000004', 'BR000005', 'MOUSE DELUX', 1, 100000, 100000),
('20200903000004', 'BR000006', 'MOUSE V-TORE', 1, 30000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `status`) VALUES
(112, 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Active'),
(113, 'reza', 'reza', 'reza@gmail.com', 'bb98b1d0b523d5e783f931550d7702b6', 'Active'),
(114, 'tes', 'tes', 'tst@tst.com', '4d682ec4eed27c53849758bc13b6e179', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`plu_cat`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plu`
--
ALTER TABLE `plu`
  ADD PRIMARY KEY (`plu_id`);

--
-- Indexes for table `salesheader`
--
ALTER TABLE `salesheader`
  ADD PRIMARY KEY (`SalesNo`);

--
-- Indexes for table `salesitem`
--
ALTER TABLE `salesitem`
  ADD KEY `SalesNo` (`SalesNo`),
  ADD KEY `plu_id` (`plu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `plu_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salesitem`
--
ALTER TABLE `salesitem`
  ADD CONSTRAINT `salesitem_ibfk_2` FOREIGN KEY (`plu_id`) REFERENCES `plu` (`plu_id`),
  ADD CONSTRAINT `salesitem_ibfk_3` FOREIGN KEY (`plu_id`) REFERENCES `plu` (`plu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
