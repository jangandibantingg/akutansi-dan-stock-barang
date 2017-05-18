-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2015 at 09:29 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_akutansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `arus_kas`
--

CREATE TABLE IF NOT EXISTS `arus_kas` (
  `id_arus_kas` int(11) NOT NULL AUTO_INCREMENT,
  `id_master` int(11) NOT NULL,
  `id_submaster` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_arus_kas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `arus_kas`
--

INSERT INTO `arus_kas` (`id_arus_kas`, `id_master`, `id_submaster`, `tanggal`) VALUES
(6, 11, 10, '2015-10-26'),
(8, 11, 9, '2015-10-26'),
(9, 11, 12, '2015-10-26'),
(10, 11, 6, '2015-10-26'),
(11, 11, 3, '2015-10-26'),
(12, 12, 16, '2015-10-26'),
(13, 12, 18, '2015-10-26'),
(14, 13, 7, '2015-10-26'),
(15, 13, 14, '2015-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `id_bank` int(122) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(122) NOT NULL,
  `atas_nama` varchar(122) NOT NULL,
  `norek` varchar(122) NOT NULL,
  `gambar` varchar(12) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id_bank`, `nama_bank`, `atas_nama`, `norek`, `gambar`) VALUES
(2, 'BCA      ', 'NURHUDA       ', '2250626625      ', 'BCA.png'),
(10, 'BRI  ', 'nurhuda  ', '350901004190533  ', 'BRI.png');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(122) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(122) NOT NULL,
  `harga` int(122) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `harga_beli` int(122) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `satuan`, `harga`, `id_gudang`, `id_suplier`, `id_jenis`, `harga_beli`, `harga_jual`) VALUES
(10, 'nasi kucing', 0, 'pcs', 0, 0, 0, 13, 1500, 2000),
(11, 'apace 12 ', 0, 'box', 0, 0, 0, 12, 9000, 10000),
(9, 'surya 12', 0, 'box', 0, 0, 0, 12, 560000, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE IF NOT EXISTS `gudang` (
  `id_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gudang` varchar(122) NOT NULL,
  `alamat` varchar(122) NOT NULL,
  `telpon` varchar(122) NOT NULL,
  PRIMARY KEY (`id_gudang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `alamat`, `telpon`) VALUES
(1, 'gudang satu  ', 'jalan wilis no 90 nganjuk - jatim (telp:089634203745)', ''),
(3, 'gudang tiga  ', 'jalan lombok no 90 kadiri (telp:0954203745)', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `id_income` int(11) NOT NULL AUTO_INCREMENT,
  `id_submaster` varchar(122) NOT NULL,
  `jumlah` varchar(122) NOT NULL,
  `nama_keterangan` varchar(122) NOT NULL,
  `tanggal` date NOT NULL,
  `debit` int(122) NOT NULL,
  `kredit` int(122) NOT NULL,
  `status` varchar(122) NOT NULL,
  PRIMARY KEY (`id_income`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id_income`, `id_submaster`, `jumlah`, `nama_keterangan`, `tanggal`, `debit`, `kredit`, `status`) VALUES
(3, '9', '', 'pendapatan produk bekas', '2015-10-26', 5000000, 0, 'laba/rugi'),
(2, '9', '', 'penjualan produk', '2015-10-26', 50000000, 0, 'laba/rugi'),
(4, '10', '', 'biaya pembelian komputer server', '2015-10-26', 0, 5000000, 'laba/rugi'),
(5, '10', '', 'biaya pengadaan sms gateway', '2015-10-26', 0, 500000, 'laba/rugi'),
(6, '10', '', 'biaya pembelian kertas kartu produk', '2015-10-26', 0, 2000000, 'laba/rugi'),
(10, '9', '', 'penjualan pin aktifasi', '2015-10-26', 20000000, 0, 'laba/rugi'),
(11, '12', '', 'listrik, air dan telepon', '2015-10-26', 0, 15000000, 'laba/rugi'),
(12, '12', '', 'promosi (markup)', '2015-10-26', 0, 5000000, 'laba/rugi'),
(13, '12', '', 'administrasi kantor', '2015-10-26', 0, 2000000, 'laba/rugi'),
(14, '12', '', 'maintanance program', '2015-10-26', 0, 7000000, 'laba/rugi'),
(20, '12', '', 'speedy indihome', '2015-10-27', 0, 300000, 'laba/rugi'),
(23, '13', '', 'rekereasi', '2015-10-26', 0, 5000000, 'laba/rugi'),
(24, '5', '', 'wip listrik dan air', '2015-10-26', 0, 1000000, 'neraca'),
(25, '1', '', 'kas kecil', '2015-10-26', 0, 500000, 'neraca'),
(26, '1', '', 'kas', '2015-10-26', 0, 8000000, 'neraca'),
(27, '2', '', 'bank bri', '2015-10-26', 0, 221000000, 'neraca'),
(28, '2', '', 'bank bca', '2015-10-26', 0, 90000000, 'neraca'),
(29, '3', '', 'piutang usaha', '2015-10-26', 0, 34940000, 'neraca'),
(30, '5', '', 'wip maintanance program', '2015-10-26', 0, 7000000, 'neraca'),
(31, '16', '', 'pajak perusahaan', '2015-10-26', 0, 5000000, 'neraca'),
(84, '10', '', 'barang masuk gudang 30-10-2015 ', '2015-10-30', 0, 90000, 'laba/rugi'),
(48, '7', '', 'modal disetor', '2015-10-27', 191640000, 0, 'neraca'),
(47, '4', '', 'piutang karyawan', '2015-10-26', 0, 3000000, 'neraca'),
(39, '6', '', 'hutang usaha', '2015-10-26', 30000000, 0, 'neraca'),
(40, '6', '', 'hutang usaha pembelian peralatan', '2015-10-26', 5000000, 0, 'neraca'),
(41, '7', '', 'modal disetor', '2015-10-26', 425800000, 0, 'neraca'),
(42, '8', '', 'laba tahun berjalan', '2015-10-26', 0, 0, 'neraca'),
(43, '18', '', 'mesin dan peralatan', '2015-10-26', 0, 10000000, 'neraca'),
(44, '18', '', 'akumulsi penyusutan mesin dan peralatan', '2015-10-26', 3000000, 0, 'neraca'),
(45, '18', '', 'kendaraan', '2015-10-26', 0, 300000000, 'neraca'),
(46, '18', '', 'akumulsi penyusutan mesin dan peralatan', '2015-10-26', 25000000, 0, 'neraca'),
(50, '10', '', 'member payment', '2015-10-27', 0, 2401215, 'laba/rugi'),
(76, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 90000, 'laba/rugi'),
(55, '10', '', 'barang masuk gudang 27-10-2015 ', '2015-10-27', 0, 2500000, 'laba/rugi'),
(54, '10', '', 'tf member payment 27-10-2015 ', '2015-10-27', 0, 2401215, 'laba/rugi'),
(58, '10', '', 'barang masuk gudang 27-10-2015 ', '2015-10-27', 0, 319088, 'laba/rugi'),
(60, '10', '', 'barang masuk gudang 27-10-2015 ', '2015-10-27', 0, 50000, 'laba/rugi'),
(62, '10', '', 'barang masuk gudang 27-10-2015 ', '2015-10-27', 0, 3136000, 'laba/rugi'),
(83, '9', '', 'barang keluar gudang 30-10-2015 ', '2015-10-30', 100000, 0, 'laba/rugi'),
(64, '10', '', 'barang masuk gudang 27-10-2015 ', '2015-10-27', 0, 100, 'laba/rugi'),
(65, '10', '', 'barang masuk gudang 27-10-2015 ', '2015-10-27', 0, 3136000, 'laba/rugi'),
(66, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 2800000, 'laba/rugi'),
(67, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 2250000, 'laba/rugi'),
(81, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 90000, 'laba/rugi'),
(69, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 6460000, 'laba/rugi'),
(70, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 900000, 'laba/rugi'),
(71, '9', '', 'barang keluar gudang 29-10-2015 ', '2015-10-29', 675000, 0, 'laba/rugi'),
(72, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 5600000, 'laba/rugi'),
(73, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 750000, 'laba/rugi'),
(74, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 15000, 'laba/rugi'),
(75, '9', '', 'barang keluar gudang 29-10-2015 ', '2015-10-29', 20000, 0, 'laba/rugi'),
(77, '9', '', 'barang keluar gudang 29-10-2015 ', '2015-10-29', 50000, 0, 'laba/rugi'),
(78, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 90000, 'laba/rugi'),
(79, '10', '', 'barang masuk gudang 29-10-2015 ', '2015-10-29', 0, 135000, 'laba/rugi'),
(80, '9', '', 'barang keluar gudang 29-10-2015 ', '2015-10-29', 300000, 0, 'laba/rugi'),
(85, '16', '', 'aang', '2015-11-23', 5000, 0, 'neraca');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE IF NOT EXISTS `jenis` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(122) NOT NULL,
  `jenis_seo` varchar(122) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `jenis_seo`) VALUES
(12, 'rokok', 'rokok'),
(14, 'obat herbal', 'obat-herbal'),
(13, 'makanan ringan', 'makanan-ringan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_seo`) VALUES
(17, 'Koleksi Baju', 'koleksi-baju'),
(16, 'Jaket Gaya', 'jaket-gaya'),
(15, 'Celana Gaul', 'celana-gaul'),
(14, 'Aneka Kaos', 'aneka-kaos'),
(18, 'Ragam Topi', 'ragam-topi');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE IF NOT EXISTS `master` (
  `id_master` int(11) NOT NULL AUTO_INCREMENT,
  `nama_master` varchar(122) NOT NULL,
  `master_seo` varchar(122) NOT NULL,
  `status` varchar(122) NOT NULL,
  PRIMARY KEY (`id_master`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id_master`, `nama_master`, `master_seo`, `status`) VALUES
(1, 'harta', 'harta', 'neraca'),
(2, 'kewajiban', 'kewajiban', 'neraca'),
(3, 'modal', 'modal', 'neraca'),
(6, 'pendapatan', 'pendapatan', 'laba/rugi'),
(7, 'biaya atas pendapatan', 'biaya-atas-pendapatan', 'laba/rugi'),
(8, 'pengeluaran operasional', 'pengeluaran-operasional', 'laba/rugi'),
(9, 'pendapatan lain', 'pendapatan-lain', 'laba/rugi'),
(10, 'pengeluaran lain', 'pengeluaran-lain', 'laba/rugi'),
(11, 'operating activities', 'operating-activities', 'arus-kas'),
(12, 'investing activities', 'investing-activities', 'arus-kas'),
(13, 'financing activities', 'financing-activities', 'arus-kas');

-- --------------------------------------------------------

--
-- Table structure for table `neraca`
--

CREATE TABLE IF NOT EXISTS `neraca` (
  `id_neraca` int(11) NOT NULL AUTO_INCREMENT,
  `id_submaster` int(11) NOT NULL,
  `nama_keterangan` varchar(122) NOT NULL,
  `tanggal` date NOT NULL,
  `kredit` int(122) NOT NULL,
  `debit` int(122) NOT NULL,
  PRIMARY KEY (`id_neraca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `neraca`
--

INSERT INTO `neraca` (`id_neraca`, `id_submaster`, `nama_keterangan`, `tanggal`, `kredit`, `debit`) VALUES
(4, 1, 'kas kecil', '2015-10-26', 0, 25000),
(5, 1, 'kas besar', '2015-10-26', 0, 50000000),
(6, 2, 'bank bca', '2015-10-26', 0, 5000000),
(7, 2, 'bank bri', '2015-10-26', 0, 75000000),
(8, 3, 'piutang usaha', '2015-10-26', 0, 5000000),
(9, 4, 'piutang karyawan', '2015-10-26', 0, 5000000),
(10, 5, 'wip tenaga kerja', '2015-10-26', 0, 7000000),
(11, 5, 'wip listrik dan air', '2015-10-26', 0, 1500000),
(12, 16, 'pajak dibayar dimuka', '2015-10-26', 0, 2500000),
(13, 18, 'mesin dan peralatan', '2015-10-26', 0, 5000000),
(14, 18, 'penyusutan mesin dan peralatan', '2015-10-26', 1000000, 0),
(15, 18, 'kendaraan', '2015-10-26', 0, 300000000),
(16, 18, 'penyusutan kendaraan', '2015-10-26', 500000, 0),
(18, 6, 'hutang usaha', '2015-10-26', 0, 50000000),
(19, 6, 'hutang konsiyasi', '2015-10-26', 0, 50000000),
(20, 6, 'hutang usaha pembelian peralatan', '2015-10-26', 0, 10000000),
(21, 7, 'modal di setor', '2015-10-26', 0, 70000000),
(22, 8, 'laba tahun berjalan', '2015-10-26', 0, 38000000);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` int(122) NOT NULL AUTO_INCREMENT,
  `id_barang` int(122) NOT NULL,
  `id_gudang` int(122) NOT NULL,
  `id_suplier` int(122) NOT NULL,
  `stok` int(112) NOT NULL,
  `satuan` varchar(112) NOT NULL,
  `harga` int(112) NOT NULL,
  `status` varchar(112) NOT NULL,
  `tanggal` date NOT NULL,
  `posting` enum('N','Y') NOT NULL,
  `id_stoklist` int(11) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `id_gudang`, `id_suplier`, `stok`, `satuan`, `harga`, `status`, `tanggal`, `posting`, `id_stoklist`) VALUES
(1, 11, 1, 3, 10, 'box', 9000, 'buy', '2015-10-30', 'Y', 0),
(2, 11, 1, 0, 10, 'box', 10000, 'sell', '2015-10-30', 'Y', 4);

-- --------------------------------------------------------

--
-- Table structure for table `stoklist`
--

CREATE TABLE IF NOT EXISTS `stoklist` (
  `id_stoklist` int(11) NOT NULL AUTO_INCREMENT,
  `nama_stoklist` varchar(122) NOT NULL,
  `alamat` varchar(122) NOT NULL,
  `telpon` varchar(122) NOT NULL,
  PRIMARY KEY (`id_stoklist`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stoklist`
--

INSERT INTO `stoklist` (`id_stoklist`, `nama_stoklist`, `alamat`, `telpon`) VALUES
(1, 'bpk bambang', 'ngadiboyo rejoso nganjuk', ''),
(2, 'bpk rakijan', 'desa warujayeng nganjuk', ''),
(3, 'bapak tumijan', 'desa pelem kediri', ''),
(4, 'bapak aang', 'desa mbarong nganjuk', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id_subject` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `username` varchar(122) NOT NULL,
  PRIMARY KEY (`id_subject`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id_subject`, `subject`, `tanggal`, `jam`, `username`) VALUES
(21, 'hoe\r\n', '2015-03-05', '18:23:18', 'admin'),
(22, 'asd', '2015-03-05', '18:25:12', 'admin'),
(24, 'hoe', '2015-03-15', '04:02:28', 'lobo'),
(16, 'hoe admin\r\n', '2015-03-04', '16:49:01', 'layin001');

-- --------------------------------------------------------

--
-- Table structure for table `submaster`
--

CREATE TABLE IF NOT EXISTS `submaster` (
  `id_submaster` int(11) NOT NULL AUTO_INCREMENT,
  `nama_submaster` varchar(123) NOT NULL,
  `id_master` varchar(123) NOT NULL,
  PRIMARY KEY (`id_submaster`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `submaster`
--

INSERT INTO `submaster` (`id_submaster`, `nama_submaster`, `id_master`) VALUES
(1, 'kas', '1'),
(2, 'bank', '1'),
(3, 'piutang usaha', '1'),
(4, 'piutang non usaha', '1'),
(5, 'wip', '1'),
(6, 'hutang lancar', '2'),
(7, 'modal', '3'),
(8, 'laba', '3'),
(9, 'pendapatan usaha', '6'),
(10, 'biaya produksi', '7'),
(11, 'biaya usaha lain', '7'),
(12, 'biaya operasional', '8'),
(13, 'biaya non operasional', '8'),
(14, 'pendapatan luar usaha', '9'),
(16, 'biaya di bayar dimuka', '1'),
(18, 'harga tetap berwujud', '1');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `id_sub` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE IF NOT EXISTS `suplier` (
  `id_suplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(122) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_suplier`, `alamat`) VALUES
(2, 'PT GUDANG GARAM CORPORA TBK    ', 'jalan raya wilis 90 kediri'),
(3, 'PT DJARUM TBK  ', 'jalan dhoho surabaya'),
(4, 'PT KAMADJAYA LOGISTIK TBK  ', 'jalan surabaya - jawa timur'),
(5, 'PT POS INDONESIA  ', 'jalan simpang lima solo\r\n'),
(6, 'PT TRAVAWEB MEDIA INFORMASI', 'jalan surabaya madiun no 89. nganjuk - jawa timur\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `leveladmin` enum('admin','superadmin') COLLATE latin1_general_ci NOT NULL,
  `level_admin` varchar(12) COLLATE latin1_general_ci NOT NULL,
  `menu1` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  `menu2` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  `menu3` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  `menu4` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  `menu5` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  `menu6` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  `menu7` enum('N','Y') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`, `leveladmin`, `level_admin`, `menu1`, `menu2`, `menu3`, `menu4`, `menu5`, `menu6`, `menu7`) VALUES
('admin', 'admin', 'cisSUPER', 'admin@detik.com', '08238923848', 'admin', 'N', 'o7uhtpg3ck5i8ksad5cto12tv4', 'superadmin', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
