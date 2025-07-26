<?php
class modul{

    
    function view($act){

			include("config/config.php");
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Modul</h4>
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
								<a href=\"#\">Pengaturan</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Modul</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									<a href=\"welcome.php?modul=modul&aksi=input\">
									<button class=\"btn btn-primary btn-sm\"><i class=\"fa flaticon-pen\"></i> Tambah Data</button>
									</a>
									</h4>
								</div>
								<div class=\"card-body\">
									<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												  <tr>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Kode</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Modul</th>
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  * FROM modul ORDER BY kode");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\">$no</td>
													<td class=\"text-center\">$fetchArray[kode]</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".strtoupper($fetchArray['modul'])."</b></div>
																<div class=\"status\">$fetchArray[url]</div>
															</div>
															<div class=\"info-user ml-13\">
																<div class=\"status\">&nbsp;</div>
																<div class=\"status\">&nbsp;</div>
															</div>
															<form method=\"post\" action=\"welcome.php?modul=modul&aksi=edit\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[id]\" name=\"id\">
																<i class=\"fas flaticon-pen\"></i>
															</button>
															</form>
															&nbsp;
															<form method=\"post\" action=\"welcome.php?modul=modul&aksi=hapus\">
															<button class=\"btn btn-icon btn-danger btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[id]\" name=\"id\" 
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

    }
	
	
	function hapus($id){
			
			include("config/config.php");
    		$query = mysqli_query($conn,"delete from modul where id='$id'");
			
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
						window.location = \"welcome.php?modul=modul&aksi=view\";
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
						window.location = \"welcome.php?modul=modul&aksi=view\";
					}
					);
					</script>";
				}
     }
		
	
	
	
	
	
	
	
	

	
	
	
	

}
?>