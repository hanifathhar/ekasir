<?php
class stock{

    
    function view($jenis){

			include("config/config.php");
			
			if(empty($jenis)){
				$jenis = '0';
			}else{
				$jenis = $jenis;
			}
			
			if($jenis=='0'){
				$ket = 'Semua Barang';
			}else
			if($jenis=='1'){
				$ket = 'Barang Limit';
			}else
			if($jenis=='2'){
				$ket = 'Barang Terlaris';
			}
			
			
			
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Laporan Stock  Barang</h4>
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
								<a href=\"#\">Laporan Stock  Barang</a>
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
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Jenis Stock</label>
									  <div class=\"col-sm-2\">";
									  echo "<select class=\"select21-single form-control\" name=\"jenis\" id=\"jenis\" required>";
									        
											echo "<option value=\"$jenis\">$ket</option>";;
									  		echo "<option value=\"0\">Semua Barang</option>";;
											echo "<option value=\"1\">Barang Limit</option>";
											echo "<option value=\"2\">Barang Terlaris</option>";
											
									  echo "</select>";	
									  echo "
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
											<form method=\"post\" action=\"welcome.php?modul=stock&aksi=report\" target=\"\">
														<input type=\"hidden\" name=\"jenis\" value=\"$jenis\">
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Kode Barang</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Nama Barang</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=20>Satuan</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Harga Beli</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Harga Jual</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=20>Stock<br>Barang</th>	
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=20>Jumlah<br>Terjual</th>	
												  </tr>
											</thead>
											<tbody>";
											
											 if($jenis=='0'){
											 $baca = mysqli_query($conn,"SELECT  *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang");
											 }else
											 if($jenis=='1'){
											 $baca = mysqli_query($conn,"SELECT  *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang WHERE IFNULL((stock-terjual),0) < 10 LIMIT 10");
											 }else
											 if($jenis=='2'){
											 $baca = mysqli_query($conn,"SELECT  *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang WHERE terjual<>'0' ORDER BY terjual DESC LIMIT 10");
											 }
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 
											 if($fetchArray['saldo']<'1'){
											   echo "<tr style=\"color:#FF0000;\">
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[kd_barang]</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[nm_barang]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[satuan]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_beli'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_jual'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['saldo'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['terjual'])."</td>
												  </tr>";
											}else{
												echo "<tr>
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[kd_barang]</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[nm_barang]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[satuan]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_beli'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['harga_jual'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['saldo'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['terjual'])."</td>
												  </tr>";
											 }
												  
												  //Detail
												  
		
											  $no++;}  
											echo "</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						";
						
						
		  
		  
		  if($_POST['tampil']){
		  
				$jenis = htmlspecialchars($_POST['jenis'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=stock&aksi=view\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$jenis\" name=\"jenis\">
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
	
	
	function hapus($id,$tgl1,$tgl2){
			
			include("config/config.php");
    		$query = mysqli_query($conn,"delete from tbl_pembayaran where no_transaksi='$id'");
			$query = mysqli_query($conn,"delete from tbl_penjualan where no_transaksi='$id'");
			
			
			
			echo "<form action=\"welcome.php?modul=penjualan&aksi=view\" method=\"post\" id=\"success\">
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