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
<script>
	function hasil() {
	
		  var a = document.getElementById('total').value;
		  var b = document.getElementById('diskon').value;
		  //var c = document.getElementById('voucher').value;
		  var d = document.getElementById('pajak').value;
		  var e = document.getElementById('ogkir').value;
		  
		  
		  var diskon = parseInt(a)*parseInt(b)/100;
		  var pajak = parseInt(a)*parseInt(d)/100;
		  
		  var result = (parseInt(a)+parseInt(e)+parseInt(pajak))-(parseInt(diskon));
		  
		  var format = result.toString().split('').reverse().join('');
		  var convert = format.match(/\d{1,3}/g);
		  var rupiah = convert.join('.').split('').reverse().join('')
	
		  if (!isNaN(result)) {
			 document.getElementById('grandtotalx').value =rupiah;
			 document.getElementById('grandtotal').value =result;
		  }
	}
	
	
	
</script>
<?php

$user = $_SESSION['id'];
$aksi = $_GET['aksi'];
$id = $_POST['id'];


if($aksi=='edit'){

$sql = mysqli_query($conn,"SELECT  * from tbl_retur_pembelian where no_transaksi='$id'");
$tampil = mysqli_fetch_array($sql);
$kode = $tampil['no_transaksi'];

}else{

$sql = mysqli_query($conn,"SELECT  IFNULL(MAX(SUBSTR(no_transaksi,16,6)),0) AS nom from tbl_retur_pembelian where user='$user'");
$tampil = mysqli_fetch_array($sql);
$res = mysqli_num_rows($sql);
	
	if($tampil['nom'] < 1 ){
		
		
			$kode = "RB".$user."".date('Ymd')."000001";
		
		
	}else{
	
		$urutan = (int) $tampil['nom'];
	 
		// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
		$urutan++;
		
		$huruf = "RB".$user."".date('Ymd');
		$nomor = $huruf."".sprintf("%06s", $urutan);
		
		
		$kode = $nomor;
	}

}
?>

         
		  
		  <?php
		  	
			echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Retur Pembelian</h4>
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
								<a href=\"#\">Transaksi</a>
							</li>
							<li class=\"separator\">
								<i class=\"flaticon-right-arrow\"></i>
							</li>
							<li class=\"nav-item\">
								<a href=\"#\">Retur Pembelian</a>
							</li>
						</ul>
					</div>";
		  
		  ?>

			
	
            <div class="card mb-12">
                <div class="card-header">
									<div class="card-title"></div>
								</div>
                <div class="card-body">
                  
				  
				  <div class="row">
				    <div class="col-md-12 col-lg-5" > 
					<form action="" method="post">
					  <input type="hidden" value="<?php echo "$kode";?>" name="id">
					  <input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
					  <input type="hidden" value="<?php echo "$data[kd_kategori]";?>" name="kd_kategori" id="kd_kategori">
	
	
					<div style="border:1.7px solid #aaa;border-radius:8px;padding:12px; background-color:#FFFF99;no-repeat center center fixed;
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
					    background-size: cover;"">
					 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-3 col-form-label"><b>Nama Barang</b></label>
						  <div class="col-sm-8">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "$data[nm_barang]";?>" id="nm_barang" name="nm_barang"  readonly 
								style="border:1px solid #aaa;border-radius:1px; color:#000000;" >
								<input type="hidden" class="form-control" placeholder="" value="<?php echo "$data[kd_barang]";?>" id="kd_barang" name="kd_barang"  readonly >
								<input type="hidden" class="form-control" placeholder="" value="" id="stock" name="stock"  readonly >
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formbarang" type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i> cari</button>
									</span>
								</div>
						  </div>
					  </div>
					  
					   <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-3 col-form-label"><b>Satuan</b></label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="satuan" style="text-align:left; color:#000000;" name="satuan" value="<?php echo $data['satuan'];?>" required readonly>
						  </div>
						</div>
						
						
						
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-3 col-form-label"><b>Harga</b></label>
						  <div class="col-sm-8">
							<div class="input-icon">
							<span class="input-icon-addon">Rp</span>
								<input type="text" class="form-control" id="hargax" style="text-align:right; color:#000000;" name="hargax" value="" required readonly>
							    <input type="hidden" class="form-control" id="harga" style="text-align:right;" name="harga" value="<?php echo $data['harga'];?>" required readonly>
								</div>
						  </div>
					  </div>
					    
						<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-3 col-form-label"><b>Jumlah</b></label>
						  <div class="col-sm-8">
							<input type="number" class="form-control" id="inputEmail3" style="text-align:left; color:#000000;" name="jumlah" value="<?php echo $data['jumlah'];?>" required>
						  </div>
						</div>
						
						
						<div class="form-group row" style="text-align:right">
						 <div class="col-sm-11">
									 <button type="submit" name="tambah" value="tambah" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Tambah Barang</button>
								</div>
						</div>
					 </div>
					 
					 <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-3 col-form-label">&nbsp;</label>
						  <div class="col-sm-8">
						  </div>
						</div>
					
					
					
					</form>
					
					</div>
					
					<div class="col-md-12 col-lg-7"> 
					
					<div style="border:1.7px solid #aaa;border-radius:8px;padding:12px; background-color:#FFFF99;no-repeat center center fixed;
						-webkit-background-size: cover;
						-moz-background-size: cover;
						-o-background-size: cover;
					    background-size: cover;"">
						
						<div class="form-group row">
						  <div class="col-sm-12">
						<?php
						echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\">
											<thead>
												  <tr>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\">Nama Barang</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Qty</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Satuan</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Harga</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5>Sub Total</th>
													<th class=\"text-center\" style=\"background-color:#000033; color:#FFFFFF\" width=5></th>
												  </tr>
											</thead>
											<tbody>";
											$baca = mysqli_query($conn,"SELECT  * FROM tbl_retur_pembelian_det where no_transaksi='$kode' ORDER BY id");
											$no = 1;	
											while($fetchArray = mysqli_fetch_array($baca)){
											 
											echo "<tr>
													<td class=\"text-center\">$no</td>
													<td>
													<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".($fetchArray['nm_barang'])."</b></div>
																<div class=\"status\">$fetchArray[kd_barang]</div>
															</div>
														</div>
														</div>													
													</td>
													<td class=\"text-center\">$fetchArray[jumlah]</td>
													<td class=\"text-center\">$fetchArray[satuan]</td>
													<td class=\"text-right\">".number_format($fetchArray['harga'])."</td>
													<td class=\"text-right\">".number_format($fetchArray['total'])."</td>
													<td class=\"text-center\">
													<div class=\"card-list\">
														<div class=\"item-list\">
															<form method=\"post\" action=\"\">
															<input type=\"hidden\" value=\"$fetchArray[id]\" name=\"id\">
															<input type=\"hidden\" value=\"$fetchArray[no_transaksi]\" name=\"faktur\">
															<input type=\"hidden\" value=\"$aksi\" name=\"aksi\">
															<button class=\"btn btn-icon btn-danger btn-round btn-xs\" type=\"submit\" value=\"hapus\" name=\"hapus\" 
															onClick=\"return confirm('Apakah Anda Yakin, ingin menghapus data ini?')\">
																<i class=\"fas fa-trash\"></i>
															</button>
															</form>
														</div>
														</div>		
													</td>
												  </tr>";
												  
											  $total = $total+$fetchArray['total'];
											  $no++;}  
						
						
						echo "</tbody>
							   </table>
							   </div>
						      </div>";
						?>
						</div>
					    </div>
						
						<div class="form-group row" >
						  <label for="inputEmail3" class="col-sm-5 col-form-label">
						  <input type="text" class="form-control" placeholder="" value="TOTAL"
							style="border:0px solid #aaa;border-radius:0px;padding:18px;color:#000000;font-size:30px;box-shadow:0px 0px 0px #aaa; text-align:right;"/>
						  </label>
						  <label for="inputEmail3" class="col-sm-7 col-form-label">
						  <div class="input-icon">
							<span class="input-icon-addon" style="border-radius:0px;padding:18px;background:#000033;color:#FFFFFF;font-size:30px;box-shadow:0px 0px 0px #aaa;"/>
									 Rp
							</span>
							<input type="hidden" class="form-control" placeholder="" value="<?php echo "$total_hpp";?>" id="total_hpp" name="total_hpp" readonly />
							<input type="hidden" class="form-control" placeholder="" value="<?php echo "$total";?>" id="total" name="total" readonly
							style="background:#000000;border:1.7px solid #aaa;border-radius:0px;padding:18px;color:#000000;font-size:18px;box-shadow:0px 0px 0px #aaa;"/>
							<input type="text" class="form-control" placeholder="" value="<?php echo number_format($total);?>" id="totalx" name="totalx"
							style="background:#000033;border:1.7px solid #aaa;border-radius:0px;padding:18px;color:#FFFFFF;font-size:30px;box-shadow:0px 0px 0px #aaa; text-align:right;"/>
							</div>
						  </label>
						</div>
						
					
					  
					</div>
					
				</div>
					
					
                    
                    
				
                  
				<div class="card-action" align="right">
					<?php
					$res = mysqli_num_rows($baca);
					if($res < 1 ){
						echo "<button data-toggle=\"modal\" data-target=\"#\" type=\"button\" class=\"btn btn-primary\" disabled=\"disabled\"><i class=\"fas fa-times-circle\"></i> Belum Ada Transaksi</button>&nbsp;";
						echo "<a href=\"welcome.php?modul=returpembelian&aksi=view\"><button type=\"button\" class=\"btn btn-danger\"><i class=\"fas fa-reply\"></i> Kembali</button></a>";
					}else{
						echo "<button data-toggle=\"modal\" data-target=\"#formbayar\" type=\"button\" class=\"btn btn-primary\"><i class=\"fas fa-save\"></i> Transaksi Selesai</button>&nbsp;";
						if($aksi=='edit'){
						     echo "<a href=\"welcome.php?modul=returpembelian&aksi=view\"><button type=\"button\" class=\"btn btn-danger\"><i class=\"fas fa-reply\"></i> Kembali</button></a>";
						}else{
						     echo "<button data-toggle=\"modal\" data-target=\"#formbayar\" type=\"button\" class=\"btn btn-danger\"><i class=\"fas fa-reply\"></i> Kembali</button></a>";
						}
					}
					?>
					 
				</div>
             
                </div>
				
				
		
		  
		  
		  <div class="modal fade" id="formbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#003399; color:#FFFFFF;">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Pilih Barang :</h5>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables_new\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\">
											<thead>
												 <tr>
												    <th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=10>Kode</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=500>Nama Barang</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=50>Harga</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=50>Stock</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=10>Aksi</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT *,IFNULL((stock-terjual),0) as saldo FROM tbl_barang ORDER BY kd_barang");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
												
											  $stock = 	$fetchArray['saldo'];
											  if($stock < 1){												
												  echo "<tr class=\"\" data-a=\"$fetchArray[kd_barang]\" data-b=\"$fetchArray[nm_barang]\"
															data-c=\"$fetchArray[satuan]\"
															data-d=\"$fetchArray[kd_kategori]\"
															data-e=\"$fetchArray[harga_jual]\"
															data-f=\"".number_format($fetchArray['harga_jual'])."\" style=\"color:#FF0000;\">
															<td style=\"\">$fetchArray[kd_barang]</td>
															<td style=\"\">$fetchArray[nm_barang]</td>
															<td class=\"text-right\">".number_format($fetchArray['harga_jual'])."</td>
															<td class=\"text-right\">".number_format($fetchArray['saldo'])."</td>
															<td style=\"\"><button type=\"button\" name=\"\" value=\"\" class=\"btn btn-icon btn-round btn-danger btn-sm\">
															<i class=\"fas fa-times-circle\"></i></button></td>
													   </tr>";
											  }else{
												  echo "<tr class=\"barang\" data-a=\"$fetchArray[kd_barang]\" data-b=\"$fetchArray[nm_barang]\"
															data-c=\"$fetchArray[satuan]\"
															data-d=\"$fetchArray[kd_kategori]\"
															data-e=\"$fetchArray[harga_jual]\"
															data-f=\"".number_format($fetchArray['harga_jual'])."\"
															data-g=\"$fetchArray[saldo]\">
															<td style=\"\">$fetchArray[kd_barang]</td>
															<td style=\"\">$fetchArray[nm_barang]</td>
															<td class=\"text-right\">".number_format($fetchArray['harga_jual'])."</td>
															<td class=\"text-right\">".number_format($fetchArray['saldo'])."</td>
															<td style=\"\"><button type=\"button\" name=\"barang\" value=\"barang\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
															<i class=\"fas fa-plus\"></i></button></td>
													   </tr>";
											  }
											$no++;			 
											}
							  
											echo "</tbody>
										</table>
									</div>";

					
				?>	
                </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-reply"></i> Batal</button>
                </div>
              </div>
			  </form>
            </div>
          </div>
		  
		  
		  <div class="modal fade" id="formbayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
			<form action="" method="post">
			<input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
			<input type="hidden" value="<?php echo "$aksi";?>" name="aksi">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#003399; color:#FFFFFF;">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas fa-check"></i> Konfirmasi Retur Pembelian :</h5>
                </div>
                <div class="modal-body">
				<div class="row">
                <div class="col-md-12 col-lg-6" > 
					<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Admin</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="kasir" style="text-align:left;" name="kasir" value="<?php echo $_SESSION['nama'];?>" readonly >
						  </div>
					  </div>
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">No. Retur</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="no_transaksi" style="text-align:left;" name="no_transaksi" value="<?php echo $kode;?>" readonly >
						  </div>
					  </div>
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Faktur Pembelian</label>
						  <div class="col-sm-8">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo " $data[faktur]";?>" id="faktur" name="faktur">
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formpembelian" type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i> cari</button>
									</span>
								</div>
						  </div>
					  </div>
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal</label>
						  <div class="col-sm-8">
							<input type="date" class="form-control" id="tgl" style="text-align:left;" name="tgl" value="<?php echo date('Y-m-d');?>" required >
						  </div>
					  </div>
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Supplier</label>
						  <div class="col-sm-8">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="" value="<?php echo "";?>" id="nm_supplier" name="nm_supplier">
								<input type="hidden" class="form-control" placeholder="" value="<?php echo "";?>" id="id_supplier" name="id_supplier"  readonly >
									<span class="input-icon-addon">
									 <button data-toggle="modal" data-target="#formsupplier" type="button" class="btn btn-default btn-sm"><i class="fa fa-search"></i> cari</button>
									</span>
								</div>
						  </div>
					  </div>
					   <div class="form-group row">
                       <legend class="col-form-label col-sm-4 pt-0"><b>Pembayaran</b></legend>
                        <div class="col-sm-8">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="pembayaran" class="custom-control-input" value="1" required onchange="toggleTextField('1')">
                            <label class="custom-control-label" for="customRadio1">Tunai</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="pembayaran" class="custom-control-input" value="2" required onchange="toggleTextField('2')">
                            <label class="custom-control-label" for="customRadio2">Kredit</label>
                          </div>
                        </div>
                    </div>
					
					<div class="form-group row">
						 <label for="inputEmail3" class="col-sm-12 col-form-label" style="background-color:#CCCCCC;">Pengiriman</label>
					</div>
					
					<div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Exspedisi</label>
                      <div class="col-sm-8">
                      <select class="select21-single form-control" name="exspedisi" id="exspedisi">
                        <?php
							echo "<option value=\"\">Exspedisi :</option>";
							$sql ="SELECT * FROM ms_exspedisi";
							$baca = mysqli_query($conn,$sql);
							while($result = mysqli_fetch_array($baca)){
								$nama = ($result['expedisi']);
								echo "<option value=\"$nama\">$nama</option>";
												
							}
					
						?>
                      </select>
                      </div>
					  </div>
					
					<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Ongkir</label>
						  <div class="col-sm-8">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								<input type="number" class="form-control" placeholder="" value="<?php echo "0";?>" id="ogkir" name="ogkir" style="text-align:right;" onchange="hasil()" >
								</div>
						  </div>
					  </div>
					  
					  
				</div>
				
				<div class="col-md-12 col-lg-6" > 
					
					<div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Total</label>
						  <div class="col-sm-8">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								       <input type="text" class="form-control" placeholder="" value="<?php echo number_format($total);?>" id="totalx" name="totalx" style="text-align:right;" readonly >
								</div>
						  </div>
					  </div>
					  <input type="hidden" class="form-control" placeholder="" value="<?php echo "$total";?>" id="total" name="total" style="text-align:right;" readonly >
					  <!--
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Voucher</label>
						  <div class="col-sm-8">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								<input type="number" class="form-control" placeholder="" value="<?php echo "0";?>" id="voucher" name="voucher" style="text-align:right;" >
								</div>
						  </div>
					  </div>
					  -->
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Diskon</label>
						  <div class="col-sm-4">
							<div class="input-icon">
								<input type="number" class="form-control" placeholder="" value="<?php echo "0";?>" id="diskon" name="diskon" onchange="hasil()" >
								 <span class="input-icon-addon">
									 %
								</span>
							</div>
						  </div>
					  </div>
					   <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Pajak</label>
						  <div class="col-sm-4">
							<div class="input-icon">
								<input type="number" class="form-control" placeholder="" value="<?php echo "0";?>" id="pajak" name="pajak" onchange="hasil()" >
								 <span class="input-icon-addon">
									 %
								</span>
							</div>
						  </div>
					  </div>
					  
					  <div class="form-group row" >
						  <label for="inputEmail3" class="col-sm-4 col-form-label">
						  <input type="text" class="form-control" placeholder="" value="TOTAL"
							style="border:0px solid #aaa;border-radius:0px;padding:18px;color:#000000;font-size:25px;box-shadow:0px 0px 0px #aaa;"/>
						  </label>
						  <label for="inputEmail3" class="col-sm-8 col-form-label">
						   <div class="input-icon">
							<span class="input-icon-addon" style="border:0px solid #aaa;border-radius:0px;padding:18px;color:#FFFFFF;font-size:30px;box-shadow:0px 0px 0px #aaa;"/>
									 Rp
							</span>
							<input type="hidden" class="form-control" placeholder="" value="<?php echo "$total";?>" id="grandtotal" name="grandtotal" readonly
							style="background:#000000;border:1.7px solid #aaa;border-radius:0px;padding:18px;color:#000000;font-size:18px;box-shadow:0px 0px 0px #aaa;"/>
							<input type="text" class="form-control" placeholder="" value="<?php echo number_format($total);?>" id="grandtotalx" name="grandtotalx"
							style="background:#000000;border:1.7px solid #aaa;border-radius:0px;padding:18px;color:#FFFFFF;font-size:25px;box-shadow:0px 0px 0px #aaa; text-align:right;"/>
							</div>
						  </label>
						</div>
					  
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Dibayar</label>
						  <div class="col-sm-8">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								<input type="text" class="form-control" placeholder="" value="<?php echo "0";?>" id="dibayar" name="dibayar" style="text-align:right;"  >
								</div>
						  </div>
					  </div>
					  <!--
					  <div class="form-group row">
						  <label for="inputEmail3" class="col-sm-4 col-form-label">Kembali</label>
						  <div class="col-sm-8">
							<div class="input-icon">
							<span class="input-icon-addon">
									 Rp
									</span>
								        <input type="text" class="form-control" placeholder="" value="<?php echo "0";?>" id="kembalix" name="kembalix" style="text-align:right;" readonly >
								</div>
						  </div>
					  </div>
					  <input type="hidden" class="form-control" placeholder="" value="<?php echo "0";?>" id="kembali" name="kembali" style="text-align:right;">
					  -->
				</div>
				</div>	
                </div>
			   <div class="modal-footer">
                  <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fas fa-reply"></i> Batal</button>
                  <button type="submit" name="bayar" value="bayar" class="btn btn-primary btn-sm" onClick="return confirm('Apakah Anda Yakin, ingin mengakhiri transaksi ini?')"><i class="fas fa-save"></i> Simpan & Cetak</button>
                </div>
              </div>
			  
			  </form>
            </div>
          </div>
		  
		  
		  
		  <div class="modal fade" id="formsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#000033; color:#FFFFFF;">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Supplier :</h5>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables_new2\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\">
											<thead>
												 <tr>
												 	<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=500>Nama Supplier</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM tbl_supplier ORDER BY id_supplier");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
										      echo "<tr class=\"supplier\" data-a=\"$fetchArray[id_supplier]\" data-b=\"$fetchArray[nm_supplier]\">
														<td style=\"\">$no</td>
														<td style=\"\">
														<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".($fetchArray['nm_supplier'])."</b></div>
																<div class=\"status\">$fetchArray[no_telp]</div>
															</div>
															<button type=\"button\" name=\"supplier\" value=\"supplier\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
														<i class=\"fas fa-plus\"></i></button>
														</div>
														</div>	
														</td>
												   </tr>";
											$no++;			 
											}
							  
											echo "</tbody>
										</table>
									</div>";

					
				?>	
                </div>
				<div class="modal-footer" style="background-color:#000033; color:#FFFFFF;">
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-reply"></i> Batal</button>
                </div>
              </div>
			  
			  </form>
            </div>
          </div>
		  
		  
		  
		  <div class="modal fade" id="formpembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
			<form action="" method="post">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#000033; color:#FFFFFF;">
                  <h5 class="modal-title" id="exampleModalLabelLogout"><i class="fas flaticon-folder"></i> Faktur Pembelian :</h5>
                </div>
                <div class="modal-body">
                <?php 
				 	
				echo "<div class=\"table-responsive\">
										<table id=\"basic-datatables_new3\" class=\"display table table-striped table-hover\" style=\"border:1.7px solid #aaa;border-radius:0px;padding:18px;\">
											<thead>
												 <tr>
												 	<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=5>No.</th>
													<th class=\"text-center\" style=\"background-color:#003399; color:#FFFFFF\" width=500>Faktu Pembelian</th>
												  </tr>
											</thead>
											<tbody>";
											
											$baca = mysqli_query($conn,"SELECT * FROM tbl_pembelian ORDER BY no_transaksi");
											 $no = 1;	
											 while($fetchArray = mysqli_fetch_array($baca)){
										
										      echo "<tr class=\"faktur\" data-a=\"$fetchArray[no_transaksi]\" data-b=\"$fetchArray[id_supplier]\" data-c=\"$fetchArray[nm_supplier]\">
														<td style=\"\">$no</td>
														<td style=\"\">
														<div class=\"card-list\">
														<div class=\"item-list\">
															<div class=\"info-user ml-3\">
																<div class=\"username\"><b>".($fetchArray['no_transaksi'])."</b></div>
																<div class=\"status\">$fetchArray[nm_supplier]</div>
															</div>
															<button type=\"button\" name=\"faktur\" value=\"faktur\" class=\"btn btn-icon btn-round btn-primary btn-sm\">
														<i class=\"fas fa-plus\"></i></button>
														</div>
														</div>	
														</td>
														
												   </tr>";
											$no++;			 
											}
							  
											echo "</tbody>
										</table>
									</div>";

					
				?>	
                </div>
				<div class="modal-footer" style="background-color:#000033; color:#FFFFFF;">
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-reply"></i> Batal</button>
                </div>
              </div>
			  
			  </form>
            </div>
          </div>
		  
		  
		  
		  <script>
		  
		  
		  //jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.barang', function (e) {
			
				
				document.getElementById("kd_barang").value = $(this).attr('data-a');
                document.getElementById("nm_barang").value = $(this).attr('data-b');
				document.getElementById("satuan").value = $(this).attr('data-c');
				document.getElementById("kd_kategori").value = $(this).attr('data-d');
				document.getElementById("harga").value = $(this).attr('data-e');
				document.getElementById("hargax").value = $(this).attr('data-f');
				document.getElementById("stock").value = $(this).attr('data-g');
				
				
                $('#formbarang').modal('hide');
				
            });
			
			$(document).on('click', '.supplier', function (e) {
			
				document.getElementById("id_supplier").value = $(this).attr('data-a');
				document.getElementById("nm_supplier").value = $(this).attr('data-b');
				
                $('#formsupplier').modal('hide');
				
            });
			
			$(document).on('click', '.faktur', function (e) {
			
				document.getElementById("faktur").value = $(this).attr('data-a');
				document.getElementById("id_supplier").value = $(this).attr('data-b');
				document.getElementById("nm_supplier").value = $(this).attr('data-c');
				
                $('#formpembelian').modal('hide');
				
            });
			
			$(document).on('click', '.satuan', function (e) {
			
				document.getElementById("satuan").value = $(this).attr('data-a');
				
                $('#formsatuan').modal('hide');
				
            });
			
			
		</script>
		<script>
			function toggleTextField(pembayaran) {
			  var textField = document.getElementById("dibayar");
			  if (pembayaran === "1") {
				textField.disabled = false; // Aktifkan text field
				textField.value = document.getElementById("grandtotal").value;
			  } else if (pembayaran === "2") {
				textField.disabled = true; // Nonaktifkan text field
				textField.value = ""; // Kosongkan nilai text field
			  }
			}
	     </script>
        
           



<?php

if($_POST['tambah']){

$aksi = htmlspecialchars($_POST['aksi'], ENT_QUOTES);
$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
$kd_barang = htmlspecialchars($_POST['kd_barang'], ENT_QUOTES);
$nm_barang = htmlspecialchars($_POST['nm_barang'], ENT_QUOTES);
$kd_kategori = htmlspecialchars($_POST['kd_kategori'], ENT_QUOTES);
$satuan = htmlspecialchars($_POST['satuan'], ENT_QUOTES);
$harga = htmlspecialchars($_POST['harga'], ENT_QUOTES);
$jumlah = htmlspecialchars($_POST['jumlah'], ENT_QUOTES);
$stock = htmlspecialchars($_POST['stock'], ENT_QUOTES);
$user = $_SESSION['id'];

$total = $harga*$jumlah;

		if(empty($kd_barang) || empty($nm_barang) || empty($kd_kategori) || empty($satuan) || empty($harga) || empty($jumlah)){
		
				echo "<form action=\"welcome.php?modul=returpembelian&aksi=$aksi\" method=\"post\" id=\"gagal\">
				       <input type=\"hidden\" value=\"$id\" name=\"id\">
				      </form>";
					
			
				echo "<script type=\"text/javascript\">
						swal(\"Maaf! ", "Barang belum anda pilih!\", {
						icon : \"error\",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
								
							}
						},
					}).then(
					function() {
						document.getElementById('gagal').submit();
					}
					);
					</script>";
				
				
		}else
		if($jumlah > $stock){
		
			echo "<form action=\"welcome.php?modul=returpembelian&aksi=$aksi\" method=\"post\" id=\"gagal\"></form>";
				echo "<script type=\"text/javascript\">
						swal(\"Maaf! ", "Jumlah Barang Melebihi Stock Barang yang ada!\", {
						icon : \"error\",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
								
							}
						},
					}).then(
					function() {
						document.getElementById('gagal').submit();
					}
					);
					</script>";
					
		}else{ 
				
				$query = mysqli_query($conn,"INSERT INTO tbl_retur_pembelian_det (no_transaksi,tgl_transaksi,kd_barang,nm_barang,kd_kategori,satuan,harga,jumlah,total,tgl_update,user) 
									  VALUE('$id','$tgl','$kd_barang','$nm_barang','$kd_kategori','$satuan','$harga','$jumlah','$total',NOW(),'$user')");
					
				if($query){
				
				echo "<form action=\"welcome.php?modul=returpembelian&aksi=$aksi\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$id\" name=\"id\">
					</form>";
					
				echo "<script type=\"text/javascript\">
						document.getElementById('success').submit();
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
				
	

}else
if($_POST['hapus']){

		$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
		$faktur = htmlspecialchars($_POST['faktur'], ENT_QUOTES);
		$aksi = htmlspecialchars($_POST['aksi'], ENT_QUOTES);

		$query = mysqli_query($conn,"delete from tbl_retur_pembelian_det where id='$id'");
				
				if($query){
				
				echo "<form action=\"welcome.php?modul=returpembelian&aksi=$aksi\" method=\"post\" id=\"success\">
				          <input type=\"hidden\" value=\"$faktur\" name=\"id\">
				      </form>";
					
				echo "<script type=\"text/javascript\">
						document.getElementById('success').submit();
					</script>";
					
		}else{
				echo "<script type=\"text/javascript\">
						swal(\"Maaf! ", "Data Gagal dihapus!\", {
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



}else
if($_POST['bayar']){


$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
$faktur = htmlspecialchars($_POST['faktur'], ENT_QUOTES);
$no_transaksi = htmlspecialchars($_POST['no_transaksi'], ENT_QUOTES);
$tgl = htmlspecialchars($_POST['tgl'], ENT_QUOTES);
$id_supplier = htmlspecialchars($_POST['id_supplier'], ENT_QUOTES);
$nm_supplier = htmlspecialchars($_POST['nm_supplier'], ENT_QUOTES);
$pembayaran = htmlspecialchars($_POST['pembayaran'], ENT_QUOTES);
$exspedisi = htmlspecialchars($_POST['exspedisi'], ENT_QUOTES);

$ogkir = htmlspecialchars($_POST['ogkir'], ENT_QUOTES);
$total = htmlspecialchars($_POST['total'], ENT_QUOTES);
$voucher = htmlspecialchars($_POST['voucher'], ENT_QUOTES);
$diskon = htmlspecialchars($_POST['diskon'], ENT_QUOTES);
$pajak = htmlspecialchars($_POST['pajak'], ENT_QUOTES);

$grandtotal = htmlspecialchars($_POST['grandtotal'], ENT_QUOTES);
$dibayar = htmlspecialchars($_POST['dibayar'], ENT_QUOTES);


$saldo = $grandtotal-$dibayar;

				$query = mysqli_query($conn,"delete from tbl_retur_pembelian where no_transaksi='$no_transaksi'");
				$query = mysqli_query($conn,"INSERT INTO tbl_retur_pembelian (no_transaksi,tgl_transaksi,id_supplier,nm_supplier,faktur,pembayaran,exspedisi,ongkir,total,voucher,diskon,pajak,grand_total,dibayar,saldo,tgl_update,user) 
									  VALUE('$no_transaksi','$tgl','$id_supplier','$nm_supplier','$faktur','$pembayaran','$exspedisi','$ogkir','$total','$voucher','$diskon','$pajak','$grandtotal','$dibayar','$saldo',NOW(),'$user')");
									  
				$query = mysqli_query($conn,"update tbl_retur_pembelian_det set tgl_transaksi='$tgl' where no_transaksi='$no_transaksi'");
				
				
				$kode = "PIU/".$faktur;
				$query = mysqli_query($conn,"delete from tbl_piutang where no_transaksi='$kode'");
				if($pembayaran=='2'){
					
					
					$query = mysqli_query($conn,"INSERT INTO tbl_piutang (no_transaksi,tgl_faktur,id_member,nm_member,faktur,total_piutang,pelunasan,saldo,tgl_update,user,keterangan) 
									 VALUE('$kode','$tgl','$id_supplier','$nm_supplier','$faktur','$grandtotal','','$saldo',NOW(),'$user','Retur Pembelian')");
				
				}
					
				if($query){
					
					echo "<form action=\"welcome.php?modul=returpembelian&aksi=invoice\" method=\"post\" id=\"success\">
					          <input type=\"hidden\" value=\"$no_transaksi\" name=\"id\">
						  </form>";	
					
					/*echo "<form action=\"report/rpt_faktur.php\" method=\"post\" id=\"cetak\" target=\"\">
							  <input type=\"hidden\" value=\"$faktur\" name=\"id\">
						  </form>";*/
						
					echo "<script type=\"text/javascript\">
							swal(\"Ok! ", "Taransaksi Berhasil!\", {
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


?>

<script>
    function printDokumen() {
        var printContents = document.getElementById('container').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>