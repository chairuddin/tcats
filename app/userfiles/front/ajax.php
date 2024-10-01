<?php
function auto_save($token)
{
	
	global $mysql;
	if($token!="")
	{
		
		$q=$mysql->query("SELECT id,quiz_id,acak,score_master,custom_score,poin_benar,poin_salah,poin_kosong,poin_A,poin_B,poin_C,poin_D,poin_E FROM quiz_done WHERE token='$token' and is_done=0");
		if($q and $mysql->numrows($q)>0)
		{
			
			ob_start();
			$member_data=$mysql->assoc($q);
			
			//$q=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id='".$member_data['quiz_id']."'");
			//include(path_to_soal_json($member_data['quiz_id']));
			//$r_json_soal=json_decode(trim($soal_json),true);
			
			
		
			if($_GET['akhiri_ujian']==1){
				$r_json_soal=get_soal_json($member_data['quiz_id']);
				if(count($r_json_soal['soal_ganda'])>0)
				{
					
					$benar=0;
					$salah=0;
					$tidak_jawab=0;
					$total_quiz=0;
					$r_jawaban=array();
					$no=0;
					$score_sbmptn=array();
					//while($d=$mysql->assoc($q))
					foreach($r_json_soal['soal_ganda'] as $d)
					{
						$no++;
						$total_quiz++;
						//$jawaban=$_POST['soal_'.md5($d['id'])];
						$jawaban=$_POST['soal_'.$d['id']];
						if($member_data['custom_score']==2){
							$score_sbmptn[]=$member_data["poin_".$jawaban];
						}else{
							
							$r_jawaban[$no]=$jawaban;
							if($jawaban!="" AND $jawaban==$d['answer'])
							{
								$benar++;
							}
							elseif($jawaban!="" AND $jawaban!=$d['answer'])
							{
								$salah++;
							}
							else
							{
								$tidak_jawab++;
							}
						}
						
					
					}
				}
			$answer=json_encode($r_jawaban);
			
			if($member_data['custom_score']==1){				
				$score=($benar*$member_data['poin_benar'])+($salah*$member_data['poin_salah'])+($tidak_jawab*$member_data['poin_kosong']);	
			}elseif($member_data['custom_score']==0){
				$bobot=$member_data['score_master']/$total_quiz;
				$score=round($benar*$bobot,2);	
			}elseif($member_data['custom_score']==2){
				$score=array_sum($score_sbmptn);
			}
			
			}
			
			$r_acak_id=explode(",",$member_data['acak']);
			$r_jawaban_temp=array();
			$nomor=1;
			foreach($r_acak_id as $id_acak){
			//$r_jawaban_temp[$nomor]=$_POST['soal_'.md5($id_acak)];
			$r_jawaban_temp[$nomor]=$_POST['soal_'.$id_acak];
			$nomor++;
			}
			$answer_temp=json_encode($r_jawaban_temp);
			
			$hari_ini=date("Y-m-d H:i:s");
			/*UPDATE NILAI*/
			if($_GET['akhiri_ujian']==1){
				
				$tambahan="
				end_time='$hari_ini',
				is_done=1 ";
			}else{
				$tambahan="
				is_done=0 ";
			}
			
			$update=$mysql->query("
			UPDATE 
				quiz_done 
			SET 
				check_point='$hari_ini',
				benar='$benar',
				salah='$salah',
				answer='$answer',
				answer_temp='$answer_temp',
				tidak_jawab='$tidak_jawab',
				score='$score',
				$tambahan
			WHERE 
				id='".$member_data['id']."'
			");
			$temp=ob_get_clean();
			/*END UPDATE NILAI*/
			if($_GET['akhiri_ujian']==1){
				return 2;
			}else{
				return 1;
			}
			
			
		}else{
			return 0;
		}
		
	}else{
		return 0;
	}
}
function akhiri_ujian($token)
{
	global $mysql;
	if($token!="")
	{
		
		$q=$mysql->query("SELECT id,quiz_id,acak,score_master FROM quiz_done WHERE token='$token' and is_done=0");
		if($q and $mysql->numrows($q)>0)
		{
			ob_start();
			$member_data=$mysql->assoc($q);
			
			/*UPDATE NILAI*/
			$hari_ini=date("Y-m-d H:i:s");
			$q=$mysql->query("UPDATE quiz_done SET 
			check_point='$hari_ini',
			end_time='$hari_ini',
			is_done=1 
			WHERE id='".$member_data['id']."'
			");
			if($q){
				if(count($_COOKIE)>0)
				{
					foreach($_COOKIE as $i =>$v)
					{
					if($i=="PHPSESSID"){
					continue;
					}		
					setcookie($i,"",-1,"/");
					}
				}
			}
			$temp=ob_get_clean();
			/*END UPDATE NILAI*/
			echo 1;
			
		}else{
			$q=$mysql->query("SELECT id,quiz_id,acak,score_master FROM quiz_done WHERE token='$token' and is_done=1");
			if($q and $mysql->numrows($q)>0){
				echo 1;
			}else{
				echo 0;	
			}
			
		}
		
	}else{
		echo 0;
	}
	
}

 
if($action=="save_essay"){
	$id=cleanInput($_POST['id']);
	$answer=$_POST['answer'];
	$token=$_POST['token'];
	$done_id=$mysql->get1value("SELECT id FROM quiz_done WHERE token='$token' and is_done=0");
	$q=$mysql->query("INSERT INTO quiz_essay_answer (essay_id,done_id,answer) values ('$id','$done_id','$answer') ON DUPLICATE KEY UPDATE answer='$answer'");
	//$q=$mysql->query("REPLACE INTO quiz_essay_answer (essay_id,done_id,answer) values ('$id','$done_id','$answer')");
}
if($action=="akhiri_ujian"){
	akhiri_ujian($_POST['token']);
}
if($action=="autosave"){
	echo auto_save($_POST['token']);
}
if($action=="check_point"){

}
if($action=="check_valid"){
	$token=$_POST['token'];
	$hari_ini=date("Y-m-d H:i:s");
	/*
	$q=$mysql->query("UPDATE quiz_done SET 
			check_point='$hari_ini'
			WHERE token='$token' and is_done=0
			");
	//var_dump($q);		
	*/ 
	/**/
	//$q=$mysql->query(" SELECT schedule_id FROM quiz_done WHERE token='$token' and is_done=0 ");
	
	$q=$mysql->query("UPDATE quiz_done SET 
			check_point='$hari_ini'
			WHERE token='$token' and is_done=0
			");
	
	if($q and $mysql->affected_rows()>0)
	{	
		echo 1;
	}
	else
	{
		echo 0;
	}
	/*
	 if($q){
	echo 1;
	}else{
	echo 0;
	} 
	 * */
	
}
if($action=="timeout_checking"){
	$token=$_POST['token'];
	
	
	$q=$mysql->query("SELECT start_time,quiz_duration FROM quiz_done WHERE token='$token' AND is_done=0");
	if($q and $mysql->numrows($q)>0)
	{
		
		$member_data=$mysql->assoc($q);
		$start_time=$member_data['start_time'];
		$this_time=strtotime(date("Y-m-d H:i:s"));
		$quiz_duration= ($member_data['quiz_duration']*60);

		$end_time=strtotime($start_time)+$quiz_duration;
		$quiz_left_duration=$end_time-$this_time;


		if($quiz_left_duration<=-120){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	else
	{
		echo 1;
	}
}
//session_write_close();
$mysql->close();
exit();

?>
