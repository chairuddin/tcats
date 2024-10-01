<?php

function quiz_login()
{
	header("location:".fronturl("quiz_login"));
	exit();
}
$info=array();
	$token=cleanInput($action);
	
	$q=$mysql->query("SELECT score,tidak_jawab,benar,salah,kkm,custom_score FROM quiz_done WHERE token='$token' AND is_done=1");
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
			$info['done']=$pass;
			$info['yes']=1;
			
		}else{
			$info['score']=$score;
			$info['tidak_jawab']=$tidak_jawab;
			$info['benar']=$benar;
			$info['salah']=$salah;
			$info['pass']=$pass;
			$info['kkm']=$kkm;
			$info['yes']=1;
			$info['custom_score']=$member_data['custom_score'];
			
		}
		
		
	}
	else
	{
	quiz_login();
	}
?>
<div class='container alma-container'>
<div class='row'>
<div class='col-md-12'>
<div id="div_quiz_done">	
	<div id="countdown"></div>	
	<div id="message-final">
		<h1>Anda sudah melaksanakan ujian	</h1>
		<?php if($web_config_show_score){?>
		<div class="score_exam">
			<table class="score_exam_table">
				<?php
				if($info['custom_score']!=2){
				?>
				<tr>
					<td>Jawaban Benar</td><td>:</td><td class="kolom_nilai"><?php echo $info['benar'];?></td>
				</tr>
				<tr>
					<td>Jawaban Salah</td><td>:</td><td class="kolom_nilai"><?php echo $info['salah'];?></td>
				</tr>
				<?php
				}
				
				if($info['custom_score']!=2 && $info['tidak_jawab']>0){
				?>
				<tr>
					<td>Tidak Jawab</td><td>:</td><td class="kolom_nilai"><?php echo $info['tidak_jawab'];?></td>
				</tr>
				<?php
				}
				
				if($info['kkm']>0){
					
				?>
				<tr class="score_kkm">
					<td>KKM</td><td>:</td><td class="kolom_nilai"><?php echo $info['kkm'];?></td>
				</tr>
				<?php
				}
				?>
				<tr class="score_final">
					<td>Skor</td><td>:</td><td class="kolom_nilai"><?php echo $info['score'];?></td>
				</tr>
			</table>
		</div>
		<div class="message_exam"><?php echo ($info['pass']==1?$web_config_msg_pass_exam:$web_config_msg_fail_exam);?></div>
		<?php 
		}else{
		?>
		<div class="message_exam"><?php echo ($info['done']==1?$web_config_msg_pass_exam:$web_config_msg_fail_exam);?></div>
		<?php
		}
		?>
		<br/>
	<a href="<?php echo fronturl("quiz_login");?>"><button type="button">Kembali Ke Halaman login</button></a>	
	</div>
</div>
</div>
</div>
</div>
<?php

 $url_login=fronturl("quiz_login");

$script_js['quiz_done']=<<<END
	<script>
	var durasi=60;
	var jalan = 0;
	var habis = 0;
	function init(){
		mulai();
		$(document).ready(function(){
			t = setTimeout(function() { kembali_login() },60);
		});
	}
	
	function kembali_login(){
		document.location.href='$url_login';
	}
	
	function mulai()
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
		document.getElementById("countdown").innerHTML =detikx;
		durasi --;
		if(durasi>0)
		{
			t = setTimeout(function() { mulai() },1000);
			jalan = 1;
		}
		else
		{
			if(jalan==1)
			{
				clearTimeout(t);
			}

			habis = 1;
			document.getElementById("countdown").innerHTML = "00";
		}
	}
	
	$(document).ready(function(){
		t = setTimeout(function() { init() },5000);
		
	});

	</script>

END;

$style_css['quiz_done']=<<<END
<style>
#div_quiz_done {
  padding-bottom: 50px;
  padding-top: 10px;
  height: 568px;

}
.score_exam_table{
margin:0 auto;
}
.score_exam_table td {
  padding: 1px;
  text-align: left;
}
.score_exam {
  //border: 1px solid;
  margin: 0 auto;
  padding: 15px 12px;
  //width: 350px;
}
#countdown {
  color: $color_v5;
  font-size: 75px;
  height: 75px;
  text-align: center;
  padding-top: 18px;
}
#message-final {
  border: 1px solid white;
  border-radius: 24px;
  font-size: 14pt;
  padding: 8px;
  text-align: center;
   background-color:white;
}
.message_exam {
  margin-top: 15px;
  line-height:30px;
}
.kolom_nilai {
  text-align: right !important;
}
.score_final {
  font-weight: bold;
  font-size: 18pt;
}
</style>
END;
?>
