<?php
function status_ujian($is_done) {
	$status='';
	$is_done==3?$status="Belum Selesai":'';
	$is_done==1?$status="Selesai":'';
	$is_done==0?$status="Belum Selesai":'';
	return $status;
}
function list_riwayat() {
	global $mysql,$biodata;
	$hari_ini = date("Y-m-d");
	$hari_ini_long = date("Y-m-d H:i:s");
	$member_id=$biodata['id'];
	$member_code=$biodata['username'];
	
	$q=$mysql->query(" SELECT id,token,quiz_title_id,quiz_id,score,score_essay,check_point,is_done FROM quiz_done WHERE (member_code='$member_code' OR member_id='$member_id') ORDER BY check_point DESC  ");
	$data = array();
	if($q AND $mysql->num_rows($q)>0) {
		while($d = $mysql->fetch_assoc($q)) {
			$data[]=$d;
		}
	}
	return $data;
}
?>
