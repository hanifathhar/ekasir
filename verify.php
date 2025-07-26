<?php
if($_POST['submit']){
include("page/config/config.php");
$u = htmlspecialchars($_POST['username'], ENT_QUOTES);
$p = htmlspecialchars($_POST['password'], ENT_QUOTES);
$p = md5($p);


	$sqlcek1 = mysqli_query($conn,"SELECT * FROM admin WHERE username='$u'");
	$key1 = mysqli_num_rows($sqlcek1);
	$sqlcek2 = mysqli_query($conn,"SELECT * FROM admin WHERE username='$u' and password='$p'");
	$key2 = mysqli_num_rows($sqlcek2);
	
	
	if($key1<1){
		 $msg ="<div class=\"form-group\">
							<div class=\"alert alert-danger\">
								<a>Usernama Masih Salah</a>
							</div>
						</div>";
	}else
	if($key2<1){
		 $msg ="<div class=\"form-group\">
							<div class=\"alert alert-danger\">
								<a>Password Masih Salah</a>
							</div>
						</div>";
	}else{
	
		$baca = mysqli_query($conn,"select a.* from admin a where a.username='$u' and a.password='$p'");
		$jml = mysqli_num_rows($baca);
	
		if($jml==1){
			while($field=mysqli_fetch_array($baca)){
				session_start();
				
	
				$_SESSION['username']=$u;
				$_SESSION['password']=$p;
				
				$_SESSION['level']=$field['level'];
				$_SESSION['grup']=$field['id_grup'];
				$_SESSION['nmgrup']=$field['nm_grup'];
				$_SESSION['id']=$field['id'];
				$_SESSION['nik']=$field['nik'];
				$_SESSION['telp']=$field['no_telp'];
				$_SESSION['email']=$field['email'];
				$_SESSION['nama']=$field['nm_pengguna'];
				
				$_SESSION['cabang']=$field['kd_cabang'];
				$_SESSION['nmcabang']=$field['nm_cabang'];
				
				
				
				if(strtoupper($_POST['captcha']) == $_SESSION['captcha_id']){
				
					  echo "<script>
								document.location='page/welcome.php?modul=dashboard&aksi=view'
							</script>\n";
							
				}else{
				
					 $msg ="<div class=\"form-group\">
										<div class=\"alert alert-danger\">
											<a>Kode Captcha Salah</a>
										</div>
									</div>";
				
				
				}
				
			
						   
			}
				session_register('u');
				session_register('p');
				session_register('t');
			
		}
		else
		{
			
			echo "<script>document.location='index.php?act=0'</script>\n";
		}
	
	}
	
}

?>