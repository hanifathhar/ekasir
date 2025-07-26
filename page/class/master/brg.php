<?php
class brg{

    
    function view($act){

			include("config/config.php");
			
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Data Barang</h4>
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
								<a href=\"#\">Master Data</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Data Barang</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									</h4>
								</div>
								<div class=\"card-body\">
									<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Jenis Barang</th>
												  </tr>
											</thead>
											<tbody>";
											 
											 $baca = mysqli_query($conn,"SELECT  * FROM ms_akun7 ORDER BY kd_akun7");
											 
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\">$no</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".strtoupper($fetchArray['nm_akun7'])."</b></div>
																<div class=\"status\">$fetchArray[kd_akun7]</div>
															</div>
															<div class=\"info-user ml-13\">
																<div class=\"status\">&nbsp;</div>
																<div class=\"status\">&nbsp;</div>
															</div>
															<a href=\"welcome.php?modul=brg&aksi=detail&jns=$fetchArray[kd_akun7]\" title=\"Next\">
															<button type=\"button\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
																<i class=\"icon-arrow-right-circle\"></i>
															</button>
															</a>
														</div>
														</div>
													</td>";
													
														
													echo "
												  </tr>";
											  $no++;}  
											echo "</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>";

    }
	
	
	function detail($jns){

			include("config/config.php");
			$sql = mysqli_query($conn,"SELECT  * FROM ms_akun7 where kd_akun7='$jns'");
		    $data = mysqli_fetch_array($sql);
			
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Data Unit</h4>
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
								<a href=\"#\">Master Data</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Data OPD</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Data Unit</a>
							</li>
						</ul>
					</div>
						
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
							    <div class=\"card-header\">
									<div class=\"\" role=\"alert\">
										<b>$jns - $data[nm_akun7]</b>
									</div>
								</div>
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									<a href=\"welcome.php?modul=brg&aksi=input&jns=$jns\">
										<button class=\"btn btn-primary btn-sm\"><i class=\"fa flaticon-pen\"></i> Tambah Barang</button>
									</a>
									&nbsp;
									<a href=\"welcome.php?modul=brg&aksi=view\">
										<button class=\"btn btn-danger btn-sm\"><i class=\"icon-action-undo\"></i> Kembali</button>
									</a>
									</h4>
								</div>
								<div class=\"card-body\">
									<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Barang</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Satuan</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=100>Harga</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  * FROM ms_akun8 WHERE kd_akun7='$jns' ORDER BY kd_akun8");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\">$no</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".($fetchArray['nm_akun8'])."</b></div>
																<div class=\"status\">$fetchArray[kd_akun8]</div>
															</div>
														</div>
														</div>
													</td>
													<td class=\"text-center\">$fetchArray[satuan]</td>
													<td class=\"text-right\">".number_format($fetchArray['harga'],2)."</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<a href=\"welcome.php?modul=brg&aksi=edit&id=$fetchArray[kd_akun8]&jns=$jns\" title=\"Edit\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\">
																<i class=\"fas flaticon-pen\"></i>
															</button>
															</a>
															&nbsp;
															<a href=\"welcome.php?modul=brg&aksi=hapus&id=$fetchArray[kd_akun8]\" 
															onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\" title=\"Hapus\">
															<button class=\"btn btn-icon btn-danger btn-round btn-xs\">
																<i class=\"fas fa-trash\"></i>
															</button>
															</a>
														</div>
														</div>
													</td>";	
													echo "
												  </tr>";
											  $no++;}  
											echo "</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>";

    }
	
	
	function hapus($id){
			
			include("config/config.php");
    		$query = mysqli_query($conn,"DELETE FROM ms_akun8 where kd_akun8='$id'");
			
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
						window.history.go(-1);
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
						window.history.go(-1);
					}
					);
					</script>";
				}
     }
	 
	 
	
	
	

}
?>