<?php
include '../../config/config.php';
$con = new classConnection();
$con->getOpenCon();
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);


$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO','0','0',20,'15');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$id = $_GET['id'];
$skpd = $_GET['skpd'];

/////////////// end ///////////////////////////////////////




$baca = mysql_query("SELECT  *,DATE_FORMAT(tgl_sptj,'%d-%m-%Y') AS tgl FROM trhsptj WHERE no_sptj='$id'");
$data = mysql_fetch_array($baca);
$tgl = $data['tgl_sptj'];

$bl = mysql_query("SELECT  * from ms_smt where kd='$data[bulan]' order by kd");
$bca = mysql_fetch_array($bl);



$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='$skpd' and kode='PA'");
$ttd1 = mysql_fetch_array($ttd);

$awl = mysql_query("SELECT  * FROM saldo_awal_fktp WHERE kd_skpd='$skpd'");
$row_awal = mysql_fetch_array($awl);
$saldo = $row_awal['nilai'];

if ($data[bulan] == '1'){
	$pndptn = mysql_fetch_array(mysql_query("SELECT SUM(nilai) as nilai FROM trd_setor_tunai WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='6'"));
	$pndptnbunga = mysql_fetch_array(mysql_query("SELECT SUM(nilai) as nilai FROM trd_bunga_bank WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='6'"));
	$keluarpjk = mysql_fetch_array(mysql_query("SELECT SUM(nilai) as nilai FROM trd_admin_bank WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='6'"));
} else if ($data[bulan]=='2'){
	$pndptn = mysql_fetch_array(mysql_query("SELECT SUM(nilai) as nilai FROM trd_setor_tunai WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='12'"));
	$pndptnbunga = mysql_fetch_array(mysql_query("SELECT SUM(nilai) as nilai FROM trd_bunga_bank WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='12'"));
	$keluarpjk = mysql_fetch_array(mysql_query("SELECT SUM(nilai) as nilai FROM trd_admin_bank WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='12'"));
}
$pndptn_lain = $pndptn['nilai']+$pndptnbunga['nilai'];
$pengluaran_lain = $keluarpjk['nilai'];

$ttw1 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$skpd' and MONTH(tgl_fktp) IN ('1','2','3')");
$ptw1 = mysql_fetch_array($ttw1);
$htw1 = number_format($ptw1['nilai']);
$ttw2 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$skpd' and MONTH(tgl_fktp) IN ('4','5','6')");
$ptw2 = mysql_fetch_array($ttw2);
$htw2 = number_format($ptw2['nilai']);
$ttw3 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$skpd' and MONTH(tgl_fktp) IN ('7','8','9')");
$ptw3 = mysql_fetch_array($ttw3);
$htw3 = number_format($ptw3['nilai']);
$ttw4 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$skpd' and MONTH(tgl_fktp) IN ('10','11','12')");
$ptw4 = mysql_fetch_array($ttw4);
$htw4 = number_format($ptw4['nilai']);

$totalsmt1 = number_format($ptw1['nilai'] + $ptw2['nilai']);
$totalsmt2 = number_format($ptw3['nilai'] + $ptw4['nilai']);
$totalterima = number_format($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] + $ptw4['nilai']);

$res = mysql_num_rows($ttd);
if($res < 0){
	$nip = 'Belum Ada';
	$nama = 'Belum Ada';
	$jabatan = 'Belum Ada';

}else{
	$nip = $ttd1['nip'];
	$nama = $ttd1['nama'];
	$jabatan = $ttd1['jabatan'];
}

$alm = mysql_query("SELECT  * FROM ms_skpd WHERE kd_skpd='$skpd'");
$almt = mysql_fetch_array($alm);
						   
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
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b><U>SURAT PERNYATAAN TANGGUNG JAWAB</u></b></td>
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
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">:  $data[kd_skpd]</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Nomor/Tanggal DPA</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">: 1.01.02.1.01.02.01.00.16.63.52</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Kegiatan Dana BOS</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">: 1.01.02.1.01.02.01.00.16.63</td>
					</tr>";
				 
			echo "
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Saya yang bertandatangan dibawah ini ...<B>$nama</B>.... menyatakan bahwa saya bertanggung jawab secara formal dan material atas kebenaran realisasi penerimaan dan pengeluaran Dana BOS serta kebenaran perhitungan dan setoran pajak yang telah dipungut atas penggunaan Dana BOS pada ...<b>$bca[nm]</b>... tahun anggaran ...<b>$tahun1</b>... dengan rincian sebagai berikut :</td>
					</tr>
					 ";
		echo "</table>"; 
		


$bepega = mysql_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj 
where b.kd_skpd='$skpd' and bulan = '1' and a.kd_rek5 LIKE '521%'");  	
$bepeg = mysql_fetch_array($bepega);
$bpeg = number_format ($bepeg['bpeg']);

$bepega2 = mysql_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj
where b.kd_skpd='$skpd' and b.bulan = '2' and a.kd_rek5 LIKE '521%'");  	
$bepeg2 = mysql_fetch_array($bepega2);
$bpeg2 = number_format ($bepeg2['bpeg']);

		
$bbaja = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj 
where b.kd_skpd='$skpd' and bulan = '1' and a.kd_rek5 LIKE '522%'");  	
$bbja = mysql_fetch_array($bbaja); 
$bbj = number_format ($bbja['bbj']);

$bbaja2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj 
where b.kd_skpd='$skpd' and b.bulan = '2' and LEFT(a.kd_rek5,3)='522'");  	
$bbja2 = mysql_fetch_array($bbaja2); 
$bbj2 = number_format ($bbja2['bbj']);	
		
$bmodal = mysql_query ("SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj 
where b.kd_skpd='$skpd' and bulan = '1' and a.kd_rek5 LIKE '523%'");	
$bmoda = mysql_fetch_array($bmodal);
$bmod = number_format ($bmoda['bmod']);

$bmodal2 = mysql_query ("SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj 
where b.kd_skpd='$skpd' and b.bulan = '2' and a.kd_rek5 LIKE '523%'");	
$bmoda2 = mysql_fetch_array($bmodal2);
$bmod2 = number_format ($bmoda2['bmod']);

$jlh = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);
$jlh1 = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $pengluaran_lain);
$jlh2 = number_format ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']);
$jlh3 = number_format (($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod'])+($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod'] + $pengluaran_lain));
$sisasmt1 = number_format(($ptw1['nilai'] + $ptw2['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod']));
$sisasmt2 = number_format(($ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] + $ptw4['nilai']) - ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']));
		
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"> 
				    <tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>A.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>SALDO AWAL</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></b>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>".number_format($saldo)."</b></b>
					</tr>
			</table>";
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"> 
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=10><b>B.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENERIMAAN DANA BOS</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;1. Triwulan I</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. $htw1";
						echo "</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;2. Triwulan II</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. $htw2</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Jumlah Semester I</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>$totalsmt1</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;3. Triwulan III</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $htw3;
						}
						echo "</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;4. Triwulan IV</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $htw4;
						}
						echo "</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Jumlah Semester II</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $totalsmt2;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Pendapatan Lain-lain</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>".number_format($pndptn_lain)."</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Jumlah Penerimaan</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
							echo number_format($saldo + $pndptn_lain + $ptw1['nilai'] + $ptw2['nilai']);
						} else if ($data[bulan]=='2'){
							echo number_format($saldo + $pndptn_lain + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] + $ptw4['nilai']);
						}
						echo "</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;\"><b>&nbsp;</b></td>
					</tr>
					
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=12><b>C.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENGELUARAN DANA BOS</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;1. Jenis Belanja Pegawai</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
							echo $bpeg;
						echo "</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;2. Jenis Belanja Barang dan Jasa</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
							echo $bbj;
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;3. Jenis Belanja Modal</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
							echo $bmod;
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Jumlah Semester I</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>";
							echo $jlh;
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;1. Jenis Belanja Pegawai</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $bpeg2;
						}
						echo "</b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;2. Jenis Belanja Barang dan Jasa</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $bbj2;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;3. Jenis Belanja Modal</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $bmod2;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Jumlah Semester II</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $jlh2;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Pengeluaran Lain-lain</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>".number_format($pengluaran_lain)."</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4 align=\"left\"><b>Jumlah Pengeluaran</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>";
						if ($data[bulan] == '1'){
							echo $jlh;
						} else if ($data[bulan]=='2'){
							echo $jlh3;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"><b>&nbsp;</b></td>
					</tr>
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=4><B>D.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>SISA DANA BOS</b></td>
						<td width=\"5%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. </b></td>
						<td width=\"20%\" align=\"right\" style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
							echo number_format(($saldo + $pndptn_lain + $ptw1['nilai'] + $ptw2['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $pengluaran_lain));
							$kas = ($saldo + $pndptn_lain + $ptw1['nilai'] + $ptw2['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $pengluaran_lain);
						} else if ($data[bulan]=='2'){
							echo number_format(($saldo + $pndptn_lain + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] + $ptw4['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod'] + $pengluaran_lain));
							$kas = ($saldo + $pndptn_lain + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] + $ptw4['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod'] + $bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod'] + $pengluaran_lain);
						}
						echo "</b></td>
					</tr>";
				
				
				$sql_awal = mysql_query ("SELECT * FROM saldo_awal_fktp WHERE kd_skpd='$skpd'");	
				$awl = mysql_fetch_array($sql_awal);
				$saldo = number_format ($awl['nilai']);	
				
				if ($data[bulan] == '1'){
					$sql_bku1 = mysql_query ("SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='6'");
					$sql_bku2 = mysql_query ("SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='6' and jns=0");
					$sql_bku3 = mysql_query ("SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$skpd' AND MONTH(tgl_kas)<='6' AND jns_trans IN ('2','6')");
				} else if ($data[bulan]=='2'){
					$sql_bku1 = mysql_query ("SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='12'");
					$sql_bku2 = mysql_query ("SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$skpd' AND MONTH(tgl_bukti)<='12' and jns=0");
					$sql_bku3 = mysql_query ("SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$skpd' AND MONTH(tgl_kas)<='12' AND jns_trans IN ('2','6')");
				}
				
					
				$buku1 = mysql_fetch_array($sql_bku1);
				$buku2 = mysql_fetch_array($sql_bku2);
				$buku3 = mysql_fetch_array($sql_bku3);
				$terima = number_format ($buku1['terima']);
				$keluar = number_format ($buku2['keluar']);
				$real   = number_format ($buku3['keluar']);
				
				$bank   = ($awl['nilai']+$buku1['terima'])-$buku2['keluar'];
				$tunai  =  $buku2['keluar']-$buku3['keluar'];
					
				echo "<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=4>Terdiri atas:</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;1. Sisa Kas Tunai</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ".number_format($tunai)."</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;&nbsp;&nbsp;2. Sisa di Bank</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3>Rp. ".number_format($bank)."</td>
					</tr>";
		
		
				  
        echo "</table>";  
		
				
		
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					
					 <tr>
						<td  align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Bukti-bukti atas belanja tersebut pada huruf C disimpan pada  $data[nm_skpd] untuk kelengkapan administrasi dan keperluan pemeriksaan sesuai peraturan perundang-undangan. Apabila bukti-bukti tidak benar yang mengakibatkan kerugian daerah, saya bertanggungjawab sepenuhnya atas kerugian daerah dimaksud sesuai kewenangan saya berdasarkan ketentuan perundang-undangan.<br>&nbsp;<br>Demikian surat pernyataan ini dibuat dengan sebenarnya.	</td>
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
