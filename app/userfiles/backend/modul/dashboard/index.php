<?php
b_auto_load_css();
b_auto_load_js();
b_load_lib("YonaForm");
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
include "function.php";
include "action.php";
include "view.php";
$form->release_data();
?>
