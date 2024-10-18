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
<link rel="shortcut icon" href="<?php echo $config['backendurl'];?>/images/favicon.png"/>

<title>Halaman administrasi</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Custom style -->
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/dist/css/login.css?v=1">
<!-- Google Font: Source Sans Pro -->
<link href="<?php echo $config['backendurl'];?>/template2/dist/Source_Sans_Pro/font.css" rel="stylesheet">
</head>
<body  class="hold-transition login-page" id="login-page">
    		 
			 <div class="login-wrapper">
			  <img src="<?php echo $config['backendurl'];?>/images/logo.png" class="logo-login">
			  <h2>T-CATS : Training Center Competency Assessment and Training System</h2>
			  <!-- /.login-logo -->
			  <div class="form-wrapper">
				<div class="">

				  <form action="<?php echo backendurl("login/check")?>" method="post">
					<div class="mb-3">
				        <label for="username" class="form-label fw-bold">Username</label>
					    <input type="text" class="form-input" name="username" placeholder="">
					</div>
					<div class="mb-3">
			            <label for="username" class="form-label fw-bold">Password</label>
			            <div class="position-relative">
        					<input type="password" class="form-input" id="password" name="password" placeholder="">
        					<span id="togglePassword" class="eye-icon"><i class="fa fa-eye"></i></span>
			            </div>
					</div>
					
					<button type="submit" class="btn btn-primary btn-submit w-100">Login</button>
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
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $config['backendurl'];?>/template2/dist/js/adminlte.min.js"></script>
<script>
// Ambil elemen input dan ikon mata
const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

// Fungsi untuk toggle show/hide password
togglePassword.addEventListener("click", function () {
    // Cek tipe input saat ini
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    
    // Ganti tipe input
    passwordInput.setAttribute("type", type);
    
    // Ubah ikon mata (opsional, tergantung simbol atau font yang digunakan)
    if (type === "password") {
        togglePassword.innerHTML = "<i class='fa fa-eye'></i>"; // Ikon mata
    } else {
        togglePassword.innerHTML = "<i class='fa fa-eye-slash'></i>"; // Ikon mata dengan garis (misal)
    }
});
$('#modal-default').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var title = button.data('title') // Extract info from data-* attributes
  var body = button.data('body') // Extract info from data-* attributes
  var btn1 = button.data('btn1') // Extract info from data-* attributes
  var btn1name = button.data('btn1name') // Extract info from data-* attributes
  var btn2 = button.data('btn2') // Extract info from data-* attributes
  var btn2name = button.data('btn2name') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text(title)
  modal.find('.modal-body').text(body)
  modal.find('#btn1').attr("href",btn1)
  modal.find('#btn1name').text(btn1name)
  
  if(btn2=='') {
	modal.find('#btn2').hide();
  } else {
	modal.find('#btn2').attr("href",btn2)
	modal.find('#btn2name').text(btn2name)
  }
  
//  modal.find('.modal-body input').val(recipient)
})

<?php 
if($_SESSION['msg_toast']!="") {
	echo $_SESSION['msg_toast'];
	unset($_SESSION['msg_toast']);
}
?>
</script>
  <?php echo $script_js;?>
</body>
</html>


			
			
