<?php
include '../../config/config.php';
$con = new classConnection();
$con->getOpenCon();
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




$baca = mysql_query("SELECT  *,DATE_FORMAT(tgl_sp3b,'%d-%m-%Y') AS tgl FROM trhsp3b WHERE no_sp3b='$id'");
$data = mysql_fetch_array($baca);
$tgl = $data['tgl_sp3b'];
//$skpd = $data['kd_fktp'];

$bl = mysql_query("SELECT  * from ms_smt where kd='$data[bulan]' order by kd");
$bca = mysql_fetch_array($bl);

$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl1   = substr($tgl, 8, 2);
				 
$tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;




$ttd = mysql_query("SELECT  * FROM ms_ttd WHERE kd_skpd='$skpd' and kode='PA'");
$ttd1 = mysql_fetch_array($ttd);

$res = mysql_num_rows($ttd);
if($res < 0){
	$nip = 'Belum Ada';
	$nama = 'Belum Ada';
	$jabatan = 'Belum Ada';

}else{
	$nip = $ttd1['nip'];
	$nama = $ttd1['nama'];
	$jabatan = $ttd1['jabatan'];
}


$alm = mysql_query("SELECT  * FROM ms_skpd WHERE kd_skpd='$skpd'");
$almt = mysql_fetch_array($alm);

//PENDAPATAN
$a = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_pendapatan a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
     where b.kd_fktp='$data[kd_fktp]' and b.bulan<='$data[bulan]'");
$b = mysql_fetch_array($a);

$ax = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_pendapatan a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
     where b.kd_fktp='$data[kd_fktp]' and b.bulan='1'");
$bx = mysql_fetch_array($ax);

$az = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_pendapatan a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
     where b.kd_fktp='$data[kd_fktp]' and b.bulan='2'");
$bz = mysql_fetch_array($az);
////////////////


//BELANJA			
$c = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
     where b.kd_fktp='$data[kd_fktp]' and b.bulan<='$data[bulan]'");
$d = mysql_fetch_array($c);


$e = mysql_query("SELECT IFNULL(SUM(awal),0) AS nilai FROM saldo_awal_fktp where kd_skpd='$data[kd_fktp]'");
$f = mysql_fetch_array($e);


//PENGEMBALIAN
if($data['bulan']=='1'){
	$str = mysql_query("SELECT  sum(nilai) as nilai FROM trd_setor_tunai WHERE kd_skpd='$data[kd_fktp]' and MONTH(tgl_bukti) <='6'");
	$str_tunai = mysql_fetch_array($str);
	$setortunai = $str_tunai['nilai'];
}else{
	$str = mysql_query("SELECT  sum(nilai) as nilai FROM trd_setor_tunai WHERE kd_skpd='$data[kd_fktp]' and MONTH(tgl_bukti) <='12'");
	$str_tunai = mysql_fetch_array($str);
	$setortunai = $str_tunai['nilai'];
}

//BUNGA BANK
if($data['bulan']=='1'){
	$bunga = mysql_query("SELECT  sum(nilai) as nilai FROM trd_bunga_bank WHERE kd_skpd='$data[kd_fktp]' and MONTH(tgl_bukti) <='6'");
	$bunga_bnk = mysql_fetch_array($bunga);
	$bungabank = $bunga_bnk['nilai'];
}else{
	$bunga = mysql_query("SELECT  sum(nilai) as nilai FROM trd_bunga_bank WHERE kd_skpd='$data[kd_fktp]' and MONTH(tgl_bukti) <='12'");
	$bunga_bnk = mysql_fetch_array($bunga);
	$bungabank = $bunga_bnk['nilai'];
}

//ADMIN BANK
if($data['bulan']=='1'){
	$adm = mysql_query("SELECT  sum(nilai) as nilai FROM trd_admin_bank WHERE kd_skpd='$data[kd_fktp]' and MONTH(tgl_bukti) <='6'");
	$adm_bank = mysql_fetch_array($adm);
	$adminbank = $adm_bank['nilai'];
}else{
	$adm = mysql_query("SELECT  sum(nilai) as nilai FROM trd_admin_bank WHERE kd_skpd='$data[kd_fktp]' and MONTH(tgl_bukti) <='12'");
	$adm_bank = mysql_fetch_array($adm);
	$adminbank = $adm_bank['nilai'];
}


$x = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_pendapatan a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
                  where b.bulan<'$data[bulan]' and b.kd_fktp='$data[kd_fktp]'");
$xx = mysql_fetch_array($x);
$terima_lalu = $xx['nilai'];
			
$y = mysql_query("SELECT IFNULL(SUM(a.nilai),0) AS nilai FROM trdsp3b_belanja a left join trhsp3b b on a.no_sp3b=b.no_sp3b 
                  where b.bulan<'$data[bulan]' and b.kd_fktp='$data[kd_fktp]'");
$yy = mysql_fetch_array($y);
$keluar_lalu = $yy['nilai'];


$sal =number_format($f['nilai']);
$setor = number_format($setortunai+$bungabank);
$bank = number_format($adminbank);
$pen=number_format($b['nilai']);
	$pen1=number_format($bx['nilai']);
	$pen2=number_format($bz['nilai']);
$bel=number_format($d['nilai']);
$akhir=number_format(($f['nilai']+$b['nilai']+$setortunai+$bungabank)-($d['nilai']+$adminbank));



$bepega = mysql_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where  b.kd_fktp='$data[kd_fktp]' and bulan = '1' and a.kd_rek5 LIKE '521%'");  	
$bepeg = mysql_fetch_array($bepega);
$bpeg = number_format ($bepeg['bpeg']);

$bepega2 = mysql_query ("SELECT SUM(a.nilai) AS bpeg FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.kd_fktp='$data[kd_fktp]' and bulan = '2' and a.kd_rek5 LIKE '521%'");  	
$bepeg2 = mysql_fetch_array($bepega2);
$bpeg2 = number_format ($bepeg2['bpeg']);

		
$bbaja = mysql_query("SELECT SUM(a.nilai) AS bbj FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.kd_fktp='$data[kd_fktp]' and bulan = '1' and a.kd_rek5 LIKE '522%'");  	
$bbja = mysql_fetch_array($bbaja); 
$bbj = number_format ($bbja['bbj']);

$bbaja2 = mysql_query("SELECT SUM(a.nilai) AS bbj FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.kd_fktp='$data[kd_fktp]' and bulan = '2' and a.kd_rek5 LIKE '522%'");  	
$bbja2 = mysql_fetch_array($bbaja2); 
$bbj2 = number_format ($bbja2['bbj']);	
		
$bmodal = mysql_query ("SELECT SUM(a.nilai) AS bmod FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.kd_fktp='$data[kd_fktp]' and bulan = '1' and a.kd_rek5 LIKE '523%'");	
$bmoda = mysql_fetch_array($bmodal);
$bmod = number_format ($bmoda['bmod']);

$bmodal2 = mysql_query ("SELECT SUM(a.nilai) AS bmod FROM trdsp3b_belanja a INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.kd_fktp='$data[kd_fktp]' and bulan = '2' and a.kd_rek5 LIKE '523%'");	
$bmoda2 = mysql_fetch_array($bmodal2);
$bmod2 = number_format ($bmoda2['bmod']);

						   
echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\"> 
					 <tr>
						<td align=\"center\" width=\"20%\">
                          <img src=\"../../img/logobiak.jpg\" height=90 width=90>  
                        </td>
             			
						<td align=\"center\" style=\"font-size:16px;border:solid 1px black;\" colspan=3><b>KABUPATEN TAPANULI SELATAN
<br><h2>".strtoupper($almt[nm_skpd])."</h2><br>SURAT PERMINTAAN PENGESAHAN BELANJA
						(SP2B) SEKOLAH<br>TANGGAL : ".strtoupper($tanggal).", NOMOR : $id</b></td>
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
					    <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\" colspan=4><br>&nbsp;<br>
						<table width=\"500\" align=\"left\" border=\"0\"> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">1. Saldo Awal</td>

							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">$sal</td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">2. Pengembalian/Bunga Bank</td>

							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">$setor</td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">3. Penerimaan</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$pen</b></td>
							</tr>
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">a) Penerimaan Semester I</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">$pen1</td>
							</tr>
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">b) Penerimaan Semester II</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
							  if ($data[bulan] == '1'){
										echo '0';
									} else if ($data[bulan]=='2'){
										echo $pen2;
									}
							  echo "</td>
							</tr>  
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">4. Belanja</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$bel</b></td>
							</tr>
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>1) Belanja Semester I</b></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;a) Belanja Pegawai</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
						
									echo $bpeg;
								echo "</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;b) Belanja Barang dan Jasa</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
						
							echo $bbj;
						echo "</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;c) Belanja Modal</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
					
							echo $bmod;
						echo "</b></td>
					</tr></td>
					<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>2) Belanja Semester II</b></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"></td>
							</tr>
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;a) Belanja Pegawai</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
									if ($data[bulan] == '1'){
										echo '0';
									} else if ($data[bulan]=='2'){
										echo $bpeg2;
									}
									
								
								echo "</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;b) Belanja Barang dan Jasa</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
							   		if ($data[bulan] == '1'){
										echo '0';
									} else if ($data[bulan]=='2'){
										echo $bbj2;
									}
							
					
						echo "</b></td>
					</tr></td>
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;c) Belanja Modal</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">";
								
								    if ($data[bulan] == '1'){
										echo '0';
									} else if ($data[bulan]=='2'){
										echo $bmod2;
									}
							
							
						echo "</b></td>
					</tr></td> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"></td>
							</tr>
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">5. Admin Bank</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">Rp.</td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\">$bank</td>
							</tr> 
							</tr> 
							<tr>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">6. Saldo Akhir</td>
							  <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"></td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\">&nbsp;</td>
							   <td align=\"left\" style=\"font-size:14px;border:solid 0px black;\"><b>Rp.</b></td>
							  <td align=\"right\" style=\"font-size:14px;border:solid 0px black;\"><b>$akhir</b></td>
							</tr> 
						 </table>
						</td>
						
					</tr>
					<tr>
						<td align=\"center\"  width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Untuk $bca[nm]</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Tahun Anggaran $tahun1</td>

					</tr>
					<tr>
						<td align=\"center\"  width=\"40%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">Dasar Pengesahan</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">Urusan</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">Organisasi</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">Nama Sekolah</td>
					</tr>
					<tr>
						<td align=\"center\"  width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">1.01.01.1.01</td>
						<td align=\"center\" width=\"40%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">1.01.01</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">$almt[nm_skpd]</td>
						<td align=\"center\" width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\">$data[nm_fktp]</td>
					</tr>
					<tr>
						<td align=\"center\"  width=\"30%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Program <br> 1.01.01.1.01.01.01.00.16</td>
						<td align=\"center\" width=\"40%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=\"2\">Kegiatan <br> 1.01.01.1.01.01.01.00.16.63</td>
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
		$sql = "SELECT a.kd_rek5 AS rek1,SUM(a.nilai) AS trm,'' AS rek2,0 AS kel FROM trdsp3b_pendapatan a
				INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.no_sp3b='$id' and b.kd_skpd='$skpd'
				GROUP BY a.kd_rek5
				UNION
				SELECT '' AS rek1,0 AS trm,a.kd_rek5 AS rek2,SUM(a.nilai) AS kel FROM trdsp3b_belanja a
				INNER JOIN trhsp3b b ON a.no_sp3b=b.no_sp3b where b.no_sp3b='$id' and b.kd_skpd='$skpd'
				GROUP BY a.kd_rek5";
				$query1 = mysql_query($sql);  	
				while($resulte = mysql_fetch_array($query1)){ 
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
						 $ter       = number_format($resulte["trm"]);
						 }
						 
						 if($resulte["kel"] < 1){
						 $kel       = '';
						 }else{
						 $kel       = number_format($resulte["kel"]);
						 }
				
				echo "<tr> 
							<td  align=\"center\" style=\"font-size:13px;border:solid 1px black;\">$crek1</td>                           
                            <td  align=\"right\" style=\"font-size:13px;border:solid 1px black;\">$ter</td>
                            <td  align=\"center\" style=\"font-size:13px;border:solid 1px black;\">$crek2</td>
							<td  align=\"right\" style=\"font-size:13px;border:solid 1px black;\">$kel</td>
                        </tr>";
				  }
				 
				
				 $totalterima       = number_format($terima);
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
                    <td align=\"center\" width=\"25%\">$alamat, $tgl_sp3b</td></tr>
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





	$footer = "";	
	


	$html = ob_get_contents();
	ob_end_clean();
	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;

?>
