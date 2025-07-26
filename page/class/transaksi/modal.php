<?php
class modal{

    
    function view($tgl1,$tgl2){

			include("config/config.php");
			if(empty($tgl1) || empty($tgl2)){
				$tgl1 = date('Y-m-d');
				$tgl2 = date('Y-m-d');
			}
			
			
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Modal Disetor</h4>
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
								<a href=\"#\">Modal Disetor</a>
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
										<button type=\"submit\" name=\"tampil\" value=\"tampil\" class=\"btn btn-primary btn-sm\"><i class=\"icon-refresh\"></i> Tampilkan</button>
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
											<button class=\"btn btn-primary btn-sm\"><i class=\"fa flaticon-pen\"></i> Input Modal Disetor</button>
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Metode<br>Pembayaran</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Jumlah</th>												
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,IF(pembayaran=1,'Tunai','Non Tunai') as bayar,
											         (select nm_pengguna from admin where id=tbl_modal.user) as kasir
											         FROM tbl_modal WHERE tgl_transaksi BETWEEN '$tgl1' and '$tgl2' ORDER BY no_transaksi,tgl_transaksi");
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
																<div class=\"status\">$fetchArray[bukti]</div>
															</div>
														</div>
														</div>	
													</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[bayar]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['nilai'])."</td>>
													<td class=\"text-center\" style=\"font-size:12px;\">
													<div class=\"card-list\">
														<div class=\"item-list\">
															<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-target=\"#import".$fetchArray['no_transaksi']."\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\">
																	<i class=\"fa flaticon-pen\"></i>
																</button>
															</a>
															&nbsp;
															<form method=\"post\" action=\"welcome.php?modul=modal&aksi=hapus\">
															<input type=\"hidden\" name=\"tgl1\" value=\"$tgl1\">
														    <input type=\"hidden\" name=\"tgl2\" value=\"$tgl2\">
															<button class=\"btn btn-icon btn-danger btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[no_transaksi]\" name=\"id\" 
															onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\">
																<i class=\"fas fa-trash\"></i>
															</button>
															</form>
														</div>
													</div>		
													</td>
												  </tr>";
												  
												  //Detail
												  
											  echo "<div class=\"modal fade\" id=\"import".$fetchArray['no_transaksi']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
														aria-hidden=\"true\">
														<div class=\"modal-dialog\" role=\"document\">
														<form enctype=\"\" method=\"post\" action=\"\">
														<input type=\"hidden\" value=\"$fetchArray[no_transaksi]\" name=\"idx\">
														  <div class=\"modal-content\">
															<div class=\"modal-header\" style=\"background-color:#003399; color:#FFFFFF;\">
															  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"fas fa-save\"></i> Modal Disetor</h5>
															</div>
															<div class=\"modal-body\">";
															
															echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Tanggal</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"date\" class=\"form-control\" id=\"tglx\" name=\"tglx\" value=\"$fetchArray[tgl_transaksi]\" required>
																  </div>
																</div>";
															echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>No. Bukti</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"text\" class=\"form-control\" id=\"buktix\" name=\"buktix\" value=\"$fetchArray[bukti]\" required>
																  </div>
																</div>";	
														   echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Keterangan</b></label>
																  <div class=\"col-sm-8\">
																	<input type=\"text\" class=\"form-control\" id=\"ketx\" name=\"ketx\" value=\"$fetchArray[keterangan]\" required>
																  </div>
																</div>";
																
														 
																
														   echo "<div class=\"form-group row\">
																  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Jumlah</b></label>
																  <div class=\"col-sm-8\">
																	<div class=\"input-icon\">
																	<span class=\"input-icon-addon\">Rp</span>
																		<input type=\"text\" class=\"form-control\" id=\"nilaix\" style=\"text-align:right;\" name=\"nilaix\" value=\"$fetchArray[nilai]\" required>
																		</div>
																  </div>
															  </div>";
															
											
														   echo "</div>
												<div class=\"modal-footer\">
													<button type=\"button\" class=\"btn btn-warning btn-sm\" data-dismiss=\"modal\"><i class=\"fas fa-reply\"></i> Batal</button>
													<button type=\"submit\" name=\"update\" value=\"update\" class=\"btn btn-primary btn-sm\"><i class=\"fas fa-save\"></i> update</button>
												</div>
											  </div>
											  </form>
											</div>
										  </div>";
		  
		  
		  
		  
												  
											  $total = $total+$fetchArray['nilai'];
											  $no++;}  
											echo "</tbody>
												  <tr>
													<td class=\"text-right\" style=\"font-size:12px;\" colspan=5><b>Jumlah Total</b></td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($total)."</td>
													<td class=\"text-center\"></td>
												  </tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						";
						
						$user = $_SESSION['id'];
						$sql = mysqli_query($conn,"SELECT  IFNULL(MAX(SUBSTR(no_transaksi,16,6)),0) AS nom from tbl_modal");
						$tampil = mysqli_fetch_array($sql);
						$res = mysqli_num_rows($sql);
							
							if($tampil['nom'] < 1 ){
								
								
									$kode = "MD".$user."".date('Ymd')."000001";
								
								
							}else{
							
								$urutan = (int) $tampil['nom'];
							 
								// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
								$urutan++;
								
								$huruf = "MD".$user."".date('Ymd');
								$nomor = $huruf."".sprintf("%06s", $urutan);
								
								
								$kode = $nomor;
							}
						
						echo "<div class=\"modal fade\" id=\"import\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
						aria-hidden=\"true\">
						<div class=\"modal-dialog\" role=\"document\">
						<form enctype=\"\" method=\"post\" action=\"\">
						<input type=\"hidden\" value=\"$kode\" name=\"id\">
						  <div class=\"modal-content\">
							<div class=\"modal-header\" style=\"background-color:#003399; color:#FFFFFF;\">
							  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"fas fa-save\"></i> Modal Disetor</h5>
							</div>
							<div class=\"modal-body\">";
							
							echo "<div class=\"form-group row\">
								  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Tanggal</b></label>
								  <div class=\"col-sm-8\">
									<input type=\"date\" class=\"form-control\" id=\"tgl\" name=\"tgl\" value=\"".date('Y-m-d')."\" required>
								  </div>
								</div>";
						    echo "<div class=\"form-group row\">
								  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>No. Bukti</b></label>
								  <div class=\"col-sm-8\">
									<input type=\"text\" class=\"form-control\" id=\"bukti\" name=\"bukti\" value=\"\" required>
								  </div>
								</div>";	
						   echo "<div class=\"form-group row\">
								  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Keterangan</b></label>
								  <div class=\"col-sm-8\">
									<input type=\"text\" class=\"form-control\" id=\"ket\" name=\"ket\" value=\"\" required>
								  </div>
								</div>";
						
								
						   echo "<div class=\"form-group row\">
								  <label for=\"inputEmail3\" class=\"col-sm-3 col-form-label\"><b>Jumlah</b></label>
								  <div class=\"col-sm-8\">
									<div class=\"input-icon\">
									<span class=\"input-icon-addon\">Rp</span>
										<input type=\"text\" class=\"form-control\" id=\"nilai\" style=\"text-align:right;\" name=\"nilai\" value=\"\" required>
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
						
						
						
		  
		  
		  if($_POST['tampil']){
		  
				$tgl1 = htmlspecialchars($_POST['tgl1'], ENT_QUOTES);
				$tgl2 = htmlspecialchars($_POST['tgl2'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=modal&aksi=view\" method=\"post\" id=\"success\">
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
				$pembayaran = htmlspecialchars($_POST['pembayaran'], ENT_QUOTES);
				$nilai = htmlspecialchars($_POST['nilai'], ENT_QUOTES);
				
				$user = $_SESSION['id'];
				
				$query = mysqli_query($conn,"INSERT INTO tbl_modal (no_transaksi,tgl_transaksi,keterangan,bukti,pembayaran,nilai,tgl_update,user) 
									  VALUE('$id','$tgl','$ket','$bukti','$pembayaran','$nilai',NOW(),'$user')");
									  
				if($query){
					
					echo "<form action=\"welcome.php?modul=modal&aksi=view\" method=\"post\" id=\"success\">
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
		  if($_POST['update']){
		  
		  	    $tgl = htmlspecialchars($_POST['tglx'], ENT_QUOTES);
				$id = htmlspecialchars($_POST['idx'], ENT_QUOTES);
				$ket = htmlspecialchars($_POST['ketx'], ENT_QUOTES);
				$bukti = htmlspecialchars($_POST['buktix'], ENT_QUOTES);
				$pembayaran = htmlspecialchars($_POST['pembayaranx'], ENT_QUOTES);
				$nilai = htmlspecialchars($_POST['nilaix'], ENT_QUOTES);
				
				$user = $_SESSION['id'];
				
				$query = mysqli_query($conn,"delete from tbl_modal where no_transaksi='$id'");
				$query = mysqli_query($conn,"INSERT INTO tbl_modal (no_transaksi,tgl_transaksi,keterangan,bukti,pembayaran,nilai,tgl_update,user) 
									  VALUE('$id','$tgl','$ket','$bukti','$pembayaran','$nilai',NOW(),'$user')");
				
				/*
				$query = mysqli_query($conn,"UPDATE tbl_modal SET tgl_transaksi = '$tgl',
													   keterangan = '$ket',
													   bukti = '$bukti',
													   pembayaran = '$pembayaran',
													   nilai = '$nilai',
													   tgl_update = NOW(),
													   user = '$user'
													   WHERE no_transaksi='$id'");*/
									  
				if($query){
					
					echo "<form action=\"welcome.php?modul=modal&aksi=view\" method=\"post\" id=\"success\">
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