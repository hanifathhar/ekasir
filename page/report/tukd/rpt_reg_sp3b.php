<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO-L','0','0',10,'7');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////
$tgl = $_POST['tgl'];
$tahun = $_POST['tahun'];
$bulan = $_POST['trw'];
$pa = $_POST['pa'];
$cetak = $_POST['cetak'];
/////////////// end ///////////////////////////////////////

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


					

$per = mysqli_query($conn,"SELECT  * FROM ms_bln WHERE kd='$bulan'");
$periode = mysqli_fetch_array($per);

$ttd = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE nip='$pa'");
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




						   
echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=2></td>
		<td align=center  style=\"font-size:16px;width:10%;\" ><b>PEMERINTAH KABUPATEN TAPANULI SELATAN<br>DINAS PENDIDIKAN DAERAH<br>REGISTER SP2B</b><br><b>PERIODE ".strtoupper($periode['nm'])."</b></td>
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
						<TD width=\"5%\" align=\"center\" style=\"font-size:12px;\"><b>No</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Nomor<br>SP2B</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Tanggal<br>SP2B</b></TD>	
						<TD align=\"center\" style=\"font-size:12px;\"><b>Uraian</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Bulan</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Pendapatan<br>(Rp)</b></TD>	
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Belanja<br>(Rp)</b></TD>			
					 </TR>
					 </thead>";
	  
	  $baca = mysqli_query($conn,"SELECT *,DATE_FORMAT(tgl_sp3b,'%d/%m/%Y') AS tgl FROM trhsp3b WHERE MONTH(tgl_sp3b)<='$bulan' order by no_sp3b,tgl_sp3b");
		
			$no = 1;
			$pen = 0;
			$bel = 0;	
            while($fetchArray = mysqli_fetch_array($baca)){
			
				$a = mysqli_query($conn,"SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdsp3b_pendapatan where no_sp3b='$fetchArray[no_sp3b]'");
				$b = mysqli_fetch_array($a);
				
				$c = mysqli_query($conn,"SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdsp3b_belanja where no_sp3b='$fetchArray[no_sp3b]'");
				$d = mysqli_fetch_array($c);
			
				$sql = mysqli_query($conn,"SELECT  * FROM ms_smt WHERE kd='$fetchArray[bulan]'");
                $bln = mysqli_fetch_array($sql);

				echo "<TR>
						<TD width=\"5%\" align=\"center\" style=\"font-size:12px;\">$no</TD>
							<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\">$fetchArray[no_sp3b]</TD>
							<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\">$fetchArray[tgl]</TD>
							<TD align=\"left\" style=\"font-size:12px;\">$fetchArray[ket]</TD>
							<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\">$bln[nm]</TD>
							<TD width=\"10\" align=\"right\" style=\"font-size:12px;\">".number_format($b[nilai],2,",",".")."</TD>
							<TD width=\"10\" align=\"right\" style=\"font-size:12px;\">".number_format($d[nilai],2,",",".")."</TD>		
					 </TR>";
			
			
			$pen = $pen+$b[nilai];
			$bel = $bel+$d[nilai];

	 
	 $no ++;}
	 
			 echo "<TR>
						    <TD width=\"70%\" align=\"left\" style=\"font-size:12px;\" colspan=5><b>JUMLAH TOTAL (Rp.)</b></TD>
							<TD width=\"10\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($pen,2,",",".")."</b></TD>
							<TD width=\"10\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bel,2,",",".")."</b></TD>		
					 </TR>";
	 

echo "</table>";
echo "<table width=\"100%\" border=\"0\">
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"></td>
					<td align=\"center\" width=\"50%\">Mengetahui,</td>
				</tr>
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"></td>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\">Sipirok, $tanggal
					<br><b>$jabatan_pa</b></td>
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
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"></td>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"><b><u>$nama_pa</u></b><br>$pangkat_pa<br>NIP. $nip_pa</td>
				</tr>
				</table>";

	  
	  



$footer = "Register SP2B - $tahun || Halaman: {PAGENO} dari {nb}";
	

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
