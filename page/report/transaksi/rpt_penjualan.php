<?php
include '../../config/config.php';

ini_set("memory_limit","-1");
ini_set('MAX_EXECUTION_TIME',-1);




$tgl1 = $_POST['tgl1'];
$tgl2 = $_POST['tgl2'];




 	   $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
	   $tahun1 = substr($tgl_cetak, 0, 4);
	   $bulan1 = substr($tgl_cetak, 5, 2);
	   $tgl1   = substr($tgl_cetak, 8, 2);
				 
	   $tanggal = $tgl1 . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;
	   
	   $tahun2 = substr($tgl, 0, 4);
	   $bulan2 = substr($tgl, 5, 2);
	   $tgl2   = substr($tgl, 8, 2);
				 
	   $tanggal_periode = $tgl2 . " " . $BulanIndo[(int)$bulan2-1] . " ". $tahun2;
	   



	   echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> 
					 <tr>
						<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><h3>PEMERINTAH KABUPATEN PADANG LAWAS UTARA<br>
						<b>".strtoupper($nmskpd)."</b></h3>
						</td>
					</tr>
					<tr>
						<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5>
						<b>DAFTAR PERSEDIAAN BARANG SESUAI HASIL STOCK OPNAME BARANG<br>
						PERIODE SAMPAI DENGAN ".strtoupper($tanggal_periode)."</b></td>
					</tr>
					
					<tr>
						<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
					</tr>
		     </table>";	
			
			echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\"> 
				  <thead><tr>
						<td align=\"center\"  width=\"5%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\" rowspan=3><b>NO.</b></td>
						<td align=\"center\" width=\"15%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\" rowspan=3><b>NAMA BARANG</b></td>
						<td align=\"center\" width=\"10%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\" rowspan=3><b>HARGA<br>SATUAN</b></td>
						<td align=\"center\" width=\"10%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\" rowspan=3><b>SATUAN</b></td>
						<td align=\"center\" width=\"20%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\" colspan=2 rowspan=2><b>SALDO AWAL</b></td>
						<td align=\"center\" width=\"40%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=4><b>ARUS BARANG TAHUN $tahun</b></td>
						<td align=\"center\" width=\"20%\" valign=\"\" style=\"font-size:14px;border:solid 1px black;\" colspan=2 rowspan=2><b>SALDO AKHIR</b></td>
					</tr>
					<tr>
						<td align=\"center\"  width=\"20%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=2><b>MASUK</b></td>
						<td align=\"center\" width=\"20%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\" colspan=2><b>KELUAR</b></td>
					</tr>
					<tr>
						<td align=\"center\"  width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH</b></td>
						<td align=\"center\" width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>RP.</b></td>
						<td align=\"center\"  width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH</b></td>
						<td align=\"center\" width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>RP.</b></td>
						<td align=\"center\"  width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH</b></td>
						<td align=\"center\" width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>RP.</b></td>
						<td align=\"center\"  width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH</b></td>
						<td align=\"center\" width=\"10%\" valign=\"top\" style=\"font-size:14px;border:solid 1px black;\"><b>RP.</b></td>
					</thead></tr>";
					
					$baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,IF(pembayaran=1,'Tunai','Non Tunai') as bayar,
											         (select nm_pengguna from admin where id=tbl_pembayaran.user) as kasir,IF(nm_member<>'',nm_member,'Umum') as pembeli 
											         FROM tbl_pembayaran WHERE tgl_transaksi BETWEEN '$tgl1' and '$tgl2' ORDER BY no_transaksi");
						
					$no = 1;
					$jum_sal=0;
					$total_sal=0;
					$jum_trm=0;
					$total_trm=0;
					$jum_kel=0;
					$total_kel=0;	
					while($fetchArray = mysqli_fetch_array($baca)){
					
					
					
					echo "<tr>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\">$no.</td>
					  <td class=\"center\" style=\"font-size:14px;border:solid 1px black;\">$fetchArray[nm_akun8]</td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[harga])."</td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\">$fetchArray[satuan]</td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[jml_awal])."</td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[nilai_awal],2)."</td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[jml_masuk])."</td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[nilai_masuk],2)."</td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[jml_keluar])."</td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\">".number_format($fetchArray[nilai_keluar],2)."</td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\">".number_format($jml_akhir)."</td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\">".number_format($nilai_akhir,2)."</td>";
                   echo "</tr>";
			
					$jum_sal=$jum_sal+$fetchArray[jml_awal];
					$total_sal=$total_sal+$fetchArray[nilai_awal];
						   
					$jum_trm=$jum_trm+$fetchArray[jml_masuk];
					$total_trm=$total_trm+$fetchArray[nilai_masuk];
					
					$jum_kel=$jum_kel+$fetchArray[jml_keluar];
					$total_kel=$total_kel+$fetchArray[nilai_keluar];
					
					$no++;}
			  
			  echo "<tr>
					  <td class=\"center\" colspan=4 style=\"font-size:14px;border:solid 1px black;\"><b>JUMLAH TOTAL</b></td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format($jum_sal)."</b></td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format($total_sal,2)."</b></td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format($jum_trm)."</b></td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format($total_trm,2)."</b></td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format($jum_kel)."</b></td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format($total_kel,2)."</b></td>
					  <td align=\"center\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format(($jum_sal+$jum_trm)-$jum_kel)."</b></td>
					  <td align=\"right\" style=\"font-size:14px;border:solid 1px black;\"><b>".number_format(($total_sal+$total_trm)-$total_kel,2)."</b></td>";
                   echo "</tr>";
            echo "</table>";
			
			echo "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\"> 
					 <tr>
						<td align=\"left\" style=\"font-size:12px;border:solid 0px black;\" colspan=5></td>
					</tr>
				</table>";
			  
			  
			  echo "<table style=\"border-collapse:collapse;font-size:12px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr>
						<td align=\"center\" width=\"25%\"></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">&nbsp;</td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\">Mengetahui,<br><b>$jabatanpa</b></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">$data[alamat], $tanggal<br><b>$jabatanpb</b></td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\"></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\"><b></b></td>
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
						<td align=\"center\" width=\"25%\"><b>$namapa</td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\"><b>$namapb</b></td>
					</tr>
					 <tr>
						<td align=\"center\" width=\"25%\">NIP. $nippa</td>                    
						<td align=\"center\" width=\"25%\"></td>
						<td align=\"center\" width=\"25%\">NIP. $nippb</b></td>
					</tr>                              
                   
					<tr>
						<td align=\"center\" width=\"25%\"><br></br></td>                    
						<td align=\"center\" width=\"25%\">$setuju<br>$jabatan_pppb</br></td>
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
						<td align=\"center\" width=\"25%\"><b>$nama_pppb </b> <br>$pangkt <br>$np $nip_pppb</td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					
                  </table>";
/*		
$footer = " $foot || Halaman: {PAGENO} dari {nb}";						
$html = ob_get_contents(); 
ob_end_clean();
$mpdf->SetFooter($footer);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("Stock_Opname.pdf" ,'I');
*/
?>
