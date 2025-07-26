<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);


$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$id = $_GET['id'];
$skpd = $_GET['skpd'];

/////////////// end ///////////////////////////////////////

			$baca = mysqli_query($conn,"SELECT  * from ms_skpd where (kd_skpd)='$skpd'");
			$data = mysqli_fetch_array($baca);
			$kode = $data['kd_skpd'];
			$nmskpd   = $data['nm_skpd'];
			$map_skpd = $data['map_skpd'];



$baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_sptj,'%d-%m-%Y') AS tgl FROM trhsptj WHERE no_sptj='$id'");
$data = mysqli_fetch_array($baca);
$tgl = $data['tgl_sptj'];

$bl = mysqli_query($conn,"SELECT  * from ms_smt where kd='$data[bulan]' order by kd");
$bca = mysqli_fetch_array($bl);



$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$ttd = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='PA'");
$ttd1 = mysqli_fetch_array($ttd);

$awl = mysqli_query($conn,"SELECT  * FROM saldo_awal_fktp WHERE kd_skpd='$kode'");
$row_awal = mysqli_fetch_array($awl);
$saldo = $row_awal['nilai'];


//PENGEMBALIAN
if($data['bulan']=='1'){
	$str = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_setor_tunai WHERE kd_skpd='$skpd' and MONTH(tgl_bukti) <='6'");
	$str_tunai = mysqli_fetch_array($str);
	$setortunai = $str_tunai['nilai'];
}else{
	$str = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_setor_tunai WHERE kd_skpd='$skpd' and MONTH(tgl_bukti) <='12'");
	$str_tunai = mysqli_fetch_array($str);
	$setortunai = $str_tunai['nilai'];
}

//BUNGA BANK
if($data['bulan']=='1'){
	$bunga = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_bunga_bank WHERE kd_skpd='$skpd' and MONTH(tgl_bukti) <='6'");
	$bunga_bnk = mysqli_fetch_array($bunga);
	$bungabank = $bunga_bnk['nilai'];
}else{
	$bunga = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_bunga_bank WHERE kd_skpd='$skpd' and MONTH(tgl_bukti) <='12'");
	$bunga_bnk = mysqli_fetch_array($bunga);
	$bungabank = $bunga_bnk['nilai'];
}

//ADMIN BANK
if($data['bulan']=='1'){
	$adm = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_admin_bank WHERE kd_skpd='$skpd' and MONTH(tgl_bukti) <='6'");
	$adm_bank = mysqli_fetch_array($adm);
	$adminbank = $adm_bank['nilai'];
}else{
	$adm = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_admin_bank WHERE kd_skpd='$skpd' and MONTH(tgl_bukti) <='12'");
	$adm_bank = mysqli_fetch_array($adm);
	$adminbank = $adm_bank['nilai'];
}

$ttw1 = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('1','2','3','4','5','6')");
$ptw1 = mysqli_fetch_array($ttw1);
$htw1 = number_format($ptw1['nilai']);

$ttw2 = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('7','8','9','10','11','12')");
$ptw2 = mysqli_fetch_array($ttw2);
$htw2 = number_format($ptw2['nilai']);


$tsmt1 = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('1','2','3','4','5','6')");
$psmt1 = mysqli_fetch_array($tsmt1);
$hsmt1 = number_format($psmt1['nilai']);
$tsmt2 = mysqli_query($conn,"SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('7','8','9','10','11','12')");
$psmt2 = mysqli_fetch_array($tsmt2);
$hsmt2 = number_format($psmt2['nilai']);

$totalterima = number_format($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai']);

$res = mysqli_num_rows($ttd);
if($res < 0){
	$nip = 'Belum Ada';
	$nama = 'Belum Ada';
	$jabatan = 'Belum Ada';

}else{
	$nip = $ttd1['nip'];
	$nama = $ttd1['nama'];
	$jabatan = $ttd1['jabatan'];
}

$alm = mysqli_query($conn,"SELECT  * FROM ms_skpd WHERE kd_skpd='$kode'");
$almt = mysqli_fetch_array($alm);


$giat = mysqli_query($conn,"SELECT  kd_sub_kegiatan,nm_sub_kegiatan from trdsptj_belanja where (no_sptj)='$id' group by kd_sub_kegiatan,nm_sub_kegiatan");
$tampil = mysqli_fetch_array($giat);
						   
echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					 <tr>
						<td align=\"left\" ><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
						<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b><h2>
						".strtoupper($data['nm_skpd'])."</h2><b>".strtoupper($almt['alamat'])."</b></td>
						<td align=\"right\" ><img src=\"../../img/disdik.png\" width=\"95px\" height=\"95px\"></td>
					</tr>
					<tr>
						<td align=\"center\" style=\"font-size:12px;width:10%;border-bottom: 4px solid\" colspan=5></td>
					</tr>
					<tr>
					
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
					</tr>
					<tr>
						<td align=\"center\" > </td>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b><U>SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</u></b></td>
						<td align=\"center\" width=\"18%\"> </td>
					</tr>
					<tr>
						<td align=\"center\" > </td>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b>Nomor : $id</b></td>
						<td align=\"center\" width=\"18%\"> </td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Nama Sekolah</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">: $data[nm_skpd]</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Kode Organisasi</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">:  $map_skpd</td>
					</tr>
					
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Kegiatan Dana BOS</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">: $tampil[kd_sub_kegiatan] - $tampil[nm_sub_kegiatan]</td>
					</tr>";
				 
			echo "
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Saya yang bertandatangan dibawah ini ...<B>$nama</B>.... menyatakan bahwa saya bertanggung jawab secara formal dan material atas kebenaran realisasi penerimaan dan pengeluaran Dana BOS serta kebenaran perhitungan dan setoran pajak yang telah dipungut atas penggunaan Dana BOS pada ...<b>$bca[nm]</b>... tahun anggaran ...<b>$tahun1</b>... dengan rincian sebagai berikut :</td>
					</tr>
					 ";
		echo "</table>"; 
		


$bepega = mysqli_query ($conn,"SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj 
where b.kd_skpd='$kode' and bulan = '1' and a.kd_rek6 LIKE '5101%'");  	
$bepeg = mysqli_fetch_array($bepega);
$bpeg = number_format ($bepeg['bpeg']);

$bepega2 = mysqli_query ($conn,"SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '2' and a.kd_rek6 LIKE '5101%'");  	
$bepeg2 = mysqli_fetch_array($bepega2);
$bpeg2 = 0;//number_format ($bepeg2['bpeg']);

//$bepega3 = mysqli_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '3' and a.kd_rek6 LIKE '5101%'");  	
//$bepeg3 = mysqli_fetch_array($bepega3);
//$bpeg3 = number_format ($bepeg3['bpeg']);

		
$bbaja = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '1' and LEFT(a.kd_rek6,6)='5.1.02'");  	
$bbja = mysqli_fetch_array($bbaja); 
$bbj = number_format ($bbja['bbj']);

$bbaja2 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '2' and LEFT(a.kd_rek6,6)='5.1.02'");  	
$bbja2 = mysqli_fetch_array($bbaja2); 
$bbj2 = number_format ($bbja2['bbj']);	

//$bbaja3 = mysqli_query("SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '3' and LEFT(a.kd_rek6,3)='5102'");  	
//$bbja3 = mysqli_fetch_array($bbaja3); 
//$bbj3 = number_format ($bbja3['bbj']);
		
$bmodal = mysqli_query ($conn,"SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '1' and LEFT(a.kd_rek6,3)='5.2'");	
$bmoda = mysqli_fetch_array($bmodal);
$bmod = number_format ($bmoda['bmod']);

$bmodal2 = mysqli_query ($conn,"SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '2' and LEFT(a.kd_rek6,3)='5.2'");	
$bmoda2 = mysqli_fetch_array($bmodal2);
$bmod2 = number_format ($bmoda2['bmod']);

//$bmodal3 = mysqli_query ("SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '3' and a.kd_rek6 LIKE '520%'");	
//$bmoda3 = mysqli_fetch_array($bmodal3);
//$bmod3 = number_format ($bmoda3['bmod']);


if ($data[bulan] == '1'){
$jlh = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);
$jlh2 = number_format (0);
$jlh3 = number_format (0);
$total = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);
} else if ($data[bulan]=='2'){
$jlh = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);
$jlh2 = number_format ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']);
$jlh3 = number_format (0);
$total = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']+$bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']);
}
//else{
//$jlh = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);
//$jlh2 = number_format ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']);
//$jlh3 = number_format ($bepeg3['bpeg'] + $bbja3['bbj'] + $bmoda3['bmod']);
//$total = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']+$bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']+$bepeg3['bpeg'] + $bbja3['bbj'] + $bmoda3['bmod']);
//}

$sisasmt1 = number_format($psmt1['nilai'] - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod']));
$sisasmt2 = number_format($psmt2['nilai'] - ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']));



				
		
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"> 
				    <tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>A.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>SALDO AWAL</b></td>
						<td width=\"25%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ".number_format($saldo).",-</b></td>
					</tr>
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>B.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENGEMBALIAN/BUNGA BANK</b></td>
						<td width=\"25%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ".number_format($setortunai + $bungabank).",-</b></td>
					</tr>
			</table>";
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"> 
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=8><b>C.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENERIMAAN DANA BOS</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Semester I</td>
						<td width=\"25%\"  align=\"right\" style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. $htw1,-";
						echo "</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Semester II</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $htw2;
						}/*else if ($data[bulan]=='3'){
							echo $htw2;
						}*/
						echo ",-</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;</td>
						<td width=\"25%\" align=\"right\" style=\"font-size:12px;border:solid 0px black;\" colspan=0>";
						
						echo "</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2></td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>
						</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Penerimaan</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
							echo number_format($saldo + $ptw1['nilai']);
						} else if ($data[bulan]=='2'){
							echo number_format($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai']);
						}/*else if ($data[bulan]=='3'){
							echo number_format($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] );
						}*/
						echo ",-</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;\"><b>&nbsp;</b></td>
					</tr>
					
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=10><b>D.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENGELUARAN DANA BOS</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Jenis Belanja Pegawai</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>";
							echo $bpeg.',-';
						echo "<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Jenis Belanja Barang dan Jasa</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ";
							echo $bbj.',-';
						echo "<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;3. Jenis Belanja Modal</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ";
							echo $bmod.',-';
						echo "<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Semester I</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
							echo $jlh;
						echo ",-</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Jenis Belanja Pegawai</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ";
						    if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo $bpeg2;
							}
							
						echo ",-</td><td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Jenis Belanja Barang dan Jasa</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ";
							if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo $bbj2;
							}
							
						echo ",-</td><td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;3. Jenis Belanja Modal</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ";
						    if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo $bmod2;
							}
							
						echo ",-</td><td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Semester II</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						    if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo $jlh2;
							}
							
						echo ",-</b></td>
					</tr>
					<!--<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Jenis Belanja Pegawai</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						    if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo '0';
							} else if ($data[bulan]=='3'){
								echo $bpeg3;
							}
							
						echo ",-</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Jenis Belanja Barang dan Jasa</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
							if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo '0';
							} else if ($data[bulan]=='3'){
								echo $bbj3;
							}
							
						echo ",-</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;3. Jenis Belanja Modal</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						    if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo '0';
							} else if ($data[bulan]=='3'){
								echo $bmod3;
							}
							
						echo ",-</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Tahap III</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						    if ($data[bulan] == '1'){
							echo '0';
							} else if ($data[bulan]=='2'){
								echo '0';
							} else if ($data[bulan]=='3'){
								echo $jlh3;
							}
							
						echo ",-</b></td>
					</tr>-->
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Pengeluaran</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
							echo $total;
						echo ",-</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"><b>&nbsp;</b></td>
					</tr>
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=1><B>E.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b>ADMIN BANK</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
							echo number_format($adminbank);
						echo ",-</b></td>
					</tr>
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=4><B>F.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b>SISA DANA BOS</b></td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
						
							echo number_format(($saldo + $setortunai + $bungabank + $psmt1['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $adminbank));
							$kas = ($saldo + $setortunai + $bungabank + $psmt1['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $adminbank);
						
						} else if ($data[bulan]=='2'){
						
							echo number_format(($saldo + $setortunai + $bungabank + $psmt1['nilai'] + $psmt2['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod'] + $adminbank));
							$kas = ($saldo + $setortunai + $bungabank + $psmt1['nilai'] + $psmt2['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod'] + $adminbank);
							
						}
						echo ",-</b></td>
					</tr>";
				
				$sql_awal = mysqli_query ($conn,"SELECT * FROM saldo_awal_fktp WHERE kd_skpd='$kode'");	
				$awl = mysqli_fetch_array($sql_awal);
				$saldo = number_format ($awl['nilai']);	
				
				if ($data[bulan] == '1'){
				$sql_bku1 = mysqli_query ($conn,"SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='6'");
				$sql_bku2 = mysqli_query ($conn,"SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='6'");
				$sql_bku3 = mysqli_query ($conn,"SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$kode' AND MONTH(tgl_kas)<='6' AND jns_trans='2'");
				}else if ($data[bulan] == '2'){
				$sql_bku1 = mysqli_query ($conn,"SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='12'");
				$sql_bku2 = mysqli_query ($conn,"SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='12'");
				$sql_bku3 = mysqli_query ($conn,"SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$kode' AND MONTH(tgl_kas)<='12' AND jns_trans='2'");
				}
				/*else{
				$sql_bku1 = mysqli_query ("SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='12'");
				$sql_bku2 = mysqli_query ("SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='12'");
				$sql_bku3 = mysqli_query ("SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$kode' AND MONTH(tgl_kas)<='12' AND jns_trans='2'");
				}*/
				$buku1 = mysqli_fetch_array($sql_bku1);
				$buku2 = mysqli_fetch_array($sql_bku2);
				$buku3 = mysqli_fetch_array($sql_bku3);
				$terima = number_format ($buku1['terima']);
				$keluar = number_format ($buku2['keluar']);
				$real   = number_format ($buku3['keluar']);
				
				$bank   = $kas;//($awl['nilai']+$buku1['terima'])-$buku2['keluar'];
				$tunai  =  0;//$buku2['keluar']-$buku3['keluar'];

				
				echo "<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4>Terdiri atas:</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Sisa Kas Tunai</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ".number_format($tunai).",-</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Sisa di Bank</td>
						<td width=\"25%\" align=\"right\"  style=\"font-size:12px;border:solid 0px black;\" colspan=0>Rp. ".number_format($bank).",-</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"></td>
					</tr>";
		
		
				  
        echo "</table>";  
		
				
		
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					
					 <tr>
						<td  align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Bukti-bukti atas belanja tersebut pada huruf D disimpan pada  $data[nm_skpd] untuk kelengkapan administrasi dan keperluan pemeriksaan sesuai peraturan perundang-undangan. Apabila bukti-bukti tidak benar yang mengakibatkan kerugian daerah, saya bertanggungjawab sepenuhnya atas kerugian daerah dimaksud sesuai kewenangan saya berdasarkan ketentuan perundang-undangan.<br>&nbsp;<br>Demikian surat pernyataan ini dibuat dengan sebenarnya.	</td>
					</tr> ";
	    echo "</table>";          
					
		echo "<table style=\"border-collapse:collapse;font-size:12px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                   
			
                    
                    <tr>
						<td align=\"center\" width=\"25%\"></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">Tapanuli Selatan, $tanggal</td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\"><b></b></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\"><b>$jabatan</b></td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">&nbsp;</td>
					</tr>                              
                    <tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">&nbsp;</td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\"><b></b></td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\"><b>$nama</b></td>
					</tr>                              
                    <tr>
						<td align=\"center\" width=\"25%\"></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">NIP. $nip</td>
					</tr>
					
                  </table>";



			

	$footer = "";	
	


	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;

?>
