<script>
    function printDokumen() {
        var printContents = document.getElementById('container').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
<?php
class laba{

    
    function view($bulan,$tahun){

			include("config/config.php");
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			
			if(empty($bulan)){
				$bulan = date('m');
			}
			
			if(empty($tahun)){
				$tahun = date('Y');
			}
			
			

			$nmbulan = $BulanIndo[(int)$bulan-1];
			$periode = "Bulan " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
			
			$csql = mysqli_query($conn,"SELECT * FROM ms_profil");
			$company = mysqli_fetch_array($csql);
	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Laporan Laba/Rugi</h4>
						<ul class=\"breadcrumbs\">
							<li class=\"nav-home\">
								<a href=\"#\">
									<i class=\"flaticon-home\"></i>
								</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Laporan</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Laporan Laba/Rugi</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
							<form action=\"\" method=\"post\">
								<input type=\"hidden\" value=\"$id\" name=\"id\">
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									
									<div class=\"form-group row\">
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Bulan</label>
									  <div class=\"col-sm-2\">
										 <select class=\"select21-single form-control\" name=\"bulan\" id=\"bulan\" required>";
										    echo "<option value=\"$bulan\">$bulan - $nmbulan</option>";
										    $sql ="SELECT * FROM ms_bulan ORDER BY kode";
											$baca = mysqli_query($conn,$sql);
											while($result = mysqli_fetch_array($baca)){
												$idx = $result['kode'];
												$nama = ($result['nama']);
												echo "<option value=\"$idx\">$idx - $nama</option>";
																
											}
										 
										 
										 echo "
										 </select>
									  </div>
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Tahun</label>
									  <div class=\"col-sm-2\">
										<select class=\"select21-single form-control\" name=\"tahun\" id=\"tahun\" required>";
										
											echo "<option value=\"$tahun\">$tahun</option>";
										    $sql ="SELECT YEAR(tgl_transaksi) AS tahun FROM tbl_jurnal GROUP BY YEAR(tgl_transaksi) ORDER BY YEAR(tgl_transaksi)";
											$baca = mysqli_query($conn,$sql);
											while($result = mysqli_fetch_array($baca)){
												$idx = $result['tahun'];
												$nama = ($result['tahun']);
												echo "<option value=\"$idx\">$nama</option>";
																
											}
										
										echo "
										</select>
									  </div>
									</div>
									<div class=\"form-group row\">
									<label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\"></label>
									  <div class=\"col-sm-2\">
										<button type=\"submit\" name=\"tampil\" value=\"tampil\" class=\"btn btn-primary btn-sm\"><i class=\"icon-refresh\"></i> Tampilkan</button>
										<button class=\"btn btn-success btn-sm\" type=\"button\" class=\"btn btn-primary\" onclick=\"printDokumen()\">
																<i class=\"fas fa-print\"></i> Cetak Laporan
														</button>
									  </div>
									</div>
									
									</h4>
								</div>
								</form>
								
								
								<div class=\"card-body\">
									<div class=\"table-responsive\">
									<div id=\"container\">
						            <center>
									<table style='width:80%; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
											<td width='70px' align='left' style='padding-right:80px; vertical-align:top'>
											<span style='font-size:12pt'><b>$company[company]</b></span></br>
											<span style='font-size:9pt'>$company[alamat]<br>Telp: $company[no_telp] / Email: $company[email]</span>
											</td>
											<td style='vertical-align:top' width='30%' align='left'></td>
									</table>	
									<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> 
												 <tr>
													<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><h2><b>LAPORAN LABA/RUGI<br></b></h2></td>
												</tr>
												<tr>
													<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><b>$periode</b></td>
												</tr>
												<tr>
													<td align=\"center\" style=\"font-size:12px;border:solid 0px black;\" colspan=5>&nbsp;</td>
												</tr>
										 </table>
										<table width=\"80%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"font-size:15px;\" width=800><b>Uraian</b></th>
													<th class=\"text-center\" style=\"font-size:15px;\" width=200><b>Jumlah<br>(Rp)</b></th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT a.no,a.bold,a.uraian,IF(a.kode IS NULL OR a.kode ='',\"'xxx'\",a.kode) as kode
													FROM map_laba a GROUP BY a.no,a.uraian,a.kode,a.bold 
													ORDER BY a.no");
											  $no = 1; 
											  $pendapatan=0;
											  $pembelian=0;
											  $hpp =0;
											  while($fetchArray = mysqli_fetch_array($baca)){
											 
											  $nama      = $fetchArray['uraian'];
											  $nor      = $fetchArray['no'];    
											  $n         = $fetchArray['kode'];
											  
											  $sql5   = mysqli_query($conn,"SELECT SUM(z.nilai) AS nilai FROM(
														SELECT a.kd_akun,SUM(a.kredit-a.debet) as nilai FROM tbl_jurnal a 
														WHERE (left(REPLACE(a.kd_akun,'.',''),1) in ('4') AND left(REPLACE(a.kd_akun,'.',''),2) IN (".$n.")) and (year(a.tgl_transaksi)='$tahun' 
														AND MONTH(a.tgl_transaksi)= '$bulan')
														GROUP BY a.kd_akun
														UNION
														SELECT a.kd_akun,SUM(a.debet-a.kredit) as nilai FROM tbl_jurnal a 
														WHERE (left(REPLACE(a.kd_akun,'.',''),1) in ('5') AND left(REPLACE(a.kd_akun,'.',''),2) IN (".$n.")) and (year(a.tgl_transaksi)='$tahun' 
														AND  MONTH(a.tgl_transaksi)= '$bulan')
														GROUP BY a.kd_akun
														) AS z");
												$trh = mysqli_fetch_array($sql5);
												$nil    = $trh['nilai'];
												
												
												if ($fetchArray['no']==2){$penjualan=$trh['nilai'];}
												
												$ret_1    = mysqli_query($conn,"SELECT SUM(a.debet-a.kredit) as nilai FROM tbl_jurnal a WHERE (year(a.tgl_transaksi)='$tahun' AND  MONTH(a.tgl_transaksi)= '$bulan')
												           AND left(REPLACE(a.kd_akun,'.',''),2) in ('52')");
												$retur1 = mysqli_fetch_array($ret_1);
												
												if ($fetchArray['no']==3){
													$nil=-$retur1['nilai'];
													$retur_penjualan=$retur1['nilai'];
												}
												if ($fetchArray['no']==4){
												    $nil=$penjualan-$retur1['nilai'];
													$pendapatan=$penjualan-$retur1['nilai'];
												}
												
												if ($fetchArray['no']==9){$pembelian=$trh['nilai'];}
												
												
												
												$awal    = mysqli_query($conn,"SELECT SUM(a.debet-a.kredit) as nilai FROM tbl_jurnal a WHERE (year(a.tgl_transaksi)<='$tahun' AND  MONTH(a.tgl_transaksi)< '$bulan')
												           AND left(REPLACE(a.kd_akun,'.',''),2) in ('14')");
												$trhawal = mysqli_fetch_array($awal);
												
												if ($fetchArray['no']==8){$nil=$trhawal['nilai'];}
												
												
												$akhir    = mysqli_query($conn,"SELECT SUM(a.debet-a.kredit) as nilai FROM tbl_jurnal a WHERE (year(a.tgl_transaksi)='$tahun' AND  MONTH(a.tgl_transaksi)<= '$bulan')
												           AND left(REPLACE(a.kd_akun,'.',''),2) in ('14')");
												$trhakhir = mysqli_fetch_array($akhir);
												
												
												$ret_2    = mysqli_query($conn,"SELECT SUM(a.kredit-a.debet) as nilai FROM tbl_jurnal a WHERE (year(a.tgl_transaksi)='$tahun' AND  MONTH(a.tgl_transaksi)= '$bulan')
												           AND left(REPLACE(a.kd_akun,'.',''),2) in ('42')");
												$retur2 = mysqli_fetch_array($ret_2);
												
												if ($fetchArray['no']==10){
													$nil=-$retur2['nilai'];
													$retur_pembelian=$retur2['nilai'];
												}
												
												if ($fetchArray['no']==11){
													$nil=-$trhakhir['nilai'];
												}
												
												
												if($fetchArray['no']==12){
												    $nil=($trhawal['nilai']+$pembelian)-($retur_pembelian+$trhakhir['nilai']);
													$hpp = ($trhawal['nilai']+$pembelian)-($retur_pembelian+$trhakhir['nilai']);
												}
												
												if($fetchArray['no']==14){
												    $nil=$pendapatan-$hpp;
												}
												
												if ($nil<0){
													$nilai    = "(".number_format(abs($nil),"0",".",",").")";
												}else{
													$nilai    = number_format($nil,"0",".",",");    
												}
											  
											  
											       if ($fetchArray['bold']==0 )  {
													 echo "<tr>
															<td style=\"font-size:15px;\"><b>$nama</b></td>
															<td class=\"text-right\" style=\"font-size:12px;\"><b></b></td>
														  </tr>";
													}else
													if ($fetchArray['bold']==1 )  {
													 echo "<tr>
															<td style=\"font-size:15px;\"><b>$nama</b></td>
															<td class=\"text-right\" style=\"font-size:15px;\"><b>$nilai</b></td>
														  </tr>";
													}else{
														
														  
													if (empty($nama)){
													
														echo "<tr>
															<td style=\"font-size:15px;\">&nbsp;</td>
															<td class=\"text-right\" style=\"font-size:12px;\">&nbsp;</td>
														  </tr>";
													
													}else{
													
														echo "<tr>
																<td style=\"font-size:15px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nama</td>
																<td class=\"text-right\" style=\"font-size:15px;\">$nilai</td>
														  </tr>";
													
													}
													
													}	
											  
											  
											  
											  
											  $no++;
											  }
											  
										echo "</tbody>
										</table>
										</div>
									</div>
								</div>
								<div class=\"card-action\" align=\"left\">
								(* Laba kotor merupakan pengukuran langsung pendapatan dari penjualan barang dalam satu periode akuntansi.
								</div>
							</div>
						</div>
						";
		  
		  
		  
		  if($_POST['tampil']){
		  
				$bulan = htmlspecialchars($_POST['bulan'], ENT_QUOTES);
				$tahun = htmlspecialchars($_POST['tahun'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=laba&aksi=view\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$bulan\" name=\"bulan\">
						  <input type=\"hidden\" value=\"$tahun\" name=\"tahun\">
					</form>";
					
					
				echo "<script type=\"text/javascript\">
					  swal(\"", "Data Berhasil Ditapilkan!\", {
						icon : \"success\",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
								
							}
						},
					}).then(
					function() {
						document.getElementById('success').submit();
					}
					);
					</script>";
		  
		  
		  
		  }

    }
	

}
?>
