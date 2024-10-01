<?php
function auto_save($token)
{
	
	global $mysql;
	if($token!="")
	{
		$mysql->autocommit(false);
		
		$q=$mysql->query("SELECT q.id,q.quiz_id,q.acak,q.score_master,q.custom_score,q.poin_benar,q.poin_salah,q.poin_kosong,q.poin_A,q.poin_B,q.poin_C,q.poin_D,q.poin_E,q.poin_F,q.poin_G,q.poin_H,q.poin_I,q.poin_J,p.pg paket_pg,p.essay paket_essay FROM quiz_done q LEFT JOIN quiz_done_paket p ON q.id=p.quiz_done_id WHERE q.token='$token' and q.is_done=0");
		if($q and $mysql->numrows($q)>0)
		{
			
			ob_start();
			$member_data=$mysql->assoc($q);
			
			//$q=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id='".$member_data['quiz_id']."'");
			//include(path_to_soal_json($member_data['quiz_id']));
			//$r_json_soal=json_decode(trim($soal_json),true);
			$r_json_soal=get_soal_json($member_data['quiz_id']);
			
			$benar=0;
			$salah=0;
			$tidak_jawab=0;
			$total_quiz=0;
			
			/*COMPLEX*/
			//model skor = 0 semua semua bobot dianggap seperti pilihan ganda
			if($member_data['custom_score']==0) {
				$complex_answer=array();
				if(count($r_json_soal['soal_complex'])>0)
				{
					
					foreach($r_json_soal['soal_complex'] as $id_complex => $data) {
						$total_quiz++;
						if(count($_POST['complex_'.$data['id']])) {
							$sort_answer=$_POST['complex_'.$data['id']];
							sort($sort_answer);
							$join_answer=join("",$sort_answer);
							$complex_answer[$data['id']]=$join_answer;
							if($data['answer']==$join_answer) {
								//benar
								$benar++;
							} elseif($join_answer=='') {
								//salah
								$tidak_jawab++;
							} else {
								$salah++;
								//tidak jawab
							}
						}
					}
					$json_encode_answer=json_encode($complex_answer);
					$insert_complex=$mysql->query("INSERT INTO quiz_done_complex SET id_quiz_done='".$member_data['id']."',answer='".$json_encode_answer."',benar=$benar,salah=$salah,tidak_jawab=$tidak_jawab ON DUPLICATE KEY UPDATE answer='".$json_encode_answer."',benar=$benar,salah=$salah,tidak_jawab=$tidak_jawab ");
					
				 }
			}
			/*END COMPLEX*/
			
			/*ESSAY SHORT ANSWER*/
			//model skor = 0 semua semua bobot dianggap seperti pilihan ganda
			if($member_data['custom_score']==0) {
				
				$jumlah_essay=count($r_json_soal['soal_essay']);
				if($jumlah_essay>0)
				{
					
					$total_quiz+=$jumlah_essay;
					$benar_essay=$mysql->get1value("SELECT count(id) FROM quiz_done_essay WHERE score>0 AND id_quiz_done=".$member_data['id']);
					$benar+=$benar_essay;
					$salah+=$jumlah_essay-$benar_essay;
					
				}
			}
			/*END ESSAY SHORT ANSWER*/
			if($_GET['akhiri_ujian']==1){
				//$r_json_soal=get_soal_json($member_data['quiz_id']);
				if(count($r_json_soal['soal_ganda'])>0)
				{
					
					/*pindah ke atas karena ada complex jadi digabung disana untuk perhitungannya* /
					$benar=0;
					$salah=0;
					$tidak_jawab=0;
					$total_quiz=0;
					/*end pindah keatas*/
					$r_jawaban=array();
					$no=0;
					$score_custom=array();
					/*custom_score = 3*/
					$bobot=array();
					$betul=array();
					/*custom_score = 3*/
					//while($d=$mysql->assoc($q))
					/*custom_score = 4*/
					if($member_data['paket_pg']=='') {
						$r_acak_pg=explode(",",$member_data['acak']);
					} else {
						$r_acak_pg=explode(",",$member_data['paket_pg']);
					}
					/*end custom_score = 4*/
					//foreach($r_json_soal['soal_ganda'] as $d)
					foreach($r_acak_pg as $soal_id)
					{
						$d=$r_json_soal['soal_ganda'][$soal_id];
						$no++;
						$total_quiz++;
						//$jawaban=$_POST['soal_'.md5($d['id'])];
						$jawaban=$_POST['soal_'.$d['id']];
						if($member_data['custom_score']==2){
							$r_jawaban[$no]=$jawaban;
							$score_custom[]=$member_data["poin_".$jawaban];
						} elseif($member_data['custom_score']==3) {
							$bobot[$d['urutan']]=$d['bobot'];
							$r_jawaban[$no]=$jawaban;
							if($jawaban!="" AND $jawaban==$d['answer'])
							{
								$benar++;
								$betul[$d['urutan']]=$d['bobot'];
							}
							elseif($jawaban!="" AND $jawaban!=$d['answer'])
							{
								$salah++;
							}
							else
							{
								$tidak_jawab++;
							}
						} else {
							
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
			
			if ($member_data['custom_score']==1){				
				$score=($benar*$member_data['poin_benar'])+($salah*$member_data['poin_salah'])+($tidak_jawab*$member_data['poin_kosong']);	
			} elseif($member_data['custom_score']==0 OR $member_data['custom_score']=4){
				$bobot=$member_data['score_master']/$total_quiz;
				$score=round($benar*$bobot,2);	
			} elseif($member_data['custom_score']==2) {
				$bobot=$member_data['score_master']/$total_quiz;
				foreach($score_custom as $persentase_poin) {
					$score += $bobot * ($persentase_poin/100);
				}
				//$score=array_sum($score_custom);
			} elseif($member_data['custom_score']==3) {
				$qkd=$mysql->query("SELECT id,score_max,kkm,nomor_soal,title_id FROM quiz_kd WHERE quiz_id='".$member_data['quiz_id']."' ");
				if( $qkd and $mysql->numrows($qkd)>0 ) {
					
					while($dkd = $mysql->assoc($qkd)) {
						$r_nomor = explode(",",$dkd['nomor_soal']);
						$total_bobot=0;
						
						foreach($r_nomor as $nomor) {
							$total_bobot+=$bobot[$nomor];
						}
						$bobot_perpoint=$dkd['score_max']/$total_bobot;
						$t_skor=0;
						
						if(count($betul)>0) {
							foreach($r_nomor as $nomor) {
								if($betul[$nomor]!="") {
									$betul_bobot=$betul[$nomor];
									$t_skor+=$betul_bobot*$bobot_perpoint;
								}
							}
							
						}
						
						$score+=$t_skor;
						$score_kd_update=array();
						$score_kd_insert=array();
						$score_kd_insert[]=" id_quiz_done='".$member_data['id']."'";
						$score_kd_insert[]=" id_quiz_kd='".$dkd['id']."'";
						$score_kd_insert[]=" nama_kd='".$dkd['title_id']."'";
						$score_kd_insert[]=" score='".$t_skor."'";
						$score_kd_insert[]=" score_max='".$dkd['score_max']."'";
						$score_kd_update[]=" nama_kd='".$dkd['title_id']."'";
						$score_kd_update[]=" score='".$t_skor."'";
						$score_kd_update[]=" kkm='".$dkd['kkm']."'";
						
						$sql_kd = 'INSERT INTO quiz_done_kd SET '.join(",",$score_kd_insert).' ON DUPLICATE KEY UPDATE '.join(",",$score_kd_update);
						$insert_kd = $mysql->query($sql_kd);
						
						}
					}
				$score=round($score);
				
				//$score=array_sum($score_sbmptn);
			} elseif($member_data['custom_score']==4 and false) {
				$qkd=$mysql->query("SELECT id,score_max,kkm,nomor_soal,title_id FROM quiz_kd WHERE quiz_id='".$member_data['quiz_id']."' ");
				if($qkd and $mysql->numrows($qkd)>0) {
					$bobot=$member_data['score_master']/$total_quiz;
					while($dkd = $mysql->assoc($qkd)) {
						$r_nomor = explode(",",$dkd['nomor_soal']);
						$total_bobot=0;
						
						foreach($r_nomor as $nomor) {
							$total_bobot+=$bobot;
						}
						$bobot_perpoint=$member_data['score_master']/$total_bobot;
						$t_skor=0;
						
						if(count($betul)>0) {
							foreach($r_nomor as $nomor) {
								if($betul[$nomor]!="") {
									$betul_bobot=$betul[$nomor];
									$t_skor+=$betul_bobot*$bobot_perpoint;
								}
							}
							
						}
						
						$score+=$t_skor;
						$score_kd_update=array();
						$score_kd_insert=array();
						$score_kd_insert[]=" id_quiz_done='".$member_data['id']."'";
						$score_kd_insert[]=" id_quiz_kd='".$dkd['id']."'";
						$score_kd_insert[]=" nama_kd='".$dkd['title_id']."'";
						$score_kd_insert[]=" score='".$t_skor."'";
						$score_kd_insert[]=" score_max='".$dkd['score_max']."'";
						$score_kd_update[]=" nama_kd='".$dkd['title_id']."'";
						$score_kd_update[]=" score='".$t_skor."'";
						$score_kd_update[]=" kkm='".$dkd['kkm']."'";
						
						$sql_kd = 'INSERT INTO quiz_done_kd SET '.join(",",$score_kd_insert).' ON DUPLICATE KEY UPDATE '.join(",",$score_kd_update);
						$insert_kd = $mysql->query($sql_kd);
						
						}
					}
				$score=round($score);
				
				//$score=array_sum($score_sbmptn);
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
			$score_essay='NULL';
			$hari_ini=date("Y-m-d H:i:s");
			/*UPDATE NILAI*/
			if($_GET['akhiri_ujian']==1){
				
				$tambahan="
				end_time='$hari_ini',
				is_done=1 ";
				$score_essay=$mysql->get1value("SELECT sum(score) FROM quiz_done_essay WHERE id_quiz_done=".$member_data['id']);
				
			}else{
				$tambahan="
				is_done=0 ";
			}
			$json_ragu=json_encode($_POST['ragu']);
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
				score_essay='$score_essay',
				score_complex='$score_complex',
				ragu='$json_ragu',
				$tambahan
			WHERE 
				id='".$member_data['id']."'
			");
			$temp=ob_get_clean();
			/*END UPDATE NILAI*/
			$mysql->commit();
			$mysql->autocommit(true);
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
			$score_essay=$mysql->get1value("SELECT sum(score) FROM quiz_done_essay WHERE id_quiz_done=".$member_data['id']);
			
			if($score_essay<=0 && $score_essay=='' ) {
				$score_essay='NULL';
			}
			/*UPDATE NILAI*/
			$hari_ini=date("Y-m-d H:i:s");
			$q=$mysql->query("UPDATE quiz_done SET 
			check_point='$hari_ini',
			end_time='$hari_ini',
			score_essay='$score_essay',
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
	$essay_terpilih=$mysql->get1value("SELECT essay from quiz_done_paket WHERE quiz_done_id=$done_id ");
	
	$kunci_essay=$mysql->fetch_assoc($mysql->query("SELECT  quiz_id,answer1,answer2,answer3,answer4,answer5,point1,point2,point3,point4,point5 FROM quiz_essay WHERE id=".$id));
	$list_kunci=array();
	$score=0;
	$score_persen=0;
	
	if($kunci_essay['answer1']!='' or $kunci_essay['answer2']!='' or $kunci_essay['answer3']!='' or $kunci_essay['answer4']!='' or $kunci_essay['answer5']!='')
	{
		
		$skor_maksimal=$q=$mysql->get1value("SELECT score_essay FROM quiz_master WHERE id=".$kunci_essay['quiz_id']);
		$jumlah_soal=$q=$mysql->get1value("SELECT count(id) FROM quiz_essay WHERE id IN ($essay_terpilih) AND quiz_id=".$kunci_essay['quiz_id']);
		$bobot=$skor_maksimal/$jumlah_soal;
		$list_kunci=array(
		1=>strtolower($kunci_essay['answer1']),
		2=>strtolower($kunci_essay['answer2']),
		3=>strtolower($kunci_essay['answer3']),
		4=>strtolower($kunci_essay['answer4']),
		5=>strtolower($kunci_essay['answer5'])
		);	
		
		$find=array_search(strtolower($answer),$list_kunci);
		if($find>0) {
			$score=$bobot*($kunci_essay['point'.$find]/100);
			$score_persen=$kunci_essay['point'.$find];
		} 
		
		
		
		
	}
	
	$answer=addslashes($answer);
	$q=$mysql->query("
	INSERT INTO quiz_done_essay 
	SET 
		id_quiz_done='$done_id',
		id_quiz_essay='$id',
		answer='$answer',
		score='$score',
		score_persen='$score_persen'
	ON DUPLICATE KEY UPDATE answer='$answer',score='$score', score_persen='$score_persen'	
	");
	if($q) {
	echo 1;
	} else {
	echo 0;
	}
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
