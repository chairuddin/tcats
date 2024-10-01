<?php
//fungsi ini dipake untuk fungsi fungsi khusus projek ini saja. silahkan dihapus untuk project baru


function data_hasil_tes() {
	$option_tes[1]="Negatif";
	$option_tes[2]="Positif";
	return $option_tes;
}
function get_hasil_tes($id) {
	$option_tes=data_hasil_tes();
	return $option_tes[$id];
}

function data_jenis_nota() {
	$option_jenis[1]="Quizroom";
	$option_jenis[2]="Websuka";
	return $option_jenis;
}
function get_jenis_nota($id) {
	$option_jenis=data_jenis_nota();
	return $option_jenis[$id];
}
function data_jenis_kelamin() {
	$option_jenis_kelamin[1]="Laki-laki";
	$option_jenis_kelamin[2]="Perempuan";
	return $option_jenis_kelamin;
}
function get_jenis_kelamin($id) {
	$option_jenis=data_jenis_kelamin();
	return $option_jenis[$id];
}
?>