<?php
class user{

    
    function view($act){

			
			include("config/config.php");
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Manajemen User</h4>
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
								<a href=\"#\">Manajemen User</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									 <form method=\"post\" action=\"welcome.php?modul=user&aksi=input\">
													<button class=\"btn btn-primary btn-sm\" type=\"submit\"><i class=\"fa flaticon-pen\"></i> Tambah User</button>
												</form>
									</h4>
								</div>
								<div class=\"card-body\">
									<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
												 	<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-left\" style=\"background-color:#000033; color:#FFFFFF\">DAFTAR USER</th>
												  </tr>
											</thead>
											<tbody>";
											
											 $baca = mysqli_query($conn,"SELECT  * FROM admin ORDER BY id");
											
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 
															 
											  $inisial = strtoupper(substr($fetchArray['nm_pengguna'],0,1));
											  if($fetchArray['level']=='1'){
												$avatar = "<span class=\"avatar-title rounded-circle border border-white bg-info\">$inisial</span>";
											  }else{
												$avatar = "<span class=\"avatar-title rounded-circle border border-white bg-danger\">$inisial</span>";
											  }
											  
											  echo "<tr>
											        <td class=\"text-center\">$no</td>
													<td>
													  <div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"avatar avatar-online\">
																$avatar
															</div>
															<div class=\"info-user ml-2\">
																<div class=\"username\"><b>".strtoupper($fetchArray['nm_pengguna'])."</b></div>
																<div class=\"status\"><i class=\"fas fa-address-book\"></i> $fetchArray[email] / $fetchArray[no_telp]</div>
															</div>
															<form method=\"post\" action=\"welcome.php?modul=user&aksi=edit\">
															    <input type=\"hidden\" value=\"$fetchArray[id]\" name=\"id\">
																<button class=\"btn btn-icon btn-primary btn-round btn-xs\" type=\"submit\"><i class=\"fas fa-user-edit\"></i></button>
															</form>
															&nbsp;
															<form method=\"post\" action=\"welcome.php?modul=user&aksi=hapus\">
																<input type=\"hidden\" value=\"$fetchArray[id]\" name=\"id\">
																<button class=\"btn btn-icon btn-danger btn-round btn-xs\" type=\"submit\"
																onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\" ><i class=\"fas fa-trash\"></i></button>
															</form>
														</div>
														</div>
													</td>";
													
												  echo "</tr>";
												  
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
    		$query = mysqli_query($conn,"delete from admin where id='$id'");
			
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
						window.location = \"welcome.php?modul=user&aksi=view\";
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
						window.location = \"welcome.php?modul=user&aksi=view\";
					}
					);
					</script>";
				}
     }
		
	
	
	
	
	
	
	
	

	
	
	
	

}
?>