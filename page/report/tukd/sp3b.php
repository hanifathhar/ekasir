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


$baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_sp3b,'%d-%m-%Y') AS tgl FROM trhsp3b WHERE no_sp3b='$id'");
$data = mysqli_fetch_array($baca);
$tgl = $data['tgl_sp3b'];
//$skpd = $data['kd_fktp'];

$bl = mysqli_query($conn,"SELECT  * from ms_smt where kd='$data[bulan]' order by kd");
$bca = mysqli_fetch_array($bl);

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;




$ttd = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE kode='KD'");
$ttd1 = mysqli_fetch_array($ttd);

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

$alm = mysqli_query($conn,"SELECT  * FROM ms_skpd WHERE kd_skpd='$skpd'");
$almt = mysqli_fetch_array($alm);


$a = mysqli_query($conn,"SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdsp3b_pendapatan where no_sp3b='$id'");
$b = mysqli_fetch_array($a);
			
$c = mysqli_query($conn,"SELECT IFNULL(SUM(nilai),0) AS nilai FROM trdsp3b_belanja where no_sp3b='$id'");
$d = mysqli_fetch_array($c);


$e = mysqli_query($conn,"SELECT IFNULL(SUM(nilai),0) AS nilai FROM saldo_awal_fktp WHERE chek='0'");
$f = mysqli_fetch_array($e);





$x = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_pendapatan a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
                  where b.no_sp3b<'$id'");
$xx = mysqli_fetch_array($x);
$terima_lalu = $xx['nilai'];
			
$y = mysqli_query($conn,"SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
                  where b.no_sp3b<'$id'");
$yy = mysqli_fetch_array($y);
$keluar_lalu = $yy['nilai'];


$sal =number_format(($f['nilai']+$terima_lalu)-$keluar_lalu);
$pen=number_format($b['nilai']);
$bel=number_format($d['nilai']);
$akhir=number_format(($f['nilai']+$b['nilai']+$terima_lalu)-($d['nilai']+$keluar_lalu));


		
$bbaja = mysqli_query($conn,"SELECT SUM(a.nilai) AS bbj FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.no_sp3b='$id' and a.kd_rek6 LIKE '5.1.02%'");  	
$bbja = mysqli_fetch_array($bbaja); 
$bbj = number_format ($bbja['bbj']);



		
$bmodal = mysqli_query ($conn,"SELECT SUM(a.nilai) AS bmod FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.no_sp3b='$id' and a.kd_rek6 LIKE '5.2%'");	
$bmoda = mysqli_fetch_array($bmodal);
$bmod = number_format ($bmoda['bmod']);





						   
echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\"> 
					 <tr>
						<td align=\"center\" width=\"20%\">
                          <img src=\"../../img/logobiak.jpg\" height=90 width=90>  
                        </td>
             			
						<td align=\"center\" style=\"font-size:16px;border:solid 1px black;\" colspan=3><b>KABUPATEN TAPANULI SELATAN
<br><h2>DINAS PENDIDIKAN DAERAH</h2><br>SURAT PERMINTAAN PENGESAHAN BELANJA
						(SP2B)<br>TANGGAL : ".strtoupper($tanggal)."<br>NOMOR : $id</b></td>
					</tr> 
					<tr>
						<td align=\"left\" style=\"font-size:14px;border:solid 1px black;\" colspan=4>Kepala Dinas Pendidikan Daerah Kabupaten 
						Tapanuli Selatan memohon kepada :</td>
					</tr> 
					<tr>
						<td align=\"left\" style=\"font-size:14px;border:solid 1px black;\" colspan=4>Bendahara Umum Daerah Selaku PPKD</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:14px;border:solid 1px black;\" colspan=4>Agar Mengesahkan dan membukukan pendapatan dan belanja dana Operasional Sekolah (BOS) sejumlah :</td>
					</tr>
					<tr>
					    <td align=\"left\" style=\"font-size:14px;border:solid 1px black;\" colspan=4><br>&nbsp;<br>
						<table width=\"500\" align=\"left\" border=\"0\"> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>1. Saldo Awal</b></td>

							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$sal,-</b></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>2. Penerimaan</b></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$pen,-</b></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>3. Belanja</b></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$bel,-</b></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">a) Belanja Pegawai</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
						
								echo 0;
						
						echo ",-</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">b) Belanja Barang dan Jasa</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
						
							echo $bbj;
						
						echo ",-</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">c) Belanja Modal</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
						
							echo $bmod;
						
						echo ",-</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>4. Saldo Akhir</b></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$akhir,-</b></td>
							</tr> 
						 </table>
						</td>
						
					</tr>
					<tr>
						<td align=\"center\"  width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Untuk $bca[nm]</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Tahun Anggaran $tahun1</td>

					</tr>
					
					<tr>
						<td align=\"center\"  width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Program <br> 1.01.02<br>PROGRAM PENGELOLAAN PENDIDIKAN</td>
						<td align=\"center\" width=\"40%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Kegiatan <br> 1.01.02.2.01<br>Pengelolaan Pendidikan Sekolah</td>
					</tr>
					
					<tr>
						<td align=\"center\"  width=\"50%\" colspan=2 valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>PENERIMAAN</b></td>
						<td align=\"center\" width=\"50%\" colspan=2 valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>BELANJA</b></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\"><b>KODE REKENING</b></td>
						<td align=\"center\" width=\"25%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH (RP)</b></td>
						<td align=\"center\" width=\"25%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\"><b>KODE REKENING</b></td>
						<td align=\"center\" width=\"25%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH (RP)</b></td>
					</tr>";
		
		$terima=0;
		$keluar=0;
		$no=0;
		$sql = "SELECT a.kd_rek6 AS rek1,SUM(a.nilai) AS trm,'' AS rek2,0 AS kel,a.nm_rek6 as nmrek1,'' as nmrek2 FROM trdsp3b_pendapatan a
		        where a.no_sp3b='$id'
				GROUP BY a.kd_rek6
				UNION
				SELECT '' AS rek1,0 AS trm,a.kd_rek6 AS rek2,SUM(a.nilai) AS kel,'' as nmrek1, a.nm_rek6 as nmrek2 FROM trdsp3b_belanja a
				where a.no_sp3b='$id'
				GROUP BY a.kd_rek6";
				$query1 = mysqli_query($conn,$sql);  	
				while($resulte = mysqli_fetch_array($query1)){ 
				$no++;
						
					
						$crek1       = $resulte["rek1"];
						$crek2       = $resulte["rek2"];
						//$ter       = number_format($resulte["trm"]);
						//$kel       = number_format($resulte["kel"]);
						
						
						$terima=$terima+$resulte["trm"];
						$keluar=$keluar+$resulte["kel"];
						
						 if($resulte["trm"] < 1){
						 $ter       = '';
						 }else{
						 $ter       = number_format($resulte["trm"]+$h['nilai']);
						 }
						 
						 if($resulte["kel"] < 1){
						 $kel       = '';
						 }else{
						 $kel       = number_format($resulte["kel"]);
						 }
				
				echo "<tr> 
							<td  align=\"left\" style=\"font-size:12px;border:solid 1px black;\">$crek1<br>$resulte[nmrek1]</td>                           
                            <td  align=\"right\" style=\"font-size:12px;border:solid 1px black;\">$ter</td>
                            <td  align=\"left\" style=\"font-size:12px;border:solid 1px black;\">$crek2<br>$resulte[nmrek2]</td>
							<td  align=\"right\" style=\"font-size:12px;border:solid 1px black;\">$kel</td>
                        </tr>";
				  }
				 
				
				 $totalterima       = number_format($terima+$h['nilai']);
				 $totalkeluar       = number_format($keluar);
				
		
		echo "<tr>
						<td align=\"left\"  width=\"25%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>Jumlah Penerimaan</b></td>
						<td align=\"right\" width=\"25%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>Rp. $totalterima</b></td>
						<td align=\"left\" width=\"25%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>Jumlah Belanja </b></td>
						<td align=\"right\" width=\"25%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>Rp. $totalkeluar</b></td>
					</tr>
			<tr>
						<td align=\"right\"  width=\"25%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"4\"><b>".strtoupper($tanggal)."</b></td>
			</tr>";
                    
						
		echo "<tr><td align=\"left\" colspan=4 style=\"font-size:14px;border:solid 1px black;\">
					<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr><td align=\"center\" width=\"25%\"></td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\"></td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\"><b><br>".substr($jabatan,0,31)." <br> ".substr($jabatan,31)."</b></td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>                              
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">&nbsp;</td></tr>
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\"><b>$nama</b></td></tr>                              
                    <tr><td align=\"center\" width=\"25%\">&nbsp;</td>                    
                    <td align=\"center\" width=\"25%\">&nbsp;</td>
                    <td align=\"center\" width=\"25%\">NIP. $nip</td></tr>
					
				  </table>";				
						
		echo "</td>
					</tr>
                  </table>";





	$footer = "Nomor SP2B : $id || Halaman: {PAGENO} dari {nb}";
	


	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;

?>
