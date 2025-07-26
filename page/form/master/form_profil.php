<?php

$id   = $_SESSION['id'];
$baca  = mysqli_query($conn,"SELECT  a.*,b.nm_grup from admin a left join admin_grup b on a.id_grup=b.id_grup where id='$id'");
$data 	   = mysqli_fetch_array($baca);


echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Profil</h4>
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
								<a href=\"#\">Profil</a>
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
									<div class="card-title" style="color:#FFFFFF;">Detail Pengguna</div>
								</div>
                <div class="card-body">
                  <form action="" method="post">
				  <input type="hidden" value="<?php echo "$id";?>" name="id">
				  <input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
                     <div class="row">
				    <div class="col-md-12 col-lg-6"> 
				  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pengguna</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="nama" value="<?php echo "$data[nm_pengguna]";?>" required>
                      </div>
                    </div>
					 <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">No. Telp</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="no_telp" value="<?php echo "$data[no_telp]";?>" >
                      </div>
                    </div>
					 <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">E-Mail</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="email" value="<?php echo "$data[email]";?>" >
                      </div>
                    </div>
					
					
					
					
					
					  
					  <div class="form-group row">
                      <legend class="col-form-label col-sm-2 pt-0"><b>Level</b></legend>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="level" class="custom-control-input" value="1" <?php if($data['level']=='1'){echo "checked";}?>>
                            <label class="custom-control-label" for="customRadio1">Super Admin</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="level" class="custom-control-input" value="2" <?php if($data['level']=='2'){echo "checked";}?>>
                            <label class="custom-control-label" for="customRadio2">Operator</label>
                          </div>
                        </div>
                    </div>
					  
					
					  
					 
					
					
					</div>
					
					<div class="col-md-12 col-lg-6"> 
					
					
					    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Group Menu</label>
                      <div class="col-sm-9">
                      <select class="select21-single form-control" name="grup" id="grup" required>
                        <?php
							$sql  = mysqli_query($conn,"SELECT  * from admin_grup where id_grup='$data[id_grup]'");
							$row  = mysqli_fetch_array($sql);

							echo "<option value=\"$row[id_grup]\">$row[id_grup] - $row[nm_grup]</option>";
							
						?>
                      </select>
                      </div>
					  </div>
					    <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Cabang</label>
						  <div class="col-sm-9">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "$data[nm_cabang]";?>" id="nm_cabang" name="nm_cabang"  readonly 
								style="border:1px solid #aaa;border-radius:1px;" >
								<input type="hidden" class="form-control" placeholder="" value="<?php echo "$data[kd_cabang]";?>" id="kd_cabang" name="kd_cabang"  readonly >
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formpasien" type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
									</span>
								</div>
						  </div>
					</div>
					
					
						 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" placeholder="" name="username" value="<?php echo "$data[username]";?>" required>
						  </div>
						</div>
						
					
					  
					</div>
				</div>
					<div class="card-action">
									 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Update Profil</button>
						 <a href="welcome.php?modul=dashboard&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
				</div>
                  </form>
                </div>
				
				
<?php
if($_POST['simpan']){

 
$id = $_POST['id'];
$nama = $_POST['nama'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];

$username = $_POST['username'];
$password = md5($_POST['password']);

$grup = $_POST['grup'];
$level = $_POST['level'];

$kd_cabang = $_POST['kd_cabang'];
$nm_cabang = $_POST['nm_cabang'];

			
			   $query = mysqli_query($conn,"UPDATE admin SET nm_pengguna = '$nama',
													   username = '$username',
													   no_telp = '$no_telp',
													   email = '$email',
													   kd_cabang = '$kd_cabang',
													   nm_cabang = '$nm_cabang'
													   WHERE id='$id'");
					
				
				if($query){
				
				echo "<form action=\"welcome.php?modul=profil&aksi=view\" method=\"post\" id=\"success\">
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
						document.getElementById('success').submit();
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
						window.history.go(-1);
					}
					);
					</script>";
				}
				
}
           



