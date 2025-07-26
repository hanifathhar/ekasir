<?php
$aksi = $_GET['aksi'];
$id   = $_POST['id'];
$skpd   = $_POST['skpd'];
$unit   = $_POST['unit'];
$act   = $_GET['act'];

$csql = mysqli_query($conn,"SELECT  *,(SELECT nm_skpd FROM skpd WHERE kd_skpd=unit.kd_skpd) as nm_skpd FROM unit where kd_unit='$unit'");
$cdata = mysqli_fetch_array($csql);

$baca  = mysqli_query($conn,"SELECT  * from ms_penerima where id='$id'");
$data 	   = mysqli_fetch_array($baca);


?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Data Penerima</h4>
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
								<a href=\"#\">OPD</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Unit</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Data Penerima</a>
							</li>
						</ul>
					</div>";
		  
		  ?>


	
            <div class="card mb-12">
			    <?php
				echo "<div class=\"card-header\">
									<div class=\"\" role=\"alert\">
										<b>$skpd - $cdata[nm_skpd]</b><br>
										<b>$unit - $cdata[nm_unit]</b>
									</div>
								</div>";
				?>
                <div class="card-body">
                  <form action="" method="post">
				  <input type="hidden" value="<?php echo "$id";?>" name="id">
				  <input type="hidden" value="<?php echo "$skpd";?>" name="skpd">
				  <input type="hidden" value="<?php echo "$cdata[nm_skpd]";?>" name="nmopd">
				  <input type="hidden" value="<?php echo "$unit";?>" name="unit">
				  <input type="hidden" value="<?php echo "$cdata[nm_unit]";?>" name="nmunit">
				  <input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
				  
				  <div class="row">
				    <div class="col-md-12 col-lg-6"> 
				  
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Penerima</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="" name="nama" value="<?php echo "$data[nama_penerima]";?>" required>
                      </div>
                    </div>
					 <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">NPWP</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="" id="npwp" name="npwp" value="<?php echo "$data[npwp]";?>">
                      </div>
                    </div>
					
					
						
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Bank</label>
						  <div class="col-sm-10">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "$data[bank_penerima]";?>" id="bank" name="bank" required>
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formjabatan" type="button" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
									</span>
								</div>
						  </div>
						</div>
						
						 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Rekening</label>
						  <div class="col-sm-10">
							 <input type="text" class="form-control" placeholder="" id="rek" name="rek" value="<?php echo "$data[rek_penerima]";?>" required>
						  </div>
						</div>
					
					  
					</div>
					
				</div>
					
					
                    
                    
				
                  
					<div class="card-action">
					<table>
					<tr>
						<td> 
						   <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></form>
						</td>
						<td>
							<?php
									 echo "<form method=\"post\" action=\"welcome.php?modul=penerima&aksi=detail\">
											  <input type=\"hidden\" value=\"$unit\" name=\"unit\">
											  <input type=\"hidden\" value=\"$skpd\" name=\"skpd\">
											  <button type=\"submit\" class=\"btn btn-danger\"><i class=\"fas fa-reply\"></i> Batal</button>
									   </form>";
									 
									 ?>
						</td>
					</tr>
					</table>
									
									 
						 
					</div>
                  
                </div>
				
				
		
		
		<div class="modal fade" id="formjabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Bank</h5>
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
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Bank</th>
												  </tr>
											</thead>
											<tbody>";
											$baca = mysqli_query($conn,"SELECT *,CONCAT(kode,' ',nama) AS nama1 FROM bank WHERE jns_rekening='BANK'");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
													
													echo "<tr class=\"pilih\" data-a=\"$fetchArray[nama1]\">
															<td style=\"font-size:12px;\">
															<div class=\"card-list\">
																<div class=\"item-list\">
																	<div class=\"info-user ml-3\">
																		<div class=\"username\">$fetchArray[kode] ".($fetchArray['nama'])."</div>
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
			
				document.getElementById("bank").value = $(this).attr('data-a');
				
				
				
                $('#formjabatan').modal('hide');
				
            });
			
	
			
			
		</script>
           



<?php

if($_POST['simpan']){


$id = $_POST['id'];
$nama = $_POST['nama'];
$npwp = $_POST['npwp'];
$bank = $_POST['bank'];
$skpd = ($_POST['skpd']);
$unit = ($_POST['unit']);
$rek = $_POST['rek'];




$aksi = $_POST['aksi'];

	if($aksi == 'edit'){
			
				
				
				$query = mysqli_query($conn,"UPDATE ms_penerima SET nama_penerima = '$nama',
													   npwp = '$npwp',
													   bank_penerima = '$bank',
													   kd_skpd = '$skpd',
													   kd_unit = '$unit',
													   rek_penerima = '$rek'
													   WHERE id='$id'");
			
				
				if($query){
				
				
				echo "<form action=\"welcome.php?modul=penerima&aksi=edit\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$skpd\" name=\"skpd\">
						  <input type=\"hidden\" value=\"$unit\" name=\"unit\">
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
				$query = mysqli_query($conn,"INSERT INTO ms_penerima (nama_penerima,bank_penerima,rek_penerima,npwp,kd_skpd,kd_unit) 
									  VALUE('$nama','$bank','$rek','$npwp','$skpd','$unit')");
				
				if($query){
				
				echo "<form action=\"welcome.php?modul=penerima&aksi=detail\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$skpd\" name=\"skpd\">
						  <input type=\"hidden\" value=\"$unit\" name=\"unit\">
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



}


?>