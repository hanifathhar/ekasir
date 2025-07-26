
<?php
$aksi = $_GET['aksi'];
$id   = $_POST['id'];
$act   = $_POST['act'];

$baca  = mysqli_query($conn,"SELECT  * from admin_grup where id_grup='$id'");
$data 	   = mysqli_fetch_array($baca);

?>
<script type="text/javascript">
		$(document).ready(function(){
		
			$("#check-all").click(function(){ // Ketika user men-cek checkbox all
			  if($(this).is(":checked")) // Jika checkbox all diceklis
				$(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
			  else // Jika checkbox all tidak diceklis
				$(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
			 }); 
			
			 
		});
</script>


          

		  <?php
		  	
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
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Form</a>
							</li>
						</ul>
					</div>";
		  
		  ?>

			 <form action="" method="post">
			 <input type="hidden" value="<?php echo "$id";?>" name="id">
			 <input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
	
              <div class="row">
			     
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Form Entry</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6 col-lg-12">
											<div class="form-group col-lg-5">
												<label for="email2">Kode</label>
												<input type="text" class="form-control" id="kode" name="kode" value="<?php echo "$data[id_grup]";?>" required>
											</div>
											<div class="form-group col-lg-5">
												<label for="email2">Nama Group</label>
												<input type="text" class="form-control" id="nama" name="nama" value="<?php echo "$data[nm_grup]";?>" required>
											</div>
									</div>
								</div>
								<div class="form-group col-lg-5">
									<button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
									<a href="welcome.php?modul=grup&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Kembali</button></a>
								</div>
							</div>
							<?php
							echo "<div class=\"card-body\">
									<div class=\"table-responsive\">
										<table id=\"basic-datatabless\" class=\"display table table-striped table-hover\" >
											<thead>
												<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5><input type=\"checkbox\" id=\"check-all\"></th>
												<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
												<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Page</th>
												<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Kode</th>
												<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Modul</th>
											</thead>
											<tbody>";
								if($aksi=='edit'){
									$baca = mysqli_query($conn,"SELECT a.* FROM (
											SELECT  kode,modul,page_id,url,'1' as ck FROM otori_menu WHERE id_grup='$id' 
											UNION
											SELECT  kode,modul,page_id,url as url,'0' as ck FROM modul WHERE 
											kode NOT IN (SELECT kode FROM otori_menu WHERE id_grup='$id') 
											) AS a ORDER BY a.kode");
								}else{
									$baca = mysqli_query($conn,"SELECT  kode,modul,page_id,url as url,'0' as ck FROM modul ORDER BY kode");
								}
								$no = 1;	
								while($fetchArray = mysqli_fetch_array($baca)){
								
								 echo "<tr>";
					 		
											 if($fetchArray['ck']=='1'){	  
												  echo "<td class=\"text-center\"><input class=\"check-item\" type=\"checkbox\" name=\"check[$no]\" value=\"$fetchArray[kode]\" checked /></td>";
											 }else{
												  echo "<td class=\"text-center\"><input class=\"check-item\" type=\"checkbox\" name=\"check[$no]\" value=\"$fetchArray[kode]\" /></td>";
											 }
					 
											echo "<td class=\"text-center\">$no</td>
											<td class=\"text-center\">$fetchArray[page_id]</td>
											<td class=\"text-center\">$fetchArray[kode]</td>
											<td>$fetchArray[modul]</td>
										  </tr>";
								  $no++;}  
								  echo "</tbody>
								  </table>
								</div>
							  </div>";
							?>
						</div>
						</div>
						</form>
					
					
					
                 



<?php

if($_POST['simpan']){


$kode = $_POST['kode'];
$nama  = $_POST['nama'];
$aksi = $_POST['aksi'];
$cek = $_POST['check'];


$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
		if($cek==''){
				
				mysqli_query($conn,"DELETE from otori_menu where id_grup='$kode'");
				
				echo "<form action=\"welcome.php?modul=grup&aksi=$aksi\" method=\"post\" id=\"warning\">
						  <input type=\"hidden\" value=\"$id\" name=\"id\">
					</form>";
					
				echo "<script type=\"text/javascript\">
						swal(\"Maaf! ", "Belum ada Modul yang anda pilih untuk di tampilkan!\", {
						icon : \"error\",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
								
							}
						},
					}).then(
					function() {
						document.getElementById('warning').submit();
					}
					);
					</script>";
		}else{	
				
				mysqli_query($conn,"UPDATE admin_grup SET nm_grup='$nama' WHERE id_grup='$kode'");
	            
				mysqli_query($conn,"DELETE from otori_menu where id_grup='$kode'");
				foreach($_POST['check'] as $key => $val){
					$sql = mysqli_query($conn,"SELECT * FROM modul WHERE kode ='".$val."'");
					while($data = mysqli_fetch_array($sql)){
					
					$kode_menu = $data['kode'];
					$modul = $data['modul'];
					$page_id = $data['page_id'];
					$url = $data['url'];
					
					
					
					$update = mysqli_query($conn,"INSERT INTO otori_menu (kode,modul,page_id,url,id_grup) 
					VALUES ('$kode_menu','$modul','$page_id','$url','$kode')");
					
					
					}
					
					
					echo "<form action=\"welcome.php?modul=grup&aksi=$aksi\" method=\"post\" id=\"success\">
							  <input type=\"hidden\" value=\"$kode\" name=\"id\">
						</form>";
					
					
					echo "<script type=\"text/javascript\">
						  swal(\"Ok! ", "Data Berhasil di Update!\", {
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
			
				
				
	}else{
									  
				
				
				
				if($cek==''){
				
					echo "<form action=\"welcome.php?modul=grup&aksi=$aksi\" method=\"post\" id=\"warning\">
							  <input type=\"hidden\" value=\"$id\" name=\"id\">
						</form>";
			
					echo "<script type=\"text/javascript\">
						swal(\"Maaf! ", "Belum ada Modul yang anda pilih untuk di tampilkan!\", {
						icon : \"error\",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
								
							}
						},
					}).then(
					function() {
						document.getElementById('warning').submit();
					}
					);
					</script>";
				}else{
					
					mysqli_query($conn,"INSERT INTO admin_grup (id_grup,nm_grup) VALUES ('$kode','$nama')");
					
					foreach($_POST['check'] as $key => $val){
						$sql = mysqli_query($conn,"SELECT * FROM modul WHERE kode ='".$val."'");
						while($data = mysqli_fetch_array($sql)){
						
						$kode_menu = $data['kode'];
						$modul = $data['modul'];
						$page_id = $data['page_id'];
						$url = $data['url'];
						
						
						
						$update = mysqli_query($conn,"INSERT INTO otori_menu (kode,modul,page_id,url,id_grup) 
						VALUES ('$kode_menu','$modul','$page_id','$url','$kode')");
						
						
						}
						
						
						echo "<form action=\"welcome.php?modul=grup&aksi=$aksi\" method=\"post\" id=\"success\">
								  <input type=\"hidden\" value=\"$kode\" name=\"id\">
							</form>";
						
						echo "<script type=\"text/javascript\">
							  swal(\"Ok! ", "Data Berhasil di Simpan!\", {
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



}


?>