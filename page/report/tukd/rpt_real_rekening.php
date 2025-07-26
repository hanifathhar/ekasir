<?php
include '../../config/config.php';
$con = new classConnection();
$con->getOpenCon();
ini_set("memory_limit","-1");
set_time_limit(300);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO-L','0','0',10,'7');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_GET['tgl'];
$tahun = $_GET['tahun'];
$cetak = $_GET['cetak'];
/////////////// end ///////////////////////////////////////

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$baca = mysql_query("SELECT  a.* FROM ms_skpd a	WHERE a.kd_skpd='$skpd'");
$data = mysql_fetch_array($baca);
$nmskpd = $data['nm_skpd'];
$alamat = $data['alamat'];


					

					

$per = mysql_query("SELECT  * FROM ms_tw WHERE kd='$bulan'");
$periode = mysql_fetch_array($per);

$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='1.01.01.01.00' and kode='PA'");
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


$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='1.01.01.01.00' and kode='MB'");
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


						   
echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=2></td>
		<td align=center  style=\"font-size:16px;width:10%;\" ><b>PEMERINTAH KABUPATEN TAPANULI SELATAN<br>REKAPITULASI REALISASI BELANJA SP3B BERDASARKAN SEKOLAH</b></td>
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



echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:9px;\" align=\"center\">
	 				 <thead>
					 <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Kode Sekolah</b></TD>
						<TD width=\"20%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Nama Sekolah</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Anggaran Belanja<br>(Rp)</b></TD>	
						<TD width=\"50%\" align=\"center\" style=\"font-size:12px;\" colspan=5><b>Realisasi Belanja<br>(Rp)</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Sisa Anggaran<br>(Rp)</b></TD>				
					 </TR>
					  <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Triwulan I</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Triwulan II</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Triwulan III</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Triwulan IV</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Total Realisasi</b></TD>	
					 </TR>
					 </thead>";
	  
	        $baca = mysql_query("SELECT  * FROM saldo_awal_fktp ORDER BY kd_skpd");
		
			$no = 1;
			$angg = 0;
			$tw1 = 0;
			$tw2 = 0;
			$tw3 = 0;
			$tw4 = 0;	
            while($fetchArray = mysql_fetch_array($baca)){
			
			
			$a = mysql_query("SELECT IFNULL(SUM(nilai_ubah),0) AS nilai FROM trdrkas where kd_skpd='$fetchArray[kd_skpd]'");
			$b = mysql_fetch_array($a);
			
			$x1 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
				                  left join trhsptj c on b.no_sptj=c.no_sptj 
				                  where c.kd_skpd='$fetchArray[kd_skpd]' and b.bulan='1'");
			$x11 = mysql_fetch_array($x1);
			
			$x2 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
				                  left join trhsptj c on b.no_sptj=c.no_sptj 
				                  where c.kd_skpd='$fetchArray[kd_skpd]' and b.bulan='2'");
			$x22 = mysql_fetch_array($x2);
			
			$x3 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
				                  left join trhsptj c on b.no_sptj=c.no_sptj 
				                  where c.kd_skpd='$fetchArray[kd_skpd]' and b.bulan='3'");
			$x33 = mysql_fetch_array($x3);
			
			$x4 = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
				                  left join trhsptj c on b.no_sptj=c.no_sptj 
				                  where c.kd_skpd='$fetchArray[kd_skpd]' and b.bulan='4'");
			$x44 = mysql_fetch_array($x4);
			
			
			$angg = $angg+$b[nilai];
			$tw1 = $tw1+$x11[nilai];
			$tw2 = $tw2+$x22[nilai];
			$tw3 = $tw3+$x33[nilai];
			$tw4 = $tw4+$x44[nilai];
			
			
				echo "<TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\">$fetchArray[kd_skpd]</TD>
							<TD width=\"20%\" align=\"left\" style=\"font-size:12px;\">$fetchArray[nm_skpd]</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($b[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x11[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x22[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x33[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x44[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($x11[nilai]+$x22[nilai]+$x33[nilai]+$x44[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\">".number_format($b[nilai]-($x11[nilai]+$x22[nilai]+$x33[nilai]+$x44[nilai]),2,",",".")."</TD>			
					 </TR>";
			
			

	 
	 $no ++;}
	 
			 echo "<TR>
						    <TD width=\"30%\" align=\"left\" style=\"font-size:12px;\" colspan=2><b>JUMLAH TOTAL (Rp.)</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($angg,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($tw1,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($tw2,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($tw3,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($tw4,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($tw1+$tw2+$tw3+$tw4,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($angg-($tw1+$tw2+$tw3+$tw4),2,",",".")."</b></TD>			
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
