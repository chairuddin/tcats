<?php
$bahas_soal=1;
/*
if($web_config_mode_login){	
	$url_login = fronturl("siswa/dashboard");	
} else {
	$url_login = fronturl("quiz_login");				
}
*/ 
$token=$action;
$pil_soal=array();
$pil_jawab=array();
if($token!="")
{
	$q=$mysql->query("SELECT q.*,p.pg paket_pg,p.essay paket_essay,p.complex paket_complex FROM quiz_done q LEFT JOIN quiz_done_paket p ON p.quiz_done_id=q.id WHERE q.token='$token' AND q.is_done=1");
	if($q and $mysql->numrows($q)>0)
	{
		$member_data=$mysql->assoc($q);
	}
	else
	{
		//quiz_login();
	}
}
else
{
	//quiz_login();
}
$member_id=$member_data['member_id'];
$is_ragu=json_decode($member_data['ragu'],true);

$last_digit=substr($member_id,-1,1);
$last_digit=$last_digit<3?5:$last_digit;
$start_time=$member_data['start_time'];
$this_time=strtotime(date("Y-m-d H:i:s"));
$quiz_duration= ($member_data['quiz_duration']*60);

$end_time=strtotime($start_time)+$quiz_duration;
$quiz_left_duration=$end_time-$this_time;

/*
if($quiz_left_duration<=0){
	$quiz_left_duration=0;
	if($_POST['token']!="" and !$_POST['selesai'] and $member_data['start_time']!="" and $member_data['quiz_duration']!="" and $quiz_left_duration==0 )
	{	
		submit_jawaban($_POST['token']);
	}
}


if($_POST['token']!="" and $_POST['selesai'])
{
	submit_jawaban($_POST['token']);
}
*/ 

?>
<link href="<<<TEMPLATE_URL>>>/css/ujian.css?1=3" rel="stylesheet">
<div class="koneksi_bermasalah" style="display:none;">Tidak terhubung dengan server</div>
<div class="koneksi_putus" style="display:none;">Koneksi bermasalah</div>
<div class="koneksi_lambat" style="display:none;">Koneksi internet anda terlalu lambat. Silahkan gunakan internet yang stabil dan refresh halaman ini</div>
<form onsubmit="cek_jawaban();return false;" name="formulir" id="formulir" method="post" action=""    >
<input type="hidden" id="otomatis" name="otomatis" value="0">
<div class='container alma-container'>
<div class='row'>
<div class='col-md-12'>
<!--<div id="divbiodata">-->
<h4>Pembahasan Soal <?php echo $member_data['quiz_title_id'];?></h4>
<div id="ujian-block">
<?php
$waktu_ujian_show=<<<END
<span id="divwaktu_ujian" class="sisa-waktu">
<span class="time-countdown"><div id='clockdiv'>
  <div id='clockdays'>
	<span class='days'>00:</span>
  </div>
  <div  id='clockhours'>
	<span class='hours'>00:</span>
  </div>
  <div  id='clockminutes'>
	<span class='minutes'>00:</span>
  </div>
  <div>
	<span class='seconds'>00</span>
  </div>
</div>	
</span>
</span>
END;
echo $waktu_ujian_show;
$panel_user.='
		<div id="user-welcome">
			<i class="glyphicon glyphicon-user"></i>
			<div class="right-side-welcome">
				<div class="nama-siswa">
				'.$member_data['member_fullname'].'<br/>
				'.$member_data['member_class'].'<br/>
				'.$member_data['quiz_code'].'|'.$member_data['quiz_title_id'].'<br/>
				</div>
				
			</div>
		</div>
';
?>

<div id="waktuhabis">
	<div id="countdown"></div>	
	<div id="message-final">
	<h1>Durasi ujian sudah habis</h1>
	<p>Sistem akan melakukan submit secara otomatis </p>
	<img src="<?php echo fileurl("asset/ajax-loader.gif")?>">
	
	<br/>
	</div>
</div>
<div id="submit_ujian">
	<div id="message-final">
	<h1>Silahkan tunggu beberapa saat</h1>
	<p>Sistem akan melakukan submit secara otomatis </p>
	<img src="<?php echo fileurl("asset/ajax-loader.gif")?>">
	</div>
</div>
<!--<div id="formulir_ujian" >-->

<?php

$answer_temp=json_decode($member_data['answer_temp'],true);
$acak=$member_data['acak'];
$acak_essay=$member_data['paket_essay'];
$acak_complex=$member_data['paket_complex'];
$acak_pilihan=json_decode($member_data['acak_pilihan'],true);


$r_json_soal=get_soal_json($member_data['quiz_id']);
		

$total=0;
if(count($r_json_soal['soal_ganda'])>0)
{
	$no=0;
	//$total=count($r_json_soal['soal_ganda']);
	
	//while($v=$mysql->assoc($q))
	$r_acak=explode(",",$acak);	
	$total=count($r_acak);
	
	foreach($r_acak as $index)
	{
		$v=$r_json_soal['soal_ganda'][$index];
		$no++;
		if($no>1)
		{
		$button_sebelum='<a class="prev-page btn btn-default" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="glyphicon glyphicon-chevron-left"></i> Kembali ke soal '.($no-1).'</a>';
		}
		else
		{
		$button_sebelum="<a href=\"#\"></a>";
		}
		if($no<$total)
		{
		$button_berikut='<a  class="next-page btn btn-primary" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')">Lanjut ke soal '.($no+1).'<i class="glyphicon glyphicon-chevron-right"></i></a>';
		}
		else
		{
		$button_berikut="<a href=\"#\"></a>";
		/*cek apakah ada essay*/
		//$q_cek_essay=$mysql->query("SELECT id FROM quiz_essay WHERE quiz_id='".$member_data['quiz_id']."' ORDER BY id limit 1");
		//if($q_cek_essay and $mysql->numrows($q_cek_essay)>0){
		if(count($r_json_soal['soal_essay'])>0 or count($r_json_soal['soal_complex'])>0){
			$button_berikut='<a  class="next-page btn btn-primary" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')">Lanjut ke soal '.($no+1).'<i class="glyphicon glyphicon-chevron-right"></i></a>';	
		}
		
		}
		
		//$no_sss=md5($v['id']);		
		$no_sss=$v['id'];
		
		?>
		<div class='wrap_soal' id="wrap_soal<?php echo $no?>" berikut="<?php echo $button_berikut!=""?($no+1):"";?>">
			<div id="ukuran-soal">
				<div class='navigation_button'>
				<?php
				//echo $button_sebelum;
				echo "<div class='nomor-soal'>Soal No<span>$no</span></div>";	 
				//echo $button_berikut;
				?>
				</div>
			</div>
			<div class="body-ujian" >
			<div class="body-line" >
			<div class='soal_desc question-block'>
			
			<?php 
			// echo "<h4 class=\"subtitle_quiz\">Soal Pilihan Ganda</h4>";	
			echo $v['question'];
			?>
			</div>
			<?php
				$pilihan=$pilihan_ganda;
				$ada_pilihan=0;
				foreach($pilihan as $i=>$pil)
				{
					if(trim(strip_tags($v[$pil]))!="-"){	
					$ada_pilihan++;
					}
				}
			?>
			<div class='answer-block'>
			<!--<h4 class="subtitle_quiz"><?php echo $ada_pilihan>0?"Pilihan Jawaban":"";?></h4>-->
				<?php
				$acak_jawaban=array();
				
				$jawaban=$answer_temp[$no];//$_COOKIE['soal'.$no];
				
				$tanda[$no]=$jawaban!=""?1:0;

				$pesan='<span class="alert alert-warning">Jawaban anda salah.</span>';
				if($jawaban==$v['answer']) {
					$pesan='<span class="alert alert-success">Jawaban anda benar.</span>';
				}
				$pesan_jawaban[$no]=$pesan;
				
				
				foreach($pilihan as $i=>$pil)
				{
					$checked=$class_checked="";
					if(trim(strip_tags($v[$pil]))!="-"){
						
					if($jawaban!="" AND $jawaban==$pil)
					{
						//setcookie("soal$no",$jawaban,time() + 86400 , "/");
						$pil_soal[$no]=$jawaban;
						$checked="checked='checked'";
						$class_checked="answer_checked";
					}
					
					//document.getElementById(jawaban+i).checked=true;	
					ob_start();
					?>
						<div class="kolom_input"  <?php echo $pil==$v['answer']?'style="border:2px solid green;"':'';?>>		
							<input mark-choice="mark-value" onclick="<?php echo $no<$total?"tampilkan_soal_delay('".($no+1)."',$web_config_navigasi_soal)":""; ?>" class="radio_pilihan icheck-me"  <?php echo $checked;?> id="<?php echo $pil.$no;?>" type="radio" meta-urutan="<?php echo $no;?>" meta-name="soal<?php echo $no;?>" meta-label="label_<?php echo $pil.$no;?>" meta-type="pilihan_ganda" name="soal_<?php echo $no_sss;?>" value="<?php echo $pil;?>" />
							<label id="label_<?php echo $pil.$no;?>" class="soal<?php echo $no;?> <?php echo $class_checked;?>" for="<?php echo $pil.$no;?>">
							<div class="abjad"><?php //echo $pil;?></div>
							<?php echo $v[$pil];?></label>
						</div>
						
					<?php
					$acak_jawaban[$pil]=ob_get_clean();
				
					}
				
				}
				$ip=0;
				foreach($acak_pilihan[$v['id']] as $xx => $zz)
				{	
					if($jawaban==$zz){
						
						//setcookie("jawab_soal$no",$pilihan[$ip],time() + 86400 , "/");
						$pil_jawab[$no]=$pilihan[$ip];
					}				
					
					echo str_replace('mark-value',$pilihan[$ip],$acak_jawaban[$zz]);
					$ip++;
				}
				echo "<br/><p>";
				echo $pesan_jawaban[$no];
				echo "</p>";
				?>
				
				<?php if($mode_pembahasan) { ?>
					<br/>
					<b>Pembahasan:</b><br/>
					<div><?php echo $v['pembahasan']?></div>
				<?php }?>
				
			</div>
			</div>
			</div>
			<div class="footer-ujian">
				<?php echo $button_sebelum;?>
 
				<div class="jawaban-ragu">
					<label for="ragu<?php echo $no;?>"><input type="checkbox" name="ragu[<?php echo $no?>]"  class="ragu-button" id="ragu<?php echo $no?>" nomor-soal="<?php echo $no?>" <?php echo $is_ragu[$no]?'checked="checked"':'';?> value="1" /> Ragu-Ragu</label>
				</div>
				<?php echo $button_berikut;?>
			</div>
		</div>
		<?php
	}
	
	//create panel answer 
	$panel_answer="";
	
	for($i=1;$i<=$total;$i++)
	{
		//$tandai=$tanda[$i]==1?"style='background-color: rgb(40, 171, 227); border: 1px solid; display: block;'":"";
		$tandai=$tanda[$i]==1?"panel_answer_checked":"";
		$class_ragu=$is_ragu[$i]?' ragu':'';
		$panel_answer.="<li><span class='checked_answer $tandai button-list-jawaban$class_ragu'  onclick='tampilkan_soal($i)' id='check_soal$i'>$i<span class='check_abc' id='answer_soal$i'></span></span></li>";
		
	}
}
########COMPLEX
$total_complex=0;
if(count($r_json_soal['soal_complex'])>0)
{
	
	//$no=0;
	//$total=count($r_json_soal['soal_ganda']);
	
	//while($v=$mysql->assoc($q))
	$r_acak_complex=explode(",",$acak_complex);	
	$total_complex=count($r_acak_complex);
		
	$json_jawab_complex=$mysql->get1value("SELECT answer FROM quiz_done_complex WHERE id_quiz_done='".$member_data['id']."'  ",'id');
	$r_jawab_complex=json_decode($json_jawab_complex,true);
	foreach($r_acak_complex as $index)
	{
		
		$v=$r_json_soal['soal_complex'][$index];
		$no++;
		if($no>1)
		{
		$button_sebelum='<a class="prev-page btn btn-default" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="glyphicon glyphicon-chevron-left"></i>Kembali ke soal '.($no-1).'</a>';
		}
		else
		{
		$button_sebelum="<a href=\"#\"></a>";
		}
		if($no<$total)
		{
		$button_berikut='<a  class="next-page btn btn-primary" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')">Lanjut ke soal '.($no+1).'<i class="glyphicon glyphicon-chevron-right"></i></a>';
		}
		else
		{
		$button_berikut="<a href=\"#\"></a>";
		/*cek apakah ada essay*/
		//$q_cek_essay=$mysql->query("SELECT id FROM quiz_essay WHERE quiz_id='".$member_data['quiz_id']."' ORDER BY id limit 1");
		//if($q_cek_essay and $mysql->numrows($q_cek_essay)>0){
		if(count($r_json_soal['soal_essay'])>0){
			$button_berikut='<a  class="next-page btn btn-primary" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')">Lanjut ke soal '.($no+1).'<i class="glyphicon glyphicon-chevron-right"></i></a>';	
		}
		
		}
		
		//$no_sss=md5($v['id']);		
		$no_sss=$v['id'];
		
		?>
		<div class='wrap_soal' id="wrap_soal<?php echo $no?>" berikut="<?php echo $button_berikut!=""?($no+1):"";?>">
			<div id="ukuran-soal">
				<div class='navigation_button'>
				<?php
				//echo $button_sebelum;
				echo "<div class='nomor-soal'>Soal No<span>$no</span></div>";	 
				//echo $button_berikut;
				?>
				</div>
			</div>
			<div class="body-ujian" >
			<div class="body-line" >
			<div class='soal_desc question-block'>
			
			<?php 
			// echo "<h4 class=\"subtitle_quiz\">Soal Pilihan Ganda</h4>";	
			echo $v['question'];
			?>
			</div>
			<?php
				$pilihan=$pilihan_ganda;
				$ada_pilihan=0;
				foreach($pilihan as $i=>$pil)
				{
					if(trim(strip_tags($v[$pil]))!="-"){	
					$ada_pilihan++;
					}
				}
				
			?>
			<div class='answer-block'>
			<!--<h4 class="subtitle_quiz"><?php echo $ada_pilihan>0?"Pilihan Jawaban":"";?></h4>-->
				<?php
				$acak_jawaban=array();
				
				$r_jawaban=str_split($r_jawab_complex[$v['id']]);
				
				$tanda[$no]=$jawaban!=""?1:0;
				
				
				foreach($pilihan as $i=>$pil)
				{
					$checked=$class_checked="";
					if(trim(strip_tags($v[$pil]))!="-"){
						
					if(count($r_jawaban)>0 AND in_array($pil,$r_jawaban))
					{
						//setcookie("soal$no",$jawaban,time() + 86400 , "/");
						$pil_soal[$no]=$jawaban;
						$checked="checked='checked'";
						$class_checked="answer_checked";
					}
					
					//document.getElementById(jawaban+i).checked=true;	
					ob_start();
					?>
						<div class="kolom_input">		
							<input mark-choice="mark-value" onclick="<?php echo $no<$total?"tampilkan_soal_delay('".($no+1)."',$web_config_navigasi_soal)":""; ?>" class="radio_complex icheck-me"  <?php echo $checked;?> id="<?php echo $pil.$no;?>" type="checkbox" meta-type="pilihan_complex" meta-urutan="<?php echo $no;?>" meta-name="soal<?php echo $no;?>" meta-label="label_<?php echo $pil.$no;?>" name="complex_<?php echo $no_sss;?>[]" value="<?php echo $pil;?>" />
							<label id="label_<?php echo $pil.$no;?>" class="soal<?php echo $no;?> <?php echo $class_checked;?>" for="<?php echo $pil.$no;?>">
							<div class="abjad"><?php //echo $pil;?></div>
							<?php echo $v[$pil];?></label>
						</div>
						
					<?php
					$acak_jawaban[$pil]=ob_get_clean();
				
					}
				
				}
				$ip=0;
				/*
				foreach($acak_pilihan[$v['id']] as $xx => $zz)
				{	
					if($jawaban==$zz){
						
						//setcookie("jawab_soal$no",$pilihan[$ip],time() + 86400 , "/");
						$pil_jawab[$no]=$pilihan[$ip];
					}				
					
					echo str_replace('mark-value',$pilihan[$ip],$acak_jawaban[$zz]);
					$ip++;
				}
				* */
				
				foreach($acak_jawaban as $x => $z ) {
					echo $z;
					
				}
				?>
			
			<p><br/><i>*Opsi pilihan jawaban diatas bisa dipilih lebih dari satu</i></p>	
			</div>
			</div>
			</div>
			<div class="footer-ujian">
				<?php echo $button_sebelum;?>
				<div class="jawaban-ragu">
					<label for="ragu<?php echo $no;?>"><input type="checkbox" name="ragu[<?php echo $no?>]"  class="ragu-button" id="ragu<?php echo $no?>" nomor-soal="<?php echo $no?>"  <?php echo $is_ragu[$no]?'checked="checked"':'';?>  value="1" /> Ragu-Ragu</label>
				</div>
				<?php echo $button_berikut;?>
			</div>
		</div>
		<?php
	}
	
	//create panel answer 
	//$panel_answer="";
	
	for($i=$total+1;$i<=$total_complex+$total_complex;$i++)
	{
		//$tandai=$tanda[$i]==1?"style='background-color: rgb(40, 171, 227); border: 1px solid; display: block;'":"";
		$tandai=$tanda[$i]==1?"panel_answer_checked":"";
		//<span class='check_abc' id='answer_soal$i'></span>
		$class_ragu=$is_ragu[$i]?' ragu':'';
		$panel_answer.="<li><span class='checked_answer $tandai button-list-jawaban$class_ragu'  onclick='tampilkan_soal($i)' id='check_soal$i'>$i</span></li>";
		
	}
}

////////////////ESSAY
	
$r_jawab_essay=$mysql->query_data("SELECT id_quiz_essay,answer FROM quiz_done_essay WHERE id_quiz_done='".$member_data['id']."'  ",'id_quiz_essay');

$ada_essay=0;
$total_essay=0;
//if($q and $mysql->numrows($q)>0)
if(count($r_json_soal['soal_essay'])>0)
{
	$ada_essay=1;
	//$total_essay=$mysql->numrows($q);
	//$total_essay=count($r_json_soal['soal_essay']);
	$r_acak_essay=explode(",",$acak_essay);	
	$total_essay=count($r_acak_essay);
	$r_no_essay=array();
	$no_essay=0;
	//while($v=$mysql->assoc($q))
	//foreach($r_json_soal['soal_essay'] as $v)
	
	foreach($r_acak_essay as $index)
	{
		$v=$r_json_soal['soal_essay'][$index];

		$no++;
		$no_essay++;
		$r_no_essay[]=$no;
		if($no_essay>1)
		{
		// $button_sebelum='<a class="navigasi-kiri quiz_navigation" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="fa fa-arrow-left"></i></a>';
		$button_sebelum='<a class="prev-page btn btn-default" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="glyphicon glyphicon-chevron-left"></i>Kembali ke soal '.($no-1).'</a>';
		}
		else
		{
		//kembali ke pilihan ganda	
		// $button_sebelum='<a class="navigasi-kiri quiz_navigation" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="fa fa-arrow-left"></i></a>';	
		$button_sebelum='<a class="prev-page btn btn-default" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="glyphicon glyphicon-chevron-left"></i>Lannjut ke soal'.($no-1).'</a>';
		//$button_sebelum="";	
		}
		if($no_essay<$total_essay)
		{
		//$button_berikut='<a  class="navigasi-kanan" href="#wrap_soal'.($no+1).'"  onclick="tampilkan_soal('.($no+1).')"><i class="fa fa-arrow-right"></i></a>';
		// $button_berikut='<a  class="navigasi-kanan quiz_navigation" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')"><i class="fa fa-arrow-right"></i></a>';
		$button_berikut='<a  class="next-page btn btn-primary" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')">Lanjut ke soal '.($no+1).' <i class="glyphicon glyphicon-chevron-right"></i></a>';
		}
		else
		{
		$button_berikut="<a href=\"#\"></a>";
		}
		
		$no_sss=md5($v['id']);		
		?>
		<div class='wrap_soal' id="wrap_soal<?php echo $no?>">
			<div id="ukuran-soal">
				<div class='navigation_button'>
				<?php
				///echo $button_sebelum;
				echo "<div class='nomor-soal'>Soal No<span>".$no."</span></div>";	
				//echo $button_berikut;
				?>
				</div>
			</div>
			<div class="body-ujian">
				<div class="body-line">
				<!--<div class='soal_desc <?php echo $v['model']==0?"col-md-12":"col-md-6";?>'>-->
					<div class="question-block">
					<?php 
					// echo "<h4 class=\"subtitle_quiz\">Soal Uraian</h4>";
					echo $v['question'];
					?>
					</div>
				<!--<div class='pilihan_essay <?php echo $v['model']==0?"vertical col-md-12":"horizontal col-md-6";?>'>-->
					<div class='answer-block'>
					<br/>
					<!--<h4 class="subtitle_quiz"><?php echo $ada_pilihan>0?"Silakan isi jawaban":"";?></h4>-->
					<?php
					$tanda_essay[$no]=$r_jawab_essay[$v['id']]['answer']!=""?1:0;
					/*
					<input type="text" onkeyup="isi_essay(<?php echo $v['id'];?>)" class="form-control" style="max-width:500px;" value="<?php echo $r_jawab_essay[$v['id']]['answer'];?>" name="essay_<?php echo $v['id'];?>" id="essay_<?php echo $v['id'];?>" /> 
					* */
					?>
						<div class="input_essay"></div>
						<textarea onkeyup="isi_essay(<?php echo $v['id'];?>)" class="form-control" style="max-width:500px;" name="essay_<?php echo $v['id'];?>" id="essay_<?php echo $v['id'];?>" ><?php echo $r_jawab_essay[$v['id']]['answer'];?></textarea>
						<br/>
					
						<div class="input_jawaban"><button type="button" class="btn btn-success" onclick="jawab_essay(<?php echo $v['id'];?>,<?php echo $no_essay<$total_essay?($no+1):"''";?>,<?php echo $web_config_navigasi_soal;?>,<?php echo $no;?>)" >Simpan Jawaban</button></div>
						<p><i>*Tekan tombol SIMPAN JAWABAN setelah mengisi jawaban diatas</i></p>
						<div style="display:none;" class="loading_jawaban_<?php echo $v['id'];?>"><img src="<?php echo fileurl("asset/ajax-loader.gif")?>" /></div>
						<div class="msg_jawaban_<?php echo $v['id'];?>" style="font-style: italic;font-size: 10pt; text-align: left;"></div>
						

					</div>
				</div>
			</div>
		
			<div class="footer-ujian" style="width:100%;">
				<?php echo $button_sebelum;?>
				<div class="jawaban-ragu">
					<label for="ragu<?php echo $no;?>"><input type="checkbox" name="ragu[<?php echo $no?>]"  class="ragu-button" id="ragu<?php echo $no?>" nomor-soal="<?php echo $no?>"  <?php echo $is_ragu[$no]?'checked="checked"':'';?>  value="1" /> Ragu-Ragu</label>
				</div>			
				<?php echo $button_berikut;?>
			</div>
			
	
		</div>
		<?php
	}
	//create panel answer 
	
	
	//for($i=1;$i<=$total;$i++)
	foreach($r_no_essay as $x => $i)
	{
		//$panel_answer_essay.="<span  onclick='tampilkan_soal($i)' id='check_soal_$i'>".($x+1)."</span>";
		$tandai=$tanda_essay[$i]==1?"panel_answer_checked":"";
		$class_ragu=$is_ragu[$i]?' ragu':'';
		//$panel_answer_essay.="<span class='checked_answer $tandai'  onclick='tampilkan_soal($i)' id='check_soal$i'>".($x+1)."</span>";
		$panel_answer_essay.="<li><span class='checked_answer button-list-jawaban $tandai $class_ragu'  onclick='tampilkan_soal($i)' id='check_soal$i'>".($i)."</span></li>";
	
	}
	
}
$logo=logo();	
$logo_instansi=logo_footer();	
?>

<input type="hidden" name="token" id="token" value="<?php echo $token;?>" />
<!-- mark button submit-->
<!--
<div id="footer-ujian">
	<a href="#" class="prev-page btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i> Soal Sebelumnya</a>
	<div class="jawaban-ragu">
		<label for="ragu"><input type="checkbox" name="ragu" id="ragu" value="1" /> Ragu-Ragu</label>
	</div>
	<a href="#" class="next-page btn btn-primary">Soal Berikutnya<i class="glyphicon glyphicon-chevron-right"></i></a>
</div>
-->
<?php

if($web_config_show_footer_instansi==1){
echo '<div class="row" id="footer-instansi">';
echo <<<END
	<div class="col-md-4"><img class="logo-instansi-footer" src="$logo_instansi" alt="logo-instansi" title="logo-instansi" /></div>
	<div class="col-md-8">$web_config_footer_instansi</div>
END;
echo '</div>';	
}



?>

</div>	

</div>
<div id="block-list-jawaban">
	
	<div id="show-hide-jawaban">
		<div class="show-jawaban"><i class="glyphicon glyphicon-chevron-left"></i> Daftar<br/>Soal</div>
		<div class="hide-jawaban"><i class="glyphicon glyphicon-chevron-right"></i></div>
	</div>
	<div class="list-jawaban-line">
		
		<ul>
		<?php 
		echo $panel_answer;
		if($ada_essay){
		?>
			
		<?php echo $panel_answer_essay;?></ul>
		<?php
		}
		?>
		<ul>
	</div>
	
</div>
<div class="auto-save-icon" style="display:none;">
<img src="<?php echo fileurl("asset/ajax-loader.gif")?>">
</div>
</div>

<div class='row' >
	<div class='col-md-12' >
		
	</div>
</div>

</div>

<div class="logo-dalam">
<?php //echo "<img src=\"$logo\" alt=\"$web_config_name\" title=\"$web_config_name\" />"; ?>
</div>


</form>
<?php
$style_css['quiz_start']=<<<END
<style>
#footer-instansi {
  background-color: hsl(0, 0%, 96%);
  padding-top: 17px;
  font-size: 8pt;
  min-height: 63px;
}
#footer-instansi p {
 line-height: 10pt;
 
}
.logo-dalam {
  bottom: 10px;
  position: fixed;
  right: 10px;
  width: 80px;
  z-index:-1;
}
.row{margin:0px !important;}
.biodata-left{
float:left;
width:calc(100% - 127px);
}
#divwaktu_ujian{
	float:right;
	}

.biodata-left > span {
	width: 100%;
	padding-right:15px;
	}
#clockdiv{
    
	color: white;
	display: inline-block;
	font-family: sans-serif;
	font-size: 16px;
	font-weight: 100;
	margin-bottom: 5px;
	text-align: center;
	
}

.prev-page,.nomor-soal span,.sisa-waktu .time-countdown,.btn-primary{background: #333;;}
.prev-page:hover,.btn-primary:hover{background:#333;color:#fff}
#clockdiv > div {
  background: #333; none repeat scroll 0 0;
  border:1px solid #333;
  display: inline-block;
  margin-right: 1px;
width:18px;  
}
#clockdiv > div > span {
  padding-top:2px;
  display:block;
}

.smalltext {
  color: white;
  font-size:7px;
  height: 10px;
  padding-top: 0;
  font-weight: bold;
}

.pilihan_ganda > ul li:nth-child(1) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(2) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(3) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(4) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(5) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(6) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(7) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(8) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(9) > .kolom_input > label > .abjad::after,
.pilihan_ganda > ul li:nth-child(10) > .kolom_input > label > .abjad::after{
	background:white;
	color:black;
	border:1px solid black;
	border-radius: 23px;
	line-height: 9px;
	margin:7px;
	padding: 8px;
	position: absolute;
	width: 26px;
	z-index: 4;
	left:0;
	top:0;
}
.pilihan_ganda .radio_pilihan{
display:none;
}
.pilihan_ganda > ul li:nth-child(1) > .kolom_input > label >  .abjad::after {content: "A";}
.pilihan_ganda > ul li:nth-child(2) > .kolom_input > label >  .abjad::after {content: "B";}
.pilihan_ganda > ul li:nth-child(3) > .kolom_input > label >  .abjad::after {content: "C";}
.pilihan_ganda > ul li:nth-child(4) > .kolom_input > label >  .abjad::after {content: "D";}
.pilihan_ganda > ul li:nth-child(5) > .kolom_input > label >  .abjad::after {content: "E";}
.pilihan_ganda > ul li:nth-child(6) > .kolom_input > label >  .abjad::after {content: "F";}
.pilihan_ganda > ul li:nth-child(7) > .kolom_input > label >  .abjad::after {content: "G";}
.pilihan_ganda > ul li:nth-child(8) > .kolom_input > label >  .abjad::after {content: "H";}
.pilihan_ganda > ul li:nth-child(9) > .kolom_input > label >  .abjad::after {content: "I";}
.pilihan_ganda > ul li:nth-child(10) > .kolom_input > label >  .abjad::after {content: "J";}


.ui-dialog-buttonset > button:last-child {
  background-color: lightpink;
  position:absolute;
  left:12px;
  border:0;
}
.ui-dialog-buttonset > button:first-child {
  background-color: lightseagreen;
  float:right;
  border:0;
}
.ui-dialog-buttonset > button{
font-weight:bold;
padding:5px;
}
.ui-dialog-titlebar-close{
background-color:red;
display:none;
}
.ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix.ui-draggable-handle {
 
}
.ui-widget-header{
 background-color: #856404 !important;
}
//#856404
.auto-save-icon {
  position: absolute;
  bottom: 10px;
  left: 10px;
}

.quiz_navigation {
  background-color: #e8b71a;
  border: 1px solid #e8b71a;
  color: white;
  display: block;
  float: left;
  font-size: 23pt;
  height: 42px;
  margin-bottom: 10px;
    padding-top: 4px;
  text-align: center;
  vertical-align: middle;
  width: 62px;
}
#waktuhabis, #submit_ujian {
  display: none;
  padding-top: 57px;
  background-color:white;
  height:520px;
}
#message-final input {
  margin: 0 auto;
}

.answered{
background-color:#28ABE3;
}

#divbiodata {
  background-color: #E8B71A;
  padding: 5px;
}

.wrap_soal_essay{
	
}
.wrap_soal {
  display: none;
  min-height: 403px	;
  padding: 30px 0 0 0;
  position: relative;
}
.wrap_soal table, .wrap_soal_essay table {
max-width:100%;
}
.pilihan_ganda.vertical >ul >li,.pilihan_ganda.horizontal >ul >li{
	list-style: none;
	margin-bottom:5px;
}
.pilihan_ganda > ul {
  margin: 0;
  padding: 0;
}
.kolom_input
{
position:relative;
margin-right:5px;
background-color:white;
}

.kolom_input > label {
border: 1px solid $color_1;

  cursor: pointer;
  font-weight: normal;
  height: 100%;
  margin: 0;
  padding: 6px 5px 8px 39px;
  width: 100%;
}
.kolom_input > label img {
  margin-top: 15px;
}
.kolom_input > input {
  left: 11px;
  position: absolute;
  top: 3px;
  cursor: pointer;
}
.pilihan_ganda.vertical > ul > li > .kolom_input {
  margin-bottom: 5px;
  
  min-height: 40px;
}
.soal_no {
  font-weight: bold;
  padding: 11px;
}
.navigation_button {
  right: 9px;
  position: absolute;
  top: 5px;
}
#countdown {
  font-size: 75px;
  text-align: center;
  height: 75px;
  color: #8d8d8d;
}
#message-final {
    font-size: 34px;
    margin-bottom: 200px;
    text-align: center;
    line-height: 36px;
    padding:0 30px 0px 30px;
}
.animasi_bulat_terpilih{
animation-name:rubberBand;
animation-duration: 0.6s;
}
.animasi_soal_masuk{
animation-name:fadeIn;
animation-duration: 1s;
}
.animasi_soal_masuk_kanan{
animation-name:fadeInRight;
animation-duration: 0.5s;
}
.animasi_soal_keluar{
animation-name:fadeOut;
animation-duration: 0.5s;
}

@media (max-width: 992px) {
.panel_answer span {
  border: 1px solid $color_1;
	cursor: pointer;
    display: block;
    float: left;
    font-size: 12pt;
    height: 40px;
    text-align: center;
    width: 35px;
    position: relative;
    padding: 16px 5px 0 0;
}
.pilihan_ganda.horizontal >ul >li{
  margin-bottom: 5px;
  min-height: 40px;
}
.panel_answer{
  background-color: white;
  border: 2px solid #e8b71a;
  margin-top: 24px;
  padding: 3px;
  width: 100%;
  display:inline-block;
}
#tombol_selesai {
  background-color: lightseagreen;
  border: 2px solid #ddd;
  display: block;
  font-weight: bold;
  margin: 25px auto;
  padding: 19px; 
  z-index:9999;
}
}
@media (min-width: 992px) {
.panel_answer span {
  border: 1px solid $color_1;
/*  border-radius: 12px; */
	cursor: pointer;
	display: block;
	float: left;
	font-size: 9pt;
	height: 40px;
	text-align: center;
	width: 28px;
	position: relative;
	padding: 16px 0 0 0;
}
.pilihan_ganda.horizontal >ul >li{
/*
width:calc(100% / 5);
float:left;
*/
}
.cek_pilihan_ganda{
	display:inline-block;
}
.cek_pilihan_essay{
	display:inline-block;
}
.panel_answer {
  background-color: white;
  border: 2px solid #e8b71a;
  padding: 3px;
  position: fixed;
  width: 150px;
  right: calc(100% /30);
  top:75px;
}
#tombol_selesai {
  background-color: lightseagreen;
  border: 2px solid #ddd;
  display: block;
  font-weight: bold;
  margin: 0	 auto;
  padding: 19px 24px;
  position: fixed;
  right: calc(100% /30);
  top: 10px;
  width:150px;
  z-index:9999;
}

}
.panel_answer h1 {
    font-size: 14px !important;
    text-align: left !important;
    padding: 9px 0 2px 0;
	margin: 0;
    width: 100%;
    display: block;
    font-weight: bold;
    clear: both;
    background-color: lightgray;
    text-align: center !important;
}
.check_abc {
	display: block !important;
    position: absolute !important;
    width: 16px !important;
    height: 16px !important;
    
    top: 6px;
    font-size: 12pt !important;
    text-align: center !important;
    line-height: 14px;
    padding: 0 !important;
    color: white;

}
.koneksi_putus {
    width: 100%;
    background-color: wheat;
    height: 100vh;
    width: 100vw;
    padding: 0;
    margin: 0;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 116;
    text-align: center;
    padding: 36vh 0;
    font-weight: bold;
}
.koneksi_lambat {
    width: 100%;
    background-color: wheat;
    height: 100vh;
    width: 100vw;
    padding: 0;
    margin: 0;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 117;
    text-align: center;
    padding: 36vh 0;
    font-weight: bold;
}

</style>
END;

//$url_login=fronturl("quiz_login");
$url_done=fronturl("quiz_done");
$fronturl=fronturl("ajax");

$sound_image=fileurl("asset/speaker.gif");
$data_pil_soal=json_encode($pil_soal);
$data_pil_jawab=json_encode($pil_jawab);

//$waktu_berjalan =  ($this_time-strtotime($start_time))/60;
$waktu_ijin_submit=(($quiz_left_duration/60)<=15)?999:999; //sisa waktu bisa disubmit
//$waktu_ijin_submit=(($quiz_left_duration/60)<=15)?10:10; //sisa waktu bisa disubmit
$script_js['quiz_start']=<<<END
<script>

	var save_now=0;
	var continue_refresh=1;
	var koneksi_bermasalah=0;
	var koneksi_lambat=0;
	var confirm_akhiri_ujian=0;
	var urutan_auto_save=0;
	var urutan_cek_valid=0;
	var timeout=5;
	//var waktu_berjalan = $waktu_berjalan;
	var sisa_waktu=999;
	var durasi_awal=$quiz_duration;
	var durasi=$quiz_left_duration;
	var waktu_ijin_submit=$waktu_ijin_submit;//menit
	var jalan = 0;
	var habis = 0;
		timer = null;
		timerping = null;

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

/*
window.addEventListener('visibilitychange', myPageShowListenerFunc, false);	
function myPageShowListenerFunc(e){
	if(confirm_akhiri_ujian<=0){
		alert('Anda dilarang menutup halaman ujian');
		e.preventDefault();
		e.stopPropagation();
	}
}
*/

function isi_essay(id_soal) {
			id=id_soal;
			$(".msg_jawaban_"+id).html('');
}
function jawab_essay(id_soal,goto,navigasi_soal,tandai_nomor) {
			id=id_soal;
			answer=$("#essay_"+id).val();
			token=$("#token").val()
			jawab="id="+id+"&answer="+answer+"&token="+token;
			$(".loading_jawaban_"+id).show();
			$(".msg_jawaban_"+id).html('Sedang menyimpan..');
			$.ajax({
			type: 'POST',
			url: '$fronturl/save_essay',
			data: jawab,
			error: function() {
			document.location.href='$url_login';
			console.log('er');
			},
			success: function(data) {
				$(".loading_jawaban_"+id).hide();
				
				if(data>0){
				$(".msg_jawaban_"+id).html('Berhasil menyimpan..');
					setTimeout(function(){
					$(".msg_jawaban_"+id).html('');
					},2000);
					if(answer.length>0) {
						$("#check_soal"+tandai_nomor).addClass("panel_answer_checked");
					} else {
						$("#check_soal"+tandai_nomor).removeClass("panel_answer_checked");
					}
					if(goto!='') {
						tampilkan_soal_delay(goto,navigasi_soal);
					}
				}else{
					$(".msg_jawaban_"+id).html('Gagal menyimpan silahkan refresh halaman..');
				}
				
			
			},
			error: function() {
				$(".msg_jawaban_"+id).html('Gagal menyimpan..');
			}

			});
}

function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function reset_answer(){
		localStorage.clear();
}
function reload_answer(){
	answer_storage=getStorage("jawab");
	if(answer_storage!='') {
		data=answer_storage.split(",");
		for(i=0;i<data.length;i++){
			set_option(data[i]);
		}
	}
}
function set_answer(id_soal){
	
	jawab_baru=id_soal.substring(1,id_soal.length);
	index=0;
	answer_temp=[];
	answer_storage=getStorage("jawab");
	if(answer_storage!="" && answer_storage!=null){
		data=answer_storage.split(",");
		for(i=0;i<data.length;i++){
		  jawab_lama=data[i].substring(1,data[i].length);
		  if(jawab_baru!=jawab_lama && data[i]!="" && data[i]!=null	){
			answer_temp[index]=data[i];
			index++; 
		  }
	 
		}
	
		answer_temp[index]=id_soal;
		if(answer_temp.length>0){
			final_answer=answer_temp.join(",");
			localStorage.setItem("jawab",final_answer);
		}
		
	
	}
	
	
}
	
function stop_audiovideo(){
	$('video').each(function() 
	{
		$(this)[0].pause();
	});
	$('audio').each(function() 
	{
		$(this)[0].pause();
	});
}	
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
  
    	
  function updateClock() {
    var t = getTimeRemaining(endtime);
	//waktu_berjalan+=(1/60);
	
	var temp = (t.days*24)+(t.hours*60)+t.minutes;
	sisa_waktu=parseInt(temp);
    daysSpan.innerHTML = t.days+':';
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2)+':';
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2)+':';
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
	
	
	if (t.total <= 0 ) {
		clearInterval(timeinterval);
		waktuhabis();	
    }
    
  }
  
  var t = getTimeRemaining(endtime);
	if(t.days<=0){document.getElementById("clockdays").style.display="none";}
	if(t.days<=0 && t.hours<=0){document.getElementById("clockhours").style.display="none";}
	if(t.days<=0 && t.hours<=0 && t.minutes<=0){document.getElementById("clockminutes").style.display="none";}	

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

//var deadline = new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
var deadline = new Date(Date.parse(new Date()) + ($quiz_left_duration * 1000));

	function init(){
		setup_soal();
		setTimeout(
		function(){
			load_jawaban();		
			soal_ke=getStorage('soal_ke');
			if(soal_ke=='' || soal_ke===undefined || soal_ke===null){
				soal_ke=1;
			}
			
			tampilkan_soal(soal_ke);
			
		},1000);
	
		
		
	
	}
	
	
	function pre_timeout_checking()
	{
		t = setTimeout(	function(){akhiri_ujian()},1000	);	
	}
	function akhiri_ujian(){

		
		confirm_akhiri_ujian=1;
		save_now=1;
		quiz_token=getCookie("quiz_token");
		if(quiz_token==""){
			document.location.href='$url_login';
		}
		manualsave(1); 
	}
	function isujianvalid()
	{
			quiz_token=getCookie("quiz_token");
			if(quiz_token==""){
				document.location.href='$url_login';
			}else{
				token=$("#token").val();
				token="token="+token;
				$.ajax({
					type: 'POST',
					cache : false,
					url: '$fronturl/check_valid',
					data: token,
					error: function() {
					continue_refresh=1;
					$(".koneksi_bermasalah").show();
					koneksi_bermasalah++;
					if(koneksi_bermasalah>5){
						$(".koneksi_putus").show();
					}
						//document.body.innerHTML='<div style="padding:59px; 30px 0 30px;text-align:center;font-weight:bold;">Perangkat anda tidak terhubung <br/>dengan server<br>Silahkan hubungi admin. <br/><a href="$url">Silahkan refresh halaman anda</a></div>';
					},
					success: function(data) {
					$(".koneksi_bermasalah").hide();
					$(".koneksi_putus").hide();
					koneksi_bermasalah=0;
					continue_refresh=1;
					koneksi_lambat=0;
					//console.log('a');
					if(data==0 || data==''){
						document.location.href='$url_login';
					}
					}
					

				});
			}
			
	
	}
	function autosave(first)
	{
		if(urutan_auto_save==$last_digit){	
			if(first==1 || save_now==1 ){
				if(continue_refresh==1){
					continue_refresh=0;
					piljab=$(formulir).serialize();
					
					$(".auto-save-icon").show();
					
					if(confirm_akhiri_ujian==1){
						urlpost='$fronturl/autosave?akhiri_ujian=1';
					}else{
						urlpost='$fronturl/autosave?akhiri_ujian=0';
					}
					
					$.ajax({
						type: 'POST',
						url: urlpost,
						cache : false,
						data: piljab,
						error: function() {
							continue_refresh=1;
							$(".koneksi_bermasalah").show();
							koneksi_bermasalah++;
							if(koneksi_bermasalah>5){
								$(".koneksi_putus").show();
							}
							//document.body.innerHTML='<div style="padding:59px; 30px 0 30px;text-align:center;font-weight:bold;">Perangkat anda tidak terhubung <br/>dengan server<br>Silahkan hubungi admin. <br/><a href="$url">Silahkan refresh halaman anda</a></div>';
						},
						success: function(data) {
							$(".koneksi_bermasalah").hide();
							$(".koneksi_putus").hide();
							koneksi_bermasalah=0;
							continue_refresh=1;
							console.log('autosave'+data);
							if(data==0 || data==''){
								document.location.href='$url_login';
							}
							if(data==2){
								document.location.href='$url_done/'+quiz_token;
								save_now=0;
							}
							continue_refresh=1;
							$(".auto-save-icon").hide();
							koneksi_lambat=0;
						}

					});
					
					first=0;
					//setCookie("save_now",0,1);
				}
			}else{
				if(continue_refresh==1){
					continue_refresh=0;
					isujianvalid();
				}
				
			}
		}
		//console.log("c="+continue_refresh);
	
		urutan_auto_save++;
		if(urutan_auto_save==10){urutan_auto_save=0;}
		t = setTimeout(function(){autosave(first)},1200);
		if(koneksi_lambat>30){
			$(".koneksi_lambat").show();
		}else{
			$(".koneksi_lambat").hide();
		}
		
		koneksi_lambat++;
	}	
	function autoping()
	{
	
		if(urutan_auto_save==$last_digit){	
			isujianvalid();
		}
	
		urutan_auto_save++;
		if(urutan_auto_save==10){urutan_auto_save=0;}
		timerping=setTimeout(function(){
				autoping();
			}, 3000);
		//console.log(urutan_auto_save+"=="+$last_digit);
	}	
	
	function manualsave(save_now)
	{
			clearTimeout(timerping);
					
					piljab=$(formulir).serialize();
					
					$(".auto-save-icon").show();
					
					if(confirm_akhiri_ujian==1){
						urlpost='$fronturl/autosave?akhiri_ujian=1';
					}else{
						urlpost='$fronturl/autosave?akhiri_ujian=0';
					}
					
					$.ajax({
						type: 'POST',
						url: urlpost,
						data: piljab,
						error: function() {
							document.body.innerHTML='<div style="padding:59px; 30px 0 30px;text-align:center;font-weight:bold;">Perangkat anda tidak terhubung <br/>dengan server<br>Silahkan hubungi admin. <br/><a href="$url">Silahkan refresh halaman anda</a></div>';
						},
						success: function(data) {
						//console.log('MANUAL'+data);
							if(data==0 || data==''){
								document.location.href='$url_login';
							}
							if(data==2){
								document.location.href='$url_done/'+quiz_token;
							}
							continue_refresh=1;
							
						$(".auto-save-icon").hide();
						}

					});
					
						
			
			timerping=setTimeout(function(){
				autoping();
			}, 3000);
	}
	
	function waktuhabis()
	{
		$("#waktuhabis").show();
		$("#panel_answer").hide();
		$("#formulir_ujian").hide();
		pre_timeout_checking();
		
	}
	function submit_selesai()
	{
		$("#submit_ujian").show();
		$("#panel_answer").hide();
		$("#formulir_ujian").hide();
		pre_timeout_checking();

	}
	
	function setup_soal()
	{
		$(".wrap_soal").hide();
		$("#wrap_soal1").show();
	}
	function tampilkan_soal(nomor)
	{
		$("#check_soal"+nomor).hide();
		$(".wrap_soal").hide();
		
		$(".checked_answer").css({"border":"1px solid $color_1"});
		$("#check_soal"+nomor).css({"border":"2px solid red"});
		
		//$("#check_soal"+nomor).removeClass("checked_answer");
		$("#check_soal"+nomor).removeClass("animasi_bulat_terpilih");
		$("#check_soal"+nomor).addClass("animasi_bulat_terpilih");
		
		$("#wrap_soal"+nomor).removeClass("animasi_soal_masuk");
		$("#wrap_soal"+nomor).addClass("animasi_soal_masuk");
		$("#wrap_soal"+nomor).show();
		$("#check_soal"+nomor).show();
		//setCookie("soal_ke",nomor,1);
		localStorage.setItem('soal_ke',nomor);
		
		stop_audiovideo();
		//topFunction();
	}
	function tampilkan_soal_delay(nomor,navigasi_soal)
	{
	//setCookie("soal_ke",nomor,1);
	localStorage.setItem('soal_ke',nomor);
	
	if(navigasi_soal.length==0 || navigasi_soal!=0) {
		setTimeout(function(){move_delay(nomor)},1000);
	}
	
	}
	function move_delay(nomor)
	{
	$("#check_soal"+nomor).hide();
	$("#wrap_soal"+nomor).removeClass("animasi_soal_masuk");
	
	$(".wrap_soal").hide();
	
	$(".checked_answer").css({"border":"1px solid"});
	$("#check_soal"+nomor).css({"border":"2px solid red"});
	
	//$("#check_soal"+nomor).removeClass("checked_answer");
	$("#check_soal"+nomor).removeClass("animasi_bulat_terpilih");
	$("#check_soal"+nomor).addClass("animasi_bulat_terpilih");
	
	
	$("#wrap_soal"+nomor).addClass("animasi_soal_masuk");
	$("#wrap_soal"+nomor).show();
	$("#check_soal"+nomor).show();
	//topFunction();
	}
	function getStorage(name) {
		var storageValue='';
		 try {
				storageValue=localStorage.getItem(name);
				if(storageValue===null || storageValue===undefined || storageValue==''){
					storageValue='';
				}
		 } catch (e) {
				storageValue='';
				
		 }
		 return storageValue;
	}
	function load_jawaban()
	{
	 online=1;
	 
	 //ONLINE
	 if(online==1){
//	 alert('load online');
		data_jawaban=JSON.parse('$data_pil_soal');
		data_mark_jawaban=JSON.parse('$data_pil_jawab');
		for(i=1;i<=$total;i++)
		{
			
			//jawaban=getCookie("soal"+i);
			//mark_jawaban=getCookie("jawab_soal"+i);
			jawaban=data_jawaban[i];
			mark_jawaban=data_mark_jawaban[i];
			if(jawaban=="" || jawaban==undefined)
			{
				
			}
			else
			{
			$("#answer_soal"+i).html(mark_jawaban);
			$(".soal"+i).removeClass("answer_checked");
			$("#label_"+jawaban+i).removeClass("answer_checked");
			$("#label_"+jawaban+i).addClass("answer_checked");
				
			$("#check_soal"+i).removeClass("panel_answer_checked");
			$("#answer_soal"+i).html(mark_jawaban);
			$("#check_soal"+i).addClass("panel_answer_checked");
			
			document.getElementById(jawaban+i).checked=true;
			
			}
		}
		}
		
		//OFFLINE
		answer_storage=getStorage("jawab");
	 
		if(answer_storage!=null && answer_storage!="" && answer_storage!=undefined){
		  if(answer_storage.split(",").length>0){
		  online=0;
		  }
		}
	  
		 if(online==0){
		  reload_answer();
//		  alert('load offline');
		  }
	}
	function mulai()
	{
		
		if(durasi>=0)
		{
		
		jam = Math.floor(durasi/3600);
		
		sisa = durasi%3600;
		menit = Math.floor(sisa/60);
		sisa2 = sisa%60
		detik = sisa2%60;
		if(detik<10){
			detikx = "0"+detik;
		}else{
			detikx = detik;
		}
		if(menit<10){
			menitx = "0"+menit;
		}else{
			menitx = menit;
		}
		if(jam<10){
			jamx = "0"+jam;
		}else{
			jamx = jam;
		}
		document.getElementById("divwaktu_ujian").innerHTML = ""+jamx+":"+menitx+":"+detikx;
		durasi --;
		if(durasi>0)
		{
			t = setTimeout(function(){mulai()},1000);
			jalan = 1;
		}
		else
		{

			if(jalan==1)
			{
			clearTimeout(t);
			}

			
			document.getElementById("divwaktu_ujian").innerHTML = "00:00";
			
			waktuhabis();
			

		}
		
		}
		else
		{

		document.getElementById("divwaktu_ujian").innerHTML = "00:00";
		}
	}
	function getCookie(c_name){
		if (document.cookie.length>0){
			c_start=document.cookie.indexOf(c_name + "=");
			if (c_start!=-1){
				c_start=c_start + c_name.length+1;
				c_end=document.cookie.indexOf(";",c_start);
				if (c_end==-1) c_end=document.cookie.length;
				return unescape(document.cookie.substring(c_start,c_end));
			}
		}
		return "";
	}
	function setCookie(c_name,value,expiredays){
		var exdate=new Date();
		exdate.setDate(exdate.getDate()+expiredays);
		document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())+";path=/";
	}
	
	function cek_jawaban()
	{
		
		bolong=0;
		terjawab=0;
		for(i=1;i<=$total;i++)
		{			
			//jawaban=getCookie("soal"+i);
			jawaban=$("#answer_soal"+i).html();
			//console.log("soal"+i);
			if(jawaban=="")
			{
			bolong++;
			} else {
			terjawab++;
			}
			
		}
	
	
	if(bolong)
	{
		boleh_submit=terjawab>0?true:false;
		if(!boleh_submit ) {
			title='Warning';
			message="Ujian tidak bisa diakhiri jika tidak ada jawaban terpilih";
		} else {
			//if(waktu_berjalan < waktu_ijin_submit) {
			if(sisa_waktu > waktu_ijin_submit) {
				boleh_submit=false;
				title='Warning';
				message="Ujian tidak bisa diakhiri sampai sisa waktu kurang dari "+parseInt(waktu_ijin_submit)+" menit, silahkan jawab yang belum terjawab";
			} else {
				boleh_submit=true;
				title='Apakah anda yakin?';
				message="Apakah anda yakin tetap mau mengakhiri ujian anda? Masih ada "+bolong+" soal pilihan ganda yang belum dijawab!!!";
			}
			
			
		}
		$("#msg_ujian_bolong").html(bolong);
		//$("#dialog-confirm-finish").dialog("open");
		Swal.fire({
		  title: title,
		  text: message,
		  icon: 'warning',
		  showConfirmButton: boleh_submit,
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Setuju',
		  cancelButtonText: 'Batal'
		}).then((result) => {
		  if (result.value) {
				submit_selesai();
				topFunction();
		  } else {
				
		  }
		});
	}
	else
	{
	
		
		if(sisa_waktu > waktu_ijin_submit) {
			boleh_submit=false;
			title='Warning';
			message="Ujian tidak bisa diakhiri sampai sisa waktu kurang dari "+parseInt(waktu_ijin_submit)+" menit, silahkan cek jawaban anda";
		} else {
			title='Apakah anda yakin?';
			boleh_submit=true;
			message="Masih ada waktu untuk mengecek jawaban anda! ";
		}
		

	
	//$("#dialog-confirm-adawaktu").dialog("open");
	Swal.fire({
		  title: title,
		  text: message,
		  icon: 'warning',
		  showConfirmButton: boleh_submit,
		  showCancelButton: true,
		  confirmButtonColor:'#d33',
		  cancelButtonColor: '#3085d6',
		  confirmButtonText: 'Akhiri Ujian',
		  cancelButtonText: 'Lanjutkan Ujian'
		}).then((result) => {
		  if (result.value) {
				submit_selesai();
				setTimeout(function(){topFunction()},500);
		  } else {
				
		  }
		});
	}
	return true;		
	}	

function set_option(id_soal)
{

	element_jawab=$("#"+id_soal);
	nomor=parseInt(element_jawab.attr("meta-urutan"));			
	nama_soal=element_jawab.attr("meta-name");
	jawab_soal="jawab_"+element_jawab.attr("meta-name");
	mark_choice=element_jawab.attr("mark-choice");
	nilai_soal=element_jawab.val();	
	document.getElementById(id_soal).checked=true;	
	var dijawab=document.getElementById(id_soal).checked;
	
	if(!dijawab){
		//alert('belum dijawab');
	}else{
		//setCookie(nama_soal,nilai_soal,1);				
		//setCookie(jawab_soal,mark_choice,1);	
		$("#answer_"+nama_soal).html(mark_choice);
		$("#check_"+nama_soal).removeClass("panel_answer_checked");
		$("#check_"+nama_soal).addClass("panel_answer_checked");
		
		
		
		metalabel=element_jawab.attr('meta-label');
		metaname=element_jawab.attr('meta-name');
		urutan=element_jawab.attr('meta-urutan');
		name=element_jawab.attr('meta-name');
		$("."+name).css("border","1px solid $color_1");
		$("."+name).css("border-radius","0");
		
		$("."+metaname).removeClass("answer_checked");
		$("#"+metalabel).addClass("answer_checked");
	}
}	
$(document).ready(function(){
	init();
	if($("audio"). length) {
		$("audio").attr("controlslist",'nodownload');
	}
	if($("video"). length) {
		$("video").attr("controlslist",'nodownload');
	}
	
		
	$(".kolom_input>input").click(function(){
		return false;
	});


	$(".ragu-button").click(function(){
		return false; 
	});

	});


 
 function check_point()
 {
	token=$("#token").val();
	token="token="+token;
	$.ajax({
		type: 'POST',
		url: '$fronturl/check_point',
		cache : false,
		data: token,
		error: function() {
		},
		success: function(data) {
		//console.log(data);
		}

	});
 }

 //AUTO SAVE JAWABAN
 $(document).ready(function(){
 
 
 $(".radio_pilihan").click(function(){
 
	id=$(this).attr('id');
	metalabel=$(this).attr('meta-label');
	metaname=$(this).attr('meta-name');
	urutan=$(this).attr('meta-urutan');
	name=$(this).attr('meta-name');
	$("."+name).css("border","1px solid $color_1");
	$("."+name).css("border-radius","0");
	
//	$("#check_soal"+nomor).removeClass("animasi_bulat_terpilih");
//	$("#check_soal"+nomor).addClass("animasi_bulat_terpilih");

	//$("#label_"+id).css("border","3px solid ");
	//$("#label_"+id).css("border-radius","10px");
	$("."+metaname).removeClass("answer_checked");
	$("#"+metalabel).addClass("answer_checked");
//	setCookie("save_now",1,1);
	save_now=1;

 });
 });
 
 //END AUTO SAVE JAWABAN

</script>

END;

if($member_data['is_listening']==1){

$script_js['quiz_start'] .=<<<END
<script>
soal_ke=localStorage.getItem('soal_ke');
if(soal_ke===null || soal_ke===undefined || soal_ke.length==0 || soal_ke=='') {
	soal_ke=1;
}
$(document).ready(function(){

setTimeout(function(){
	$(".navigasi-kiri").hide();
	$(".navigasi-kanan").hide();
	$(".checked_answer").attr("onclick","");
	$(".kolom_input > input").attr("onclick","");
},100);
$("audio").after("<img style='width:50%' src='$sound_image'>");

});

document.onreadystatechange = function () {
    if (document.readyState == "interactive") {
	
		function startAudio(){
			index=0;
			var soal_berikut = [];
			document.querySelectorAll('.wrap_soal').forEach(function(element){
			soal_berikut[index]=element.getAttribute('berikut');
			index++;	
			});
			
			var sounds = [];
			index=0;
			document.querySelectorAll('audio').forEach(function(element) {
				element.controls=false;
				suara=element.src;
				sounds[index]=new Audio(suara);
				index++;
			});
			
			
				
			var i = -1;
			function playSnd() {
				i++;
				
				if (i == sounds.length) return;
				if(soal_ke!=""){
					//console.log('a');
					if(i>=(parseInt(soal_ke)-1)){
					
						sounds[i].pause(); // first pause        
						sounds[i].currentTime = 0; // then reset     
						
						sounds[i].addEventListener('ended',()=>{
							setTimeout(function(){
								if(soal_berikut[i]!="" && soal_berikut[i]!=undefined){
								
									tampilkan_soal(parseInt(soal_berikut[i]));	
									setTimeout(function(){
									playSnd();
									},2000);
									
								}
							},1000);	
						});
						
						sounds[i].play();
						
						
					}else{
					//skip
					
					console.log('skip'+i);
					playSnd();
					}
					
					
				}else{
					sounds[i].addEventListener('ended',()=>{
						setTimeout(function(){
							if(soal_berikut[i]!="" && soal_berikut[i]!=undefined){
								tampilkan_soal(parseInt(soal_berikut[i]));	
								setTimeout(function(){
								playSnd();
								},2000);
								
							}
						},5000);	
					});
					
					sounds[i].pause(); // first pause        
					sounds[i].currentTime = 0; // then reset     
					sounds[i].play();
				}
			}
			playSnd();
		}
		function cekAudioReady(){
			jumlah_audio=0;
			siap_audio=0;
			document.querySelectorAll('audio').forEach(function(element) {
			element.controls=false;
			status=element.readyState;
			//alert(status);
				if(status==4){
					siap_audio++;
				}
				jumlah_audio++;
			});
			if(jumlah_audio==siap_audio){
				return 1;
			}else{
				return 0
			}
		}
		
		
		function loopCekAudio(){
			if(cekAudioReady()){
					startAudio();
			
			}else{
			
				setTimeout(function(){
						loopCekAudio();
				},2000);
			}
			
		}
		
		loopCekAudio();
		
    }
}
</script>
END;

}
?>
