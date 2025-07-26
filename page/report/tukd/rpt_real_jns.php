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
$jns = $_GET['jns'];
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


					

					

// $per = mysql_query("SELECT  * FROM ms_tw WHERE kd='$bulan'");
// $periode = mysql_fetch_array($per);

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


$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='1.01.01.01.00' and kode='BK'");
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



// $dpa = mysql_query("SELECT SUM(nilai) AS nilai,  SUM(nilai_ubah) AS nilai_ubah 
// 					FROM trdrka WHERE kd_skpd='$kode' AND kd_sub_kegiatan='$giat' AND kd_rek6='$rek'");
// $dppa = mysql_fetch_array($dpa);
// $jml_apbd = $dppa['nilai'];
// $jml_papbd = $dppa['nilai_ubah'];

						   
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
		<td align=center  style=\"font-size:12px;width:10%;\" ><h3><B>REKAPITULASI REALISASI BELANJA DANA BOS<BR>TAHUN ANGGARAN $tahun</b></h3></td>
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



echo "<table width=100% cellpadding=3 cellspacing=0 border=1 style=\"border-collapse:0px; font-size:9px;\" align=\"center\">
	 				 <thead>
					 <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Kode</b></TD>
						<TD width=\"30%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Nama Sekolah</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Anggaran</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Belanja<br>Pegawai</b></TD>
						<TD width=\"20%\" align=\"center\" style=\"font-size:12px;\" colspan=2><b>Belanja Barang & Jasa</b></TD>
						<TD width=\"20%\" align=\"center\" style=\"font-size:12px;\" colspan=2><b>Belanja Modal</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Total Realisasi<br>(Rp)</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\" rowspan=2><b>Sisa Anggaran<br>(Rp)</b></TD>				
					 </TR>
					  <TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Belanja Persediaan</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Belanja Jasa</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Belanja Peralatan & Mesin</b></TD>
						<TD width=\"10%\" align=\"center\" style=\"font-size:12px;\"><b>Belanja Aset Tetap Lainnya</b></TD>
					 </TR>
					 </thead>";
	  		if($jns=='1'){
	        	$baca = mysql_query("SELECT  * FROM saldo_awal_fktp WHERE chek=0 ORDER BY kd_skpd");
			}else
			if($jns=='2'){
				$baca = mysql_query("SELECT  * FROM saldo_awal_fktp WHERE chek=1 ORDER BY kd_skpd");
			}else{
				$baca = mysql_query("SELECT  * FROM saldo_awal_fktp ORDER BY kd_skpd");
			}
			
			
		
			$no = 1;
			$pagu=0;
			$bp = 0;
			$bj1 = 0;
			$bj2 = 0;
			$bm1 = 0;
			$bm2 = 0;
			$bm3 = 0;	
            while($fetchArray = mysql_fetch_array($baca)){
			
			$p = mysql_query("SELECT IFNULL(SUM(nilai_ubah),0) AS nilai FROM trdrkas where kd_skpd='$fetchArray[kd_skpd]'");
			$p1 = mysql_fetch_array($p);
			
			$a = mysql_query("SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdtransout_fktp where kd_skpd='$fetchArray[kd_skpd]' and left(kd_rek6,4)='5101'");
			$a1 = mysql_fetch_array($a);
			

			$b = mysql_query("SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdtransout_fktp  where kd_skpd='$fetchArray[kd_skpd]' 
			                  and left(kd_rek6,6) in ('510201')");
			$b1 = mysql_fetch_array($b);
			
			$c = mysql_query("SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdtransout_fktp where kd_skpd='$fetchArray[kd_skpd]' 
			                  and left(kd_rek6,6) in ('510202','510203','510204','510205')");
			$c1 = mysql_fetch_array($c);
			
			$d = mysql_query("SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdtransout_fktp where kd_skpd='$fetchArray[kd_skpd]' 
			                  and left(kd_rek6,6) in ('520201','520202','520203','520204','520205','520206','520207','520208','520209','520210','520213')");
			$d1 = mysql_fetch_array($d);
			
			$e = mysql_query("SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdtransout_fktp where kd_skpd='$fetchArray[kd_skpd]' 
			                  and left(kd_rek6,6) in ('520501')");
			$e1 = mysql_fetch_array($e);
			
			$pagu=$pagu+$p1[nilai];
			$bp = $bp+$a1[nilai];
			$bj1 = $bj1+$b1[nilai];
			$bj2 = $bj2+$c1[nilai];
			$bm1 = $bm1+$d1[nilai];
			$bm2 = $bm2+$e1[nilai];
			
			
				echo "<TR>
						<TD width=\"10%\" align=\"center\" style=\"font-size:11px;\">$fetchArray[kd_skpd]</TD>
							<TD width=\"30%\" align=\"left\" style=\"font-size:11px;\">$fetchArray[nm_skpd]</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($p1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($a1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($b1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($c1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($d1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($e1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($a1[nilai]+$b1[nilai]+$c1[nilai]+$d1[nilai]+$e1[nilai],2,",",".")."</TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:11px;\">".number_format($p1[nilai]-($a1[nilai]+$b1[nilai]+$c1[nilai]+$d1[nilai]+$e1[nilai]),2,",",".")."</TD>			
					 </TR>";
			
			

	 
	 $no ++;}
	 
			 echo "<TR>
						    <TD width=\"40%\" align=\"left\" style=\"font-size:12px;\" colspan=2><b>JUMLAH TOTAL (Rp.)</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($pagu,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bp,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bj1,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bj2,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bm1,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bm2,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($bp+$bj1+$bj2+$bm1+$bm2,2,",",".")."</b></TD>
							<TD width=\"10%\" align=\"right\" style=\"font-size:12px;\"><b>".number_format($pagu-($bp+$bj1+$bj2+$bm1+$bm2),2,",",".")."</b></TD>		
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
	

 // if($cetak<>'1')
 // {
 // 	$html = ob_get_contents();
 // 	ob_end_clean();
 // 	$mpdf->SetFooter($footer);
 // 	$mpdf->WriteHTML(utf8_encode($html));
 // 	$mpdf->Output($nama_dokumen.".pdf" ,'I');
 // 	exit;
 // }
 // else
 // {
 // 	$xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
 // 	$xls->generateXML('Report');

 // }
?>
