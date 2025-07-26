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
class neraca{

    
    function view($tgl1){

			include("config/config.php");
			if(empty($tgl1)){
				$tgl1 = date('Y-m-d');
			}
			
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

			$tahun1 = substr($tgl1, 0, 4);
			$bulan1 = substr($tgl1, 5, 2);
			$tgl   = substr($tgl1, 8, 2);
			$tanggal = $tgl . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;
			
			$csql = mysqli_query($conn,"SELECT * FROM ms_profil");
			$company = mysqli_fetch_array($csql);
	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Neraca</h4>
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
								<a href=\"#\">Neraca</a>
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
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Periode Transaksi</label>
									  <div class=\"col-sm-2\">
										<input type=\"date\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"\" name=\"tgl1\" value=\"$tgl1\">
									  </div>
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
													<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><h2><b>NERACA<br></b></h2></td>
												</tr>
												<tr>
													<td align=\"center\" style=\"font-size:16px;border:solid 0px black;\" colspan=5><b>Per $tanggal</b></td>
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
													FROM map_neraca a GROUP BY a.no,a.uraian,a.kode,a.bold 
													ORDER BY a.no");
											  $no = 1; 
											  $kewajiban=0;
											  $modal =0;
											  while($fetchArray = mysqli_fetch_array($baca)){
											 
											  $nama      = $fetchArray['uraian'];
											  $nor      = $fetchArray['no'];    
											  $n         = $fetchArray['kode'];
											  
											  $sql5   = mysqli_query($conn,"SELECT SUM(z.nilai) AS nilai FROM(
														SELECT a.kd_akun,SUM(a.kredit-a.debet) as nilai FROM tbl_jurnal a 
														WHERE (left(REPLACE(a.kd_akun,'.',''),1) in ('2','3') AND left(REPLACE(a.kd_akun,'.',''),2) IN (".$n.")) and a.tgl_transaksi<= '$tgl1'
														GROUP BY a.kd_akun
														UNION
														SELECT a.kd_akun,SUM(a.debet-a.kredit) as nilai FROM tbl_jurnal a 
														WHERE (left(REPLACE(a.kd_akun,'.',''),1) in ('1') AND left(REPLACE(a.kd_akun,'.',''),2) IN (".$n.")) and a.tgl_transaksi<= '$tgl1'
														GROUP BY a.kd_akun
														) AS z");
												$trh = mysqli_fetch_array($sql5);
												$nil    = $trh['nilai'];
												
												if ($fetchArray['no']==12){$kewajiban=$trh['nilai'];}
												if ($fetchArray['no']==17){$modal=$trh['nilai'];}
												
												if($fetchArray['no']==19){
												    $nil=$kewajiban+$modal;
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
								(* Anda dapat melihat posisi aktiva, kewajiban dan modal bisnis Anda pada periode tertentu di Laporan Neraca Keuangan
								</div>
							</div>
						</div>
						";
		  
		  
		  
		  if($_POST['tampil']){
		  
				$tgl1 = htmlspecialchars($_POST['tgl1'], ENT_QUOTES);
				$tgl2 = htmlspecialchars($_POST['tgl2'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=neraca&aksi=view\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$tgl1\" name=\"tgl1\">
						  <input type=\"hidden\" value=\"$tgl2\" name=\"tgl2\">
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
