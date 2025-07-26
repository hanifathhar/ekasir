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

$baca  = mysqli_query($conn,"SELECT  *,(select nm_kategori from ms_kategori where kd_kategori=tbl_barang.kd_kategori) as nm_kategori from tbl_barang where kd_barang='$id'");
$data 	   = mysqli_fetch_array($baca);

if($aksi=='edit'){

	$kode = $data['kd_barang'];

}else{


$sql = mysqli_query($conn,"SELECT  IFNULL(MAX(SUBSTR(kd_barang,1,6)),0) AS nom from tbl_barang");
$tampil = mysqli_fetch_array($sql);
$res = mysqli_num_rows($sql);
	
	if($tampil['nom'] < 1 ){
		
		
			$kode = "000001";
		
		
	}else{
	
		$urutan = (int) $tampil['nom'];
	 
		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;
		
		//$huruf = "";
		$nomor = sprintf("%06s", $urutan);
		
		
		$kode = $nomor;
	}

}
?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Barang</h4>
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
								<a href=\"#\">Barang</a>
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
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Kode</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="kode" value="<?php echo "$kode";?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="nama" value="<?php echo "$data[nm_barang]";?>" required>
                      </div>
                    </div>
					 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
						  <div class="col-sm-9">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "$data[nm_kategori]";?>" id="nm_kategori" name="nm_kategori"  readonly 
								style="border:1px solid #aaa;border-radius:1px;" >
								<input type="hidden" class="form-control" placeholder="" value="<?php echo "$data[kd_kategori]";?>" id="kd_kategori" name="kd_kategori"  readonly >
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formkategori" type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
									</span>
								</div>
						  </div>
					      </div>
					<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Satuan</label>
						  <div class="col-sm-9">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "$data[satuan]";?>" id="satuan" name="satuan"  readonly 
								style="border:1px solid #aaa;border-radius:1px;" >
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formsatuan" type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
									</span>
								</div>
						  </div>
					      </div>
					
					
					
					
					
					
					
					</div>
					
					<div class="col-md-12 col-lg-6"> 
					
				
				
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Beli</label>
						  <div class="col-sm-5">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								<input type="number" class="form-control" placeholder="" value="<?php echo $data['harga_beli'];?>" id="harga_beli" name="harga_beli" style="text-align:right;" >
								</div>
						  </div>
					    </div>
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Jual</label>
						  <div class="col-sm-5">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								<input type="number" class="form-control" placeholder="" value="<?php echo $data['harga_jual'];?>" id="harga_jual" name="harga_jual" style="text-align:right;" >
								</div>
						  </div>
					    </div>
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Stock</label>
						  <div class="col-sm-5">
							<div class="input-icon">
								<input type="number" class="form-control" placeholder="" value="<?php echo $data['stock'];?>" id="stock" name="stock" readonly style="text-align:right;" >
								</div>
						  </div>
					    </div>
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Terjual</label>
						  <div class="col-sm-5">
							<div class="input-icon">
								<input type="number" class="form-control" placeholder="" value="<?php echo $data['terjual'];?>" id="terjual" name="terjual" readonly style="text-align:right;" >
								</div>
						  </div>
					    </div>
						
					
					  
					</div>
					
				</div>
					
					
                    
                    
				
                  
					<div class="card-action">
									 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
						 <a href="welcome.php?modul=barang&aksi=view"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
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
										<table id=\"basic-datatables_new\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF;\" width=>Kategori Barang</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM ms_kategori ORDER BY kd_kategori");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
										      echo "<tr class=\"kategori\" data-a=\"$fetchArray[kd_kategori]\" data-b=\"$fetchArray[nm_kategori]\">
														<td style=\"\">
														<div class=\"card-list\">
														  <div class=\"item-list\">
														  	<div class=\"info-user ml-2\">
																<div class=\"username\"><b>".strtoupper($fetchArray['nm_kategori'])."</b></div>
															</div>
															<button type=\"button\" name=\"kategori\" value=\"kategori\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
														     <i class=\"fas fa-plus\"></i></button>
														  </div>
														 </div>
														</td>
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
										<table id=\"basic-datatables_new1\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\" >
											<thead>
												 <tr>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF;\" width=><b>Daftar Satuan</b></th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM ms_satuan ORDER BY satuan");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
										      echo "<tr class=\"satuan\" data-a=\"$fetchArray[satuan]\">
														<td style=\"\">
														<div class=\"card-list\">
														  <div class=\"item-list\">
														  	<div class=\"info-user ml-2\">
																<div class=\"username\"><b>".strtoupper($fetchArray['satuan'])."</b></div>
															</div>
															<button type=\"button\" name=\"satuan\" value=\"satuan\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
														     <i class=\"fas fa-plus\"></i></button>
														  </div>
														 </div>
														</td>
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
$kode = htmlspecialchars($_POST['kode'], ENT_QUOTES);
$kd_kategori = htmlspecialchars($_POST['kd_kategori'], ENT_QUOTES);
$satuan = htmlspecialchars($_POST['satuan'], ENT_QUOTES);
$harga_beli = htmlspecialchars($_POST['harga_beli'], ENT_QUOTES);
$harga_jual = htmlspecialchars($_POST['harga_jual'], ENT_QUOTES);
$stock = htmlspecialchars($_POST['stock'], ENT_QUOTES);
$terjual = htmlspecialchars($_POST['terjual'], ENT_QUOTES);




$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
				
				$query = mysqli_query($conn,"UPDATE tbl_barang SET nm_barang = '$nama',
													   kd_kategori = '$kd_kategori',
													   satuan = '$satuan',
													   harga_beli = '$harga_beli',
													   harga_jual = '$harga_jual',
													   stock = '$stock',
													   terjual = '$terjual'
													   WHERE kd_barang='$id'");
					
				if($query){
				
				echo "<form action=\"welcome.php?modul=barang&aksi=edit\" method=\"post\" id=\"success\">
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
				$query = mysqli_query($conn,"INSERT INTO tbl_barang (kd_barang,nm_barang,kd_kategori,satuan,harga_beli,harga_jual,stock,terjual) 
									  VALUE('$kode','$nama','$kd_kategori','$satuan','$harga_beli','$harga_jual','$stock','$terjual')");
				
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
						window.location = \"welcome.php?modul=barang&aksi=view&act=1\";
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