<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);


$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO-L');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_POST['tgl'];
$tahun = $_POST['tahun'];
$skpd = $_POST['skpd'];
$cetak = $_POST['cetak'];
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


					

					

$per = mysqli_query($conn,"SELECT  * FROM ms_thp WHERE kd='$bulan'");
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



						   
echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=2></td>
		<td align=center  style=\"font-size:16px;width:10%;\" ><b>PEMERINTAH KABUPATEN TAPANULI SELATAN<br>LAPORAN REALISASI BELANJA DANA BOS</b></td>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=2></td>
	  </tr>
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" ><h3><B>TAHUN ANGGARAN $tahun</b></h3></td>
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
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Total Realisasi<br>(Rp)</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Sisa Anggaran<br>(Rp)</b></TD>				
					 </TR>
					  <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Tahap I</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Tahap II</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Tahap III</b></TD>	
					 </TR>
					 </thead>";
	  
	  $baca = mysqli_query($conn,"SELECT x.* FROM (
		                        SELECT  left(kd_kegiatan,24) AS kode,nm_snp AS nama,kd_snp AS kodok,'1' AS cek,SUM(nilai) as nilai,'' as norka 
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp
								UNION
								SELECT  left(kd_kegiatan,28) AS kode,nm_peruntukan AS nama,kd_peruntukan AS kodok,'2' AS cek,SUM(nilai) as nilai,
								'' as norka 
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp,kd_peruntukan
								UNION
								SELECT  kd_kegiatan AS kode,nm_kegiatan AS nama,kd_kegiatan AS kodok,'3' AS cek,SUM(nilai) as nilai,
								'' as norka
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp,kd_peruntukan,kd_kegiatan
								UNION
								SELECT  no_trdrka AS kode,nm_rek6 AS nama,kd_rek6 AS kodok,'4' AS cek,nilai as nilai,
								no_trdrka as norka
								FROM trdrkas WHERE kd_skpd='$kode' 
								GROUP BY kd_snp,kd_peruntukan,kd_kegiatan,kd_rek6
								) AS x ORDER BY x.kode,x.cek");
		
			$no = 1;
			$angg = 0;
			$tw1 = 0;
			$tw2 = 0;
			$tw3 = 0;
			$tw4 = 0;		
            while($fetchArray = mysqli_fetch_array($baca)){
			
			
			if($fetchArray['cek']=='1'){
			
				$x1 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,24)='".substr($fetchArray['kode'],0,24)."' and month(tgl_bukti) IN ('1','2','3','4')");
			    $x11 = mysqli_fetch_array($x1);
				
				$x2 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,24)='".substr($fetchArray['kode'],0,24)."' and month(tgl_bukti) IN ('5','6','7','8')");
			    $x12 = mysqli_fetch_array($x2);
				
				$x3 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,24)='".substr($fetchArray['kode'],0,24)."' and month(tgl_bukti) IN ('9','10','11','12')");
			    $x13 = mysqli_fetch_array($x3);
				
				
	 		  echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:12px;\"><b>$fetchArray[kode]</b></TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:12px;\"><b>$fetchArray[nama]</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($fetchArray['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x11['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x12['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x11['nilai']+$x12['nilai']+$x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']),2,",",".")."</b></TD>			
					 </TR>";
			}else
			if($fetchArray['cek']=='2'){
			
				$x1 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,28)='".substr($fetchArray['kode'],0,28)."' and month(tgl_bukti) IN ('1','2','3','4')");
			    $x11 = mysqli_fetch_array($x1);
				
				$x2 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,28)='".substr($fetchArray['kode'],0,28)."' and month(tgl_bukti) IN ('5','6','7','8')");
			    $x12 = mysqli_fetch_array($x2);
				
				$x3 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,28)='".substr($fetchArray['kode'],0,28)."' and month(tgl_bukti) IN ('9','10','11','12')");
			    $x13 = mysqli_fetch_array($x3);
			
				
				
				 echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:12px;\"><b>$fetchArray[kode]</b></TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:12px;\"><b>$fetchArray[nama]</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($fetchArray['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x11['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x12['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x11['nilai']+$x12['nilai']+$x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']),2,",",".")."</b></TD>			
					 </TR>";
			
			
			
			
			}else
			if($fetchArray['cek']=='3'){
			
				 $x1 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,35)='".substr($fetchArray['kode'],0,35)."' and month(tgl_bukti) IN ('1','2','3','4')");
			    $x11 = mysqli_fetch_array($x1);
				
				$x2 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,35)='".substr($fetchArray['kode'],0,35)."' and month(tgl_bukti) IN ('5','6','7','8')");
			    $x12 = mysqli_fetch_array($x2);
				
				$x3 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,35)='".substr($fetchArray['kode'],0,35)."' and month(tgl_bukti) IN ('9','10','11','12')");
			    $x13 = mysqli_fetch_array($x3);		
				
				
				 echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:12px;\"><b><i>$fetchArray[kode]</i></b></TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:12px;\"><b><i>$fetchArray[nama]</i></b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($fetchArray['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x11['nilai'],2,",",".")."</b></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x12['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($x11['nilai']+$x12['nilai']+$x13['nilai'],2,",",".")."</b></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']),2,",",".")."</b></TD>			
					 </TR>";
			
			
			
			
			}else{
			
				$x1 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,35)='".substr($fetchArray['kode'],0,35)."' and a.kd_rek6 = '$fetchArray[kodok]' 
								  and month(tgl_bukti) IN ('1','2','3','4')");
			    $x11 = mysqli_fetch_array($x1);
				
				$x2 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where left(kd_kegiatan,35)='".substr($fetchArray['kode'],0,35)."' and a.kd_rek6 = '$fetchArray[kodok]'  
								  and month(tgl_bukti) IN ('5','6','7','8')");
			    $x12 = mysqli_fetch_array($x2);
				
				$x3 = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdtransout_fktp a 
				                  where a.kd_kegiatan='".substr($fetchArray['kode'],0,35)."' and a.kd_rek6 = '$fetchArray[kodok]' 
								  and month(a.tgl_bukti) IN ('9','10','11','12')");
			    $x13 = mysqli_fetch_array($x3);
				
				$angg = $angg+$fetchArray['nilai'];
				$tw1 = $tw1+$x11['nilai'];
				$tw2 = $tw2+$x12['nilai'];
				$tw3 = $tw3+$x13['nilai'];
			
				echo "<TR>
						<TD width=\"10%\" align=\"left\" style=\"font-size:12px;\">$fetchArray[kode]</TD>
						<TD width=\"30%\" align=\"left\" style=\"font-size:12px;\">$fetchArray[nama]</TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($fetchArray['nilai'],2,",",".")."</TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x11['nilai'],2,",",".")."</TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x12['nilai'],2,",",".")."</TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x13['nilai'],2,",",".")."</TD>	\
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x11['nilai']+$x12['nilai']+$x13['nilai'],2,",",".")."</TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($fetchArray['nilai']-($x11['nilai']+$x12['nilai']+$x13['nilai']),2,",",".")."</TD>			
					 </TR>";
			
			
			
			}
	 
	 $no ++;}
	 
		echo "<TR>
						<TD width=\"30%\" align=\"left\" style=\"font-size:12px;\" colspan=2><h3><b>JUMLAH TOTAL (Rp.)</b></h3></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($angg,2,",",".")."</b></h3></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($tw1,2,",",".")."</b></h3></TD>
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($tw2,2,",",".")."</b></h3></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($tw3,2,",",".")."</b></h3></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($tw1+$tw2+$tw3,2,",",".")."</b></h3></TD>	
						<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><h3><b>".number_format($angg-($tw1+$tw2+$tw3),2,",",".")."</b></h3></TD>			
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
