<?php

$info=array();
	$token=cleanInput($action);
	
	$q=$mysql->query("SELECT id,score,score_essay,tidak_jawab,benar,salah,kkm,custom_score FROM app_quiz_done WHERE token='$token' AND is_done=1");
	if($q and $mysql->numrows($q)>0)
	{
		$member_data=$mysql->assoc($q);
		$score=$member_data['score'];
		$score_essay=$member_data['score_essay'];
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
			if($member_data['custom_score']==0) {
			/*	
				
			$benar_essay=$mysql->get1value("SELECT count(id) FROM quiz_done_essay WHERE score>0 AND id_quiz_done=".$member_data['id']);
			$salah_essay=$mysql->get1value("SELECT count(id) FROM quiz_done_essay WHERE score<=0 AND id_quiz_done=".$member_data['id']);
			$benar+=$benar_essay;
			$salah+=$salah_essay;
			*/
		
			
			}
			$info['score']=$score;
			$info['score_essay']=$score_essay;
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
<link href="<<<TEMPLATE_URL>>>/css/ujian-selesai.css?1=1" rel="stylesheet">
<div class='container alma-container'>
<div class='row'>
<div class='col-md-12'>
<div id="div_quiz_done">	
	<div id="countdown"></div>	
	<div id="tes-selesai">
		<h1>Anda sudah melaksanakan ujian	</h1>
		<?php if($web_config_show_score){ ?>
		<div class="score_exam">	
		<?php
		include "custom_score_".$info['custom_score'].".php";		
		?>
		</div>
		<?php
		}else{
		?>
		<div class="message_exam"><?php echo ($info['done']==1?$web_config_msg_pass_exam:$web_config_msg_fail_exam);?></div>
		<?php
		}
		?>
		<br/>
		<div id="" class="text-center">
		<!-- <a href="<?php echo fronturl("app_quiz_bahas/$token");?>"><button type="button" class="btn btn-success">Pembahasan Soal</button></a>-->
		 <a href="#"><button type="button" class="btn btn-success" onclick="window.parent.backToCompetency()">Kembali</button></a>
		</div>
		<br/>
	</div>
</div>
</div>
</div>
</div>
<script>
	setcookie("quiz_token","",-1,"/");	
</script>
<?php

$style_css['quiz_done']=<<<END
<style>
nav{display:none;}
button{
color:black;
}
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
.kolom_nilai {
  text-align: right !important;
}
.score_final {
  font-weight: bold;
  font-size: 18pt;
}
.message_exam {
    margin-top: 15px;
    line-height: 30px;
    text-align: center;
	padding-left:10px;
	padding-right:10px;
}
.score_exam h4 {
    text-align: center;
}
</style>
END;
?>
