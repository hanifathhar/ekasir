<?php
class barang{

    
    function view($msg){

			include("config/config.php");
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Barang</h4>
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
								<a href=\"#\">Master</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Barang</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									<div class=\"table-responsive\">
									<table border=0>
									<tr>
										<td>
											<a href=\"welcome.php?modul=barang&aksi=input\">
											<button class=\"btn btn-primary btn-sm\"><i class=\"fa flaticon-pen\"></i> Tambah Data</button>
											</a>
										</td>
										<td>
											<a href=\"javascript:void(0);\" data-toggle=\"modal\" data-target=\"#import\">
											<button class=\"btn btn-success btn-sm\">
												<i class=\"fas fa-upload\"></i> Import Data Barang
											</button>
											</a>
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Barang</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Kategori</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Satuan</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=100>Harga Beli</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=100>Harga Jual</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5></th>
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  *,(select nm_kategori from ms_kategori where kd_kategori=tbl_barang.kd_kategori) as nm_kategori FROM tbl_barang ORDER BY kd_barang");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\">$no</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".($fetchArray['nm_barang'])."</b></div>
																<div class=\"status\">$fetchArray[kd_barang]</div>
															</div>
														</div>
														</div>													
													</td>
													<td class=\"text-center\">$fetchArray[nm_kategori]</td>
													<td class=\"text-center\">$fetchArray[satuan]</td>
													<td class=\"text-right\">".number_format($fetchArray['harga_beli'])."</td>
													<td class=\"text-right\">".number_format($fetchArray['harga_jual'])."</td>
													<td class=\"text-center\">
													<div class=\"card-list\">
														<div class=\"item-list\">
														<form method=\"post\" action=\"welcome.php?modul=barang&aksi=edit\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[kd_barang]\" name=\"id\">
																<i class=\"fas flaticon-pen\"></i>
															</button>
															</form>
															&nbsp;
															<form method=\"post\" action=\"welcome.php?modul=barang&aksi=hapus\">
															<button class=\"btn btn-icon btn-danger btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[kd_barang]\" name=\"id\" 
															onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\">
																<i class=\"fas fa-trash\"></i>
															</button>
															</form>
														</div>
														</div>		
													</td>
												  </tr>";
											  $no++;}  
											echo "</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						";
						
						
						
						
						
						echo "<div class=\"modal fade\" id=\"import\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
						aria-hidden=\"true\">
						<div class=\"modal-dialog\" role=\"document\">
						<form enctype=\"multipart/form-data\" method=\"post\" action=\"controler/upload_barang.php\">
						  <div class=\"modal-content\">
							<div class=\"modal-header\" style=\"background-color:#003399; color:#FFFFFF;\">
							  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"fas fa-upload\"></i> Import Data Barang</h5>
							</div>
							<div class=\"modal-body\">";
							
							echo "<div class=\"form-group\">
								   <div class=\"alert alert-danger\">
												<label for=\"exampleFormControlFile1\">Telusuri File Excel</label>
												<input type=\"file\" class=\"form-control-file\" id=\"filename\" name=\"filename\" required>
									</div>
									</div>
									<div class=\"form-group\">
										<input type=\"checkbox\" name=\"chek\" id=\"chek\" value=\"1\"> Kosongkan Tabel
								  </div>
							      ";
								
							echo "<div class=\"form-group\">
									<div class=\"modal-title\">
									<b> <a title=\"Download File\" href=\"controler/download.php?file=template_barang.xls\">
									      <i class=\"fa  fa-download\"></i> template_barang.xls
									 </a></b>
									</div>
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

    }
	
	
	function hapus($id){
			
			include("config/config.php");
    		$query = mysqli_query($conn,"delete from tbl_barang where kd_barang='$id'");
			
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
						window.location = \"welcome.php?modul=barang&aksi=view\";
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
						window.location = \"welcome.php?modul=barang&aksi=view\";
					}
					);
					</script>";
				}
     }
		
	
	
	
	
	
	
	
	

	
	
	
	

}
?>