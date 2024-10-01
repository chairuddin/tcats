<?php
if($_SESSION['f_id']!=""){
	header("location:".fronturl("sekolah_dashboard"));
	exit();
}
?>
<div class="container">
<div class="login-form">
<div class="main-div">
<div class="panel">
<h2>Login Guru</h2>
<p>Silahkan masukkan ID and password</p>
</div>
<?php
if($_SESSION['msg_warning']!=""){ 
echo '
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>
  '.$_SESSION['msg_warning'].'
</div>';
}
?>
<form id="Login" method="post">
<div class="form-group">
	<input type="text" class="form-control" id="inputEmail" name="sekolah_id" placeholder="ID Sekolah">
</div>
<div class="form-group">
	<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
</div>
<div class="forgot">
	
</div>
<button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
</div>
</div>
</div>

