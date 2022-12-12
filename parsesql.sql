-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10 Apr 2016 pada 07.27
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `parsesql`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`member_id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `gender` enum('M','W') NOT NULL DEFAULT 'M',
  `birth_day` date NOT NULL,
  `time_register` datetime NOT NULL,
  `time_login` datetime NOT NULL,
  `ip_login` varchar(40) NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`member_id`, `name`, `username`, `gender`, `birth_day`, `time_register`, `time_login`, `ip_login`, `block`, `active`) VALUES
(1, 'Kamshory, MT', 'kamshory', 'M', '1987-02-20', '2016-04-10 00:00:00', '2016-04-10 00:00:00', '199.188.72.74', 0, 1);

--
-- Trigger `member`
--
DELIMITER //
CREATE TRIGGER `after_delete_member` AFTER DELETE ON `member`
 FOR EACH ROW begin
delete from `phone` where `phone`.`member_id` = OLD.`member_id`;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `phone`
--

CREATE TABLE IF NOT EXISTS `phone` (
  `member_id` bigint(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `phone`
--

INSERT INTO `phone` (`member_id`, `phone`, `type`) VALUES
(1, '+6281277777778', 'M'),
(1, '+6285665355352', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `member_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
