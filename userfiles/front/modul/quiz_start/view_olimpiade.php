<?php
/*
bagaimana caranya mengatasi pengguna mobile yang berhenti sinkronisasi dengan server?
bagaimana caranya internet yang lambat bisa tetap mengerjakan. 
	dan jika refresh data lokal lebih di utamakan daripada data server.
	jika pindah ke perangkat lain data server yang di utamakan.
	cek apakah data local storage merupakan sesi yang sama dengan ujian existing! bedanya token ujian
	bagaimana caranya jika durasi ujian sudah habis siswa tidak bisa melihat soal tapi masih bisa submit jawaban.
login baru localstorage dibersihkan.	 

*/

$token=$_COOKIE['quiz_token'];
$pil_soal=array();
$pil_jawab=array();
if($token!="")
{
	$q=$mysql->query("SELECT * FROM quiz_done WHERE token='$token' AND is_done=0");
	if($q and $mysql->numrows($q)>0)
	{
		$member_data=$mysql->assoc($q);
	}
	else
	{
		quiz_login();
	}
}
else
{
	quiz_login();
}
$member_id=$member_data['member_id'];
$last_digit=substr($member_id,-1,1);
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
<div class="koneksi_bermasalah" style="display:none;">Tidak terhubung dengan server</div>
<div class="koneksi_putus" style="display:none;">Koneksi bermasalah</div>
<div class="koneksi_lambat" style="display:none;">Koneksi internet terlalu lambat</div>
<form onsubmit="cek_jawaban();return false;" name="formulir" id="formulir" method="post" action=""    >
<input type="hidden" id="otomatis" name="otomatis" value="0">
<div class='container alma-container'>
<div class='row'>
<div class='col-md-10'>
<div id="divbiodata">
<div class="biodata-left">
<?php

echo "<span>Nama: ".$member_data['member_fullname']."</span>";
echo "<span>Sekolah: ".$member_data['member_class']."</span>";
echo "<span>Soal: ";
echo $member_data['quiz_title_id']."</span>";
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
	<img src="<?php echo fileurl("asset/ajax-loader.gif")?>">
	<input type="hidden"   name="selesai" value="Selesai Ujian">
	
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
<div id="formulir_ujian" >
<?php

$answer_temp=json_decode($member_data['answer_temp'],true);
$acak=$member_data['acak'];
$acak_pilihan=json_decode($member_data['acak_pilihan'],true);


$r_json_soal=get_soal_json($member_data['quiz_id']);
		
		
//$q=$mysql->query("SELECT * FROM quiz_detail WHERE quiz_id='".$member_data['quiz_id']."' ORDER BY FIELD(id,$acak)");

//if($q and $mysql->numrows($q)>0)
if(count($r_json_soal['soal_ganda'])>0)
{
	$no=0;
	//$total=$mysql->numrows($q);
	$total=count($r_json_soal['soal_ganda']);
	
	
	//while($v=$mysql->assoc($q))
	$r_acak=explode(",",$acak);	
	foreach($r_acak as $index)
	{
		$v=$r_json_soal['soal_ganda'][$index];
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
		/*cek apakah ada essay*/
		//$q_cek_essay=$mysql->query("SELECT id FROM quiz_essay WHERE quiz_id='".$member_data['quiz_id']."' ORDER BY id limit 1");
		//if($q_cek_essay and $mysql->numrows($q_cek_essay)>0){
		if(count($r_json_soal['soal_essay'])>0){
			$button_berikut='<a  class="navigasi-kanan quiz_navigation" href="#divbiodata"  onclick="tampilkan_soal('.($no+1).')"><i class="fa fa-arrow-right"></i></a>';	
		}
		
		}
		
		$no_sss=md5($v['id']);		
		
		?>
		<div class='wrap_soal row' id="wrap_soal<?php echo $no?>" berikut="<?php echo $button_berikut!=""?($no+1):"";?>">
			
			<div class='soal_desc <?php echo $v['model']==0?"col-md-12":"col-md-6";?>'>
			
			<?php 
			echo "<h4 class=\"subtitle_quiz\">Soal Pilihan Ganda</h4>";	
			echo $v['question'];
			?>
			</div>
			<?php
				$pilihan=array("A","B","C","D","E");
				$ada_pilihan=0;
				foreach($pilihan as $i=>$pil)
				{
					if(trim(strip_tags($v[$pil]))!="-"){	
					$ada_pilihan++;
					}
				}
			?>
			<div class='pilihan_ganda <?php echo $v['model']==0?"vertical col-md-12":"horizontal col-md-6";?>'>
			<h4 class="subtitle_quiz"><?php echo $ada_pilihan>0?"Pilihan Jawaban":"";?></h4>
				<ul>
				<?php
				$acak_jawaban=array();
				
				$jawaban=$answer_temp[$no];//$_COOKIE['soal'.$no];
				
				$tanda[$no]=$jawaban!=""?1:0;
				
				
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
					<li>
						<div class="kolom_input">		
							<input mark-choice="mark-value" onclick="<?php echo $no<$total?"tampilkan_soal_delay('".($no+1)."')":""; ?>" class="radio_pilihan icheck-me"  <?php echo $checked;?> id="<?php echo $pil.$no;?>" type="radio" meta-urutan="<?php echo $no;?>" meta-name="soal<?php echo $no;?>" meta-label="label_<?php echo $pil.$no;?>" name="soal_<?php echo $no_sss;?>" value="<?php echo $pil;?>" />
							<label id="label_<?php echo $pil.$no;?>" class="soal<?php echo $no;?> <?php echo $class_checked;?>" for="<?php echo $pil.$no;?>">
							<div class="abjad"><?php //echo $pil;?></div>
							<?php echo $v[$pil];?></label>
						</div>
						
					</li>	
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
		$panel_answer.="<span class='checked_answer $tandai'  onclick='tampilkan_soal($i)' id='check_soal$i'>$i<div class='check_abc' id='answer_soal$i'></div></span>";
		
	}
}

////////////////ESSAY

	
//$q=$mysql->query("SELECT qe.* FROM quiz_essay qe  WHERE qe.quiz_id='".$member_data['quiz_id']."' ORDER BY qe.id");
$ada_essay=0;
//if($q and $mysql->numrows($q)>0)
if(count($r_json_soal['soal_essay'])>0)
{
	$ada_essay=1;
	//$total_essay=$mysql->numrows($q);
	$total_essay=count($r_json_soal['soal_essay']);
	$r_no_essay=array();
	$no_essay=0;
	//while($v=$mysql->assoc($q))
	foreach($r_json_soal['soal_essay'] as $v)
	{
		$no++;
		$no_essay++;
		$r_no_essay[]=$no;
		if($no_essay>1)
		{
		$button_sebelum='<a class="navigasi-kiri quiz_navigation" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="fa fa-arrow-left"></i></a>';
		}
		else
		{
		//kembali ke pilihan ganda	
		$button_sebelum='<a class="navigasi-kiri quiz_navigation" href="#divbiodata" onclick="tampilkan_soal('.($no-1).')"><i class="fa fa-arrow-left"></i></a>';	
		//$button_sebelum="";	
		}
		if($no_essay<$total_essay)
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
			echo "<h4 class=\"subtitle_quiz\">Soal Uraian</h4>";
			echo $v['question'];
			?>
			</div>
			<div class='pilihan_essay <?php echo $v['model']==0?"vertical col-md-12":"horizontal col-md-6";?>'>
				<br/>
				<br/>
				<br/>
			<h4 class="subtitle_quiz"><?php echo $ada_pilihan>0?"Silahkan isi jawaban dikertas!":"";?></h4>
			</div>
			<div class='navigation_button'>
			<?php
			echo $button_sebelum;
			echo "<div class='quiz_navigation soal_no'>".$no_essay."</div>";	
			echo $button_berikut;
			?>
			</div>
		</div>
		<?php
	}
	//create panel answer 
	
	
	//for($i=1;$i<=$total;$i++)
	foreach($r_no_essay as $x => $i)
	{
		//$panel_answer_essay.="<span  onclick='tampilkan_soal($i)' id='check_soal_$i'>".($x+1)."</span>";
		$panel_answer_essay.="<span class='checked_answer'  onclick='tampilkan_soal($i)' id='check_soal$i'>".($x+1)."</span>";
		
	}
}
$logo=logo();	
$logo_instansi=logo_footer();	
?>

<input type="hidden" name="token" id="token" value="<?php echo $token;?>" />
<!-- mark button submit-->
<?php

echo '<div class="row" id="footer-instansi">';
if($web_config_show_footer_instansi==1){
echo <<<END
	<div class="col-md-4"><img class="logo-instansi-footer" src="$logo_instansi" alt="logo-instansi" title="logo-instansi" /></div>
	<div class="col-md-8">$web_config_footer_instansi</div>
END;
	
}
echo '</div>';


?>
</div>

</div>
<div class='col-md-2' >
	<div class="panel_answer">
		
		<div class="cek_pilihan_ganda">
			<h1>Pilihan Ganda</h1>
			<?php echo $panel_answer;?>
		</div>
		<?php 
		if($ada_essay){
		?>
		<div class="cek_pilihan_essay">
			<h1>Soal Uraian</h1>			
			<?php echo $panel_answer_essay;?>
		</div>
		<?php
		}
		?>
	</div>
	
</div>
<div class="auto-save-icon" style="display:none;">
<img src="<?php echo fileurl("asset/ajax-loader.gif")?>">
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
	<p>Apakah anda yakin tetap mau mengakhiri ujian anda? <br/>Masih ada <span id="msg_ujian_bolong"></span> soal pilihan ganda yang belum dijawab!!! </p>
</div>
<div id="dialog-confirm-adawaktu" title="Apakah anda yakin?" style="display:none;">
	Masih ada waktu untuk mengecek jawaban anda!	
</div>
<div id="dialog-confirm-newtab" title="Peringatan!!!" style="display:none;">
	Anda dilarang meninggalkan halaman ini. kami merekam aktifitas anda
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
display:none;
}
.ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix.ui-draggable-handle {
 
}
.ui-widget-header{
 background-color: red !important;
}

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
    line-height: 36px;
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
    font-size: 9pt;
    height: 40px;
    text-align: center;
    width: 35px;
    position: relative;
    padding: 16px 0 0 0;
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
  background-color: $color_2;
  border: medium none;
  display: block;
  font-weight: bold;
  margin: 25px auto;
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
  background-color: $color_2;
  border: medium none;
  display: block;
  font-weight: bold;
  margin: 0	 auto;
  padding: 19px 24px;
  position: fixed;
  right: calc(100% /30);
  top: 10px;
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
    color: black;
    border-radius: 45px;
    position: absolute !important;
    width: 16px !important;
    height: 16px !important;
    right: 5px;
    top: 3px;
    font-size: 7pt !important;
    text-align: center !important;
    background-color: aliceblue;
    line-height: 14px;
    padding: 0 !important;
    background-color: #8db3e3;

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

$url_login=fronturl("quiz_login");
$url_done=fronturl("quiz_done");
$fronturl=fronturl("ajax");

$sound_image=fileurl("asset/speaker.gif");
$data_pil_soal=json_encode($pil_soal);
$data_pil_jawab=json_encode($pil_jawab);
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
	var durasi=$quiz_left_duration;
	var jalan = 0;
	var habis = 0;
window.addEventListener('visibilitychange', myPageShowListenerFunc, false);	

function myPageShowListenerFunc(){
$("#dialog-confirm-newtab").dialog("open");
alert('Anda dilarang menutup halaman ujian');
console.log('a');
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

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
	
	
	
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



	function init(){
		setup_soal();
		setTimeout(
		function(){
			initializeClock('clockdiv', deadline);	
			autosave(1);
			load_jawaban();		
		},1000);

		isujianvalid();
		soal_ke=localStorage.getItem('soal_ke');
		//soal_ke=getCookie("soal_ke");
		if(soal_ke!=""){
			tampilkan_soal(soal_ke);
		}
	
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
		if(koneksi_lambat>10){
			$(".koneksi_lambat").show();
		}else{
			$(".koneksi_lambat").hide();
		}
		
		koneksi_lambat++;
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
	}
	function tampilkan_soal_delay(nomor)
	{
	//setCookie("soal_ke",nomor,1);
	localStorage.setItem('soal_ke',nomor);
	setTimeout(function(){move_delay(nomor)},1000);
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
		for(i=1;i<=$total;i++)
		{			
			//jawaban=getCookie("soal"+i);
			jawaban=$("#answer_soal"+i).html();
			//console.log("soal"+i);
			if(jawaban=="")
			{
			bolong++;
			}
			
		}
		
	if(bolong)
	{
		$("#msg_ujian_bolong").html(bolong);
		$("#dialog-confirm-finish").dialog("open");
	}
	else
	{
	$("#dialog-confirm-adawaktu").dialog("open");
	}
	return true;		
	}	

function setJawab(id_soal)
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
		alert('belum dijawab');
	}else{
		//setCookie(nama_soal,nilai_soal,1);				
		//setCookie(jawab_soal,mark_choice,1);	
		localStorage.setItem(nomor,id_soal);
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
	
	
	$(".kolom_input>input").click(function(){
		id_soal=$(this).attr("id");
		nomor=parseInt($(this).attr("meta-urutan"));
		
		nama_soal=$(this).attr("meta-name");
		jawab_soal="jawab_"+$(this).attr("meta-name");
		mark_choice=$(this).attr("mark-choice");
		nilai_soal=$(this).val();
		
		
		
		var dijawab=document.getElementById(id_soal).checked;
		
		if(!dijawab){
			alert('belum dijawab');
		}else{
			//setCookie(nama_soal,nilai_soal,1);				
			//setCookie(jawab_soal,mark_choice,1);	
			localStorage.setItem(nomor,id_soal);
			$("#answer_"+nama_soal).html(mark_choice);
			$("#check_"+nama_soal).removeClass("panel_answer_checked");
			$("#check_"+nama_soal).addClass("panel_answer_checked");
				
		}
	});
	
	
	
	});

$("#dialog-confirm-newtab").dialog({
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
			text: "",
			click: function() {
				
				$( this ).dialog( "close" );
			}
		}
	]
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
				submit_selesai();
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
