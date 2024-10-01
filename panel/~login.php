<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/css/bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo $config['backendurl'];?>/template/css/themes.css">


	<!-- jQuery -->
	<script src="<?php echo $config['backendurl'];?>/template/js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo $config['backendurl'];?>/template/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="<?php echo $config['backendurl'];?>/template/js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo $config['backendurl'];?>/template/js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo $config['backendurl'];?>/template/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo $config['backendurl'];?>/template/js/bootstrap.min.js"></script>
	<script src="<?php echo $config['backendurl'];?>/template/js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="<?php echo $config['backendurl'];?>/template/js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo $config['backendurl'];?>/template/login/images/favicon.png" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		
		<h1><a href="index.html"><img src="<?php echo $config['backendurl'];?>/template/login/images/logo-warna.png" alt="" class='retina-ready' width="50%" ></a></h1>
		<div class="login-body">
			<h2>SIGN IN</h2>
			<form action="<?php echo backendurl("login/check")?>" method='post' class='form-validate' id="test">
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='username' placeholder="Username" class='input-block-level' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="password" placeholder="Password" class='input-block-level' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					<div class="remember">
						
					</div>
					<input type="submit" value="Login" class='btn btn-primary'>
				</div>
				<div class="">
				<a href="#">&nbsp;</a>
				</div>
			</form>
			
		</div>
	</div>
</body>

</html>
