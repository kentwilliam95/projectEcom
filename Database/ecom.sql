-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 06:01 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `ID_CUSTOMER` varchar(10) NOT NULL,
  `NAMA_CUSTOMER` varchar(20) DEFAULT NULL,
  `PASSWORD` char(10) DEFAULT NULL,
  `ALAMAT_CUSTOMER` varchar(20) DEFAULT NULL,
  `GENDER` varchar(1) DEFAULT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `KOTA` varchar(10) DEFAULT NULL,
  `NEGARA` char(15) DEFAULT NULL,
  `KODE_POSTAL` varchar(6) DEFAULT NULL,
  `TELEPHON` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID_CUSTOMER`, `NAMA_CUSTOMER`, `PASSWORD`, `ALAMAT_CUSTOMER`, `GENDER`, `TANGGAL_LAHIR`, `KOTA`, `NEGARA`, `KODE_POSTAL`, `TELEPHON`) VALUES
('C0001', 'Kent William', 'William95', 'satelit utara', 'M', '2016-11-01', 'Surabaya', 'Indonesia', '12345', '082131978888'),
('C0002', 'brilly', 'brilliant5', 'jalan sultan', 'M', '2016-11-03', 'Jakarta', 'Indonesia', '12345', '8855220010'),
('C0003', 'budi', 'buidbuid', 'raya mboh', 'M', '2016-09-07', 'Bandung', 'Indonesia', '12345', '114477894532'),
('C0004', 'daniel', 'dandan1234', 'sukolilo', 'M', '2016-09-06', 'Surabaya', 'Indonesia', '12345', '12345689889'),
('C0005', 'kendra', 'kendra5555', 'menceng jaya', 'M', '2016-11-18', 'Madura', 'Indonesia', '12345', '56545613212'),
('C0006', 'hendra', 'hendra1234', 'kartini 5', 'M', '2016-09-07', 'Surabaya', 'Indonesia', '12345', '777444111235'),
('C0007', 'zakir', 'pusing4455', 'Menceng raya', 'M', '2016-11-01', 'Madura', 'Indonesia', '12345', '98799878787'),
('C0008', 'sanjaya', 'kertajaya', 'kertajaya indah', 'M', '2016-09-07', 'Surabaya', 'Indonesia', '12345', '84613287987'),
('C0009', 'Lukas', 'Lukas12345', 'DOLLI', 'M', '2016-09-06', 'Surabaya', 'Indonesia', '12345', '99999999910'),
('C0010', 'Fanuel H', 'HAHAHA96', 'Jalan doeloe', 'M', '2016-11-03', 'Malang', 'Indonesia', '12345', '1234567899');

-- --------------------------------------------------------

--
-- Table structure for table `djual`
--

CREATE TABLE IF NOT EXISTS `djual` (
  `IDDJUAL` varchar(10) NOT NULL,
  `ID_HJUAL` varchar(10) DEFAULT NULL,
  `ID_PRODUK` varchar(10) DEFAULT NULL,
  `NAMA_PRODUK` text,
  `HARGA_PRODUK` float DEFAULT NULL,
  `JUMLAH_PRODUK` float DEFAULT NULL,
  `TOTAL` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE IF NOT EXISTS `gambar` (
`ID_GAMBAR` int(11) NOT NULL,
  `ID_PRODUK` varchar(10) DEFAULT NULL,
  `NAMA_GAMBAR` varchar(200) DEFAULT NULL,
  `EXTENSI` varchar(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`ID_GAMBAR`, `ID_PRODUK`, `NAMA_GAMBAR`, `EXTENSI`) VALUES
(1, 'PRO0003', 'PRO00032.jpg', NULL),
(2, 'PRO0003', 'PRO00033.jpg', NULL),
(3, 'PRO0003', 'PRO00034.jpg', NULL),
(4, 'PRO0002', 'PRO0002.jpg', NULL),
(5, 'PRO0002', 'PRO0002.png', NULL),
(6, 'PRO0002', 'PRO00021.jpg', NULL),
(7, 'PRO0001', 'PRO00011.jpg', NULL),
(8, 'PRO0001', 'PRO00012.jpg', NULL),
(9, 'PRO0001', 'PRO00013.jpg', NULL),
(10, 'PRO0004', 'PRO0004.jpg', NULL),
(11, 'PRO0004', 'PRO00041.jpg', NULL),
(12, 'PRO0004', 'PRO00042.jpg', NULL),
(13, 'PRO0005', 'PRO0005.jpg', NULL),
(14, 'PRO0005', 'PRO00051.jpg', NULL),
(15, 'PRO0005', 'PRO00052.jpg', NULL),
(16, 'PRO0006', 'PRO0006.jpg', NULL),
(17, 'PRO0006', 'PRO00061.jpg', NULL),
(18, 'PRO0006', 'PRO00062.jpg', NULL),
(19, 'PRO0007', 'PRO0007.jpg', NULL),
(20, 'PRO0007', 'PRO00071.jpg', NULL),
(21, 'PRO0007', 'PRO00072.jpg', NULL),
(22, 'PRO0008', 'PRO0008.jpg', NULL),
(23, 'PRO0008', 'PRO00081.jpg', NULL),
(24, 'PRO0008', 'PRO00082.jpg', NULL),
(25, 'PRO0010', 'PRO0010.jpg', NULL),
(26, 'PRO0010', 'PRO00101.jpg', NULL),
(27, 'PRO0010', 'PRO00102.jpg', NULL),
(28, 'PRO0039', 'PRO0039.jpg', NULL),
(29, 'PRO0039', 'PRO00391.jpg', NULL),
(30, 'PRO0039', 'PRO00392.jpg', NULL),
(31, 'PRO0032', 'PRO0032.jpg', NULL),
(32, 'PRO0032', 'PRO00321.jpg', NULL),
(33, 'PRO0032', 'PRO00322.jpg', NULL),
(34, 'PRO0031', 'PRO0031.jpg', NULL),
(35, 'PRO0031', 'PRO00311.jpg', NULL),
(36, 'PRO0031', 'PRO00312.jpg', NULL),
(37, 'PRO0020', 'PRO0020.jpg', NULL),
(38, 'PRO0020', 'PRO00201.jpg', NULL),
(39, 'PRO0020', 'PRO00202.jpg', NULL),
(40, 'PRO0019', 'PRO0019.jpg', NULL),
(41, 'PRO0019', 'PRO00191.jpg', NULL),
(42, 'PRO0019', 'PRO00192.jpg', NULL),
(43, 'PRO0018', 'PRO0018.jpg', NULL),
(44, 'PRO0018', 'PRO00181.jpg', NULL),
(45, 'PRO0018', 'PRO00182.jpg', NULL),
(46, 'PRO0017', 'PRO0017.jpg', NULL),
(47, 'PRO0017', 'PRO0017.png', NULL),
(48, 'PRO0017', 'PRO00171.jpg', NULL),
(49, 'PRO0016', 'PRO0016.JPG', NULL),
(50, 'PRO0016', 'PRO0016.png', NULL),
(51, 'PRO0016', 'PRO00161.jpg', NULL),
(52, 'PRO0011', 'PRO0011.jpg', NULL),
(53, 'PRO0011', 'PRO00111.jpg', NULL),
(54, 'PRO0011', 'PRO00112.jpg', NULL),
(55, 'PRO0012', 'PRO0012.jpg', NULL),
(56, 'PRO0012', 'PRO00121.jpg', NULL),
(57, 'PRO0012', 'PRO00122.jpg', NULL),
(58, 'PRO0013', 'PRO0013.jpg', NULL),
(59, 'PRO0013', 'PRO00131.jpg', NULL),
(60, 'PRO0013', 'PRO0013.png', NULL),
(61, 'PRO0014', 'PRO0014.jpg', NULL),
(62, 'PRO0014', 'PRO0014.png', NULL),
(63, 'PRO0014', 'PRO00141.jpg', NULL),
(64, 'PRO0015', 'PRO0015.png', NULL),
(65, 'PRO0015', 'PRO0015.jpg', NULL),
(66, 'PRO0015', 'PRO00151.jpg', NULL),
(67, 'PRO0009', 'PRO0009.jpg', NULL),
(68, 'PRO0009', 'PRO00091.jpg', NULL),
(69, 'PRO0009', 'PRO00092.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hjual`
--

CREATE TABLE IF NOT EXISTS `hjual` (
  `ID_HJUAL` varchar(10) NOT NULL,
  `TOTAL` float DEFAULT NULL,
  `NO_SURATJALAN` varchar(12) DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hpromosi`
--

CREATE TABLE IF NOT EXISTS `hpromosi` (
  `IDHPROMOSI` varchar(10) NOT NULL,
  `NAMA_PROMOSI` varchar(100) DEFAULT NULL,
  `TGL_MULAI_PROMOSI` date DEFAULT NULL,
  `TGL_AKHIR_PROMOSI` date DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT NULL,
  `DESKRIPSI_PROMO` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hpromosi`
--

INSERT INTO `hpromosi` (`IDHPROMOSI`, `NAMA_PROMOSI`, `TGL_MULAI_PROMOSI`, `TGL_AKHIR_PROMOSI`, `STATUS`, `DESKRIPSI_PROMO`) VALUES
('HPR0001', 'golo2', '2016-11-30', '2016-12-03', 'Y', 'tatata');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `ID_PEGAWAI` varchar(10) NOT NULL,
  `NAMA_PEGAWAI` varchar(20) DEFAULT NULL,
  `PASSWORD` char(10) DEFAULT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `JENIS_KELAMIN` varchar(1) DEFAULT NULL,
  `PRIVILAGE` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_PEGAWAI`, `NAMA_PEGAWAI`, `PASSWORD`, `TANGGAL_LAHIR`, `JENIS_KELAMIN`, `PRIVILAGE`) VALUES
('P0001', 'Pwegan', 'pwe1234567', '2016-11-01', 'F', ''),
('P0002', 'znaz', '1122334455', '2016-09-07', 'M', ''),
('P0003', 'canir', 'canirazi25', '2016-11-02', 'F', ''),
('P0004', 'elgifor', 'elgifora95', '2016-11-01', 'F', ''),
('P0005', 'Hitler', 'nein95', '2016-11-07', 'M', '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `ID_PRODUK` varchar(10) NOT NULL,
  `NAMA_PRODUK` text,
  `HARGA_JUAL` float DEFAULT NULL,
  `MEREK_PRODUK` varchar(15) DEFAULT NULL,
  `STOK` varchar(3) DEFAULT NULL,
  `KETERANGAN` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID_PRODUK`, `NAMA_PRODUK`, `HARGA_JUAL`, `MEREK_PRODUK`, `STOK`, `KETERANGAN`) VALUES
('PRO0001', 'NUGGET AYAM', 6000, 'FIESTA', '10', 'Penjelasan Produk-Nuget Ayam Spesial Buatan Fiesta-sehat dan bergizi- low fat-bagus untuk makanan cepat saji-tinggi protein#Keterangan Produk-Berat:250g-expired Date:22 Oct 2016-BahanProduk: tepung, gula, merica, dan rempah-rempah'),
('PRO0002', 'GALAXY S6', 6500, 'SAMSUNG', '10', 'Penjelasan Produk-Handphone keluaran Samsung yang paling bagus,elgean, dan sexy. Batterai bisa bertahan sampai 1 minggu tanpa cas#Keterangan Produk-Berat:100g-Batterai:6000 MAH-Internet:4g/HSDPA/3.5G-casing:Besi dan Plastik-Sensor:Accelerometer & Gyro'),
('PRO0003', 'SUSU SAPI GREENFIELD PLAIN 1L', 23000, 'GREENFIELD', '10', 'Penjelasan Produk-Produk ini merupakan Susu terbaik dari Greenfield dan susunya alami terasa seperti di kandang greenfield ketika diminum#Keterangan Produk-Berat:1000g-expired Date:25 Oct 2016-BahanProduk: Susu dan pengawet lemah-tanggal Produksi:25 september 2016'),
('PRO0004', 'SUSU SAPI ULTRAMILK KOTAK', 5000, 'ULTRAMILK', '10', 'Penjelasan Produk-Susu sapi klasik dari ultramilk#Keterangan Produk-Berat:250g-expired Date:22 Oct 2016-BahanProduk: Susu, kakao, dan pemanis buatan-tanggal Produksi:22 september 2016'),
('PRO0005', 'AIR MINERAL', 7000, 'AQUA', '10', 'Penjelasan Produk-Air mineral dari gunung kakek bodo alami airnya 100%#Keterangan Produk-Berat:600g-expired Date:NONE-BahanProduk: Air Kakek Bodo'),
('PRO0006', 'PEPSI BLUE', 4000, 'PEPSI', '10', 'Penjelasan Produk-Produk dari Pepsi yang bernama Pepsi blue yang mempunyai sensai luarbiasa birunya dan dapat menghilangkan sakit kepala#Keterangan Produk-Berat:350g-expired Date:22 DEC 2016-BahanProduk: pemanis buatan, air soda, pewarna buatan dan sensasi'),
('PRO0007', 'BEDAK', 4000, 'ORIFLAME', '10', 'Penjelasan Produk-Produk bedan dari Oriflame yang dapat memercantik muka anda dalam sekali tebas#Keterangan Produk-Berat:50g-expired Date:NONE-BahanProduk: talk, magnesium silikat, vitamin E, dan bismuth oksiklorida'),
('PRO0008', 'LIPSTICK', 4000, 'ORIFLAME', '10', 'Penjelasan Produk-Produk sepesial lagi dari oriflame yaitu lipstik kecantikan bibir, dengan ini bibir anda akan berwana terang tanpa lampu#Keterangan Produk-Berat:20g-expired Date:None-BahanProduk: Neon, pewarna Buatan, Perasa, dan vitamin E'),
('PRO0009', 'MOBIL 1', 4000, 'HOTWHEELS', '10', 'Penjelasan Produk-Mobil ini adalah mobil pertama hotwheels yang bentuknya sangat istimewa dan sangat cepat dalam melaju di track #Keterangan Produk-Berat:50g-BahanProduk: plastik, besi, karet, dan tembaga-Dimensi: 6 x 18x 6.8"'),
('PRO0010', 'KAMEN RIDER', 8000, 'BANDAI', '10', 'Penjelasan Produk-Sebuah Action figure dari Bandai yaitu Kamen Rider yang telah di desain untuk anak-anak jaman sekarang ini mudah dipakai dan jangan sampai dimakan #Keterangan Produk-Berat:70g-BahanProduk: Besi, Plastik, Tembaga, Motor, dan panel-Dimensi Benda:7cm x10 cm x 3cm'),
('PRO0011', 'TUNA KALENG', 15000, 'KING FISHER', '10', ''),
('PRO0012', 'MESIN CUCI A', 15000, 'LG ', '10', ''),
('PRO0013', 'INDOMIE', 15000, 'INDOFOOD ', '10', ''),
('PRO0014', 'PASTO', 18000, 'LA FONTE', '10', ''),
('PRO0015', 'DEODORANT', 18000, 'REXONA', '10', ''),
('PRO0016', 'CHEETOS', 10000, 'INDOFOOD ', '10', ''),
('PRO0017', 'IPHONE 4', 10000, 'APPLE ', '10', ''),
('PRO0018', 'TV 21 I', 10000, 'SAMSUNG ', '10', ''),
('PRO0019', 'BARBIE', 13000, 'TOYR US ', '10', ''),
('PRO0020', 'ULTRAMAN', 13000, 'BANDAI ', '10', ''),
('PRO0031', 'sticker', 2000, 'paperclip', '100', ''),
('PRO0032', 'speaker', 150000, 'simbada', '10', ''),
('PRO0039', 'FlashDisk Data Traveler 64-32GB', 250000, 'Kingston', '15', 'Penjelasan Produk -Flash Disk ini Bersisi 32GB dan usb 3.0#\r\nKeterangan Produk-Besar:3cmX5cmX1CM-merek:Kingston-GB:32-Warna:Putih-Berat:15Gram#');

-- --------------------------------------------------------

--
-- Table structure for table `promosi`
--

CREATE TABLE IF NOT EXISTS `promosi` (
  `ID_DPROMOSI` varchar(11) NOT NULL,
  `ID_PRODUK` varchar(10) DEFAULT NULL,
  `IDHPROMOSI` varchar(10) DEFAULT NULL,
  `DISKON_PROMOSI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promosi`
--

INSERT INTO `promosi` (`ID_DPROMOSI`, `ID_PRODUK`, `IDHPROMOSI`, `DISKON_PROMOSI`) VALUES
('DPR0003', 'PRO0008', 'HPR0001', 20),
('DPR0004', 'PRO0012', 'HPR0001', 20),
('DPR0005', 'PRO0014', 'HPR0001', 20);

-- --------------------------------------------------------

--
-- Table structure for table `rincian_produk`
--

CREATE TABLE IF NOT EXISTS `rincian_produk` (
  `ID_RINCIAN` varchar(10) NOT NULL,
  `ID_PRODUK` varchar(10) DEFAULT NULL,
  `JENIS_PRODUK` varchar(10) DEFAULT NULL,
  `KATEGORI_PRODUK` varchar(10) DEFAULT NULL,
  `KELAS_PRODUK` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rincian_produk`
--

INSERT INTO `rincian_produk` (`ID_RINCIAN`, `ID_PRODUK`, `JENIS_PRODUK`, `KATEGORI_PRODUK`, `KELAS_PRODUK`) VALUES
('RIN0001', 'PRO0001', 'MAKANAN BE', 'MAKANAN', 'EDIBLE'),
('RIN0002', 'PRO0002', 'HP', 'ELEKTRONIK', 'INEDIBLE'),
('RIN0003', 'PRO0003', 'SUSU', 'MINUMAN', 'EDIBLE'),
('RIN0004', 'PRO0004', 'SUSU', 'MINUMAN', 'EDIBLE'),
('RIN0005', 'PRO0005', 'AIR', 'MINUMAN', 'EDIBLE'),
('RIN0006', 'PRO0006', 'SODA', 'MINUMAN', 'EDIBLE'),
('RIN0007', 'PRO0007', 'MAKE UP', 'KECANTIKAN', 'INEDIBLE'),
('RIN0008', 'PRO0008', 'MAKE UP', 'KECANTIKAN', 'INEDIBLE'),
('RIN0009', 'PRO0009', 'DIE CAST', 'TOYS', 'INEDIBLE'),
('RIN0010', 'PRO0010', 'ACTION FIG', 'TOYS', 'INEDIBLE'),
('RIN0011', 'PRO0011', 'MAKANAN KA', 'MAKANAN', 'EDIBLE'),
('RIN0012', 'PRO0012', 'MESIN CUCI', 'ELEKTRONIK', 'INEDIBLE'),
('RIN0013', 'PRO0013', 'MAKANAN IN', 'MAKANAN', 'EDIBLE'),
('RIN0014', 'PRO0014', 'MAKANAN IN', 'MAKANAN', 'EDIBLE'),
('RIN0015', 'PRO0015', 'PARFUM', 'KECANTIKAN', 'INEDIBLE'),
('RIN0016', 'PRO0016', 'SNACK', 'MAKANAN', 'EDIBLE'),
('RIN0017', 'PRO0017', 'HP', 'ELEKTRONIK', 'INEDIBLE'),
('RIN0018', 'PRO0018', 'TV', 'ELEKTRONIK', 'INEDIBLE'),
('RIN0019', 'PRO0019', 'BONEKA', 'TOYS', 'INEDIBLE'),
('RIN0020', 'PRO0020', 'ACTION FIG', 'TOYS', 'INEDIBLE');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `ID` varchar(10) NOT NULL,
  `ID_PRODUK` varchar(10) DEFAULT NULL,
  `ID_CUSTOMER` varchar(10) DEFAULT NULL,
  `JUMLAH` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE IF NOT EXISTS `voucher` (
  `ID_VOUCHER` varchar(10) NOT NULL,
  `NAMA_VOUCHER` varchar(25) DEFAULT NULL,
  `POTONGAN_HARGA` int(11) DEFAULT NULL,
  `EXP` date DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `ID_PRODUK` varchar(10) DEFAULT NULL,
  `ID_CUSTOMER` varchar(10) DEFAULT NULL,
  `ID_WISHLIST` varchar(10) DEFAULT NULL,
  `SESSIONID` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`ID_PRODUK`, `ID_CUSTOMER`, `ID_WISHLIST`, `SESSIONID`) VALUES
('PRO0001', NULL, 'FwY0ObIdHn', 'ZONd2E5hy4'),
(NULL, NULL, 'UramlUZWLB', 'ZONd2E5hy4'),
('PRO0012', NULL, '1EMVBWryfe', 'ZONd2E5hy4'),
('PRO0019', NULL, 'IMY7mZdIAY', 'ZONd2E5hy4'),
('PRO0011', NULL, 'RuVNxuRRwl', 'o9h7KtNsEc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`ID_CUSTOMER`);

--
-- Indexes for table `djual`
--
ALTER TABLE `djual`
 ADD PRIMARY KEY (`IDDJUAL`), ADD KEY `FK_RELATIONSHIP_5` (`ID_PRODUK`), ADD KEY `FK_RELATIONSHIP_6` (`ID_HJUAL`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
 ADD PRIMARY KEY (`ID_GAMBAR`), ADD KEY `FK_RELATIONSHIP_8` (`ID_PRODUK`);

--
-- Indexes for table `hjual`
--
ALTER TABLE `hjual`
 ADD PRIMARY KEY (`ID_HJUAL`);

--
-- Indexes for table `hpromosi`
--
ALTER TABLE `hpromosi`
 ADD PRIMARY KEY (`IDHPROMOSI`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`ID_PEGAWAI`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
 ADD PRIMARY KEY (`ID_PRODUK`);

--
-- Indexes for table `promosi`
--
ALTER TABLE `promosi`
 ADD PRIMARY KEY (`ID_DPROMOSI`), ADD KEY `FK_RELATIONSHIP_10` (`ID_PRODUK`), ADD KEY `FK_RELATIONSHIP_9` (`IDHPROMOSI`);

--
-- Indexes for table `rincian_produk`
--
ALTER TABLE `rincian_produk`
 ADD PRIMARY KEY (`ID_RINCIAN`), ADD KEY `FK_RELATIONSHIP_1` (`ID_PRODUK`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
 ADD PRIMARY KEY (`ID`), ADD KEY `FK_RELATIONSHIP_4` (`ID_PRODUK`), ADD KEY `FK_RELATIONSHIP_7` (`ID_CUSTOMER`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
 ADD PRIMARY KEY (`ID_VOUCHER`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
 ADD KEY `FK_RELATIONSHIP_2` (`ID_PRODUK`), ADD KEY `FK_RELATIONSHIP_3` (`ID_CUSTOMER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
MODIFY `ID_GAMBAR` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `djual`
--
ALTER TABLE `djual`
ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`ID_HJUAL`) REFERENCES `hjual` (`ID_HJUAL`);

--
-- Constraints for table `gambar`
--
ALTER TABLE `gambar`
ADD CONSTRAINT `FK_RELATIONSHIP_8` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`);

--
-- Constraints for table `promosi`
--
ALTER TABLE `promosi`
ADD CONSTRAINT `FK_RELATIONSHIP_10` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
ADD CONSTRAINT `FK_RELATIONSHIP_9` FOREIGN KEY (`IDHPROMOSI`) REFERENCES `hpromosi` (`IDHPROMOSI`);

--
-- Constraints for table `rincian_produk`
--
ALTER TABLE `rincian_produk`
ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
