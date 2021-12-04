-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 05:57 AM
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
-- Database: `final_projek_boris`
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
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(2) NOT NULL,
  `nama_bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'januari'),
(2, 'februari'),
(3, 'maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'november'),
(12, 'desember');

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
  `id_bulan` int(2) NOT NULL,
  `tanggal` int(2) NOT NULL,
  `deskripsi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `id_akun`, `debit`, `kredit`, `id_bulan`, `tanggal`, `deskripsi`) VALUES
(2, 111, 0, 1000, 1, 1, 'membayar karyawan'),
(17, 411, 1232, 0, 2, 3, ''),
(18, 411, 19999, 0, 2, 3, ''),
(21, 311, 45555, 0, 2, 5, ''),
(23, 112, 12000, 0, 5, 4, 'beli komputer'),
(24, 121, 123, 0, 9, 5, 'asdad'),
(25, 111, 1000, 0, 2, 13, ''),
(26, 111, 0, 2000, 2, 13, ''),
(27, 111, 13000, 0, 2, 2, 'tes'),
(28, 111, 0, 4000, 2, 6, ''),
(32, 514, 12121, 0, 5, 2, 'tes'),
(33, 115, 0, 99999, 5, 5, 'sss'),
(36, 211, 0, 90000, 12, 2, 'bayar pln'),
(37, 411, 2000, 0, 1, 1, 'coba');

-- --------------------------------------------------------

--
-- Table structure for table `kas_masjid`
--

CREATE TABLE `kas_masjid` (
  `id_km` int(11) NOT NULL,
  `tgl_km` date NOT NULL,
  `uraian_km` varchar(200) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kas_masjid`
--

INSERT INTO `kas_masjid` (`id_km`, `tgl_km`, `uraian_km`, `masuk`, `keluar`, `jenis`) VALUES
(1, '2021-11-23', 'beli TOA', 10, 5, 'masuk'),
(2, '2021-11-28', 'sumbangan orang', 5, 0, 'masuk');

-- --------------------------------------------------------

--
-- Table structure for table `kas_sosial`
--

CREATE TABLE `kas_sosial` (
  `id_ks` int(11) NOT NULL,
  `tgl_ks` date NOT NULL,
  `uraian_ks` varchar(200) NOT NULL,
  `masuk` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kas_sosial`
--

INSERT INTO `kas_sosial` (`id_ks`, `tgl_ks`, `uraian_ks`, `masuk`, `keluar`, `jenis`) VALUES
(1, '2021-11-10', 'santunan', 12, 6, 'keluar'),
(2, '2021-11-26', 'amal mushola', 100, 0, 'masuk');

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
  `id_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_tanaman`
--

INSERT INTO `penjualan_tanaman` (`id_penjualan_tanaman`, `id_tanaman`, `jumlah_pembelian`, `id_customer`) VALUES
(2, 1, 2, 11);

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
(1, 'melati', 11, 10, 5, 10000, 5000),
(2, 'mawar', 12, 6, 1, 12000, 10000),
(3, 'mawar', 11, 6, 5, 14000, 10000),
(5, 'adam hawa', 13, 120, 24, 100000, 80000),
(15, 'dandelion', 12, 20, 4, 50000, 120000),
(34, 'anggrek', 12, 20, 0, 20000, 10000),
(35, 'janda bolong', 13, 91, 0, 30000, 20000),
(36, 'janga kembang', 16, 111, 0, 1000, 2000),
(37, 'duda bolong', 16, 29, 0, 100000, 200000),
(38, 'duda bolong 2', 12, 10, 0, 1000000, 300000),
(39, 'mangga', 12, 76, 0, 1000, 2000);

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
(2, 'syn', 'syn', 'syn', 'Pegawai');

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
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

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
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_bulan` (`id_bulan`);

--
-- Indexes for table `kas_masjid`
--
ALTER TABLE `kas_masjid`
  ADD PRIMARY KEY (`id_km`);

--
-- Indexes for table `kas_sosial`
--
ALTER TABLE `kas_sosial`
  ADD PRIMARY KEY (`id_ks`);

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
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kas_masjid`
--
ALTER TABLE `kas_masjid`
  MODIFY `id_km` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kas_sosial`
--
ALTER TABLE `kas_sosial`
  MODIFY `id_ks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LOCATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penjualan_tanaman`
--
ALTER TABLE `penjualan_tanaman`
  MODIFY `id_penjualan_tanaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SUPPLIER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tanaman`
--
ALTER TABLE `tanaman`
  MODIFY `id_tanaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id_bulan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan_tanaman`
--
ALTER TABLE `penjualan_tanaman`
  ADD CONSTRAINT `penjualan_tanaman_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`CUST_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_tanaman_ibfk_2` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
