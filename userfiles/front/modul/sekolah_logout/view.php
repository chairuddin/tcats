<?php
unset($_SESSION['f_id']);
unset($_SESSION['f_login']);
unset($_SESSION['f_username']);
unset($_SESSION['f_fullname']);
unset($_SESSION['f_status']);

if($_SESSION['f_id']==""){
	header("location:".fronturl(""));
	exit();
}
