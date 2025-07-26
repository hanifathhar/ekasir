<?php
include '../../config/config.php';
$con = new classConnection();
$con->getOpenCon();
ini_set("memory_limit","-1");
set_time_limit(4800);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO-L','0','0',10,'7');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_GET['tgl'];
$tahun = $_GET['tahun'];
$skpd = $_GET['skpd'];
$cetak = $_GET['cetak'];
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


					

					

$per = mysql_query("SELECT  * FROM ms_tw WHERE kd='$bulan'");
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

$dpa = mysql_query("SELECT SUM(nilai) AS nilai,  SUM(nilai_ubah) AS nilai_ubah 
					FROM trdrka WHERE kd_skpd='$kode' AND kd_kegiatan='$giat' AND kd_rek5='$rek'");
$dppa = mysql_fetch_array($dpa);
$jml_apbd = $dppa['nilai'];
$jml_papbd = $dppa['nilai_ubah'];

						   
echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=3><img src=\"../../img/logo-blue.png\" width=\"95px\" height=\"95px\"></td>
		<td align=center  style=\"font-size:16px;width:10%;\" ><b>PEMERINTAH KABUPATEN TAPANULI SELATAN</b></td>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=3></td>
	  </tr>
	  <tr>
		<td align=center  style=\"font-size:15px;width:10%;\" ><h2><B>DINAS PENDIDIKAN DAERAH</b></h2></td>
	  </tr>
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" ><h3><B>LAPORAN REALISASI BELANJA DANA BOS<BR>TAHUN ANGGARAN $tahun</b></h3></td>
	  </tr>
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;border-bottom: 4px solid\" colspan=3><h3></h3></td>
	  </tr>
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" >&nbsp;</td>
		<td align=center  style=\"font-size:12px;width:10%;\" >&nbsp;</td>
		<td align=center  style=\"font-size:12px;width:10%;\" >&nbsp;</td>
	  </tr>
	</table>";

echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=left  style=\"font-size:11px;width:10%;\" >NAMA SEKOLAH</td>
		<td align=left  style=\"font-size:11px;width:2%;\" >:</td>
		<td align=left  style=\"font-size:11px;width:88%;\" >$nmskpd</td>
	  </tr>
	  <tr>
		<td align=left  style=\"font-size:11px;width:10%;\" >KABUPATEN/KOTA</td>
		<td align=left  style=\"font-size:11px;width:2%;\" >:</td>
		<td align=left  style=\"font-size:11px;width:88%;\" >KABUPATEN TAPANULI SELATAN</td>
	  </tr>
	  <tr>
		<td align=left  style=\"font-size:11px;width:10%;\" >PROVINSI</td>
		<td align=left  style=\"font-size:11px;width:2%;\" >:</td>
		<td align=left  style=\"font-size:11px;width:88%;\" >SUMATERA UTARA</td>
	  </tr>
	  <tr>
		<td align=left  style=\"font-size:11px;width:10%;\" >SUMBER DANA</td>
		<td align=left  style=\"font-size:11px;width:2%;\" >:</td>
		<td align=left  style=\"font-size:11px;width:88%;\" >DANA BOS</td>
	  </tr>
	</table>";

echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:9px;\" align=\"center\">
	 				 <thead>
					 <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Kode</b></TD>
						<TD width=\"30%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Uraian</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Anggaran Belanja<br>(Rp)</b></TD>	
						<TD width=\"40%\" align=\"center\" style=\"font-size:12px;\" colspan=3><b>Realisasi Belanja (Rp)</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Sisa Anggaran<br>(Rp)</b></TD>				
					 </TR>
					  <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Semester I</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Semester II</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Jumlah<br>Realisasi</b></TD>	
					 </TR>
					 </thead>";
	  
	  $baca = mysql_query("SELECT x.* FROM (
		                        SELECT  left(kd_kegiatan,16) AS kode,nm_snp AS nama,kd_snp AS kodok,'1' AS cek,SUM(nilai) as nilai,'' as norka 
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp
								UNION
								SELECT  left(kd_kegiatan,20) AS kode,nm_peruntukan AS nama,kd_peruntukan AS kodok,'2' AS cek,SUM(nilai) as nilai,
								'' as norka 
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp,kd_peruntukan
								UNION
								SELECT  kd_kegiatan AS kode,nm_kegiatan AS nama,kd_kegiatan AS kodok,'3' AS cek,SUM(nilai) as nilai,
								'' as norka
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp,kd_peruntukan,kd_kegiatan
								UNION
								SELECT  no_trdrka AS kode,nm_rek5 AS nama,kd_rek5 AS kodok,'4' AS cek,nilai as nilai,
								no_trdrka as norka
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp,kd_peruntukan,kd_kegiatan,kd_rek5
								) AS x ORDER BY x.kode,x.cek");
		
			$no = 1;
			$angg = 0;
			$tw1 = 0;
			$tw2 = 0;
			$tw3 = 0;
			$tw4 = 0;		
            while($fetchArray = mysql_fetch_array($baca)){
			
			
			if($fetchArray['cek']=='1'){
			
				$x1 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,16)='".substr($fetchArray['kode'],0,16)."' and month(tgl_bukti) IN ('1','2','3')");
			    $x11 = mysql_fetch_array($x1);
				
				$x2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,16)='".substr($fetchArray['kode'],0,16)."' and month(tgl_bukti) IN ('4','5','6')");
			    $x12 = mysql_fetch_array($x2);
				
				$x3 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,16)='".substr($fetchArray['kode'],0,16)."' and month(tgl_bukti) IN ('7','8','9')");
			    $x13 = mysql_fetch_array($x3);
				
				$x4 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,16)='".substr($fetchArray['kode'],0,16)."' and month(tgl_bukti) IN ('10','11','12')");
			    $x14 = mysql_fetch_array($x4);
				
	 		  echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:10px;\"><b>$fetchArray[kode]</b></TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:10px;\"><b>$fetchArray[nama]</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($fetchArray['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x11['nilai']+$x12['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x13['nilai']+$x14['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai']),2,",",".")."</b></TD>			
					 </TR>";
			}else
			if($fetchArray['cek']=='2'){
			
				$x1 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,20)='".substr($fetchArray['kode'],0,20)."' and month(tgl_bukti) IN ('1','2','3')");
			    $x11 = mysql_fetch_array($x1);
				
				$x2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,20)='".substr($fetchArray['kode'],0,20)."' and month(tgl_bukti) IN ('4','5','6')");
			    $x12 = mysql_fetch_array($x2);
				
				$x3 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,20)='".substr($fetchArray['kode'],0,20)."' and month(tgl_bukti) IN ('7','8','9')");
			    $x13 = mysql_fetch_array($x3);
				
				$x4 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,20)='".substr($fetchArray['kode'],0,20)."' and month(tgl_bukti) IN ('10','11','12')");
			    $x14 = mysql_fetch_array($x4);
			
				
				
				 echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:10px;\"><b>$fetchArray[kode]</b></TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:10px;\"><b>$fetchArray[nama]</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($fetchArray['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x11['nilai']+$x12['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x13['nilai']+$x14['nilai'],2,",",".")."</b></TD>		
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai']),2,",",".")."</b></TD>			
					 </TR>";
			
			
			
			
			}else
			if($fetchArray['cek']=='3'){
			
				$x1 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and month(tgl_bukti) IN ('1','2','3')");
			    $x11 = mysql_fetch_array($x1);
				
				$x2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and month(tgl_bukti) IN ('4','5','6')");
			    $x12 = mysql_fetch_array($x2);
				
				$x3 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and month(tgl_bukti) IN ('7','8','9')");
			    $x13 = mysql_fetch_array($x3);
				
				$x4 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and month(tgl_bukti) IN ('10','11','12')");
			    $x14 = mysql_fetch_array($x4);
			
				
				
				 echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:10px;\"><b><i>$fetchArray[kode]</i></b></TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:10px;\"><b><i>$fetchArray[nama]</i></b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($fetchArray['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x11['nilai']+$x12['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x14['nilai']+$x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\"><b>".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai']),2,",",".")."</b></TD>			
					 </TR>";
			
			
			
			
			}else{
			
				$x1 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and kd_rek5 LIKE '%$fetchArray[kodok]%'  and month(tgl_bukti) IN ('1','2','3')");
			    $x11 = mysql_fetch_array($x1);
				
				$x2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and kd_rek5 LIKE '%$fetchArray[kodok]%'  and month(tgl_bukti) IN ('4','5','6')");
			    $x12 = mysql_fetch_array($x2);
				
				$x3 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and kd_rek5 LIKE '%$fetchArray[kodok]%'  and month(tgl_bukti) IN ('7','8','9')");
			    $x13 = mysql_fetch_array($x3);
				
				$x4 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,27)='".substr($fetchArray['kode'],0,27)."' and kd_rek5 LIKE '%$fetchArray[kodok]%'  and month(tgl_bukti) IN ('10','11','12')");
			    $x14 = mysql_fetch_array($x4);
				
				
				$angg = $angg+$fetchArray['nilai'];
				$tw1 = $tw1+$x11['nilai'];
				$tw2 = $tw2+$x12['nilai'];
				$tw3 = $tw3+$x13['nilai'];
				$tw4 = $tw4+$x14['nilai'];
				$smt1 = $tw1+$tw2;
				$smt2 = $tw3+$tw4;
				$sms1 = $x11['nilai']+$x12['nilai'];
				$sms2 = $x13['nilai']+$x14['nilai'];
			
				echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:10px;\">$fetchArray[kode]</TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:10px;\">$fetchArray[nama]</TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\">".number_format($fetchArray['nilai'],2,",",".")."</TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\">".number_format($x11['nilai']+$x12['nilai'],2,",",".")."</TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\">".number_format($x13['nilai']+$x14['nilai'],2,",",".")."</TD>		
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\">".number_format($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai'],2,",",".")."</TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:10px;\">".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']+$x14['nilai']),2,",",".")."</TD>			
					 </TR>";
			
			
			
			}
	 
	 $no ++;}
	 
		echo "<TR>
						<TD width=\"30%\" align=\"left\" style=\"font-size:12px;\" colspan=2><h3><b>JUMLAH TOTAL (Rp.)</b></h3></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($angg,2,",",".")."</b></h3></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($sms1,2,",",".")."</b></h3></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($sms2,2,",",".")."</b></h3></TD>		
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($sms1+$sms2,2,",",".")."</b></h3></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($angg-($sms1+$sms2),2,",",".")."</b></h3></TD>		
					 </TR>";

echo "</table>";
echo "<table width=\"100%\" border=\"0\">
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\">Mengetahui,</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"><b>$jabatan_pa</b></td>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\">$alamat, $tanggal
					<br><b>$jabatan_bk</b></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\">&nbsp;</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\">&nbsp;</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\">&nbsp;</td>
					<td align=\"center\" width=\"50%\"></td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"><b><u>$nama_pa</u></b><br>$pangkat_pa<br>NIP. $nip_pa</td>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"><b><u>$nama_bk</u></b><br>$pangkat_bk<br>NIP. $nip_bk</td>
				</tr>
				</table>";

	  
	  




//$footer = "Buku Rincian Objek $nmskpd Bulan ".ucwords(strtolower($periode[nm]))." - $tahun || Halaman: {PAGENO} dari {nb}";
	

 if($cetak<>'1')
 {
 	$html = ob_get_contents();
 	ob_end_clean();
 	$mpdf->SetFooter($footer);
 	$mpdf->WriteHTML(utf8_encode($html));
 	$mpdf->Output($nama_dokumen.".pdf" ,'I');
 	exit;
 }
 else
 {
 	$xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
 	$xls->generateXML('Report');

 }
?>
