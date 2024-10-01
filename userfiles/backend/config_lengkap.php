<?php
date_default_timezone_set("Asia/Jakarta");
$config['default']="decoration";
$lang="id";
$list_lang=array("id");
$req_lang=array("id"=>0,"en"=>0); /*lang required*/
$lang=in_array($_SESSION['front_lang'],$list_lang)?$_SESSION['front_lang']:$lang;

$r_modul["decoration"]="Logo";
$r_modul["menu_layout"]="Atur Layout";
$r_modul["footer_layout"]="Atur Layout Footer";
$r_modul["quiz_ongoing"]="Antrian ujian saat ini";
$r_modul["quiz_result"]="Hasil Ujian";
$form_title=$r_modul[$modul];

?>
