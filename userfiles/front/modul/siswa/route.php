<?php
$modul=$_GET['seg2'];
$action=$_GET['seg3'];
$id=$_GET['seg4'];
$file_dir=__DIR__;

$url_images=fileurl("quiz_member");
$url_images_large=$url_images."/source";

$path_images=filepath("quiz_member");
$path_images_large=$path_images."/source";


if($modul!='login' AND $modul!='lupa_password' AND $modul!='reset_password') {
	siswa_harus_login();
}
$biodata=get_login_session();
list($biodata_fullname,$biodata_asal_instansi,$biodata_alamat,$biodata_foto)=$mysql->fetch_row($mysql->query("SELECT fullname,asal_instansi,alamat,foto FROM quiz_member WHERE id=".$biodata['id']));

if($biodata_foto!="") {
	if(file_exists($path_images_large."/".$biodata_foto)) {
		$biodata_foto='<img src="'.$url_images_large.'/'.$biodata_foto.'" class="img-responsive"/><br/>';
	}
}

ob_start();
if(file_exists("$file_dir/modul/$modul/view.php")){
	include "$file_dir/modul/$modul/view.php";
} else {
	include "$file_dir/modul/dashboard/view.php";
}

$maincontent=ob_get_clean();
?>
