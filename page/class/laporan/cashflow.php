<?php
class cashflow{

    
    function view($tgl1,$tgl2){

			include("config/config.php");
			if(empty($tgl1) || empty($tgl2)){
				$tgl1 = date('Y-m-d');
				$tgl2 = date('Y-m-d');
			}
			
			$select = mysqli_query($conn,"SELECT SUM(debet-kredit) as nilai FROM tbl_jurnal where kd_akun IN ('1.1','1.2')");
	        $data = mysqli_fetch_array($select);
	
	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Laporan Cashflow</h4>
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
								<a href=\"#\">Laporan Cashflow</a>
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
										<input type=\"date\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"\" name=\"tgl2\" value=\"$tgl2\">
									  </div>
									  <div class=\"col-sm-1\">
										<button type=\"submit\" name=\"tampil\" value=\"tampil\" class=\"btn btn-primary btn-sm\"><i class=\"icon-refresh\"></i> Tampilkan</button>
									  </div>
									</div>
									<div class=\"form-group row\">
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Saldo Kas</label>
									  <div class=\"col-sm-2\">";
									  echo "<div class=\"input-icon\">
												<span class=\"input-icon-addon\" style=\"color:#FFFFFF; font-size:15px;\">Rp.</span>
													<input type=\"text\" class=\"form-control\" placeholder=\"\" value=\"".number_format($data['nilai'])."\" id=\"saldo\" name=\"saldo\" 
													style=\"text-align:right; font-size:15px; background-color:#000033; color:#FFFFFF;\" >
											  </div>";	
									  echo "
									  </div>
									</div>
									</h4>
								</div>
								</form>
								<div class=\"card-header\" align=\"right\">
									<h4 class=\"card-title\">
									<div class=\"table-responsive\">
									<table border=0>
									<tr>
										<td>
											<form method=\"post\" action=\"welcome.php?modul=cashflow&aksi=report\" target=\"\">
														<input type=\"hidden\" name=\"tgl1\" value=\"$tgl1\">
														<input type=\"hidden\" name=\"tgl2\" value=\"$tgl2\">
														<button class=\"btn btn-success btn-sm\" type=\"submit\">
																<i class=\"fas fa-print\"></i> Cetak Laporan
														</button>
											</form>
										</td>
										<td>
											&nbsp;
										</td>
									</tr>
									</table>
									</div>
									</h4>
								</div>
								
								<div class=\"card-body\">
									<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												  <tr>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Tanggal</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>No. Transaksi</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Jenis</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=20>Penerimaan</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=20>Pengeluaran</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Keterangan</th>	
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>User</th>	
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,(select nm_pengguna from admin where id=tbl_jurnal.user) as kasir
											         FROM tbl_jurnal WHERE tgl_transaksi BETWEEN '$tgl1' and '$tgl2' and kd_akun IN ('1.1','1.2') ORDER BY tgl_transaksi");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[tgl]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[no_transaksi]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[jenis]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['debet'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['kredit'])."</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[keterangan]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[kasir]</td>
												  </tr>";
												  
												  //Detail
												  
												  $debet = $debet+$fetchArray['debet'];
												  $kredit = $kredit+$fetchArray['kredit'];
												  
		
											  $no++;}  
											echo "</tbody>
												  <tr>
													<td class=\"text-right\" style=\"font-size:12px;\" colspan=4><b>Jumlah Total</b></td>
													<td class=\"text-right\" style=\"font-size:12px;\"><b>".number_format($debet)."</b></td>
													<td class=\"text-right\" style=\"font-size:12px;\"><b>".number_format($kredit)."</b></td>
													<td class=\"text-center\"></td>
													<td class=\"text-center\"></td>
												  </tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						";
		  
		  
		  
		  if($_POST['tampil']){
		  
				$tgl1 = htmlspecialchars($_POST['tgl1'], ENT_QUOTES);
				$tgl2 = htmlspecialchars($_POST['tgl2'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=cashflow&aksi=view\" method=\"post\" id=\"success\">
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
