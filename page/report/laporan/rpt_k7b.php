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






$bl = mysqli_query($conn,"SELECT  * from ms_thp where kd='$trw' order by kd");
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
		<td align=\"right\" style=\"font-size:11px;\" colspan=5><b>Formulir BOS-7B</b></td>
	  </tr>
	  <tr>
		<td align=\"right\" style=\"font-size:11px;\" colspan=5><b>&nbsp;</b></td>
	  </tr>
	  <tr>
		<td align=\"left\" ><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
		<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b>
			<h2>DINAS PENDIDIKAN DAERAH</h2></b>
			<b>".strtoupper($data1[nm_skpd])."</b></td>
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
						<td align=\"left\" colspan=2  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Tanggal Penutupan Kas</td>
						<td align=\"justify\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">:</td>
						<td align=\"justify\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"  colspan=3>$tanggal_sekarang
						</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=2  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Nama Penutup Kas/Pemegang Kas</td>
						<td align=\"justify\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">:</td>
						<td align=\"justify\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>$nama_bk</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=2  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Tanggal Penutupan Kas Yang Lalu </td>
						<td align=\"justify\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">:</td>
						<td align=\"justify\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>$tanggal_lalu
						</td>
					</tr>
	
                    <tr>
						<td align=\"left\" colspan=6>&nbsp;</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Jumlah Total Penerimaan (K) 
						</td>
						<td align=\"right\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"right\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">".number_format($buku[terima])."</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Jumlah Total Pengeluaran (D)
						</td>
						<td align=\"right\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border-bottom:solid 1px black;\">Rp.</td>
						<td align=\"right\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border-bottom:solid 1px black;\">".number_format($buku[keluar])."</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=6>&nbsp;</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Saldo Buku Kas Umum (A)</td>
						<td align=\"right\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"right\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">".number_format($saldo)."</td>
					</tr>
					<tr>
						<td align=\"left\" colspan=4  width=\"45%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\">Saldo Kas</td>
						<td align=\"right\" width=\"5%\" valign=\"top\" style=\"font-size:12px;border-bottom:solid 1px black;\">Rp.</td>
						<td align=\"right\" width=\"50%\" valign=\"top\" style=\"font-size:12px;border-bottom:solid 1px black;\">".number_format($saldo_kas)."</td>
					</tr>
                  </table><br>&nbsp;";

echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
					<tr>
						<td align=\"left\" width=\"100%\" valign=\"top\" style=\"font-size:13px;border:solid 0px black;\" colspan=10><b>Saldo Kas Terdiri Atas (B) :</b></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>1).</b></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>Uang Tunai/Kertas</b></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 100.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_100_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_100_rbu]*100000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 50.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_50_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_50_rbu]*50000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 20.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_20_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_20_rbu]*20000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 10.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_10_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_10_rbu]*10000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 5.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_5_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_5_rbu]*5000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 2.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_2_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_2_rbu]*2000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 1.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[kertas_1_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Lembar</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[kertas_1_rbu]*1000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>";
					$kertas = ($data[kertas_100_rbu]*100000)+($data[kertas_50_rbu]*50000)+($data[kertas_20_rbu]*20000)+($data[kertas_10_rbu]*10000)+($data[kertas_5_rbu]*5000)+
					           ($data[kertas_2_rbu]*2000)+($data[kertas_1_rbu]*1000);
					
				echo "<tr>
						<td align=\"right\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=6><b>Sub Jumlah (1)</b></td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"><b>Rp.</b></td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"><b>".number_format($kertas)."</b></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>2).</b></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>Uang Tunai/Logam</b></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 1.000,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[logam_1_rbu]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Keping</td>
						<td align=\"right\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[logam_1_rbu]*1000)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 500,-</td>

						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[logam_5_rtus]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Keping</td>
						<td align=\"right\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[logam_5_rtus]*500)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 200,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[logam_2_rtus]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Keping</td>
						<td align=\"right\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[logam_2_rtus]*200)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" width=\"20%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Pecahan</td>
						<td align=\"left\" align=\"justify\"  width=\"15%\" style=\"font-size:12px;border:solid 0px black;\">Rp. 100,-</td>
						<td align=\"left\" align=\"justify\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">$data[logam_1_ratus]</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">Keping</td>
						<td align=\"right\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\">Rp.</td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\">".number_format($data[logam_1_ratus]*100)."</td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>";
					$logam=($data[logam_1_rbu]*1000)+($data[logam_5_rtus]*500)+($data[logam_2_rtus]*200)+($data[logam_1_ratus]*100);
					
				echo "<tr>
						<td align=\"right\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=6><b>Sub Jumlah (2)</b></td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"><b>Rp.</b></td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"><b>".number_format($logam)."</b></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"right\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=6>&nbsp;</td>
						<td align=\"left\" align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\"><b></b></td>
						<td align=\"left\" align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\" align=\"justify\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>3).</b></td>
						<td align=\"justify\" width=\"30%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=5><b>Saldo Bank, Surat Berharga, dll. (3)</b></td>
						<td align=\"right\"  width=\"5%\" style=\"font-size:12px;border:solid 0px black;\" valign=top><b>Rp.</b></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\" valign=top><b>".number_format($saldo_bank)."</b></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"right\" width=\"30%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=5><b>Jumlah (1+2+3)</b></td>
						<td align=\"right\"  width=\"5%\" style=\"font-size:12px;border-top:solid 1px black;\" valign=top><b>Rp.</b></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 1px black;\" valign=top></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border-top:solid 1px black;\"></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 1px black;\"><b>".number_format($saldo_bank)."</b></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"justify\" width=\"30%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=5><b>Perbedaan (A-B)</b></td>
						<td align=\"right\"  width=\"5%\" style=\"font-size:12px;border-top:solid 1px black;\" valign=top><b>Rp.</b></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 1px black;\" valign=top></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border-top:solid 1px black;\"></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 1px black;\"><b>".number_format($saldo_bank-$saldo)."</b></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"justify\" width=\"30%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
						<td align=\"right\"  width=\"5%\" style=\"font-size:12px;border-top:solid 0px black;\" valign=top></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\" valign=top></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\"></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"justify\" width=\"30%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
						<td align=\"right\"  width=\"5%\" style=\"font-size:12px;border-top:solid 0px black;\" valign=top></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\" valign=top></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\"></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\"></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"2%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"></td>
						<td align=\"justify\" width=\"30%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
						<td align=\"right\"  width=\"5%\" style=\"font-size:12px;border-top:solid 0px black;\" valign=top></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\" valign=top></td>
						<td align=\"left\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\"></td>
						<td align=\"right\"  width=\"10%\" style=\"font-size:12px;border-top:solid 0px black;\"></td>
					</tr>
		          </table>";       
					
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
                    <tr><td align=\"center\" width=\"25%\"></td>                    
                    <td align=\"center\" width=\"25%\"></td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\" style=\"font-size:12px;border:solid 0px black;\">Yang Diperiksa,</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\" style=\"font-size:12px;border:solid 0px black;\">
					$alamat, $tanggal_sekarang<br>Yang Memeriksa,</td></tr>
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
