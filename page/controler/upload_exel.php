<?php 
// menghubungkan dengan koneksi
include '../config/config.php';
$con = new classConnection();
$con->getOpenCon();
// menghubungkan dengan library excel reader
include "../config/excel_reader2.php";

$kosong = $_POST['kosong'];
$user = $_SESSION['id'];

// upload file xls
$target = basename($_FILES['file']['name']) ;
move_uploaded_file($_FILES['file']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['file']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// hapus data
if($kosong == '1'){
	mysql_query("delete from tbl_barang");
}
// jumlah default data yang berhasil di import
$berhasil = 1;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$kategori     = trim($data->val($i, 1));
	$kdbrg   	  = trim($data->val($i, 2));
	$nmbrg        = trim($data->val($i, 3));
	$harga        = $data->val($i, 4);
	$satuan        = $data->val($i, 5);
	$stock        = $data->val($i, 6);

		// input data ke database (table data_pegawai)
		mysql_query("INSERT INTO tbl_barang (id_barang,kd_kategori,kd_barang,nm_barang,satuan,harga_jual,stock,user,tgl_update) 
			                      VALUE('$berhasil','$kategori','$kdbrg','$nmbrg','$satuan','$harga','$stock','$user',NOW())");
		$berhasil++;
		
		
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['file']['name']);

// alihkan halaman ke index.php
// header('location:../welcome.php?modul=kwitansi_multi&aksi=edit&skpd=$skpd&unit=$unit&id=$nom');

 echo "<script type='text/javascript'>
								  setTimeout(function () {  
								  swal({
									title: 'Failed',
									text:  'Gagal..',
									type: 'error',
									timer: 1000
								   });  
								  },10); 
								  window.setTimeout(function(){ 
								  window.location.replace('../welcome.php?modul=mbarang&aksi=view&act=1');
								  } ,1000);   
							 </script>";  
?>