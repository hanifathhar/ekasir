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

$baca = mysqli_query($conn,"SELECT  * from ms_skpd where (kd_skpd)='$skpd'");
$data = mysqli_fetch_array($baca);
$kode = $data['kd_skpd'];
$nmskpd = $data['nm_skpd'];


$baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_sptmh,'%d-%m-%Y') AS tgl FROM trhsptmh WHERE no_sptmh='$id'");
$data = mysqli_fetch_array($baca);
$tgl = $data['tgl_sptmh'];

$bl = mysqli_query($conn,"SELECT  * from ms_thp where kd='$data[bulan]' order by kd");
$bca = mysqli_fetch_array($bl);



$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;


$ttd = mysqli_query($conn,"SELECT  * FROM ms_ttd WHERE kd_skpd='$kode' and kode='PA'");
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

$alm = mysqli_query($conn,"SELECT  * FROM ms_skpd WHERE kd_skpd='$kode'");
$almt = mysqli_fetch_array($alm);
						   
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
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b>SURAT PERNYATAAN TELAH MENERIMA HIBAH (SPTMH)</b></td>
						<td align=\"center\" width=\"18%\"> </td>
					</tr>
					<tr>
						<td align=\"center\" > </td>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=3><b>TANPA MELALUI RKUD</b></td>
						<td align=\"center\" width=\"18%\"> </td>
					</tr>
					<tr>
						<td align=\"center\" > </td>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>NOMOR : $id / TANGGAL : $tanggal</td>
						<td align=\"center\" width=\"18%\"> </td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Menyatakan bahwa saya atas nama :</td>
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
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Kabupaten</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">:  Tapanuli Selatan</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;Provinsi</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">: Sumatera Utara</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=\"20%\">&nbsp;&nbsp;&nbsp;&nbsp;NPSN</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=4 width=\"64%\">: $almt[npsn]</td>
					</tr>";
				 
			echo "
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Bertanggung jawab penuh atas segala penerima hibah berupa uang yang diterima langsung pada $bca[nm] :</td>
					</tr>
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Tanpa melalui RKUD dengan rincian sebagai berikut :</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					 ";
		echo "</table>"; 
	

$data = mysqli_query($conn,"SELECT IFNULL(nilai,0) AS nilai, IFNULL(nilai,0) AS pagu FROM trdrkas WHERE kd_skpd='$kode'");
$k = mysqli_fetch_array($data);
$pagu_tahun = $k[nilai];

$realisasi = mysqli_query($conn,"SELECT * FROM trhsptmh WHERE kd_skpd='$kode' and no_sptmh='$id'");
$k1 = mysqli_fetch_array($realisasi);
	
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\"> 
				    <tr>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:25px;font-size:12px;border:solid 0px black;\" rowspan=2><b>Kode<br>Rekening</b></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" rowspan=2><b>Pagu<br>(Rp)</b></td>
						<td width=\"45%\" align=\"center\" valign=\"centre\" style=\"height:45px;font-size:12px;border:solid 0px black;\" colspan=3><b>Realisasi<br>(Rp)</b></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" rowspan=2><b>Sisa<br>(Rp)</b></td>
					</tr>
					<tr>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1><b>s.d. Tahap Lalu</b></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1><b>Tahap Ini</b></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1><b>s.d. Tahap Ini</b></td>
					</tr>
					<tr>
						<td width=\"15%\" align=\"left\" valign=\"centre\" style=\"height:25px;font-size:12px;border:solid 0px black;\" colspan=1>Pendapatan</td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
					</tr>
					<tr>
						<td width=\"15%\" align=\"left\" valign=\"centre\" style=\"height:25px;font-size:12px;border:solid 0px black;\" colspan=1>4.3.1.01.02</td>
						<td width=\"15%\" align=\"right\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1>".number_format($pagu_tahun,2,",",".")."</td>
						<td width=\"15%\" align=\"right\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1>".number_format($k1['real_lalu'],2,",",".")."</td>
						<td width=\"15%\" align=\"right\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1>".number_format($k1['real_real'],2,",",".")."</td>
						<td width=\"15%\" align=\"right\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1>".number_format($k1['real_ini'],2,",",".")."</td>
						<td width=\"15%\" align=\"right\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1>".number_format($k1['real_sisa'],2,",",".")."</td>
					</tr>
					<tr>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
						<td width=\"15%\" align=\"center\" valign=\"centre\" style=\"height:15px;font-size:12px;border:solid 0px black;\" colspan=1></td>
					</tr>
		
		
				  
        </table>";  
		
				
		
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					 <tr>
						<td  align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Bukti-bukti terkait hal tersebut diatas sesuai ketentuan yang berlaku pada <b>".$almt['nm_skpd']."</b> untuk kelengkapan administrasi dan keperluan pemeriksaan aparat pengawas fungsional.<br>&nbsp;<br>Demikian surat pernyataan ini dibuat dengan sebenarnya.	</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5 width=\"64%\"></td>
					</tr>
					";
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
