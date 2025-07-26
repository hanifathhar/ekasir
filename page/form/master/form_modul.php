<?php
$aksi = $_GET['aksi'];
$id   = $_POST['id'];
$act   = $_POST['act'];

$baca  = mysqli_query($conn,"SELECT  * from modul where id='$id'");
$data 	   = mysqli_fetch_array($baca);


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
												<label for="email2">Page</label>
												<input type="text" class="form-control" id="page" name="page" value="<?php echo "$data[page_id]";?>" required>
											</div>
											<div class="form-group col-lg-5">
												<label for="email2">Kode</label>
												<input type="text" class="form-control" id="kode" name="kode" value="<?php echo "$data[kode]";?>" required>
											</div>
											<div class="form-group col-lg-5">
												<label for="email2">Nama Modul</label>
												<input type="text" class="form-control" id="nama" name="nama" value="<?php echo "$data[modul]";?>" required>
											</div>
											<div class="form-group col-lg-5">
												<label for="email2">URL</label>
												<input type="text" class="form-control" id="url" name="url" value="<?php echo "$data[url]";?>" required>
											</div>
									</div>
								</div>
								<div class="card-action">
									<button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
									<a href="welcome.php?modul=modul&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Kembali</button></a>
								</div>
							</div>
							
						</div>
						</div>
						</form>

<?php

if($_POST['simpan']){


$id = $_POST['id'];
$nama = $_POST['nama'];
$kode = $_POST['kode'];
$page = $_POST['page'];
$url = $_POST['url'];


$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
				
				
				$query = mysqli_query($conn,"UPDATE modul SET modul = '$nama',
													   page_id = '$page',
													   kode = '$kode',
													   url = '$url'
													   WHERE id='$id'");
			
				if($query){
				
				
				echo "<form action=\"welcome.php?modul=modul&aksi=edit\" method=\"post\" id=\"Berhasil\">
						  <input type=\"hidden\" value=\"$id\" name=\"id\">
					</form>";
			
			
		
					
				echo "<script type=\"text/javascript\">
					  swal(\"", "Data Berhasil di Update!\", {
						icon : \"success\",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
								
							}
						},
					}).then(
					function() {
						document.getElementById('Berhasil').submit();
					}
					);
					</script>";
					
				}else{
				
				echo "<form action=\"welcome.php?modul=modul&aksi=edit\" method=\"post\" id=\"Gagal\">
						  <input type=\"hidden\" value=\"$id\" name=\"id\">
					</form>";
					
					
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
						document.getElementById('Gagal').submit();
					}
					);
					</script>";
					
			
				}
				
	}else{
				$query = mysqli_query($conn,"INSERT INTO modul (kode,page_id,modul,url) 
									  VALUE('$kode','$page','$nama','$url')");
				
				if($query){
				echo "<script type=\"text/javascript\">
					  swal(\"", "Data Berhasil di Update!\", {
						icon : \"success\",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
								
							}
						},
					}).then(
					function() {
						window.location = \"welcome.php?modul=modul&aksi=view&act=1\";
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
						window.location = \"welcome.php?modul=modul&aksi=input\";
					}
					);
					</script>";
				}
	
			
	}



}


?>