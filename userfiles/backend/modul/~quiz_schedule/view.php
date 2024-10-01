<?php
$col_back="&nbsp;";	
if($action=="del_confirm")
{
list($schedule_data)=$mysql->query_data("SELECT * FROM quiz_schedule WHERE id=$id ");
//var_dump($schedule_data);
$quiz_info=json_decode($schedule_data['quiz_info'],true);
$sql="SELECT id FROM quiz_done WHERE schedule_id=$id AND is_done=1 ";

$q=$mysql->query($sql);
if($q and $mysql->numrows($q)>0){
	$total_ujian=$mysql->numrows($q);
	
	$d=$mysql->assoc($q);
	if($total_ujian>0){
	echo
	'
	<div class="del_confirm">
	<div class="del_confirm_title">
	Apakah anda yakin mau menghapus hasil ujian  <b>'.$quiz_info['title_id'].'</b> dengan total  '.$total_ujian.' peserta?
	</div>
	<div class="del_confirm_button">
	<a class="btn btn-danger" href="'.backendurl("quiz_schedule/del/$id").'">Hapus</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="btn btn-danger" href="'.backendurl("quiz_schedule/del/$id?arsip=1").'">Hapus & Arsipkan</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="btn btn-inverse" href="'.backendurl("quiz_schedule").'">Batal</a>
	</div>
	</div>
	';
	}else{
	header("location:".backendurl("quiz_schedule/del/$id"));
	exit();
	}	
}else{
	header("location:".backendurl("quiz_schedule/del/$id"));
	exit();
}
}
if($action=="edit")
{
/* 
 * */
$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
$form = new Form("update{$modul}");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("$modul/update"),
	"enctype" =>"multipart/form-data" 
));
$form->addElement(new Element_HTML('<legend>'._MODULEDIT.'</legend>'));
$form->addElement(new Element_Hidden("form", "update{$modul}"));
$form->addElement(new Element_Hidden("id", "$id"));

$exam_date=date("d/m/Y",strtotime($d['tanggal']));
$exam_time=date("H:i",strtotime($d['tanggal']));
$exam_date_expired=date("d/m/Y",strtotime($d['tanggal_expired']));
$exam_time_expired=date("H:i",strtotime($d['tanggal_expired']));

/*
$form->addElement(new Element_jQueryUIDate("Tanggal Uji", "exam_date",array("value"=>$exam_date,"jQueryOptions" => array("dateFormat" => "dd/mm/yy"))));
$form->addElement(new Element_Time("Jam Mulai", "exam_time",array("value"=>$exam_time)));
*/
$kondisi="";
if($_SESSION['s_level']==0){
	$kondisi=" WHERE created_by='".$_SESSION['s_id']."'";
}
$quiz_data=$mysql->query_data("SELECT * FROM quiz_master $kondisi ORDER BY code ASC ");

$quiz_option='<option value="">Pilih Soal</option>';
if(count($quiz_data)>0){
	foreach($quiz_data as $qd){
		$selected=$qd['id']==$d['quiz_id']?"selected='selected'":"";
		$quiz_option.='<option value="'.$qd['id'].'" '.$selected.'>'.$qd['code'].' - '.$qd['title_id'].'</option>';
	} 
}
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Soal Uji
<span class="required">* </span>
</label><div class="controls">
<select id="quiz_id" name="quiz_id" required="required" onchange="update_quiz_select(this.value)">
'.$quiz_option.'
</select>
</div>
</div>
'
));

$quiz_data=$mysql->query_data("SELECT * FROM quiz_master WHERE id='".$d['quiz_id']."'");
list($quiz_data)=$quiz_data;
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">

</label><div id="quiz_info" class="controls">

	<table>
	<tr><td>Kode</td><td>:</td><td>'.$quiz_data['code'].'</td></tr>
	<tr><td>Soal</td><td>:</td><td>'.$quiz_data['title_id'].'</td></tr>
	<tr><td>Durasi</td><td>:</td><td>'.$quiz_data['duration'].'</td></tr>
	<tr><td>KKM</td><td>:</td><td>'.$quiz_data['kkm'].'</td></tr>
	<tr><td>Acak Soal</td><td>:</td><td>'.($quiz_data['is_random']==1?"Ya":"Tidak").'</td></tr>
	<tr><td>Acak Pilihan</td><td>:</td><td>'.($quiz_data['is_random_option']==1?"Ya":"Tidak").'</td></tr>
	</table>
	
</div>
</div>
'

));
$late_checked=$d['is_late']==1?'checked="checked"':'';
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
</label><div class="controls">
<input type="checkbox" id="is_late" name="is_late" value="1" '.$late_checked.' /> Tepat waktu
</div>
</div>
'
));

$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Tanggal Uji
</label>
<div class="controls">
  <div id="datetimepicker1" class="input-append date">
    <input data-format="dd/MM/yyyy" type="text" id="exam_date" name="exam_date" value="'.$exam_date.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  Pukul
  <div id="datetimepicker2" class="input-append date">
    <input data-format="hh:mm" type="text" id="exam_time" name="exam_time"  value="'.$exam_time.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#datetimepicker1").datetimepicker({
      language: "pt-BR",
      pickTime: false,
      startDate:"'.$exam_date.'"
    });
  });
  $("#datetimepicker1,#datetimepicker2").on("changeDate", function(e) {
	set_kadaluarsa();	
	});
  
  $(function() {
    $("#datetimepicker2").datetimepicker({
      language: "pt-BR",
      pickDate: false,
      pickSeconds: false
    });
  });
  
</script>
'

));

$form->addElement(new Element_HTML(
'
<div class="control-group" id="div_kadaluarsa">
<label for="updatequiz_master-element-3" class="control-label">
Kadaluarsa
</label>
<div class="controls">

  <div id="datetimepicker3" class="input-append date">
    <input data-format="dd/MM/yyyy" type="text" id="exam_date_expired" name="exam_date_expired" value="'.$exam_date_expired.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  Pukul
  <div id="datetimepicker4" class="input-append date">
    <input data-format="hh:mm" type="text" id="exam_time_expired" name="exam_time_expired"  value="'.$exam_time_expired.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#datetimepicker3").datetimepicker({
      language: "pt-BR",
      pickTime: false,
       startDate:"'.$exam_date.'",
    });
  });
  
  $(function() {
    $("#datetimepicker4").datetimepicker({
      language: "pt-BR",
      pickDate: false,
      pickSeconds: false,
    });
  });
  
</script>
'

));




$r_allow_class=explode(",",$d['allow_class']);
$quiz_class=$mysql->query_data("SELECT distinct class FROM quiz_member ORDER BY class ASC ");

$allclass=array();
if(count($quiz_class)>0){
	foreach($quiz_class as $qd){
		$allclass[]=$qd['class'];
	}
}
$allclass=join(",",$allclass);



$quiz_class_option='<ul class="pilih_kelas">';
//$checked=in_array("ALL",$r_allow_class);
$quiz_class_option.='<li><input class="class_all" type="checkbox" value="0" name="check_all" />Semua Kelas</li>';
if(count($quiz_class)>0){
	foreach($quiz_class as $qd){
		$checked=in_array($qd['class'],$r_allow_class);
		$quiz_class_option.='<li><input class="class_select"  name="allow_class[]" '.($checked==1?"checked='checked'":"").' type="checkbox" value="'.$qd['class'].'" />'.$qd['class'].'</li>';
	} 
}
$quiz_class_option.='</ul>';

$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Pilih Kelas
</label><div class="controls">
'.$quiz_class_option.'
</div>
</div>
'));

/*
$form->addElement(new Element_Textbox(_KODE,"code",array("required"=>1,"value"=>$d['code'])));
$form->addElement(new Element_Textbox(_JUDUL,"title_id", array("required" => 1,"value"=>$d['title_id'])));
$form->addElement(new Element_Textbox(_DURASI,"duration",array("required" => 1,"type"=>"number","min"=>"1","value"=>$d['duration'])));
//$form->addElement(new Element_Textarea(_KONTEN,"content_id", array("value"=>$d['content_id'],"class"=>"smalltiny")));


$opt_random.='<option value="1" '.($d['is_random']==1?"selected='selected'":"").'>Ya</option>';
$opt_random.='<option value="0" '.($d['is_random']==0?"selected='selected'":"").'>Tidak</option>';


$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Acak Soal
<span class="required">* </span>
</label><div class="controls">
<select name="is_random" required="required">
'.$opt_random.'
</select>

</div>
</div>
'

));
*/
//$form->addElement(new Element_Textbox(_URL,"url", array("required" => 1,"value"=>$d['url'])));
$form->addElement(new Element_Button(_SIMPAN));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
}

if($action=="copy")
{
$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
$form = new Form("{$modul}save_as");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("$modul/save_as"),
	"enctype" =>"multipart/form-data" 
));
$form->addElement(new Element_HTML('<legend>'._MODULCOPY.'</legend>'));
$form->addElement(new Element_Hidden("form", "{$modul}save_as"));
$form->addElement(new Element_Hidden("id", "$id"));


$exam_date=date("d/m/Y",strtotime($d['tanggal']));
$exam_time=date("H:i",strtotime($d['tanggal']));
$exam_date_expired=date("d/m/Y",strtotime($d['tanggal_expired']));
$exam_time_expired=date("H:i",strtotime($d['tanggal_expired']));
/*
$form->addElement(new Element_jQueryUIDate("Tanggal Uji", "exam_date",array("value"=>$exam_date,"jQueryOptions" => array("dateFormat" => "dd/mm/yy"))));
$form->addElement(new Element_Time("Jam Mulai", "exam_time",array("value"=>$exam_time)));
*/
$kondisi="";
if($_SESSION['s_level']==0){
	$kondisi=" WHERE created_by='".$_SESSION['s_id']."'";
}
$quiz_data=$mysql->query_data("SELECT * FROM quiz_master $kondisi ORDER BY code ASC ");

$quiz_option='<option value="">Pilih Soal</option>';
if(count($quiz_data)>0){
	foreach($quiz_data as $qd){
		$selected=$qd['id']==$d['quiz_id']?"selected='selected'":"";
		$quiz_option.='<option value="'.$qd['id'].'" '.$selected.'>'.$qd['code'].' - '.$qd['title_id'].'</option>';
	} 
}
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Soal Uji
<span class="required">* </span>
</label><div class="controls">
<select id="quiz_id" name="quiz_id" required="required" onchange="update_quiz_select(this.value)">
'.$quiz_option.'
</select>

</div>
</div>
'

));
$quiz_data=$mysql->query_data("SELECT * FROM quiz_master WHERE id='".$d['quiz_id']."'");
list($quiz_data)=$quiz_data;
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">

</label><div id="quiz_info" class="controls">

	<table>
	<tr><td>Kode</td><td>:</td><td>'.$quiz_data['code'].'</td></tr>
	<tr><td>Soal</td><td>:</td><td>'.$quiz_data['title_id'].'</td></tr>
	<tr><td>Durasi</td><td>:</td><td>'.$quiz_data['duration'].'</td></tr>
	<tr><td>Acak</td><td>:</td><td>'.($quiz_data['is_random']==1?"Ya":"Tidak").'</td></tr>
	</table>
	
</div>
</div>
'
));
$late_checked=$d['is_late']==1?'checked="checked"':'';
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
</label><div class="controls">
<input type="checkbox" id="is_late" name="is_late" value="1" '.$late_checked.' /> Tepat waktu
</div>
</div>
'
));

$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Tanggal Uji
</label>
<div class="controls">

  <div id="datetimepicker1" class="input-append date">
    <input data-format="dd/MM/yyyy" type="text" id="exam_date" name="exam_date" value="'.$exam_date.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  Pukul
  <div id="datetimepicker2" class="input-append date">
    <input data-format="hh:mm" type="text" id="exam_time" name="exam_time"  value="'.$exam_time.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#datetimepicker1").datetimepicker({
      language: "pt-BR",
      pickTime: false,
      startDate:"'.$exam_date.'"
    });
  });
  $("#datetimepicker1,#datetimepicker2").on("changeDate", function(e) {
	set_kadaluarsa();	
	});
  
  $(function() {
    $("#datetimepicker2").datetimepicker({
      language: "pt-BR",
      pickDate: false,
      pickSeconds: false
    });
  });
  
</script>
'

));

$form->addElement(new Element_HTML(
'
<div class="control-group" id="div_kadaluarsa">
<label for="updatequiz_master-element-3" class="control-label">
Kadaluarsa
</label>
<div class="controls">

  <div id="datetimepicker3" class="input-append date">
    <input data-format="dd/MM/yyyy" type="text" id="exam_date_expired" name="exam_date_expired" value="'.$exam_date_expired.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  Pukul
  <div id="datetimepicker4" class="input-append date">
    <input data-format="hh:mm" type="text" id="exam_time_expired" name="exam_time_expired"  value="'.$exam_time_expired.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#datetimepicker3").datetimepicker({
      language: "pt-BR",
      pickTime: false,
       startDate:"'.$exam_date.'",
    });
  });
  
  $(function() {
    $("#datetimepicker4").datetimepicker({
      language: "pt-BR",
      pickDate: false,
      pickSeconds: false,
    });
  });
  
</script>
'

));

$r_allow_class=explode(",",$d['allow_class']);
$quiz_class=$mysql->query_data("SELECT distinct class FROM quiz_member ORDER BY class ASC ");

$allclass=array();
if(count($quiz_class)>0){
	foreach($quiz_class as $qd){
		$allclass[]=$qd['class'];
	}
}
$allclass=join(",",$allclass);


$quiz_class_option='<ul  class="pilih_kelas">';
$checked=in_array("ALL",$r_allow_class);
$quiz_class_option.='<li><input class="class_all" type="checkbox" value="" '.($checked==1?"checked='checked'":"").' name="check_all" />Semua Kelas</li>';
if(count($quiz_class)>0){
	foreach($quiz_class as $qd){
		$checked=in_array($qd['class'],$r_allow_class);
		$quiz_class_option.='<li><input class="class_select"  name="allow_class[]" '.($checked==1?"checked='checked'":"").' type="checkbox" value="'.$qd['class'].'" />'.$qd['class'].'</li>';
	} 
}
$quiz_class_option.='</ul>';

$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Pilih Kelas
</label><div class="controls">
'.$quiz_class_option.'
</div>
</div>
'));


$form->addElement(new Element_Button(_SIMPAN));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
}

if($action=="add")
{
$form = new Form("{$modul}add");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"action" =>backendurl("$modul/save"),
	"enctype" =>"multipart/form-data" ));
	
$form->addElement(new Element_HTML('<legend>'._MODULTAMBAH.'</legend>'));
$form->addElement(new Element_Hidden("form", "{$modul}add"));
/*
$form->addElement(new Element_File(_THUMBNAIL, "filename"));
*/
$kondisi="";
if($_SESSION['s_level']==0){
	$kondisi=" WHERE created_by='".$_SESSION['s_id']."'";
}
$quiz_data=$mysql->query_data("SELECT * FROM quiz_master $kondisi ORDER BY code ASC ");
$quiz_option='<option value="">Pilih Soal</option>';
if(count($quiz_data)>0){
	foreach($quiz_data as $qd){
		$quiz_option.='<option value="'.$qd['id'].'">'.$qd['code'].' - '.$qd['title_id'].'</option>';
	} 
}
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Soal Uji
<span class="required">* </span>
</label><div class="controls">
<select id="quiz_id" name="quiz_id" required="required" onchange="update_quiz_select(this.value)">
'.$quiz_option.'
</select>

</div>
</div>
'

));
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">

</label><div id="quiz_info" class="controls">

</div>
</div>
'

));
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
</label><div class="controls">
<input type="checkbox" id="is_late" name="is_late" value="1" checked="checked" /> 
Tepat waktu
</div>
</div>
'
));

$exam_date=date("d/m/Y");
$exam_time=date("H:i");
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Tanggal Uji
</label>
<div class="controls">

  <div id="datetimepicker1" class="input-append date">
    <input data-format="dd/MM/yyyy" type="text" id="exam_date" name="exam_date" value="'.$exam_date.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  Pukul
  <div id="datetimepicker2" class="input-append date">
    <input data-format="hh:mm" type="text" id="exam_time" name="exam_time"  value="'.$exam_time.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#datetimepicker1").datetimepicker({
      language: "pt-BR",
      pickTime: false,
      startDate:"'.$exam_date.'"
    });
  });
  $("#datetimepicker1,#datetimepicker2").on("changeDate", function(e) {
	set_kadaluarsa();	
	});
  
  $(function() {
    $("#datetimepicker2").datetimepicker({
      language: "pt-BR",
      pickDate: false,
      pickSeconds: false
    });
  });
  
</script>
'

));

$form->addElement(new Element_HTML(
'
<div class="control-group" id="div_kadaluarsa">
<label for="updatequiz_master-element-3" class="control-label">
Kadaluarsa
</label>
<div class="controls">

  <div id="datetimepicker3" class="input-append date">
    <input data-format="dd/MM/yyyy" type="text" id="exam_date_expired" name="exam_date_expired" value="'.$exam_date.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  Pukul
  <div id="datetimepicker4" class="input-append date">
    <input data-format="hh:mm" type="text" id="exam_time_expired" name="exam_time_expired"  value="'.$exam_time.'" required="required"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
  
</div>
</div>
<script type="text/javascript">
  $(function() {
    $("#datetimepicker3").datetimepicker({
      language: "pt-BR",
      pickTime: false,
       startDate:"'.$exam_date.'",
    });
  });
  
  $(function() {
    $("#datetimepicker4").datetimepicker({
      language: "pt-BR",
      pickDate: false,
      pickSeconds: false,
    });
  });
  
</script>
'

));

//$form->addElement(new Element_Textbox("Tanggal Uji","exam_date",array("required"=>1,"value"=>$exam_date,array("id"=>"exam_date"))));
//$form->addElement(new Element_Textbox("Jam Mulai","exam_time",array("required"=>1,"value"=>$exam_time)));

/*
$form->addElement(new Element_jQueryUIDate("Tanggal Uji", "exam_date",array("value"=>date("d/m/Y"),"jQueryOptions" => array("dateFormat" => "dd/mm/yy"))));
$form->addElement(new Element_Time("Jam Mulai", "exam_time",array("value"=>date("H:i"))));
*/




$quiz_class=$mysql->query_data("SELECT distinct class FROM quiz_member ORDER BY class ASC ");

$allclass=array();
if(count($quiz_class)>0){
	foreach($quiz_class as $qd){
		$allclass[]=$qd['class'];
	}
}
$allclass=join(",",$allclass);

$quiz_class_option='<ul class="pilih_kelas">';
$quiz_class_option.='<li><input class="class_all" type="checkbox" value="'.$allclass.'" name="check_all" />Semua Kelas</li>';
if(count($quiz_class)>0){
	foreach($quiz_class as $qd){
		$quiz_class_option.='<li><input class="class_select"  name="allow_class[]" type="checkbox" value="'.$qd['class'].'" />'.$qd['class'].'</li>';
	} 
}
$quiz_class_option.='</ul>';
$form->addElement(new Element_HTML(
'
<div class="control-group">
<label for="updatequiz_master-element-3" class="control-label">
Pilih Kelas
</label><div class="controls">
'.$quiz_class_option.'
</div>
</div>
'));

$form->addElement(new Element_Textbox("Token","token",array("value"=>"","placeholder"=>"Otomatis")));
/*
foreach($list_lang as $i =>$v)
{
$form->addElement(new Element_TinyMCE(_KONTEN,"content_$v",array("class"=>"smalltiny")));
}
*/
$form->addElement(new Element_Button(_SIMPAN));
$form->addElement(new Element_Button(_BATAL, "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();

}

if($action=="" or $action=="search" or $action=="view" or $action=="today")
{
$form_search=form_search($keyword);
}

if($action=="view" or $action=="" or $action=="search" or $action=="today")
{
Form::clearValues("update{$modul}");
Form::clearValues("{$modul}add"); 
Form::clearValues("{$modul}save_as"); 	

$col_tambah=button_add("$modul/add");
//$col_tambah.="&nbsp;&nbsp;<a class=\"btn btn-filter\" href=\"".backendurl("$modul/".($action=="show_calendar"?"view":"show_calendar"))."\" ><img alt=\"View Calendar\" border=\"0\" src=\"".modul_asset_url("$modul/asset/date.png")."\">".($action=="show_calendar"?"Daftar":"Kalender")."</a>";
$col_tambah.="&nbsp;&nbsp;<a class=\"btn btn-filter\" href=\"".backendurl("$modul/".($action=="today"?"view":"today"))."\" ><img alt=\"View\" border=\"0\" src=\"".backendurl("images/view.png")."\">".($action=="today"?"Semua":"Hari Ini")."</a>";

if($_SESSION['s_level']>1)
{
$col_tambah.="&nbsp;&nbsp;<a class=\"btn btn-upload\" href=\"#\" onclick=\"$('.upload_jadwal').show();\">Restore(*.gz)</a>";
$col_tambah.="&nbsp;&nbsp;<a class=\"btn btn-download\" onclick=\"document.getElementById('form_list_jadwal').submit();\">Backup(*.gz)</a>";
$col_tambah.="&nbsp;&nbsp;
<span class=\"upload_jadwal\" style=\"display:none;\">
<form method=\"post\" enctype=\"multipart/form-data\" action=\"".backendurl("$modul/upload")."\">
File Jadwal (*.gz)<input type=\"file\" accept=\"gz/*\" name=\"filename\" required=\"required\">
<button type=\"submit\" class=\"btn btn-primary\" name=\"proses_upload\" value=\"1\" />Submit Jadwal</button>
</form></span>";
}
$sql="SELECT m.id,m.token,m.allow_class,m.tanggal,m.tanggal_expired,date_format(m.tanggal,'%d/%m/%Y') exam_date,date_format(m.tanggal,'%H:%i') exam_time,
date_format(m.tanggal_expired,'%d/%m/%Y') exam_date_expired,date_format(m.tanggal_expired,'%H:%i') exam_time_expired,
m.is_late,q.code,q.title_id,q.duration,q.is_random,q.is_random_option,q.kkm,(select count(*) from quiz_detail q WHERE q.quiz_id=m.quiz_id  ) soal, m.modified_date,m.created_date	 FROM $modul m LEFT JOIN quiz_master q ON m.quiz_id=q.id ";
$sql.=" WHERE m.is_deleted=0 ";
if( $action=="today"){
	$sql.=" AND ('$hariini' BETWEEN  date_format(m.tanggal,'%Y-%m-%d') AND date_format(m.tanggal_expired,'%Y-%m-%d')";
	$sql.=" OR  date_format(m.tanggal,'%Y-%m-%d') ='$hariini')";
}

if($action=="search"){
$sql.=" AND (q.title_id LIKE '%$keyword%' ";
$sql.=" OR q.code LIKE '%$keyword%' ";
$sql.=" OR m.token LIKE '%$keyword%' ";
$sql.=" ) ";
}

if($_SESSION['s_level']==0){
	$sql.=" AND m.quiz_id IN (SELECT id FROM quiz_master WHERE created_by='".$_SESSION['s_id']."')";
}
$r=$mysql->query($sql);
$total_records = $mysql->numrows($r);
$start = $screen * $max_page_list;
$pages = ceil($total_records/$max_page_list);
if ($pages>1) $col_pagination=pagination($screen);
$sql.="  order by $sort_by $sort_order  LIMIT $start, $max_page_list";

$r=$mysql->query($sql);
echo "
<form method='post' id='form_list_jadwal' name='form_list_jadwal' action='".backendurl("$modul/download")."'>
<table id='DataTables_Table_3_wrapper' class='view-table table table-hover table-nomargin table-bordered '>";
echo "
<thead>
<tr>
<th>No</th>
<th>Token</th>
";
echo "<th>".orderBy("tanggal",_TANGGAL,$sort_order,$sort_by)."</th>";
//echo "<th>Kadaluarsa</th>";
//echo "<th>Tepat waktu</th>";

echo "<th>".orderBy("title_id",_JUDUL,$sort_order,$sort_by)."</th>";
echo "<th>Action</th>";

echo "
</tr>
</thead>
";
$no=($start+1);
if($mysql->numrows($r)>0)
{
echo '<tbody id="brand_row" class="ui-sortable">';

while($d=$mysql->assoc($r))
{
$style_today="";	
$a=0;	

$a=strtotime($hariini_long)-strtotime($d["modified_date"]);
$b=strtotime($hariini_long)-strtotime($d["created_date"]);
//if(date("Y-m-d",strtotime($d["tanggal"]))==$hariini or $a<0){
$a=$a/60;
$b=$b/60;
if($a<=5 or $b<=5){$style_today="color-time1";}
//elseif($a>50 and $a<=100){$style_today="color-time2";}
//elseif($a>100 and $a<=150){$style_today="color-time3";}
//elseif($a>150 and $a<=300){$style_today="color-time4";}
//else{$style_today="color-time5";}
//}	


$class=$mysql->query("SELECT member_class,count(id) jumlah FROM quiz_done WHERE schedule_id='".$d['id']."' AND is_done=1 GROUP BY member_class");
$jumlah_peserta_ujian=array();
$r_allow_class=array();
if($class and $mysql->numrows($class)>0){
	while($dclass=$mysql->assoc($class)){
		$r_allow_class[]=$dclass['member_class'];
		$jumlah_peserta_ujian[$dclass['member_class']]=$dclass['jumlah'];
	}
}
$allow_class="<span class='class_option'>".join("</span><span class='class_option'>",$r_allow_class)."</span>";
	
	if(count($r_allow_class)>0){
		$allow_class="";
		foreach($r_allow_class as $x =>$v){
			$allow_class.="<div style='display:block;clear:both;'><a class='button_download_excel' style='margin-bottom:3px;' title='Download $v dalam bentuk Excel' href='".fronturl("get_excel/?schedule_id=".$d['id'])."&class=$v'><img alt=\"Download Excel\" border=\"0\" src=\"".backendurl("images/excel_l.gif")."\">&nbsp;".$v."(".($jumlah_peserta_ujian[$v]).")</div>";
		}
	}
	/*
	else{
		if($d['allow_class']=="ALL"){
		$class=$mysql->get1value("SELECT GROUP_CONCAT(DISTINCT(member_class)) FROM quiz_done WHERE schedule_id='".$d['id']."'");
		$d['allow_class'].=",".$class;
		}
	}
	*/ 
//jika tidak ada sama sekali




echo "
<tr id='list_{$d['id']}' class='rowmove $style_today'>
<td>$no ".($_SESSION['s_level']>1?"<input type='checkbox' name='id_schedule[]' value='".$d['id']."' />":"")."</td>
";
/*
$thumbnail_url="$small_url/".$d['thumbnail'];
$thumbnail_path="$small_pic/".$d['thumbnail'];

if(file_exists("$thumbnail_path")){echo "<td class='brand_thumbnail'><img src='".$thumbnail_url."'/></td>";}
else{echo "<td>&nbsp;</td>";}
*/
//$r_allow_class=explode(",",$d["allow_class"]);
//$allow_class=join(", ",$r_allow_class);


/*TANGGAL MULAI DAN EXPIRED*/
$tanggal_ujian=tgl_indo_long(date("Y-m-d",strtotime($d['tanggal'])));
$tanggal_expired=tgl_indo_long(date("Y-m-d",strtotime($d['tanggal_expired'])));
$hari_sama=$tanggal_ujian==$tanggal_expired?1:0;
$jadwal_ujian="";
if($hari_sama==1)
{
	$jadwal_ujian="
	<span class='tanggal_ujian_inline'><i class=\"icon-calendar\"></i>$tanggal_ujian</span><span class='waktu_ujian_inline'><i class='glyphicon-stopwatch'></i>
	".date("H:i",strtotime($d['tanggal']))." - ".date("H:i",strtotime($d['tanggal_expired'])).
	"</span>";
}
else
{
	$jadwal_ujian= "

	<span class='tanggal_ujian'><i class=\"icon-calendar\"></i>$tanggal_ujian</span><span class='waktu_ujian'><i class='glyphicon-stopwatch'></i>
	".date("H:i",strtotime($d['tanggal'])).
	"</span><br/>";
	$jadwal_ujian.= "
	<span class='tanggal_ujian'><i class=\"icon-calendar\"></i>$tanggal_expired</span><span class='waktu_ujian'><i class='glyphicon-stopwatch'></i>
	".date("H:i",strtotime($d['tanggal_expired'])).
	"</span>";
}
/*END TANGGAL MULAI DAN EXPIRED*/


echo "<td valign='top' ><b>".$d["token"]."</b></td>";
echo "<td valign='top' class='td_tanggal_ujian'>$jadwal_ujian</td>";
echo "<td><b>".$d["code"]." - ".$d["title_id"]."</b> <br/>(".$d["soal"]." Soal, ".$d["duration"]." Menit,KKM ".$d["kkm"].($d["is_random"]==1?", Soal Acak":"")."".($d["is_random_option"]==1?", Pilihan Acak":"").", ".($d["is_late"]==1?" Tepat Waktu":"Waktu Bebas").")";
echo "<br/>$allow_class";
echo "</td>";
$ar_action=array("edit"=>$d['id'],"del_confirm"=>$d['id']);

//if($_SESSION['s_level']>=1)
//{
//$ar_action["del"]=$d['id'];
//}
//<a class='button_action' href='".backendurl("quiz_schedule/copy/".$d['id'])."'><i class='icon-copy'></i></a>
echo "<td>";
echo "<a class='button_action' href='".backendurl("quiz_dashboard/view/".$d['id'])."'><i class='icon-dashboard'></i></a>";
echo "<a class='button_action' href='".backendurl("$modul/view_analisa/?schedule_id=".$d['id'])."'><i class='icon-bar-chart'></i></a>";
echo button_action($ar_action);
//echo '<a class="button_action  action-schedule-remove" title="Arsipkan" data-toggle="modal" href="'.backendurl("quiz_schedule/del/".$d['id']).'"><i class="icon-flag"></i></a>';
echo "</td>";

echo "</tr>";
$no++;
}
echo "</tbody>";
}

echo "</table>
</form>";

}
///////////////////////////////////////////////////////////////////////////
if($action=="view_analisa")
{
$form_title="Analisa Soal";
$col_tambah.="<a class=\"printer\" target=\"_BLANK\"href='".backendurl("$modul/view_analisa/?quiz_id=".$_GET['quiz_id']."&schedule_id=".$_GET['schedule_id']."&print=1&class=".$_GET['class'])."'><img alt=\"Cetak\" border=\"0\" src=\"".backendurl("images/print.jpg")."\"></a>	  ";	
$schedule_id=cleanInput($_GET['schedule_id']);	
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();
list($dschedule)=$mysql->query_data("SELECT * FROM quiz_schedule WHERE id=$schedule_id");

//AMBIL KUNCI JAWABAN
	$quiz_id=$dschedule['quiz_id'];
	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
//END AMBIL KUNCI JAWABAN

$sql="SELECT * FROM quiz_done  WHERE is_done=1 AND schedule_id='".$schedule_id."' ORDER BY score DESC";
$r=$mysql->query($sql);
if($r and $mysql->numrows($r)){
	$r_temp=array();
	$class_rank="";
	$correct=array();
	$member_terpilih=array();
	$score_individu=array();
	$jawab=array();
	$jumlah_peserta=$mysql->numrows($r);
	$peta_biner=array();
	
	while($d=$mysql->assoc($r)){
		$class_rank=($d['score']>=70)?"upper":(($d['score']<=30)?"lower":"middle");
		
		if($class_rank=="upper" OR $class_rank=="middle" OR $class_rank=="lower"){
			$member_terpilih[$d['member_id']]=$d['score'];
		}
		
		
		$temp_answer=json_decode($d['answer'],true);
		//$temp_acak=explode(",",$d['acak']);
		$r_answer=array();
		
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $idsoal){
				$index+=1;
				
				$r_answer[$idsoal]=$temp_answer[$index];			
				$jawab[$index]["A"]+=$temp_answer[$index]=="A"?1:0;
				$jawab[$index]["B"]+=$temp_answer[$index]=="B"?1:0;
				$jawab[$index]["C"]+=$temp_answer[$index]=="C"?1:0;
				$jawab[$index]["D"]+=$temp_answer[$index]=="D"?1:0;
				$jawab[$index]["E"]+=$temp_answer[$index]=="E"?1:0;	
								
				$final_salah[$index]+=0;
				$final_benar[$index]+=0;
				$final_tidak_jawab[$index]+=0;
				
				//BANDINGKAN JAWABAN
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					//BENAR
					
					$score_individu[$d['member_id']]+=1;
					$peta_biner[$index][]=$d['member_id'];
					$final_benar[$index]+=1;
					$correct[$class_rank][$index]+=1;
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					//SALAH
					$final_salah[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
				}else{
					//TAK JAWAB
					$final_salah[$index]+=1;
					$final_tidak_jawab[$index]+=1;
					$member_salah[$index][]=$d['member_id'];

				}
				//END BANDINGKAN JAWABAN
			}
			
		}
	}

	if(count($member_salah)>0){
	$json_member=json_encode($member_salah);
	$insert=$mysql->query("REPLACE INTO quiz_analize(schedule_id,json_member) values ('$schedule_id','$json_member')");
	}
	
}

$nama_quiz=$mysql->get1value("SELECT concat(code,' ',title_id) judul FROM quiz_master WHERE id='$quiz_id'");
$jumlah_soal=count($kunci);

echo "<div class='span12'>";
echo '<div class="box">
	<div class="box-title">
		<h3>
			<i class="icon-bar-chart"></i>
			Analisa Butir Soal
		</h3>
	</div>
	<div class="box-content">';
echo "<p>
<table cellpadding=0>
<tr><td><b>Paket Soal </b></td><td>&nbsp;:&nbsp;</td><td>$nama_quiz</td></tr>";
/*TANGGAL MULAI DAN EXPIRED*/
$tanggal_ujian=date("Y-m-d",strtotime($dschedule['tanggal']));
$tanggal_expired=date("Y-m-d",strtotime($dschedule['tanggal_expired']));
$hari_sama=$tanggal_ujian==$tanggal_expired?1:0;
$jadwal_ujian="";
if($hari_sama==1)
{
echo "
	<tr>
	<td><b>Tanggal</b></td>
	<td>:</td>
	<td>".tgl_indo($tanggal_ujian)." Pukul ".date("H:i",strtotime($dschedule['tanggal']))." - ".date("H:i",strtotime($dschedule['tanggal_expired']))."</td>
	</tr>
	";
}
else
{
echo "
	<tr>
	<td><b>Tanggal Mulai</b></td>
	<td>:</td>
	<td>".tgl_indo($tanggal_ujian)." Pukul ".date("H:i",strtotime($dschedule['tanggal']))."</td>
	</tr>
	<tr>
	<td><b>Tanggal Selesai</b></td>
	<td>:</td>
	<td>".tgl_indo($tanggal_expired)." Pukul ".date("H:i",strtotime($dschedule['tanggal_expired']))."</td>
	</tr>
	";
}
/*END TANGGAL MULAI DAN EXPIRED*/
echo "
<tr><td><b>Jumlah Siswa</b> </td><td>&nbsp;:&nbsp;</td><td>$jumlah_peserta</td></tr>
</table>
<p>
<br/>

";

echo "<div class='kotak_laporan'>";
echo "<br/>";
ob_start();
echo "<table id='' border='1' cellspacing='0' cellpadding='3' style='width:auto;' class=''>";
echo '<tbody>';
echo "
<tr>
<th width='120px'>Item</th>
<th width='120px'>Incorrect</th>
<th width='120px'>Statistic Option</th>
<th width='120px'>Daya Pembeda</th>
<th width='120px'>Tingkat Kesulitan</th>
<th width='120px'>Efektifitas Option</th>
<th width='120px'>Status Soal</th>
</tr>";
/*
<th width='120px'>Correct(Upper Group #>= 70)</th>
<th width='120px'>Correct(Middle Group 31-69)</th>
<th width='120px'>Correct(Lower Group #<=30 ) </th>
<!-- <th width='120px'>Statistic Option</th> -->
<th width='120px'>Discrimination</th>
*/
$kunci_nomor=array();
if(count($kunci)>0){	
	$index=0;
	foreach($kunci as $idsoal => $idsoal){
	$index+=1;
	$kunci_nomor[$index]=$kunci[$idsoal];
	}			
}
$jumlah_member_terpilih=count($member_terpilih);
$rata_rata_benar=round(array_sum($score_individu)/count($score_individu),2);

$std_benar=round(sd($score_individu),2);

$total_score=array_sum($final_benar);
$propc=array();
$jawab_prope=array();
$p_x_q=array();
foreach($final_salah as $i => $v)
{
$r_mean=array();
$mean=0;
if(count($peta_biner[$i])>0){
	$jml_biner=count($peta_biner[$i]);
	foreach($peta_biner[$i] as $x => $member_id){
		$r_mean[]=$score_individu[$member_id];
	}
		
	//echo "<br/>";
	$mean=round(array_sum($r_mean)/count($r_mean),2);
}
$p=round(($final_benar[$i]==$jumlah_member_terpilih?$final_benar[$i]-1:$final_benar[$i])/$jumlah_member_terpilih,2);

$q=1-$p;
$sqrt_p_q=round(sqrt(($p/$q)),2);
$r_pBis=round((($mean-$rata_rata_benar)/$std_benar)*$sqrt_p_q,2);
$ordinat_y=round((1/sqrt(2*pi()))*exp(-0.5*$p),4);
$r_Bis=round((($mean-$rata_rata_benar)/$std_benar)*($p/$ordinat_y),2);
$p_x_q[]=round($p*$q,2);

/**/
//statistic option	

$jawab_prope[$i]["A"]=round($jawab[$i]["A"]/$jumlah_member_terpilih,2);	
$jawab_prope[$i]["B"]=round($jawab[$i]["B"]/$jumlah_member_terpilih,2);	
$jawab_prope[$i]["C"]=round($jawab[$i]["C"]/$jumlah_member_terpilih,2);	
$jawab_prope[$i]["D"]=round($jawab[$i]["D"]/$jumlah_member_terpilih,2);	
$jawab_prope[$i]["E"]=round($jawab[$i]["E"]/$jumlah_member_terpilih,2);
$out=($jumlah_member_terpilih-($jawab[$i]["A"]+$jawab[$i]["B"]+$jawab[$i]["C"]+$jawab[$i]["D"]+$jawab[$i]["E"]))/$jumlah_member_terpilih;	

$jawab_prope[$i]["out"]=round($out,2);	
$jawab_max=$jawab_prope[$i][$kunci_nomor[$i]];
$efektifitas_option=(
$jawab_max<$jawab_prope[$i]["A"] OR 
$jawab_max<$jawab_prope[$i]["B"] OR 
$jawab_max<$jawab_prope[$i]["C"] OR 
$jawab_max<$jawab_prope[$i]["D"] OR 
$jawab_max<$jawab_prope[$i]["E"] OR 
$jawab_max<$jawab_prope[$i]["out"])?
"Ada Option lain yang bekerja lebih baik":"Baik";
//end statistic option

$jumlah_benar=($correct['upper'][$i]+$correct['middle'][$i]+$correct['lower'][$i]);
$propc[$i]=$jumlah_benar>=$jumlah_member_terpilih?(($jumlah_benar-1)/$jumlah_member_terpilih):($jumlah_benar/$jumlah_member_terpilih);
$daya_pembeda=$r_Bis>0.21?"Dapat Membedakan":"Tidak dapat membeda- kan";
$tingkat_kesulitan=$propc[$i]>=0.7?"Mudah":(($propc[$i]>0.3 AND $propc[$i]<0.7)?"Sedang":"Sulit");
$point_pembeda=$r_Bis>0.21?1:-2;
$point_tk=($propc[$i]==1 OR $propc[$i]==0)?0:1;

$point_efektif=(
$jawab_max<$jawab_prope[$i]["A"] OR 
$jawab_max<$jawab_prope[$i]["B"] OR 
$jawab_max<$jawab_prope[$i]["C"] OR 
$jawab_max<$jawab_prope[$i]["D"] OR 
$jawab_max<$jawab_prope[$i]["E"] OR 
$jawab_max<$jawab_prope[$i]["out"])?0:1;


$total_point=($point_pembeda+$point_tk+$point_efektif);
$status_soal=$total_point>2?"Dapat diterima":(($total_point>0 AND $total_point<=2)?"Soal sebaiknya Direvisi":"Ditolak/ Jangan Digunakan");


echo "<tr>";
echo "<td>Pertanyaan $i</td>";
echo "<td align='center'><a href='".backendurl("$modul/view_siswa/?no_soal=".$i."&schedule_id=".$schedule_id)."'>".($v>0?$v:0)."</a></td>";
//echo "<td align='center'>".$correct['upper'][$i]."</td>";
//echo "<td align='center'>".$correct['middle'][$i]."</td>";
//echo "<td align='center'>".$correct['lower'][$i]."</td>";

echo "<td align='left'>";
//echo "Prop =".$propc[$i]."<br/>";
//echo "Biser =".$r_Bis."<br/>";
//echo "Rata =".$rata_rata_benar."<br/>";
//echo "Stdev =".$std_benar."<br/>";
	echo "<table width='80px'>";
	echo "<tr><td align=center ".($kunci_nomor[$i]=="A"?"style='color:red;font-weight:bold;'":"").">A</td><td>:".$jawab_prope[$i]["A"]."</td></tr>";
	echo "<tr><td align=center ".($kunci_nomor[$i]=="B"?"style='color:red;font-weight:bold;'":"").">B</td><td>:".$jawab_prope[$i]["B"]."</td></tr>";
	echo "<tr><td align=center ".($kunci_nomor[$i]=="C"?"style='color:red;font-weight:bold;'":"").">C</td><td>:".$jawab_prope[$i]["C"]."</td></tr>";
	echo "<tr><td align=center ".($kunci_nomor[$i]=="D"?"style='color:red;font-weight:bold;'":"").">D</td><td>:".$jawab_prope[$i]["D"]."</td></tr>";
	echo "<tr><td align=center ".($kunci_nomor[$i]=="E"?"style='color:red;font-weight:bold;'":"").">E</td><td>:".$jawab_prope[$i]["E"]."</td></tr>";
	echo "<tr><td align=center >?</td><td>:".$jawab_prope[$i]["out"]."</td></tr>";
	echo "</table>";
echo "</td>";
//echo "<div>$point_pembeda ,$point_tk,$point_efektif </div>";

echo "<td align='center'>".$daya_pembeda."</td>";
echo "<td align='center'>".$tingkat_kesulitan."</td>";
echo "<td align='center'>".$efektifitas_option."</td>";
echo "<td align='center'>".$status_soal."</td>";
//echo "<td align='center'>".round(($correct['upper'][$i]+$correct['lower'][$i])/$jumlah_peserta,2)."</td>";
//echo "<td align='center'>".round(($correct['upper'][$i]-$correct['lower'][$i])/($jumlah_peserta/2),2)."</td>";
echo "</tr>";
}
$reabilitas=round($jumlah_soal/($jumlah_soal-1)*(1-(array_sum($p_x_q)/pow($std_benar,2))),3);

echo '</tbody>';
echo '</table>';

$report=ob_get_clean();
echo "<br/><b>Reliabilitas Tes : $reabilitas</b><br/><br/>";
echo $report;
echo "</p>";
echo "</div>";
echo "</div>";
echo "</div>";
$rfinal_salah=json_encode($final_salah);
$jumlah_soal=count($final_salah);
 
}

///////////////////////////////////////////////////////////////////////////
if($action=="view_siswa")
{
	
$schedule_id=cleanInput($_GET['schedule_id']);
$no_soal=cleanInput($_GET['no_soal']);
$q=$mysql->query("SELECT schedule_id,json_member FROM quiz_analize WHERE schedule_id='$schedule_id'");
$nama_quiz=$mysql->get1value("SELECT concat(code,'-',title_id) judul FROM quiz_master WHERE id=(SELECT quiz_id FROM quiz_schedule WHERE id='$schedule_id')");

	if($q and $mysql->numrows($q)>0){
		$d=$mysql->assoc($q);
		//var_dump(strlen($d['json_member']));
		$r=explode(",",$d['json_member']);
		$json_member=json_decode($d['json_member'],true);
		
		
			if(count($json_member)>0){	
				$join_member="'".join("','",$json_member[$no_soal])."'";	
				
				$q=$mysql->query("SELECT member_code,member_class,member_fullname FROM quiz_done WHERE member_id IN ($join_member) AND schedule_id='$schedule_id' ORDER BY member_class,member_fullname");
				if($q and $mysql->numrows($q)>0){
					echo "<br/>";
					echo "<table>
					<tr>
					<td>Nama Soal</td>
					<td>:</td>
					<td><b>$nama_quiz</b></td>
					</tr>
					<tr>
					<td>Nomor Soal</td>
					<td>:</td>
					<td><b>$no_soal</b></td>
					</tr>
					</table>";
					echo "<table width='300px' id='DataTables_Table_3_wrapper' style='width:auto;' class='table table-hover table-nomargin table-bordered '>";
					echo "
					<thead>
					<tr>
					<th width='40px'>"._NOMOR."</th>
					<th width='350px'>"._CLASS."</th>
					<th width='100px'>"._KODELOGIN."</th>
					<th width='300'>"._NAMALENGKAP."</th>

					";
					echo "</tr>
					</thead>";
					echo '<tbody>';
					$no=1;
					while($siswa=$mysql->assoc($q)){
					echo "
					<tr>
					<td>$no</td>
					<td>".$siswa['member_class']."</td>
					<td>".$siswa['member_code']."</td>
					<td>".$siswa['member_fullname']."</td>
					";
					$no++;
					}
					echo '</tbody>';
					echo '</table>';
				}
				else{
					echo "Tidak ada data siswa";
				}
				 
			}
	}

}



///////////////////////////////////////////////////////////////////////////
if($action=="show_calendar"){
echo '<div class="calendar"></div>';
$q=$mysql->query("SELECT id,allow_class,quiz_info,date_format(tanggal,'%Y-%m-%d-%H-%i') tanggal,date_format(tanggal_expired,'%Y-%m-%d-%H-%i') tanggal_expired FROM quiz_schedule ORDER BY tanggal");

$r_data_awal=array();
if($q and $mysql->numrows($q)>0)
{
	while($d=$mysql->assoc($q))
	{
	$id_jadwal=$d['id'];
	$schedule_info=json_decode($d['quiz_info'],true);
	list($y1,$m1,$d1,$h1,$i1)=explode("-",$d['tanggal']);
	list($y2,$m2,$d2,$h2,$i2)=explode("-",$d['tanggal_expired']);
	$r_data_awal[]="
	{
		id:$id_jadwal,
		title: '[".$schedule_info['code']."] ".$schedule_info['title_id']." (".$d['allow_class'].",".$schedule_info['duration']." Menit)',
		start: new Date('$y1/$m1/$d1 $h1:$i1'),
		end: new Date('$y2/$m2/$d2 $h2:$i2'),
		allDay: false,
		url:'".backendurl("$modul/edit/".$id_jadwal)."'
	}
	";	

	}
	 
}

	
	$data_awal=join(",",$r_data_awal);
$script_js.=<<<END
<script>
$(document).ready(function() {
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
if($(".calendar").length > 0)
{

	$('.calendar').fullCalendar('addEventSource', [
	$data_awal
	]);
}
});

</script>
END;

}
?>
