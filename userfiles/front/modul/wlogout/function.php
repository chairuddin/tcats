<?php

	session_destroy();
	$bulan=(((60*60)*24)*30);
	setcookie(sha1('remember'),$d['authcode'],-$bulan,'/');
	header("location:".fronturl());
	exit();

?>
