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

<title>Halaman administrasi</title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="<?php echo $config['backendurl'];?>/template2/dist/Source_Sans_Pro/font.css" rel="stylesheet">
</head>
<body  class="hold-transition login-page">
    		 
			 <div class="login-box">
			  <div class="login-logo">
				Login Admin / Pengawas
			  </div>
			  <!-- /.login-logo -->
			  <div class="card">
				<div class="card-body login-card-body">
				  <p class="login-box-msg">Sign in to start your session</p>

				  <form action="<?php echo backendurl("login/check")?>" method="post">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="username" placeholder="Username">
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-user"></span>
						</div>
					  </div>
					</div>
					<div class="input-group mb-3">
					  <input type="password" class="form-control" name="password" placeholder="Password">
					  <div class="input-group-append">
						<div class="input-group-text">
						  <span class="fas fa-lock"></span>
						</div>
					  </div>
					</div>
					<div class="row">
					  <div class="col-8">
						<div class="icheck-primary">
						  
						</div>
					  </div>
					  <!-- /.col -->
					  <div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/select2/js/select2.full.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo $config['backendurl'];?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $config['backendurl'];?>/template2/dist/js/adminlte.min.js"></script>
<script>
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


			
			
