<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>E-Kasir</title>
  <!-- plugins:css -->
  
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style1.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/img/ek-lg-1.png">
  
</head>


<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image:url(assets/img/bg.jpeg); no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;">
        <div class="row w-100 mx-0">
          <div class="col-lg-3 mx-auto" style="background-color:">
            <div class="auth-form-light text-center py-5 px-4 px-sm-10">
              <div class="brand-logo">
			      <img src="assets/img/ek.png" alt="logo" style="width:120px; height:120px;">
			  </div>
				  <?php
				   include("verify.php");
				   echo "<div class=\"form-group row\">";
				   echo "<div class=\"col-sm-12\">";
				   echo "$msg";
				   echo "</div>";
				   echo "</div>";
				  ?>
              
              <form class="pt-3" method="post" action="">
                <div class="form-group  row">
				<div class="col-sm-12">
                  <input type="text" class="form-control form-control"  placeholder="Username" name="username"
				  style="background:#000033;border:1.7px solid #aaa;border-radius:8px;padding:18px;color:#FFFFFF;font-size:12px; text-align:left;box-shadow:0px 0px 0px #aaa;">
                </div>
				</div>
                <div class="form-group row">
				<div class="col-sm-12">
                  <input type="password" class="form-control form-control" placeholder="Password" name="password" id="password"
				  style="background:#000033;border:1.7px solid #aaa;border-radius:8px;padding:18px;color:#FFFFFF;font-size:12px; text-align:left;box-shadow:0px 0px 0px #aaa;">
                </div>
			    </div>
				 <div class="form-group row" style="text-align:left">
				<div class="col-sm-12">
                  <input type="checkbox" onClick="showHide()"><span style='width:100%; font-size:12pt; font-family:calibri; border-collapse: collapse;'> Tampilkan Password</span>
                </div>
			    </div>
				
				<div class="form-group row">
					<div class="col-sm-6">
						<div id="captcha_image"><img src="page/images/image.php" width="180" height="48" alt="Captcha image"></div>
					</div>
					<div class="col-sm-6">
						<input class="form-control form-control" type="text" name="captcha" placeholder="Captcha"  maxlength="6" 
				         style="background:#000033;border:1.7px solid #aaa;border-radius:8px;padding:18px;color:#FFFFFF;font-size:12px; text-align:center;box-shadow:0px 0px 0px #aaa;">
					</div>
				</div>
				
                <div class="form-group row">
				<div class="col-sm-12">
				<button type="submit" name="submit" value="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> Masuk Sekarang</button>
                </div>
				</div>
                
              </form>
			  <div class="card-action" align="left">
				  <?php
				    include("page/config/config.php");
				    $csql = mysqli_query($conn,"SELECT * FROM ms_profil");
					$company = mysqli_fetch_array($csql);
					$nmclient = $company['company'];
					$alamat = $company['alamat'];
				    echo "<div class=\"alert alert-primary\">";
				    echo"<table style='width:100%; font-size:9pt; font-family:calibri; border-collapse: collapse;' border = '0'>
							<td width='100px' align='left' style='padding-right:80px; vertical-align:top'>
								<span style='font-size:12pt'><b>$company[company]</b></span><br>
								<span style='font-size:9pt'>$company[alamat]</span><br>
								<span style='font-size:9pt'>Telp: $company[no_telp]</span><br>
								<span style='font-size:9pt'>Email: $company[email]</span>
							</td>
						</table>";
				    echo "</div>";
				  ?>
			  </div>
            </div>
			
          </div>
        </div>
		
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script>
	function showHide() {
	var inputan = document.getElementById("password");
	if (inputan.type === "password") {
		inputan.type = "text";
	} else {
		inputan.type = "password";
	}
	} 
  </script>
  <!-- endinject -->
</body>

</html>
