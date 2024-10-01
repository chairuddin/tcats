<?php
function quiz_login()
{
	header("location:".fronturl("quiz_login"));
	exit();
} 

function submit_jawaban($token)
{
	global $mysql,$web_config_show_score;
	
	if($token!="")
	{
		$q=$mysql->query("SELECT id,quiz_id,kkm,score_master FROM quiz_done WHERE token='$token' and is_done=0",1,1);
		if($q and $mysql->numrows($q)>0)
		{
			$member_data=$mysql->assoc($q);
			
			$q=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id='".$member_data['quiz_id']."'");
			if($q and $mysql->numrows($q)>0)
			{
				$benar=0;
				$salah=0;
				$tidak_jawab=0;
				$total_quiz=0;
				$r_jawaban=array();
				$no=0;
				while($d=$mysql->assoc($q))
				{
					$no++;
					$total_quiz++;
					//soal_<?php echo $no_sss;?
					$jawaban=$_POST['soal_'.md5($d['id'])];
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
			$answer=json_encode($r_jawaban);
			$bobot=$member_data['score_master']/$total_quiz;
			
			$score=round($benar*$bobot,2);
			
			$kkm=$member_data['kkm'];
			$pass=0;
			if($score >= $kkm){
				$pass=1;
			}
			/*UPDATE NILAI*/
			$hari_ini=date("Y-m-d H:i:s");
			$q=$mysql->query("UPDATE quiz_done SET 
			end_time='$hari_ini',
			check_point='$hari_ini',
			benar='$benar',
			salah='$salah',
			answer='$answer',
			tidak_jawab='$tidak_jawab',
			is_done=1,
			score='$score'
			WHERE id='".$member_data['id']."'
			");
		
			
			if($q)
			{
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
				
				if(!$web_config_show_score){
					header("location:".fronturl("quiz_done")."?done=$pass");
				}else{
					header("location:".fronturl("quiz_done")."?score=$score&tidak_jawab=$tidak_jawab&benar=$benar&salah=$salah&pass=$pass&kkm=$kkm");
				}
				exit();
			}
			else{
				header("location:".fronturl("quiz_start"));
				exit();
			}	
			/*END UPDATE NILAI*/
			
		}
		else
		{
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
			show_score($token);		
			
		}	
	}
	
}
function show_score($token){
		global $mysql,$web_config_show_score;
			$q=$mysql->query("SELECT score,tidak_jawab,benar,salah,kkm FROM quiz_done WHERE token='$token' AND is_done=1");
			if($q and $mysql->numrows($q)>0)
			{
				$member_data=$mysql->assoc($q);
				$score=$member_data['score'];
				$tidak_jawab=$member_data['tidak_jawab'];
				$benar=$member_data['benar'];
				$salah=$member_data['salah'];
				$kkm=$member_data['kkm'];
				$pass=0;
				if($score >= $kkm){
					$pass=1;
				}
				if(!$web_config_show_score){
					header("location:".fronturl("quiz_done")."?done=$pass&yes=1");
				}else{
					header("location:".fronturl("quiz_done")."?score=$score&tidak_jawab=$tidak_jawab&benar=$benar&salah=$salah&pass=$pass&kkm=$kkm&yes=1");
				}
				
				exit();
			}
			else
			{
			quiz_login();
			}
 
}
?>
