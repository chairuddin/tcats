<?php

$data_login=get_login_session();

//jika sedang login dan mengakses /login maka lakukan pengecekan 
if($data_login['username']!='') {
	$q=$mysql->query("SELECT id,username,class,jurusan,ruang,fullname FROM quiz_member WHERE username='".$data_login['username']."' AND status=1");
	$ismember=false;
	if($q and $mysql->numrows($q)>0)
	{
		header("location:".fronturl("siswa/dashboard"));
		exit();
	}
}

if($_POST['do_login']==1) {
	set_logout_session();
	$username=md5(cleanInput($_POST['username']));
	$password=md5("quizroom_".$_POST['password']);
	
	$q=$mysql->query("SELECT id,username,class,jurusan,ruang,fullname,md5(password) password,foto FROM quiz_member WHERE (md5(username)='$username' OR md5(email)='$username' ) AND password='$password' AND status=1");
	$ismember=false;
	if($_POST['password']!='' AND $q and $mysql->numrows($q)>0)
	{
		$data_member=$mysql->assoc($q);	
		$ismember=true;
		set_login_session($data_member);
		header("location:".fronturl("siswa/dashboard"));
		exit();
	}
	else
	{
		
		sweetalert2("warning"," Gunakan Username dan Password yang benar!");
		//,fronturl("siswa/login")
		$r_msg_warning[]="Gunakan Username dan Password yang benar!";
	}
}

?>
