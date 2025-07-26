<?php
		  echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Profil Company</h4>
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
								<a href=\"#\">Profil Company</a>
							</li>
						</ul>
					</div>";
					
					
$baca = mysqli_query($conn,"SELECT * FROM ms_profil");
$data = mysqli_fetch_array($baca);
		  
?>
		  
		   <div class="row">
		 
						<div class="col-md-8">
							<div class="card card-post card-round">
							<div class="card card-profile">
								<div class="card-header" style="background-image:url(../assets/img/bg.jpeg); no-repeat center center fixed;
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
					    background-size: cover;">
								</div>
							</div>
								<div class="card-body">
									<form action="" method="post" enctype="multipart/form-data">
				                       <input type="hidden" value="" name="aksi">
									   
										<div class="form-group row">
										  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Company</label>
										  <div class="col-sm-5">
											<input type="text" class="form-control" id="inputEmail3" placeholder="" name="nama" value="<?php echo $data['company'];?>" required>
										  </div>
										</div>
										<div class="form-group row">
										  <label for="inputEmail3" class="col-sm-2 col-form-label">No. Telp</label>
										  <div class="col-sm-5">
											<input type="text" class="form-control" id="inputEmail3" placeholder="" name="telp" value="<?php echo $data['no_telp'];?>" required>
										  </div>
										  <label for="inputEmail3" class="col-sm-1 col-form-label" style="text-align:right">Email</label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="inputEmail3" placeholder="" name="email" value="<?php echo $data['email'];?>" required>
										  </div>
										</div>
										 <div class="form-group row">
										  <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
										  <div class="col-sm-10">
											<input type="text" class="form-control" id="inputEmail3" placeholder="" name="alamat" value="<?php echo $data['alamat'];?>">
										  </div>
										</div>
										<div class="form-group row">
										  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Direktur</label>
										  <div class="col-sm-5">
											 <input type="text" class="form-control" id="inputEmail3" placeholder="" name="pimpinan" value="<?php echo $data['pimpinan'];?>">
										  </div>
										</div>
										<div class="form-group row">
										  <label for="inputEmail3" class="col-sm-2 col-form-label">Jabatan</label>
										  <div class="col-sm-5">
											 <input type="text" class="form-control" id="inputEmail3" placeholder="" name="jabatan" value="<?php echo $data['jabatan'];?>">
										  </div>
										</div>
										
										<div class="form-group row">
										  <div class="col-sm-12">
										  <div class="card-action">
											 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Update Profil</button>
						 					<a href="welcome.php?modul=dashboard&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
											</div>
										  </div>
										</div>
								</div>
								</form>
							</div>
					
						 
						</div>
						
						<div class="col-md-4">
							<div class="card card-profile">
								<div class="card-header" style="background-image:url(../assets/img/bg.jpeg); no-repeat center center fixed;
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
					    background-size: cover;">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
										<?php
											if(!empty($data['logo'])){
																	echo "<a href=\"#\">
																		<img src=\"$data[logo]\" alt=\"...\" class=\"avatar-img rounded-circle\">
																		</a>";
											}else{
																	echo "<a href=\"#\">
																		<img src=\"../assets/img/placeholder-840x630.png\" alt=\"...\" class=\"avatar-img rounded-circle\">
																		</a>";
																	
											}
										?>
											
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name"><?php echo "$data[company]";?></div>
										<div class="job"><?php echo "$data[alamat]";?></div>
										<div class="social-media">
										</div>
										<div class="view-profile">
											 <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#formubah"><i class="fas fa-camera"></i> Ubah Logo</button>
										</div>
									</div>
								</div>
								
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="social-media">
										<div class="alert alert-default">
											Backup database dilakukan untuk melindungi data dari kehilangan atau kerusakan yang disebabkan oleh berbagai faktor seperti kegagalan sistem, kesalahan manusia, serangan siber, atau bencana alam. Dengan adanya backup, data yang hilang atau rusak dapat dipulihkan kembali, sehingga operasional bisnis atau sistem tetap berjalan lancar. 
										</div>
										</div>
										<div class="view-profile">
											 <?php
											 echo "<form method=\"post\" action=\"controler/beckup.php\">
															<button class=\"btn btn-default btn-block\" type=\"submit\" value=\"beckup\" name=\"beckup\">
																<i class=\"flaticon-database\"></i> Beckup Database
															</button>
													</form>";
											 ?>
										</div>
									</div>
								</div>
								
							</div>
                       
						

<?php

echo "<div class=\"modal fade\" id=\"formubah\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabelLogout\"
														aria-hidden=\"true\">
														<div class=\"modal-dialog\" role=\"document\">
														 <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
														  <div class=\"modal-content\">
															<div class=\"modal-header\">
															  <h5 class=\"modal-title\" id=\"exampleModalLabelLogout\"><i class=\"fas fa-camera\"></i> Logo</h5>
															  
															</div>
															<div class=\"modal-body\">
															<div class=\"form-group\">
																		<input name=\"file\" type=\"file\" onChange=\"readURL(this);\" id=\"inputImage\">
																	</div>
															<figure class=\"imagecheck-figure\" align=\"center\">"; 
															
															
																	if(!empty($data['logo'])){
																	echo "<a href=\"#\">
																		<img src=\"$data[logo]\" id=\"preview_gambar\" class=\"avatar-img rounded-circle\" style=\"width:100px;\" />
																		</a>";
																	
																	}else{
																	echo "<a href=\"#\">
																		<img src=\"../assets/img/placeholder-840x630.png\" id=\"preview_gambar\" class=\"avatar-img rounded-circle\" style=\"width:100px;\" />
																		</a>";
																	
																	}
													
															echo "
															</figure>	
															</div>
															<div class=\"modal-footer\" align=\"center\">
															<button type=\"submit\" name=\"ubah_logo\" value=\"ubah_logo\" class=\"btn btn-success\" >
															<i class=\"fas fa-sync\"></i> Upload Logo</button>
															<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\" ><i class=\"icon-action-undo\"></i> Kembali</button>
															</div>
														  </div>
														  </form>
														</div>
													  </div>";


?>	
           
       
            
<script type="text/javascript"><!--
google_ad_client = "ca-pub-9728127992213102";
/* Header */
google_ad_slot = "4835858335";
google_ad_width = 100;
google_ad_height = 90;
//-->
</script>
</div>
</center>
<script>
function readURL(input) { // Mulai membaca inputan gambar
if (input.files && input.files[0]) {
var reader = new FileReader(); // Membuat variabel reader untuk API FileReader

reader.onload = function (e) { // Mulai pembacaan file
$('#preview_gambar') // Tampilkan gambar yang dibaca ke area id #preview_gambar
.attr('src', e.target.result)
.width(100); // Menentukan lebar gambar preview (dalam pixel)
//.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
};

reader.readAsDataURL(input.files[0]);
}
}
</script>

<?php
 
if($_POST['simpan']){

$nama = $_POST['nama'];
$telp = $_POST['telp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$pimpinan = $_POST['pimpinan'];
$jabatan = $_POST['jabatan'];



		

				$query = mysqli_query($conn,"UPDATE ms_profil SET company = '$nama',
													   no_telp = '$telp',
													   email = '$email',
													   alamat = '$alamat',
													   pimpinan = '$pimpinan',
													   jabatan = '$jabatan'");
					
				
				if($query){
				echo "<script type=\"text/javascript\">
					  swal(\"Ok! ", "Profil Berhasil di Update!\", {
						icon : \"success\",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
								
							}
						},
					}).then(
					function() {
						window.location = \"welcome.php?modul=company&aksi=view\";
					}
					);
					</script>";
				}else{
				echo "<script type=\"text/javascript\">
								swal(\"Maaf! ", "Profil Gagal di Update\", {
								icon : \"error\",
								buttons: {        			
									confirm: {
										className : 'btn btn-danger'
										
									}
								},
							}).then(
							function() {
								window.location = \"welcome.php?modul=company&aksi=view\";
							}
							);
							</script>";
				}


}else
if($_POST['ubah_logo']){

$ekstensi_bolehfile	= array('jpg','png');
$nama_file = $_FILES['file']['name'];
$x_file = explode('.', $nama_file);
$ekstensi_file = strtolower(end($x_file));
$ukuran_file	= $_FILES['file']['size'];
$file_tmp_file = $_FILES['file']['tmp_name'];
	
$new_name_file = date('YmdHis').'_'.$nama_file; //rename file
$tempat_file = ('../assets/img/'.$new_name_file);




				$sql = mysqli_query($conn,"select * from ms_profil");
				$row = mysqli_fetch_array($sql);
				   
				   
				   if(!empty($_FILES['file']['name'])){	
						if(in_array($ekstensi_file, $ekstensi_bolehfile) === true){
						
							@unlink($row['logo']);
							move_uploaded_file($file_tmp_file, '../assets/img/'.$new_name_file);
							$logo = $tempat_file;
						
						}else{
						
							$logo = $row['logo'];
							echo "<script type=\"text/javascript\">
								swal(\"Maaf! ", "Type File Harus JPEG!\", {
								icon : \"error\",
								buttons: {        			
									confirm: {
										className : 'btn btn-danger'
										
									}
								},
							}).then(
							function() {
								window.location = \"welcome.php?modul=company&aksi=view\";
							}
							);
							</script>";
						
						}
					}else{
						$logo = $row['logo'];
					}


				$query = mysqli_query($conn,"UPDATE ms_profil SET logo = '$logo'");
					
				
				if($query){
				echo "<script type=\"text/javascript\">
					  swal(\"Ok! ", "Logo Berhasil di Update!\", {
						icon : \"success\",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
								
							}
						},
					}).then(
					function() {
						window.location = \"welcome.php?modul=company&aksi=view\";
					}
					);
					</script>";
				}else{
				echo "<script type=\"text/javascript\">
								swal(\"Maaf! ", "Logo Gagal di Update\", {
								icon : \"error\",
								buttons: {        			
									confirm: {
										className : 'btn btn-danger'
										
									}
								},
							}).then(
							function() {
								window.location = \"welcome.php?modul=company&aksi=view\";
							}
							);
							</script>";
				}

}else
/*if($_POST['beckup']){

	           
			   echo "<form action=\"controler/beckup.php\" method=\"post\" id=\"success\">
					  </form>";	
			   
			  echo "<script type=\"text/javascript\">
					  swal(\"Ok! ", "Beckup Database Berhasil!\", {
						icon : \"success\",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
								
							}
						},
					}).then(
					function() {
						window.location = \"welcome.php?modul=company&aksi=view\";
					}
					);
					</script>";
					
					
}

*/

?>
