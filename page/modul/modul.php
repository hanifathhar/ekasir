<?php

//*********************************************************Modul Data Master*********************************
if($_GET['modul']=="dashboard"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
						if($_GET['aksi']=="view"){
						
							if($_SESSION['level']=='1'){
								include 'class/dashboard.php';
								$tahun = $_POST['tahun'];
								$dashboard = new dashboard();
								$dashboard->view($tahun);
							}else{
								/*include 'class/operator.php';
								$operator = new operator();
								$operator->view();*/
							
							}
							
                        }
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="profil"){
						if($_GET['aksi']=="view"){
                            include 'form/master/form_profil.php';
                        }
}else
if($_GET['modul']=="company"){
						if($_GET['aksi']=="view"){
                            include 'form/master/form_sclient.php';
                        }
}else
if($_GET['modul']=="ubahpassword"){
						if($_GET['aksi']=="view"){
                            include 'form/master/form_password.php';
                        }
}else
if($_GET['modul']=="user"){

	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=user%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/master/user.php';
							$act = $_GET['act'];
							$user = new user();
							$user->view($act);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/master/form_user.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/master/form_user.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/master/user.php';
							$id = $_POST['id'];
							$user = new user();
							$user->hapus($id);
                        }else
						if($_GET['aksi']=="ubahpassword"){
                            include 'form/master/form_password.php';
                        }else
						if($_GET['aksi']=="profil"){
                            include 'form/master/form_profil.php';
                        }
			 }else{
				echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			 }
		
						
	}else{
		echo "<script>document.location='../index.php'</script>\n";
	}
}else
if($_GET['modul']=="barang"){

	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=barang%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/master/barang.php';
							$msg = $_GET['msg'];
							$barang = new barang();
							$barang->view($msg);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/master/form_barang.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/master/form_barang.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/master/barang.php';
							$id = $_POST['id'];
							$barang = new barang();
							$barang->hapus($id);
                        }
			 }else{
				echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			 }
		
						
	}else{
		echo "<script>document.location='../index.php'</script>\n";
	}
}else
if($_GET['modul']=="supplier"){

	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=supplier%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/master/supplier.php';
							$act = $_GET['act'];
							$supplier = new supplier();
							$supplier->view($act);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/master/form_supplier.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/master/form_supplier.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/master/supplier.php';
							$id = $_POST['id'];
							$supplier = new supplier();
							$supplier->hapus($id);
                        }
			 }else{
				echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			 }
		
						
	}else{
		echo "<script>document.location='../index.php'</script>\n";
	}
}else
if($_GET['modul']=="member"){

	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=member%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/master/member.php';
							$act = $_GET['act'];
							$member = new member();
							$member->view($act);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/master/form_member.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/master/form_member.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/master/member.php';
							$id = $_POST['id'];
							$member = new member();
							$member->hapus($id);
                        }
			 }else{
				echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			 }
		
						
	}else{
		echo "<script>document.location='../index.php'</script>\n";
	}
}else
if($_GET['modul']=="modul"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=modul%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
			
						if($_GET['aksi']=="view"){
                            include 'class/master/modul.php';
							$act = $_GET['act'];
							$modul = new modul();
							$modul->view($act);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/master/form_modul.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/master/form_modul.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/master/modul.php';
							$id = $_POST['id'];
							$modul = new modul();
							$modul->hapus($id);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=1'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="grup"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=grup%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/master/grup.php';
							$act = $_GET['act'];
							$grup = new grup();
							$grup->view($act);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/master/form_grup.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/master/form_grup.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/master/grup.php';
							$id = $_POST['id'];
							$grup = new grup();
							$grup->hapus($id);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="kasir"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=kasir%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
			
						if($_GET['aksi']=="input"){
                            include 'form/transaksi/form_kasir.php';
                        }else
						if($_GET['aksi']=="invoice"){
                            include 'form/transaksi/form_invoice.php';
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="penjualan"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=penjualan%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/penjualan.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$penjualan = new penjualan();
							$penjualan->view($tgl1,$tgl2);
                        }else
						if($_GET['aksi']=="invoice"){
                            include 'form/transaksi/form_invoice_penjualan.php';
                        }else
						if($_GET['aksi']=="report"){
                            include 'form/transaksi/form_lap_penjualan.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/transaksi/penjualan.php';
							$id = $_POST['id'];
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$penjualan = new penjualan();
							$penjualan->hapus($id,$tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="pembelian"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=pembelian%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/pembelian.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$pembelian = new pembelian();
							$pembelian->view($tgl1,$tgl2);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/transaksi/form_pembelian.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/transaksi/form_pembelian.php';
                        }else
						if($_GET['aksi']=="invoice"){
                            include 'form/transaksi/form_invoice_pembelian.php';
                        }else
						if($_GET['aksi']=="report"){
                            include 'form/transaksi/form_lap_pembelian.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/transaksi/pembelian.php';
							$id = $_POST['id'];
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$pembelian = new pembelian();
							$pembelian->hapus($id,$tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="returpenjualan"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=returpenjualan%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/returpenjualan.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$returpenjualan = new returpenjualan();
							$returpenjualan->view($tgl1,$tgl2);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/transaksi/form_retur_penjualan.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/transaksi/form_retur_penjualan.php';
                        }else
						if($_GET['aksi']=="invoice"){
                            include 'form/transaksi/form_invoice_retur_penjualan.php';
                        }else
						if($_GET['aksi']=="report"){
                            include 'form/transaksi/form_lap_retur_penjualan.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/transaksi/returpenjualan.php';
							$id = $_POST['id'];
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$returpenjualan = new returpenjualan();
							$returpenjualan->hapus($id,$tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="returpembelian"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=returpembelian%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/returpembelian.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$returpembelian = new returpembelian();
							$returpembelian->view($tgl1,$tgl2);
                        }else
						if($_GET['aksi']=="input"){
                            include 'form/transaksi/form_retur_pembelian.php';
                        }else
						if($_GET['aksi']=="edit"){
                            include 'form/transaksi/form_retur_pembelian.php';
                        }else
						if($_GET['aksi']=="invoice"){
                            include 'form/transaksi/form_invoice_retur_pembelian.php';
                        }else
						if($_GET['aksi']=="report"){
                            include 'form/transaksi/form_lap_retur_pembelian.php';
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/transaksi/returpembelian.php';
							$id = $_POST['id'];
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$returpembelian = new returpembelian();
							$returpembelian->hapus($id,$tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="modal"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=modal%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/modal.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$modal = new modal();
							$modal->view($tgl1,$tgl2);
                        }else
						if($_GET['aksi']=="hapus"){
                            include 'class/transaksi/modal.php';
							$id = $_POST['id'];
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$modal = new modal();
							$modal->hapus($id,$tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="piutang"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=piutang%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/piutang.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$piutang = new piutang();
							$piutang->view($tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="hutang"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=hutang%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/transaksi/hutang.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$hutang = new hutang();
							$hutang->view($tgl1,$tgl2);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="cashflow"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=cashflow%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/laporan/cashflow.php';
							$tgl1 = $_POST['tgl1'];
							$tgl2 = $_POST['tgl2'];
							$cashflow = new cashflow();
							$cashflow->view($tgl1,$tgl2);
                        }else
						if($_GET['aksi']=="report"){
                            include 'form/laporan/form_lap_cashflow.php';
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="stock"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=stock%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/laporan/stock.php';
							$jenis = $_POST['jenis'];
							$stock = new stock();
							$stock->view($jenis);
                        }else
						if($_GET['aksi']=="report"){
                            include 'form/laporan/form_lap_stock.php';
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="laba"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=laba%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/laporan/laba.php';
							$bulan = $_POST['bulan'];
							$tahun = $_POST['tahun'];
							$laba = new laba();
							$laba->view($bulan,$tahun);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}else
if($_GET['modul']=="neraca"){
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		
			$id = $_SESSION['id'];
			$baca = mysqli_query($conn,"SELECT a.* FROM otori_menu a LEFT JOIN admin b ON a.id_grup=b.id_grup WHERE b.id='$id' AND a.url LIKE '%welcome.php?modul=neraca%'");
			$res = mysqli_num_rows($baca);
			if($res > 0){
						if($_GET['aksi']=="view"){
                            include 'class/laporan/neraca.php';
							$tgl1 = $_POST['tgl1'];
							$neraca = new neraca();
							$neraca->view($tgl1);
                        }
			}else{
			echo "<script>document.location='welcome.php?modul=dashboard&aksi=view&act=2'</script>\n";
			}
		}else{
			echo "<script>document.location='../index.php'</script>\n";
		}
}


?>