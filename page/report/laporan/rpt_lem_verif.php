<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO','0','0','20','15');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_POST['tgl'];
$tahun = $_POST['tahun'];
$trw = $_POST['trw'];
$skpd = $_POST['skpd'];
$kv = $_POST['kv'];
$tv = $_POST['tv'];

if($trw == '1'){
	$ket = "1 JANUARI S/D 30 JUNI ".$tahun."  ( TAHAP KE - I )";
	$bln1 = "1";
	$bln2 = "6";
}else
if($trw == '2'){
	$ket = "1 JULI S/D 31 DESEMBER ".$tahun."  ( TAHAP KE - II )";
	$bln1 = "7";
	$bln2 = "12";
}
/////////////// end ///////////////////////////////////////

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$baca = mysqli_query($conn,"SELECT  a.* FROM ms_skpd a	WHERE (a.kd_skpd)='$skpd'");
$data = mysqli_fetch_array($baca);
$kode = $data['kd_skpd'];
$nmskpd = $data['nm_skpd'];
$alamat = $data['alamat'];
$chek   = $data['chek'];

$per = mysqli_query($conn,"SELECT  * FROM ms_bln WHERE kd='$bulan'");
$periode = mysqli_fetch_array($per);

$ttda1 = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE nip='$kv'");
$ttd1 = mysqli_fetch_array($ttda1);

$res = mysqli_num_rows($ttda1);
if($res < 0){
	$nip_kv = 'Belum Ada';
	$nama_kv = 'Belum Ada';
	$pangkat_kv = 'Belum Ada';
	$jabatan_kv = 'Belum Ada';

}else{
	$nip_kv = $ttd1['nip'];
	$nama_kv = $ttd1['nama'];
	$pangkat_kv = $ttd1['pangkat'];
	$jabatan_kv = $ttd1['jabatan'];
}


$ttda2 = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE nip='$tv'");
$ttd2 = mysqli_fetch_array($ttda2);

$res = mysqli_num_rows($ttda2);
if($res < 0){
	$nip_tv = 'Belum Ada';
	$nama_tv = 'Belum Ada';
	$pangkat_tv = 'Belum Ada';
	$jabatan_tv = 'Belum Ada';

}else{
	$nip_tv = $ttd2['nip'];
	$nama_tv = $ttd2['nama'];
	$pangkat_tv = $ttd2['pangkat'];
	$jabatan_tv = $ttd2['jabatan'];
}

$ttda3 = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE kode='kd'");
$ttd3 = mysqli_fetch_array($ttda3);

$res = mysqli_num_rows($ttda3);
if($res < 0){
	$nip_ktv = 'Belum Ada';
	$nama_ktv = 'Belum Ada';
	$pangkat_ktv = 'Belum Ada';
	$jabatan_ktv = 'Belum Ada';

}else{
	$nip_ktv = $ttd3['nip'];
	$nama_ktv = $ttd3['nama'];
	$pangkat_ktv = $ttd3['pangkat'];
	$jabatan_ktv = $ttd3['jabatan'];
}

						   
echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
	  
	  <tr>
		<td align=\"left\" ><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
		<td align=\"center\" style=\"font-size:18px;border:solid 0px black;\" colspan=3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b>
			<h3>DINAS PENDIDIKAN DAERAH</h3></b>
			<b>".strtoupper($nmskpd)."</b></td>
		<td align=\"right\" ><img src=\"../../img/disdik.png\" width=\"95px\" height=\"95px\"></td>
	  </tr>
	  <tr>
		<td align=\"center\" style=\"font-size:12px;width:10%;border-bottom: 4px solid\" colspan=5></td>
	  </tr>
	</table>";

echo "<br><table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
	  	<td></td>
		<td align=\"center\" style=\"font-size:15px;border:solid 0px black;\" colspan=3><h3>LEMBAR VERIFIKASI</h3></b><h4>LAPORAN PERTANGGUNGJAWABAN (LPJ) DANA BOS</h4>
		<h4>".strtoupper($nmskpd)."</h4><h4>KABUPATEN TAPANULI SELATAN</h4><h4>DANA TAHAP $trw </h4><h4>TAHUN $tahun</h4></td>
		<td></td>
	  </tr>
	</table><br>";

echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
	  	<td align=\"left\" style=\"font-size:15px;border:solid 0px black;\"><h5>I. REALISASI BELANJA MENURUT STANDAR</h5></td>
	  </tr>
	</table>";


echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:9px;\">
	  <thead>
	  		<tr>
                <td align=\"center\" width=\"5%\" style=\"font-size:12px\"><b>NO</b></td>
                <td align=\"center\" width=\"80%\" style=\"font-size:12px\"><b>URAIAN</b></td>
                <td align=\"center\" width=\"25%\" style=\"font-size:12px\"><b>JUMLAH (RP)</b></td>
                <td align=\"center\" width=\"15%\" style=\"font-size:12px\"><b>PERSENTASE</b></td>
	  </thead>";
	  
	  $query_snp = mysqli_query($conn,"SELECT * FROM ms_snp ORDER BY kd_snp");
	  $tot_real = mysqli_fetch_array(mysqli_query($conn,"SELECT IFNULL(sum(nilai),0) AS nilai FROM `trdtransout_fktp` WHERE kd_skpd = '$kode' AND (MONTH(tgl_bukti) BETWEEN '$bln1' AND '$bln2')"));
	  $jum_tot = 0;
	  $jum_persen = 0;
	  while( $querysnp = mysqli_fetch_array($query_snp)){
	 	$query = mysqli_fetch_array(mysqli_query($conn,"SELECT IFNULL(sum(nilai),0) AS nilai FROM `trdtransout_fktp` WHERE kd_skpd = '$kode' AND (MONTH(tgl_bukti) BETWEEN '$bln1' AND '$bln2') AND kd_snp = '$querysnp[kd_snp]'"));

		echo "<tr>
                <td align=\"center\" style=\"font-size:12px\">$querysnp[kd_snp]</td>
                <td align=\"left\" style=\"font-size:12px\">$querysnp[nm_snp]</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format($query[nilai],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format((($query[nilai]/$tot_real[nilai])*100),'2',',','.')."</td>

            </tr>";

        $jum_tot = $jum_tot + $query[nilai];
        $jum_persen = $jum_persen + (($query[nilai]/$tot_real[nilai])*100);
						
	  }
   	 
		echo "
					 <tr>
						<td colspan=\"2\" valign=\"top\" align=\"center\" style=\"font-size:12px;\"><b>JUMLAH</b></td>
						<td valign=\"top\" width=\"6%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jum_tot,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"6%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jum_persen)." %</b></td>
					 </tr>";

echo "</table><br>";


echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
	  	<td align=\"left\" style=\"font-size:15px;border:solid 0px black;\"><h5>II. REALISASI BELANJA PER JENIS ANGGARAN</h5></td>
	  </tr>
	</table>";

echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:9px;\">
	  <thead>
	  		<tr>
                <td align=\"center\" width=\"5%\" style=\"font-size:12px\"><b>NO</b></td>
                <td align=\"center\" width=\"80%\" style=\"font-size:12px\"><b>JENIS BELANJA</b></td>
                <td align=\"center\" width=\"25%\" style=\"font-size:12px\"><b>JUMLAH (RP)</b></td>
                <td align=\"center\" width=\"15%\" style=\"font-size:12px\"><b>PERSENTASE</b></td>
	  </thead>";
	  
	  $sql521 = mysqli_fetch_array(mysqli_query($conn,"SELECT IFNULL(sum(nilai),0) AS nilai FROM `trdtransout_fktp` WHERE kd_skpd = '$kode' AND (MONTH(tgl_bukti) BETWEEN '$bln1' AND '$bln2') AND map_lra1 like '5101%'"));
	  $sql522 = mysqli_fetch_array(mysqli_query($conn,"SELECT IFNULL(sum(nilai),0) AS nilai FROM `trdtransout_fktp` WHERE kd_skpd = '$kode' AND (MONTH(tgl_bukti) BETWEEN '$bln1' AND '$bln2') AND map_lra1 like '5102%'"));
	  $sql523 = mysqli_fetch_array(mysqli_query($conn,"SELECT IFNULL(sum(nilai),0) AS nilai FROM `trdtransout_fktp` WHERE kd_skpd = '$kode' AND (MONTH(tgl_bukti) BETWEEN '$bln1' AND '$bln2') AND map_lra1 like '520%'"));
	  $jum_jns_bel = $sql521[nilai] + $sql522[nilai] + $sql523[nilai];
	 
			
		echo "<tr>
                <td align=\"center\" style=\"font-size:12px\">1</td>
                <td align=\"left\" style=\"font-size:12px\">BELANJA PEGAWAI</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format($sql521[nilai],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format((($sql521[nilai]/$jum_jns_bel)*100),'2',',','.')."</td>

            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px\">2</td>
                <td align=\"left\" style=\"font-size:12px\">BELANJA BARANG DAN JASA</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format($sql522[nilai],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format((($sql522[nilai]/$jum_jns_bel)*100),'2',',','.')."</td>

            </tr>
            <tr>
                <td align=\"center\" style=\"font-size:12px\">3</td>
                <td align=\"left\" style=\"font-size:12px\">BELANJA MODAL</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format($sql523[nilai],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:12px\">".number_format((($sql523[nilai]/$jum_jns_bel)*100),'2',',','.')."</td>

            </tr>";

	  





	 
		echo "
					 <tr>
						<td colspan=\"2\" valign=\"top\" align=\"center\" style=\"font-size:12px;\"><b>JUMLAH</b></td>
						<td valign=\"top\" width=\"6%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jum_jns_bel,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"6%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format((($jum_jns_bel/$jum_jns_bel)*100))." %</b></td>
					 </tr>";

echo "</table><br>";



		
echo "<table width=\"100%\" border=\"0\">
				<tr>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\">Mengetahui,<br><b>Ketua Tim Peneliti/Verifikasi LPJ BOS<br>Kab. Tapanuli Selatan</b></td>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\"></td>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\">Sipirok, ...................................$tahun
					<br><b>Tim Peneliti/Verifikasi LPJ BOS<br>Kab. Tapanuli Selatan</b></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>";
				echo "<tr>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\"><b><u>$nama_kv</u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br>NIP. $nip_kv</td>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\"></td>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\"><b><u>$nama_tv</u></b><br>NIP. $nip_tv</td>
					 </tr>

				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"left\" style=\"font-size:12px\"><b></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"center\" ></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>
				<tr>
					<td width=\"30%\" align=\"center\" >&nbsp;</td>
					<td width=\"30%\" align=\"left\"  style=\"font-size:12px\"><b><u></u></b><br></td>
					<td width=\"30%\" align=\"center\" ></td>
				</tr>";
				
				echo "</table>";

	  
	  




$footer = "";
	

if($cetak=='1')
{
	$xls = new Excel_XML('UTF-8', 'FOLIO-L','0','0',20,'7');
	$xls->generateXML('rpt_bku_'.$periode[nm]);
}else{
	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;
}
?>
