<?php
if($action=="check")
{
$ulogin=md5($_POST['username']);
$password=md5(sha1($_POST['password']));
$r=$mysql->query("SELECT id,username,fullname,level,status FROM user WHERE (md5(username)='$ulogin' or md5(email)='$ulogin') and  password='$password' and status=1");
if($r and $mysql->numrows($r)==1)
{	
	list($s_id,$s_username,$s_fullname,$s_level,$s_status)=$mysql->row($r);
	$_SESSION['s_id']=$s_id;
	$_SESSION['s_login']=true;
	$_SESSION['s_username']=$s_username;
	$_SESSION['s_fullname']=$s_fullname;
	$_SESSION['s_level']=$s_level;
	$_SESSION['s_status']=$s_status;
	$r=$mysql->query("UPDATE user SET lastlogin=now() WHERE id=$s_id");
	header("location:".backendurl());
	exit();
}
else
{
	sweetalert2("warning"," Gunakan Username dan Password yang benar!");
	//$_SESSION['msg_warning']=_USERNAMEPASSWORDSALAH;
	header("location:".backendurl());
	exit();
//$msg_warning=_USERNAMEPASSWORDSALAH;
}

}

?>
