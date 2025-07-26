<style>
  
	.small-box {
	border-radius: 8px;
	position: relative;
    border: 1.5px solid #eee;
	opacity:0.9;
	}
	
	#small-box-footer {
	background-color: #eee;
	}
	
	.content {
	color:#333;
	font-family:Yu Gothic;
	}
			
  
  </style>



  
<?php
class dashboard{

	function view($tahun){
	
	include("config/config.php");
	
	$tgl = date("Y-m-d");

	if(empty($tahun)){
		$tahun = date('Y');
	}
	
	
	
	
	$select2 = mysqli_query($conn,"SELECT COUNT(*) as jum,SUM(grand_total) as nilai FROM tbl_retur_penjualan WHERE tgl_transaksi='$tgl'");
	$data2 = mysqli_fetch_array($select2);
	
	$select20 = mysqli_query($conn,"SELECT SUM(jumlah) as jum FROM tbl_retur_penjualan_det WHERE tgl_transaksi='$tgl'");
	$data20 = mysqli_fetch_array($select20);
	
	
	$select3 = mysqli_query($conn,"SELECT COUNT(*) as jum,SUM(grand_total) as nilai FROM tbl_pembayaran WHERE tgl_transaksi='$tgl'");
	$data3 = mysqli_fetch_array($select3);
	
	$select4 = mysqli_query($conn,"SELECT SUM(jumlah) as jum FROM tbl_penjualan WHERE tgl_transaksi='$tgl' ");
	$data4 = mysqli_fetch_array($select4);
	
	$select5 = mysqli_query($conn,"SELECT COUNT(*) as jum FROM tbl_pembayaran WHERE dibayar=0 AND tgl_transaksi='$tgl'");
	$data5 = mysqli_fetch_array($select5);
	
	$select6 = mysqli_query($conn,"SELECT COUNT(*) as jum,SUM(grand_total) as nilai FROM tbl_pembelian WHERE tgl_transaksi='$tgl'");
	$data6 = mysqli_fetch_array($select6);
	
	$select0 = mysqli_query($conn,"SELECT SUM(jumlah) as jum FROM tbl_pembelian_det WHERE tgl_transaksi='$tgl'");
	$data0 = mysqli_fetch_array($select0);
	
	
	$select7 = mysqli_query($conn,"SELECT SUM(debet) as nilai FROM tbl_jurnal where kd_akun IN ('1.1','1.2') AND tgl_transaksi='$tgl'");
	$data7 = mysqli_fetch_array($select7);
	
	$select8 = mysqli_query($conn,"SELECT SUM(kredit-debet) as nilai FROM tbl_jurnal where kd_akun='4.1' AND tgl_transaksi='$tgl'");
	$data8 = mysqli_fetch_array($select8);
	
	$select10 = mysqli_query($conn,"SELECT SUM(debet-kredit) as nilai FROM tbl_jurnal where kd_akun='1.3'");
	$data10 = mysqli_fetch_array($select10);
	
	$select11 = mysqli_query($conn,"SELECT SUM(debet-kredit) as nilai FROM tbl_jurnal where kd_akun IN ('1.1','1.2')");
	$data11 = mysqli_fetch_array($select11);
	
	$select9 = mysqli_query($conn,"SELECT COUNT(*) as jum,SUM(grand_total) as nilai FROM tbl_retur_pembelian WHERE tgl_transaksi='$tgl'");
	$data9 = mysqli_fetch_array($select9);
	
	$select90 = mysqli_query($conn,"SELECT SUM(jumlah) as jum FROM tbl_retur_pembelian_det WHERE tgl_transaksi='$tgl'");
	$data90 = mysqli_fetch_array($select90);
	
	

		
		echo "<div class=\"page-header\">
						<h4 class=\"page-title\">Dashboard</h4>
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
								<a href=\"#\">Dashboard</a>
							</li>
						</ul>
					</div>
					<div class=\"row\">
					
					<div class=\"col-sm-6 col-md-3\">
							<div class=\"card card-stats card-default card-round\">
								<div class=\"card-body \">
									<div class=\"row\">
										<div class=\"col-3\">
											<div class=\"icon-big text-center\">
												<i class=\"far fa-credit-card\"></i>
											</div>
										</div>
										<div class=\"col-9 col-stats\">
											<div class=\"numbers\">
												<p class=\"card-category\">Saldo Kas</p>
												<h4 class=\"card-title\">Rp.".number_format($data11['nilai'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class=\"col-sm-6 col-md-3\">
							<div class=\"card card-stats card-default card-round\">
								<div class=\"card-body \">
									<div class=\"row\">
										<div class=\"col-3\">
											<div class=\"icon-big text-center\">
												<i class=\"fas fa-hands\"></i>
											</div>
										</div>
										<div class=\"col-9 col-stats\">
											<div class=\"numbers\">
												<p class=\"card-category\">Jumlah Pemasukan Hari ini</p>
												<h4 class=\"card-title\">Rp.".number_format($data7['nilai'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class=\"col-sm-6 col-md-3\">
							<div class=\"card card-stats card-default card-round\">
								<div class=\"card-body\">
									<div class=\"row\">
										<div class=\"col-3\">
											<div class=\"icon-big text-center\">
												<i class=\"fas fa-hand-holding\"></i>
											</div>
										</div>
										<div class=\"col-9 col-stats\">
											<div class=\"numbers\">
												<p class=\"card-category\">Jumlah Piutang</p>
												<h4 class=\"card-title\">Rp.".number_format($data10['nilai'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class=\"col-sm-6 col-md-3\">
							<div class=\"card card-stats card-default card-round\">
								<div class=\"card-body\">
									<div class=\"row\">
										<div class=\"col-3\">
											<div class=\"icon-big text-center\">
												<i class=\"flaticon-coins\"></i>
											</div>
										</div>
										<div class=\"col-9 col-stats\">
											<div class=\"numbers\">
												<p class=\"card-category\">Jumlah Penjualan Hari ini</p>
												<h4 class=\"card-title\">Rp.".number_format($data8['nilai'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
					</div>
					
					";
					
					echo "<div class=\"row\">
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-secondary mr-3\">
											<i class=\"fa fa-dollar-sign\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">".number_format($data3['jum'])." <small>Penjualan Hari ini</small></a></b></h5>
											<h5 class=\"mb-1\"><b>Rp.".number_format($data3['nilai'])."</b> / <small class=\"text-muted\">".number_format($data4['jum'])." Item Barang</small></h5>
										</div>
									</div>
								</div>
							</div>
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-success mr-3\">
											<i class=\"fa fa-shopping-cart\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">".number_format($data6['jum'])." <small>Pembelian Hari ini</small></a></b></h5>
											<h5 class=\"mb-1\"><b>Rp.".number_format($data6['nilai'])."</b> / <small class=\"text-muted\">".number_format($data0['jum'])." Item Barang</small></h5>
										</div>
									</div>
								</div>
							</div>
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-danger mr-3\">
											<i class=\"fas fa-dolly\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">".number_format($data2['jum'])." <small>Retur Penjualan Hari ini</small></a></b></h5>
											<h5 class=\"mb-1\"><b>Rp.".number_format($data2['nilai'])."</b> / <small class=\"text-muted\">".number_format($data20['jum'])." Item Barang</small></h5>
										</div>
									</div>
								</div>
							</div>
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-primary mr-3\">
											<i class=\"fas fa-dolly-flatbed\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">".number_format($data9['jum'])." <small>Retur Pembelian Hari ini</small></a></b></h5>
											<h5 class=\"mb-1\"><b>Rp.".number_format($data9['nilai'])."</b> / <small class=\"text-muted\">".number_format($data90['jum'])." Item Barang</small></h5>
										</div>
									</div>
								</div>
							</div>
						</div>";
						
						
						echo "<div class=\"row\">";
						/*		
							echo "<div class=\"col-md-4\">
									<div class=\"card\">
										<div class=\"card-header\">
											<h4 class=\"card-title\"><i class=\"flaticon-chart-pie\"></i> Stock Barang</h4>
										</div>
										<div class=\"card-body\">
											<div class=\"chart-container\" id=\"mygraph_belanja\">";
												include "piegraph.php";
											echo "</div>
										</div>
									</div>
								</div>";
								
								
							echo "<div class=\"col-md-4\">
									<div class=\"card\">
										<div class=\"card-header\">
											<h4 class=\"card-title\"><i class=\"flaticon-graph\"></i> Penjualan 5 Hari Terakhir</h4>
										</div>
										<div class=\"card-body\">
											<div class=\"chart-container\" id=\"penjualan\">";
												include "grafik_penjualan.php";
											echo "</div>
										</div>
									</div>
								</div>";
								
								
							echo "<div class=\"col-md-4\">
									<div class=\"card\">
										<div class=\"card-header\">
											<h4 class=\"card-title\"><i class=\"fas fa-medal\"></i> Top 5 Terlaris</h4>
										</div>
										<div class=\"card-body\">
											<div class=\"chart-container\" id=\"terlaris\">";
												include "grafik_terlaris.php";
											echo "</div>
										</div>
									</div>
								</div>";
								
						*/		
						echo "";
						
							
							echo "<div class=\"col-md-12\">
									<div class=\"card\">
										<div class=\"card-header\">
											<h4 class=\"card-title\">
											
											<form action=\"\" method=\"post\">
								<input type=\"hidden\" value=\"$id\" name=\"id\">
									
									<div class=\"form-group row\">
									  <label for=\"inputEmail3\" class=\"col-sm-1 col-form-label\" style=\"text-align:right\">Tahun</label>
									  <div class=\"col-sm-2\">
										<select class=\"select21-single form-control\" name=\"tahun\" id=\"tahun\" required>";
											echo "<option value=\"$tahun\">$tahun</option>";
										    $sql ="SELECT YEAR(tgl_transaksi) AS tahun FROM tbl_jurnal GROUP BY YEAR(tgl_transaksi) ORDER BY YEAR(tgl_transaksi)";
											$baca = mysqli_query($conn,$sql);
											while($result = mysqli_fetch_array($baca)){
												$idx = $result['tahun'];
												$nama = ($result['tahun']);
												echo "<option value=\"$idx\">$nama</option>";
																
											}
										
										echo "
										</select>
									  </div>
									  <div class=\"col-sm-2\">
									  <button type=\"submit\" name=\"tampil\" value=\"tampil\" class=\"btn btn-primary btn-sm\"><i class=\"icon-refresh\"></i> Tampilkan</button>
									  </div>
									</div>
									
									
								</form>
											
											</h4>
										</div>
										<div class=\"card-body\">
											<div class=\"chart-container\" id=\"penjualan\">";
												//include "line_chart.php";
												include "line_bar_chart.php";
											echo "</div>
										</div>
									</div>
								</div>";



		
		if($_POST['tampil']){
		  
				$tahun = htmlspecialchars($_POST['tahun'], ENT_QUOTES);
		  
		  
		  		echo "<form action=\"welcome.php?modul=dashboard&aksi=view\" method=\"post\" id=\"success\">
						  <input type=\"hidden\" value=\"$tahun\" name=\"tahun\">
					</form>";
					
					
				echo "<script type=\"text/javascript\">
						document.getElementById('success').submit();
					</script>";
		  
		  
		  
		  }
								
    }
	
	
	
	

	  
}
?>
