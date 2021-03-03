-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2018 at 06:27 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riana`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` char(30) NOT NULL,
  `password` char(50) NOT NULL,
  `level` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'kepala', 'kepala', 'kepala');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` char(10) NOT NULL,
  `id_pelanggan` char(20) NOT NULL,
  `tgl_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_pelanggan`, `tgl_order`) VALUES
('ACM-000001', 'PL01', '2018-02-08 21:43:31'),
('ACM-000002', 'PL02', '2018-02-08 21:59:04'),
('ACM-000003', 'PL03', '2018-02-08 22:24:21'),
('ACM-000004', 'PL08', '2018-02-09 17:22:38'),
('ACM-000005', 'PL07', '2018-02-09 17:29:39'),
('ACM-000006', 'PL01', '2018-02-18 22:25:47'),
('ACM-000007', 'PL01', '2018-08-27 22:15:02'),
('ACM-000008', 'PL01', '2018-08-27 22:22:20'),
('ACM-000009', 'PL02', '2018-08-27 22:24:42'),
('ACM-000010', 'PL02', '2018-08-27 22:25:58'),
('ACM-000011', 'PL02', '2018-08-27 22:31:31'),
('ACM-000012', 'PL02', '2018-08-27 22:39:12'),
('ACM-000013', 'PL01', '2018-08-27 22:44:00'),
('ACM-000014', 'PL01', '2018-08-27 22:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` char(10) NOT NULL,
  `id_order` char(10) NOT NULL,
  `id_produk` char(10) NOT NULL,
  `jumlah_produk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id_order_item`, `id_order`, `id_produk`, `jumlah_produk`) VALUES
('OID-000001', 'ACM-000001', 'PR15', 1),
('OID-000002', 'ACM-000001', 'PR11', 1),
('OID-000003', 'ACM-000002', 'PR04', 2),
('OID-000004', 'ACM-000002', 'PR18', 1),
('OID-000005', 'ACM-000003', 'PR11', 1),
('OID-000006', 'ACM-000003', 'PR09', 1),
('OID-000007', 'ACM-000004', 'PR05', 2),
('OID-000008', 'ACM-000005', 'PR24', 1),
('OID-000009', 'ACM-000005', 'PR18', 1),
('OID-000010', 'ACM-000005', 'PR15', 2),
('OID-000011', 'ACM-000005', 'PR22', 1),
('OID-000012', 'ACM-000005', 'PR23', 1),
('OID-000013', 'ACM-000006', 'PR09', 1),
('OID-000014', 'ACM-000006', 'PR19', 1),
('OID-000015', 'ACM-000006', 'PR03', 1),
('OID-000016', 'ACM-000006', 'PR28', 3),
('OID-000017', 'ACM-000007', 'PR04', 1),
('OID-000018', 'ACM-000008', 'PR07', 1),
('OID-000019', 'ACM-000009', 'PR05', 1),
('OID-000020', 'ACM-000010', 'PR09', 1),
('OID-000021', 'ACM-000011', 'PR12', 1),
('OID-000022', 'ACM-000012', 'PR17', 1),
('OID-000023', 'ACM-000013', 'PR16', 1),
('OID-000024', 'ACM-000014', 'PR17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` char(20) NOT NULL,
  `email` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `nama_pelanggan` varchar(80) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email`, `password`, `nama_pelanggan`, `alamat`, `nohp`) VALUES
('PL01', 'rsud.majalengka@yahoo.com', 'maja098', 'RSUD Majalengka', 'Jl. Kesehatan No. 77 Majalengka Wetan', '081321464138'),
('PL02', 'rsud45.kuningan@gmail.com', 'rs45kng', 'RSUD 45 Kuningan', 'Jl. Jend Sudirman No. 68 Kuningan', '081323005291'),
('PL03', 'rsud_linggajati@yahoo.co.id', 'linggajati18', 'RSUD Linggajati', 'Jl. Raya Bandorasa Wetan', '0232-614884'),
('PL04', 'rspelabuhan.crb@gmail.com', 'pelabuhan23', 'RS Pelabuhan', 'Jl. Sisingamangarja No.45', '0231-230024'),
('PL05', 'rsud.waledcrb@yahoo.co.id', 'waled4', 'RSUD Waled', 'Jl. Kesehatan No. 4 Waled Cirebon', '0231-662175'),
('PL06', 'sekarkamulyan.kng@yahoo.com', 'cigugur28', 'RS Sekar Kamulyan', 'Jl. Rumah Sakit No. 28 Cigugur Kuningan', '0232-645733'),
('PL07', 'rsciremai.45@gmail.com', 'ciremai48', 'RSAD Ciremai', 'Jl. Kesambi No. 237 Cirebon', '0231-201861'),
('PL08', 'apakrab19@gmail.com', 'akrabkng', 'Apotek Akrab', 'Jl. Jend Sudirman No. 19 Kuningan', '0232-871568');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` char(10) NOT NULL,
  `id_order` char(10) NOT NULL,
  `status` int(2) NOT NULL,
  `tgl_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_bayar`, `id_order`, `status`, `tgl_bayar`) VALUES
('PAY-000001', 'ACM-000001', 1, '2018-02-09 23:26:47'),
('PAY-000002', 'ACM-000002', 0, '0000-00-00 00:00:00'),
('PAY-000003', 'ACM-000003', 2, '0000-00-00 00:00:00'),
('PAY-000004', 'ACM-000004', 0, '0000-00-00 00:00:00'),
('PAY-000005', 'ACM-000005', 0, '0000-00-00 00:00:00'),
('PAY-000006', 'ACM-000006', 0, '0000-00-00 00:00:00'),
('PAY-000007', 'ACM-000007', 0, '0000-00-00 00:00:00'),
('PAY-000008', 'ACM-000008', 0, '0000-00-00 00:00:00'),
('PAY-000009', 'ACM-000009', 0, '0000-00-00 00:00:00'),
('PAY-000010', 'ACM-000010', 0, '0000-00-00 00:00:00'),
('PAY-000011', 'ACM-000011', 0, '0000-00-00 00:00:00'),
('PAY-000012', 'ACM-000012', 0, '0000-00-00 00:00:00'),
('PAY-000013', 'ACM-000013', 0, '0000-00-00 00:00:00'),
('PAY-000014', 'ACM-000014', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` char(10) NOT NULL,
  `nama_produk` char(50) NOT NULL,
  `harga` int(15) NOT NULL,
  `stok` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `foto` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `deskripsi`, `id_tipe`, `foto`) VALUES
('PR01', 'Vacutainer EDTA', 1321000, 7, '<p>Untuk kebutuhan penempatan sampel darah</p>\r\n', 2, '3.jpg'),
('PR02', 'HBsAg', 2432000, 10, '<p>Untuk mengecek penyakit hepatitis B</p>\r\n', 2, '2.jpg'),
('PR03', 'Parafilm', 2110000, 3, '', 2, 'parafilm.jpg'),
('PR04', 'CREATININE', 3800000, 0, '', 1, 'creatinine.jpg'),
('PR05', 'Arcus Diluent', 1810000, 3, '', 1, 'arcus dyluent.jpg'),
('PR06', 'Kartu Golongan Darah', 121000, 10, '', 2, '4.jpg'),
('PR07', 'Golongan Darah', 1207000, 7, '', 1, 'set gol darah.jpg'),
('PR08', 'Sarung Tangan', 106000, 5, '', 2, '1.jpg'),
('PR09', 'Total Protein', 4000000, 1, '', 1, 'total protein.jpg'),
('PR10', 'Uric Acid', 6000000, 2, '', 1, 'uric acid.jpg'),
('PR11', 'Cholesterol', 4213000, 2, '', 1, 'cholesterol.jpg'),
('PR12', 'HDL Cholesterol', 4671000, 1, '', 1, 'hdl cholesterol.jpg'),
('PR13', 'Paratyphi', 3206000, 3, '', 1, 'paratyphi.jpg'),
('PR15', 'Glucose', 3400000, 0, '', 1, 'glucose.jpg'),
('PR16', 'Albumin', 2200000, 3, '', 1, 'albumin.jpg'),
('PR17', 'Alkaline Phosphat', 5600000, 0, '', 1, 'alkaline phospat.jpg'),
('PR18', 'Triglycerides', 9000000, 1, '', 1, 'triglycerides.jpg'),
('PR19', 'Bilirubin Direct', 5600000, 1, '', 1, 'bilirubin direct.jpg'),
('PR20', 'Bilirubin Total', 5600000, 3, '', 1, 'bilirubin total.jpg'),
('PR21', 'Digital Timer', 156000, 7, '', 2, 'digital timer.jpg'),
('PR22', 'SGOT', 5600000, 3, '', 1, 'sgot.jpg'),
('PR23', 'SGPT', 5600000, 3, '', 1, 'sgpt.jpg'),
('PR24', 'Urea', 5600000, 2, '', 1, 'urea.jpg'),
('PR25', 'OK Plast', 18000, 13, '', 2, 'ok_plast.jpg'),
('PR26', 'Needle Flashback', 565000, 2, '', 2, 'needle flashback.jpg'),
('PR27', 'Thermal Printer 57x50', 6000, 10, '', 2, 'Thermall Paper 57x50.jpg'),
('PR28', 'Sample Cup Urine', 100000, 497, '', 2, 'sample cup urine.jpg'),
('PR29', 'Object Glass 7101 (Merah)', 30000, 4, '', 2, 'object glass merah.jpg'),
('PR30', 'Object Glass 7105 (Hijau)', 75000, 4, '', 2, 'object glass hijau.jpg'),
('PR31', 'Hematology Control', 6000000, 3, '', 1, 'Hematology Controls.jpg'),
('PR32', 'Blue Tip', 125000, 3, '', 2, 'blue tip.jpg'),
('PR33', 'Yellow Tip', 125000, 4, '', 2, 'yellow tip.jpg'),
('PR34', 'Pipet Pasteu', 96000, 12, '', 2, 'PIPET PASTEU.jpg'),
('PR35', 'Pot Feces', 130000, 2, '', 2, 'pot feces.jpg'),
('PR36', 'Tabung Reaksi', 350000, 10, '', 2, 'tabung reaksi.jpg'),
('PR37', 'Disposible 5cc BD', 415000, 5, '', 2, 'disposibble 5cc.jpg'),
('PR38', 'Disposible 3cc BD', 410000, 5, '', 2, 'disposibble 3cc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_produk`
--

CREATE TABLE `tipe_produk` (
  `id_tipe` int(11) NOT NULL,
  `nama_tipe` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_produk`
--

INSERT INTO `tipe_produk` (`id_tipe`, `nama_tipe`) VALUES
(1, 'Reagent'),
(2, 'Alat Disposible');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_tipe` (`id_tipe`);

--
-- Indexes for table `tipe_produk`
--
ALTER TABLE `tipe_produk`
  ADD PRIMARY KEY (`id_tipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipe_produk`
--
ALTER TABLE `tipe_produk`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_tipe`) REFERENCES `tipe_produk` (`id_tipe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
