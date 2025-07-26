<?php
class hutang{

    
    function view($tgl1,$tgl2){

			include("config/config.php");
			if(empty($tgl1) || empty($tgl2)){
				$tgl1 = date('Y-m-d');
				$tgl2 = date('Y-m-d');
			}
			
			
			
			
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Hutang</h4>
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
								<a href=\"#\">Transaksi</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Hutang</a>
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
									  <label for=\"inputEmail3\" class=\"col-sm-2 col-form-label\" style=\"text-align:right\">Periode Transaksi</label>
									  <div class=\"col-sm-2\">
										<input type=\"date\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"\" name=\"tgl1\" value=\"$tgl1\">
									  </div>
									  <div class=\"col-sm-2\">
										<input type=\"date\" class=\"form-control\" id=\"inputEmail3\" placeholder=\"\" name=\"tgl2\" value=\"$tgl2\">
									  </div>
									  <div class=\"col-sm-1\">
										<button type=\"submit\" name=\"tampil\" value=\"tampil\" class=\"btn btn-default btn-sm\"><i class=\"icon-refresh\"></i> Tampilkan</button>
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
											<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-target=\"#import\">
											<button class=\"btn btn-primary btn-sm\"><i class=\"fa flaticon-pen\"></i> Pelunasan Hutang</button>
											</a>
										</td>
										<td>
											&nbsp;
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Keterangan</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Nilai Hutang</th>	
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Nilai Pelunasan</th>	
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Sisa Hutang</th>												
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											
											 $baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,IF(nm_member<>'',nm_member,'Umum') as pembeli,
											         (select nm_pengguna from admin where id=tbl_hutang.user) as kasir,DATE_FORMAT(tgl_faktur, '%d/%m/%Y') AS tgl_faktur
											         FROM tbl_hutang WHERE tgl_transaksi BETWEEN '$tgl1' and '$tgl2' AND lunas='1' ORDER BY no_transaksi,tgl_transaksi");
											 
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[tgl]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[no_transaksi]</td>
													<td class=\"text-left\" style=\"font-size:12px;\">
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"status\"><b>".($fetchArray['keterangan'])."</b></div>
																<div class=\"status\">$fetchArray[pembeli]</div>
																<div class=\"status\">$fetchArray[faktur]</div>
															</div>
														</div>
														</div>	
													</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['total_hutang'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['pelunasan'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['saldo'])."</td>
													<td class=\"text-center\" style=\"font-size:12px;\">
													<div class=\"card-list\">
														<div class=\"item-list\">
															<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-target=\"#import".$fetchArray['faktur']."\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\">
																	<i class=\"fa flaticon-pen\"></i>
																</button>
															</a>
														</div>
													</div>		
													</td>
												  </tr>";
												  
												  //Detail
												  
											
										
														
												
												  
											  echo "<div class=\"modal fade\" id=\"import".$fetchArray['faktur']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
														aria-hidden=\"true\">
														<div class=\"modal-dialog\" role=\"document\">
														<form enctype=\"\" method=\"post\" action=\"\">
														<input type=\"hidden\" value=\"$fetchArray[no_transaksi]\" name=\"idx\">
														  <div class=\"modal-content\">
															<div class=\"modal-header\" style=\"background-color:#000033; color:#FFFFFF;\">
															  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"flaticon-agenda-1\"></i> Pelunasan Hutang</h5>
															</div>
															<div class=\"modal-body\">";
															
															echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Tanggal</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"date\" class=\"form-control\" id=\"tgl\" name=\"tgl\" value=\"$fetchArray[tgl_transaksi]\" required>
																  </div>
																</div>";
															echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>No. Bukti</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"text\" class=\"form-control\" id=\"buktix\" name=\"buktix\" value=\"$fetchArray[faktur]\" readonly>
																  </div>
																</div>";	
														   echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Keterangan</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"text\" class=\"form-control\" id=\"\" name=\"\" value=\"$fetchArray[pembeli]\" readonly>
																  </div>
																</div>";
														
																
														   echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Nilai Hitang</b></label>
																  <div class=\"col-sm-8\">
																	<div class=\"input-icon\">
																	<span class=\"input-icon-addon\">Rp</span>
																		<input type=\"text\" class=\"form-control\" id=\"\" style=\"text-align:right;\" name=\"\" 
																		value=\"$fetchArray[total_hutang]\" readonly>
																		</div>
																  </div>
															  </div>";
															  
														
														  echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Pelunasan</b></label>
																  <div class=\"col-sm-8\">
																	<div class=\"input-icon\">
																	<span class=\"input-icon-addon\">Rp</span>
																		<input type=\"text\" class=\"form-control\" id=\"\" style=\"text-align:right;\" name=\"\" value=\"$fetchArray[pelunasan]\" required>
																		</div>
																  </div>
															  </div>";
															
											
											echo "</div>
												<div class=\"modal-footer\">
													<button type=\"button\" class=\"btn btn-warning btn-sm\" data-dismiss=\"modal\"><i class=\"fas fa-reply\"></i> Batal</button>
													<button type=\"submit\" name=\"hapus\" value=\"hapus\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\">
													<i class=\"fas fa-trash\"></i> Hapus</button>
												</div>
											  </div>
											  </form>
											</div>
										  </div>";
		  
		  
		  
		  
												  
											  $total = $total+$fetchArray['total_hutang'];
											  $pelunasan = $pelunasan+$fetchArray['pelunasan'];
											  $saldo = $saldo+$fetchArray['saldo'];
											  $no++;}  
											echo "</tbody>
												  <tr>
													<td class=\"text-right\" style=\"font-size:12px;\" colspan=4><b>Jumlah Total</b></td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($total)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($pelunasan)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($saldo)."</td>
													<td class=\"text-center\"></td>
												  </tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						";
						
						
					    $tgl =  date('Y-m-d');
						
		 				 echo "<div class=\"modal fade\" id=\"import\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
														aria-hidden=\"true\">
														<div class=\"modal-dialog\" role=\"document\">
														<form enctype=\"\" method=\"post\" action=\"\">
														  <div class=\"modal-content\">
															<div class=\"modal-header\" style=\"background-color:#000033; color:#FFFFFF;\">
															  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"flaticon-agenda-1\"></i> Pelunasan Hutang</h5>
															</div>
															<div class=\"modal-body\">";
															echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Tanggal</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"date\" class=\"form-control\" id=\"tgl\" name=\"tgl\" value=\"$tgl\" required>
																  </div>
																</div>";
															echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>No. Bukti</b></label>
																   <div class=\"col-sm-8\">
																	<div class=\"input-icon\">
																		<input type=\"text\" class=\"form-control\" placeholder=\"\" value=\"\" id=\"bukti\" name=\"bukti\">
																			<span class=\"input-icon-addon\">
																			 <button data-toggle=\"modal\" data-target=\"#daftar\" type=\"button\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-search\"></i> cari</button>
																			</span>
																		</div>
																  </div>
																</div>";	
														   echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Keterangan</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"text\" class=\"form-control\" id=\"ket\" name=\"ket\" value=\"$fetchArray[pembeli]\" readonly>
																  </div>
																</div>";
														
																
														   echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Nilai Hutang</b></label>
																  <div class=\"col-sm-8\">
																	<div class=\"input-icon\">
																	<span class=\"input-icon-addon\">Rp</span>
																		<input type=\"text\" class=\"form-control\" id=\"total_hutang\" style=\"text-align:right;\" name=\"total_hutang\" value=\"$fetchArray[total_hutang]\" readonly>
																		</div>
																  </div>
															  </div>";
															  
														
														  echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Pelunasan</b></label>
																  <div class=\"col-sm-8\">
																	<div class=\"input-icon\">
																	<span class=\"input-icon-addon\">Rp</span>
																		<input type=\"text\" class=\"form-control\" id=\"nilaix\" style=\"text-align:right;\" name=\"pelunasan\" value=\"$fetchArray[pelunasan]\" required>
																		</div>
																  </div>
															  </div>";
															
											
														   echo "</div>
												<div class=\"modal-footer\">
													<button type=\"button\" class=\"btn btn-warning btn-sm\" data-dismiss=\"modal\"><i class=\"fas fa-reply\"></i> Batal</button>
													<button type=\"submit\" name=\"simpan\" value=\"simpan\" class=\"btn btn-primary btn-sm\"><i class=\"fas fa-save\"></i> Simpan</button>
												</div>
											  </div>
											  </form>
											</div>
										  </div>";	
										  
										  
				
				
				echo "<div class=\"modal fade\" id=\"daftar\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
														aria-hidden=\"true\">
														<div class=\"modal-dialog modal-lg\" role=\"document\">
														<form enctype=\"\" method=\"post\" action=\"\">
														<input type=\"hidden\" value=\"$kode\" name=\"id\">
														  <div class=\"modal-content\">
															<div class=\"modal-header\" style=\"background-color:#000033; color:#FFFFFF;\">
															  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"fas fa-book-open\"></i> Daftar Hutang</h5>
															</div>
															<div class=\"modal-body\">";
															
															echo "<div class=\"table-responsive\">
																<table id=\"basic-datatables_new2\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\">
																	<thead>
																		 <tr>
																			<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=5>No.</th>
																			<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=500>Daftar Hutang</th>
																			<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=>Aksi</th>
																		  </tr>
																	</thead>
																	<tbody>";
																	
																	$baca = mysqli_query($conn,"SELECT * FROM tbl_hutang WHERE lunas='0' ORDER BY faktur");
																	 $no = 1;	
																	 while($fetchArray = mysqli_fetch_array($baca)){
																
																	  echo "<tr class=\"hutang\" data-a=\"$fetchArray[faktur]\" data-b=\"$fetchArray[nm_member]\" data-c=\"$fetchArray[total_hutang]\" >
																				<td style=\"\">$no</td>
																				<td style=\"\">
																				<div class=\"card-list\">
																				<div class=\"item-list\">
																					<div class=\"info-user ml-3\">
																						<div class=\"username\"><b>".($fetchArray['faktur'])."</b></div>
																						<div class=\"status\">$fetchArray[nm_member]</div>
																					</div>
																					<div class=\"status\">Rp.".number_format($fetchArray['total_hutang'])."
																						<div class=\"status\">$fetchArray[keterangan]</div>
																					</div>
																				</div>
																				</div>	
																				</td>
																				<td style=\"\"><button type=\"button\" name=\"hutang\" value=\"hutang\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
																				<i class=\"fas fa-plus\"></i></button></td>
																		   </tr>";
																	$no++;			 
																	}
													  
																	echo "</tbody>
																</table>
															</div>";
															
											
														   echo "</div>
												<div class=\"modal-footer\">
													<button type=\"button\" class=\"btn btn-danger btn-sm\" data-dismiss=\"modal\"><i class=\"fas fa-reply\"></i> Batal</button>
												</div>
											  </div>
											  </form>
											</div>
										  </div>";				
						
						
		  
		  
		  if($_POST['tampil']){
		  
				$tgl1 = htmlspecialchars($_POST['tgl1'], ENT_QUOTES);
				$tgl2 = htmlspecialchars($_POST['tgl2'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=piutang&aksi=view\" method=\"post\" id=\"success\">
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
		  
		  
		  
		  }else
		  if($_POST['simpan']){
		  
		  	    $tgl = htmlspecialchars($_POST['tgl'], ENT_QUOTES);
				$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
				$ket = htmlspecialchars($_POST['ket'], ENT_QUOTES);
				$bukti = htmlspecialchars($_POST['bukti'], ENT_QUOTES);
				$total_hutang = htmlspecialchars($_POST['total_hutang'], ENT_QUOTES);
				$pelunasan = htmlspecialchars($_POST['pelunasan'], ENT_QUOTES);
				$saldo = $total_hutang-$pelunasan;
				$user = $_SESSION['id'];
				
				if($saldo == 0){
					$query = mysqli_query($conn,"UPDATE tbl_hutang SET tgl_transaksi = '$tgl',
													   pelunasan = '$pelunasan',
													   saldo = '$saldo',
													   tgl_update = NOW(),
													   user = '$user',
													   lunas = '1'
													   WHERE faktur='$bukti'");
													   
					
				}else{
					$query = mysqli_query($conn,"UPDATE tbl_hutang SET tgl_transaksi = '$tgl',
													   pelunasan = '$pelunasan',
													   saldo = '$saldo',
													   tgl_update = NOW(),
													   user = '$user',
													   lunas = '0'
													   WHERE faktur='$bukti'");
													   
					
				}
				
									  
				if($query){
					
					echo "<form action=\"welcome.php?modul=hutang&aksi=view\" method=\"post\" id=\"success\">
					          <input type=\"hidden\" value=\"$faktur\" name=\"id\">
						  </form>";	
					
					echo "<script type=\"text/javascript\">
							swal(\"Ok! ", "Taransaksi Berhasil!\", {
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
						
					
				}else{
					echo "<script type=\"text/javascript\">
							swal(\"Maaf! ", "Data Gagal di Update!\", {
							icon : \"error\",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
									
								}
							},
						}).then(
						function() {
							window.history.go(-1);
						}
						);
						</script>";
				}

		   
		  }else
		  if($_POST['hapus']){
		  
				$id = htmlspecialchars($_POST['idx'], ENT_QUOTES);
				$bukti = htmlspecialchars($_POST['buktix'], ENT_QUOTES);
				$user = $_SESSION['id'];
				
				
				$query = mysqli_query($conn,"UPDATE tbl_hutang SET tgl_transaksi = NULL,
													   pelunasan = '0',
													   saldo = total_hutang,
													   tgl_update = NOW(),
													   user = '$user',
													   lunas = '0'
													   WHERE faktur='$bukti'");
													   
													   
									  
				if($query){
					
					echo "<form action=\"welcome.php?modul=hutang&aksi=view\" method=\"post\" id=\"success\">
					          <input type=\"hidden\" value=\"$faktur\" name=\"id\">
						  </form>";	
					
					echo "<script type=\"text/javascript\">
							swal(\"Ok! ", "Data Berhasil di Hapus!\", {
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
						
					
				}else{
					echo "<script type=\"text/javascript\">
							swal(\"Maaf! ", "Data Berhasil di Hapus!\", {
							icon : \"error\",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
									
								}
							},
						}).then(
						function() {
							window.history.go(-1);
						}
						);
						</script>";
				}
				
		}

    }
	
	
	function hapus($id,$tgl1,$tgl2){
			
			include("config/config.php");
    		$query = mysqli_query($conn,"delete from tbl_modal where no_transaksi='$id'");
			
			
			echo "<form action=\"welcome.php?modul=modal&aksi=view\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$tgl1\" name=\"tgl1\">
						  <input type=\"hidden\" value=\"$tgl2\" name=\"tgl2\">
					</form>";
					
			
			if($query){
				echo "<script type=\"text/javascript\">
					  swal(\"", "Data Berhasil di Hapus!\", {
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
				}else{
				echo "<script type=\"text/javascript\">
						swal(\"Maaf! ", "Data Gagal di Hapus!\", {
						icon : \"error\",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
								
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
<script>
 $(document).on('click', '.hutang', function (e) {
			
				
				document.getElementById("bukti").value = $(this).attr('data-a');
                document.getElementById("ket").value = $(this).attr('data-b');
				document.getElementById("total_hutang").value = $(this).attr('data-c');
				
				
                $('#daftar').modal('hide');
				
            });
</script>