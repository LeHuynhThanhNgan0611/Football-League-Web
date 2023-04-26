-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 12, 2022 lúc 10:09 AM
-- Phiên bản máy phục vụ: 5.7.31
-- Phiên bản PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `userlogin`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activated` bit(1) NOT NULL,
  `activate_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `firstname`, `lastname`, `email`, `password`, `activated`, `activate_token`, `position`) VALUES
('luanne', 'luan', 'ne', 'luansuunhi2002@gmail.com', '$2y$10$X0vuC/iexmKFtYNplY1xlexAMAn/BjVZFzVtq9/zYwvxlBYdHN/WW', b'1', 'EziI4miUFg', 3),
('luanvo', 'luan', 'vo', 'dongsn8@gmaill.com', '$2y$10$UyZNK4XFTnXk.yeoNjwtAuD.bDNVecd5JmCL4dvVdKPL5pPQEhsYy', b'1', 'tVVMgqpykB', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocao`
--

DROP TABLE IF EXISTS `baocao`;
CREATE TABLE IF NOT EXISTS `baocao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `content` text COLLATE utf8_vietnamese_ci NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `baocao`
--

INSERT INTO `baocao` (`id`, `user`, `title`, `content`, `date`) VALUES
(3, 'luanne', '231', 'dw1d1wrft1f1ef', '2022-12-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `idhd` int(11) NOT NULL AUTO_INCREMENT,
  `accname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `hoten` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `sdt` char(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `pid` char(12) COLLATE utf8_vietnamese_ci NOT NULL,
  `cateve` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `phuongthuc` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `idmatch` int(11) NOT NULL,
  PRIMARY KEY (`idhd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`idhd`, `accname`, `hoten`, `sdt`, `pid`, `cateve`, `soluong`, `phuongthuc`, `idmatch`) VALUES
(1, 'luanne', '11e', '214', '2141', 'vethuong', 2, 'thetindung', 1),
(2, 'luanne', '214', '2141', '214', 'vethuong', 1, 'thetindung', 1),
(3, 'luanne', '2341', '213', '42141', 'vethuong', 1, 'thetindung', 1),
(4, 'luanne', '12412', '13', '241', 'vevip', 5, 'paypal', 1),
(5, 'luanne', '4214', '4214', '2412', 'vevip', 5, 'paypal', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bxh`
--

DROP TABLE IF EXISTS `bxh`;
CREATE TABLE IF NOT EXISTS `bxh` (
  `teamname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `win` int(11) NOT NULL DEFAULT '0',
  `draw` int(11) NOT NULL DEFAULT '0',
  `lose` int(11) NOT NULL DEFAULT '0',
  `pt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`teamname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bxh`
--

INSERT INTO `bxh` (`teamname`, `win`, `draw`, `lose`, `pt`) VALUES
('17893e1', 0, 0, 0, 0),
('cuchifc', 0, 0, 0, 0),
('haloifc', 0, 0, 0, 0),
('luan', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cauthu`
--

DROP TABLE IF EXISTS `cauthu`;
CREATE TABLE IF NOT EXISTS `cauthu` (
  `idct` int(11) NOT NULL AUTO_INCREMENT,
  `vitri` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `ctname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `birthday` date NOT NULL,
  `nationality` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `idteam` int(11) NOT NULL,
  PRIMARY KEY (`idct`,`idteam`),
  KEY `fk_cauthu_thongtindoi` (`idteam`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cauthu`
--

INSERT INTO `cauthu` (`idct`, `vitri`, `ctname`, `birthday`, `nationality`, `idteam`) VALUES
(25, 'Tiá»n vá»‡', 'hihi', '2022-12-14', 'fffaaaaxxxxx', 33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichthidau`
--

DROP TABLE IF EXISTS `lichthidau`;
CREATE TABLE IF NOT EXISTS `lichthidau` (
  `idmatch` int(11) NOT NULL AUTO_INCREMENT,
  `idhome` int(11) NOT NULL,
  `homename` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `idaway` int(11) NOT NULL,
  `awayname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `homegoal` int(11) NOT NULL,
  `awaygoal` int(11) NOT NULL,
  `matchdate` date NOT NULL,
  `status` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'Chưa thi đấu',
  `ve` bit(1) NOT NULL,
  PRIMARY KEY (`idmatch`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lichthidau`
--

INSERT INTO `lichthidau` (`idmatch`, `idhome`, `homename`, `idaway`, `awayname`, `homegoal`, `awaygoal`, `matchdate`, `status`, `ve`) VALUES
(1, 33, 'luan', 34, 'haloifc', 0, 0, '2022-12-06', 'ChÆ°a thi Ä‘áº¥u', b'1'),
(2, 35, '17893e1', 34, 'haloifc', 0, 0, '2022-11-30', 'ChÆ°a thi Ä‘áº¥u', b'1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `soluongve`
--

DROP TABLE IF EXISTS `soluongve`;
CREATE TABLE IF NOT EXISTS `soluongve` (
  `idmatch` int(11) NOT NULL,
  `vethuong` int(11) NOT NULL,
  `vevip` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`idmatch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `soluongve`
--

INSERT INTO `soluongve` (`idmatch`, `vethuong`, `vevip`, `status`) VALUES
(1, 21, 2, 'Äang bÃ¡n'),
(2, 84, 26, 'Dá»«ng bÃ¡n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtindoi`
--

DROP TABLE IF EXISTS `thongtindoi`;
CREATE TABLE IF NOT EXISTS `thongtindoi` (
  `idteam` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `hlvname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `img` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  PRIMARY KEY (`idteam`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtindoi`
--

INSERT INTO `thongtindoi` (`idteam`, `teamname`, `hlvname`, `img`) VALUES
(33, 'luan', 'luanminh', '639460950e0f39.13511113.png'),
(34, 'haloifc', 'd1312', '639460a8947676.30991039.png'),
(35, '17893e1', '124e', '639460c2a151d7.73885192.png'),
(36, 'cuchifc', '241', '639462f8dac284.97983705.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
