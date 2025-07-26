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
class operator{

	function view(){
	
	include("config/config.php");
	
	$tahun = $_SESSION['tahun'];
	$skpd  =  $_SESSION['skpd'];
	$pptk = $_SESSION['username'];
	
	
		$select1 = mysqli_query($conn,"SELECT SUM(nilai_ubah) as jum FROM trdrkas WHERE kd_skpd='$skpd'");
	    $data1 = mysqli_fetch_array($select1);
		
		$select2 = mysqli_query($conn,"SELECT SUM(nilai) as jum FROM trd_fktp WHERE kd_skpd='$skpd'");
	    $data2 = mysqli_fetch_array($select2);
		
		$select3 = mysqli_query($conn,"SELECT SUM(nilai) as jum FROM trdtransout_fktp WHERE kd_skpd='$skpd'");
	    $data3 = mysqli_fetch_array($select3);
	
	
		
		
		$sqlskpd = mysqli_query($conn,"SELECT  * FROM ms_skpd where kd_skpd='$skpd'");
	    $row = mysqli_fetch_array($sqlskpd);	
				
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
					<div class=\"alert alert-danger\">
					  <div class=\"\">
										<b>$skpd - $row[nm_skpd]</b>
								</div>
					  </div>
					<div class=\"row\">
						<div class=\"col-sm-6 col-md-3\">
							<div class=\"card card-stats card-round\">
								<div class=\"card-body \">
									<div class=\"row align-items-center\">
										<div class=\"col-icon\">
											<div class=\"icon-big text-center icon-primary bubble-shadow-small\">
												<i class=\"flaticon-coins\"></i>
											</div>
										</div>
										<div class=\"col col-stats ml-3 ml-sm-0\">
											<div class=\"numbers\">
												<p class=\"card-category\">Total Anggaran Belanja</p>
												<h4 class=\"card-title\">Rp. ".number_format($data1['jum'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class=\"col-sm-6 col-md-4\">
							<div class=\"card card-stats card-round\">
								<div class=\"card-body\">
									<div class=\"row align-items-center\">
										<div class=\"col-icon\">
											<div class=\"icon-big text-center icon-info bubble-shadow-small\">
												<i class=\"flaticon-cart-1\"></i>
											</div>
										</div>
										<div class=\"col col-stats ml-3 ml-sm-0\">
											<div class=\"numbers\">
												<p class=\"card-category\">Jumlah Pendapatan</p>
												<h4 class=\"card-title\">Rp. ".number_format($data2['jum'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class=\"col-sm-6 col-md-5\">
							<div class=\"card card-stats card-round\">
								<div class=\"card-body\">
									<div class=\"row align-items-center\">
										<div class=\"col-icon\">
											<div class=\"icon-big text-center icon-danger bubble-shadow-small\">
												<i class=\"flaticon-chart-pie\"></i>
											</div>
										</div>
										<div class=\"col col-stats ml-3 ml-sm-0\">
											<div class=\"numbers\">
												<p class=\"card-category\">Jumlah Realisasi</p>
												<h4 class=\"card-title\">Rp. ".number_format($data3['jum'])."</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
					";
				
				
				
				/*	echo "<div class=\"row\">
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-secondary mr-3\">
											<i class=\"fa fa-dollar-sign\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">132 <small>Sales</small></a></b></h5>
											<small class=\"text-muted\">12 waiting payments</small>
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
											<h5 class=\"mb-1\"><b><a href=\"#\">78 <small>Orders</small></a></b></h5>
											<small class=\"text-muted\">32 shipped</small>
										</div>
									</div>
								</div>
							</div>
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-danger mr-3\">
											<i class=\"fa fa-users\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">1,352 <small>Members</small></a></b></h5>
											<small class=\"text-muted\">163 registered today</small>
										</div>
									</div>
								</div>
							</div>
							<div class=\"col-sm-6 col-lg-3\">
								<div class=\"card p-3\">
									<div class=\"d-flex align-items-center\">
										<span class=\"stamp stamp-md bg-warning mr-3\">
											<i class=\"fa fa-comment-alt\"></i>
										</span>
										<div>
											<h5 class=\"mb-1\"><b><a href=\"#\">132 <small>Comments</small></a></b></h5>
											<small class=\"text-muted\">16 waiting</small>
										</div>
									</div>
								</div>
							</div>
						</div>";
						*/
					
					/*
					echo "<div class=\"row\">
						<div class=\"col-md-8\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\"><i class=\"flaticon-chart-pie\"></i> Persentase BUMDES Pada Desa</h4>
								</div>
								<div class=\"card-body\">
									<div class=\"chart-container\" id=\"mygraph_belanja\">";
										include "piegraph.php";
									echo "</div>
								</div>
							</div>
						</div>
						<div class=\"col-md-4\">
							<div class=\"card\">
								<div class=\"card-header\">
									<h4 class=\"card-title\"><i class=\"flaticon-graph\"></i> Persentase Sumber Dana</h4>
								</div>
								<div class=\"card-body\">
									<div class=\"chart-container\" id=\"container\">";
										include "grafik3.php";
									echo "</div>
								</div>
							</div>
						</div>
						
						</div>";
						*/
						/*include "pieChart.php";
						echo "<div class=\"row\">
						       <div class=\"col-md-6\">
								<div class=\"card\">
									<div class=\"card-header\">
										<div class=\"card-title\">Pie Chart</div>
									</div>
									<div class=\"card-body\">
										<div class=\"chart-container\">
											<canvas id=\"pieChart\" style=\"width: 50%; height: 50%\"></canvas>
										</div>
									</div>
								</div>
							</div>
							</div>";*/
							
							echo "<div class=\"row\">
							<div class=\"col-md-7\">
								<div class=\"card\">
									<div class=\"card-header\">
										<h4 class=\"card-title\"><i class=\"flaticon-chart-pie\"></i> Persentase Anggaran</h4>
									</div>
									<div class=\"card-body\">
										<div class=\"chart-container\" id=\"mygraph_belanja\">";
											include "piegraph_bidang.php";
										echo "</div>
									</div>
								</div>
							</div>
							<div class=\"col-md-5\">
								<div class=\"card\">
									<div class=\"card-header\">
										<h4 class=\"card-title\"><i class=\"flaticon-graph-2\"></i> Realisasi</h4>
									</div>
									<div class=\"card-body\">
										<div class=\"chart-container\" id=\"container\">";
											include "grafik_operator.php";
										echo "</div>
									</div>
								</div>
							</div>
							
							</div>";
    }
	
	
	
	

	  
}
?>
