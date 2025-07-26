<?php
class pembelian{

    
    function view($tgl1,$tgl2){

			include("config/config.php");
			if(empty($tgl1) || empty($tgl2)){
				$tgl1 = date('Y-m-d');
				$tgl2 = date('Y-m-d');
			}
			
			
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Pembelian</h4>
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
								<a href=\"#\">Pembelian</a>
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
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Periode Pembelian</label>
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
											<a href=\"welcome.php?modul=pembelian&aksi=input\">
											<button class=\"btn btn-primary btn-sm\"><i class=\"fa flaticon-pen\"></i> Input Pembelian</button>
											</a>
										</td>
										<td>
											<form method=\"post\" action=\"welcome.php?modul=pembelian&aksi=report\" target=\"\">
														<input type=\"hidden\" name=\"tgl1\" value=\"$tgl1\">
														<input type=\"hidden\" name=\"tgl2\" value=\"$tgl2\">
														<button class=\"btn btn-default btn-sm\" type=\"submit\">
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>No. Faktur</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=100>Supplier</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Metode<br>Pembayaran</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Sub Total</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Diskon</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Pajak</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Total<br>Pembelian</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Pembayaran</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=>Sisa</th>													
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF; font-size:12px;\" width=5>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  *,DATE_FORMAT(tgl_transaksi, '%d/%m/%Y') AS tgl,IF(pembayaran=1,'Tunai','Kredit') as bayar,
											         (select nm_pengguna from admin where id=tbl_pembelian.user) as kasir,IF(nm_supplier<>'',nm_supplier,'Umum') as supplier 
											         FROM tbl_pembelian WHERE tgl_transaksi BETWEEN '$tgl1' and '$tgl2' ORDER BY no_transaksi,tgl_transaksi");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\" style=\"font-size:12px;\">$no</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[tgl]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[no_transaksi]</td>
													<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[supplier]</td>
													<td class=\"text-center\" style=\"font-size:12px;\">$fetchArray[bayar]</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['total'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['total']*$fetchArray['diskon']/100)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['total']*$fetchArray['pajak']/100)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['grand_total'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['dibayar'])."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($fetchArray['saldo'])."</td>
													<td class=\"text-center\" style=\"font-size:12px;\">
													<div class=\"card-list\">
														<div class=\"item-list\">
															<form method=\"post\" action=\"welcome.php?modul=pembelian&aksi=invoice\">
															<input type=\"hidden\" name=\"tgl1\" value=\"$tgl1\">
															<input type=\"hidden\" name=\"tgl2\" value=\"$tgl2\">
															<button class=\"btn btn-icon btn-default btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[no_transaksi]\" name=\"id\" >
																	<i class=\"fas fa-print\"></i>
																</button>
															</form>
															&nbsp;";
															$sql = mysqli_query($conn,"SELECT * from tbl_hutang where faktur='$fetchArray[no_transaksi]' and lunas='1'");
															$res = mysqli_num_rows($sql);
															if($res < 1 ){
															echo "<form method=\"post\" action=\"welcome.php?modul=pembelian&aksi=edit\">
															<input type=\"hidden\" name=\"tgl1\" value=\"$tgl1\">
															<input type=\"hidden\" name=\"tgl2\" value=\"$tgl2\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[no_transaksi]\" name=\"id\" >
																	<i class=\"fa flaticon-pen\"></i>
																</button>
															</form>";
															}
															echo "
															&nbsp;
															<form method=\"post\" action=\"welcome.php?modul=pembelian&aksi=hapus\">
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
												  
												  $total = $total+$fetchArray['total'];
												  $diskon = $diskon+($fetchArray['total']*$fetchArray['diskon']/100);
												  $pajak = $pajak+($fetchArray['total']*$fetchArray['pajak']/100);
												  $grand_total = $grand_total+$fetchArray['grand_total'];
												  $dibayar = $dibayar+$fetchArray['dibayar'];
												  $saldo = $saldo+$fetchArray['saldo'];
												  
		
											  $no++;}  
											echo "</tbody>
												  <tr>
													<td class=\"text-right\" style=\"font-size:12px;\" colspan=5><b>Jumlah Total</b></td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($total)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($diskon)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($pajak)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($grand_total)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($dibayar)."</td>
													<td class=\"text-right\" style=\"font-size:12px;\">".number_format($saldo)."</td>
													<td class=\"text-center\"></td>
												  </tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						";
						
						
						echo "<div class=\"modal fade\" id=\"import\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
						aria-hidden=\"true\">
						<div class=\"modal-dialog\" role=\"document\">
						<form action=\"\" method=\"post\">
						  <div class=\"modal-content\">
							<div class=\"modal-header\" style=\"background-color:#003399; color:#FFFFFF;\">
							  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"fas fa-upload\"></i> Import Data</h5>
							</div>
							<div class=\"modal-body\">";
							
							echo "<div class=\"form-group\">
								   <div class=\"alert alert-danger\">
												<label for=\"exampleFormControlFile1\">Telusuri File Excel</label>
												<input type=\"file\" class=\"form-control-file\" id=\"exampleFormControlFile1\">
									</div>
									</div>";
								
							echo "<div class=\"form-group\">
									<div class=\"modal-title\">
									<b>Panduan Import Data Excel.</b>
									</div>
									<ol type=\"1\">
										<li>Download file Excel <b>template_barang.xls</b> kemudian edit sesuai data anda.</li>
										<li>Jika file Excel sudah selseai diedit, upload file tersebut pada form diatas.</li>
										<li>Klik Import Excel untuk mulai mengupload.</li>
										<li>Prosess upload selesai. </li>
									</ol>
									
								</div>";
								
							
			
                           echo "</div>
                <div class=\"modal-footer\">
					<button type=\"button\" class=\"btn btn-outline-danger btn-sm\" data-dismiss=\"modal\"><i class=\"fas fa-reply\"></i> Batal</button>
                    <button type=\"submit\" name=\"upload\" value=\"upload\" class=\"btn btn-primary btn-sm\"><i class=\"fas fa-upload\"></i> Import Excel</button>
                </div>
              </div>
			  </form>
            </div>
          </div>";
		  
		  
		  
		  if($_POST['tampil']){
		  
				$tgl1 = htmlspecialchars($_POST['tgl1'], ENT_QUOTES);
				$tgl2 = htmlspecialchars($_POST['tgl2'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=pembelian&aksi=view\" method=\"post\" id=\"success\">
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
	
	
	function hapus($id,$tgl1,$tgl2){
			
			include("config/config.php");
			
			$sql = mysqli_query($conn,"SELECT * from tbl_hutang where faktur='$id' and lunas='1'");
			$res = mysqli_num_rows($sql);
			if($res < 1 ){
			
    		$query = mysqli_query($conn,"delete from tbl_pembelian where no_transaksi='$id'");
			$query = mysqli_query($conn,"delete from tbl_pembelian_det where no_transaksi='$id'");
			$query = mysqli_query($conn,"delete from tbl_hutang where faktur='$id'");
			
			}
			
			
			echo "<form action=\"welcome.php?modul=pembelian&aksi=view\" method=\"post\" id=\"success\">
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
						swal(\"Maaf! ", "Data Gagal di Hapus, Transaksi telah tercatat di daftar Pelunasan Hutang\", {
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