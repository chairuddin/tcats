<?php
function list_soal_id(){
	$jadwal=list_jadwal();
		$quiz_id=array();
		if(count($jadwal)>0){
			
			foreach($jadwal as $i =>$data){
				if(!in_array($data['quiz_id'],$quiz_id)){
					$quiz_id[]=$data['quiz_id'];
				}
				
			}
			
		}
	return $quiz_id;	
}
function list_soal($mid=""){
	global $mysql;
	$data=array();

	if($mid==""){
		$jadwal=list_jadwal();
		$quiz_id=array();
		if(count($jadwal)>0){
			foreach($jadwal as $i =>$data_jadwal){
				$quiz_id[$data_jadwal['quiz_id']]=$data_jadwal['quiz_id'];
			}
			
		}
		
		$join_id=join(",",$quiz_id);
		$data=array();
		if(count($quiz_id)>0){
			$q=$mysql->query(" SELECT id, code, title_id, duration, kkm, score, is_random, is_random_option, is_listening, created_by FROM quiz_master WHERE id IN($join_id) ORDER by id ");	
			if($q and $mysql->numrows($q)>0){
				while($d=$mysql->assoc($q)){
					$data[]=$d;
				}
			}
		}
		
	}else{
		$q=$mysql->query("SELECT id, code, title_id, duration, kkm, score, is_random, is_random_option, is_listening, created_by FROM quiz_master WHERE id=$mid ORDER by id");	
		if($q and $mysql->numrows($q)>0){
			while($d=$mysql->assoc($q)){
				$data[]=$d;
			}
		}
	
	}
	
	
	
	return $data;
}
function list_jadwal(){
	global $mysql;
	$now=date("Y-m-d");
	$q=$mysql->query("
	SELECT 
		id,
		tryout_id,
		quiz_id,
		quiz_info,
		allow_class,
		tanggal,
		tanggal_expired,
		is_late,
		max_late,
		created_by,
		created_date,
		modified_by,
		modified_date,
		ket,
		is_deleted
	FROM quiz_schedule	
	WHERE DATE_FORMAT(tanggal,'%Y-%m-%d')>='$now'
	");	
	
	$data=array();
	if($q and $mysql->numrows($q)>0){
		while($d=$mysql->assoc($q)){
			$data[]=$d;
		}
	}
	
	return $data;
}
function list_member(){
	global $mysql;
	$q=$mysql->query("
	SELECT
		id,
		username,
		class,
		jurusan,
		ruang,
		fullname,
		status,
		lastmodify
	FROM 
	quiz_member	
	");	
	
	$data=array();
	if($q and $mysql->numrows($q)>0){
		while($d=$mysql->assoc($q)){
			$data[]=$d;
		}
	}
	return $data;
}

function download_soal($mid=""){
	global $mysql;
	$data=list_soal($mid);
	$detail_r=array();
	foreach($data as $i =>$d ){
		$q=$mysql->query("SELECT id, question, quiz_id, A, B, C, D, E, answer, model,urutan FROM quiz_detail WHERE quiz_id=".$d['id']);
		if($q and $mysql->numrows($q)>0){
			while($detail=$mysql->assoc($q)){
				$detail_r[$d['id']][]=$detail;
			}
		}
	}
	return $detail_r;
}

function download_soal_id(){
	global $mysql;
	$data=list_soal($mid);
	$detail_r=array();
	foreach($data as $i =>$d ){
		$q=$mysql->query("SELECT id, question, quiz_id, A, B, C, D, E, answer, model,urutan FROM quiz_detail WHERE quiz_id=".$d['id']);
		if($q and $mysql->numrows($q)>0){
			while($detail=$mysql->assoc($q)){
				$detail_r[$d['id']][]=$detail;
			}
		}
	}
	return $detail_r;
}

function scandir_soal($mid=""){
	global $mysql;
	$data=list_soal($mid);
	$daftar_gambar=array();
	foreach($data as $i =>$d ){
		//scan direktory soal
		$user=$mysql->get1value("SELECT username FROM user WHERE id=".$d['created_by']);
		$path=filepath("media/source/$user/dir_".$d['id']);
		//$url=fileurl("media/source/$user/dir_".$d['id']);
		$url="media/source/$user/dir_".$d['id'];
		//http://localhost/quiz/userfiles/file/quiz
		if(file_exists($path)){
			$files=scandir($path);
			if(count($files)>0){
				foreach($files as $x => $filename){
					if(file_exists("$path/$filename") and !is_dir("$path/$filename")){
						$daftar_gambar[$d['id']][]=$url."/$filename";
					}
				}
			}
			
		}
		 
		
	}
	return $daftar_gambar;
	//print_r($daftar_gambar);
}

?>
