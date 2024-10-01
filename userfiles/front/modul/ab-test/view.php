<?php
die();
/*
  
 * */
$r_msg_warning=array();
/*
 *menyimpan ip address menggunakan chrome bentuk ipadress jadi kacau
 *tampilkan ip address di antrian ujian untuk melakukan pengecekan apakah perserta ujian menggunakan komputer yang masuk di jaringan yang disediakan 
 */
$hariini=date("Y-m-d");
$hariini_long=date("Y-m-d H:i:s");


	$username="tester";
	$kode_soal="MTK-XII-A";
	$schedule_id=3;
	//KONVERSI KE MD5
	

	$q=$mysql->query("SELECT * FROM quiz_member WHERE username='$username'");
	$ismember=false;
	$issoal=false;
	if($q and $mysql->numrows($q)>0)
	{
		$data_member=$mysql->assoc($q);			
		$ismember=true;
	}
	else
	{
		$r_msg_warning[]="<Gunakan kode peserta yang benar!";
	}
	$is_expired=true;
	/*
	$q=$mysql->query("
	SELECT * FROM quiz_schedule WHERE 
	md5(md5(md5(id)))='".md5(md5(md5($schedule_id)))."' 
	AND '$hariini_long' >= tanggal 
	AND '$hariini_long' <= tanggal_expired	
	AND (find_in_set('".$data_member['class']."',allow_class) OR find_in_set('ALL',allow_class))
	AND is_deleted<>1
	AND id NOT IN(SELECT DISTINCT schedule_id  FROM quiz_done 	WHERE member_id='".$data_member['id']."' and schedule_id IS NOT NULL )
	");
	*/ 
	$q=$mysql->query("
	SELECT * FROM quiz_schedule WHERE 
	md5(md5(md5(id)))='".md5(md5(md5($schedule_id)))."' 
	AND '$hariini_long' >= tanggal 
	AND '$hariini_long' <= tanggal_expired	
	AND (find_in_set('".$data_member['class']."',allow_class) OR find_in_set('ALL',allow_class))
	AND is_deleted<>1
	");


	if($q and $mysql->numrows($q)>0)
	{
	$data_schedule=$mysql->assoc($q);	
	$is_expired=false;
	
		$q=$mysql->query("SELECT * FROM quiz_master WHERE code='$kode_soal'");
		if($q and $mysql->numrows($q)>0)
		{
			$data_quiz=$mysql->assoc($q);
			$issoal=true;
		}
		else
		{
			$r_msg_warning[]="Gunakan kode soal yang benar!";
		}
		if($ismember and $issoal and !$is_expired)
		{
			
		/*ACAK SOAL*/
		
		$r_acak=array();
		$r_acak_pilihan=array();
		$q=$mysql->query("SELECT id FROM quiz_detail WHERE quiz_id='".$data_quiz['id']."' ORDER BY id ASC");
		if($q and $mysql->numrows($q)>0)
		{
			while($v=$mysql->assoc($q))
			{
				$r_acak[]=$v['id'];
				$urutan_pilihan=array("A","B","C","D","E");
				if($data_quiz['is_random_option']){
				shuffle($urutan_pilihan);
				}
					$r_acak_pilihan[$v['id']]=$urutan_pilihan;
			}
		}
		if($data_quiz['is_random'])
		{
		shuffle($r_acak);
		}
		$acak=join($r_acak,",");
		$acak_pilihan=json_encode($r_acak_pilihan);
		/*END ACAK SOAL*/
		$start_time_real=date("Y-m-d H:i:s");	
		$start_time=$start_time_real;	
		if($data_schedule['is_late'])
		{
		$start_time=$data_schedule['tanggal'];		
		}
		$string="
		INSERT INTO quiz_done (member_id,token,member_code,member_class,member_fullname,quiz_id,schedule_id,quiz_duration,quiz_title_id,quiz_code,start_time,start_time_real,acak,acak_pilihan,ip_address,score_master,kkm,browser_key)
		SELECT * FROM(SELECT '".$data_member['id']."' A,'".$token_asli."' B,'".$data_member['username']."' C,'".$data_member['class']."' D,'".addslashes($data_member['fullname'])."' E,'".$data_quiz['id']."' F,'".$data_schedule['id']."' G,'".$data_quiz['duration']."' H,'".$data_quiz['title_id']."' I,'".$data_quiz['code']."' J,'$start_time' K,'$start_time_real' L,'$acak' M,'$acak_pilihan' N,'".$_SERVER['REMOTE_ADDR']."' O,".$data_quiz['score']." P,".$data_quiz['kkm']." Q,'$browser_key' R) a
		WHERE 
		NOT EXISTS (SELECT token FROM quiz_done WHERE token='".$token_asli."')
		AND NOT EXISTS (SELECT schedule_id  FROM quiz_done 	WHERE member_id='".$data_member['id']."' and schedule_id='".$data_schedule['id']."' )
		";
		$q=$mysql->query("
		INSERT INTO log(log) values('".addslashes($string)."')
		");
		
		
		
		//reset all cookie first
		if(count($_COOKIE)>0)
		{
			foreach($_COOKIE as $i =>$v)
			{
				if($i!="PHPSESSID"){
				setcookie($i,"",-1,"/");
				}

			}
		}
		
		//renew cookie 
		//$bulan=(((60*60)*24)*30);
			$bulan=(($data_quiz['duration']+5)*60);
		setcookie("quiz_token",$token_asli,time()+$bulan,"/");
		header("location:".fronturl("quiz_start"));
		exit();
		}
	
	
	}else
	{
		$r_msg_warning[]="Ujian sudah kadaluwarsa";
	
	}
	
