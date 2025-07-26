<?php
class grup{

    
    function view($act){

				   
		/* echo "<div class=\"d-sm-flex align-items-center justify-content-between mb-4\">
				<h1 class=\"h3 mb-0 text-gray-800\">Group Menu</h1>
				<ol class=\"breadcrumb\">
				  <li class=\"breadcrumb-item\"><a href=\"#\">Home</a></li>
				  <li class=\"breadcrumb-item active\" aria-current=\"page\">Group Menu</li>
				</ol>
			  </div>";
			  
		if($act == '1'){
		
		echo "<div class=\"form-group\">
					<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">&times;</span>
						</button>
						<h6><i class=\"fas fa-check\"></i><b> Success</b></h6>
							Data Berhasil Tersimpan !!!
						</div>
					</div>
				";
		}else
		if($act == '2'){
		
		echo "<div class=\"form-group\">
					<div class=\"alert alert-success alert-dismissible\" role=\"alert\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">&times;</span>
						</button>
						<h6><i class=\"fas fa-check\"></i><b> Success</b></h6>
							Data Berhasil Dihapus !!!
						</div>
					</div>
				";
		}else
		if($act == '0'){
		
		echo "<div class=\"form-group\">
					<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">&times;</span>
						</button>
						<h6><i class=\"fas fa-exclamation-triangle\"></i><b> Warning</b></h6>
							Data Gagal Dihapus !!!
						</div>
					</div>
				";
		}
			  
		echo "<div class=\"row\">
            <!-- Datatables -->
            <div class=\"col-lg-12\">
              <div class=\"card mb-4\">
                <div class=\"card-header py-3 d-flex flex-row align-items-center justify-content-between\">
                  <h6 class=\"m-0 font-weight-bold text-primary\">
				  <a href=\"welcome.php?modul=grup&aksi=input\" class=\"btn btn-primary btn-icon-split\">
                    <span class=\"icon text-white-50\">
                      <i class=\"fas fa-plus\"></i>
                    </span>
                    <span class=\"text\">Tambah Data</span>
                  </a>
				  </h6>
                </div>
				
                <div class=\"table-responsive p-3\">
                  <table class=\"table align-items-center table-flush\" id=\"dataTable\">
                    <thead class=\"thead-light\">
					
                      <tr>
                        <th class=\"text-center\" style=\"background-color:#6777EF; color:#FFFFFF\" width=5>No.</th>
						<th class=\"text-center\" style=\"background-color:#6777EF; color:#FFFFFF\" width=5>Kode</th>
                        <th class=\"text-center\" style=\"background-color:#6777EF; color:#FFFFFF\">Nama Group</th>
						<th class=\"text-center\" style=\"background-color:#6777EF; color:#FFFFFF\" width=100>Modul</th>
                        <th class=\"text-center\" style=\"background-color:#6777EF; color:#FFFFFF\" width=100>Aksi</th>
                      </tr>
					  
                    </thead>
                     <tbody>";
				 $baca = mysql_query("SELECT  *,(SELECT COUNT(b.id) AS n FROM otoritas_menu b WHERE a.id_grup=b.id_grup) menu 
								             FROM group_admin a ORDER BY a.id_grup");
				 $no = 1;	
                 while($fetchArray = mysql_fetch_array($baca)){
                 echo "<tr>
                        <td class=\"text-center\">$no</td>
						<td class=\"text-center\">$fetchArray[id_grup]</td>
						<td>$fetchArray[nm_grup]</td>
						<td class=\"text-center\">$fetchArray[menu] modul</td>
                        <td class=\"text-center\"><a href=\"welcome.php?modul=grup&aksi=edit&id=$fetchArray[id_grup]\" class=\"btn btn-primary btn-sm\"><i class=\"fas fa-edit\"></i></a>&nbsp;
						    <a href=\"welcome.php?modul=grup&aksi=hapus&id=$fetchArray[id_grup]\" onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\" class=\"btn btn-danger btn-sm\"><i class=\"fas fa-trash\"></i></a></td>
                      </tr>";
				  $no++;}  
			    echo "</tbody>
                  </table>
                </div>
              </div>
            </div>";*/
			
			include("config/config.php");
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Group Menu</h4>
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
								<a href=\"#\">Group Menu</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\">
									<a href=\"welcome.php?modul=grup&aksi=input\">
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Group</th>
												  </tr>
											</thead>
											<tbody>";
											 $baca = mysqli_query($conn,"SELECT  *,(SELECT COUNT(b.id) AS n FROM otori_menu b WHERE a.id_grup=b.id_grup) menu 
								             FROM admin_grup a ORDER BY a.id_grup");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
											 echo "<tr>
													<td class=\"text-center\">$no</td>
													<td class=\"text-center\">$fetchArray[id_grup]</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".strtoupper($fetchArray['nm_grup'])."</b></div>
																<div class=\"status\">$fetchArray[menu] modul</div>
															</div>
															<div class=\"info-user ml-13\">
																<div class=\"status\">&nbsp;</div>
																<div class=\"status\">&nbsp;</div>
															</div>
															<form method=\"post\" action=\"welcome.php?modul=grup&aksi=edit\">
															<button class=\"btn btn-icon btn-primary btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[id_grup]\" name=\"id\">
																<i class=\"fas flaticon-pen\"></i>
															</button>
															</form>
															&nbsp;
															<form method=\"post\" action=\"welcome.php?modul=grup&aksi=hapus\">
															<button class=\"btn btn-icon btn-danger btn-round btn-xs\" type=\"submit\" value=\"$fetchArray[id_grup]\" name=\"id\" 
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
						</div>";

    }
	
	
	function hapus($id){
			
			include("config/config.php");
    		$query = mysqli_query($conn,"delete from admin_grup where id_grup='$id'");
			$query = mysqli_query($conn,"delete from otori_menu where id_grup='$id'");
			
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
						window.location = \"welcome.php?modul=grup&aksi=view\";
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
						window.location = \"welcome.php?modul=grup&aksi=view\";
					}
					);
					</script>";
				}
     }
		
	
	
	
	
	
	
	
	

	
	
	
	

}
?>