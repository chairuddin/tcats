<?php
if($id=="ujian_realtime")
{
ob_start();
	$id_jadwal=$_GET['id_jadwal'];
	$update=0;
	$realtime_array=$_POST['realtime_array'];
	$realtime_array=json_decode($realtime_array,true);
	$hariini_long=date("Y-m-d H:i:s");
	$kondisi=" AND is_deleted=0  AND id=$id_jadwal";
	if($_SESSION['s_level']==0){
	$kondisi.=" AND quiz_id IN (SELECT id FROM quiz_master WHERE created_by='".$_SESSION['s_id']."')";
	}
	$q=$mysql->query("SELECT * FROM quiz_schedule WHERE $kondisi");
	if($q and $mysql->numrows($q)>0){
		
		while($d=$mysql->assoc($q)){
			$r_quiz_info=json_decode($d['quiz_info'],true);
			
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
			$join_class=explode(",",$d['allow_class']);
			$join_class="'".join("','",$join_class)."'";
			$total_peserta=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_member WHERE class IN ($join_class) ");
			$belum_ujian=$mysql->get1value("
			SELECT IFNULL(COUNT(id),0) FROM quiz_member 
			WHERE 
			id NOT IN(SELECT member_id FROM quiz_done WHERE schedule_id=".$d['id']." AND member_class IN ($join_class)) AND class IN ($join_class) ");										
			
			}
			
			$sedang_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=0) AND schedule_id=".$d['id']);
			$reset_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=3) AND schedule_id=".$d['id']);
			$sudah_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE is_done=1 AND schedule_id=".$d['id']);
			
			
			if($realtime_array[$d['id']]['re']!=$reset_ujian OR 
			$realtime_array[$d['id']]['be']!=$belum_ujian OR
			$realtime_array[$d['id']]['se']!=$sedang_ujian OR
			$realtime_array[$d['id']]['su']!=$sudah_ujian){
				$update=1;
			}
			
			
			$realtime_array[$d['id']]=array("be"=>$belum_ujian,"re"=>$reset_ujian,"se"=>$sedang_ujian,"su"=>$sudah_ujian);
			$p_belum_ujian=round(($belum_ujian/$total_peserta)*100,1);
			$p_reset_ujian=round(($reset_ujian/$total_peserta)*100,1);
			$p_sedang_ujian=round(($sedang_ujian/$total_peserta)*100,1);
			$p_sudah_ujian=round(($sudah_ujian/$total_peserta)*100,1);
			$tanggal_ujian=date("Y-m-d",strtotime($d['tanggal']));
			$tanggal_expired=date("Y-m-d",strtotime($d['tanggal_expired']));
			$hari_sama=$tanggal_ujian==$tanggal_expired?1:0;
			echo "<div class=\"realtime-box\">";
			echo "<div class=\"realtime_title\">";
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
					<li class=\"lightred has-chart\">
						<a href=\"".backendurl("quiz_realtime/?filter=sudah_ujian&schedule_id=".$d['id'])."\"><span><div class=\"chart\" data-percent=\"$p_sudah_ujian\" data-color=\"#ffffff\" data-trackcolor=\"#f96d6d\">$p_sudah_ujian%</div></span><span class='name indikator'>Sudah Ujian $sudah_ujian/$total_peserta</span></a>
					</li>
				</ul>";
			echo "</div>";	
		}
		$realtime_array=json_encode($realtime_array);
		echo "<input id=\"realtime_hidden\" type=\"hidden\" value='$realtime_array' />";
	}else
	{
		echo '
		<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>Info!</strong> Tidak ada ujian yang aktif
				</div>
		';	
	}
	$data=ob_get_clean();
	if($update==1){
	echo $data;
	}else{
	echo 1;
	}
}
exit();
?>
