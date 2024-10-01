<?php
function nama_kelas($nama_gabung){
	list($kelas)=explode("-",$nama_gabung);
	return trim($kelas);
}
function clean_quiz_title($title){
	$temp=str_replace("UJIAN HARI KEDUA SMA","",$title);
	$temp=str_replace("UJIAN HARI PERTAMA SMA","",$temp);
	$temp=str_replace("UJIAN","",$temp);
	$temp=str_replace("BAHASA","B.",$temp);
	$temp=str_replace("INDONESIA","IND",$temp);
	$temp=str_replace("MATEMATIKA","MTK",$temp);
	$temp=str_replace("INGGRIS","ING",$temp);
	$temp=str_replace("SMK","",$temp);
	return trim($temp);
}
?>
