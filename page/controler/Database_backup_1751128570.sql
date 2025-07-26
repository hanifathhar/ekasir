

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

INSERT INTO admin VALUES("00001","admin","57b2b28f42a210bf3df12d7878ab7b38","Abdul Hanif Athhar","","081357881355","hanifconsultans@gmail.com","001","Pusat","1","01","Admin","1","2025-01-15 03:42:29","0","");
INSERT INTO admin VALUES("00002","sandy","e10adc3949ba59abbe56e057f20f883e","Roy Sandy Harahap","","081357881355","broer.87@gmail.com","001","Pusat","1","03","Kasir","0","","0","");



CREATE TABLE `admin_grup` (
  `id_grup` char(30) NOT NULL,
  `nm_grup` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_grup`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO admin_grup VALUES("01","Admin");
INSERT INTO admin_grup VALUES("02","Marketing");
INSERT INTO admin_grup VALUES("03","Kasir");
INSERT INTO admin_grup VALUES("04","Sales");



CREATE TABLE `map_laba` (
  `no` int(5) DEFAULT NULL,
  `uraian` varchar(100) DEFAULT NULL,
  `kode` text,
  `nilai` decimal(18,0) DEFAULT NULL,
  `bold` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO map_laba VALUES("1","Pendapatan","","","0");
INSERT INTO map_laba VALUES("2","Penjualan Barang","41","","2");
INSERT INTO map_laba VALUES("3","Retur Penjualan","","","2");
INSERT INTO map_laba VALUES("4","Jumlah","","","1");
INSERT INTO map_laba VALUES("5","","","","2");
INSERT INTO map_laba VALUES("7","Harga Pokok Penjualan","","","0");
INSERT INTO map_laba VALUES("12","Jumlah","","","1");
INSERT INTO map_laba VALUES("13","","","","2");
INSERT INTO map_laba VALUES("8","Persediaan Awal","14","","2");
INSERT INTO map_laba VALUES("9","Pembelian Barang","51","","2");
INSERT INTO map_laba VALUES("10","Retur Pembelian","","","2");
INSERT INTO map_laba VALUES("11","Persediaan Akhir","","","2");
INSERT INTO map_laba VALUES("14","Laba Kotor (Pendapatan - Harga Pokok Penjualan)","","","1");



CREATE TABLE `map_neraca` (
  `no` int(5) DEFAULT NULL,
  `uraian` varchar(100) DEFAULT NULL,
  `kode` text,
  `nilai` decimal(18,0) DEFAULT NULL,
  `bold` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO map_neraca VALUES("1","Aktiva","","","0");
INSERT INTO map_neraca VALUES("2","Kas","11,12","","2");
INSERT INTO map_neraca VALUES("4","Piutang","13","","2");
INSERT INTO map_neraca VALUES("5","Persediaan Barang","14","","2");
INSERT INTO map_neraca VALUES("7","Total Aktiva","11,12,13,14","","1");
INSERT INTO map_neraca VALUES("8","","","","2");
INSERT INTO map_neraca VALUES("9","Kewajiban","","","0");
INSERT INTO map_neraca VALUES("10","Hutang Pembelian","21","","2");
INSERT INTO map_neraca VALUES("11","Kewajiban Jangka Panjang","","","2");
INSERT INTO map_neraca VALUES("12","Total Kewajiban","21","","1");
INSERT INTO map_neraca VALUES("13","","","","2");
INSERT INTO map_neraca VALUES("14","Modal","","","0");
INSERT INTO map_neraca VALUES("15","Modal Disetor","32","","2");
INSERT INTO map_neraca VALUES("16","Laba","","","2");
INSERT INTO map_neraca VALUES("17","Total Modal","32","","1");
INSERT INTO map_neraca VALUES("18","","","","2");
INSERT INTO map_neraca VALUES("19","Total Modal dan Kewajiban","","","1");



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

INSERT INTO modul VALUES("U03","Manajemen User","U","welcome.php?modul=user&aksi=view","welcome.php?modul=user&aksi=view","79","");
INSERT INTO modul VALUES("U02","Group Menu","U","welcome.php?modul=grup&aksi=view","welcome.php?modul=grup&aksi=view","78","");
INSERT INTO modul VALUES("U01","Modul ","U","welcome.php?modul=modul&aksi=view","welcome.php?modul=modul&aksi=view","77","1");
INSERT INTO modul VALUES("M01","Barang","M","welcome.php?modul=barang&aksi=view","","119","");
INSERT INTO modul VALUES("M02","Supplier","M","welcome.php?modul=supplier&aksi=view","","120","");
INSERT INTO modul VALUES("M03","Member","M","welcome.php?modul=member&aksi=view","","121","");
INSERT INTO modul VALUES("A01","Kasir","A","welcome.php?modul=kasir&aksi=input","","122","");
INSERT INTO modul VALUES("B01","Penjualan","B","welcome.php?modul=penjualan&aksi=view","","123","");
INSERT INTO modul VALUES("B02","Pembelian","B","welcome.php?modul=pembelian&aksi=view","","124","");
INSERT INTO modul VALUES("C01","Laporan Cashflow","C","welcome.php?modul=cashflow&aksi=view","","125","");
INSERT INTO modul VALUES("C02","Laporan Stock Barang","C","welcome.php?modul=stock&aksi=view","","126","");
INSERT INTO modul VALUES("B03","Piutang","B","welcome.php?modul=piutang&aksi=view","","127","");
INSERT INTO modul VALUES("B04","Hutang","B","welcome.php?modul=hutang&aksi=view","","128","");
INSERT INTO modul VALUES("B05","Retur Penjualan","B","welcome.php?modul=returpenjualan&aksi=view","","129","");
INSERT INTO modul VALUES("B06","Retur Pembelian","B","welcome.php?modul=returpembelian&aksi=view","","130","");
INSERT INTO modul VALUES("C03","Laporan Laba/Rugi","C","welcome.php?modul=laba&aksi=view","","131","");
INSERT INTO modul VALUES("B07","Modal Disetor","B","welcome.php?modul=modal&aksi=view","","132","");
INSERT INTO modul VALUES("C04","Neraca","C","welcome.php?modul=neraca&aksi=view","","133","");
INSERT INTO modul VALUES("U04","Profil Company","U","welcome.php?modul=company&aksi=view","","134","");



CREATE TABLE `ms_akun` (
  `kd_akun` char(10) DEFAULT NULL,
  `nm_akun` varchar(100) DEFAULT NULL,
  `kd_jns` char(10) DEFAULT NULL,
  `nm_jns` varchar(100) DEFAULT NULL,
  `saldo` char(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO ms_akun VALUES("1.1","Kas","1","Aset","D");
INSERT INTO ms_akun VALUES("1.2","Kas Tunai","1","Aset","D");
INSERT INTO ms_akun VALUES("1.3","Piutang","1","Aset","D");
INSERT INTO ms_akun VALUES("1.4","Persediaan","1","Aset","D");
INSERT INTO ms_akun VALUES("2.1","Hutang","2","Kewajiban","K");
INSERT INTO ms_akun VALUES("3.1","Ekuitas","3","Ekuitas","K");
INSERT INTO ms_akun VALUES("4.1","Penjualan","4","Pendapatan","K");
INSERT INTO ms_akun VALUES("5.1","Pembelian","5","Biaya","D");
INSERT INTO ms_akun VALUES("3.2","Modal Disetor","3","Ekuitas","K");
INSERT INTO ms_akun VALUES("4.2","Retur Pembelian","4","Pendapatan","K");
INSERT INTO ms_akun VALUES("5.2","Retur Penjualan","5","Biaya","D");
INSERT INTO ms_akun VALUES("5.3","HPP","5","Biaya","D");



CREATE TABLE `ms_bulan` (
  `kode` char(5) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO ms_bulan VALUES("01","Januari");
INSERT INTO ms_bulan VALUES("02","Februari");
INSERT INTO ms_bulan VALUES("03","Maret");
INSERT INTO ms_bulan VALUES("04","April");
INSERT INTO ms_bulan VALUES("05","Mei");
INSERT INTO ms_bulan VALUES("06","Juni");
INSERT INTO ms_bulan VALUES("07","Juli");
INSERT INTO ms_bulan VALUES("08","Agustus");
INSERT INTO ms_bulan VALUES("09","September");
INSERT INTO ms_bulan VALUES("10","Oktober");
INSERT INTO ms_bulan VALUES("11","November");
INSERT INTO ms_bulan VALUES("12","Desember");



CREATE TABLE `ms_cabang` (
  `kd_cabang` char(10) NOT NULL,
  `nm_cabang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_cabang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO ms_cabang VALUES("001","Pusat");



CREATE TABLE `ms_exspedisi` (
  `expedisi` varchar(100) NOT NULL,
  PRIMARY KEY (`expedisi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO ms_exspedisi VALUES("JNE");
INSERT INTO ms_exspedisi VALUES("JNT");
INSERT INTO ms_exspedisi VALUES("POS");
INSERT INTO ms_exspedisi VALUES("TIKI");



CREATE TABLE `ms_kategori` (
  `kd_kategori` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO ms_kategori VALUES("1","PLASTIK");



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

INSERT INTO ms_profil VALUES("NAMA TOKO","Jl. Merdeka No. 18 - Padangsidimpuan","081357881355","hanifconsultans@gmail.com","Abd. Hanif Athhar","Direktur","../assets/img/20250619112006_ek.png","","");



CREATE TABLE `ms_satuan` (
  `satuan` char(50) NOT NULL,
  PRIMARY KEY (`satuan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO ms_satuan VALUES("Bungkus");
INSERT INTO ms_satuan VALUES("Kg");
INSERT INTO ms_satuan VALUES("Kotak");
INSERT INTO ms_satuan VALUES("Lusin");
INSERT INTO ms_satuan VALUES("Set");



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

INSERT INTO otori_menu VALUES("14090","U03","Manajemen User","U","welcome.php?modul=user&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14098","M01","Barang","M","welcome.php?modul=barang&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14104","A01","Kasir","A","welcome.php?modul=kasir&aksi=input","03","0");
INSERT INTO otori_menu VALUES("14106","C01","Laporan Cashflow","C","welcome.php?modul=cashflow&aksi=view","02","0");
INSERT INTO otori_menu VALUES("14089","U02","Group Menu","U","welcome.php?modul=grup&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14088","U01","Modul ","U","welcome.php?modul=modul&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14087","M03","Member","M","welcome.php?modul=member&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14086","M02","Supplier","M","welcome.php?modul=supplier&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14085","M01","Barang","M","welcome.php?modul=barang&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14084","C04","Neraca","C","welcome.php?modul=neraca&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14097","C04","Neraca","C","welcome.php?modul=neraca&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14096","C03","Laporan Laba/Rugi","C","welcome.php?modul=laba&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14094","C01","Laporan Cashflow","C","welcome.php?modul=cashflow&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14095","C02","Laporan Stock Barang","C","welcome.php?modul=stock&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14093","B01","Penjualan","B","welcome.php?modul=penjualan&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14092","A01","Kasir","A","welcome.php?modul=kasir&aksi=input","04","0");
INSERT INTO otori_menu VALUES("14082","C02","Laporan Stock Barang","C","welcome.php?modul=stock&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14083","C03","Laporan Laba/Rugi","C","welcome.php?modul=laba&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14081","C01","Laporan Cashflow","C","welcome.php?modul=cashflow&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14079","B06","Retur Pembelian","B","welcome.php?modul=returpembelian&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14080","B07","Modal Disetor","B","welcome.php?modul=modal&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14078","B05","Retur Penjualan","B","welcome.php?modul=returpenjualan&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14077","B04","Hutang","B","welcome.php?modul=hutang&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14076","B03","Piutang","B","welcome.php?modul=piutang&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14075","B02","Pembelian","B","welcome.php?modul=pembelian&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14074","B01","Penjualan","B","welcome.php?modul=penjualan&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14073","A01","Kasir","A","welcome.php?modul=kasir&aksi=input","01","0");
INSERT INTO otori_menu VALUES("14091","U04","Profil Company","U","welcome.php?modul=company&aksi=view","01","0");
INSERT INTO otori_menu VALUES("14099","M02","Supplier","M","welcome.php?modul=supplier&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14100","M03","Member","M","welcome.php?modul=member&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14101","U01","Modul ","U","welcome.php?modul=modul&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14102","U02","Group Menu","U","welcome.php?modul=grup&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14103","U03","Manajemen User","U","welcome.php?modul=user&aksi=view","04","0");
INSERT INTO otori_menu VALUES("14105","C02","Laporan Stock Barang","C","welcome.php?modul=stock&aksi=view","03","0");
INSERT INTO otori_menu VALUES("14107","C02","Laporan Stock Barang","C","welcome.php?modul=stock&aksi=view","02","0");
INSERT INTO otori_menu VALUES("14108","C03","Laporan Laba/Rugi","C","welcome.php?modul=laba&aksi=view","02","0");
INSERT INTO otori_menu VALUES("14109","C04","Neraca","C","welcome.php?modul=neraca&aksi=view","02","0");
INSERT INTO otori_menu VALUES("14110","M01","Barang","M","welcome.php?modul=barang&aksi=view","02","0");
INSERT INTO otori_menu VALUES("14111","M02","Supplier","M","welcome.php?modul=supplier&aksi=view","02","0");
INSERT INTO otori_menu VALUES("14112","M03","Member","M","welcome.php?modul=member&aksi=view","02","0");



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

INSERT INTO tbl_barang VALUES("000001","Kotak JGH 12/12","1","Bungkus","39000","39000","300","0");
INSERT INTO tbl_barang VALUES("000002","Kotak JGH 12/14","1","Bungkus","4000","4000","0","0");
INSERT INTO tbl_barang VALUES("000003","Kotak Minum","1","Bungkus","9500","9500","0","0");
INSERT INTO tbl_barang VALUES("000004","Box Sekat 20/20","1","Bungkus","10000","10000","0","0");
INSERT INTO tbl_barang VALUES("000005","Piring Kue Kertas","1","Bungkus","8500","8500","0","0");
INSERT INTO tbl_barang VALUES("000006","Gelas Es Cream 5 ML","1","Bungkus","5000","5000","0","0");
INSERT INTO tbl_barang VALUES("000007","Gelas Es Cream 100 ML","1","Bungkus","5000","5000","0","0");
INSERT INTO tbl_barang VALUES("000008","Tutup Es Cream","1","Bungkus","2500","2500","0","0");
INSERT INTO tbl_barang VALUES("000009","W 6x10","1","Kg","37000","37000","0","0");
INSERT INTO tbl_barang VALUES("000010","W 8x13","1","Kg","34000","34000","0","0");
INSERT INTO tbl_barang VALUES("000011","W 10x15","1","Kg","33000","33000","0","0");
INSERT INTO tbl_barang VALUES("000012","W 18x20","1","Kg","35000","35000","0","0");
INSERT INTO tbl_barang VALUES("000013","Klip 5x8","1","Pak","35000","35000","0","0");
INSERT INTO tbl_barang VALUES("000014","Klip 7x10","1","Pak","50000","50000","0","0");
INSERT INTO tbl_barang VALUES("000015","Pisau Cutter","1","Lusin","10000","10000","0","0");
INSERT INTO tbl_barang VALUES("000016","Sendok Makan Putih","1","Bungkus","7500","7500","0","0");
INSERT INTO tbl_barang VALUES("000017","Gelad Aqua","1","Bungkus","6000","6000","0","0");
INSERT INTO tbl_barang VALUES("000018","Tenda Kg Ukuran 2x3","1","Set","3500","3500","0","0");
INSERT INTO tbl_barang VALUES("000019","Tenda Kg Ukuran 3x4","1","Set","6300","6300","0","0");
INSERT INTO tbl_barang VALUES("000020","Mantel Pet Tibu PC","1","Lusin","75000","75000","0","0");
INSERT INTO tbl_barang VALUES("000021","Mantel Pet JC","1","Lusin","95000","95000","0","0");



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

INSERT INTO tbl_hutang VALUES("HUT/PJ0000120250623000002","","1","Abd. Hanif Athhar","PJ0000120250623000002","2025-06-23","Retur Penjualan","325000","0","325000","2025-06-26 02:11:15","00001","0");



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

INSERT INTO tbl_jurnal VALUES("MD0000120250618000001","2025-06-18","3.2","Modal Disetor","0","230000000","K","00001","2025-06-18 08:07:58","Modal Disetor","Modal Disetor","2");
INSERT INTO tbl_jurnal VALUES("MD0000120250618000001","2025-06-18","1.2","Kas Bank","230000000","0","D","00001","2025-06-18 08:07:58","Modal Disetor","Modal Disetor","1");
INSERT INTO tbl_jurnal VALUES("PB0000120250629000001","2025-06-29","1.4","Persediaan","11700000","0","D","00001","2025-06-28 09:32:33","CV FAUZAN SURYA SEJATI","Pembelian","1");
INSERT INTO tbl_jurnal VALUES("PB0000120250629000001","2025-06-29","1.1","Kas","0","11700000","K","00001","2025-06-28 09:32:33","CV FAUZAN SURYA SEJATI","Pembelian","2");
INSERT INTO tbl_jurnal VALUES("PB0000120250629000001","2025-06-29","5.1","Pembelian","11700000","0","D","00001","2025-06-28 09:32:33","CV FAUZAN SURYA SEJATI","Pembelian","3");
INSERT INTO tbl_jurnal VALUES("PB0000120250629000001","2025-06-29","0.0","Perubahan Sal","0","11700000","K","00001","2025-06-28 09:32:33","CV FAUZAN SURYA SEJATI","Pembelian","4");



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

INSERT INTO tbl_member VALUES("1","Abd. Hanif Athhar","1989-07-12","6403050207890001","081357881355","hanifconsultans@gmail.com","Perumahan RCM Blok. B12 - Batunadua","Padangsdimpuan");
INSERT INTO tbl_member VALUES("2","Azma Rasya Athhar","2017-05-16","-","081357881355","hanifconsultans@gmail.com","Perumahan RCM Blok B12 Batunadua","Padangsdimpuan");



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

INSERT INTO tbl_modal VALUES("MD0000120250618000001","2025-06-18","Modal Disetor","TRXMOD-001-2025","2","230000000","2025-06-18 08:07:58","00001");



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

INSERT INTO tbl_pembelian VALUES("PB0000120250629000001","2025-06-29","6","CV FAUZAN SURYA SEJATI","PB0000120250629000001","1","","0","11700000","0","0","0","11700000","11700000","0","2025-06-28 09:32:33","00001");



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

INSERT INTO tbl_pembelian_det VALUES("87","PB0000120250629000001","2025-06-29","000001","Kotak JGH 12/12","1","Bungkus","39000","300","11700000","2025-06-28 09:31:47","00001");



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
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;




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

INSERT INTO tbl_piutang VALUES("PIU/PB0000120250618000001","","4","CV . RAJA KARYA","PB0000120250618000001","2025-06-23","Retur Pembelian","165000","0","165000","2025-06-28 08:37:30","00001","0");



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

INSERT INTO tbl_retur_penjualan_det VALUES("78","RJ0000120250626000001","0000-00-00","000001","Plastik Ukuran 1 kg","1","PCS","5000","5500","10","55000","2025-06-26 02:23:55","00001");



CREATE TABLE `tbl_supplier` (
  `id_supplier` int(10) NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(100) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `no_telp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

INSERT INTO tbl_supplier VALUES("4","CV . RAJA KARYA","Perkantoran Bupati Tapanuli Selatan, Desa Situmba Kecamatan SIpirok - Kab. Tapanuli Selatan","SIPIROK","81357881355","hanifconsultans@gmail.com");
INSERT INTO tbl_supplier VALUES("5","CV AFRAH GRAFIKA","Perkantoran Bupati Tapanuli Selatan, Desa Situmba Kecamatan SIpirok - Kab. Tapanuli Selatan","SIPIROK","81357881355","hanifconsultans@gmail.com");
INSERT INTO tbl_supplier VALUES("6","CV FAUZAN SURYA SEJATI","Perkantoran Bupati Tapanuli Selatan, Desa Situmba Kecamatan SIpirok - Kab. Tapanuli Selatan","SIPIROK","81357881355","hanifconsultans@gmail.com");

