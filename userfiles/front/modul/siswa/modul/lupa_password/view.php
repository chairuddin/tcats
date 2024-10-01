<?php
if($_POST['reset_password']) {
	b_load_lib('Login');
	$email=cleanInput($_POST['email']);
	$login = new Login();
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		sweetalert2($type="warning",$msg="Email tidak valid",fronturl("siswa/lupa_password"));
	} else {
		$request=$login->request_reset($email);
		if($request) {
			sweetalert2($type="success",$msg="Silahkan cek email anda untuk melakukan reset password",fronturl("siswa/lupa_password"));
		} else {
			sweetalert2($type="warning",$msg="Reset password gagal",fronturl("siswa/lupa_password"));
		}
	}
	
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="shortcut icon" href="<?php echo favicon();?>?<?php echo uniqid();?>"/>
<title>Reset Password</title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="<?php echo $config['backendurl'];?>/template2/dist/Source_Sans_Pro/font.css" rel="stylesheet">
<style>
.login-logo img {
    max-height: 140px;
}
.login-box, .register-box {
    width: 360px;
    padding: 20px;
    background-color: white;
}
.login-page, .register-page {
    background: <?php echo $color_1;?>;
}

</style>
</head>
<body  class="hold-transition login-page">
    		 
			 <div class="login-box">
			  <div class="">
				<div class="card-body login-card-body">
				  <p class="login-box-msg">Lupa Password</p>
				  <p>Silahkan masukkan email yang anda gunakan saat registrasi.</p>
				  <form action="<?php echo fronturl("siswa/lupa_password")?>" method="post">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="email" placeholder="example@youremail.com">
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					
					<div class="row">
					  <div class="col-4">
					
					  </div>
					  <!-- /.col -->
					  <div class="col-8">
						<button type="submit" name="reset_password" value="1" class="btn btn-primary btn-block">Reset Password</button>
					  </div>
					
					  <!-- /.col -->
					</div>
				  </form>

		
				
				</div>
				<!-- /.login-card-body -->
			  </div>
			</div>
			<!-- /.login-box -->



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo $config['backendurl'];?>/template2/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $config['backendurl'];?>/template2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $config['backendurl'];?>/template2/dist/js/adminlte.min.js"></script>
<script>
<?php 

if($_SESSION['msg_toast']!="") {
	echo $_SESSION['msg_toast'];
	unset($_SESSION['msg_toast']);
}
?>
</script>
  <?php echo $script_js;?>
<script>
$(document).ready(function(){
	/*22 juni 2020 bugfix cookies dan localstorage tidak enabled*/
	if (navigator.cookieEnabled) {
		
	} else 
	{
		need_cookies=1;
	}
	if(need_cookies==1) {
		setTimeout(function(){
		Swal.fire({
			  title: 'Memerlukan Cookie',
			  text: "Cookie tidak diaktifkan pada browser Anda. Untuk melanjutkan ujian, aktifkan cookie dalam preferensi browser.",
			  icon: 'error',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'OK',
			}).then((result) => {
			  
			});
		},1000);
	}
	});
</script>
</body>
</html>
<?php
die();
//STOP LOADING MAIN TEMPLATE 
?>
