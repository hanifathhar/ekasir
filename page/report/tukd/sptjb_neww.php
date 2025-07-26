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

			$baca = mysql_query("SELECT  * from ms_skpd where md5(kd_skpd)='$skpd'");
			$data = mysql_fetch_array($baca);
			$kode = $data['kd_skpd'];
			$nmskpd   = $data['nm_skpd'];


$baca = mysql_query("SELECT  *,DATE_FORMAT(tgl_sptj,'%d-%m-%Y') AS tgl FROM trhsptj WHERE no_sptj='$id'");
$data = mysql_fetch_array($baca);
$tgl = $data['tgl_sptj'];

$bl = mysql_query("SELECT  * from ms_thp where kd='$data[bulan]' order by kd");
$bca = mysql_fetch_array($bl);



$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='PA'");
$ttd1 = mysql_fetch_array($ttd);

$awl = mysql_query("SELECT  * FROM saldo_awal_fktp WHERE kd_skpd='$kode'");
$row_awal = mysql_fetch_array($awl);
$saldo = $row_awal['nilai'];

$ttw1 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('1','2','3','4')");
$ptw1 = mysql_fetch_array($ttw1);
$htw1 = number_format($ptw1['nilai']);
$ttw2 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('5','6','7','8')");
$ptw2 = mysql_fetch_array($ttw2);
$htw2 = number_format($ptw2['nilai']);
$ttw3 = mysql_query("SELECT  sum(nilai) as nilai FROM trd_fktp WHERE kd_skpd='$kode' and MONTH(tgl_fktp) IN ('9','10','11','12')");
$ptw3 = mysql_fetch_array($ttw3);
$htw3 = number_format($ptw3['nilai']);

$totalterima = number_format($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai']);

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

$alm = mysql_query("SELECT  * FROM ms_skpd WHERE kd_skpd='$kode'");
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
where b.kd_skpd='$kode' and bulan = '1' and a.kd_rek5 LIKE '521%'");  	
$bepeg = mysql_fetch_array($bepega);
$bpeg = number_format ($bepeg['bpeg']);

$bepega2 = mysql_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '2' and a.kd_rek5 LIKE '521%'");  	
$bepeg2 = mysql_fetch_array($bepega2);
$bpeg2 = number_format ($bepeg2['bpeg']);

$bepega3 = mysql_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and a.kd_rek5 LIKE '521%'");  	
$bepeg3 = mysql_fetch_array($bepega3);
$bpeg3 = number_format ($bepeg3['bpeg']);

		
$bbaja = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '1' and a.kd_rek5 LIKE '522%'");  	
$bbja = mysql_fetch_array($bbaja); 
$bbj = number_format ($bbja['bbj']);

$bbaja2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '2' and LEFT(a.kd_rek5,3)='522'");  	
$bbja2 = mysql_fetch_array($bbaja2); 
$bbj2 = number_format ($bbja2['bbj']);	

$bbaja3 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS bbj FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and LEFT(a.kd_rek5,3)='522'");  	
$bbja3 = mysql_fetch_array($bbaja3); 
$bbj3 = number_format ($bbja3['bbj']);
		
$bmodal = mysql_query ("SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '1' and a.kd_rek5 LIKE '523%'");	
$bmoda = mysql_fetch_array($bmodal);
$bmod = number_format ($bmoda['bmod']);

$bmodal2 = mysql_query ("SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and bulan = '2' and a.kd_rek5 LIKE '523%'");	
$bmoda2 = mysql_fetch_array($bmodal2);
$bmod2 = number_format ($bmoda2['bmod']);

$bmodal3 = mysql_query ("SELECT IFNULL(SUM(a.nilai),0) AS bmod FROM trdsptj_belanja a INNER JOIN trhsptj b ON a.no_sptj=b.no_sptj where b.kd_skpd='$kode' and a.kd_rek5 LIKE '523%'");	
$bmoda3 = mysql_fetch_array($bmodal3);
$bmod3 = number_format ($bmoda3['bmod']);

$jlh = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);
$jlh2 = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']+$bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']);
$jlh3 = number_format ($bepeg['bpeg'] + $bbja['bbj'] + $bmoda['bmod']+$bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']+$bepeg3['bpeg'] + $bbja3['bbj'] + $bmoda3['bmod']);

		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"> 
				    <tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"><b>A.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>SALDO AWAL</b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ".number_format($saldo)."</b></b>
					</tr>
			</table>";
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\"> 
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=9><b>B.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENERIMAAN DANA BOS</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Tahap I</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. $htw1";
						echo "</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Tahap II</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo $htw2;
						} else if ($data[bulan]=='3'){
							echo $htw2;
						}
						echo "</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;3. Tahap III</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						if ($data[bulan] == '1'){
							echo '0';
						} else if ($data[bulan]=='2'){
							echo '0';
						}else if ($data[bulan]=='3'){
							echo $htw3;
						}
						echo "</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>&nbsp;</b></td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"><b></b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Penerimaan</b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
							echo number_format($saldo + $ptw1['nilai']);
						} else if ($data[bulan]=='2'){
							echo number_format($saldo + $ptw1['nilai'] + $ptw2['nilai']);
						}else if ($data[bulan]=='3'){
							echo number_format($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai'] );
						}
						echo "</b></td>
					</tr>
					
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;border-bottom: 0px solid\"><b></td>
					</tr>
					
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;\"><b>&nbsp;</b></td>
					</tr>
					
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=5><b>C.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=4><b>PENGELUARAN DANA BOS</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Jenis Belanja Pegawai</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						if ($data[bulan] == '1'){
							echo $bpeg;
						}else if ($data[bulan]=='2'){
							echo $bpeg+$bpeg2  ;
						}else if ($data[bulan]=='3'){
							echo $bpeg3;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Jenis Belanja Barang dan Jasa</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						if ($data[bulan] == '1'){
							echo $bbj;
						} else if ($data[bulan]=='2'){
							echo $bbj+$bbj2;
						}else if ($data[bulan]=='3'){
							echo $bbj3;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;3. Jenis Belanja Modal</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ";
						if ($data[bulan] == '1'){
							echo $bmod;
						} else if ($data[bulan]=='2'){
							echo $bmod+$bmod2;
						}else if ($data[bulan]=='3'){
							echo $bmod3;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b>Jumlah Pengeluaran</b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
							echo $jlh;
						} else if ($data[bulan]=='2'){
							echo $jlh2;
						}
						echo "</b></td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=3 align=\"left\"><b></b></td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\"><b>&nbsp;</b></td>
					</tr>
					<tr>
						<td width=\"1%\" align=\"center\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" rowspan=4><B>D.</b></td>
						<td width=\"50%\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b>SISA DANA BOS</b></td>
						<td width=\"25%\"  style=\"font-size:12px;width:10%;border-bottom: 2px solid\"><b>Rp. ";
						if ($data[bulan] == '1'){
							echo number_format(($saldo + $ptw1['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod']));
							$kas = ($saldo + $ptw1['nilai']) - ($bepeg ['bpeg'] + $bbja['bbj'] + $bmoda['bmod']);

						} else if ($data[bulan]=='2'){
							echo number_format(($saldo + $ptw1['nilai'] + $ptw2['nilai']) - ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']));
							$kas = ($saldo + $ptw1['nilai'] + $ptw2['nilai']) - ($bepeg2['bpeg'] + $bbja2['bbj'] + $bmoda2['bmod']);
						}else if ($data[bulan]=='3	'){
							echo number_format(($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai']) - ($bepeg3['bpeg'] + $bbja3['bbj'] + $bmoda3['bmod']));
							$kas = ($saldo + $ptw1['nilai'] + $ptw2['nilai'] + $ptw3['nilai']) - ($bepeg3['bpeg'] + $bbja3['bbj'] + $bmoda3['bmod']);
						}
						echo "</b></td>
					</tr>";
				
				
				$sql_awal = mysql_query ("SELECT * FROM saldo_awal_fktp WHERE kd_skpd='$kode'");	
				$awl = mysql_fetch_array($sql_awal);
				$saldo = number_format ($awl['nilai']);	
				
				if ($data[bulan] == '1'){
				$sql_bku1 = mysql_query ("SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='4'");
				$sql_bku2 = mysql_query ("SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='4'");
				$sql_bku3 = mysql_query ("SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$kode' AND MONTH(tgl_kas)<='4' AND jns_trans='2'");
				}else if ($data[bulan] == '2'){
				$sql_bku1 = mysql_query ("SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='8'");
				$sql_bku2 = mysql_query ("SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='8'");
				$sql_bku3 = mysql_query ("SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$kode' AND MONTH(tgl_kas)<='8' AND jns_trans='2'");
				}else{
				$sql_bku1 = mysql_query ("SELECT SUM(nilai) AS terima FROM tbl_setor_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='12'");
				$sql_bku2 = mysql_query ("SELECT SUM(nilai) AS keluar FROM tbl_ambil_simpanan WHERE kd_skpd='$kode' AND MONTH(tgl_bukti)<='12'");
				$sql_bku3 = mysql_query ("SELECT SUM(keluar) AS keluar FROM trdrekal WHERE kd_skpd='$kode' AND MONTH(tgl_kas)<='12' AND jns_trans='2'");
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
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;1. Sisa Kas Tunai</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ".number_format($tunai)."</td>
					</tr>
					<tr>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>&nbsp;&nbsp;&nbsp;2. Sisa di Bank</td>
						<td width=\"25%\"  style=\"font-size:12px;border:solid 0px black;\" colspan=2>Rp. ".number_format($bank)."</td>
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
					<tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\"></td>
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
