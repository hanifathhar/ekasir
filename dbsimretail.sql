/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.1.41 : Database - dbsimretail
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbsimretail` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbsimretail`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(5) unsigned zerofill NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nm_pengguna` varchar(100) DEFAULT NULL,
  `nik` varchar(100) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kd_cabang` char(20) DEFAULT NULL,
  `nm_cabang` varchar(100) DEFAULT NULL,
  `level` char(2) DEFAULT NULL,
  `id_grup` char(30) DEFAULT NULL,
  `nm_grup` varchar(100) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `kunci` int(2) NOT NULL,
  `tgl_kunci` date DEFAULT NULL,
  PRIMARY KEY (`id`,`username`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2147484248 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`nm_pengguna`,`nik`,`no_telp`,`email`,`kd_cabang`,`nm_cabang`,`level`,`id_grup`,`nm_grup`,`status`,`date_create`,`kunci`,`tgl_kunci`) values 
(00001,'admin','57b2b28f42a210bf3df12d7878ab7b38','Abdul Hanif Athhar',NULL,'081357881355','hanifconsultans@gmail.com','001','Pusat','1','01','Admin',1,'2025-01-15 03:42:29',0,NULL),
(00002,'sandy','e10adc3949ba59abbe56e057f20f883e','Roy Sandy Harahap',NULL,'081357881355','broer.87@gmail.com','001','Pusat','1','03','Kasir',0,NULL,0,NULL);

/*Table structure for table `admin_grup` */

DROP TABLE IF EXISTS `admin_grup`;

CREATE TABLE `admin_grup` (
  `id_grup` char(30) NOT NULL,
  `nm_grup` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_grup`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `admin_grup` */

insert  into `admin_grup`(`id_grup`,`nm_grup`) values 
('01','Admin'),
('02','Marketing'),
('03','Kasir'),
('04','Sales');

/*Table structure for table `map_laba` */

DROP TABLE IF EXISTS `map_laba`;

CREATE TABLE `map_laba` (
  `no` int(5) DEFAULT NULL,
  `uraian` varchar(100) DEFAULT NULL,
  `kode` text,
  `nilai` decimal(18,0) DEFAULT NULL,
  `bold` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `map_laba` */

insert  into `map_laba`(`no`,`uraian`,`kode`,`nilai`,`bold`) values 
(1,'Pendapatan',NULL,NULL,'0'),
(2,'Penjualan Barang','41',NULL,'2'),
(3,'Retur Penjualan',NULL,NULL,'2'),
(4,'Jumlah',NULL,NULL,'1'),
(5,NULL,NULL,NULL,'2'),
(7,'Harga Pokok Penjualan',NULL,NULL,'0'),
(12,'Jumlah',NULL,NULL,'1'),
(13,NULL,NULL,NULL,'2'),
(8,'Persediaan Awal','14',NULL,'2'),
(9,'Pembelian Barang','51',NULL,'2'),
(10,'Retur Pembelian',NULL,NULL,'2'),
(11,'Persediaan Akhir',NULL,NULL,'2'),
(14,'Laba Kotor (Pendapatan - Harga Pokok Penjualan)',NULL,NULL,'1');

/*Table structure for table `map_neraca` */

DROP TABLE IF EXISTS `map_neraca`;

CREATE TABLE `map_neraca` (
  `no` int(5) DEFAULT NULL,
  `uraian` varchar(100) DEFAULT NULL,
  `kode` text,
  `nilai` decimal(18,0) DEFAULT NULL,
  `bold` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `map_neraca` */

insert  into `map_neraca`(`no`,`uraian`,`kode`,`nilai`,`bold`) values 
(1,'Aktiva',NULL,NULL,'0'),
(2,'Kas','11,12',NULL,'2'),
(4,'Piutang','13',NULL,'2'),
(5,'Persediaan Barang','14',NULL,'2'),
(7,'Total Aktiva','11,12,13,14',NULL,'1'),
(8,NULL,NULL,NULL,'2'),
(9,'Kewajiban',NULL,NULL,'0'),
(10,'Hutang Pembelian','21',NULL,'2'),
(11,'Kewajiban Jangka Panjang',NULL,NULL,'2'),
(12,'Total Kewajiban','21',NULL,'1'),
(13,NULL,NULL,NULL,'2'),
(14,'Modal',NULL,NULL,'0'),
(15,'Modal Disetor','32',NULL,'2'),
(16,'Laba',NULL,NULL,'2'),
(17,'Total Modal','32',NULL,'1'),
(18,NULL,NULL,NULL,'2'),
(19,'Total Modal dan Kewajiban',NULL,NULL,'1');

/*Table structure for table `modul` */

DROP TABLE IF EXISTS `modul`;

CREATE TABLE `modul` (
  `kode` char(10) DEFAULT NULL,
  `modul` varchar(225) DEFAULT NULL,
  `page_id` char(10) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `page_link` varchar(225) DEFAULT NULL,
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `level` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seqno` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

/*Data for the table `modul` */

insert  into `modul`(`kode`,`modul`,`page_id`,`url`,`page_link`,`id`,`level`) values 
('U03','Manajemen User','U','welcome.php?modul=user&aksi=view','welcome.php?modul=user&aksi=view',79,NULL),
('U02','Group Menu','U','welcome.php?modul=grup&aksi=view','welcome.php?modul=grup&aksi=view',78,NULL),
('U01','Modul ','U','welcome.php?modul=modul&aksi=view','welcome.php?modul=modul&aksi=view',77,'1'),
('M01','Barang','M','welcome.php?modul=barang&aksi=view',NULL,119,NULL),
('M02','Supplier','M','welcome.php?modul=supplier&aksi=view',NULL,120,NULL),
('M03','Member','M','welcome.php?modul=member&aksi=view',NULL,121,NULL),
('A01','Kasir','A','welcome.php?modul=kasir&aksi=input',NULL,122,NULL),
('B01','Penjualan','B','welcome.php?modul=penjualan&aksi=view',NULL,123,NULL),
('B02','Pembelian','B','welcome.php?modul=pembelian&aksi=view',NULL,124,NULL),
('C01','Laporan Cashflow','C','welcome.php?modul=cashflow&aksi=view',NULL,125,NULL),
('C02','Laporan Stock Barang','C','welcome.php?modul=stock&aksi=view',NULL,126,NULL),
('B03','Piutang','B','welcome.php?modul=piutang&aksi=view',NULL,127,NULL),
('B04','Hutang','B','welcome.php?modul=hutang&aksi=view',NULL,128,NULL),
('B05','Retur Penjualan','B','welcome.php?modul=returpenjualan&aksi=view',NULL,129,NULL),
('B06','Retur Pembelian','B','welcome.php?modul=returpembelian&aksi=view',NULL,130,NULL),
('C03','Laporan Laba/Rugi','C','welcome.php?modul=laba&aksi=view',NULL,131,NULL),
('B07','Modal Disetor','B','welcome.php?modul=modal&aksi=view',NULL,132,NULL),
('C04','Neraca','C','welcome.php?modul=neraca&aksi=view',NULL,133,NULL),
('U04','Profil Company','U','welcome.php?modul=company&aksi=view',NULL,134,NULL);

/*Table structure for table `ms_akun` */

DROP TABLE IF EXISTS `ms_akun`;

CREATE TABLE `ms_akun` (
  `kd_akun` char(10) DEFAULT NULL,
  `nm_akun` varchar(100) DEFAULT NULL,
  `kd_jns` char(10) DEFAULT NULL,
  `nm_jns` varchar(100) DEFAULT NULL,
  `saldo` char(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_akun` */

insert  into `ms_akun`(`kd_akun`,`nm_akun`,`kd_jns`,`nm_jns`,`saldo`) values 
('1.1','Kas','1','Aset','D'),
('1.2','Kas Tunai','1','Aset','D'),
('1.3','Piutang','1','Aset','D'),
('1.4','Persediaan','1','Aset','D'),
('2.1','Hutang','2','Kewajiban','K'),
('3.1','Ekuitas','3','Ekuitas','K'),
('4.1','Penjualan','4','Pendapatan','K'),
('5.1','Pembelian','5','Biaya','D'),
('3.2','Modal Disetor','3','Ekuitas','K'),
('4.2','Retur Pembelian','4','Pendapatan','K'),
('5.2','Retur Penjualan','5','Biaya','D'),
('5.3','HPP','5','Biaya','D');

/*Table structure for table `ms_bulan` */

DROP TABLE IF EXISTS `ms_bulan`;

CREATE TABLE `ms_bulan` (
  `kode` char(5) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_bulan` */

insert  into `ms_bulan`(`kode`,`nama`) values 
('01','Januari'),
('02','Februari'),
('03','Maret'),
('04','April'),
('05','Mei'),
('06','Juni'),
('07','Juli'),
('08','Agustus'),
('09','September'),
('10','Oktober'),
('11','November'),
('12','Desember');

/*Table structure for table `ms_cabang` */

DROP TABLE IF EXISTS `ms_cabang`;

CREATE TABLE `ms_cabang` (
  `kd_cabang` char(10) NOT NULL,
  `nm_cabang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_cabang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_cabang` */

insert  into `ms_cabang`(`kd_cabang`,`nm_cabang`) values 
('001','Pusat');

/*Table structure for table `ms_exspedisi` */

DROP TABLE IF EXISTS `ms_exspedisi`;

CREATE TABLE `ms_exspedisi` (
  `expedisi` varchar(100) NOT NULL,
  PRIMARY KEY (`expedisi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_exspedisi` */

insert  into `ms_exspedisi`(`expedisi`) values 
('JNE'),
('JNT'),
('POS'),
('TIKI');

/*Table structure for table `ms_kategori` */

DROP TABLE IF EXISTS `ms_kategori`;

CREATE TABLE `ms_kategori` (
  `kd_kategori` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ms_kategori` */

insert  into `ms_kategori`(`kd_kategori`,`nm_kategori`) values 
(1,'PLASTIK');

/*Table structure for table `ms_profil` */

DROP TABLE IF EXISTS `ms_profil`;

CREATE TABLE `ms_profil` (
  `company` varchar(100) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `no_telp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pimpinan` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_profil` */

insert  into `ms_profil`(`company`,`alamat`,`no_telp`,`email`,`pimpinan`,`jabatan`,`logo`,`tgl_update`,`user`) values 
('NAMA TOKO','Jl. Merdeka No. 18 - Padangsidimpuan','081357881355','hanifconsultans@gmail.com','Abd. Hanif Athhar','Direktur','../assets/img/20250619112006_ek.png',NULL,NULL);

/*Table structure for table `ms_satuan` */

DROP TABLE IF EXISTS `ms_satuan`;

CREATE TABLE `ms_satuan` (
  `satuan` char(50) NOT NULL,
  PRIMARY KEY (`satuan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_satuan` */

insert  into `ms_satuan`(`satuan`) values 
('8888'),
('Biji'),
('Bungkus'),
('Kg'),
('Kotak'),
('Lusin'),
('Set');

/*Table structure for table `otori_menu` */

DROP TABLE IF EXISTS `otori_menu`;

CREATE TABLE `otori_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` char(50) DEFAULT NULL,
  `modul` varchar(100) DEFAULT NULL,
  `page_id` char(50) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `id_grup` char(30) DEFAULT NULL,
  `sts` int(2) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14113 DEFAULT CHARSET=latin1;

/*Data for the table `otori_menu` */

insert  into `otori_menu`(`id`,`kode`,`modul`,`page_id`,`url`,`id_grup`,`sts`) values 
(14090,'U03','Manajemen User','U','welcome.php?modul=user&aksi=view','01',0),
(14098,'M01','Barang','M','welcome.php?modul=barang&aksi=view','04',0),
(14104,'A01','Kasir','A','welcome.php?modul=kasir&aksi=input','03',0),
(14106,'C01','Laporan Cashflow','C','welcome.php?modul=cashflow&aksi=view','02',0),
(14089,'U02','Group Menu','U','welcome.php?modul=grup&aksi=view','01',0),
(14088,'U01','Modul ','U','welcome.php?modul=modul&aksi=view','01',0),
(14087,'M03','Member','M','welcome.php?modul=member&aksi=view','01',0),
(14086,'M02','Supplier','M','welcome.php?modul=supplier&aksi=view','01',0),
(14085,'M01','Barang','M','welcome.php?modul=barang&aksi=view','01',0),
(14084,'C04','Neraca','C','welcome.php?modul=neraca&aksi=view','01',0),
(14097,'C04','Neraca','C','welcome.php?modul=neraca&aksi=view','04',0),
(14096,'C03','Laporan Laba/Rugi','C','welcome.php?modul=laba&aksi=view','04',0),
(14094,'C01','Laporan Cashflow','C','welcome.php?modul=cashflow&aksi=view','04',0),
(14095,'C02','Laporan Stock Barang','C','welcome.php?modul=stock&aksi=view','04',0),
(14093,'B01','Penjualan','B','welcome.php?modul=penjualan&aksi=view','04',0),
(14092,'A01','Kasir','A','welcome.php?modul=kasir&aksi=input','04',0),
(14082,'C02','Laporan Stock Barang','C','welcome.php?modul=stock&aksi=view','01',0),
(14083,'C03','Laporan Laba/Rugi','C','welcome.php?modul=laba&aksi=view','01',0),
(14081,'C01','Laporan Cashflow','C','welcome.php?modul=cashflow&aksi=view','01',0),
(14079,'B06','Retur Pembelian','B','welcome.php?modul=returpembelian&aksi=view','01',0),
(14080,'B07','Modal Disetor','B','welcome.php?modul=modal&aksi=view','01',0),
(14078,'B05','Retur Penjualan','B','welcome.php?modul=returpenjualan&aksi=view','01',0),
(14077,'B04','Hutang','B','welcome.php?modul=hutang&aksi=view','01',0),
(14076,'B03','Piutang','B','welcome.php?modul=piutang&aksi=view','01',0),
(14075,'B02','Pembelian','B','welcome.php?modul=pembelian&aksi=view','01',0),
(14074,'B01','Penjualan','B','welcome.php?modul=penjualan&aksi=view','01',0),
(14073,'A01','Kasir','A','welcome.php?modul=kasir&aksi=input','01',0),
(14091,'U04','Profil Company','U','welcome.php?modul=company&aksi=view','01',0),
(14099,'M02','Supplier','M','welcome.php?modul=supplier&aksi=view','04',0),
(14100,'M03','Member','M','welcome.php?modul=member&aksi=view','04',0),
(14101,'U01','Modul ','U','welcome.php?modul=modul&aksi=view','04',0),
(14102,'U02','Group Menu','U','welcome.php?modul=grup&aksi=view','04',0),
(14103,'U03','Manajemen User','U','welcome.php?modul=user&aksi=view','04',0),
(14105,'C02','Laporan Stock Barang','C','welcome.php?modul=stock&aksi=view','03',0),
(14107,'C02','Laporan Stock Barang','C','welcome.php?modul=stock&aksi=view','02',0),
(14108,'C03','Laporan Laba/Rugi','C','welcome.php?modul=laba&aksi=view','02',0),
(14109,'C04','Neraca','C','welcome.php?modul=neraca&aksi=view','02',0),
(14110,'M01','Barang','M','welcome.php?modul=barang&aksi=view','02',0),
(14111,'M02','Supplier','M','welcome.php?modul=supplier&aksi=view','02',0),
(14112,'M03','Member','M','welcome.php?modul=member&aksi=view','02',0);

/*Table structure for table `tbl_barang` */

DROP TABLE IF EXISTS `tbl_barang`;

CREATE TABLE `tbl_barang` (
  `kd_barang` char(15) NOT NULL,
  `nm_barang` varchar(225) DEFAULT NULL,
  `kd_kategori` int(5) DEFAULT NULL,
  `satuan` char(50) DEFAULT NULL,
  `harga_beli` decimal(18,0) DEFAULT NULL,
  `harga_jual` decimal(18,0) DEFAULT NULL,
  `stock` int(10) NOT NULL,
  `terjual` int(10) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_barang` */

insert  into `tbl_barang`(`kd_barang`,`nm_barang`,`kd_kategori`,`satuan`,`harga_beli`,`harga_jual`,`stock`,`terjual`) values 
('000001','Kotak JGH 12/12',1,'Bungkus',39000,39000,300,263),
('000002','Kotak JGH 12/14',1,'Bungkus',4000,4000,0,0),
('000003','Kotak Minum',1,'Bungkus',9500,9500,0,0),
('000004','Box Sekat 20/20',1,'Bungkus',10000,10000,0,0),
('000005','Piring Kue Kertas',1,'Bungkus',8500,8500,0,0),
('000006','Gelas Es Cream 5 ML',1,'Bungkus',5000,5000,0,0),
('000007','Gelas Es Cream 100 ML',1,'Bungkus',5000,5000,0,0),
('000008','Tutup Es Cream',1,'Bungkus',2500,2500,0,0),
('000009','W 6x10',1,'Kg',37000,37000,0,0),
('000010','W 8x13',1,'Kg',34000,34000,0,0),
('000011','W 10x15',1,'Kg',33000,33000,0,0),
('000012','W 18x20',1,'Kg',35000,35000,0,0),
('000013','Klip 5x8',1,'Pak',35000,35000,0,0),
('000014','Klip 7x10',1,'Pak',50000,50000,0,0),
('000015','Pisau Cutter',1,'Lusin',10000,10000,0,0),
('000016','Sendok Makan Putih',1,'Bungkus',7500,7500,0,0),
('000017','Gelad Aqua',1,'Bungkus',6000,6000,0,0),
('000018','Tenda Kg Ukuran 2x3',1,'Set',3500,3500,0,0),
('000019','Tenda Kg Ukuran 3x4',1,'Set',6300,6300,0,0),
('000020','Mantel Pet Tibu PC',1,'Lusin',75000,75000,0,0),
('000021','Mantel Pet JC',1,'Lusin',95000,95000,0,0);

/*Table structure for table `tbl_hutang` */

DROP TABLE IF EXISTS `tbl_hutang`;

CREATE TABLE `tbl_hutang` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_member` char(6) DEFAULT NULL,
  `nm_member` varchar(100) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `total_hutang` decimal(18,0) DEFAULT NULL,
  `pelunasan` decimal(18,0) DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `lunas` int(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hutang` */

/*Table structure for table `tbl_jurnal` */

DROP TABLE IF EXISTS `tbl_jurnal`;

CREATE TABLE `tbl_jurnal` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `kd_akun` char(10) DEFAULT NULL,
  `nm_akun` varchar(100) DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `rk` char(5) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `urut` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jurnal` */

insert  into `tbl_jurnal`(`no_transaksi`,`tgl_transaksi`,`kd_akun`,`nm_akun`,`debet`,`kredit`,`rk`,`user`,`tgl_update`,`keterangan`,`jenis`,`urut`) values 
('MD0000120250618000001','2025-06-18','3.2','Modal Disetor',0,230000000,'K','00001','2025-06-18 08:07:58','Modal Disetor','Modal Disetor',2),
('MD0000120250618000001','2025-06-18','1.1','Kas',230000000,0,'D','00001','2025-06-18 08:07:58','Modal Disetor','Modal Disetor',1),
('PB0000120250629000001','2025-06-29','1.4','Persediaan',11700000,0,'D','00001','2025-06-28 09:32:33','CV FAUZAN SURYA SEJATI','Pembelian',1),
('PB0000120250629000001','2025-06-29','1.1','Kas',0,11700000,'K','00001','2025-06-28 09:32:33','CV FAUZAN SURYA SEJATI','Pembelian',2),
('PB0000120250629000001','2025-06-29','5.1','Pembelian',11700000,0,'D','00001','2025-06-28 09:32:33','CV FAUZAN SURYA SEJATI','Pembelian',3),
('PB0000120250629000001','2025-06-29','0.0','Perubahan Sal',0,11700000,'K','00001','2025-06-28 09:32:33','CV FAUZAN SURYA SEJATI','Pembelian',4),
('PJ0000120250629000001','2025-06-29','5.3','HPP',7800000,0,'D','00001','2025-06-28 19:10:00','Abd. Hanif Athhar','Penjualan',1),
('PJ0000120250629000001','2025-06-29','1.4','Persediaan',0,7800000,'K','00001','2025-06-28 19:10:00','Abd. Hanif Athhar','Penjualan',2),
('PJ0000120250629000001','2025-06-29','1.1','Kas',7800000,0,'D','00001','2025-06-28 19:10:00','Abd. Hanif Athhar','Penjualan',3),
('PJ0000120250629000001','2025-06-29','4.1','Penjualan',0,7800000,'K','00001','2025-06-28 19:10:00','Abd. Hanif Athhar','Penjualan',4),
('PJ0000120250722000002','2025-07-22','5.3','HPP',507000,0,'D','00001','2025-07-21 20:48:38','Umum','Penjualan',1),
('PJ0000120250722000002','2025-07-22','1.4','Persediaan',0,507000,'K','00001','2025-07-21 20:48:38','Umum','Penjualan',2),
('PJ0000120250722000002','2025-07-22','1.1','Kas',507000,0,'D','00001','2025-07-21 20:48:38','Umum','Penjualan',3),
('PJ0000120250722000002','2025-07-22','4.1','Penjualan',0,507000,'K','00001','2025-07-21 20:48:38','Umum','Penjualan',4),
('PJ0000120250722000003','2025-07-22','5.3','HPP',1950000,0,'D','00001','2025-07-22 07:04:50','Umum','Penjualan',1),
('PJ0000120250722000003','2025-07-22','1.4','Persediaan',0,1950000,'K','00001','2025-07-22 07:04:50','Umum','Penjualan',2),
('PJ0000120250722000003','2025-07-22','1.1','Kas',1950000,0,'D','00001','2025-07-22 07:04:50','Umum','Penjualan',3),
('PJ0000120250722000003','2025-07-22','4.1','Penjualan',0,1950000,'K','00001','2025-07-22 07:04:50','Umum','Penjualan',4);

/*Table structure for table `tbl_log` */

DROP TABLE IF EXISTS `tbl_log`;

CREATE TABLE `tbl_log` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `aksi` varchar(100) DEFAULT NULL,
  `transaksi` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `nilai` decimal(18,2) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_log` */

/*Table structure for table `tbl_member` */

DROP TABLE IF EXISTS `tbl_member`;

CREATE TABLE `tbl_member` (
  `id_member` int(6) NOT NULL AUTO_INCREMENT,
  `nm_member` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_telp` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_member` */

insert  into `tbl_member`(`id_member`,`nm_member`,`tgl_lahir`,`nik`,`no_telp`,`email`,`alamat`,`kota`) values 
(1,'Abd. Hanif Athhar','1989-07-12','6403050207890001','081357881355','hanifconsultans@gmail.com','Perumahan RCM Blok. B12 - Batunadua','Padangsdimpuan'),
(2,'Azma Rasya Athhar','2017-05-16','-','081357881355','hanifconsultans@gmail.com','Perumahan RCM Blok B12 Batunadua','Padangsdimpuan');

/*Table structure for table `tbl_modal` */

DROP TABLE IF EXISTS `tbl_modal`;

CREATE TABLE `tbl_modal` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL,
  `bukti` varchar(100) DEFAULT NULL,
  `pembayaran` int(2) NOT NULL DEFAULT '1',
  `nilai` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_modal` */

insert  into `tbl_modal`(`no_transaksi`,`tgl_transaksi`,`keterangan`,`bukti`,`pembayaran`,`nilai`,`tgl_update`,`user`) values 
('MD0000120250618000001','2025-06-18','Modal Disetor','TRXMOD-001-2025',2,230000000,'2025-06-18 08:07:58','00001');

/*Table structure for table `tbl_pembayaran` */

DROP TABLE IF EXISTS `tbl_pembayaran`;

CREATE TABLE `tbl_pembayaran` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_member` char(6) DEFAULT NULL,
  `nm_member` varchar(100) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `pembayaran` int(2) NOT NULL DEFAULT '1',
  `exspedisi` varchar(100) DEFAULT NULL,
  `ongkir` decimal(18,0) DEFAULT NULL,
  `total_hpp` decimal(18,0) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `voucher` decimal(18,0) DEFAULT NULL,
  `diskon` int(5) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `grand_total` decimal(18,0) DEFAULT NULL,
  `dibayar` decimal(18,0) DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT NULL,
  `kembali` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pembayaran` */

insert  into `tbl_pembayaran`(`no_transaksi`,`tgl_transaksi`,`id_member`,`nm_member`,`faktur`,`pembayaran`,`exspedisi`,`ongkir`,`total_hpp`,`total`,`voucher`,`diskon`,`pajak`,`grand_total`,`dibayar`,`saldo`,`kembali`,`tgl_update`,`user`) values 
('PJ0000120250629000001','2025-06-29','1','Abd. Hanif Athhar','PJ0000120250629000001',1,'',0,7800000,7800000,0,0,0,7800000,7800000,0,NULL,'2025-06-28 19:10:00','00001'),
('PJ0000120250722000002','2025-07-22','','','PJ0000120250722000002',1,'',0,507000,507000,0,0,0,507000,507000,0,NULL,'2025-07-21 20:48:38','00001'),
('PJ0000120250722000003','2025-07-22','','','PJ0000120250722000003',1,'',0,1950000,1950000,0,0,0,1950000,1950000,0,NULL,'2025-07-22 07:04:50','00001');

/*Table structure for table `tbl_pembelian` */

DROP TABLE IF EXISTS `tbl_pembelian`;

CREATE TABLE `tbl_pembelian` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_supplier` char(6) DEFAULT NULL,
  `nm_supplier` varchar(100) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `pembayaran` int(2) NOT NULL DEFAULT '1',
  `exspedisi` varchar(100) DEFAULT NULL,
  `ongkir` decimal(18,0) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `voucher` decimal(18,0) DEFAULT NULL,
  `diskon` int(5) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `grand_total` decimal(18,0) DEFAULT NULL,
  `dibayar` decimal(18,0) DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pembelian` */

insert  into `tbl_pembelian`(`no_transaksi`,`tgl_transaksi`,`id_supplier`,`nm_supplier`,`faktur`,`pembayaran`,`exspedisi`,`ongkir`,`total`,`voucher`,`diskon`,`pajak`,`grand_total`,`dibayar`,`saldo`,`tgl_update`,`user`) values 
('PB0000120250629000001','2025-06-29','6','CV FAUZAN SURYA SEJATI','PB0000120250629000001',1,'',0,11700000,0,0,0,11700000,11700000,0,'2025-06-28 09:32:33','00001');

/*Table structure for table `tbl_pembelian_det` */

DROP TABLE IF EXISTS `tbl_pembelian_det`;

CREATE TABLE `tbl_pembelian_det` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `kd_barang` char(15) DEFAULT NULL,
  `nm_barang` varchar(100) DEFAULT NULL,
  `kd_kategori` int(5) DEFAULT NULL,
  `satuan` char(50) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pembelian_det` */

insert  into `tbl_pembelian_det`(`id`,`no_transaksi`,`tgl_transaksi`,`kd_barang`,`nm_barang`,`kd_kategori`,`satuan`,`harga`,`jumlah`,`total`,`tgl_update`,`user`) values 
(87,'PB0000120250629000001','2025-06-29','000001','Kotak JGH 12/12',1,'Bungkus',39000,300,11700000,'2025-06-28 09:31:47','00001');

/*Table structure for table `tbl_penjualan` */

DROP TABLE IF EXISTS `tbl_penjualan`;

CREATE TABLE `tbl_penjualan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `kd_barang` char(15) DEFAULT NULL,
  `nm_barang` varchar(100) DEFAULT NULL,
  `kd_kategori` int(5) DEFAULT NULL,
  `satuan` char(50) DEFAULT NULL,
  `hpp` decimal(10,0) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penjualan` */

insert  into `tbl_penjualan`(`id`,`no_transaksi`,`tgl_transaksi`,`kd_barang`,`nm_barang`,`kd_kategori`,`satuan`,`hpp`,`harga`,`jumlah`,`total`,`tgl_update`,`user`) values 
(97,'PJ0000120250722000003','2025-07-22','000001','Kotak JGH 12/12',1,'Bungkus',39000,39000,50,1950000,'2025-07-22 07:04:43','00001'),
(94,'PJ0000120250629000001','2025-06-29','000001','Kotak JGH 12/12',1,'Bungkus',39000,39000,200,7800000,'2025-06-28 19:09:50','00001'),
(95,'PJ0000120250722000002','2025-07-22','000001','Kotak JGH 12/12',1,'Bungkus',39000,39000,13,507000,'2025-07-21 20:48:32','00001');

/*Table structure for table `tbl_piutang` */

DROP TABLE IF EXISTS `tbl_piutang`;

CREATE TABLE `tbl_piutang` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_member` char(6) DEFAULT NULL,
  `nm_member` varchar(100) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `tgl_faktur` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `total_piutang` decimal(18,0) DEFAULT NULL,
  `pelunasan` decimal(18,0) DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `lunas` int(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_piutang` */

/*Table structure for table `tbl_retur_pembelian` */

DROP TABLE IF EXISTS `tbl_retur_pembelian`;

CREATE TABLE `tbl_retur_pembelian` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_supplier` char(6) DEFAULT NULL,
  `nm_supplier` varchar(100) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `pembayaran` int(2) NOT NULL DEFAULT '1',
  `exspedisi` varchar(100) DEFAULT NULL,
  `ongkir` decimal(18,0) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `voucher` decimal(18,0) DEFAULT NULL,
  `diskon` int(5) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `grand_total` decimal(18,0) DEFAULT NULL,
  `dibayar` decimal(18,0) DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_retur_pembelian` */

/*Table structure for table `tbl_retur_pembelian_det` */

DROP TABLE IF EXISTS `tbl_retur_pembelian_det`;

CREATE TABLE `tbl_retur_pembelian_det` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `kd_barang` char(15) DEFAULT NULL,
  `nm_barang` varchar(100) DEFAULT NULL,
  `kd_kategori` int(5) DEFAULT NULL,
  `satuan` char(50) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_retur_pembelian_det` */

/*Table structure for table `tbl_retur_penjualan` */

DROP TABLE IF EXISTS `tbl_retur_penjualan`;

CREATE TABLE `tbl_retur_penjualan` (
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_member` char(6) DEFAULT NULL,
  `nm_member` varchar(100) DEFAULT NULL,
  `faktur` varchar(100) DEFAULT NULL,
  `pembayaran` int(2) NOT NULL DEFAULT '1',
  `exspedisi` varchar(100) DEFAULT NULL,
  `ongkir` decimal(18,0) DEFAULT NULL,
  `total_hpp` decimal(18,0) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `voucher` decimal(18,0) DEFAULT NULL,
  `diskon` int(5) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `grand_total` decimal(18,0) DEFAULT NULL,
  `dibayar` decimal(18,0) DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tbl_retur_penjualan` */

/*Table structure for table `tbl_retur_penjualan_det` */

DROP TABLE IF EXISTS `tbl_retur_penjualan_det`;

CREATE TABLE `tbl_retur_penjualan_det` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `kd_barang` char(15) DEFAULT NULL,
  `nm_barang` varchar(100) DEFAULT NULL,
  `kd_kategori` int(5) DEFAULT NULL,
  `satuan` char(50) DEFAULT NULL,
  `hpp` decimal(18,0) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `total` decimal(18,0) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_retur_penjualan_det` */

insert  into `tbl_retur_penjualan_det`(`id`,`no_transaksi`,`tgl_transaksi`,`kd_barang`,`nm_barang`,`kd_kategori`,`satuan`,`hpp`,`harga`,`jumlah`,`total`,`tgl_update`,`user`) values 
(78,'RJ0000120250626000001','0000-00-00','000001','Plastik Ukuran 1 kg',1,'PCS',5000,5500,10,55000,'2025-06-26 02:23:55','00001');

/*Table structure for table `tbl_supplier` */

DROP TABLE IF EXISTS `tbl_supplier`;

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(10) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(100) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_supplier` */

insert  into `tbl_supplier`(`id_supplier`,`nm_supplier`,`alamat`,`kota`,`no_telp`,`email`) values 
(4,'CV . RAJA KARYA','Perkantoran Bupati Tapanuli Selatan, Desa Situmba Kecamatan SIpirok - Kab. Tapanuli Selatan','SIPIROK','81357881355','hanifconsultans@gmail.com'),
(5,'CV AFRAH GRAFIKA','Perkantoran Bupati Tapanuli Selatan, Desa Situmba Kecamatan SIpirok - Kab. Tapanuli Selatan','SIPIROK','81357881355','hanifconsultans@gmail.com'),
(6,'CV FAUZAN SURYA SEJATI','Perkantoran Bupati Tapanuli Selatan, Desa Situmba Kecamatan SIpirok - Kab. Tapanuli Selatan','SIPIROK','81357881355','hanifconsultans@gmail.com');

/* Trigger structure for table `tbl_hutang` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_hutang` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_hutang` AFTER UPDATE ON `tbl_hutang` FOR EACH ROW 
 
	CALL jurnal_hutang(OLD.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_modal` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_modal` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_modal` AFTER INSERT ON `tbl_modal` FOR EACH ROW CALL jurnal_modal(new.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_modal` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_modal` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_modal` AFTER DELETE ON `tbl_modal` FOR EACH ROW DELETE FROM tbl_jurnal WHERE no_transaksi=OLD.no_transaksi */$$


DELIMITER ;

/* Trigger structure for table `tbl_pembayaran` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_penjualan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_penjualan` AFTER INSERT ON `tbl_pembayaran` FOR EACH ROW CALL jurnal_penjualan(new.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_pembayaran` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_penjualan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_penjualan` AFTER DELETE ON `tbl_pembayaran` FOR EACH ROW DELETE FROM tbl_jurnal WHERE no_transaksi=OLD.no_transaksi */$$


DELIMITER ;

/* Trigger structure for table `tbl_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_pembelian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_pembelian` AFTER INSERT ON `tbl_pembelian` FOR EACH ROW CALL jurnal_pembelian(new.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_pembelian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_pembelian` AFTER DELETE ON `tbl_pembelian` FOR EACH ROW DELETE FROM tbl_jurnal WHERE no_transaksi=OLD.no_transaksi */$$


DELIMITER ;

/* Trigger structure for table `tbl_pembelian_det` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_stock` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_stock` AFTER INSERT ON `tbl_pembelian_det` FOR EACH ROW update tbl_barang set stock=stock+new.jumlah where kd_barang=new.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_pembelian_det` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_stock` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_stock` AFTER DELETE ON `tbl_pembelian_det` FOR EACH ROW UPDATE tbl_barang SET stock=stock-OLD.jumlah WHERE kd_barang=OLD.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_penjualan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_terjual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_terjual` AFTER INSERT ON `tbl_penjualan` FOR EACH ROW update tbl_barang set terjual=terjual+new.jumlah where kd_barang=new.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_penjualan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_terjual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_terjual` AFTER DELETE ON `tbl_penjualan` FOR EACH ROW UPDATE tbl_barang SET terjual=terjual-OLD.jumlah WHERE kd_barang=OLD.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_piutang` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_piutang` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_piutang` AFTER UPDATE ON `tbl_piutang` FOR EACH ROW 
 
	CALL jurnal_piutang(OLD.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_retur_pembelian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_retur_pembelian` AFTER INSERT ON `tbl_retur_pembelian` FOR EACH ROW CALL jurnal_retur_pembelian(new.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_retur_pembelian` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_retur_pembelian` AFTER DELETE ON `tbl_retur_pembelian` FOR EACH ROW DELETE FROM tbl_jurnal WHERE no_transaksi=OLD.no_transaksi */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_pembelian_det` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_retur_stock` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_retur_stock` AFTER INSERT ON `tbl_retur_pembelian_det` FOR EACH ROW update tbl_barang set stock=stock-new.jumlah where kd_barang=new.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_pembelian_det` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_retur_stock` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_retur_stock` AFTER DELETE ON `tbl_retur_pembelian_det` FOR EACH ROW UPDATE tbl_barang SET stock=stock+OLD.jumlah WHERE kd_barang=OLD.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_penjualan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_retur_penjualan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_retur_penjualan` AFTER INSERT ON `tbl_retur_penjualan` FOR EACH ROW CALL jurnal_retur_penjualan(new.no_transaksi) */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_penjualan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_retur_penjualan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_retur_penjualan` AFTER DELETE ON `tbl_retur_penjualan` FOR EACH ROW DELETE FROM tbl_jurnal WHERE no_transaksi=OLD.no_transaksi */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_penjualan_det` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_retur_terjual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_retur_terjual` AFTER INSERT ON `tbl_retur_penjualan_det` FOR EACH ROW update tbl_barang set terjual=terjual-new.jumlah where kd_barang=new.kd_barang */$$


DELIMITER ;

/* Trigger structure for table `tbl_retur_penjualan_det` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `trg_batal_retur_terjual` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `trg_batal_retur_terjual` AFTER DELETE ON `tbl_retur_penjualan_det` FOR EACH ROW UPDATE tbl_barang SET terjual=terjual+OLD.jumlah WHERE kd_barang=OLD.kd_barang */$$


DELIMITER ;

/* Procedure structure for procedure `jurnal_hutang` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_hutang` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_hutang`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnhpp DOUBLE;
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,IF(nm_member<>'',nm_member,'Umum') as pembeli,pelunasan,user FROM tbl_hutang
                                  WHERE no_transaksi=vnomor and lunas='1';
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnilai, vuser;	
	
	IF done=0 THEN 	
		
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '2.1', 'Hutang', vnilai, 0,'D',vuser,NOW(),vketerangan,'Pelunasan Hutang','1');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', 0, vnilai,'K',vuser,NOW(),vketerangan,'Pelunasan Hutang','2');
		
		
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/* Procedure structure for procedure `jurnal_modal` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_modal` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_modal`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,keterangan,nilai,user,pembayaran FROM tbl_modal
                                  WHERE no_transaksi=vnomor;
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnilai, vuser, vbayar;	
	
	IF done=0 THEN 		
		
		
		      
	        INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
		        VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', vnilai,0,'D',vuser,NOW(),vketerangan,'Modal Disetor','1');	
		
		
		INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
			VALUES(vno_bukti_new, vtgl_bukti, '3.2', 'Modal Disetor', 0,vnilai,'K',vuser,NOW(),vketerangan,'Modal Disetor','2');
		
				    			           	                            
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/* Procedure structure for procedure `jurnal_pembelian` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_pembelian` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_pembelian`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,IF(nm_supplier<>'',nm_supplier,'Umum') as supplier,grand_total,dibayar,saldo,user,pembayaran FROM tbl_pembelian
                                  WHERE no_transaksi=vnomor;
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnilai, vnbayar, vnsaldo, vuser, vbayar;	
	
	IF done=0 THEN 		
		
		
			
		
			
		if vbayar = 1 then
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', vnbayar,0,'D',vuser,NOW(),vketerangan,'Pembelian','1');
			
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', 0,vnbayar,'K',vuser,NOW(),vketerangan,'Pembelian','2');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.1', 'Pembelian', vnbayar,0,'D',vuser,NOW(),vketerangan,'Pembelian','3');
		
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '0.0', 'Perubahan Sal', 0,vnbayar,'K',vuser,NOW(),vketerangan,'Pembelian','4');
		
		else
		        
		        INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', vnilai,0,'D',vuser,NOW(),vketerangan,'Pembelian','1');
				
		        INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '2.1', 'Hutang', 0,vnilai,'K',vuser,NOW(),vketerangan,'Pembelian','2');	
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.1', 'Pembelian', vnilai,0,'D',vuser,NOW(),vketerangan,'Pembelian','3');
		
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '0.0', 'Perubahan Sal', 0,vnilai,'K',vuser,NOW(),vketerangan,'Pembelian','4');
		     
		end if;
		
		
		
		
				    			           	                            
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/* Procedure structure for procedure `jurnal_penjualan` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_penjualan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_penjualan`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnhpp DOUBLE;
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,IF(nm_member<>'',nm_member,'Umum') as pembeli,total_hpp,grand_total,dibayar,saldo,user,pembayaran FROM tbl_pembayaran
                                  WHERE no_transaksi=vnomor;
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnhpp, vnilai, vnbayar, vnsaldo, vuser, vbayar;	
	
	IF done=0 THEN 	
		
		
		
			
		if vbayar = 1 then
		
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.3', 'HPP', vnhpp,0,'D',vuser,NOW(),vketerangan,'Penjualan','1');
			
	                INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', 0,vnhpp,'K',vuser,NOW(),vketerangan,'Penjualan','2');
			
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', vnbayar,0,'D',vuser,NOW(),vketerangan,'Penjualan','3');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '4.1', 'Penjualan', 0,vnbayar,'K',vuser,NOW(),vketerangan,'Penjualan','4');
		
		else
		
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.3', 'HPP', vnhpp,0,'D',vuser,NOW(),vketerangan,'Penjualan','1');
			
	                INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', 0,vnhpp,'K',vuser,NOW(),vketerangan,'Penjualan','2');
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.3', 'Piutang', vnilai,0,'D',vuser,NOW(),vketerangan,'Penjualan','3');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '4.1', 'Penjualan', 0,vnilai,'K',vuser,NOW(),vketerangan,'Penjualan','4');
		      
		end if;
		
		
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/* Procedure structure for procedure `jurnal_piutang` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_piutang` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_piutang`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnhpp DOUBLE;
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,IF(nm_member<>'',nm_member,'Umum') as pembeli,pelunasan,user FROM tbl_piutang
                                  WHERE no_transaksi=vnomor and lunas='1';
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnilai, vuser;	
	
	IF done=0 THEN 	
		
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', vnilai,0,'D',vuser,NOW(),vketerangan,'Pelunasan Piutang','1');
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.3', 'Piutang', 0, vnilai,'K',vuser,NOW(),vketerangan,'Pelunasan Piutang','2');
		
		
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/* Procedure structure for procedure `jurnal_retur_pembelian` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_retur_pembelian` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_retur_pembelian`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,IF(nm_supplier<>'',nm_supplier,'Umum') as supplier,grand_total,dibayar,saldo,user,pembayaran FROM tbl_retur_pembelian
                                  WHERE no_transaksi=vnomor;
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnilai, vnbayar, vnsaldo, vuser, vbayar;	
	
	IF done=0 THEN 		
		
		
			
		if vbayar = 1 then
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', vnbayar,0,'D',vuser,NOW(),vketerangan,'Retur Pembelian','1');	
			
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', 0,vnbayar,'K',vuser,NOW(),vketerangan,'Retur Pembelian','2');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '0.0', 'Perubahan Sal', vnbayar,0,'D',vuser,NOW(),vketerangan,'Retur Pembelian','3');
			
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '4.2', 'Retur Pembelian', 0,vnbayar,'K',vuser,NOW(),vketerangan,'Retur Pembelian','4');
				
		      
		else
		        
		        INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.3', 'Piutang', vnilai,0,'D',vuser,NOW(),vketerangan,'Retur Pembelian','1');	
			
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', 0,vnilai,'K',vuser,NOW(),vketerangan,'Retur Pembelian','2');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '0.0', 'Perubahan Sal', vnilai,0,'D',vuser,NOW(),vketerangan,'Retur Pembelian','3');
			
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '4.2', 'Retur Pembelian', 0,vnilai,'K',vuser,NOW(),vketerangan,'Retur Pembelian','4');
		     
		end if;
		
				    			           	                            
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/* Procedure structure for procedure `jurnal_retur_penjualan` */

/*!50003 DROP PROCEDURE IF EXISTS  `jurnal_retur_penjualan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `jurnal_retur_penjualan`(IN `vnomor` VARCHAR(100))
Block1: BEGIN
DECLARE vno_bukti VARCHAR (150); 
DECLARE vno_bukti_new VARCHAR (150); 
DECLARE vtgl_bukti DATE;
DECLARE vketerangan VARCHAR (250); 
DECLARE vnhpp DOUBLE;
DECLARE vnilai DOUBLE;
DECLARE vnbayar DOUBLE;
DECLARE vnsaldo DOUBLE;
DECLARE vkd_rek VARCHAR (150); 
DECLARE vnm_rek  VARCHAR (250); 
DECLARE vket VARCHAR (250); 
DECLARE vuser VARCHAR (250); 
DECLARE vbayar VARCHAR (5); 
DECLARE done INT  DEFAULT 0; 		
DECLARE cur_jurnal CURSOR FOR SELECT no_transaksi,no_transaksi,tgl_transaksi,IF(nm_member<>'',nm_member,'Umum') as pembeli,total_hpp,grand_total,dibayar,saldo,user,pembayaran FROM tbl_retur_penjualan
                                  WHERE no_transaksi=vnomor;
			
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;  
DELETE FROM tbl_jurnal WHERE no_transaksi=vnomor;
OPEN cur_jurnal;  
REPEAT
FETCH cur_jurnal INTO vno_bukti, vno_bukti_new,  vtgl_bukti, vketerangan, vnhpp, vnilai, vnbayar, vnsaldo, vuser, vbayar;	
	
	IF done=0 THEN 	
	
			
			
		if vbayar = 1 then	
		      
		        INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', vnhpp,0,'D',vuser,NOW(),vketerangan,'Penjualan','1');
			
	                INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.3', 'HPP', 0,vnhpp,'K',vuser,NOW(),vketerangan,'Penjualan','2');
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.2', 'Retur Penjualan', vnbayar,0,'D',vuser,NOW(),vketerangan,'Retur Penjualan','3');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.1', 'Kas', 0, vnbayar,'K',vuser,NOW(),vketerangan,'Retur Penjualan','4');
				
		     
		else
		      
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '1.4', 'Persediaan', vnhpp,0,'D',vuser,NOW(),vketerangan,'Penjualan','1');
			
	                INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.3', 'HPP', 0,vnhpp,'K',vuser,NOW(),vketerangan,'Penjualan','2');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '5.2', 'Retur Penjualan', vnilai,0,'D',vuser,NOW(),vketerangan,'Retur Penjualan','3');
				
			INSERT INTO tbl_jurnal(no_transaksi,tgl_transaksi,kd_akun,nm_akun,debet,kredit,rk,USER,tgl_update,keterangan,jenis,urut) 
				VALUES(vno_bukti_new, vtgl_bukti, '2.1', 'Hutang', 0, vnilai,'K',vuser,NOW(),vketerangan,'Retur Penjualan','4');
				
		end if;
		
					    			           	                            
			
	END IF;	                     
UNTIL done END REPEAT;	
CLOSE cur_jurnal;  
END block1 */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
