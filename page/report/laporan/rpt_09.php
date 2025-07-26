<?php
include '../../config/config.php';
$con = new classConnection();
$con->getOpenCon();
ini_set("memory_limit","-1");
set_time_limit(300);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO','0','0','20','15');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_GET['tgl'];
$tahun = $_GET['tahun'];
$bln = $_GET['bulan'];
$skpd = $_GET['skpd'];
$pa = $_GET['pa'];
$bk = $_GET['bk'];
$cetak = $_GET['cetak'];

/*if($trw == '1'){
	$ket = "TRIWULAN KE - I";
	$bln1 = "1";
	$bln2 = "3";
}else
if($trw == '2'){
	$ket = "TRIWULAN KE - II";
	$bln1 = "4";
	$bln2 = "6";
}else
if($trw == '3'){
	$ket = "TRIWULAN KE - III";
	$bln1 = "7";
	$bln2 = "9";
}else
if($trw == '4'){
	$ket = "TRIWULAN KE - IV";
	$bln1 = "10";
	$bln2 = "12";
}*/
/////////////// end ///////////////////////////////////////

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$baca = mysql_query("SELECT  a.* FROM ms_skpd a	WHERE md5(a.kd_skpd)='$skpd'");
$data = mysql_fetch_array($baca);
$kode = $data['kd_skpd'];
$nmskpd = $data['nm_skpd'];
$alamat = $data['alamat'];
$chek   = $data['chek'];

$per = mysql_query("SELECT  * FROM ms_bln WHERE kd='$bulan'");
$periode = mysql_fetch_array($per);

$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='PA'");
$ttd1 = mysql_fetch_array($ttd);

$res = mysql_num_rows($ttd);
if($res < 0){
	$nip_pa = 'Belum Ada';
	$nama_pa = 'Belum Ada';
	$pangkat_pa = 'Belum Ada';
	$jabatan_pa = 'Belum Ada';

}else{
	$nip_pa = $ttd1['nip'];
	$nama_pa = $ttd1['nama'];
	$pangkat_pa = $ttd1['pangkat'];
	$jabatan_pa = $ttd1['jabatan'];
}


$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='BK'");
$ttd2 = mysql_fetch_array($ttd);

$res = mysql_num_rows($ttd);
if($res < 0){
	$nip_bk = 'Belum Ada';
	$nama_bk = 'Belum Ada';
	$pangkat_bk = 'Belum Ada';
	$jabatan_bk = 'Belum Ada';

}else{
	$nip_bk = $ttd2['nip'];
	$nama_bk = $ttd2['nama'];
	$pangkat_bk = $ttd2['pangkat'];
	$jabatan_bk = $ttd2['jabatan'];
}



						   
echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
	  <tr>
		<td align=\"right\" style=\"font-size:11px;\" colspan=5><b>Formulir BOS-09</b></td>
	  </tr>
	
	  <tr>
		<td align=\"left\" ><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
		<td align=\"center\" style=\"font-size:15px;border:solid 0px black;\" colspan=3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b>
			<h3>REKAPITULASI PEMBELIAN BARANG/ASET BOS</h3>
			<h5>SATUAN PENDIDIKAN DASAR PADA</h5>
			<h5>ANGGARAN PENDAPATAN DAN BELANJA DAERAH</h5></b>
			$ket<br>TAHUN $tahun</td>
		<td align=\"right\" ><img src=\"../../img/disdik.png\" width=\"95px\" height=\"95px\"></td>
	  </tr>
	  <tr>
		<td align=\"center\" style=\"font-size:11px;width:10%;border-bottom: 4px solid\" colspan=5></td>
	  </tr>
	  
	</table>";

echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=left  style=\"font-size:11px;width:20%;\" ><br><br>NAMA SEKOLAH</td>
		<td align=left  style=\"font-size:11px;width:80%;\" ><br><br>:&nbsp;$data[map_skpd] - ".strtoupper($nmskpd)."</td>
	  </tr>
            <tr>
                <td align=\"left\" style=\"font-size:11px;\">KABUPATEN/KOTA</td>
                <td align=\"left\" style=\"font-size:11px;\">:&nbsp;TAPANULI SELATAN</td>
            </tr>
			<tr>
                <td align=\"left\" style=\"font-size:11px;\">PROVINSI</td>
                <td align=\"left\" style=\"font-size:11px;\">:&nbsp;SUMATERA UTARA</td>
            </tr>
			<tr>
				<td align=\"left\" style=\"font-size:11px;\">&nbsp;</td>
                <td align=\"left\" style=\"font-size:11px;\"></td>
			</tr>
	 
	</table>";


echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">
	  
	  		<tr>
                <td align=\"center\" width=\"7%\" style=\"height:35px;font-size:11px\" colspan=1><b>NO</b></td>
                <td align=\"center\" width=\"40%\" style=\"height:35px;font-size:11px\" colspan=1><b>NAMA BARANG/ASET</b></td>
				<td align=\"center\" width=\"13%\" style=\"height:35px;font-size:11px\" colspan=1><b>JUMLAH UNIT</b></td>
				<td align=\"center\" width=\"20%\" style=\"height:35px;font-size:11px\" colspan=1><b>HARGA SATUAN (Rp)</b></td>
				<td align=\"center\" width=\"20%\" style=\"height:35px;font-size:11px\" colspan=1><b>JUMLAH (Rp)</b></td>
                
            </tr>";
	  
	    $baca = mysql_query("SELECT DISTINCT b.nm_barang AS barang, b.jumlah AS jumlah, b.nilai AS nilai, b.total AS total 
							FROM trdtransout_fktp a INNER JOIN trdpengadaan_modal b WHERE 
							a.kd_kegiatan = b.kd_kegiatan AND a.kd_skpd='$kode' 
							AND (a.map_lra1 BETWEEN '520201' AND '520501') 
							AND (month(a.tgl_bukti) <= '$bln') ORDER BY a.map_lra1");
		$res = mysql_num_rows($baca);
		if($res > 0){
			$no_urut=0;
			while($fetchArray = mysql_fetch_array($baca)){
				$no_urut++;
					echo "
					<tr>
						<td align=\"center\" width=\"5%\" style=\"height:25px;font-size:11px\" colspan=1>$no_urut</td>
						<td align=\"left\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1>$fetchArray[barang]</td>
						<td align=\"center\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1>$fetchArray[jumlah]</td>
						<td align=\"right\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1>".number_format($fetchArray['nilai'],2,",",".")."</td>
						<td align=\"right\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1>".number_format($fetchArray['total'],2,",",".")."</td>
					</tr>
					";
			}
		}else{
			echo "
				<tr>
					<td align=\"center\" width=\"5%\" style=\"height:25px;font-size:11px\" colspan=1></td>
					<td align=\"center\" width=\"15%\" style=\"height:25px;font-size:30px\" colspan=1>NIHIL</td>
					<td align=\"center\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1></td>
					<td align=\"right\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1></td>
					<td align=\"right\" width=\"15%\" style=\"height:25px;font-size:11px\" colspan=1></td>
				</tr>
					";
		}
echo "</table>";
echo "<table width=\"100%\" border=\"0\" cellpadding=0 cellspacing=0 style=\"border-collapse:0px;\">
				<tr>
					<td align=\"left\" width=\"15%\" style=\"font-size:11px\">&nbsp;</td>
					<td align=\"left\" width=\"2%\"></td>
					<td align=\"left\" width=\"10%\"></td>
					<td align=\"left\"></td>
				</tr>
				
		</table>";
		
echo "<table width=\"100%\" border=\"0\">
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:11px\">Mengetahui,<br><b>$jabatan_pa</b></td>
					<td align=\"center\" width=\"50%\" style=\"font-size:11px\">Tapanuli Selatan, $tanggal
					<br><b>Pemegang Kas Sekolah</b></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\">&nbsp;</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\">&nbsp;</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>";
				if($chek=='1'){
				echo "<tr>
						<td align=\"center\" width=\"50%\" style=\"font-size:11px\"><b><u>$nama_pa</u></b></td>
						<td align=\"center\" width=\"50%\" style=\"font-size:11px\"><b><u>$nama_bk</u></b></td>
					 </tr>";
				}else{
				echo "<tr>
						<td align=\"center\" width=\"50%\" style=\"font-size:11px\"><b><u>$nama_pa</u></b><br>$pangkat_pa<br>NIP. $nip_pa</td>
						<td align=\"center\" width=\"50%\" style=\"font-size:11px\"><b><u>$nama_bk</u></b><br>$pangkat_bk<br>NIP. $nip_bk</td>
					 </tr>";
				}
				echo "</table>";

	  
	  




$footer = "|| Halaman: {PAGENO} dari {nb}";
	

if($cetak=='1')
{
	$xls = new Excel_XML('UTF-8', 'FOLIO','0','0',20,'7');
	$xls->generateXML('BOS09-'.$nmskpd);
}else{
	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;
}
?>
