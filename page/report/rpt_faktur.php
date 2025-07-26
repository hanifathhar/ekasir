<?php
include '../config/config.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);


$nama_dokumen='Report';
define('_MPDF_PATH','../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO');
require 'php-excel.class.php';
ob_start();

$id = $_POST['id'];

$sql = mysqli_query($conn,"SELECT  * FROM tbl_pembayaran where no_transaksi='$id'");
$data = mysqli_fetch_array($sql);

$tgl = $data['tgl_transaksi'];

	   $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
	   $tahun1 = substr($tgl, 0, 4);
	   $bulan1 = substr($tgl, 5, 2);
	   $tgl1   = substr($tgl, 8, 2);
				 
	   $tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


	   echo "<html>
			<head>
			<title>Faktur Pembayaran</title>
			<style>
				@media print {
					/* Atur gaya untuk pencetakan */
					body { font-family: Arial; }
					/* Tambahkan gaya lainnya sesuai kebutuhan */
				}
				
				#tabel
				{
				font-size:15px;
				border-collapse:collapse;
				}
				#tabel  td
				{
				padding-left:5px;
				border: 1px solid black;
				}
			</style>
			</head>
			<body style='font-family:tahoma; font-size:8pt;'>
			<div id=\"container\">
			<center>
			<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
			<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
			<span style='font-size:12pt'><b>Nama Toko</b></span></br>
			</td>
			<td style='vertical-align:top' width='30%' align='left'>
			<b><span style='font-size:12pt'>FAKTUR PENJUALAN</span></b></br>
			No Trans. : $id</br>
			Tanggal : $tanggal</br>
			</td>
			</table>
			<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
			<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
			Nama Pelanggan : $data[nm_member]</br>
			Alamat : -
			</td>
			<td style='vertical-align:top' width='30%' align='left'>
			No Telp : -
			</td>
			</table>
			<table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>
			 
			<tr align='center'>
				<td width='10%'>Kode Barang</td>
				<td width='20%'>Nama Barang</td>
				<td width='13%'>Harga</td>
				<td width='4%'>Qty</td>
				<td width='13%'>Total Harga</td>
			</tr>";
			
			$baca = mysqli_query($conn,"SELECT  * FROM tbl_penjualan where no_transaksi='$id' ORDER BY id");
			$no = 1;	
			while($fetchArray = mysqli_fetch_array($baca)){
											
			echo "<tr>
					<td style='text-align:center'>$fetchArray[kd_barang]</td>
					<td>$fetchArray[nm_barang]</td>
					<td style='text-align:right'>".number_format($fetchArray['harga'])."</td>
					<td style='text-align:center'>$fetchArray[jumlah]</td>
					<td style='text-align:right'>".number_format($fetchArray['total'])."</td>
				</tr>";
			}
			
			echo " 
			<tr>
				<td colspan = '4'><div style='text-align:right'>Total : </div></td>
				<td style='text-align:right'>".number_format($data['total'])."</td>
			</tr>
			<tr>
				<td colspan = '4'><div style='text-align:right'>Diskon : </div></td>
				<td style='text-align:right'>-".number_format($data['diskon'])." %</td>
			</tr>
			<tr>
				<td colspan = '4'><div style='text-align:right'>Pajak : </div></td>
				<td style='text-align:right'>".number_format($data['pajak'])." %</td>
			</tr>
			<tr>
				<td colspan = '4'><div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div></td>
				<td style='text-align:right'>".number_format($data['grand_total'])."</td>
			</tr>
			<tr>
				<td colspan = '4'><div style='text-align:right'>Cash : </div></td>
				<td style='text-align:right'>".number_format($data['dibayar'])."</td>
			</tr>
			</table>
			 
			<table style='width:650; font-size:7pt;' cellspacing='2'>
			<tr>
			<td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
			<td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td>
			
			<td align='center'>TTD,</br></br><u>(...........)</u></td>
			</tr>
			</table>
			</center>
			</div>
			<script>
				window.print();
			</script>
			</body>
			</html>";

?>
