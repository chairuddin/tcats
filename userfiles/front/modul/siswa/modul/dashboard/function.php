<?php

function icon_guru($guru_id) {
	 global $config;
		 $laki=array("avatar5.png");
		 $cewek=array("avatar3.png");
		 if($gender=='Cewek') {
			$icon=$cewek[0];
		 } else {
			$icon=$laki[0];
		 } 
	
	return "<img src=\"".$config['backendurl']."/template2/dist/img/$icon\" class=\"img-circle elevation-2\" alt=\"User Image\">";
}
function list_pengumuman() {
	global $mysql;
	$hari_ini = date("Y-m-d");
//	$batas_muncul = date("Y-m-d",strtotime(' -1 day',strtotime($hari_ini)));
	
	$q=$mysql->query(" SELECT p.id,u.fullname,p.tanggal,p.title,p.content,u.id guru_id FROM pengumuman p LEFT JOIN user u ON u.id=p.created_by WHERE '$hari_ini' BETWEEN tanggal AND tanggal_expired ORDER BY tanggal ASC ");
	$data = array();
	if($q AND $mysql->num_rows($q)>0) {
		while($d = $mysql->fetch_assoc($q)) {
				$data[]=$d;
		}
	}
	
	return $data;
}
function list_jadwal() {
	global $mysql,$biodata;
	$hari_ini = date("Y-m-d");
	$hari_ini_long = date("Y-m-d H:i:s");
	$class=$biodata['class'];
	
	$q=$mysql->query(" SELECT s.token,s.quiz_info,s.quiz_id,s.tanggal,s.tanggal_expired,d.is_done,d.quiz_duration  FROM 
	quiz_schedule s LEFT JOIN quiz_done d ON (d.schedule_id=s.id AND (d.member_code='".$biodata['member_code']."' OR d.member_id='".$biodata['id']."'))
	WHERE find_in_set('".$class."',s.allow_class)	 AND  ('$hari_ini' BETWEEN DATE_FORMAT(s.tanggal,'%Y-%m-%d') AND DATE_FORMAT(s.tanggal_expired,'%Y-%m-%d'))  AND (d.is_done IS NULL OR d.is_done<>1) ORDER BY s.tanggal ASC ");
	$data = array();
	if($q AND $mysql->num_rows($q)>0) {
		while($d = $mysql->fetch_assoc($q)) {
				$quiz_info=json_decode($d['quiz_info'],true);
				$quiz_info['is_done']=$d['is_done'];
				$quiz_info['quiz_duration']=$d['quiz_duration'];
				$d['info']=$quiz_info;
				$data[]=$d;
		}
	}
	return $data;
}
?>
