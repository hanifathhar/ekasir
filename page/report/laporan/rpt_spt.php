<?php
include '../../config/config.php';
include '../../config/fungsi_terbilang.php';
$con = new classConnection();
$con->getOpenCon();
ini_set("memory_limit","-1");
set_time_limit(300);

$nama_dokumen='Report';
define('_MPDF_PATH','../../report/MPDF57/');
include(_MPDF_PATH . 'mpdf.php');
$mpdf=new mPDF('utf-8', 'FOLIO','0','0',15,'15',10,15);
require '../php-excel.class.php';
ob_start();

$skpd = $_GET['skpd'];
$cetak = $_GET['cetak'];
$catatan = $_GET['catatan'];
$tgl = $_GET['tgl'];
$tahun = $_GET['tahun'];
$pa = $_GET['pa'];
$bk = $_GET['bk'];


$sql = mysql_query("SELECT  * FROM ms_skpd where md5(kd_skpd)='$skpd'");
$data = mysql_fetch_array($sql);
$kode = $data['kd_skpd'];
$nmskpd = $data['nm_skpd'];

$sqlpa = mysql_query("SELECT * FROM ms_ttd where kd_skpd='$kode' and kode='PA'");
$datapa = mysql_fetch_array($sqlpa);
$nama = $datapa['nama'];
$jabatan = $datapa['jabatan'];
$pangkat = $datapa['pangkat'];
$nip     = $datapa['nip'];
$alamat     = $datapa['alamat'];

$sqlbk = mysql_query("SELECT * FROM ms_ttd where kd_skpd='$kode' and kode='BK'");
$databk = mysql_fetch_array($sqlbk);
$namabk = $databk['nama'];
$jabatanbk = $databk['jabatan'];
$pangkatbk = $databk['pangkat'];
$nipbk     = $databk['nip'];
$alamatbk     = $databk['alamat'];


function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}




	   $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
	   $tahun1 = substr($tgl, 0, 4);
	   $bulan1 = substr($tgl, 5, 2);
	   $tgl1   = substr($tgl, 8, 2);
				 
	   $tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;

       $alm = mysql_query("SELECT * FROM ms_skpd where md5(kd_skpd)='$skpd'");
	   $dataalm = mysql_fetch_array($alm);
       $alamat_skpd = $dataalm['alamat'];
	   
	    
	   echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
	         <tr>
				<td align=\"right\" width=\"15%\">
                   <img src=\"../../img/logo-blue.png\" height=80 width=90>  
                </td>
             	<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\">
				   <b>PEMERINTAH KABUPATEN TAPANULI SELATAN<BR><span style=\"font-size:25px;\">DINAS PENDIDIKAN DAERAH</span><br>".strtoupper($nmskpd)."
				</td>
				<td align=\"left\" ><img src=\"../../img/disdik.png\" width=\"90px\" height=\"80px\"></td>
			  </tr>
			  <tr>
				 <td align=\"center\" style=\"font-size:12px;width:10%;border-bottom: 4px solid\" colspan=3></td>
			  </tr> 
	         </table>";
	   echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					 <tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;</td>
					</tr>
					 <tr>
						<td align=\"center\" style=\"font-size:15px;border:solid 0px black;\" colspan=5>
						<b><u>SURAT PERINTAH TUGAS</u></b><br>Nomor :_____/_____/_____/".$tahun."</td>
					</tr>
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>
						Yang bertanda Tangan di bawah ini :</td>
					</tr>
					
		     </table>";	
			 
		echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					<tr>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;></td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=15%;>Nama</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=1%;>:</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"  width=79%;>$nama</td>
					</tr>
					<tr>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;></td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=15%;>NIP</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;>:</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"  width=79%;>$nip</td>
					</tr>
					<tr>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;></td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=15%;>PANGKAT/GOL</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;>:</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"  width=79%;>$pangkat</td>
					</tr>
					<tr>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;></td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=15%;>Jabatan</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black; \" width=5%;>:</td>
						<td align=\"left\" valign=\"top\" style=\"font-size:12px;border:solid 0px black;\"  width=79%;>".ucwords(strtolower($jabatan))." ".($nmskpd)."</td>
					</tr>

					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;</td>
					</tr>
		     </table>";
			 
			 if($skpd=='4.00.01.01.00'){
			 	$kepala = 'Sekretaris Daerah';
			 	$skpd='';
			 }else{
			 	$kepala = 'Kepala Sekolah' ;
			 	$skpd=$nmskpd;
			 }	
			 
			 echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>Memerintahkan Kepada :</td>
					</tr>
					<tr>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5></td>
					</tr>
		     </table>";	
			
			echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\"> 
				  <tr>
						<td align=\"center\"  width=\"5%\" height=\"40px\" valign=\"middle\" style=\"font-size:12px;border:solid 1px black;\">NO.</td>
						<td align=\"center\" width=\"35%\" height=\"40px\" valign=\"middle\" style=\"font-size:12px;border:solid 1px black;\">NAMA</td>
						<td align=\"center\" width=\"15%\" height=\"40px\" valign=\"middle\" style=\"font-size:12px;border:solid 1px black;\">NIP</td>
						<td align=\"center\" width=\"15%\" height=\"40px\" valign=\"middle\" style=\"font-size:12px;border:solid 1px black;\">PANGKAT/GOL</td>
						<td align=\"center\" width=\"15%\" height=\"40px\" valign=\"middle\" style=\"font-size:12px;border:solid 1px black;\">JABATAN</td>
						<td align=\"center\" width=\"15%\" height=\"40px\" valign=\"middle\" style=\"font-size:12px;border:solid 1px black;\">TUJUAN</td>
					</tr>";
			
					

					$no = $_GET['nos'];
					$jumlah = 0;	
					for($x = 1; $x <= $no; $x++){
					
					echo "<tr>
					 		<td  align=\"center\" height=\"25px\" style=\"font-size:12px;border:solid 1px black;\">$x</td>                            
                            <td  align=\"left\" height=\"25px\" style=\"font-size:12px;border:solid 1px black;\"></td>
                            <td  align=\"center\" height=\"25px\" style=\"font-size:12px;border:solid 1px black;\"></td>
							<td  align=\"center\" height=\"25px\" style=\"font-size:12px;border:solid 1px black;\"></td>
                            <td  align=\"center\" height=\"25px\" style=\"font-size:12px;border:solid 1px black;\"></td>
							<td  align=\"center\" height=\"25px\" style=\"font-size:12px;border:solid 1px black;\"></td>
                        </tr>";
					}
			  
			  echo "
				</table>";
			  echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3></td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=20%;>Untuk Urusan / Tugas</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=1%;>:</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=79%;>$catatan</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=20%;>Lama Bertugas</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=1%;>:</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=79%;>____ Hari</td>
					</tr>
					<tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=20%;>Tanggal</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=1%;>:</td>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" width=79%;></td>
					</tr>
					
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;</td>
					</tr>
		     </table>";	
			  echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&emsp;&emsp;&emsp;Setelah selesai melaksanakan tugas agar melaporkan hasilnya kepada $kepala $skpd Kabupaten Tapanuli Selatan.</td>
					</tr>
					<tr>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5></td>
					</tr>
		     </table>";	
			   echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>&emsp;&emsp;&emsp;Demikian Surat Perintah Tugas ini diperbuat untuk diketahui dan dilaksanakan sebagaimana mestinya.</td>
					</tr>
					<tr>
						<td align=\"justify\" style=\"font-size:12px;border:solid 0px black;\" colspan=3>&nbsp;</td>
					</tr>
		     </table>";	
			  
			  echo "<table style=\"border-collapse:collapse;font-size:12px;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    
					<tr>
						<td align=\"left\" width=\"65%\">&nbsp;</td>                    
						<td align=\"left\" width=\"35%\" style=\"border-collapse:collapse;font-size:12px;\">Tapanuli Selatan, $tanggal</td>
					</tr>
					<tr>
						<td align=\"left\" width=\"65%\">&nbsp;</td>                    
						<td align=\"left\" width=\"35%\" style=\"border-collapse:collapse;font-size:12px;\"><b>$datapa[jabatan]</b></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"65%\">&nbsp;</td>                    
						<td align=\"left\" width=\"35%\">&nbsp;</td>
					</tr>
					<tr>
						<td align=\"left\" width=\"65%\">&nbsp;</td>                    
						<td align=\"left\" width=\"35%\">&nbsp;</td>
					</tr>
					<tr>
						<td align=\"left\" width=\"65%\">&nbsp;</td>                    
						<td align=\"left\" width=\"35%\" style=\"border-collapse:collapse;font-size:12px;\"><b>$datapa[nama]</b><br>$datapa[pangkat]</td>
					</tr>
					<tr>
						<td align=\"left\" width=\"65%\">&nbsp;</td>                    
						<td align=\"left\" width=\"35%\" style=\"border-collapse:collapse;font-size:12px;\">NIP. $datapa[nip]</td>
					</tr>
                  </table>";

	
	
					
					
	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;				

	



?>
