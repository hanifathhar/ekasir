<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);


$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO','0','0',20,'15');
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

/////////////// end ///////////////////////////////////////

if($trw=='1'){
$bln = '6';
}else{
$bln ='12';
}



$bl = mysqli_query($conn,"SELECT  * from ms_thp where kd='$data[trw]' order by kd");
$bca = mysqli_fetch_array($bl);

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);

$tahun2 = substr($tgl, 0, 4);
$bulan2 = substr($tgl, 5, 2);
$tgl2   = substr($tgl, 8, 2);

				 
$tanggal_lalu = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;
$tanggal_sekarang = $tgl2 . " " . $BulanIndo[(int)$bulan2-1] . " ". $tahun2;

$baca1 = mysqli_query($conn,"SELECT  a.* FROM ms_skpd a	WHERE (a.kd_skpd)='$skpd'");
$data1 = mysqli_fetch_array($baca1);
$kode = $data1['kd_skpd'];
$nmskpd = $data1['nm_skpd'];


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



$alm = mysqli_query($conn,"SELECT  * FROM ms_skpd WHERE kd_skpd='$skpd'");
$almt = mysqli_fetch_array($alm);

$sal = mysqli_query($conn,"SELECT  * FROM saldo_awal_fktp WHERE kd_skpd='$skpd'");
$saldo = mysqli_fetch_array($sal);


$sql_bku = mysqli_query($conn,"SELECT  SUM(terima) as terima,SUM(keluar) as keluar FROM trdrekal WHERE kd_skpd='$skpd' and month(tgl_kas)<='$bln'");
$buku = mysqli_fetch_array($sql_bku);

$saldo = ($saldo['nilai']+$buku['terima'])-$buku['keluar'];
$saldo_kas  = 0;
$saldo_bank = $saldo;
						   
echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
	  <tr>
		<td align=\"right\" style=\"font-size:11px;\" colspan=5><b>Formulir BOS-7C</b></td>
	  </tr>
	  <tr>
		<td align=\"right\" style=\"font-size:11px;\" colspan=5><b>&nbsp;</b></td>
	  </tr>
	  <tr>
		<td align=\"left\" ><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
		<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b>
			<h2>DINAS PENDIDIKAN DAERAH</h2></b>
			<b>".strtoupper($data[nm_skpd])."</b></td>
		<td align=\"right\" ><img src=\"../../img/disdik.png\" width=\"95px\" height=\"95px\"></td>
	  </tr>
	  <tr>
		<td align=\"center\" style=\"font-size:11px;width:10%;border-bottom: 4px solid\" colspan=5></td>
	  </tr>
	  <tr>				
		<td align=\"center\" style=\"font-size:11px;border:solid 0px black;\" colspan=5>&nbsp;</td>
	  </tr>
	</table>";
		
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
       
	   				
	
                    <tr>
						<td align=\"justify\" style=\"font-size:12px;\" colspan=6>Pada hari ini tanggal ".terbilang($tgl2)." bulan ".$BulanIndo[(int)$bulan2-1]." Tahun ".terbilang($tahun2)." yang bertanda tagan di bawah ini , kami Kepala Sekolah yang ditunjuk berdasarkan Surat Keputusan Nomor : </td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6></td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama 
						</td>
						<td align=\"center\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">:</td>
						<td align=\"left\" width=\"70%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">$nama_pa</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"20%\" valign=\"top\" style=\"font-size:12px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan
						</td>
						<td align=\"center\" width=\"5%\" valign=\"top\" style=\"font-size:12px;\">:</td>
						<td align=\"left\" width=\"70%\" valign=\"top\" style=\"font-size:12px;\">$jabatan_pa</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6>Melakukan Pemeriksaan Kas Kepada :</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6></td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama 
						</td>
						<td align=\"center\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">:</td>
						<td align=\"left\" width=\"70%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">$nama_bk</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan
						</td>
						<td align=\"center\" width=\"5%\" valign=\"top\" style=\"font-size:12px;\">:</td>
						<td align=\"left\" width=\"70%\" valign=\"top\" style=\"font-size:12px;\">$jabatan_bk</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6>&nbsp;</td>
					</tr>
					 <tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6>yang berdasarkan Surat Keputusan No. ............................... Tanggal .......................... ditugaskan dengan pengurusan uang</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6>Berdasarkan pemeriksaan kas serta ukti-bukti dalam pengurusan itu, kami menemui kenyataan sebagai berikut : </td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;\" colspan=6>&nbsp;</td>
					</tr>
                  </table>";

echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
					<tr>
						<td align=\"justify\" width=\"100%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=7>Jumlah uang yang dihitung dihadapan Bendahara/Pemegang Kas adalah : </td>
					</tr>";
					
					$kertas = ($data[kertas_100_rbu]*100000)+($data[kertas_50_rbu]*50000)+($data[kertas_20_rbu]*20000)+($data[kertas_10_rbu]*10000)+($data[kertas_5_rbu]*5000)+
					           ($data[kertas_2_rbu]*2000)+($data[kertas_1_rbu]*1000);
					
				
					$logam=($data[logam_1_rbu]*1000)+($data[logam_5_rtus]*500)+($data[logam_2_rtus]*200)+($data[logam_1_ratus]*100);
					
				echo "<tr>
						<td align=\"center\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">1).</td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Uang Kertas, Uang Logam</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($kertas+$logam)."</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">2).</td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Saldo Bank</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($saldo_bank)."</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">3).</td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Surat Berharga, dll.</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border-bottom:solid 1px black;\">Rp.</td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border-bottom:solid 1px black;\">0</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b></b></td>
						<td align=\"right\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>Jumlah</b></td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"><b>Rp.</b></td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\"><b>".number_format($saldo_bank)."</b></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=2>Saldo Menurut Buku Kas Umum</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($saldo)."</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=2>Perbedaan antara saldo kas dan saldo buku</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($saldo-$saldo_bank)."</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;</td>
						<td align=\"center\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"right\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
				
		          </table>";       
					
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
                    <tr><td align=\"center\" width=\"25%\"></td>                    
                    <td align=\"center\" width=\"25%\"></td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\" style=\"font-size:12px;border:solid 0px black;\">Bendahara/Pemegang Kas,</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px;border:solid 0px black;\">
					$alamat, $tanggal_sekarang,</td></tr>
                    <tr><td align=\"center\" width=\"25%\" style=\"font-size:12px;border:solid 0px black;\"><b>$jabatan_bk</b></td>                    
                    <td align=\"center\" width=\"25%\" ></td>
                    <td align=\"center\" width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"><b>$jabatan_pa</b></td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>                              
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\" style=\"font-size:12px;border:solid 0px black;\"><u><b>$nama_bk</b></u><br>NIP. $nip_bk</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"><u><b>$nama_pa</b></u><br>NIP. $nip_pa</td></tr>                              
                    
                  </table>";




	$footer = "";	
	


	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;

?>
