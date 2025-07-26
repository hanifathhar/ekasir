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
		  
		  
		 
		
	});
	
	
</script>
<?php
$aksi = htmlspecialchars($_GET['aksi'], ENT_QUOTES);
$id   = htmlspecialchars($_POST['id'], ENT_QUOTES);

$baca  = mysqli_query($conn,"SELECT  * from tbl_member where id_member='$id'");
$data 	   = mysqli_fetch_array($baca);

?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Member</h4>
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
								<a href=\"#\">Master</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Member</a>
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
				    <div class="col-md-12 col-lg-5"> 
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Member</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="nama" value="<?php echo "$data[nm_member]";?>" required>
                      </div>
                    </div>
					<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
						  <div class="col-sm-9">
							<input type="date" class="form-control" id="inputEmail3" name="tgl" value="<?php echo $data['tgl_lahir'];?>" required>
						  </div>
						</div>
					    <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">NIK</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" style="text-align:left;" name="nik" value="<?php echo $data['nik'];?>" required>
						  </div>
						</div>
					<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">No. Telp</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" style="text-align:left;" name="no_telp" value="<?php echo $data['no_telp'];?>" required>
						  </div>
						</div>
					
					
					
					
					
					
					</div>
					
					<div class="col-md-12 col-lg-6"> 
					
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" style="text-align:left;" name="email" value="<?php echo $data['email'];?>" required>
						  </div>
						</div>
					
						 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" style="text-align:left;" name="alamat" value="<?php echo $data['alamat'];?>" required>
						  </div>
						</div>
						
						 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Kota</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" id="inputEmail3" style="text-align:left;" name="kota" value="<?php echo $data['kota'];?>" required>
						  </div>
						</div>
					
					  
					</div>
					
				</div>
					
					
                    
                    
				
                  
					<div class="card-action">
									 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
						 <a href="welcome.php?modul=member&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
								</div>
                  </form>
                </div>
				
				
		
		  
		  
		  <div class="modal fade" id="formkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#003399; color:#FFFFFF;">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Kategori :</h5>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables_new\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=500>Nama Kategori</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=10>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM ms_kategori ORDER BY kd_kategori");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
										      echo "<tr class=\"kategori\" data-a=\"$fetchArray[kd_kategori]\" data-b=\"$fetchArray[nm_kategori]\">
														<td style=\"\">$fetchArray[nm_kategori]</td>
														<td style=\"\"><button type=\"button\" name=\"kategori\" value=\"kategori\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
														<i class=\"icon-arrow-right-circle\"></i></button></td>
												   </tr>";
														 
											}
							  
											echo "</tbody>
										</table>
									</div>";

					
				?>	
                </div>
               
              </div>
			  </form>
            </div>
          </div>
		  
		  
		  <div class="modal fade" id="formsatuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#003399; color:#FFFFFF;">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Satuan Barang :</h5>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables_new1\" class=\"display table table-striped table-hover\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=500>Nama Satuan</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=10>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM ms_satuan ORDER BY satuan");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
										      echo "<tr class=\"satuan\" data-a=\"$fetchArray[satuan]\">
														<td style=\"\">$fetchArray[satuan]</td>
														<td style=\"\"><button type=\"button\" name=\"satuan\" value=\"satuan\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
														<i class=\"icon-arrow-right-circle\"></i></button></td>
												   </tr>";
														 
											}
							  
											echo "</tbody>
										</table>
									</div>";

					
				?>	
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
			
			$(document).on('click', '.kategori', function (e) {
			
				document.getElementById("kd_kategori").value = $(this).attr('data-a');
				document.getElementById("nm_kategori").value = $(this).attr('data-b');
				
                $('#formkategori').modal('hide');
				
            });
			
			$(document).on('click', '.satuan', function (e) {
			
				document.getElementById("satuan").value = $(this).attr('data-a');
				
                $('#formsatuan').modal('hide');
				
            });
			
			
		</script>
        
           



<?php

if($_POST['simpan']){


$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
$nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
$tgl = htmlspecialchars($_POST['tgl'], ENT_QUOTES);
$nik = htmlspecialchars($_POST['nik'], ENT_QUOTES);
$no_telp = htmlspecialchars($_POST['no_telp'], ENT_QUOTES);
$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
$alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
$kota = htmlspecialchars($_POST['kota'], ENT_QUOTES);




$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
				
				$query = mysqli_query($conn,"UPDATE tbl_member SET nm_member = '$nama',
													   tgl_lahir = '$tgl',
													   nik = '$nik',
													   no_telp = '$no_telp',
													   email = '$email',
													   alamat = '$alamat',
													   kota = '$kota'
													   WHERE id_member='$id'");
					
				if($query){
				
				echo "<form action=\"welcome.php?modul=member&aksi=edit\" method=\"post\" id=\"success\">
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
				$query = mysqli_query($conn,"INSERT INTO tbl_member (nm_member,tgl_lahir,nik,no_telp,email,alamat,kota) 
									  VALUE('$nama','$tgl','$nik','$no_telp','$email','$alamat','$kota')");
				
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
						window.location = \"welcome.php?modul=member&aksi=view&act=1\";
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