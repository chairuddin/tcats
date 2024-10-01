<?php
//error_reporting(E_ALL);
b_auto_load_css();
b_auto_load_js();
b_load_lib("YonaForm");
b_load_lib("PHPExcel/Classes/PHPExcel");
$large_pic=$config['userfiles']."/{$modul}/large";
$small_pic=$config['userfiles']."/{$modul}/small";
$small_url=$config['urlfiles']."/{$modul}/small";
$large_url=$config['urlfiles']."/{$modul}/large";

$maxfilesize = 5000000;
$max_width = 900;
$large_width = 900;
$thumb_width = 360;

$validation = new YonaValidation();
$form = new YonaForm();

$is_valid = true;
/*
if($_GET['id_po']!='') {
	$id_po=$_GET['id_po'];
	$q=$mysql->query("SELECT kode,tanggal_antar FROM master_po WHERE id=$id_po AND id_cabang=$id_cabang ");
	if($q and $mysql->num_rows($q)<=0) {
		$is_valid = false;
	} else {
	list($kode_po,$tanggal_antar) = $mysql->fetch_row($q);
	}
} else {
	$is_valid = false;
}

if(!$is_valid) {
	header("location:".backendurl("master_po"));
	die();
}
*/ 

$periode_awal=$tgl1=$_GET['periode_awal']!=''?$_GET['periode_awal']:date('Y-m-01');
$periode_akhir=$tgl2=$_GET['periode_akhir']!=''?$_GET['periode_akhir']:date('Y-m-d');

include "function.php";
include "model.php";
include "view.php";

$form->release_data();
?>
