<?php
$id   = $_SESSION['id'];
$act   = $_GET['act'];

$baca  = mysqli_query($conn,"SELECT  * from admin where id='$id'");
$data 	   = mysqli_fetch_array($baca);


echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Ubah Password</h4>
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
								<a href=\"#\">Home</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Ubah Password</a>
							</li>
						</ul>
					</div>";

?>



	
            <div class="card mb-4">
               <div class="card-header" style="background-image:url(../assets/img/bg.jpeg); no-repeat center center fixed;
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
					    background-size: cover;">
									<div class="card-title" style="color:#FFFFFF;">Ubah Password</div>
								</div>
                <div class="card-body">
                  <form action="" method="post">
				  <input type="hidden" value="<?php echo "$id";?>" name="id">
				  <input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
                  
					<div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-3">
                        <input type="password" class="form-control" id="inputPassword3" name="password" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-3">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="" name="confirm">
                      </div>
                    </div>
					
					<div class="card-action">
									 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Ubah Password</button>
						 <a href="welcome.php?modul=dashboard&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
								</div>
                    
                   
                    
                  </form>
                </div>
          



<?php

if($_POST['simpan']){


$id = $_POST['id'];

$password = md5($_POST['password']);
$confirm = md5($_POST['confirm']);

	if($password != $confirm){
	
		echo "<script type=\"text/javascript\">
							swal(\"Maaf! ", "Confim Password Salah\", {
							icon : \"error\",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
									
								}
							},
						}).then(
						function() {
							window.location = \"welcome.php?modul=ubahpassword&aksi=view\";
						}
						);
						</script>";
					
	}else{
			
				
			
			    $query = mysqli_query($conn,"UPDATE admin SET password = '$password' WHERE id='$id'");
					
				
				if($query){
				echo "<script type=\"text/javascript\">
						  swal(\"Ok! ", "Password Berhasil di Ubah!\", {
							icon : \"success\",
							buttons: {        			
								confirm: {
									className : 'btn btn-success'
									
								}
							},
						}).then(
						function() {
							window.location = \"welcome.php?modul=ubahpassword&aksi=view\";
						}
						);
						</script>";
				}else{
				echo "<script type=\"text/javascript\">
							swal(\"Maaf! ", "Password Gagal di Rubah\", {
							icon : \"error\",
							buttons: {        			
								confirm: {
									className : 'btn btn-danger'
									
								}
							},
						}).then(
						function() {
							window.location = \"welcome.php?modul=ubahpassword&aksi=view\";
						}
						);
						</script>";
				}
				
	}



}


?>