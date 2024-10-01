<?php

$token="ef7a1a1fc1cc92cd10885b78c67b44fe";

if($token!="")
{
	$q=$mysql->query("SELECT * FROM quiz_done WHERE token='$token' AND is_done=0");
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
$start_time=$member_data['start_time'];
$this_time=strtotime(date("Y-m-d H:i:s"));
$quiz_duration= ($member_data['quiz_duration']*60);

$end_time=strtotime($start_time)+$quiz_duration;
$quiz_left_duration=$end_time-$this_time;

$quiz_left_duration=40;
/*
if($quiz_left_duration<=0){
	$quiz_left_duration=0;
	if($_POST['token']!="" and !$_POST['selesai'] and $member_data['start_time']!="" and $member_data['quiz_duration']!="" and $quiz_left_duration==0 )
	{	
		submit_jawaban($_POST['token']);
		
	}
}
*/ 


if($_POST['token']!="" and $_POST['selesai'])
{
	submit_jawaban($_POST['token']);
}

?>
<form onsubmit="cek_jawaban();return false;" name="formulir" id="formulir" method="post" action=""    >
<div class='container alma-container'>
<div class='row'>
<div class='col-md-10'>
<div id="divbiodata">
<div class="biodata-left">
<?php

echo "<span>Nama:".$member_data['member_fullname']."</span>";
echo "<span>Kelas:".$member_data['member_class']."</span>";
echo "<span>Soal:[".$member_data['quiz_code'];
echo "] ".$member_data['quiz_title_id']."</span>";
?>
</div>
<span id="divwaktu_ujian">
<div id='clockdiv'>
  <div id='clockdays'>
	<div class='smalltext'>HARI</div>  
	<span class='days'>00</span>
  </div><div  id='clockhours'>
	<div class='smalltext'>JAM</div>
	<span class='hours'>00</span>
  </div><div  id='clockminutes'>
	<div class='smalltext'>MNT</div>
	<span class='minutes'>00</span>
  </div><div>
	<div class='smalltext'>DTK</div>
	<span class='seconds'>00</span>
  </div>
</div>	
</span>	

</div>	


<div id="waktuhabis">
	<div id="countdown"></div>	
	<div id="message-final">
	<h1>Durasi ujian sudah habis</h1>
	<p>Sistem akan melakukan submit secara otomatis </p>
	<input type="hidden"   name="selesai" value="Selesai Ujian">
	
	<br/>
	</div>
</div>
<div id="formulir_ujian" >
<?php

$answer_temp=json_decode($member_data['answer_temp'],true);
$acak=$member_data['acak'];
$acak_pilihan=json_decode($member_data['acak_pilihan'],true);
//print_r($acak_pilihan);
//die("SELECT * FROM quiz_detail WHERE quiz_id='".$member_data['quiz_id']."' ORDER BY FIELD(id,$acak)");
$q=$mysql->query("SELECT * FROM quiz_detail WHERE quiz_id='".$member_data['quiz_id']."' ORDER BY FIELD(id,$acak)");

if($q and $mysql->numrows($q)>0)
{
	$no=0;
	$total=$mysql->numrows($q);
	while($v=$mysql->assoc($q))
	{
		$no++;
		if($no>1)
		{
		//$button_sebelum='<a class="navigasi-kiri" href="#wrap_soal'.($no-1).'" onclick="tampilkan_soal('.($no-1).')"><i class="fa fa-arrow-left"></i></a>';
		$button_sebelum='<a class="navigasi-kiri quiz_navigation" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="fa fa-arrow-left"></i></a>';
		}
		else
		{
		$button_sebelum="";	
		}
		if($no<$total)
		{
		//$button_berikut='<a  class="navigasi-kanan" href="#wrap_soal'.($no+1).'"  onclick="tampilkan_soal('.($no+1).')"><i class="fa fa-arrow-right"></i></a>';
		$button_berikut='<a  class="navigasi-kanan quiz_navigation" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')"><i class="fa fa-arrow-right"></i></a>';
		}
		else
		{
		$button_berikut="";
		}
		$no_sss=md5($v['id']);		
		?>
		<div class='wrap_soal row' id="wrap_soal<?php echo $no?>">
			
			<div class='soal_desc <?php echo $v['model']==0?"col-md-12":"col-md-6";?>'>
			
			<?php 
			echo "<h4 class=\"subtitle_quiz\">--Question--</h4>";
			echo $v['question'];
			?>
			</div>
			<?php
				$pilihan=array("A","B","C","D","E");
				$ada_pilihan=0;
				foreach($pilihan as $i=>$pil)
				{
					if(strip_tags($v[$pil])!="-"){	
					$ada_pilihan++;
					}
				}
			?>
			<div class='pilihan_ganda <?php echo $v['model']==0?"vertical col-md-12":"horizontal col-md-6";?>'>
			<h4 class="subtitle_quiz"><?php echo $ada_pilihan>0?"--Answer--":"";?></h4>
				<ul>
				<?php
				$acak_jawaban=array();
				$jawaban=$answer_temp[$no];//$_COOKIE['soal'.$no];
							
				$tanda[$no]=$jawaban!=""?1:0;
				
				
				foreach($pilihan as $i=>$pil)
				{
					if(strip_tags($v[$pil])!="-"){	
					$checked="";
					$class_checked="";
					if($jawaban!="" AND $jawaban==$pil)
					{
						
					$checked="checked='checked'";
					$class_checked="answer_checked";
					}
					//document.getElementById(jawaban+i).checked=true;	
					ob_start();
					?>	
					<li>
						<div class="kolom_input">		
							<input onclick="<?php echo $no<$total?"tampilkan_soal_delay('".($no+1)."')":""; ?>" class="radio_pilihan icheck-me"  <?php echo $checked;?> id="<?php echo $pil.$no;?>" type="radio" meta-urutan="<?php echo $no;?>" meta-name="soal<?php echo $no;?>" meta-label="label_<?php echo $pil.$no;?>" name="soal_<?php echo $no_sss;?>" value="<?php echo $pil;?>" />
							<label id="label_<?php echo $pil.$no;?>" class="soal<?php echo $no;?> <?php echo $class_checked;?>" for="<?php echo $pil.$no;?>">
							<div class="abjad"></div>
							<?php echo $v[$pil];?></label>
						</div>
						
					</li>	
					<?php
					$acak_jawaban[$pil]=ob_get_clean();
				
					}
				
				}
				
				foreach($acak_pilihan[$v['id']] as $xx => $zz)
				{
					echo $acak_jawaban[$zz];
				}
				?>
				
			</div>
			<div class='navigation_button'>
			<?php
			echo $button_sebelum;
			echo "<div class='quiz_navigation soal_no'>$no</div>";	
			echo $button_berikut;
			?>
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
		$panel_answer.="<span class='checked_answer $tandai'  onclick='tampilkan_soal($i)' id='check_soal$i'>$i</span>";
		
	}
}
$logo=logo();	
$logo_instansi=logo_footer();	
?>

<input type="hidden" name="token" id="token" value="<?php echo $token;?>" />
<!-- mark button submit-->



<div class="row" id="footer-instansi">
	<div class="col-md-5"><?php echo "<img src=\"$logo_instansi\" alt=\"$web_config_name\" title=\"$web_config_name\" />"; ?></div>
	<div class="col-md-7"><?php echo $web_config_footer_instansi?></div>
</div>
</div>

</div>
<div class='col-md-2' >
	<div class="panel_answer"><?php echo $panel_answer;?></div>
</div>
</div>

<div class='row' >
	<div class='col-md-12' >
		<input type="button" id="tombol_selesai" class="btn"  name="akhiri" value="Selesai Ujian" onclick="return cek_jawaban();">
	</div>
</div>

</div>

<div class="logo-dalam">
<?php echo "<img src=\"$logo\" alt=\"$web_config_name\" title=\"$web_config_name\" />"; ?>
</div>

<div id="dialog-confirm-finish" title="Apakah anda yakin?" style="display:none;">
	<p>Apakah anda yakin tetap mau mengakhiri ujian anda? <br/>Masih ada <span id="msg_ujian_bolong"></span> soal yang belum dijawab!!! </p>
</div>
<div id="dialog-confirm-adawaktu" title="Apakah anda yakin?" style="display:none;">
	Masih ada waktu untuk mengecek jawaban anda!	
</div>
</form>
<?php
$style_css['quiz_start']=<<<END
<style>
#footer-instansi {
  background-color: hsl(0, 0%, 96%);
  border-top: 3px dashed hsl(0, 0%, 86%);
  padding-top: 17px;
  font-size: 8pt;
  line-height: 9pt;
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
    
	color: $color_v5;
	display: inline-block;
	font-family: sans-serif;
	font-size: 16px;
	font-weight: 100;
	margin-bottom: 5px;
	text-align: center;
	width: 124px;
	
}


#clockdiv > div {
  background: $color_1; none repeat scroll 0 0;
  border:1px solid $color_2;
  display: inline-block;
  margin-right: 1px;
width:30px;  
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
.pilihan_ganda > ul li:nth-child(5) > .kolom_input > label > .abjad::after{
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

.ui-dialog-buttonset > button:last-child {
  background-color: red;
  position:absolute;
  left:12px;
  
}
.ui-dialog-buttonset > button:first-child {
  background-color: yellowgreen;
  float:right;
  
}
.ui-dialog-buttonset > button{
font-weight:bold;
padding:5px;
}
.ui-dialog-titlebar-close{
background-color:red;
}
.ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix.ui-draggable-handle {
  background-color: red;
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
#waktuhabis {
  display: none;
  padding-top: 57px;
  background-color:white;
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


.wrap_soal {
  display: none;
  min-height: 560px;
  padding: 30px 0 0 0;
  position: relative;
}
.wrap_soal table {
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
  padding: 7px;
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
}
.animasi_bulat_terpilih{
animation-name:rubberBand;
animation-duration: 0.6s;
}
.animasi_soal_masuk{
animation-name:fadeIn;
animation-duration: 0.5s;
}
.animasi_soal_masuk_kanan{
animation-name:fadeInRight;
animation-duration: 0.5s;
}
.animasi_soal_keluar{
animation-name:rollOut;
animation-duration: 1s;
}

@media (max-width: 992px) {
.panel_answer span {
  border: 1px solid $color_1;
/*  border-radius: 20px;*/
  cursor: pointer;
  display: block;
  float: left;
  font-size: 15pt;
  height: 38px;
  text-align: center;
  width: 38px;
  line-height:34px;
}
.pilihan_ganda.horizontal >ul >li{
  margin-bottom: 5px;
  min-height: 40px;
}
.panel_answer {
  background-color: white;
  border: 2px solid #e8b71a;
  margin-top: 24px;
  padding: 3px;
  width: 100%;
  display:inline-block;
}
#tombol_selesai {
  background-color: $color_2;
  border: medium none;
  display: block;
  font-weight: bold;
  margin: 0 auto;
  padding: 19px;
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
  height: 26px;
  text-align: center;
  width: 26px;
}
.pilihan_ganda.horizontal >ul >li{
/*
width:calc(100% / 5);
float:left;
*/
}
.panel_answer {
  background-color: white;
  border: 2px solid #e8b71a;
  padding: 3px;
  position: fixed;
  width: 142px;
  right: calc(100% /30);
  top:75px;
}
#tombol_selesai {
  background-color: $color_2;
  border: medium none;
  display: block;
  font-weight: bold;
  margin: 0 auto;
  padding: 19px;
  position: fixed;
  right: calc(100% /30);
  top: 10px;
}
}
</style>
END;

$url_login=fronturl("quiz_login");
$fronturl=fronturl("ajax");
$script_js['quiz_start']=<<<END
<script>


	var timeout=5;
	var durasi=$quiz_left_duration;
	var jalan = 0;
	var habis = 0;
	
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

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
	console.log(t.days);
	
	
	
	if (t.total <= 0 ) {
    clearInterval(timeinterval);
		waktuhabis();	
    }
    
  }
  
  var t = getTimeRemaining(endtime);
	if(t.days<=0){document.getElementById("clockdays").style.visibility="hidden";}
	if(t.hours<=0){document.getElementById("clockhours").style.visibility="hidden";}
	if(t.minutes<=0){document.getElementById("clockminutes").style.visibility="hidden";}	

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

//var deadline = new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
var deadline = new Date(Date.parse(new Date()) + ($quiz_left_duration * 1000));
initializeClock('clockdiv', deadline);


	function init(){
		
		//mulai();
		setup_soal();
		load_jawaban()
		isujianvalid();
		
		soal_ke=getCookie("soal_ke");
		if(soal_ke!=""){
		tampilkan_soal(soal_ke);
		}
	}
	
	
	function pre_timeout_checking()
	{
		quiz_token=getCookie("quiz_token");
		if(quiz_token==""){
		//document.location.href='$url_login';
		}else{
		
		load_jawaban();
		token=$("#token").val();
		token="token="+token;
		$.ajax({
			type: 'POST',
			url: '$fronturl/timeout_checking',
			data: token,
			error: function() {
			//document.location.href='$url_login';
			console.log('er');
			},
			success: function(data) {
			if(data>0){
				countdown();
				//console.log('submit otomatis');
				//t = setTimeout(document.getElementById("formulir").submit(),7000);
			}else{
				//document.location.href='$url_login';
			}
			
			}

		});
		
		
		}
	}

	function isujianvalid()
	{
		quiz_token=getCookie("quiz_token");
		if(quiz_token==""){
		//document.location.href='$url_login';
		}else{
		load_jawaban();
		
		token=$("#token").val();
		token="token="+token;
		$.ajax({
			type: 'POST',
			url: '$fronturl/check_valid',
			data: token,
			error: function() {
			},
			success: function(data) {
			console.log(data);
			if(data>0){
			//document.location.href='$url_login';
			}
			}

		});
		
		
		}
		t = setTimeout("isujianvalid()",10000);
	}

	function countdown()
	{
		
		jam = Math.floor(timeout/3600);
		
		sisa = timeout%3600;
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
		timeout --;
		if(timeout>0)
		{
			t = setTimeout("countdown()",1000);
			jalan = 1;
		}
		else
		{

			if(jalan==1)
			{
			clearTimeout(t);
			}
			
			document.getElementById("formulir").submit();

		}
		
		
		
	
	
	}
	function waktuhabis()
	{
		$("#waktuhabis").show();
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
	setCookie("soal_ke",nomor,1);
	}
	function tampilkan_soal_delay(nomor)
	{
	setCookie("soal_ke",nomor,1);
	setTimeout("move_delay("+nomor+")",600);
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
	
	}
	function load_jawaban()
	{
		for(i=1;i<=$total;i++)
		{
			
			jawaban=getCookie("soal"+i);
			if(!jawaban)
			{
			}
			else
			{
			//$("#check_soal"+i).css({"background-color":"#28ABE3"});
			$("#check_soal"+i).removeClass("panel_answer_checked");
			$("#check_soal"+i).addClass("panel_answer_checked");
			document.getElementById(jawaban+i).checked=true;
			}
			
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
			t = setTimeout("mulai()",1000);
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
		for(i=1;i<=$total;i++)
		{
			
			jawaban=getCookie("soal"+i);
			
			if(!jawaban)
			{
			bolong++;
			}
			
		}
		
	if(bolong)
	{
		$("#msg_ujian_bolong").html(bolong);
		$("#dialog-confirm-finish").dialog("open");
		//return false;
		/*
		var r = confirm("Apakah anda yakin tetap mau mengakhiri ujian anda? \\r\\nMasih ada "+bolong+" soal yang belum dijawab!!!");
		
		if(r)
		{	
		
			var ya = prompt("Silahkan Ketik 'Y'(tanpa tanda petik) untuk mengakhiri ujian anda", "");
			if (ya == "y" || ya == "Y") {
				return true;
			}
			else
			{
			return false;
			}
		
		}
		else
		{
		return false;
		}
		*/
	}
	else
	{
	$("#dialog-confirm-adawaktu").dialog("open");
	//return false;
	/*
		var r = confirm("Masih ada waktu untuk mengecek jawaban anda. \\r\\nApakah anda yakin tetap mau mengakhiri ujian anda?");
		
		if(r)
		{	
		var ya = prompt("Silahkan Ketik 'Y'(tanpa tanda petik) untuk mengakhiri ujian anda", "");
				if (ya == "y" || ya == "Y") {
				return true;
			}
			else
			{
			return false;
			}
		}
		else
		{
		return false;
		}
		*/
	}
	return true;		
	}	
	
	
	$(document).ready(function(){
	init();
	
	$(".kolom_input>input").click(function(){
		id_soal=$(this).attr("id");
		nama_soal=$(this).attr("meta-name");
		nilai_soal=$(this).val();
		
		var dijawab=document.getElementById(id_soal).checked;
		
		if(!dijawab){
			alert('belum dijawab');
		}else{
			
			setCookie(nama_soal,nilai_soal,1);				
			
			$("#check_"+nama_soal).removeClass("panel_answer_checked");
			$("#check_"+nama_soal).addClass("panel_answer_checked");
	
			
		}
	});
	
	
	
	});
	
$("#dialog-confirm-finish,#dialog-confirm-adawaktu").dialog({
	autoOpen: false,
	resizable: false,
	modal: true,
	width:'auto',
	buttons: [
		
		{
			text: "Lanjutkan Ujian",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
		,
		{
			text: "Akhiri ujian",
			click: function() {
			document.getElementById("formulir").submit();
			$( this ).dialog( "close" );
			}
		}
	]
});
/*
$( "#dialog-contact-button" ).click(function( event ) {
	$( "#dialog-confirm-finish").dialog("open");
	event.preventDefault();
});
*/
 
 function check_point()
 {
	token=$("#token").val();
	token="token="+token;
	$.ajax({
		type: 'POST',
		url: '$fronturl/check_point',
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
			
	piljab=$(formulir).serialize();
	
	$.ajax({
		type: 'POST',
		url: '$fronturl/autosave',
		data: piljab,
		error: function() {
		},
		success: function(data) {
		//console.log(data);
		}

	});

 });
 });
 
 //END AUTO SAVE JAWABAN	
	</script>

END;
?>
