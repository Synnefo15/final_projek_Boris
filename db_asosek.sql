-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 04:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_asosek`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(3) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama_akun` varchar(40) NOT NULL,
  `keterangan` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `id_akun`, `nama_akun`, `keterangan`) VALUES
(1, 111, 'Kas', 1),
(2, 112, 'Piutang', 1),
(3, 116, 'Perlengkapan', 1),
(4, 121, 'Peralatan', 1),
(5, 122, 'Akumulasi Peralatan', 1),
(6, 211, 'Utang Usaha', 2),
(7, 311, 'Modal', 3),
(8, 312, 'Prive', 3),
(9, 411, 'Penjualan', 4),
(10, 511, 'Beban Gaji', 5),
(11, 512, 'Beban Sewa', 5),
(12, 513, 'Beban Penyusutan Peralatan', 5),
(13, 514, 'Beban Listrik', 2),
(14, 515, 'Beban Perlengkapan', 5),
(16, 115, 'persediaan', 1),
(17, 120, 'tanah', 1),
(18, 123, 'peralatan', 1),
(19, 124, 'akumulasi penyusutan-peralatan', 1),
(20, 313, 'iktisar laba rugi', 3),
(22, 212, 'Hutang gaji', 2),
(23, 516, 'beban air', 5),
(24, 517, 'beban internet', 5);

-- --------------------------------------------------------

--
-- Table structure for table `akun_keterangan`
--

CREATE TABLE `akun_keterangan` (
  `id_akun_keterangan` int(5) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_keterangan`
--

INSERT INTO `akun_keterangan` (`id_akun_keterangan`, `keterangan`) VALUES
(1, 'aset'),
(2, 'liabilitas'),
(3, 'ekuitas'),
(4, 'pendapatan'),
(5, 'beban');

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUST_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `PHONE_NUMBER` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUST_ID`, `FIRST_NAME`, `LAST_NAME`, `PHONE_NUMBER`) VALUES
(11, 'ivan', 'GUNAWAN', '123234'),
(14, 'mamad', 'junaedi', '08781633451'),
(16, 'sigit', 'yono', '0891344576'),
(19, 'panji', 'gilang', '930193849'),
(20, 'syta', 'ajak', '08123898237');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `debit` int(11) NOT NULL DEFAULT 0,
  `kredit` int(11) NOT NULL DEFAULT 0,
  `tgl` date DEFAULT NULL,
  `deskripsi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `id_akun`, `debit`, `kredit`, `tgl`, `deskripsi`) VALUES
(38, 123, 12000, 0, '2021-02-04', 'ambil pribadi'),
(39, 111, 0, 12000, '2021-02-04', 'ambil pribadi'),
(40, 120, 10000, 0, '2021-02-07', 'beli tanah di kota'),
(41, 111, 0, 10000, '2021-02-07', 'beli tanah di kota'),
(45, 111, 200000, 0, '2021-02-12', 'Penjualan bunga'),
(46, 411, 0, 200000, '2021-02-12', 'Penjualan bunga'),
(47, 111, 0, 10000, '2021-02-10', 'bayar listrik'),
(48, 514, 10000, 0, '2021-02-10', 'bayar listik'),
(52, 516, 30000, 0, '2021-02-02', 'bayar pdam'),
(53, 111, 0, 30000, '2021-02-02', 'bayar pdam'),
(54, 111, 60000, 0, '2021-02-16', 'Penjualan bunga'),
(55, 411, 0, 60000, '2021-02-16', 'Penjualan bunga'),
(56, 111, 0, 10000, '2021-01-02', 'bayar listrik'),
(57, 514, 10000, 0, '2021-01-02', 'bayar listrik'),
(58, 111, 70000, 0, '2021-12-10', 'Penjualan bunga'),
(59, 411, 0, 70000, '2021-12-10', 'Penjualan bunga'),
(60, 111, 70000, 0, '2021-06-15', 'Penjualan bunga'),
(61, 411, 0, 70000, '2021-06-15', 'Penjualan bunga');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LOCATION_ID` int(11) NOT NULL,
  `PROVINCE` varchar(100) DEFAULT NULL,
  `CITY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LOCATION_ID`, `PROVINCE`, `CITY`) VALUES
(1, 'JATIM', 'Probolinggo'),
(2, 'JATIM', 'Jember'),
(3, 'JATIM', 'Lumajang'),
(4, 'JATIM', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_tanaman`
--

CREATE TABLE `penjualan_tanaman` (
  `id_penjualan_tanaman` int(11) NOT NULL,
  `id_tanaman` int(11) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL DEFAULT current_timestamp(),
  `tgl_kirim` date NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_tanaman`
--

INSERT INTO `penjualan_tanaman` (`id_penjualan_tanaman`, `id_tanaman`, `jumlah_pembelian`, `id_customer`, `tgl_pesan`, `tgl_kirim`, `foto`) VALUES
(2, 1, 2, 11, '2021-12-01', '2021-12-04', 'rafi'),
(3, 2, 3, 14, '2021-12-01', '2021-12-14', NULL),
(4, 3, 3, 20, '2021-12-01', '2021-12-03', NULL),
(5, 5, 6, 14, '2021-10-07', '2021-12-09', NULL),
(6, 1, 5, 11, '2021-02-19', '2021-02-23', 'IMG_20200810_165904_1637251584401.jpg-socialbook-preview.png'),
(7, 1, 2, 14, '2021-02-02', '2021-02-06', 'LO.jpg'),
(8, 2, 5, 16, '2021-02-15', '2021-02-16', NULL),
(9, 3, 5, 14, '2021-11-08', '2021-12-10', NULL),
(10, 3, 5, 14, '2021-06-10', '2021-06-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `bulan` varchar(11) DEFAULT NULL,
  `debit` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo_debit` int(11) NOT NULL,
  `saldo_kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_akun`, `bulan`, `debit`, `kredit`, `saldo_debit`, `saldo_kredit`) VALUES
(131, 111, 'February', 260000, 62000, 198000, 0),
(132, 120, 'February', 10000, 0, 10000, 0),
(133, 123, 'February', 12000, 0, 12000, 0),
(134, 411, 'February', 0, 260000, 0, 260000),
(135, 514, 'February', 10000, 0, 10000, 0),
(136, 516, 'February', 30000, 0, 30000, 0),
(138, 111, 'January', 0, 10000, 0, 10000),
(139, 514, 'January', 10000, 0, 10000, 0),
(141, 111, 'June', 70000, 0, 70000, 0),
(142, 411, 'June', 0, 70000, 0, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SUPPLIER_ID` int(11) NOT NULL,
  `COMPANY_NAME` varchar(50) DEFAULT NULL,
  `LOCATION_ID` int(11) NOT NULL,
  `PHONE_NUMBER` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SUPPLIER_ID`, `COMPANY_NAME`, `LOCATION_ID`, `PHONE_NUMBER`) VALUES
(11, 'pak tono', 1, '09457488521'),
(12, 'baharudin floris', 2, '09635877412'),
(13, 'Razer Co.', 3, '09587855685'),
(16, 'Mamad florisissi', 1, '1232313'),
(20, 'JOJO abc', 4, '11122'),
(22, 'kmada', 2, '9381');

-- --------------------------------------------------------

--
-- Table structure for table `tanaman`
--

CREATE TABLE `tanaman` (
  `id_tanaman` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_supplier` int(3) NOT NULL,
  `stok_masuk` int(4) NOT NULL,
  `stok_keluar` int(4) NOT NULL DEFAULT 0,
  `harga_jual` int(11) NOT NULL,
  `harga_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanaman`
--

INSERT INTO `tanaman` (`id_tanaman`, `nama`, `id_supplier`, `stok_masuk`, `stok_keluar`, `harga_jual`, `harga_supplier`) VALUES
(1, 'melati putih', 11, 44, 24, 100000, 50000),
(2, 'mawar', 12, 16, 11, 12000, 10000),
(3, 'mawar', 11, 73, 38, 14000, 10000),
(5, 'adam hawa', 13, 120, 30, 100000, 80000),
(34, 'anggrek', 12, 40, 0, 20000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tanaman_masuk`
--

CREATE TABLE `tanaman_masuk` (
  `id` int(11) NOT NULL,
  `id_tanaman` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tanaman_masuk`
--

INSERT INTO `tanaman_masuk` (`id`, `id_tanaman`, `jumlah`, `tanggal`) VALUES
(3, 2, 10, '2021-12-01'),
(4, 34, 13, '2021-12-02'),
(5, 1, 7, '2021-11-25'),
(6, 1, 4, '2021-12-06'),
(7, 34, 7, '2021-09-08'),
(8, 1, 5, '2021-02-06'),
(9, 1, 5, '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('Administrator','Pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(1, 'rafi', 'rafi', 'rafi', 'Administrator'),
(2, 'syn', 'syn', 'syn', 'Pegawai'),
(3, 'ulya aaa', 'ulya', 'ulya', 'Pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`) USING BTREE,
  ADD KEY `keterangan` (`keterangan`);

--
-- Indexes for table `akun_keterangan`
--
ALTER TABLE `akun_keterangan`
  ADD PRIMARY KEY (`id_akun_keterangan`);

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUST_ID`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LOCATION_ID`);

--
-- Indexes for table `penjualan_tanaman`
--
ALTER TABLE `penjualan_tanaman`
  ADD PRIMARY KEY (`id_penjualan_tanaman`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_tanaman` (`id_tanaman`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SUPPLIER_ID`),
  ADD KEY `LOCATION_ID` (`LOCATION_ID`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id_tanaman`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `tanaman_masuk`
--
ALTER TABLE `tanaman_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tanaman` (`id_tanaman`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LOCATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penjualan_tanaman`
--
ALTER TABLE `penjualan_tanaman`
  MODIFY `id_penjualan_tanaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SUPPLIER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id_tanaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tanaman_masuk`
--
ALTER TABLE `tanaman_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti`
--
ALTER TABLE `bukti`
  ADD CONSTRAINT `bukti_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan_tanaman` (`id_penjualan_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan_tanaman`
--
ALTER TABLE `penjualan_tanaman`
  ADD CONSTRAINT `penjualan_tanaman_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`CUST_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_tanaman_ibfk_2` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`LOCATION_ID`) REFERENCES `location` (`LOCATION_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD CONSTRAINT `tanaman_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`SUPPLIER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tanaman_masuk`
--
ALTER TABLE `tanaman_masuk`
  ADD CONSTRAINT `tanaman_masuk_ibfk_1` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
