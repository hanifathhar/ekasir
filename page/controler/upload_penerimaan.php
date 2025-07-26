<?php 
// menghubungkan dengan koneksi
include '../config/config.php';
// menghubungkan dengan library excel reader
include "../config/excel_reader2.php";

$chek = $_POST['chek'];


// upload file xls


// beri permisi agar file xls dapat di baca
chmod($_FILES['filename']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filename']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// hapus data
if($chek == '1'){
	mysqli_query($conn,"delete from tbl_penerimaan");
}
// jumlah default data yang berhasil di import
	$berhasil = 1;
	$nomor_lama = '';
	for ($i=2; $i<=$jumlah_baris; $i++){
	
		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
		$nomor        = trim($data->val($i, 1));
		$tgl   	      = trim($data->val($i, 2));
		$ket          = trim($data->val($i, 3));
		$rek          = trim($data->val($i, 4));
		$nmrek        = trim($data->val($i, 5));
		$nilai        = $data->val($i, 6);
		$donatur      = trim($data->val($i, 7));
		$bank         = trim($data->val($i, 8));
		$prog      = trim($data->val($i, 9));
		$nmprog         = trim($data->val($i, 10));
		$channel         = trim($data->val($i, 11));
	
		if($nomor != "" && $tgl != "" && $ket != "" && $rek != "" && $nmrek != "" && $nilai != "" && $donatur != "" && $bank != "" && $channel != ""){
		
			if($nomor_lama <> $nomor ){
				// input data ke database (table data_pegawai)
				mysqli_query($conn,"insert into tbl_penerimaan (no_terima,tgl_terima,keterangan,kd_rekening,nm_rekening,nilai,donatur,bank,user,tgl_update,id_program,nm_program,nm_channel) 
										   values('$nomor','$tgl','$ket','$rek','$nmrek','$nilai','$donatur','$bank','$user',NOW(),'$prog','$nmprog','$channel')");
				
			}
			
			$berhasil++;
			$nomor_lama=$nomor;
		}
	}

 echo "<form action=\"../welcome.php?modul=barang&aksi=view\" method=\"post\" id=\"success\">
				         <input type=\"hidden\" value=\"Berhasil\" name=\"msg\">
					  </form>";
					
				echo "<script type=\"text/javascript\">
				        alert('Data berhasil tersimpan..');
						document.getElementById('success').submit();
					</script>";
?>