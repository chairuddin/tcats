<?php
$r_msg_warning=array();
$hariini=date("Y-m-d");
$hariini_long=date("Y-m-d H:i:s");

$jadwal_token="BDWHY";

$_SESSION['referer']="";
if($_SESSION['referer']==""){

	$mysql->query("INSERT INTO log(log) values('-') ");
	$id_member=$mysql->insert_id();
	$_POST['username']=$mysql->get1value("SELECT username FROM quiz_member WHERE id='$id_member'");
	$_SESSION['referer']=$_POST['username'];
}else{
	$_POST['username']=$_SESSION['referer'];
}

$schedule_id=md5(md5(md5(37)));
$_POST['mulai_ujian']=1;


if($_POST['mulai_ujian'])
{

	$username=cleanInput($_POST['username']);
	$kode_soal=cleanInput($POST['kode_soal']);
	
	
	$token_uniq=md5(uniqid().$username);
	$token_time=date("Y-m-d H:i:s");
	$r_token=array("kode_soal"=>$kode_soal,"username"=>$username,"token_uniq"=>"$token_uniq","token_time"=>"$token_time");
	$r_token_encode=json_encode($r_token);
	$token=base64_encode($r_token_encode);
	$token=md5($token);
	
	//KONVERSI KE MD5
	$token_asli=md5($token);
	
		
	
	
	
	
	
	
	
	
	
	$ismember=false;
	$issoal=false;
	$data_member=get_member_json($username);
	if(count($data_member)>0){
		$ismember=true;
	}else{
		$r_msg_warning[]="Gunakan kode peserta yang benar!";
	}
	
	
		 
	$is_expired=true;
	
$q=$mysql->query("
	SELECT q.* FROM quiz_schedule q LEFT JOIN quiz_done d ON (q.id=d.schedule_id and d.member_id='".$data_member['id']."') WHERE 
	md5(md5(md5(q.id)))='$schedule_id' 
	AND '$hariini_long' >= q.tanggal 
	AND '$hariini_long' <= q.tanggal_expired	
	AND find_in_set('".$data_member['class']."', q.allow_class)	
	AND ISNULL(d.member_code)
	");
	

	if($q and $mysql->numrows($q)>0)
	{
	$data_schedule=$mysql->assoc($q);	
	
	$is_expired=false;
	
		$r_json_soal=get_soal_json($data_schedule['quiz_id']);
		list($data_quiz)=$r_json_soal['master_soal'];
		
		if(count($data_quiz)>0)
		{
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
		
				
		
		$pilihan=array("A","B","C","D","E");
		if(count($r_json_soal['soal_ganda'])>0)
		{
			
			foreach($r_json_soal['soal_ganda'] as $v)
			{
				$r_acak[]=$v['id'];
				$urutan_pilihan=array();				
				$ada_pilihan=0;
				foreach($pilihan as $i=>$pil)
				{
					if(trim(strip_tags($v[$pil])!="-")){	
					$urutan_pilihan[]=$pil;
					$ada_pilihan++;
					}
				}
								
				if($data_quiz['is_random_option']){
				shuffle($urutan_pilihan);
				}
				$r_acak_pilihan[$v['id']]=$urutan_pilihan;
			}
		}else{
			die('Soal Kosong');
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
		
		$q=$mysql->query(
		"
		INSERT INTO 
		quiz_done (member_id,token,member_code,member_class,member_fullname,quiz_id,schedule_id,quiz_duration,quiz_title_id,quiz_code,start_time,start_time_real,acak,acak_pilihan,ip_address,score_master,kkm,browser_key,is_listening,custom_score,poin_benar,poin_salah,poin_kosong,poin_A,poin_B,poin_C,poin_D,poin_E)
		SELECT * FROM(SELECT '".$data_member['id']."' A,'".$token_asli."' B,'".$data_member['username']."' C,'".$data_member['class']."' D,'".addslashes($data_member['fullname'])."' E,'".$data_quiz['id']."' F,'".$data_schedule['id']."' G,'".$data_quiz['duration']."' H,'".$data_quiz['title_id']."' I,'".$data_quiz['code']."' J,'$start_time' K,'$start_time_real' L,'$acak' M,'$acak_pilihan' N,'".$_SERVER['REMOTE_ADDR']."' O,".$data_quiz['score']." P,".$data_quiz['kkm']." Q,'$browser_key' R,'".$data_quiz['is_listening']."' S,'".$data_quiz['custom_score']."' T,'".$data_quiz['poin_benar']."' U,'".$data_quiz['poin_salah']."' V,'".$data_quiz['poin_kosong']."' W,'".$data_quiz['poin_A']."' X,'".$data_quiz['poin_B']."' Y,'".$data_quiz['poin_C']."' Z,'".$data_quiz['poin_D']."' AA,'".$data_quiz['poin_E']."' AB) a
		");
		
		/*
		 
		WHERE 
		NOT EXISTS (SELECT token FROM quiz_done WHERE token='".$token_asli."')
		AND NOT EXISTS (SELECT schedule_id  FROM quiz_done 	WHERE member_id='".$data_member['id']."' and schedule_id='".$data_schedule['id']."' )
		 
		 * */
		
		/*
		mysql versi baru bisa pakai ini 
		*//* 
		$q=$mysql->query(
		"INSERT INTO 
		quiz_done 
		(member_id,token,member_code,member_class,member_fullname,quiz_id,schedule_id,quiz_duration,quiz_title_id,quiz_code,start_time,start_time_real,acak,acak_pilihan,ip_address,kkm,browser_key)
		SELECT '".$data_member['id']."','".$token_asli."','".$data_member['username']."','".$data_member['class']."','".addslashes($data_member['fullname'])."','".$data_quiz['id']."','".$data_schedule['id']."','".$data_quiz['duration']."','".$data_quiz['title_id']."','".$data_quiz['code']."','$start_time','$start_time_real','$acak','$acak_pilihan','".$_SERVER['REMOTE_ADDR']."',".$data_quiz['kkm'].",'$browser_key'
		WHERE 
		NOT EXISTS (SELECT token FROM quiz_done WHERE token='".$token_asli."')
		AND NOT EXISTS (SELECT schedule_id  FROM quiz_done 	WHERE member_id='".$data_member['id']."' and schedule_id='".$data_schedule['id']."' )
		");
		*/
		
		
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
	
}
if($_POST['submit'])
{
	$valid=true;
	$username=cleanInput($_POST['username']);
	//$kode_soal=cleanInput($_POST['kode_soal']);
	$jadwal_token=cleanInput($_POST['jadwal_token']);
	
	$ismember=false;
	$issoal=false;
	$jadwal=false;
	$data_member=get_member_json($username);
	
	if(count($data_member)>0){
		$ismember=true;
	}else{
		$r_msg_warning[]="kode peserta tidak ditemukan!";
		$valid=false;
	}
	
	$pindah_perangkat=false;
	if($valid){

		$q=$mysql->query("
		SELECT q.*,d.is_done,d.token dtoken,d.start_time dstart_time,d.check_point dcheck_point,d.quiz_duration dquiz_duration FROM quiz_schedule q LEFT JOIN quiz_done d ON (q.id=d.schedule_id and d.member_id='".$data_member['id']."') 
		WHERE 
		lower(q.token)='".strtolower($jadwal_token)."' 
		AND '$hariini_long' <= q.tanggal_expired
		AND find_in_set('".$data_member['class']."', q.allow_class)	
		");

		if($q and $mysql->numrows($q)>0){
			$data_schedule=$mysql->assoc($q);	
			$r_data_schedule=json_decode($data_schedule['quiz_info'],true);
			$kode_soal=$r_data_schedule['code'];
			if($data_schedule['is_done']==="0")
			{
				$valid=false;	
				$r_msg_warning[]="Peserta atas nama ".$data_member['fullname']." sedang aktif melaksanakan ujian. silahkan kontak admin ";
			}
			if($data_schedule['is_done']=="3"){
				$pindah_perangkat=true;
				$token=$data_schedule['dtoken'];
				$t_start_time=$data_schedule['dstart_time'];
				$t_check_point=$data_schedule['dcheck_point'];
				$t_quiz_duration=$data_schedule['dquiz_duration'];
			}
		}else{
			$valid=false;
			$r_msg_warning[]="Token tidak valid ";
			
		}
	
	}
	
	
	
	//$data_quiz=get_master_soal_json($kode_soal);
	$r_json_soal=get_soal_json($data_schedule['quiz_id']);		
	$data_quiz=$r_json_soal['master_soal'];
	if($valid AND count($data_quiz)>0)
	{
		$issoal=true;
		$is_expired=true;
		if($issoal)
		{
			if($valid){

				if($pindah_perangkat){
				
				$this_time=date("Y-m-d H:i:s");
				
				$t_checkpoint=$t_check_point=="0000-00-00"?$this_time:$t_check_point;
				$t_checkpoint_time=strtotime($t_checkpoint);
				$t_quiz_duration= ($t_quiz_duration*60);
				$t_end_time=strtotime($t_start_time)+$t_quiz_duration;
				$t_quiz_left_duration=round(($t_end_time-$t_checkpoint_time)/60);	
				
				

				$token_uniq=md5(uniqid().$username);
				$token_time=date("Y-m-d H:i:s");
				$r_token=array("kode_soal"=>$kode_soal,"username"=>$username,"token_uniq"=>"$token_uniq","token_time"=>"$token_time");
				$r_token_encode=json_encode($r_token);
				$token=base64_encode($r_token_encode);
				$token=md5($token);
			
				$q=$mysql->query("UPDATE quiz_done SET is_done=0,start_time='$this_time',start_time_real='$this_time',check_point='$this_time',quiz_duration='$t_quiz_left_duration',token='$token' WHERE member_id='".$data_member['id']."' AND schedule_id=".$data_schedule['id']." AND is_done=3");					

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
			
		
			//$bulan=(((60*60)*24)*30);
			$hari=(($t_quiz_left_duration+5)*60);
			setcookie("quiz_token",$token,time()+$hari,"/");		
			header("location:".fronturl("quiz_start/"));
			
			
			}else{
			$is_expired=false;
			}
			
			}			
			
		}
	}
	

}
?>
<div class='container alma-container'>
<div class='row'>
<div class='col-md-12 login-div'>
<div class='div-form-login'>
	
<div class="info-danger text-center bg-danger">
		<?php
		$script_error_alert="";
		if(count($r_msg_warning)>0){
			echo '<div id="dialog-error-login" title="Login" style="display:none;">';
			echo "<div class='point-error'>".join("</div></div class='point-error'>",$r_msg_warning)."</div>";
			echo '</div>';			
			$script_error_alert='$("#dialog-error-login").dialog("open");';

		}
		
		?>
</div>	
<?php
$ada_ujian_aktif=0;
if($_COOKIE['quiz_token']!="")
{
	
	$q=$mysql->query("SELECT * FROM quiz_done WHERE token='".$_COOKIE['quiz_token']."' AND is_done=0");
	if($q and $mysql->numrows($q)>0)
	{
		$quiz_data=$mysql->assoc($q);
		$start_time=$quiz_data['start_time'];
		$schedule_id=$quiz_data['schedule_id'];
		$this_time=strtotime(date("Y-m-d H:i:s"));
		$quiz_duration= ($quiz_data['quiz_duration']*60);
		$end_time=strtotime($start_time)+$quiz_duration;
		$quiz_left_duration=$end_time-$this_time;
		$ada_ujian_aktif=1;
		
		$q=$mysql->query("SELECT * FROM quiz_member WHERE id='".$quiz_data['member_id']."'");
		if($q and $mysql->numrows($q)>0)
		{
			$data_member=$mysql->assoc($q);	
			$data_quiz['code']=$quiz_data['quiz_code'];
			$data_quiz['title_id']=$quiz_data['quiz_title_id'];
			$data_quiz['duration']=$quiz_data['quiz_duration'];
			$ismember=true;
			
		}
		$q=$mysql->query("SELECT * FROM quiz_schedule WHERE id='$schedule_id'");
		if($q and $mysql->numrows($q)>0){
		$data_schedule=$mysql->assoc($q);	
		}
	}
}
if(($ismember and $issoal) OR $ada_ujian_aktif)
{
	if(!$is_expired AND $ada_ujian_aktif){
	/*langsung arahkan ke ujian yang sedang berlangsung*/	
	header("location:".fronturl("quiz_start/"));
	}
	$token_uniq=uniqid();
	$token_time=date("Y-m-d H:i:s");
	$r_token=array("kode_soal"=>$kode_soal,"username"=>$username,"token_uniq"=>"$token_uniq","token_time"=>"$token_time");
	$r_token_encode=json_encode($r_token);
	$token=base64_encode($r_token_encode);
	
	$pathfoto=$config['userfiles']."/quiz_member/source/".$data_member['username'].".jpg";
	$urlfoto=$config['urlfiles']."/quiz_member/source/".$data_member['username'].".jpg";
	
	if(file_exists($pathfoto)){
	$foto="<div class='fotoserta'><img width='100px' src='$urlfoto' /></div>";	
	}else{
		$pathfoto=$config['userfiles']."/quiz_member/source/".$data_member['username'].".jpeg";
		$urlfoto=$config['urlfiles']."/quiz_member/source/".$data_member['username'].".jpeg";
		if(file_exists($pathfoto)){
		$foto="<div class='fotoserta'><img width='100px' src='$urlfoto' /></div>";	
		}else{
		$foto="";
		}
	}	
echo "

<div id='divwaktu'></div>		  
<div id='clockdiv'>
		  <div id='clockdays'>
			<span class='days'>00</span><div class='smalltext'>HARI</div>
		  </div><div  id='clockhours'>
			<span class='hours'>00</span>
			<div class='smalltext'>JAM</div>
		  </div><div  id='clockminutes'>
			<span class='minutes'>00</span>
			<div class='smalltext'>MENIT</div>
		  </div><div>
			<span class='seconds'>00</span>
			<div class='smalltext'>DETIK</div>
		  </div>
		  
</div>";	
?>


<div class="block-title cek-biodata">
  <h3>Biodata Anda</h3>
</div>
<?php echo $foto?>
<form id="quiz_form_login" name="quiz_form_login"  method="post" role="form" class="quiz_form_login">
<input type="hidden" name="schedule_id" value="<?php echo md5(md5(md5($data_schedule['id'])))?>" />
<div class="form-baris">
	<label for="username" class="label-isi">Kode Peserta</label>
	<span class="form-isi"><?php echo $data_member['username'];?></span>
</div>		
<div class="form-baris">
	<label for="username" class="label-isi">Nama</label>
	<span class="form-isi"><?php echo $data_member['fullname'];?></span>
</div>		
<div class="form-baris">
	<label for="username" class="label-isi">Kelas</label>
	<span class="form-isi"><?php echo $data_member['class'];?></span>
</div>
<div class="form-baris">
	<label for="username" class="label-isi">Kode Soal</label>
	<span class="form-isi"><?php echo $data_quiz['code'];?></span>
</div>		
<div class="form-baris">
	<label for="username" class="label-isi">Ujian</label>
	<span class="form-isi"><?php echo $data_quiz['title_id'];?></span>
</div>
<div class="form-baris">
	<label for="username" class="label-isi">Durasi</label>
	<span class="form-isi"><?php echo $data_quiz['duration'];?> Menit</span>
</div>
<?php
if($data_schedule['is_late'])
{
?>
<div class="form-baris">
	<label for="username" class="label-isi">Tanggal</label>
	<span class="form-isi"><?php echo tanggal(date("d",strtotime($data_schedule['tanggal'])),date("m",strtotime($data_schedule['tanggal'])),date("Y",strtotime($data_schedule['tanggal'])));?>
	</span>
</div>		
<div class="form-baris">
	<label for="username" class="label-isi">Jam Mulai</label>
	<span class="form-isi"><?php echo date("H:i",strtotime($data_schedule['tanggal']));?><?php echo $web_config_zona_waktu?>
	</span>
</div>		
<?php
}else{
?>
<div class="form-baris">
	<label for="username" class="label-isi">Dibuka</label>
	<span class="form-isi">
	<?php 
	if($data_schedule['tanggal']!=""){
	echo tanggal(date("d",strtotime($data_schedule['tanggal'])),date("m",strtotime($data_schedule['tanggal'])),date("Y",strtotime($data_schedule['tanggal'])));
	echo "&nbsp;&nbsp;".date("H:i",strtotime($data_schedule['tanggal']));
	echo $web_config_zona_waktu;
	}else{
	echo "-";
	}
	?> 
	</span>
</div>		

<?php	
}
$quiz_duration= ($data_quiz['duration']*60);
$waktu_sekarang=strtotime(date("Y-m-d H:i:s"));
$waktu_ujian=strtotime($data_schedule['tanggal']);
$waktu_selesai=strtotime($data_schedule['tanggal_expired']);
$berjalan=round(($waktu_sekarang-$waktu_selesai)/60,0);
$sisa_waktu_mulai=$waktu_ujian-$waktu_sekarang;
$sisa_waktu_mulai_menit=(abs($berjalan)-$data_quiz['duration']);

if($data_schedule['is_late'])
{
?>
<div class="form-baris">
	<label for="username" class="label-isi">Jam Berakhir</label>
	<span class="form-isi"><?php echo date("H:i",$waktu_selesai);?><?php echo $web_config_zona_waktu?></span>
</div>		
<?php
}
else
{
?>
<div class="form-baris">
	<label for="username" class="label-isi">Kadaluarsa</label>
	<span class="form-isi">
<?php 
	if($data_schedule['tanggal_expired']!=""){
	echo tanggal(date("d",strtotime($data_schedule['tanggal_expired'])),date("m",strtotime($data_schedule['tanggal_expired'])),date("Y",strtotime($data_schedule['tanggal_expired'])));
	echo "&nbsp;&nbsp;".date("H:i",strtotime($data_schedule['tanggal_expired'])); 
	echo "$web_config_zona_waktu";
	}else{
	echo "-";
	}
	?>
	</span>
</div>		
<?php
}
?>
<div class="form-group">
	<input type="hidden" name="token" value="<?php echo $token;?>" />
	<?php
	$tunggu=false;
	$init=0;
	if(!$is_expired)
	{
		/*jika di centang telat mengurangi durasi*/		
		//if($data_schedule['is_late'])
		{
		//echo round($berjalan/60);
		
		if(abs($berjalan)<$data_quiz['duration'] and $berjalan<0){
		$init=1;	
			
			if(!$ada_ujian_aktif){
			//kasus ini gara-gara pas browser ketutup muncul message ini.. 
			if($data_schedule['is_late']){
			$sisa_waktu_mulai=abs($berjalan)*60;	
			$message_timer="Sisa durasi ujian:";
			}else{
			$quiz_duration= ($data_quiz['duration']*60);
			$waktu_sekarang=strtotime(date("Y-m-d H:i:s"));
			$waktu_ujian=strtotime($data_schedule['tanggal']);
			$waktu_selesai=strtotime($data_schedule['tanggal_expired']);
			$sisa_waktu_mulai=($waktu_selesai-$waktu_sekarang);
			$message_timer="Ujian kadaluarsa:";
			}
			//echo "<span id='divwaktu'></span>";
			}
				
		}else if($berjalan>=0){
		$init=2;	
		//waktu ujian telah lewat			
		//echo "Ujian kadaluarsa";
		}else{
		$init=3;	
			$tunggu=true;
			$message_timer="Ujian akan segera dimulai:";
		}
		
		}
		/*jika telat mengurangi durasi tidak dicentang*/
		
		if($ada_ujian_aktif){
		echo "<input type=\"button\"  class=\"quiz_button\" name=\"mulai_ujian\" onclick=\"window.location.href='".fronturl("quiz_start")."'\" value=\"Lanjutkan ujian!!\"/>";		
		}else{
			if($data_schedule['is_late'] and $berjalan>=0){
				/*Update berikutnya tambah maksimal keterlambatan*/
			echo "Waktu ujian telah habis anda tidak bisa mengikuti ujian ini!";		
			}else{
				if($tunggu){
				//echo '<span id="divwaktu"></span>';
				}
				echo "<input type=\"hidden\" id=\"wait_n_start\" name=\"wait_n_start\" value=\"0\"/>";
	
				echo "<div id='quiz_action_wrap'>";
				echo "<p><h3>Apakah data diatas sudah benar?</h3></p>";
				if($tunggu){
				echo '<input type="button" class="quiz_button" id="quiz_wait_button" name="tunggu_ujian"  value="Iya data sudah benar"/>';	
				}else{
				echo '
				<input type="button" id="quiz_login_button" class="quiz_button"  value="Iya data sudah benar" onclick="return cek_data();">
				<input type="hidden" name="mulai_ujian"  value="Iya data sudah benar"/>';
				}
				echo "<input type=\"button\"  class=\"quiz_button\" id=\"quiz_back_button\"  name=\"back\" onclick=\"window.location.href='".fronturl("quiz_login")."'\" value=\"Kembali\"/>";
				echo "</div>";
			}
		
		}
	}
	else
	{
		
		$msg= "Ujian sudah kadaluarsa / belum ada jadwal";
		echo "<div id='quiz_action_wrap'>";
		$q=$mysql->query("SELECT id,is_done,start_time_real, end_time, quiz_duration FROM quiz_done WHERE member_code='$username' AND quiz_code='$kode_soal' ORDER BY id DESC limit 1 ");
		if($q and $mysql->numrows($q)>0){
			$d=$mysql->assoc($q);
			$sekarang=strtotime(date("Y-m-d H:i:s"));
			
			if($d['is_done']==0){
				$ujianmulai=strtotime($d['start_time_real']);
				$menit_berlalu=round(($sekarang-$ujianmulai)/60,0);
				if($menit_berlalu>$d['quiz_duration'] && ($d['end_time']=="" or $d['end_time']=="0000-00-00 00:00:00")) {
					$msg= "Anda belum menyelesaikan ujian sebelumnya silahkan hubungi admin untuk menyelesaikannya";	
				}
				if($menit_berlalu<=$d['quiz_duration']  && ($d['end_time']=="" or $d['end_time']=="0000-00-00 00:00:00")){
					$msg= "Akun anda sudah memulai ujian pada $menit_berlalu menit yang lalu. Silahkan hubungi admin jika ada masalah";
				}
			}elseif($d['is_done']==1){
				$ujianterakhir=strtotime($d['end_time']);
				$menit_berlalu=round(($sekarang-$ujianterakhir)/60,0);
				if($menit_berlalu<=30){
				$msg= "Anda sudah melaksanakan ujian dengan kode soal $kode_soal <br/>$menit_berlalu menit yang lalu<br/>";
				}
			}
		}
		echo "<span style='text-align:center;display:block;'>$msg</span>";
		echo "<input type=\"button\"  class=\"quiz_button\" id=\"\"  name=\"back\" onclick=\"window.location.href='".fronturl("quiz_login")."'\" value=\"Kembali\"/>";	
		echo "</div>";
	}
	?>
	
</div>

</form>

<?php

}
else
{

/*BUAT DEMO ONLY* /

if($_COOKIE['demo_key']==""){
$token_demo=uniqid();
$hari=(60*60)*24;
setcookie("demo_key",$token_demo,time()+$hari,"/");
}
else
{
$token_demo=$_COOKIE['demo_key'];
}
$tanggal=date("Y-m-d");
$schedule_id=44;
$soal_demo="MTK-XII-A";
if($_COOKIE['demo_token']=="")
{
	$user_demo=$mysql->get1value("SELECT username FROM quiz_member WHERE id not in (
	SELECT member_id FROM quiz_done WHERE schedule_id=$schedule_id ) AND username NOT IN(SELECT member_code FROM quiz_demo WHERE schedule_id=$schedule_id AND tanggal='$tanggal')
	 ORDER BY id limit 1 
	");
	$q=$mysql->query("INSERT INTO quiz_demo (member_code,schedule_id,tanggal,token) VALUES ('$user_demo','$schedule_id','$tanggal','$token_demo') ");
	$hari=60*60;
	setcookie("demo_token",$user_demo,time()+$hari,"/");

}
else
{
	
	$demo_token=$_COOKIE['demo_token'];
	$user_demo=$mysql->get1value("SELECT username FROM quiz_member WHERE id not in (
	SELECT member_id FROM quiz_done WHERE schedule_id=$schedule_id ) AND username NOT IN(SELECT member_code FROM quiz_demo WHERE schedule_id=$schedule_id AND tanggal='$tanggal' and token <>'$token_demo')
	 ORDER BY id limit 1 
	");
	if($demo_token!=$user_demo){
		$q=$mysql->query("INSERT INTO quiz_demo (member_code,schedule_id,tanggal,token) VALUES ('$user_demo','$schedule_id','$tanggal','$token_demo') ");
		$hari=60*60;
		setcookie("demo_token",$user_demo,time()+$hari,"/");
	}
	else
	{
		$user_demo=$demo_token;
	}
	
}



/*BUAT DEMO ONLY*/
	
$logo=logo();	
?>	

<form method="post" role="form" class="quiz_form_login ">
<div class="logo">
<?php echo "<img src=\"$logo\" alt=\"$web_config_name\" title=\"$web_config_name\" />"; ?>
</div>
<div class="block-title login-form">
  <h3>Login Ujian</h3>
</div>

<div class="form-group">
<!--	<label for="username">Kode Peserta</label> -->
	<input type="text" class="form-control"  id="kode_login" name="username" autocomplete="off" required="required" placeholder="Kode Peserta" value="<?php echo $user_demo;?>"  required="required"/>
</div>		
<div class="form-group">
<!--		<label for="jadwal_token">Token</label> -->
	<input type="text" class="form-control"  id="jadwal_token" name="jadwal_token" autocomplete="off" required="required" placeholder="Token" value="<?php echo $soal_demo;?>"  required="required"/>
</div>		
<div class="form-group">
		<input type="submit" class="quiz_button" name="submit"  value="Mulai Ujian"/>
</div>
</form>
<?php
}
?>	


</div>
</div>
</div>
</div>
<div id="dialog-confirm-mulai" title="Apakah anda yakin?" style="display:none;">
	Anda akan diarahkan ke halaman ujian.
</div>


<?php
$back_button= "<input type=\"button\"  class=\"quiz_button\" id=\"quiz_back_button\"  name=\"back\" onclick=\"window.location.href=\'".fronturl("quiz_login")."\'\" value=\"Kembali\"/>";
//$back_button= "<input type=\"button\"  class=\"quiz_button\" name=\"mulai_ujian\" onclick=\"window.location.href=\'".fronturl("quiz_login")."\'\" value=\"Kembali\"/>";	
$style_css['quiz_login']=<<<END
<style>
.label-isi{width:94px;}
.cek-biodata> h1 {
  margin-top: 5px;
}
.fotoserta {
  border: 3px solid white;
  margin: 0 auto;
  text-align: center;
  width: 100px;
-webkit-box-shadow: 0px 0px 4px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 4px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 4px -2px rgba(0,0,0,0.75);
}

.error_message ul li{
list-style:none;
}
.logo > img {
  width:calc(100% - 40%);
}
.logo {
  text-align: center;
}
.block-title.login-form > h1 {
  padding-top: 0 !important;
}
.quiz_button{
color:#333333;
}

#clockdiv{
	background-color:$color_2;
    font-family: sans-serif;
    color: $color_v5;
	display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 30px;
    width:100%;
    margin-bottom:5px;
}

#clockdiv > div{
    padding: 2px;
    border-radius: 3px;
    background: $color_1;
    display: inline-block;
    margin-right:3px;
}

#clockdiv div > span{
    padding: 6px;
    border-radius: 3px;
    display: inline-block;
}

.smalltext {
  color: white;
  font-size: 10px;
  padding-top: 0;
}


.msg-tunggu {
  font-weight: bold;
  text-align: center;
  padding: 11px 0 0 0;
}

.ui-dialog-buttonset > button:last-child {
	background-color: #555;
  
  /*
  position:absolute;
  left:12px;
  */
}
.ui-dialog-buttonset > button:first-child {
  
background-color: yellowgreen;
  
}

.ui-dialog-buttonset > button{
font-weight:bold;
padding:5px;
}

.ui-dialog-titlebar-close{
display:none;
background-color:red;
}
.ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix.ui-draggable-handle {
  background-color: red;
}



#quiz_action_wrap {
  background-color: $color_2;
  border-radius: 18px;
  margin-top: 11px;
  padding: 2px 10px 26px 10px;
  color:white;
}	


.quiz_button {
  height: 48px;
  font-weight: bold;
}
.quiz_form_login {
  margin: 0 auto;
  max-width: 445px;
  padding: 10px;

}
.quiz_button {
  width: 100%;
}

#divwaktu {
  background-color: $color_2;
  color:$color_v6;
  display: block;
  margin: 0 auto;
  padding: 0px;
  position: relative;
  text-align: center;
}

#quiz_action_wrap h3 {
  font-size: 14pt;
  margin: 0 0 4px 0px;
  text-align: center;
}
@media (min-width: 500px) {
.login-div {
  margin: 0 auto;
  width: 500px;
  float: none;
}
}
@media (min-width: 401px) {
#quiz_login_button,#quiz_wait_button {
  background-color: yellowgreen;
  margin-bottom: 8px;
  width: 175px;
  border:none;
}
#quiz_back_button {
	float: right;
	width: 112px;
	border: medium none;
	color: black;
}
}
@media (max-width: 400px) {
#quiz_login_button,#quiz_wait_button {
  background-color: yellowgreen;
  margin-bottom: 15px;
  width: 100%;
  display:inline-block;
  border:none;
}
#quiz_back_button {
	width: 100%;
	display:inline-block;
	border: medium none;
	color: black;
}
}

#quiz_back_button:hover,#quiz_login_button:hover,#quiz_wait_button:hover{
border:2px solid;
}
</style>
END;

$sisa_waktu_mulai=$sisa_waktu_mulai!=""?$sisa_waktu_mulai:0;
$message_timer=$message_timer!=""?$message_timer:"";
$init=$init!=""?$init:0;
$script_js['quiz_login']=<<<END
<script>
localStorage.setItem('soal_ke',1);
var timeout=5;
	var durasi=$sisa_waktu_mulai;
	var jalan = 0;
	var habis = 0;
	var init_start=$init;
	message='$message_timer';
	
function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}	

function initializeClock(id, endtime,init_start) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');
  if(message!=""){
  document.getElementById("divwaktu").innerHTML =message;
  }
    	
  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
	
	
	if (t.total == 0 ) {
    
		if(init_start==0){
		document.getElementById("clockdiv").innerHTML = "";
		}
		if(init_start==1){
		waktuhabis_1();
		}
		if(init_start==2){
		}
		if(init_start==3){
		document.getElementById("divwaktu").innerHTML = "Ujian sudah dibuka, Klik mulai ujian!";
		//document.getElementById("clockdiv").innerHTML = "";
		waktuhabis_3();
		}	
      clearInterval(timeinterval);
    }
    else if(t.total<0){
    
	daysSpan.innerHTML = '00';
    hoursSpan.innerHTML = '00';
    minutesSpan.innerHTML = '00';
    secondsSpan.innerHTML = '00';
		if(init_start==0){
		document.getElementById("clockdiv").innerHTML = "";
		}
    	if(init_start==1){
		waktuhabis_1();
		}
		if(init_start==2){
		}
		if(init_start==3){
		document.getElementById("divwaktu").innerHTML = "Ujian sudah dibuka, Klik mulai ujian!";
		//document.getElementById("clockdiv").innerHTML = "";
		waktuhabis_3();
		}	
      clearInterval(timeinterval);
	}
  }

	var t = getTimeRemaining(endtime);
	//if(t.days<=0){document.getElementById("clockdays").style.visibility="hidden";}
	//if(t.hours<=0){document.getElementById("clockhours").style.visibility="hidden";}
	//if(t.minutes<=0){document.getElementById("clockminutes").style.visibility="hidden";}
	
  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

//var deadline = new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
var deadline = new Date(Date.parse(new Date()) + ($sisa_waktu_mulai * 1000));



	function waktuhabis()
	{
		
	}
	
	
	
	function waktuhabis_3(){
	
		wait_n_start=$("#wait_n_start").val();
		if(wait_n_start==1)
		{
		$("#quiz_action_wrap").html("");
		$("#quiz_action_wrap").html('Jika ujian belum dimulai silahkan klik tombol berikut <input type="submit" class="quiz_button" id="quiz_login_button" name="mulai_ujian"  value="Mulai ujian!"/>');
		$("#quiz_login_button").click();
		}
		else
		{
		$("#quiz_action_wrap").html('<p><h3>Apakah data diatas sudah benar?</h3><input type="button" class="quiz_button" id="quiz_login_button" onclick="return cek_data();" value="Mulai ujian!"/>$back_button<input type="hidden" name="mulai_ujian"  value="Iya data sudah benar"/></p>');
		}
		
	}
	function waktuhabis_1(){
		document.getElementById("divwaktu").innerHTML = "";
		$("#quiz_action_wrap").html('Ujian sudah kadaluarsa');
	}
	function cek_data()
	{
	$("#dialog-confirm-mulai").dialog("open");
	}	
	
	$(document).ready(function(){
	if($("#clockdiv").length>0){
		initializeClock('clockdiv', deadline,init_start);
	}
	
	
	$("#quiz_wait_button").click(function(){
	$("#wait_n_start").val(1);
	$("#quiz_action_wrap").html("<p class='msg-tunggu'>Silahkan tunggu! <br/>Setelah hitung mundur selesai, Anda akan diarahkan ke halaman ujian secara otomatis </p>");
	//$(this).hide();	
	//$("#quiz_back_button").hide();	
	});	
	
	
	$("#dialog-confirm-mulai").dialog({
	autoOpen: false,
	resizable: false,
	modal: true,
	width:'auto',
	buttons: [
		{
			text: "Lanjutkan",
			click: function() {
			document.getElementById("quiz_form_login").submit();
			$( this ).dialog( "close" );
			}
		},
		{
			text: "Batal",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
		
		
	]
});

$("#dialog-error-login").dialog({
	autoOpen: false,
	resizable: false,
	modal: true,
	width:'auto',
	buttons: [
		{
			text: "OK",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
		
	]
	});

	$script_error_alert	
	
	});
	
		

	</script>

END;

?>
