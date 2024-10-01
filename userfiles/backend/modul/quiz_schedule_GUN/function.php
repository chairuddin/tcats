<?php

function show_form_essay($data_ujian) {
	global $mysql,$modul;
	$data=$data_ujian['pg'];
	$id_quiz_done=$data['id'];
	$quiz_id = $data['quiz_id'];
	$essay_terpilih=$mysql->get1value("SELECT essay from quiz_done_paket WHERE quiz_done_id=$id_quiz_done ");
	
	$r_soal_ujian = $mysql->query_data("SELECT id,question FROM quiz_essay WHERE quiz_id=$quiz_id AND id IN($essay_terpilih)",'id');
	
	$action_submit=backendurl("$modul/update_koreksi_essay");
	ob_start();
	if(is_array($data)) {
		echo '<form method="post" action="'.$action_submit.'">';
		echo '<div class="card card-navy">';
		echo '<div class="card-header">'.$data['member_code']." | ".$data['member_fullname'];
		echo '</div>';
		echo '<div class="card-body">';
		$no=1;
		
		echo '<input type="hidden" name="id_quiz_done"  value="'.$id_quiz_done.'" />';
		echo '<div class="row">';
		foreach($r_soal_ujian as $id_essay => $essay) {
			
			
			echo '<div class="col-md-6">';
			echo "<b>Pertanyaan #$no</b>";
			echo $essay['question'];
			echo "<b>Jawaban Siswa</b>";
			echo '<textarea class="form-control" name="answer['.$id_essay.']">'.$data_ujian['essay'][$id_essay]['answer'].'</textarea>';
			echo '</div>';
			echo '<div class="col-md-6">';
			echo "<b>Kunci Jawaban</b>";
			echo '<ul>';
			
			$skor_terpilih='';
			for($i=1;$i<=5;$i++) {
				
				if($data_ujian['essay'][$id_essay]['score_persen']<=0.0) {
					$skor_selected=strtolower($data_ujian['essay'][$id_essay]['answer'])==strtolower($data_ujian['kunci_essay'][$id_essay]['answer'.$i])?'active':'';
					if($skor_selected=='active') {
						$skor_terpilih=$data_ujian['kunci_essay'][$id_essay]['point'.$i];
					}
				} else {
					$skor_terpilih=$data_ujian['essay'][$id_essay]['score_persen'];
				}
				$kunci_teks=trim($data_ujian['kunci_essay'][$id_essay]['answer'.$i]);
				if($kunci_teks!="") {
					echo '<li class="'.$skor_selected.'">'.$kunci_teks.' ('.$data_ujian['kunci_essay'][$id_essay]['point'.$i].')</li>';
				}
			}
			echo '</ul>';
			echo '</div>';
			/*
			echo '<div class="col-md-6">';
			echo "<b>Komentar Guru</b>";
			echo '<textarea class="form-control" name="comment['.$id_essay.']">'.$data_ujian['essay'][$id_essay]['comment'].'</textarea>';
			echo '</div>';
			*/ 
			echo '<div class="col-md-12">';
			echo '&nbsp;';
			echo '</div>';
			echo '<div class="col-md-2">';
			echo "<b>Skor(1-100)</b>";
			echo '<input class="form-control" type="text" name="score_persen['.$id_essay.']" value="'.$skor_terpilih.'"/>';
			echo '</div>';
			echo '<div class="col-md-12"><hr/></div>';
			
			$no++;
		}
		echo '</div>';
		echo '</div>';
		echo '<div class="card-footer">';
		echo '<button type="submit" class="btn btn-primary">Submit</button>';
		echo '</div>';
		echo '</div>';
		echo '</form>';
	}
	
	return ob_get_clean();
}
function data_ujian($id_quiz_done) {
	
	global $mysql;
	$data_ujian=array();
	$q = $mysql->query(" SELECT * FROM quiz_done WHERE id=$id_quiz_done ");
	/*PILIHAN GANDA*/
	$quiz_id=0;
	$id_quiz_done=array();
	if($q and $mysql->num_rows($q)>0) {
		while($d = $mysql->fetch_assoc($q)) {
			$id_quiz_done[]=$d['id'];
			$data_ujian['pg']=$d;
			$quiz_id=$d['quiz_id'];
			/*info PG sekaligus dipakai buat biodata peserta*/
		}
	}
	
	/*PILIHAN ESSAY*/
	$join_id_quiz_done = join(",",$id_quiz_done);
	$q_essay = $mysql->query(" SELECT id_quiz_done,id_quiz_essay,answer,score_persen,score,comment,is_done FROM quiz_done_essay WHERE id_quiz_done IN ($join_id_quiz_done) ");
	if($q_essay) {
		while($d_essay = $mysql->fetch_assoc($q_essay)) {
			$data_ujian['essay'][$d_essay['id_quiz_essay']]=$d_essay;
		}
	}
	
	/*Kunci jawaban PG*/
	
	$kunci_pg=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=".$quiz_id);
	if($qkey and $mysql->num_rows($qkey)>0){
		while($d=$mysql->fetch_assoc($qkey)){
			$kunci_pg[$d['id']]=$d['answer'];
		}
	}
	$data_ujian['kunci_pg']=$kunci_pg;
	/*Kunci jawaban ESSAY*/
	
	$kunci_essay=array();
	$qkey=$mysql->query("SELECT id,question,answer1,answer2,answer3,answer4,answer5,point1,point2,point3,point4,point5 FROM quiz_essay WHERE quiz_id=".$quiz_id);
	if($qkey and $mysql->num_rows($qkey)>0){
		while($d=$mysql->fetch_assoc($qkey)){
			$kunci_essay[$d['id']]=$d;
		}
	}
	$data_ujian['kunci_essay']=$kunci_essay;
	return $data_ujian;
}
function info_ujian($id) {
global $mysql,$config_wali_kelas,$is_wali_kelas;
$hariini_long=date("Y-m-d H:i:s");
$kondisi=" AND is_deleted=0 ";
$data_ujian = array();				
	$q=$mysql->query("SELECT * FROM quiz_schedule WHERE id='$id'");
	if($q and $mysql->numrows($q)>0){
		
		$realtime_array=array();
		$filter_kelas='';
		while($d=$mysql->assoc($q)){
			$r_quiz_info=json_decode($d['quiz_info'],true);
			$join_class=explode(",",$d['allow_class']);
			$join_class="'".join("','",$join_class)."'";
			if($_SESSION['s_level']==0){
				if($is_wali_kelas){			
					$join_class="'".join("','",$config_wali_kelas)."'";
					$filter_kelas=" AND member_class IN ($join_class) ";
				}
			}
			$total_siswa="";
			if($d['allow_class']=="ALL")
			{
			$total_peserta=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_member");
			$belum_ujian=$mysql->get1value("
			SELECT IFNULL(COUNT(id),0) FROM quiz_member 
			WHERE 
			id NOT IN(SELECT member_id FROM quiz_done WHERE schedule_id=".$d['id'].")");
			}
			else
			{
			$total_peserta=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_member WHERE class IN ($join_class) ");
			$belum_ujian=$mysql->get1value("
			SELECT IFNULL(COUNT(id),0) FROM quiz_member 
			WHERE 
			id NOT IN(SELECT member_id FROM quiz_done WHERE schedule_id=".$d['id']." AND member_class IN ($join_class)) AND class IN ($join_class) ");										
			}
			
			$sedang_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=0) $filter_kelas AND schedule_id=".$d['id']);
			$reset_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=3) $filter_kelas AND schedule_id=".$d['id']);
			$sudah_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE is_done=1 $filter_kelas AND schedule_id=".$d['id']);
			
			$data_ujian['total_peserta']=$total_peserta;
			$data_ujian['belum_ujian']=$belum_ujian;
			$data_ujian['sedang_ujian']=$sedang_ujian;
			$data_ujian['reset_ujian']=$reset_ujian;
			$data_ujian['sudah_ujian']=$sudah_ujian;
			
			
			$realtime_array[$d['id']]=array("be"=>$belum_ujian,"re"=>$reset_ujian,"se"=>$sedang_ujian,"su"=>$sudah_ujian);
			$p_belum_ujian=round(($belum_ujian/$total_peserta)*100,1);
			$p_reset_ujian=round(($reset_ujian/$total_peserta)*100,1);
			$p_sedang_ujian=round(($sedang_ujian/$total_peserta)*100,1);
			$p_sudah_ujian=round(($sudah_ujian/$total_peserta)*100,1);
			
			$data_ujian['belum_ujian_prosentase']=$p_belum_ujian;
			$data_ujian['sedang_ujian_prosentase']=$p_sedang_ujian;
			$data_ujian['reset_ujian_prosentase']=$p_reset_ujian;
			$data_ujian['sudah_ujian_prosentase']=$p_sudah_ujian;
			
			$tanggal_ujian=date("Y-m-d",strtotime($d['tanggal']));
			$tanggal_expired=date("Y-m-d",strtotime($d['tanggal_expired']));
			/*
			echo "<div class=\"realtime-box\">";
			echo "<div class=\"realtime_title\">";
			$hari_sama=$tanggal_ujian==$tanggal_expired?1:0;
			if($hari_sama==1)
			{
				echo "<span class='realtime-limit-child'><i class='glyphicon-stopwatch'></i>
				".date("H:i",strtotime($d['tanggal']))." - ".date("H:i",strtotime($d['tanggal_expired'])).
				"</span>";
			}
			else
			{
				echo "<span class='realtime-limit-child'><i class='glyphicon-stopwatch'></i>
				".date("H:i",strtotime($d['tanggal']))." - ".tgl_indo(date("Y-m-d",strtotime($d['tanggal']))).
				"</span>";
				echo "<span class='realtime-limit-child'><i class='glyphicon-stopwatch'></i>
				".date("H:i",strtotime($d['tanggal_expired']))." - ".tgl_indo(date("Y-m-d",strtotime($d['tanggal_expired']))).
				"</span>";
			}
			echo "<span class='realtime-title-child'>[&nbsp;".$d['token']." ]&nbsp;".$r_quiz_info['code']." ".$r_quiz_info['title_id']."</span>";
			
			echo "</div>";		
			echo "
			<ul class=\"tiles tiles-center nomargin\">
				<li class=\"lightgrey has-chart\">
					<a href=\"".backendurl("quiz_realtime/?filter=belum_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_belum_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#333333\">$p_belum_ujian%</div></span><span class='name indikator'>Belum Ujian $belum_ujian/$total_peserta</span></a>
				</li>
				<li class=\"blue has-chart\">
					<a href=\"".backendurl("quiz_ongoing/?filter=sedang_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sedang_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#5facf3\">$p_sedang_ujian%</div></span><span class='name indikator'>Sedang Ujian</br>$sedang_ujian</span></a>
				</li>
				<li class=\"orange has-chart\">
					<a href=\"".backendurl("quiz_ongoing/?filter=pending&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sudah_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#FEEB67\">$p_reset_ujian%</div></span><span class='name indikator'>Pending</br>$reset_ujian</span></a>
				</li>
				<li class=\"orange has-chart\">
					<a href=\"".backendurl("quiz_ongoing/?filter=sudah_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sudah_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#f96d6d\">$p_sudah_ujian%</div></span><span class='name indikator'>Sudah Ujian $sudah_ujian/$total_peserta</span></a>
				</li>
			</ul>";
			$d['allow_class']=explode(",",$d['allow_class']);
			$d['allow_class']=join(", ",$d['allow_class']);	
			echo "<div class=\"allow_class\">Kelas: ".$d['allow_class']."</div>";	
			echo "</div>";	
			*/ 
		}
		//$realtime_array=json_encode($realtime_array);
		//echo "<input id=\"realtime_hidden\" type=\"hidden\" value='$realtime_array' />";
	}
	return $data_ujian;
}
?>
