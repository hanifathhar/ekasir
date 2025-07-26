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
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=3></td>
		<td align=center  style=\"font-size:12px;width:10%;\" ><h3><b>PEMERINTAH KABUPATEN TAPANULI SELATAN<br>DINAS PENDIDIKAN DAERAH<br>REKAPITULASI SALDO DANA BOS PADA SEKOLAH SD DAN SMP NEGERI</b></h3></td>
		<td align=center  style=\"font-size:12px;width:10%;\" rowspan=3></td>
	  </tr>
	  <tr>
		<td align=center  style=\"font-size:12px;width:10%;\" ><h3><B>PERIODE $periode[nm]</b></h3></td>
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




echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:12px;\" align=\"center\">
	 				 <thead>
					 <TR>
						<TD width=\"5%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>NO.</b></TD>
						<TD align=\"center\" style=\"font-size:12px;\" rowspan=2><b>NAMA SEKOLAH</b></TD>
						<TD width=\"30%\" align=\"center\" style=\"font-size:12px;\" colspan=3><b>PENERIMAAN</b></TD>	
						<TD width=\"40%\" align=\"center\" style=\"font-size:12px;\" colspan=4><b>BELANJA</b></TD>	
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>SALDO AKHIR<br>(Rp.)</b></TD>
					 </TR>
					 <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>SALDO AWAL<br>(Rp.)</b></TD>	
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>PENERIMAAN<br>(Rp.)</b></TD>	
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>TOTAL PENERIMAAN<br>(Rp.)</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>BELANJA PEGAWAI<br>(Rp.)</b></TD>	
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>BELANJA BARANG DAN JASA<br>(Rp.)</b></TD>	
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>BELANJA MODAL<br>(Rp.)</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>TOTAL BELANJA<br>(Rp.)</b></TD>
					 </TR>
					 </thead>";
	  
	        $baca = mysqli_query($conn,"SELECT  * FROM saldo_awal_fktp where chek='0' ORDER BY map_skpd");
		
			$no = 1;
			$lalu=0;
			$awal=0;
			$penerimaan=0;
			$jumpenerimaan=0;	
			$bp=0;
			$bj=0;
			$bm=0;
			$jumbelanja=0;
			$akhir=0;	
            while($fetchArray = mysqli_fetch_array($baca)){
			
			

			
			$sql1 = mysqli_query($conn,"SELECT a.kd_skpd,b.nm_skpd,
							SUM(CASE WHEN LEFT(b.kd_rek6,3)='5.1' THEN b.nilai ELSE 0 END) AS jasa,
							SUM(CASE WHEN LEFT(b.kd_rek6,3)='5.2' THEN b.nilai ELSE 0 END) AS modal,
							SUM(CASE WHEN LEFT(b.kd_rek6,1)='5' THEN b.nilai ELSE 0 END) AS total 
							FROM trhsptj a
							LEFT JOIN trdsptj_belanja b ON a.no_sptj=b.no_sptj
							WHERE MONTH(a.tgl_sp3b)<='$bulan' and a.kd_skpd='$fetchArray[kd_skpd]' and a.cair='1'
							GROUP BY a.kd_skpd,b.nm_skpd");
			$bel = mysqli_fetch_array($sql1);
			
			$sql2 = mysqli_query($conn,"SELECT a.kd_skpd,b.nm_skpd,
							SUM(CASE WHEN LEFT(b.kd_rek6,1)='4' THEN b.nilai ELSE 0 END) AS pendapatan
							FROM trhsptj a
							LEFT JOIN trdsptj_pendapatan b ON a.no_sptj=b.no_sptj
							WHERE MONTH(a.tgl_sp3b)<='$bulan' and a.kd_skpd='$fetchArray[kd_skpd]' and a.cair='1'
							GROUP BY a.kd_skpd,b.nm_skpd");
			$pen = mysqli_fetch_array($sql2);
			
			
			
				$sal_akhir = ($fetchArray["nilai"]+$pen["pendapatan"]) - ($bel["total"]);
				echo" <tr>
						<td align=\"center\" style=\"font-size:10px;\">$no</td>
						<td align=\"left\" style=\"font-size:10px;\">$fetchArray[nm_skpd]</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($fetchArray["nilai"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($pen["pendapatan"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($fetchArray["nilai"]+$pen["pendapatan"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">0</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($bel["jasa"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($bel["modal"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($bel["total"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($sal_akhir)."</td>";
				  
				  
					
				echo "</tr>";
				
			
			 $awal=$awal+$fetchArray["nilai"];
			 $penerimaan=$penerimaan+$pen["pendapatan"];
			 $jumpenerimaan=$awal+$penerimaan;	
			
			 $bp=0;
			 $bj=$bj+$bel["jasa"];
			 $bm=$bm+$bel["modal"];
			 $jumbelanja=$jumbelanja+$bel["total"];

	 		 $akhir=$akhir+$sal_akhir;
	         $no ++;}
	 
			   echo "<TR>
							<TD align=\"left\" style=\"font-size:12px;\" colspan=2><b>JUMLAH (Rp.)</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($awal,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($penerimaan,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jumpenerimaan,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>0</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bj,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bm,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jumbelanja,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($akhir,2,",",".")."</b></TD>
					 </TR>";
	 

echo "</table>";


echo "<table width=\"100%\" border=\"0\">
				<tr>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\"></td>
					<td align=\"center\" width=\"50%\" style=\"font-size:12px\">Mengetahui,</td>
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

	  
	  



$footer = "|| Halaman: {PAGENO} dari {nb}";
	

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
