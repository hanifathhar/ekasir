<?php
session_start();

include("config/config.php");
set_time_limit(1200);

$csql = mysqli_query($conn,"SELECT * FROM ms_profil");
$company = mysqli_fetch_array($csql);
$nmclient = $company['company'];
$alamat = $company['alamat'];


$tgl = date('Y-m-d');
$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$tahun1 = substr($tgl, 0, 4);
$bulan1 = substr($tgl, 5, 2);
$tgl   = substr($tgl, 8, 2);
				 
$tanggal = $tgl . " " . $BulanIndo[(int)$bulan1-1] . " ". $tahun1;



$tahun = date('Y');



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>E-Kasir</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	 <link rel="shortcut icon" href="../assets/img/ek-lg-1.png">
	
	<!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
	
	 
  
    <!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	
	<!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	
	
	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<script>
	function PopupCenter(pageURL, title,w,h) {
		var left = (screen.width/2)-(w/2);
		var top = (screen.height/2)-(h/2);
		var targetWin = window.open (pageURL, title, 'directories=no,titlebar=no,toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
		}
		function PopupCenterhapus(pageURL, title,w,h) {
		if (confirm("Anda yakin ingin menghapus data ini ?"))
				{
				var left = (screen.width/2)-(w/2);
				var top = (screen.height/2)-(h/2);
				var targetWin = window.open (pageURL, title, 'directories=no,titlebar=no,toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
				}
		}
		
	
    </script>
	
	 

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">

	
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="white">
				<a href="welcome.php?modul=dashboard&aksi=view" style="font-size:15px; color:#FFFFFF;">
						<img src="../assets/img/ek-lg-3.png" alt="navbar brand" class="navbar-brand">
				</a>
				
					<!-- <img src="../assets/img/siblud.png" alt="navbar brand" class="navbar-brand"> -->
				
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="white">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav" style="font-size:25px; color:#FF0000; text-shadow:#000000;">
						<b><?php echo "$nmclient";?></b>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						
						
						
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" style="font-size:15px;">
								<i class="fas fa-home"></i>&nbsp;&nbsp;Profil
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/boy.png" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $_SESSION['nama'];?></h4>
												<p class="text-muted"><?php echo $_SESSION['nmgrup'];?></p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="welcome.php?modul=profil&aksi=view"><i class="fas fa-user-circle"></i> Profil</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="welcome.php?modul=ubahpassword&aksi=view"><i class="icon-lock-open"></i> Ubah Password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2" data-background-color="dark">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/boy.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#" aria-expanded="true">
							<?php
							$inisial = substr($_SESSION['nama'],0,12);
							?>
								<span>
									<?php echo $inisial;?>
									<p class="text-muted"><?php echo $_SESSION['nmgrup'];?></p>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
					
					<?php
					
				
					
					/*
					
					
					
					
					
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('E') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#tables\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas fa-cart-plus\"></i>
								<p>Pengadaan</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"tables\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('E') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
									echo "<li>
											<a href=\"$fetchArray[url]\">
												<span class=\"sub-item\">$fetchArray[modul]</span>
											</a>
									      </li>";
								}
								echo "
								</ul>
							</div>
						</li>";
					
					}
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('B') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#sidebarLayouts\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas fa-donate\"></i>
								<p>Pengeluaran</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"sidebarLayouts\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('B') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
										
										echo "<li>
												<a href=\"$fetchArray[url]\">
													<span class=\"sub-item\">$fetchArray[modul]</span>
												</a>
											  </li>";
						
									
								}
								echo "
								</ul>
							</div>
						</li>";
						
					}
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('C') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#maps\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas flaticon-file-1\"></i>
								<p>Laporan</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"maps\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('C') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
									
										echo "<li>
												<a href=\"$fetchArray[url]\">
													<span class=\"sub-item\">$fetchArray[modul]</span>
												</a>
											  </li>";
									
								}
								echo "
								</ul>
							</div>
						</li>";
					
					}
					
					
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('D') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#sidebarLayouts1\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas fa-chalkboard-teacher\"></i>
								<p>Verifikasi</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"sidebarLayouts1\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('D') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
										
										echo "<li>
												<a href=\"$fetchArray[url]\">
													<span class=\"sub-item\">$fetchArray[modul]</span>
												</a>
											  </li>";
						
									
								}
								echo "
								</ul>
							</div>
						</li>";
					
					}
					
					
					*/
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('M') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#forms\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas fa-book\"></i>
								<p>Master</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"forms\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('M') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
									echo "<li>
											<a href=\"$fetchArray[url]\">
												<span class=\"sub-item\">$fetchArray[modul]</span>
											</a>
									      </li>";
								}
								echo "
								</ul>
							</div>
						</li>";
					
					}
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('A') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#base\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas flaticon-agenda-1\"></i>
								<p>Kasir</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"base\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('A') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
									echo "<li>
											<a href=\"$fetchArray[url]\">
												<span class=\"sub-item\">$fetchArray[modul]</span>
											</a>
									      </li>";
								}
								echo "
								</ul>
							</div>
						</li>";
						
					}
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('B') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#sidebarLayouts\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas fa-chart-pie\"></i>
								<p>Transaksi</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"sidebarLayouts\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('B') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
										
										echo "<li>
												<a href=\"$fetchArray[url]\">
													<span class=\"sub-item\">$fetchArray[modul]</span>
												</a>
											  </li>";
						
									
								}
								echo "
								</ul>
							</div>
						</li>";
						
					}
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('C') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#maps\" class=\"collapsed\" aria-expanded=\"false\">
								<i class=\"fas flaticon-file-1\"></i>
								<p>Laporan</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"maps\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('C') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
									
										echo "<li>
												<a href=\"$fetchArray[url]\">
													<span class=\"sub-item\">$fetchArray[modul]</span>
												</a>
											  </li>";
									
								}
								echo "
								</ul>
							</div>
						</li>";
					
					}
					
					
					
					$baca = mysqli_query($conn,"select * from otori_menu where page_id IN ('U') and id_grup='".$_SESSION['grup']."'");
					$res = mysqli_num_rows($baca);
					if($res < 1){
									
					}else{ 
					
					echo "<li class=\"nav-item\">
							<a data-toggle=\"collapse\" href=\"#dashboard\">
								<i class=\"fas flaticon-settings\"></i>
								<p>Pengaturan</p>
								<span class=\"caret\"></span>
							</a>
							<div class=\"collapse\" id=\"dashboard\">
								<ul class=\"nav nav-collapse\">";
								$sql ="select * from otori_menu where page_id IN ('U') and id_grup='".$_SESSION['grup']."' order by id";
								$baca = mysqli_query($conn,$sql);
								while($fetchArray = mysqli_fetch_array($baca))
								{
									echo "<li>
											<a href=\"$fetchArray[url]\">
												<span class=\"sub-item\">$fetchArray[modul]</span>
											</a>
									      </li>";
								}
								echo "
								</ul>
							</div>
						</li>";
					
					}
					
					?>
						
						
						
						
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					
					<?php
					
					include "modul/modul.php";
					
					?>
						
					</div>	
					</div>
				</div>
			</div>
			
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								
							</li>
							<li class="nav-item">
								
							</li>
							<li class="nav-item">
								
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						
					</div>				
				</div>
			</footer>
		</div>
		
		<!-- Custom template | don't include it in your project! -->
		
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	
	
	
	<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});
			
			$('#basic-datatables_new').DataTable({
			});
			
			$('#basic-datatables_new1').DataTable({
			});
			
			$('#basic-datatables_new2').DataTable({
			});
			
			$('#basic-datatables_new3').DataTable({
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
	<script>
		//== Class definition
		var SweetAlert2Demo = function() {

			//== Demos
			var initDemos = function() {
				//== Sweetalert Demo 1
				$('#alert_demo_1').click(function(e) {
					swal('Good job!', {
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
							}
						},
					});
				});

				//== Sweetalert Demo 2
				$('#alert_demo_2').click(function(e) {
					swal("Here's the title!", "...and here's the text!", {
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
							}
						},
					});
				});

				//== Sweetalert Demo 3
				$('#alert_demo_3_1').click(function(e) {
					swal("Good job!", "You clicked the button!", {
						icon : "warning",
						buttons: {        			
							confirm: {
								className : 'btn btn-warning'
							}
						},
					});
				});

				$('#alert_demo_3_2').click(function(e) {
					swal("Good job!", "You clicked the button!", {
						icon : "error",
						buttons: {        			
							confirm: {
								className : 'btn btn-danger'
							}
						},
					});
				});

				$('#alert_demo_3_3').click(function(e) {
					swal("Good job!", "You clicked the button!", {
						icon : "success",
						buttons: {        			
							confirm: {
								className : 'btn btn-success'
							}
						},
					});
				});

				$('#alert_demo_3_4').click(function(e) {
					swal("Good job!", "You clicked the button!", {
						icon : "info",
						buttons: {        			
							confirm: {
								className : 'btn btn-info'
							}
						},
					});
				});

				//== Sweetalert Demo 4
				$('#alert_demo_4').click(function(e) {
					swal({
						title: "Good job!",
						text: "You clicked the button!",
						icon: "success",
						buttons: {
							confirm: {
								text: "Confirm Me",
								value: true,
								visible: true,
								className: "btn btn-success",
								closeModal: true
							}
						}
					});
				});

				$('#alert_demo_5').click(function(e){
					swal({
						title: 'Input Something',
						html: '<br><input class="form-control" placeholder="Input Something" id="input-field">',
						content: {
							element: "input",
							attributes: {
								placeholder: "Input Something",
								type: "text",
								id: "input-field",
								className: "form-control"
							},
						},
						buttons: {
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							},        			
							confirm: {
								className : 'btn btn-success'
							}
						},
					}).then(
					function() {
						swal("", "You entered : " + $('#input-field').val(), "success");
					}
					);
				});

				$('#alert_demo_6').click(function(e) {
					swal("This modal will disappear soon!", {
						buttons: false,
						timer: 3000,
					});
				});

				$('#alert_demo_7').click(function(e) {
					swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes, delete it!',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Delete) => {
						if (Delete) {
							swal({
								title: 'Deleted!',
								text: 'Your file has been deleted.',
								type: 'success',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							});
						} else {
							swal.close();
						}
					});
				});

				$('#alert_demo_8').click(function(e) {
					swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						buttons:{
							cancel: {
								visible: true,
								text : 'No, cancel!',
								className: 'btn btn-danger'
							},        			
							confirm: {
								text : 'Yes, delete it!',
								className : 'btn btn-success'
							}
						}
					}).then((willDelete) => {
						if (willDelete) {
							swal("Poof! Your imaginary file has been deleted!", {
								icon: "success",
								buttons : {
									confirm : {
										className: 'btn btn-success'
									}
								}
							});
						} else {
							swal("Your imaginary file is safe!", {
								buttons : {
									confirm : {
										className: 'btn btn-success'
									}
								}
							});
						}
					});
				})

			};

			return {
				//== Init
				init: function() {
					initDemos();
				},
			};
		}();

		//== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
	</script>
	<!-- Select2 -->
  <script src="../vendors/select2/dist/js/select2.min.js"></script>
   <script>
    $(document).ready(function () {


      $('.select2').select2();

      // Select2 Single  with Placeholder
      $('.select2-single-placeholder').select2({
        placeholder: "",
        allowClear: true
      });      

      // Select2 Multiple
      $('.select2-multiple').select2();

      // Bootstrap Date Picker
      $('#simple-date1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,        
      });

      $('#simple-date2 .input-group.date').datepicker({
        startView: 1,
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });

      $('#simple-date3 .input-group.date').datepicker({
        startView: 2,
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });

      $('#simple-date4 .input-daterange').datepicker({        
        format: 'dd/mm/yyyy',        
        autoclose: true,     
        todayHighlight: true,   
        todayBtn: 'linked',
      });    

      // TouchSpin

      $('#touchSpin1').TouchSpin({
        min: 0,
        max: 100,                
        boostat: 5,
        maxboostedstep: 10,        
        initval: 0
      });

      $('#touchSpin2').TouchSpin({
        min:0,
        max: 100,
        decimals: 0,
        step: 1.0,
        postfix: '%',
        initval: 0,
        boostat: 5,
        maxboostedstep: 10
      });

      $('#touchSpin3').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
      });
	  
	  
	  $('#touchSpin4').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
      });
	  
	  $('#touchSpin5').TouchSpin({
        min: 0,
        max: 100,
        initval: 0,
        boostat: 5,
        maxboostedstep: 10,
        verticalbuttons: true,
      });

      $('#clockPicker1').clockpicker({
        donetext: 'Done'
      });

      $('#clockPicker2').clockpicker({
        autoclose: true
      });

      let input = $('#clockPicker3').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'top',
        align: 'left',
      });

      $('#check-minutes').click(function(e){        
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
      });

    });
  </script>
  <script>
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready(function() {
			$('.js-example-basic-single').select2();
		});
	  </script>	
	  <script type="text/javascript">
		  $(document).ready(function() {
			  $('#cek').select2({
			   placeholder: "",
			allowClear: true,
			language: "id"
			  });
		  });
	 </script>
	 <!-- Bootstrap Notify -->
	 <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	 <script>
		$('#displayNotifedit').on('click', function(){
			var placementFrom = 'top';
			var placementAlign = 'right';
			var state = 'primary';
			var style = 'withicon';
			var content = {};

			content.message = 'Maaf, Data ini tidak bisa di edit';
			content.title = 'Pemberitahuan :';
			if (style == "withicon") {
				content.icon = 'fa fa-bell';
			} else {
				content.icon = 'none';
			}
			content.url = '';
			content.target = '';

			$.notify(content,{
				type: state,
				placement: {
					from: placementFrom,
					align: placementAlign
				},
				time: 1000,
				delay: 0,
			});
		});
	</script>
	<script>
		$('#displayNotifdelet').on('click', function(){
			var placementFrom = 'top';
			var placementAlign = 'right';
			var state = 'danger';
			var style = 'withicon';
			var content = {};

			content.message = 'Maaf, Data ini tidak bisa di hapus';
			content.title = 'Pemberitahuan :';
			if (style == "withicon") {
				content.icon = 'fa fa-bell';
			} else {
				content.icon = 'none';
			}
			content.url = '';
			content.target = '';

			$.notify(content,{
				type: state,
				placement: {
					from: placementFrom,
					align: placementAlign
				},
				time: 1000,
				delay: 0,
			});
		});
	</script>
	<script>
		var lineChart = document.getElementById('lineChart').getContext('2d'),
		barChart = document.getElementById('barChart').getContext('2d'),
		pieChart = document.getElementById('pieChart').getContext('2d'),
		doughnutChart = document.getElementById('doughnutChart').getContext('2d'),
		radarChart = document.getElementById('radarChart').getContext('2d'),
		bubbleChart = document.getElementById('bubbleChart').getContext('2d'),
		multipleLineChart = document.getElementById('multipleLineChart').getContext('2d'),
		multipleBarChart = document.getElementById('multipleBarChart').getContext('2d'),
		htmlLegendsChart = document.getElementById('htmlLegendsChart').getContext('2d');

		var myLineChart = new Chart(lineChart, {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [{
					label: "Active Users",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'bottom',
					labels : {
						padding: 10,
						fontColor: '#1d7af3',
					}
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});

		var myBarChart = new Chart(barChart, {
			type: 'bar',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets : [{
					label: "Sales",
					backgroundColor: 'rgb(23, 125, 255)',
					borderColor: 'rgb(23, 125, 255)',
					data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
			}
		});

		var myPieChart = new Chart(pieChart, {
			type: 'pie',
			data: {
				datasets: [{
					data: [50, 35, 15],
					backgroundColor :["#1d7af3","#f3545d","#fdaf4b"],
					borderWidth: 0
				}],
				labels: ['New Visitors', 'Subscribers', 'Active Users'] 
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom',
					labels : {
						fontColor: 'rgb(154, 154, 154)',
						fontSize: 11,
						usePointStyle : true,
						padding: 20
					}
				},
				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 14,
				},
				tooltips: false,
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		})

		var myDoughnutChart = new Chart(doughnutChart, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: [10, 20, 30],
					backgroundColor: ['#f3545d','#fdaf4b','#1d7af3']
				}],

				labels: [
				'Red',
				'Yellow',
				'Blue'
				]
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				},
				layout: {
					padding: {
						left: 20,
						right: 20,
						top: 20,
						bottom: 20
					}
				}
			}
		});

		var myRadarChart = new Chart(radarChart, {
			type: 'radar',
			data: {
				labels: ['Running', 'Swimming', 'Eating', 'Cycling', 'Jumping'],
				datasets: [{
					data: [20, 10, 30, 2, 30],
					borderColor: '#1d7af3',
					backgroundColor : 'rgba(29, 122, 243, 0.25)',
					pointBackgroundColor: "#1d7af3",
					pointHoverRadius: 4,
					pointRadius: 3,
					label: 'Team 1'
				}, {
					data: [10, 20, 15, 30, 22],
					borderColor: '#716aca',
					backgroundColor: 'rgba(113, 106, 202, 0.25)',
					pointBackgroundColor: "#716aca",
					pointHoverRadius: 4,
					pointRadius: 3,
					label: 'Team 2'
				},
				]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend : {
					position: 'bottom'
				}
			}
		});

		var myBubbleChart = new Chart(bubbleChart,{
			type: 'bubble',
			data: {
				datasets:[{
					label: "Car", 
					data:[{x:25,y:17,r:25},{x:30,y:25,r:28}, {x:35,y:30,r:8}], 
					backgroundColor:"#716aca"
				},
				{
					label: "Motorcycles", 
					data:[{x:10,y:17,r:20},{x:30,y:10,r:7}, {x:35,y:20,r:10}], 
					backgroundColor:"#1d7af3"
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'bottom'
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}],
					xAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				},
			}
		});

		var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [{
					label: "Python",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [30, 45, 45, 68, 69, 90, 100, 158, 177, 200, 245, 256]
				},{
					label: "PHP",
					borderColor: "#59d05d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#59d05d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [10, 20, 55, 75, 80, 48, 59, 55, 23, 107, 60, 87]
				}, {
					label: "Ruby",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [10, 30, 58, 79, 90, 105, 117, 160, 185, 210, 185, 194]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});

		var myMultipleBarChart = new Chart(multipleBarChart, {
			type: 'bar',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets : [{
					label: "First time visitors",
					backgroundColor: '#59d05d',
					borderColor: '#59d05d',
					data: [95, 100, 112, 101, 144, 159, 178, 156, 188, 190, 210, 245],
				},{
					label: "Visitors",
					backgroundColor: '#fdaf4b',
					borderColor: '#fdaf4b',
					data: [145, 256, 244, 233, 210, 279, 287, 253, 287, 299, 312,356],
				}, {
					label: "Pageview",
					backgroundColor: '#177dff',
					borderColor: '#177dff',
					data: [185, 279, 273, 287, 234, 312, 322, 286, 301, 320, 346, 399],
				}],
			},
			options: {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position : 'bottom'
				},
				title: {
					display: true,
					text: 'Traffic Stats'
				},
				tooltips: {
					mode: 'index',
					intersect: false
				},
				responsive: true,
				scales: {
					xAxes: [{
						stacked: true,
					}],
					yAxes: [{
						stacked: true
					}]
				}
			}
		});

		// Chart with HTML Legends

		var gradientStroke = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
		gradientStroke.addColorStop(0, '#177dff');
		gradientStroke.addColorStop(1, '#80b6f4');

		var gradientFill = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
		gradientFill.addColorStop(0, "rgba(23, 125, 255, 0.7)");
		gradientFill.addColorStop(1, "rgba(128, 182, 244, 0.3)");

		var gradientStroke2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
		gradientStroke2.addColorStop(0, '#f3545d');
		gradientStroke2.addColorStop(1, '#ff8990');

		var gradientFill2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
		gradientFill2.addColorStop(0, "rgba(243, 84, 93, 0.7)");
		gradientFill2.addColorStop(1, "rgba(255, 137, 144, 0.3)");

		var gradientStroke3 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
		gradientStroke3.addColorStop(0, '#fdaf4b');
		gradientStroke3.addColorStop(1, '#ffc478');

		var gradientFill3 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
		gradientFill3.addColorStop(0, "rgba(253, 175, 75, 0.7)");
		gradientFill3.addColorStop(1, "rgba(255, 196, 120, 0.3)");

		var myHtmlLegendsChart = new Chart(htmlLegendsChart, {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [ {
					label: "Subscribers",
					borderColor: gradientStroke2,
					pointBackgroundColor: gradientStroke2,
					pointRadius: 0,
					backgroundColor: gradientFill2,
					legendColor: '#f3545d',
					fill: true,
					borderWidth: 1,
					data: [154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374]
				}, {
					label: "New Visitors",
					borderColor: gradientStroke3,
					pointBackgroundColor: gradientStroke3,
					pointRadius: 0,
					backgroundColor: gradientFill3,
					legendColor: '#fdaf4b',
					fill: true,
					borderWidth: 1,
					data: [256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521]
				}, {
					label: "Active Users",
					borderColor: gradientStroke,
					pointBackgroundColor: gradientStroke,
					pointRadius: 0,
					backgroundColor: gradientFill,
					legendColor: '#177dff',
					fill: true,
					borderWidth: 1,
					data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					display: false
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				},
				scales: {
					yAxes: [{
						ticks: {
							fontColor: "rgba(0,0,0,0.5)",
							fontStyle: "500",
							beginAtZero: false,
							maxTicksLimit: 5,
							padding: 20
						},
						gridLines: {
							drawTicks: false,
							display: false
						}
					}],
					xAxes: [{
						gridLines: {
							zeroLineColor: "transparent"
						},
						ticks: {
							padding: 20,
							fontColor: "rgba(0,0,0,0.5)",
							fontStyle: "500"
						}
					}]
				}, 
				legendCallback: function(chart) { 
					var text = []; 
					text.push('<ul class="' + chart.id + '-legend html-legend">'); 
					for (var i = 0; i < chart.data.datasets.length; i++) { 
						text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
						if (chart.data.datasets[i].label) { 
							text.push(chart.data.datasets[i].label); 
						} 
						text.push('</li>'); 
					} 
					text.push('</ul>'); 
					return text.join(''); 
				}  
			}
		});

		var myLegendContainer = document.getElementById("myChartLegend");

		// generate HTML legend
		myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

		// bind onClick event to all LI-tags of the legend
		var legendItems = myLegendContainer.getElementsByTagName('li');
		for (var i = 0; i < legendItems.length; i += 1) {
			legendItems[i].addEventListener("click", legendClickCallback, false);
		}

	</script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="../bower_components/ckeditor/ckeditor.js"></script>
	<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script>
	  $(function () {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('editor1')
		CKEDITOR.replace('editor2')
		CKEDITOR.replace('editor3')
		CKEDITOR.replace('editor4')
		//bootstrap WYSIHTML5 - text editor
		$('.textarea').wysihtml5()
	  })
	</script>
</body>
</html>