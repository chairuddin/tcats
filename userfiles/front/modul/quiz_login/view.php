<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$run_js_script1="";
$run_js_script2="";
$url_back = "";
if($web_config_mode_login){	
	$url_back = fronturl("siswa/dashboard");	
} else {
	$url_back = fronturl("quiz_login");				
}
$this_time=date("Y-m-d H:i:s");

$_POST=$_GET;
//$_POST['username']='181910033';
//$_POST['jadwal_token']='FNQXN';

$r_msg_warning=array();
$this_url=$_SERVER['REQUEST_URI'];

$message_timer='';
 
if($_POST['mulai_ujian'])
{

	$schedule_id=cleanInput($_POST['schedule_id']);
	$token_asli=cleanInput($_POST['token']);
	$token=base64_decode($_POST['token']);
	$r_token=json_decode($token,true);
	$username=cleanInput($r_token['username']);
	$kode_soal=cleanInput($r_token['kode_soal']);
	//KONVERSI KE MD5
	$token_asli=md5($_POST['token']);
		
	$ismember=false;
	$issoal=false;
	$data_member=get_member_json($username);
	if(count($data_member)>0){
		$ismember=true;
	}else{
		$r_msg_warning[]="Gunakan kode peserta yang benar!";
	}

		 
	$is_expired=true;
	/*
	$q=$mysql->query("
	SELECT * FROM quiz_schedule WHERE 
	md5(md5(md5(id)))='$schedule_id' 
	AND '$this_time' >= tanggal 
	AND '$this_time' <= tanggal_expired	
	AND (find_in_set('".$data_member['class']."', allow_class) OR find_in_set('ALL', allow_class))
	AND is_deleted<>1
	AND id NOT IN(SELECT DISTINCT schedule_id  FROM quiz_done 	WHERE member_id='".$data_member['id']."' and schedule_id IS NOT NULL )
	",1,1);
	*/
$q=$mysql->query("
	SELECT q.* FROM quiz_schedule q LEFT JOIN quiz_done d ON (q.id=d.schedule_id and d.member_id='".$data_member['id']."') WHERE 
	md5(md5(md5(q.id)))='$schedule_id' 
	AND '$this_time' >= q.tanggal 
	AND '$this_time' <= q.tanggal_expired	
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
		
		$acak_pg=array();
		$acak_essay=array();
		$acak_complex=array();
		$paket=array('A','B');
		list($master_soal)=($r_json_soal['master_soal']);
		if($master_soal['custom_score']==4) {
			$pg_total=$master_soal['pg_total'];
			$essay_total=$master_soal['essay_total'];
			$pg_total_komplex=$master_soal['pg_total_komplex'];
			for($i=1;$i<=$pg_total;$i++) {
				$acak_pg[$i]=$paket[rand(0,1)];
			}
			
			for($i=1;$i<=$essay_total;$i++) {
				$acak_essay[$i]=$paket[rand(0,1)];
			}
			for($i=1;$i<=$pg_total_komplex;$i++) {
				$acak_complex[$i]=$paket[rand(0,1)];
			}
		}
		
		
		if(count($r_json_soal['soal_ganda'])>0 or count($r_json_soal['soal_essay'])>0)
		{
			foreach($r_json_soal['soal_ganda'] as $v)
			{
				if($acak_pg[$v['urutan']]==$v['type']) {
					$r_acak[]=$v['id'];
					$urutan_pilihan=array();				
					$ada_pilihan=0;
					foreach($pilihan_ganda as $i=>$pil)
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
			}
			
			if(count($r_json_soal['soal_essay'])>0) {
				
				foreach($r_json_soal['soal_essay'] as $v)
				{
					if($acak_essay[$v['urutan']]==$v['type']) {
						$r_acak_essay[]=$v['id'];
					}
				}
			}
			
			if(count($r_json_soal['soal_complex'])>0) {
				
				foreach($r_json_soal['soal_complex'] as $v)
				{
					if($acak_complex[$v['urutan']]==$v['type']) {
						$r_acak_complex[]=$v['id'];
					}
				}
			}
		}else{
			die('soal-tidak-ditemukan');
		}
		
		if($data_quiz['is_random'])
		{
		shuffle($r_acak);
		shuffle($r_acak_essay);
		shuffle($r_acak_complex);
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
		/*modif disini 19 juni 2020*/
		if($data_quiz['duration']>200) {
			$data_quiz['duration']=$mysql->get1value("SELECT duration FROM quiz_master WHERE id='".$data_quiz['id']."'");
		}
		/*modif disini 3 mei 2020*/
		$q=$mysql->query(
		"
		INSERT INTO 
		quiz_done SET
			member_id='".$data_member['id']."',
			token='".$token_asli."',
			member_code='".$data_member['username']."',
			member_class='".$data_member['class']."',
			member_fullname='".addslashes($data_member['fullname'])."',
			quiz_id='".$data_quiz['id']."',
			schedule_id='".$data_schedule['id']."' ,
			quiz_duration='".$data_quiz['duration']."',
			quiz_title_id='".$data_quiz['title_id']."',
			quiz_code='".$data_quiz['code']."' ,
			start_time= '$start_time',
			start_time_real= '$start_time_real',
			acak='$acak' ,
			acak_pilihan='$acak_pilihan' ,
			ip_address= '".$_SERVER['REMOTE_ADDR']."',
			score_master= '".$data_quiz['score']."',
			kkm='".$data_quiz['kkm']."' ,
			browser_key= '$browser_key',
			is_listening= '".$data_quiz['is_listening']."',
			custom_score= '".$data_quiz['custom_score']."',
			poin_benar= '".$data_quiz['poin_benar']."',
			poin_salah= '".$data_quiz['poin_salah']."',
			poin_kosong= '".$data_quiz['poin_kosong']."',
			poin_A= '".$data_quiz['poin_A']."',
			poin_B= '".$data_quiz['poin_B']."',
			poin_C= '".$data_quiz['poin_C']."',
			poin_D= '".$data_quiz['poin_D']."',	
			poin_E='".$data_quiz['poin_E']."',
			poin_F='".$data_quiz['poin_F']."',
			poin_G='".$data_quiz['poin_G']."',
			poin_H='".$data_quiz['poin_H']."',
			poin_I='".$data_quiz['poin_I']."',
			poin_J='".$data_quiz['poin_J']."'		
		");
		$quiz_done_id=$mysql->insert_id();
		$join_pg=join(",",$r_acak);
		$join_essay=join(",",$r_acak_essay);
		$join_complex=join(",",$r_acak_complex);
		$insert_paket=$mysql->query("INSERT INTO quiz_done_paket SET quiz_done_id=$quiz_done_id, pg='$join_pg',essay='$join_essay',complex='$join_complex'");
		/*end modif disini 3 mei 2020*/
		/*
		$q=$mysql->query(
		"
		INSERT INTO 
		quiz_done (member_id,token,member_code,member_class,member_fullname,quiz_id,schedule_id,quiz_duration,quiz_title_id,quiz_code,start_time,start_time_real,acak,acak_pilihan,ip_address,score_master,kkm,browser_key,is_listening,custom_score,poin_benar,poin_salah,poin_kosong,poin_A,poin_B,poin_C,poin_D,poin_E)
		SELECT * FROM(SELECT '".$data_member['id']."' A,'".$token_asli."' B,'".$data_member['username']."' C,'".$data_member['class']."' D,'".addslashes($data_member['fullname'])."' E,'".$data_quiz['id']."' F,'".$data_schedule['id']."' G,'".$data_quiz['duration']."' H,'".$data_quiz['title_id']."' I,'".$data_quiz['code']."' J,'$start_time' K,'$start_time_real' L,'$acak' M,'$acak_pilihan' N,'".$_SERVER['REMOTE_ADDR']."' O,".$data_quiz['score']." P,".$data_quiz['kkm']." Q,'$browser_key' R,'".$data_quiz['is_listening']."' S,'".$data_quiz['custom_score']."' T,'".$data_quiz['poin_benar']."' U,'".$data_quiz['poin_salah']."' V,'".$data_quiz['poin_kosong']."' W,'".$data_quiz['poin_A']."' X,'".$data_quiz['poin_B']."' Y,'".$data_quiz['poin_C']."' Z,'".$data_quiz['poin_D']."' AA,'".$data_quiz['poin_E']."' AB) a
		"); 
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
				
				if($i!="PHPSESSID" and $i!="STDSESSID"){
					setcookie($i,"",-1,"/");
				}

			}
		}
		
		//renew cookie 
		//$bulan=(((60*60)*24)*30);
		$bulan=(($data_quiz['duration']+10)*60);
		setcookie("quiz_token",$token_asli,time()+$bulan,"/");
		header("location:".fronturl("quiz_start"));
		exit();
		}
	
	
	}else
	{
		
		$r_msg_warning[]="Ujian sudah kadaluwarsa";
	}
	
}

$token=$_COOKIE['quiz_token'];
if($token!=""){
	
	$q=$mysql->query("
		SELECT d.is_done,d.token dtoken,d.start_time dstart_time,d.check_point dcheck_point,d.quiz_duration dquiz_duration,q.token
		FROM   
			quiz_done d LEFT JOIN quiz_schedule q ON q.id=d.schedule_id  
		WHERE 
		'$this_time' <= q.tanggal_expired
		AND d.token='$token'
	");
	
	
		if($q and $mysql->numrows($q)>0){
			$data_schedule=$mysql->assoc($q);	
			$r_data_schedule=json_decode($data_schedule['quiz_info'],true);
			$kode_soal=$r_data_schedule['code'];
			if($data_schedule['is_done']==="0")
			{
				header("location:".fronturl("quiz_start"));
				exit();
			}
			if($data_schedule['is_done']=="3"){
				$pindah_perangkat=true;
				$token=$data_schedule['dtoken'];
				$t_start_time=$data_schedule['dstart_time'];
				$t_check_point=$data_schedule['dcheck_point'];
				$t_quiz_duration=$data_schedule['dquiz_duration'];
			}
		}
		
		///////////////////////////////////////
		if($pindah_perangkat){
				
			
				$t_checkpoint=$t_check_point=="0000-00-00"?$this_time:$t_check_point;
				$t_checkpoint_time=strtotime($t_checkpoint);
				$t_quiz_duration= ($t_quiz_duration*60);
				$t_end_time=strtotime($t_start_time)+$t_quiz_duration;
				$t_quiz_left_duration=round(($t_end_time-$t_checkpoint_time)/60);	
				
				$q=$mysql->query("UPDATE quiz_done SET is_done=0,start_time='$this_time',start_time_real='$this_time',check_point='$this_time',quiz_duration='$t_quiz_left_duration' WHERE token='".$token."' AND is_done=3");					

				//reset all cookie first
				if(count($_COOKIE)>0)
				{
					foreach($_COOKIE as $i =>$v)
					{ 
						if($i!="PHPSESSID" and $i!="STDSESSID"){
							setcookie($i,"",-1,"/");
						}
					}
				}
			
		
			//$bulan=(((60*60)*24)*30);
			$hari=(($t_quiz_left_duration+10)*60);
			setcookie("quiz_token",$token,time()+$hari,"/");		
			header("location:".fronturl("quiz_start/"));
			
			
			}else{
			$is_expired=false;
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
	
	if(is_array($data_member) AND count($data_member)>0 AND $data_member['status']){
		$ismember=true;
	}elseif(is_array($data_member)>0 AND  !$data_member['status'] ){
		$valid=false;
		$r_msg_warning[]="Peserta tidak aktif. Silahkan hubungi admin!";
	}else{
		$r_msg_warning[]="kode peserta tidak ditemukan!";
		$valid=false;
	}
	
	$pindah_perangkat=false;
	if($valid){
		$sql="
		SELECT q.*,d.id ujian_id,d.is_done,d.token dtoken,d.start_time dstart_time,d.check_point dcheck_point,d.quiz_duration dquiz_duration 
		FROM 
			quiz_schedule q LEFT JOIN quiz_done d ON (q.id=d.schedule_id and d.member_id='".$data_member['id']."') 
		WHERE 
		lower(q.token)='".strtolower($jadwal_token)."' 
		AND '$this_time' <= q.tanggal_expired
		AND find_in_set('".$data_member['class']."', q.allow_class)	
		";

		$q=$mysql->query($sql);

		if($q and $mysql->numrows($q)>0) {
		
			$data_schedule=$mysql->assoc($q);	
			
			$r_data_schedule=json_decode($data_schedule['quiz_info'],true);
			$kode_soal=$r_data_schedule['code'];
			if($data_schedule['is_done']==="0")
			{
				//cek waktu jika jarak check_point terlalu lama otomatis bisa login untuk melanjutkan ujian
				$sekarang=strtotime(date("Y-m-d H:i:s"));
				$check_point=strtotime($data_schedule['dcheck_point']);
				$selisih=($sekarang-$check_point)/60; 
				
				if($selisih>1){
					
					//jika selisih lebih dari 3 menit maka auto resume
					
					$q=$mysql->query("UPDATE quiz_done SET is_done=3 WHERE id=".$data_schedule['ujian_id']);
					$q=$mysql->query($sql);
					$data_schedule=$mysql->assoc($q);	
					
				} else {
					$valid=false;	
					$r_msg_warning[]="Peserta atas nama ".$data_member['fullname']." sedang aktif melaksanakan ujian. silahkan kontak admin ";
				}
			}
			if($data_schedule['is_done']=="3"){
				$pindah_perangkat=true;
				$token=$data_schedule['dtoken'];
				$t_start_time=$data_schedule['dstart_time'];
				//$t_check_point=$data_schedule['dcheck_point'];
				/*22 juni 2020 bugfix  time jadi jutaan */
				$t_check_point=$data_schedule['dcheck_point']==""?$data_schedule['dstart_time']:$data_schedule['dcheck_point'];
				$t_quiz_duration=$data_schedule['dquiz_duration'];
			}
			if($data_schedule['is_done']=="1"){
				$valid=false;
				$r_msg_warning[]="Anda sudah melaksanakan ujian ini  ";
			
			}
		}else{
			
			$valid=false;
			$r_msg_warning[]="Token tidak valid ";
			
		}
	
	}
	
	
	
	//$data_quiz=get_master_soal_json($kode_soal);
	$r_json_soal=get_soal_json($data_schedule['quiz_id']);		
	list($data_quiz)=$r_json_soal['master_soal'];
	
	if($valid AND count($data_quiz)>0)
	{
		$issoal=true;
		$is_expired=true;
		if($issoal)
		{
			if($valid){

				//$q=$mysql->query(" SELECT token,start_time,check_point,quiz_duration FROM quiz_done WHERE member_id='".$data_member['id']."' AND schedule_id=".$data_schedule['id']." AND is_done=3 ");
				if($pindah_perangkat){
				
				
				
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
							
						if($i!="PHPSESSID" and $i!="STDSESSID"){
							setcookie($i,"",-1,"/");
						}
					}
				}
			
		
			//$bulan=(((60*60)*24)*30);
			$hari=(($t_quiz_left_duration+10)*60);
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
<link href="<<<TEMPLATE_URL>>>/css/konfirmasi-tes.css?1=1" rel="stylesheet">
<div class='container alma-container'>
	
		<?php
		
		if(count($r_msg_warning)>0){
			/*
			echo '<div id="dialog-error-login" title="Login" style="display:none;">';
			echo "<div class='point-error'>".join("</div></div class='point-error'>",$r_msg_warning)."</div>";
			echo '</div>';			
			*/
			$error_msg=join("<br/>",$r_msg_warning);
			if($web_config_mode_login){	
				sweetalert2("warning",$error_msg,$url_back);
			} else {
			$run_js_script1="
			setTimeout(function(){
			Swal.fire(
			  'Login',
			  '$error_msg',
			  'error'
			);
			},200);
			";
			}
			 

		}
		
		?>

<?php
$ada_ujian_aktif=0;
if($_COOKIE['quiz_token']!="" and false)
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
	exit();
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
/*	
$panel_user='
		<div id="user-welcome">
			<div class="right-side-welcome">
				<div id="divwaktu"></div>		  
				<div id="clockdiv">
						  <div id="clockdays">
							<span class="days">00</span><div class="smalltext">HARI</div>
						  </div><div  id="clockhours">
							<span class="hours">00</span>
							<div class="smalltext">JAM</div>
						  </div><div  id="clockminutes">
							<span class="minutes">00</span>
							<div class="smalltext">MENIT</div>
						  </div><div>
							<span class="seconds">00</span>
							<div class="smalltext">DETIK</div>
						  </div>
						  
				</div>
				
			</div>
		</div>
';
*/ 

echo '
	<div id="divwaktu"></div>		  
				<div id="clockdiv">
						  <div id="clockdays">
							<span class="days">00</span><div class="smalltext">HARI</div>
						  </div><div  id="clockhours">
							<span class="hours">00</span>
							<div class="smalltext">JAM</div>
						  </div><div  id="clockminutes">
							<span class="minutes">00</span>
							<div class="smalltext">MENIT</div>
						  </div><div>
							<span class="seconds">00</span>
							<div class="smalltext">DETIK</div>
						  </div>
						  
				</div>
';	
?>


<?php echo $foto?>
<!--<form id="quiz_form_login" name="quiz_form_login"  method="get" role="form" class="quiz_form_login form-konfirmasi">-->
<form id="quiz_form_login" name="quiz_form_login"  method="get" role="form">
<div class='row'>
<div class='col-sm-8'>
<div id="konfirmasi-tes" class='div-form-login'>
<div class="block-title cek-biodata">
  <h1>Biodata Anda</h1>
</div>

<input type="hidden" name="uniq"  value="<?php echo uniqid();?>"/>
<input type="hidden" name="schedule_id" value="<?php echo md5(md5(md5($data_schedule['id'])))?>" />
<div class="form-baris form-group">
	<label for="username" class="label-isi">Kode Peserta</label>
	<span class="form-isi"><?php echo $data_member['username'];?></span>
</div>		
<div class="form-baris form-group">
	<label for="username" class="label-isi">Nama</label>
	<span class="form-isi"><?php echo $data_member['fullname'];?></span>
</div>		
<div class="form-baris form-group">
	<label for="username" class="label-isi">Kelas</label>
	<span class="form-isi"><?php echo $data_member['class'];?></span>
</div>
<div class="form-baris form-group">
	<label for="username" class="label-isi">Kode Soal</label>
	<span class="form-isi"><?php echo $data_quiz['code'];?></span>
</div>		
<div class="form-baris form-group">
	<label for="username" class="label-isi">Ujian</label>
	<span class="form-isi"><?php echo $data_quiz['title_id'];?></span>
</div>
<div class="form-baris form-group">
	<label for="username" class="label-isi">Durasi</label>
	<span class="form-isi"><?php echo $data_quiz['duration'];?> Menit</span>
</div>
<?php
if($data_schedule['is_late'])
{
?>
<div class="form-baris form-group">
	<label for="username" class="label-isi">Tanggal</label>
	<span class="form-isi"><?php echo tanggal(date("d",strtotime($data_schedule['tanggal'])),date("m",strtotime($data_schedule['tanggal'])),date("Y",strtotime($data_schedule['tanggal'])));?>
	</span>
</div>		
<div class="form-baris form-group">
	<label for="username" class="label-isi">Jam Mulai</label>
	<span class="form-isi"><?php echo date("H:i",strtotime($data_schedule['tanggal']));?>
	</span>
</div>		
<?php
}else{
?>
<div class="form-baris form-group">
	<label for="username" class="label-isi">Dibuka</label>
	<span class="form-isi">
	<?php 
	if($data_schedule['tanggal']!=""){
	echo tanggal(date("d",strtotime($data_schedule['tanggal'])),date("m",strtotime($data_schedule['tanggal'])),date("Y",strtotime($data_schedule['tanggal'])));
	echo "&nbsp;&nbsp;".date("H:i",strtotime($data_schedule['tanggal']));
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
//die($berjalan);
$sisa_waktu_mulai=$waktu_ujian-$waktu_sekarang;

$sisa_waktu_mulai_menit=(abs($berjalan)-$data_quiz['duration']);

if($data_schedule['is_late'])
{
?>
<div class="form-baris form-group">
	<label for="username" class="label-isi">Jam Berakhir</label>
	<span class="form-isi"><?php echo date("H:i",$waktu_selesai);?>
</div>		
<?php
}
else
{
?>
<div class="form-baris form-group">
	<label for="username" class="label-isi">Kadaluarsa</label>
	<span class="form-isi">
<?php 
	if($data_schedule['tanggal_expired']!=""){
	echo tanggal(date("d",strtotime($data_schedule['tanggal_expired'])),date("m",strtotime($data_schedule['tanggal_expired'])),date("Y",strtotime($data_schedule['tanggal_expired'])));
	echo "&nbsp;&nbsp;".date("H:i",strtotime($data_schedule['tanggal_expired'])); 
	}else{
	echo "-";
	}
	?>
	</span>
</div>		
<?php
}
?>
</div>
</div>
<div class='col-sm-4'>
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
		
		if($waktu_sekarang>=$waktu_ujian and  abs($berjalan)<$data_quiz['duration'] and $berjalan<0){
			
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
				echo "<p><h3>Apakah data sudah benar? a</h3></p>";
				echo '<div class="d-flex justify-content-evenly">';
				if($tunggu){
				/*
				echo '
				<input type="button" id="quiz_login_button" class="quiz_button"  value="Iya data sudah benar" onclick="return cek_data();">
				<input type="hidden" name="mulai_ujian"  value="Iya data sudah benar"/>';	
				*/
				echo '<input type="button" class="quiz_button" id="quiz_wait_button" onclick="wait_button();" name="tunggu_ujian"  value="Iya data sudah benar"/>';	
				}else{
				echo '
				<input type="button" id="quiz_login_button" class="quiz_button"  value="Iya data sudah benar" onclick="return cek_data();">
				<input type="hidden" name="mulai_ujian"  value="Iya data sudah benar"/>';
				}
				echo "<input type=\"button\"  class=\"quiz_button\" id=\"quiz_back_button\"  name=\"back\" onclick=\"window.location.href='".$url_back."'\" value=\"Kembali\"/>";
				echo "</div>";
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
		echo "<input type=\"button\"  class=\"quiz_button\" id=\"\"  name=\"back\" onclick=\"window.location.href='".$url_back."'\" value=\"Kembali\"/>";	
		echo "</div>";
	}
	?>
	
</div>
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
<link href="<<<TEMPLATE_URL>>>/css/login.css" rel="stylesheet">
<form method="get" role="form" class="quiz_form_login " id="form-login">
<!--<div class="logo">
<?php echo "<img src=\"$logo\" alt=\"$web_config_name\" title=\"$web_config_name\" />"; ?>
</div>-->
<h1>User Login</h1>

<div class="form-group">
	<table>
		<tr>
			<td align="right">Kode Peserta</td>
			<td><i class="glyphicon glyphicon-user"></i><input type="text" class="form-control"  id="kode_login" name="username" autocomplete="off" required="required" placeholder="Kode Peserta" value="<?php echo $_POST['username'];?>"  required="required"/></td>
		</tr>
		<tr>
			<td align="right">Token</td>
			<td><i class="glyphicon glyphicon-lock"></i><input type="text" class="form-control"  id="jadwal_token" name="jadwal_token" autocomplete="off" required="required" placeholder="Token" value="<?php echo $_POST['jadwal_token'];?>"  required="required"/></td>
		</tr>
		<tr>
			<td class="mobile-hidden"></td>
			<td>
				<input type="hidden" name="uniq"  value="<?php echo uniqid();?>"/>
				<input type="submit" class="btn btn-success" name="submit"  value="Mulai Ujian"/><br/>
				<?php if($web_config_mode_login==1) :?>
				<a href="<?php echo url_back_login();?>"><input type="button" class="btn btn-primary" name="back"  value="Kembali"/></a>
				<?php endif;?>
			</td>
		</tr>
	</table>
		
						
<!--	<label for="username">Kode Peserta</label>
	<input type="text" class="form-control"  id="kode_login" name="username" autocomplete="off" required="required" placeholder="Kode Peserta" value="<?php echo $_POST['username'];?>"  required="required"/>
<div class="form-group">
	<label for="jadwal_token">Token</label>
	<input type="text" class="form-control"  id="jadwal_token" name="jadwal_token" autocomplete="off" required="required" placeholder="Token" value="<?php echo $_POST['jadwal_token'];?>"  required="required"/>
</div>		
<div class="form-group">
		<input type="hidden" name="uniq"  value="<?php echo uniqid();?>"/>
		<input type="submit" class="quiz_button" name="submit"  value="Mulai Ujian"/>
</div>-->
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
$back_button= "<input type=\"button\"  class=\"quiz_button\" id=\"quiz_back_button\"  name=\"back\" onclick=\"window.location.href=\'".$url_back."\'\" value=\"Kembali\"/>";
//$back_button= "<input type=\"button\"  class=\"quiz_button\" name=\"mulai_ujian\" onclick=\"window.location.href=\'".fronturl("quiz_login")."\'\" value=\"Kembali\"/>";	
$style_css['quiz_login']=<<<END
<style>

.row{
margin:0 !important;
}

.ui-dialog-buttonset > button {
    border: none;
    padding: 11px;
}
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
#clockdiv > div {
    height: 43px;
    font-size: 18px;
    line-height: 12px;
}
#divwaktu{
padding:5px;
}
#clockdiv{
    font-family: sans-serif;
    color: white;
	display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 30px;
    width:100%;

}

#clockdiv > div{
    padding: 2px;
    border-radius: 3px;
    background: #333;
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
	background-color: #aaa;
  
  /*
  position:absolute;
  left:12px;
  */
}
.ui-dialog-buttonset > button:first-child {
  
background-color: lightseagreen;
  
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
  background-color: #856404 !important;
}


#quiz_action_wrap {
    background-color: #fff;
    border-radius: 20px;
    margin-top: 11px;
    padding: 20px;
    border: 1px solid #ccc;
}

.quiz_button {
  height: 48px;
  font-weight: 500;
}
h2#swal2-title {
    color: #333;
    margin-bottom: 15px;
}
.swal2-actions {
    margin-top: 30px !important;
}
.swal2-styled.swal2-confirm {
    width: 46%;
    margin: 0 2%;
    background: #e6ac02 !important;
}
.swal2-styled.swal2-cancel {
    background: #aaa !important;
    width: 46%;
    margin: 0 2%;
}
.swal2-content {
    font-size: 15px !important;
    color: #777 !important;
}
.swal2-popup {
    border-radius: 20px !important;
    padding: 30px !important;
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
  color:$color_v6;
  display: block;
  margin: 0 auto;
  padding: 0px;
  position: relative;
  text-align: center;
}

#quiz_action_wrap h3 {
    font-size: 14pt;
    margin: 0 0 24px 0px;
    text-align: center;
    font-weight: 600;
}
@media (min-width: 500px) {
.login-div {
  margin: 0 auto;
  width: 500px;
  float: none;
}
}
@media (min-width: 401px) {
#quiz_login_button, #quiz_wait_button,#quiz_login_button:hover, #quiz_wait_button:hover {
    background-color: #e6ac02;
    margin-bottom: 8px;
    width: 200px;
    border: none !important;
    border-radius: 10px;
    padding: 10px 20px;
    color: #fff;
}
#quiz_back_button,#quiz_back_button:hover {
	width: 200px;
	border: medium none !important;
	color: black;
	border-radius:10px;
}
.d-flex.justify-content-evenly {
    display: flex;
    justify-content: space-evenly;
}
}
@media (max-width: 400px) {
#quiz_login_button,#quiz_wait_button {
  background-color: lightseagreen;
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

}
</style>
END;

$sisa_waktu_mulai=$sisa_waktu_mulai!=""?$sisa_waktu_mulai:0;
$message_timer=$message_timer!=""?$message_timer:"";
$init=$init!=""?$init:0;

if($_POST['submit']!='') {

	$run_js_script2=<<<END
	$(document).ready(function(){
		
		if($("#clockdiv").length>0){
			deadline = new Date(Date.parse(new Date()) + ($sisa_waktu_mulai * 1000));
			setTimeout(function(){
			
			initializeClock('clockdiv', deadline,$init);
			
			},500);
		}
	});
	
END;
	
}
if($message_timer!='') {
	$message_timer='document.getElementById("divwaktu").innerHTML ="'.$message_timer.'";';
}
$script_js['quiz_login']=<<<END
<script>

//larang back
(function (global) { 

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {            
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);


/*22 juni 2020 bugfix cookies dan localstorage tidak enabled*/
need_cookies=0;
need_localstorage=0;
try {
  localStorage.clear();
  localStorage.setItem('soal_ke',1);
} catch (e) {
  need_localstorage=1;
}


var timeout=5;
	var durasi=$sisa_waktu_mulai;
	var jalan = 0;
	var habis = 0;
	var init_start=$init;
	


	
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
  
  $message_timer
  
  
 
  
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


	
	

function waktuhabis_3(){

	wait_n_start=$("#wait_n_start").val();
	if(wait_n_start==1)
	{
	$("#quiz_action_wrap").html('<p><h3>Apakah data benar?</h3><input type="button" class="quiz_button" id="quiz_login_button" onclick="return cek_data();" value="Mulai ujian!"/>$back_button<input type="hidden" name="mulai_ujian"  value="Iya data sudah benar"/></p>');
	pakta_integritas();
	//$("#quiz_action_wrap").html("");
	//$("#quiz_action_wrap").html('$web_config_paktaintegritas <input type="submit" class="quiz_button" id="quiz_login_button" name="mulai_ujian"  value="Setuju"/>');
	//$("#quiz_login_button").click();
	}
	else
	{
	$("#quiz_action_wrap").html('<p><h3>Apakah data benar?</h3><input type="button" class="quiz_button" id="quiz_login_button" onclick="return cek_data();" value="Mulai ujian!"/>$back_button<input type="hidden" name="mulai_ujian"  value="Iya data sudah benar"/></p>');
	}
	
}
	
	
	$(document).ready(function(){
	/*22 juni 2020 bugfix cookies dan localstorage tidak enabled*/
	if (navigator.cookieEnabled) {
		
	} else 
	{
		need_cookies=1;
	}
	if(need_cookies==1) {
		setTimeout(function(){
		Swal.fire({
			  title: 'Memerlukan Cookie',
			  text: "Cookie tidak diaktifkan pada browser Anda. Untuk melanjutkan ujian, aktifkan cookie dalam preferensi browser.",
			  icon: 'error',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  confirmButtonText: 'OK',
			}).then((result) => {
			  
			});
		},1000);
	}
	//run timer
	$run_timer
	
/*	
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
*/
/*
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
*/	
	
	
	});
	
	function cek_data()
	{
	//$("#dialog-confirm-mulai").dialog("open");
	pakta_integritas();
	}	
	function pakta_integritas() {
		Swal.fire({
		  title: '$web_config_judulpaktaintegritas',
		  text: "$web_config_paktaintegritas",
		  icon: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Setuju',
		  cancelButtonText: 'Batal'
		}).then((result) => {
		  if (result.value) {
			document.getElementById("quiz_form_login").submit();
		  }
		});
	}
	

	function wait_button() {
	
	$("#wait_n_start").val(1);
	$("#quiz_action_wrap").html("<p class='msg-tunggu'>Silahkan tunggu! <br/>Setelah hitung mundur selesai, Anda akan diarahkan ke halaman ujian secara otomatis.Jika halaman ini bermasalah silahkan tekan tombol berikut <a href='$this_url'><button type='button' class='quiz_button'>Refresh Halaman</button></a> </p>");

	}
	function waktuhabis_1(){
		document.getElementById("divwaktu").innerHTML = "";
		$("#quiz_action_wrap").html('Ujian sudah kadaluarsa');
	}
</script>

END;

?>

