<?php
$aksi = $_GET['aksi'];
$id   = $_GET['id'];
$opd   = $_GET['opd'];
$unit   = $_GET['unit'];
$act   = $_GET['act'];

$csql = mysqli_query($conn,"SELECT  *,(SELECT nm_skpd FROM ms_skpd WHERE kd_skpd=ms_unit.kd_skpd) as nm_skpd FROM ms_unit where kd_unit='$unit'");
$cdata = mysqli_fetch_array($csql);

$baca  = mysqli_query($conn,"SELECT  * from ms_pegawai where id='$id'");
$data 	   = mysqli_fetch_array($baca);


?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Data Pegawai</h4>
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
								<a href=\"#\">Master Data</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Data OPD</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Data Unit</a>
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


	
            <div class="card mb-12">
			    <?php
				echo "<div class=\"card-header\">
									<div class=\"\" role=\"alert\">
										<b>$opd - $cdata[nm_skpd]</b><br>
										<b>$unit - $cdata[nm_unit]</b>
									</div>
								</div>";
				?>
                <div class="card-body">
                  <form action="" method="post">
				  <input type="hidden" value="<?php echo "$id";?>" name="id">
				  <input type="hidden" value="<?php echo "$opd";?>" name="opd">
				  <input type="hidden" value="<?php echo "$cdata[nm_skpd]";?>" name="nmopd">
				  <input type="hidden" value="<?php echo "$unit";?>" name="unit">
				  <input type="hidden" value="<?php echo "$cdata[nm_unit]";?>" name="nmunit">
				  <input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
				  
				  <div class="row">
				    <div class="col-md-12 col-lg-6"> 
				  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pegawai</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="nama" value="<?php echo "$data[nama]";?>" required>
                      </div>
                    </div>
					 <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">NIP</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="" id="nip" name="nip" value="<?php echo "$data[nip]";?>" required>
                      </div>
                    </div>
					 <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Pangkat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="pangkat" value="<?php echo "$data[pangkat]";?>" required>
                      </div>
                    </div>
					
					
					
					
					
					  
					 
					  
					
					  
					 
					
					
					</div>
					
					<div class="col-md-12 col-lg-6"> 
					
						
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Jabatan</label>
						  <div class="col-sm-10">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "$data[jabatan]";?>" id="jabatan" name="jabatan" >
								<input type="hidden" value="<?php echo "$data[kode]";?>" name="kode" id="kode">
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formjabatan" type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
									</span>
								</div>
						  </div>
						</div>
						
						 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Sebagai</label>
						  <div class="col-sm-10">
							<textarea class="form-control" id="sebagai" name="sebagai" rows="5" ><?php echo "$data[sebagai]";?></textarea>
						  </div>
						</div>
					
					  
					</div>
					
				</div>
					
					
                    
                    
				
                  
					<div class="card-action">
									 <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
						 <a href="welcome.php?modul=pegawai&aksi=detail&unit=<?php echo "$unit";?>&opd=<?php echo "$opd";?>"><button type="button" class="btn btn-danger"><i class="fas fa-reply"></i> Batal</button></a>
								</div>
                  </form>
                </div>
				
				
		
		
		<div class="modal fade" id="formjabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Jabatan</h5>
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Jabatan</th>
												  </tr>
											</thead>
											<tbody>";
											$baca = mysqli_query($conn,"SELECT * FROM ms_jabatan");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
													echo "<tr class=\"pilih\" data-a=\"$fetchArray[kode]\" data-b=\"$fetchArray[jabatan]\">
															<td style=\"font-size:12px;\">
															<div class=\"card-list\">
																<div class=\"item-list\">
																	<div class=\"info-user ml-3\">
																		<div class=\"username\">$fetchArray[kode] - ".($fetchArray['jabatan'])."</div>
																	</div>
																	<button type=\"button\" name=\"pilih\" value=\"pilih\" class=\"btn btn-icon btn-primary btn-round btn-xs\">
																		<i class=\"fas fa-arrow-alt-circle-up\"></i>
																	</button>
																</div>
																</div>
															</td>
														 </tr>";
											
											
												
											   $no++;}  
											echo "</tbody>
										</table>
									</div>";
					
					
					
				?>	
                </div>
                <div class="modal-footer">&nbsp;
                </div>
              </div>
			  </form>
            </div>
          </div>
		  
		   <script>
		  
		  
		  //jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
			
				document.getElementById("kode").value = $(this).attr('data-a');
				document.getElementById("jabatan").value = $(this).attr('data-b');
				
				
				
                $('#formjabatan').modal('hide');
				
            });
			
	
			
			
		</script>
           



<?php

if($_POST['simpan']){


$id = $_POST['id'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$pangkat = $_POST['pangkat'];
$sebagai = $_POST['sebagai'];

$kode = $_POST['kode'];
$jabatan = $_POST['jabatan'];
$opd = ($_POST['opd']);
$nmopd = $_POST['nmopd'];
$unit = ($_POST['unit']);
$nmunit = $_POST['nmunit'];




$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
				
				
				$query = mysqli_query($conn,"UPDATE ms_pegawai SET nama = '$nama',
													   nip = '$nip',
													   pangkat = '$pangkat',
													   sebagai = '$sebagai',
													   kode    = '$kode',
													   jabatan = '$jabatan',
													   kd_skpd = '$opd',
													   nm_skpd = '$nmopd',
													   kd_unit = '$unit',
													   nm_unit = '$nmunit'
													   WHERE id='$id'");
			
				
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
						window.history.go(-1);
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
				$query = mysqli_query($conn,"INSERT INTO ms_pegawai (nama,nip,pangkat,sebagai,kode,jabatan,kd_skpd,nm_skpd,kd_unit,nm_unit) 
									  VALUE('$nama','$nip','$pangkat','$sebagai','$kode','$jabatan','$opd','$nmopd','$unit','$nmunit')");
				
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
						window.location = \"welcome.php?modul=pegawai&aksi=detail&unit=$unit&opd=$opd\";
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