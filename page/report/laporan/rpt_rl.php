<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO-L','0','0',20,'15');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_POST['tgl'];
$tahun = $_POST['tahun'];
$trw = $_POST['bulan'];
$skpd = $_POST['skpd'];
$pa = $_POST['kpa'];
$bk = $_POST['bk'];
$cetak = $_POST['ctk'];

if($trw == '1'){
	$ket = "1 JANUARI S/D 30 JUNI ".$tahun."  ( SEMESTER - I )";
	$bln1 = "1";
	$bln2 = "6";
}else
if($trw == '2'){
	$ket = "1 JULI S/D 31 DESEMBER ".$tahun."  ( SEMESTER - II )";
	$bln1 = "7";
	$bln2 = "12";
}
/*if($trw == '1'){
	$ket = "JANUARI ".$tahun;
	$bln1 = "1";
}else
if($trw == '2'){
	$ket = "FEBRUARI ".$tahun;
	$bln1 = "2";
}else
if($trw == '3'){
	$ket = "MARET ".$tahun;
	$bln1 = "3";
}else
if($trw == '4'){
	$ket = "APRIL ".$tahun;
	$bln1 = "4";
}else
if($trw == '5'){
	$ket = "TRIWULAN KE - I (SATU) ".$tahun;
	$bln1 = "5";
}else
if($trw == '6'){
	$ket = "TRIWULAN KE - II (DUA) ".$tahun;
	$bln1 = "6";
}else
if($trw == '7'){
	$ket = "TRIWULAN KE - II (DUA) ".$tahun;
	$bln1 = "7";
}else
if($trw == '8'){
	$ket = "AGUSTUS ";
	$bln1 = "8";
}else
if($trw == '9'){
	$ket = "SEPTEMBER ";
	$bln1 = "9";
}else
if($trw == '10'){
	$ket = "TRIWULAN KE - III (TIGA) ";
	$bln1 = "10";
}else
if($trw == '11'){
	$ket = "TRIWULAN KE - III (TIGA) ";
	$bln1 = "11";
}else
if($trw == '12'){
	$ket = "TRIWULAN KE - IV (EMPAT) ";
	$bln1 = "12";
}*/
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

$ttd = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='PA'");
$ttd1 = mysqli_fetch_array($ttd);

$res = mysqli_num_rows($ttd);
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


$ttd = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='BK'");
$ttd2 = mysqli_fetch_array($ttd);

$res = mysqli_num_rows($ttd);
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
		<td align=\"right\" style=\"font-size:11px;\" colspan=5><b>Formulir BOS-7A</b></td>
	  </tr>

	  <tr>
		<td align=\"left\" ><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
		<td align=\"center\" style=\"font-size:15px;border:solid 0px black;\" colspan=3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b>
			<h3>REKAPITULASI REALISASI PENGGUNAAN DANA BOS</h3></b>
			$ket<br>TAHUN $tahun</td>
		<td align=\"right\" ><img src=\"../../img/disdik.png\" width=\"95px\" height=\"95px\"></td>
	  </tr>
	  <tr>
		<td align=\"center\" style=\"font-size:11px;width:10%;border-bottom: 4px solid\" colspan=5></td>
	  </tr>
	
	</table>";

echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=left  style=\"font-size:11px;width:20%;\" >NAMA SEKOLAH</td>
		<td align=left  style=\"font-size:11px;width:80%;\" >:&nbsp;$data[map_skpd] - ".strtoupper($nmskpd)."</td>
	  </tr>
            <tr>
                <td align=\"left\" style=\"font-size:11px;\">KABUPATEN/KOTA</td>
                <td align=\"left\" style=\"font-size:11px;\">:&nbsp;TAPANULI SELATAN</td>
            </tr>
			<tr>
                <td align=\"left\" style=\"font-size:11px;\">PROVINSI</td>
                <td align=\"left\" style=\"font-size:11px;\">:&nbsp;SUMATERA UTARA</td>
            </tr>

	</table>";


echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:9px;\">
	  <thead>
	  		<tr>
                <td align=\"center\" width=\"5%\" style=\"font-size:11px\" rowspan=3><b>NO</b></td>
                <td align=\"center\" width=\"15%\" style=\"font-size:11px\" rowspan=3><b>PROGRAM/KEGIATAN</b></td>
                <td align=\"center\" width=\"60%\" style=\"font-size:11px\" colspan=8><b>JENIS BELANJA</b></td>
            <tr>
                <td align=\"center\" width=\"10%\" style=\"font-size:11px\" rowspan=2><b>PENERIMAAN</b></td>
                <td align=\"center\" width=\"10%\" style=\"font-size:11px\" rowspan=2><b>BELANJA PEGAWAI</b></td>
				<td align=\"center\" width=\"20%\" style=\"font-size:11px\" colspan=2><b>BELANJA BARANG DAN JASA</b></td>
				<td align=\"center\" width=\"20%\" style=\"font-size:11px\" colspan=2><b>BELANJA MODAL</b></td>
				<td align=\"center\" width=\"10%\" style=\"font-size:11px\" rowspan=2><b>TOTAL</b></td>
				<td align=\"center\" width=\"10%\" style=\"font-size:11px\" rowspan=2><b>SELISIH</b></td>
            </tr>
			<tr>
                <td align=\"center\" width=\"10%\" style=\"font-size:11px\"><b>PERSEDIAAN</b></td>
                <td align=\"center\" width=\"10%\" style=\"font-size:11px\"><b>BARANG JASA</b></td>
				<td align=\"center\" width=\"10%\" style=\"font-size:11px\"><b>PERALATAN DAN MESIN</b></td>
				<td align=\"center\" width=\"10%\" style=\"font-size:11px\"><b>ASETTETAP LAINNYA</b></td>
            </tr>
	  </thead>";
	  $query_snp = mysqli_query($conn,"SELECT * FROM ms_snp ORDER BY kd_snp");
	  
	  $jump1=0;
	  $jump2=0;
	  $jump3=0;
	  $jump4=0;
	  $jump5=0;
	  $jump6=0;
	  while( $querysnp = mysqli_fetch_array($query_snp)){
	  $baca = mysqli_query($conn,"SELECT
			IFNULL(SUM(CASE WHEN left(a.kd_rek6,4)='5101' THEN a.nilai ELSE 0 END),0) AS pegawai,
			IFNULL(SUM(CASE WHEN a.map_lra1 = '510201' THEN a.nilai ELSE 0 END),0) AS persediaan,
			IFNULL(SUM(CASE WHEN a.map_lra1 = '510202' THEN a.nilai ELSE 0 END),0) AS jasa,
			IFNULL(SUM(CASE WHEN a.map_lra1 = '520201' THEN a.nilai ELSE 0 END),0) AS mesin,
			IFNULL(SUM(CASE WHEN a.map_lra1 = '520501' THEN a.nilai ELSE 0 END),0) AS lainnya,
			IFNULL(SUM(CASE WHEN left(a.kd_rek6,1)='5' THEN a.nilai ELSE 0 END),0) AS belanja
			FROM trdtransout_fktp a WHERE a.kd_skpd='$kode'
			AND MONTH(a.tgl_bukti) between '$bln1' and '$bln2' AND a.kd_snp = '$querysnp[kd_snp]'");
			
		while($fetchArray = mysqli_fetch_array($baca)){
		
		  $jump1=$jump1+$fetchArray[belanja];
		  $jump2=$jump2+$fetchArray[pegawai];
		  $jump3=$jump3+$fetchArray[persediaan];
		  $jump4=$jump4+$fetchArray[jasa];
		  $jump5=$jump5+$fetchArray[mesin];
		  $jump6=$jump6+$fetchArray[lainnya];
			
		echo "<tr>
                <td align=\"center\" style=\"font-size:10px\">$querysnp[kd_snp]</td>
                <td align=\"left\" style=\"font-size:10px\">$querysnp[nm_snp]</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[belanja],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[pegawai],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[persediaan],'2',',','.')."</td>
                <td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[jasa],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[mesin],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[lainnya],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[belanja],'2',',','.')."</td>
				<td align=\"right\" valign=\"top\" style=\"font-size:11px\">".number_format($fetchArray[belanja]-$fetchArray[belanja],'2',',','.')."</td>
            </tr>";
			
			
		}
	  }
	 
		echo "
					 <tr>
						<td colspan=\"2\" valign=\"top\" align=\"left\" style=\"font-size:11px;\"><b>JUMLAH</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump1,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump2,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump3,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump4,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump5,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump6,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump1,'2',',','.')."</b></td>
						<td valign=\"top\" width=\"10%\" align=\"right\" style=\"font-size:11px;\"><b>".number_format($jump1-$jump1,'2',',','.')."</b></td>
					 </tr>";

echo "</table>";

$sal = mysqli_query($conn,"SELECT sum(nilai) as nilai from saldo_awal_fktp where kd_skpd='$kode'");
$datsal = mysqli_fetch_array($sal);

$a = mysqli_query($conn,"SELECT sum(nilai) as nilai from trd_fktp where kd_skpd='$kode' and month(tgl_fktp) < '$bln1' ");
$a1 = mysqli_fetch_array($a);

$b = mysqli_query($conn,"SELECT sum(nilai) as nilai from trdtransout_fktp where kd_skpd='$kode' and month(tgl_bukti) < '$bln1' ");
$b1 = mysqli_fetch_array($b);

$saldo = ($datsal[nilai]+$a1[nilai])-$b1[nilai];

$trm = mysqli_query($conn,"SELECT sum(nilai) as nilai from trd_fktp where kd_skpd='$kode' and month(tgl_fktp) between '$bln1' and '$bln2' ");
$dattrm = mysqli_fetch_array($trm);

$blj = mysqli_query($conn,"SELECT sum(nilai) as nilai from trdtransout_fktp where kd_skpd='$kode' and month(tgl_bukti) between '$bln1' and '$bln2' ");
$datblj = mysqli_fetch_array($blj);

/*$trm = mysqli_query($conn,"SELECT sum(nilai) as nilai from trd_fktp where kd_skpd='$kode' and month(tgl_fktp) = '$bln1'");
$dattrm = mysqli_fetch_array($trm);

$blj = mysqli_query($conn,"SELECT sum(nilai) as nilai from trdtransout_fktp where kd_skpd='$kode' and month(tgl_bukti) = '$bln1'");
$datblj = mysqli_fetch_array($blj);*/
		
echo "<table width=\"100%\" border=\"0\">
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:11px\">&nbsp;</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:11px\">Mengetahui,<br><b>$jabatan_pa</b></td>
					<td align=\"center\" width=\"50%\" style=\"font-size:11px\">-, $tanggal
					<br><b>$jabatan_bk</b></td>
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
