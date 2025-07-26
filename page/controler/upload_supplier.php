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
	mysqli_query($conn,"delete from tbl_supplier");
}
// jumlah default data yang berhasil di import
	$berhasil = 0;
	$nomor_lama = '';
	for ($i=2; $i<=$jumlah_baris; $i++){
	
		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
		$nama        = trim($data->val($i, 1));
		$alamat   	      = trim($data->val($i, 2));
		$kota          = trim($data->val($i, 3));
		$no_telp          = trim($data->val($i, 4));
		$email        = $data->val($i, 5);
	
		if($nama != "" && $alamat != "" && $kota != "" && $no_telp != "" && $email != ""){
		
				// input data ke database (table data_pegawai)
				mysqli_query($conn,"insert into tbl_supplier (nm_supplier,alamat,kota,no_telp,email) 
										   values('$nama','$alamat','$kota','$no_telp','$email')");
				
		
			
			$berhasil++;
			$nomor_lama=$nomor;
		}
	}

unlink($_FILES['filename']['name']);

 				echo "<form action=\"../welcome.php?modul=supplier&aksi=view\" method=\"post\" id=\"success\">
				         <input type=\"hidden\" value=\"Berhasil\" name=\"msg\">
					  </form>";
					
				echo "<script type=\"text/javascript\">
				        alert('Data berhasil tersimpan..');
						document.getElementById('success').submit();
					</script>";
?>