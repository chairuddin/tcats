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
	'lembaga_jenis'=>'Lembaga Jenis',
	'npsn'=>'NPSN',
	'npyp'=>'NPYP',
	'kode'=>'KODE',
	'lembaga_nama'=>'Nama Lembaga',
	'lembaga_jenjang'=>'Jenjang Lembaga',
	'lembaga_status'=>'Status Lembaga ',
	'lembaga_alamat'=>'Alamat Lembaga ',
	'lembaga_telp'=>'Telp Lembaga',
	'lembaga_email'=>'Email Lembaga',
	'lembaga_jenis'=>'Lembaga Jenis',
	'lembaga_website'=>'Website Lembaga',
	'lembaga_kota'=>'Kota Lembaga',
	'lembaga_tahun_berdiri'=>'Tahun Berdiri Lembaga',
	'pic_nama_lengkap'=>'Nama PIC',
	'pic_nama_panggilan'=>'Panggilan PIC',
	'pic_kelamin'=>'Kelamin PIC',
	'pic_whatsapp'=>'Whatsapp PIC',
	'pic_email'=>'Email PIC',
	'pic_tanggal_lahir'=>'Tanggal Lahir PIC',
	'pic_agama'=>'Agama PIC',
	'pic_jabatan'=>'Jabatan PIC',
	'pic_tahun_menjabat'=>'Tahun Menjabat PIC',

);


include "function.php";
include "action.php";
include "view.php";
$form->release_data();
?>
