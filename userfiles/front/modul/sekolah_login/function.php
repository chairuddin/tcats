<?php
if(!$web_config_allow_teacher){
	header("location:".fronturl());
	exit();
}
define(_USERNAMEPASSWORDSALAH,"ID dan Password Salah");
if($_POST['sekolah_id']!="" and $_POST['password']!="")
{
$ulogin=md5($_POST['sekolah_id']);
$password=md5(sha1($_POST['password']));

$r=$mysql->query("SELECT id,username,fullname,status FROM quiz_school WHERE md5(username)='$ulogin' and  password='$password' and status=1");
if($r and $mysql->numrows($r)==1)
{	
	list($s_id,$s_username,$s_fullname,$s_status)=$mysql->row($r);
	$_SESSION['f_id']=$s_id;
	$_SESSION['f_login']=true;
	$_SESSION['f_username']=$s_username;
	$_SESSION['f_fullname']=$s_fullname;
	$_SESSION['f_status']=$s_status;
	
	$r=$mysql->query("UPDATE quiz_school SET lastlogin=now() WHERE id=$s_id");
	header("location:".fronturl("sekolah_dashboard"));
	exit();
}
else
{
	$_SESSION['msg_warning']=_USERNAMEPASSWORDSALAH;
	header("location:".fronturl("sekolah_login"));
	exit();
//$msg_warning=_USERNAMEPASSWORDSALAH;
}
}
?>
