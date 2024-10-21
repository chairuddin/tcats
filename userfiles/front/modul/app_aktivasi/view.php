<?php
$stamp=cleanInput($action);
$id_register=$mysql->get1value("SELECT id FROM app_register WHERE md5(concat('aktivasi_',id))='$stamp' AND status=0 ");
if($id_register>0) {

    list($data)=$mysql->query_data(" SELECT username,email,nama,wa,password FROM app_register WHERE md5(concat('aktivasi_',id))='$stamp' AND status=0 ");
    $now=date("Y-m-d H:i:s");
    $username = $data['username'];
    $email = $data['email'];
    $nama = $data['nama'];
    $wa= $data['wa'];
    $password= $data['password'];
    
    $register_to_quiz_member=$mysql->query("
    INSERT INTO quiz_member SET
    username='$username',
    password='$password',
    class='APPS',
    fullname='$nama',
    created_date='$now',
    status='1',
    email='$email',
    wa='$wa'
    ");

    if( $register_to_quiz_member) {
        $update_status=$mysql->query("UPDATE app_register SET status=1 WHERE id=$id_register ");
        $msg='Selamat akun anda berhasil diaktifkan, silakan login menggunakan email dan password yang didaftarkan.';
    } else {
         $msg='Gagal registrasi member, silakan hubungi admin';
    }
} else {
    $msg='Kode aktivasi tidak valid';
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
<title>Aktivasi</title>

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
				  <p class="login-box-msg">Aktivasi Akun</p>
				  <p><?php echo $msg;?></p>
                  <a class="btn btn-success btn-medium" href="<?=fronturl('app')?>">Login</a>
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
</body>
</html>
<?php
die();
//STOP LOADING MAIN TEMPLATE
?>
