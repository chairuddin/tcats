<?php
$modul=$_GET['seg2'];
$action=$_GET['seg3'];
$id=$_GET['seg4'];
$file_dir=__DIR__;

if($modul!='login' AND $modul!='lupa_password' AND $modul!='reset_password') {
	siswa_harus_login();
}
$biodata=get_login_session();
ob_start();
if(file_exists("$file_dir/modul/$modul/view.php")){
	include "$file_dir/modul/$modul/view.php";
} else {
	include "$file_dir/modul/dashboard/view.php";
}

$maincontent=ob_get_clean();
?>
