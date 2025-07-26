<?php 
// menghubungkan dengan koneksi
include '../config/config.php';
// menghubungkan dengan library excel reader
include "../config/excel_reader2.php";

$chek = $_POST['chek'];


// upload file xls

$target = basename($_FILES['filename']['name']) ;
move_uploaded_file($_FILES['filename']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filename']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filename']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// hapus data
if($chek == '1'){
	mysqli_query($conn,"delete from tbl_barang");
}
// jumlah default data yang berhasil di import
	$berhasil = 0;
	$nomor_lama = '';
	for ($i=2; $i<=$jumlah_baris; $i++){
	
		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
		$nomor        = trim($data->val($i, 1));
		$nama   	      = trim($data->val($i, 2));
		$kategori          = trim($data->val($i, 3));
		$satuan          = trim($data->val($i, 4));
		$harga_beli        = $data->val($i, 5);
		$harga_jual        = $data->val($i, 6);
		$stock      = $data->val($i, 7);
		$terjual         = $data->val($i, 8);
	
		if($nomor != "" && $nama != "" && $kategori != "" && $satuan != "" && $harga_beli != "" && $harga_jual != ""){
		
			if($nomor_lama <> $nomor ){
				// input data ke database (table data_pegawai)
				mysqli_query($conn,"insert into tbl_barang (kd_barang,nm_barang,kd_kategori,satuan,harga_beli,harga_jual,stock,terjual) 
										   values('$nomor','$nama','$kategori','$satuan','$harga_beli','$harga_jual','$stock','$terjual')");
				
			}
			
			$berhasil++;
			$nomor_lama=$nomor;
		}
	}

unlink($_FILES['filename']['name']);

 				echo "<form action=\"../welcome.php?modul=barang&aksi=view\" method=\"post\" id=\"success\">
				         <input type=\"hidden\" value=\"Berhasil\" name=\"msg\">
					  </form>";
					
				echo "<script type=\"text/javascript\">
				        alert('Data berhasil tersimpan..');
						document.getElementById('success').submit();
					</script>";
?>