<?php
//error_reporting(E_ALL);
b_auto_load_css();
b_auto_load_js();
b_load_lib("YonaForm");
b_load_lib("PHPExcel/Classes/PHPExcel");
$keyword="";
$orderurl="";


$hari_ini=date("Y-m-d H:i:s");
$admin_id=$_SESSION['s_id'];


$maxfilesize = 5000000;
$max_width = 250;
$large_width = 250;
$thumb_width = 100;

$max_page_list=50;
$validation = new YonaValidation();
$form = new YonaForm();

$field=array(
	'npsn'=>'NPSN',
	'status_pekerjaan'=>'Status Saat Ini',
	'nama_lengkap'=>'Nama Lengkap',
	'nama_panggilan'=>'Nama Panggilan',
	'kelamin'=>'Jenis Kelamin',
	'whatsapp'=>'Whatsapp',
	'email'=>'Email',
	'tanggal_lahir'=>'Tanggal Lahir',
	'agama'=>'Agama',
	'jabatan'=>'Jabatan',
	'tahun_menjabat'=>'Tahun Menjabat',

);


include "function.php";
include "action.php";
include "view.php";
$form->release_data();

?>
