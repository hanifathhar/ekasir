<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO-L','0','0',20,'7');
require '../php-excel.class.php';
ob_start();
/////////////// Vareabel Cetak /////////////////////////////

$id = $_GET['id'];
$skpd = $_GET['skpd'];
$baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_sp3b,'%d-%m-%Y') AS tgl FROM trhsp3b WHERE no_sp3b='$id'");
$data = mysqli_fetch_array($baca);

$bl = mysqli_query($conn,"SELECT  * from ms_smt where kd='$data[bulan]' order by kd");
$bca = mysqli_fetch_array($bl);

/////////////// end ///////////////////////////////////////



						   
echo "<table width=100% cellpadding=0 cellspacing=0 border=0 style=\"border-collapse:0px; font-size:9px;\">
	  <tr>
		<td align=left  style=\"font-size:12px;width:10%;\">NOMOR SP2B</td>
		<td align=left  style=\"font-size:12px;\">: $id</td>
	  </tr>
	  <tr>
		<td align=left  style=\"font-size:12px;width:10%;\">TANGGAL SP2B</td>
		<td align=left  style=\"font-size:12px;\">: $data[tgl]</td>
	  </tr>
	  <tr>
		<td align=left  style=\"font-size:12px;width:10%;\">SEMESTER</td>
		<td align=left  style=\"font-size:12px;\">: ".strtoupper($bca['nm'])."</td>
	  </tr>
	 <tr>
		<td align=left  style=\"font-size:12px;width:10%;\">&nbsp;</td>
		<td align=left  style=\"font-size:12px;\"></td>
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
			
			
			$x = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsptj_pendapatan a left join trhsptj b on a.no_sptj=b.no_sptj 
                  where LEFT(b.no_sp3b,5)<'".substr($id,0,5)."' and b.kd_skpd='$fetchArray[kd_skpd]' and b.cair='1'");
			$xx = mysqli_fetch_array($x);
			$terima_lalu = $xx['nilai'];
						
			$y = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsptj_belanja a left join trhsptj b on a.no_sptj=b.no_sptj 
							  where LEFT(b.no_sp3b,5)<'".substr($id,0,5)."' and b.kd_skpd='$fetchArray[kd_skpd]' and b.cair='1'");
			$yy = mysqli_fetch_array($y);
			$keluar_lalu = $yy['nilai'];

			
			$sql1 = mysqli_query($conn,"SELECT a.kd_skpd,b.nm_skpd,
							SUM(CASE WHEN LEFT(b.kd_rek6,3)='5.1' THEN b.nilai ELSE 0 END) AS jasa,
							SUM(CASE WHEN LEFT(b.kd_rek6,3)='5.2' THEN b.nilai ELSE 0 END) AS modal,
							SUM(CASE WHEN LEFT(b.kd_rek6,1)='5' THEN b.nilai ELSE 0 END) AS total 
							FROM trhsptj a
							LEFT JOIN trdsptj_belanja b ON a.no_sptj=b.no_sptj
							WHERE a.no_sp3b='$id' and a.kd_skpd='$fetchArray[kd_skpd]'
							GROUP BY a.kd_skpd,b.nm_skpd");
			$bel = mysqli_fetch_array($sql1);
			
			$sql2 = mysqli_query($conn,"SELECT a.kd_skpd,b.nm_skpd,
							SUM(CASE WHEN LEFT(b.kd_rek6,1)='4' THEN b.nilai ELSE 0 END) AS pendapatan
							FROM trhsptj a
							LEFT JOIN trdsptj_pendapatan b ON a.no_sptj=b.no_sptj
							WHERE a.no_sp3b='$id' and a.kd_skpd='$fetchArray[kd_skpd]'
							GROUP BY a.kd_skpd,b.nm_skpd");
			$pen = mysqli_fetch_array($sql2);
			
			
			
				$sal_akhir = ($terima_lalu+$fetchArray["nilai"]+$pen["pendapatan"]) - ($bel["total"]+$keluar_lalu);
				echo" <tr>
						<td align=\"center\" style=\"font-size:10px;\">$no</td>
						<td align=\"left\" style=\"font-size:10px;\">$fetchArray[nm_skpd]</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format(($terima_lalu+$fetchArray["nilai"])-$keluar_lalu)."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($pen["pendapatan"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format(($terima_lalu+$fetchArray["nilai"]+$pen["pendapatan"])-$keluar_lalu)."</td>
						<td align=\"right\" style=\"font-size:10px;\">0</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($bel["jasa"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($bel["modal"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($bel["total"])."</td>
						<td align=\"right\" style=\"font-size:10px;\">".number_format($sal_akhir)."</td>";
				  
				  
					
				echo "</tr>";
				
			 $lalu=$lalu+($terima_lalu-$keluar_lalu);
			 $awal=$awal+$fetchArray["nilai"];
			 $penerimaan=$penerimaan+$pen["pendapatan"];
			 $jumpenerimaan=$lalu+$awal+$penerimaan;	
			
			 $bp=0;
			 $bj=$bj+$bel["jasa"];
			 $bm=$bm+$bel["modal"];
			 $jumbelanja=$jumbelanja+$bel["total"];

	 		 $akhir=$akhir+$sal_akhir;
	         $no ++;}
	 
			   echo "<TR>
							<TD align=\"left\" style=\"font-size:12px;\" colspan=2><b>JUMLAH (Rp.)</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($awal+$lalu,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($penerimaan,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jumpenerimaan,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>0</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bj,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bm,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($jumbelanja,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($akhir,2,",",".")."</b></TD>
					 </TR>";
	 

echo "</table>";

	  
	  




$footer = "Nomor SP2B : $id|| Halaman: {PAGENO} dari {nb}";
	


	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;

?>
