<?php
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
			
			$sedang_ujian=$mysql->get1value("SELECT IFNULL(COUNT(id),0) FROM quiz_done WHERE (is_done=0)  $filter_kelas AND schedule_id=".$d['id']);
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
			
		}
		return $data_ujian;
	}
}
?>
