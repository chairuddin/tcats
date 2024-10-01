<?php
if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	$username=cleanInput($_POST['username']);
	$fullname=cleanInput($_POST['fullname']);
	$nickname=cleanInput($_POST['nickname']);
	$level=cleanInput($_POST['level']);
	$status=cleanInput($_POST['status']);
	$cabang=1;/*harcode*/
	
	if($action!="update")
	{
		$r_sql[]="username='$username'";
		if($username=="") {
			$log_error[]='Username harus diisi';	
		}
	}
	$r_sql[]="fullname='$fullname'";
	$r_sql[]="nickname='$nickname'";
	$r_sql[]="level='$level'";
	$r_sql[]="status='$status'";
	$password=$password2="";
	$r_update=array();
	$log_error=array();
	
	if($fullname=="") {
		$log_error[]='Nama lengkap harus diisi';	
	}
	if($nickname=="") {
		$log_error[]='Nama Panggilan harus diisi';	
	}
	if($level=="") {
		$log_error[]='Username harus diisi';	
	}
	if($_POST['password']!='' or $_POST['password2']!='')
	{
		
		$password=md5(sha1($_POST['password']));
		$password2=md5(sha1($_POST['password2']));
		if($password!=$password2)
		{
		$log_error[]='Password tidak sama';	
		}
		else
		{
		$r_sql[]="password='$password'";
		}
	}
	
	if($action=="update") {
		$sql=" UPDATE user SET ";
	} else {
		$sql=" INSERT INTO user SET ";		
	}
	
	$sql.=join(",",$r_sql);
	
	if($action=="update") {
		$sql.=" WHERE id=$id ";
	}
	$q=$mysql->query($sql);
	
	if($action=="save"){
		$id_user=$mysql->insert_id();
	}else {
		$id_user=$id;
	}
	/*
	//update cabang
	$hapus_cabang=$mysql->query("DELETE FROM hak_cabang WHERE id_user=$id_user ");
	if(count($cabang)>0) {
		foreach($cabang as $id_cabang) {
			//echo "INSERT INTO hak_cabang SET id_user=$id_user,id_cabang=$id_cabang <br/>";
			$insert_cabang=$mysql->query("INSERT INTO hak_cabang SET id_user=$id_user,id_cabang=$id_cabang");
		}
	} else {
		$log_error[]='Cabang harus dipilih';	
	}
	*/
	
	if($q and count($log_error)<=0){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." user berhasil",backendurl("$modul"));
		die();
	} else {
		$tambahan=join("<br/>",$log_error);
		sweetalert2($type="warning","$tambahan",backendurl("$modul/".($action=="save"?"add":"edit/$id")));
		die();
	}
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM user WHERE id='$id'";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus user berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Hapus user gagal",backendurl("$modul"));
	}
	
}

?>
