<script>
var htmlobjek;

		
		$(document).ready(function(){
		  //apabila terjadi event onchange terhadap object <select id=propinsi>
		  
		 $("#prov").change(function(){
			var kode = $("#prov").val();
			$.ajax({
				url: "controler/controler_kabupaten.php",
				data: "kode="+kode,
				cache: false,
				success: function(msg){
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=kota>
					$("#kab").html(msg);
				}
			});
		  });
		  
		   $("#bidang").change(function(){
			var prov = $("#prov").val();
			var kab = $("#kab").val();
			var bidang = $("#bidang").val();
			$.ajax({
				url: "controler/controler_unit.php",
				data: "bidang="+bidang+"&prov="+prov+"&kab="+kab,
				cache: false,
				success: function(msg){
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=kota>
					$("#unit").html(msg);
				}
			});
		  });
		  
		  $("#unit").change(function(){
			var kode = $("#unit").val();
			$.ajax({
				url: "controler/controler_sub.php",
				data: "kode="+kode,
				cache: false,
				success: function(msg){
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=kota>
					$("#sub").html(msg);
				}
			});
		  });
		  
		  $("#sub").change(function(){
			var kode = $("#sub").val();
			$.ajax({
				url: "controler/controler_upb.php",
				data: "kode="+kode,
				cache: false,
				success: function(msg){
					//jika data sukses diambil dari server kita tampilkan
					//di <select id=kota>
					$("#upb").html(msg);
				}
			});
		  });
		  
		  
		 
		
	});
	
	
</script>
<?php
$aksi = $_GET['aksi'];
$id   = $_POST['id'];
$act   = $_POST['act'];

$baca  = mysqli_query($conn,"SELECT  * from admin where id='$id'");
$data 	   = mysqli_fetch_array($baca);



?>

         
		  
		  <?php
		  	
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
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Detail</a>
							</li>
						</ul>
					</div>";
		  
		  ?>


	
            <div class="card mb-12">
                <div class="card-header">
									<div class="card-title">Detail</div>
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
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Group Menu</label>
                      <div class="col-sm-9">
                      <select class="select21-single form-control" name="grup" id="grup" required>
                        <?php
						if($aksi == 'edit'){
							$sql  = mysqli_query($conn,"SELECT  * from admin_grup where id_grup='$data[id_grup]'");
							$row  = mysqli_fetch_array($sql);

							echo "<option value=\"$row[id_grup]\">$row[id_grup] - $row[nm_grup]</option>";
							$sql ="SELECT * FROM admin_grup ORDER BY id_grup";
							$baca = mysqli_query($conn,$sql);
							while($result = mysqli_fetch_array($baca)){
								$idx = $result['id_grup'];
								$nama = ($result['nm_grup']);
								echo "<option value=\"$idx\">$idx - $nama</option>";
												
							}
						}else{
							echo "<option value=\"\">Group Menu :</option>";
							$sql ="SELECT * FROM admin_grup ORDER BY id_grup";
							$baca = mysqli_query($conn,$sql);
							while($result = mysqli_fetch_array($baca)){
								$idx = $result['id_grup'];
								$nama = ($result['nm_grup']);
								echo "<option value=\"$idx\">$idx - $nama</option>";
												
							}
						}
						?>
                      </select>
                      </div>
					  </div>
					  
					  <div class="form-group row">
                      <legend class="col-form-label col-sm-2 pt-0"><b>Level User</b></legend>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="level" class="custom-control-input" value="1" <?php if($data['level']=='1'){echo "checked";}?>>
                            <label class="custom-control-label" for="customRadio1">Admin</label>
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
						  <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Cabang</label>
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
						  <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" placeholder="" name="username" value="<?php echo "$data[username]";?>" required>
						  </div>
						</div>
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
						  <div class="col-sm-9">
							<input type="password" class="form-control" id="inputEmail3" placeholder="" name="password" value="">
						  </div>
						</div>
					
					  
					</div>
					
				</div>
					
					
                    
                    
				
                  
					<div class="card-action">
									 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
						 <a href="welcome.php?modul=user&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
								</div>
                  </form>
                </div>
				
				
		<div class="modal fade" id="formpasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Cabang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=10>Kode</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=500>Nama Cabang</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=10>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											$baca = mysqli_query($conn,"SELECT kd_cabang AS kode,nm_cabang AS nama FROM ms_cabang ORDER BY kd_cabang");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
													echo "<tr class=\"pilih\" data-a=\"$fetchArray[kode]\" data-b=\"$fetchArray[nama]\">
															<td class=\"text-left\" style=\"font-size:12px;\">$fetchArray[kode]</td>
															<td style=\"font-size:12px;\">$fetchArray[nama]</td>
															<td style=\"font-size:12px;\"><button type=\"button\" name=\"pilih\" value=\"pilih\" 
															class=\"btn btn-icon btn-round btn-primary btn-sm\"><i class=\"icon-arrow-right-circle\"></i></button></td>
														 </tr>";
												
											
												
											   $no++;}  
											echo "</tbody>
										</table>
									</div>";
					
					
					
				?>	
                </div>
                <div class="modal-footer">
                </div>
              </div>
			  </form>
            </div>
          </div>
		  
		  
		  <div class="modal fade" id="formbidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Bidang :</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#2BB930; color:#FFFFFF\" width=500>Nama Bidang</th>
													<th class=\"text-center\" style=\"background-color:#2BB930; color:#FFFFFF\" width=10>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM tbl_bidang WHERE kd_unit='$data[kd_unit]' ORDER BY kd_bidang");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
													echo "<tr class=\"pilih_bidang\" data-a=\"$fetchArray[kd_bidang]\" data-b=\"$fetchArray[nm_bidang]\">
															<td style=\"\">$fetchArray[nm_bidang]</td>
															<td style=\"\"><button type=\"button\" name=\"pilih_bidang\" value=\"pilih_bidang\" class=\"btn btn-icon btn-round btn-success btn-sm\"><i class=\"icon-arrow-right-circle\"></i></button></td>
														 </tr>";
														 
											}
							  
											echo "</tbody>
										</table>
									</div>";
					
					
					
				?>	
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-reply"></i> Batal</button>
                </div>
              </div>
			  </form>
            </div>
          </div>
		  
		  
		  
		  <script>
		  
		  
		  //jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
			
				
				document.getElementById("kd_cabang").value = $(this).attr('data-a');
                document.getElementById("nm_cabang").value = $(this).attr('data-b');
				
				
                $('#formpasien').modal('hide');
				
            });
			
			$(document).on('click', '.pilih_bidang', function (e) {
			
				document.getElementById("kd_bidang").value = $(this).attr('data-a');
				document.getElementById("nm_bidang").value = $(this).attr('data-b');
				
                $('#formbidang').modal('hide');
				
            });
			
			
		</script>
        
           



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


$sql  = mysqli_query($conn,"SELECT  * from admin_grup where id_grup='$grup'");
$row  = mysqli_fetch_array($sql);
$ket  = $row['nm_grup'];




$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
				
				if(empty($_POST['password'])){
					$query = mysqli_query($conn,"UPDATE admin SET nm_pengguna = '$nama',
													   username = '$username',
													   id_grup = '$grup',
													   nm_grup = '$ket',
													   level = '$level',
													   no_telp = '$no_telp',
													   email = '$email',
													   kd_cabang = '$kd_cabang',
													   nm_cabang = '$nm_cabang'
													   WHERE id='$id'");
					}else{
					$query = mysqli_query($conn,"UPDATE admin SET nm_pengguna = '$nama',
													   username = '$username',
													   password = '$password',
													   id_grup = '$grup',
													   nm_grup = '$ket',
													   level = '$level',
													   no_telp = '$no_telp',
													   email = '$email',
													   kd_cabang = '$kd_cabang',
													   nm_cabang = '$nm_cabang'
													   WHERE id='$id'");
				}
				
				if($query){
				
				echo "<form action=\"welcome.php?modul=user&aksi=edit\" method=\"post\" id=\"success\">
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
				
	}else{
	
	
			$sql = mysqli_query($conn,"SELECT IFNULL(MAX(SUBSTR(id,1,5)),0) AS nom from admin");
			$tampil = mysqli_fetch_array($sql);
			$res = mysqli_num_rows($sql);
				
				if($tampil['nom'] < 1 ){
					
						$kode = "00001";
					
				}else{
				
					$urutan = (int) $tampil['nom'];
					// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
					$urutan++;
					$huruf = "";
					$nomor = sprintf("%05s", $urutan);
					
					
					$kode = $nomor;
				}
				
				$query = mysqli_query($conn,"INSERT INTO admin (id,nm_pengguna,username,password,id_grup,nm_grup,level,no_telp,email,kd_cabang,nm_cabang) 
									  VALUE('$kode','$nama','$username','$password','$grup','$ket','$level','$no_telp','$email','$kd_cabang','$nm_cabang')");
				
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
						window.location = \"welcome.php?modul=user&aksi=view&act=1\";
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



}


?>