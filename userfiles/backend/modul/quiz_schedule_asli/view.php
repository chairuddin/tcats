<?php
//if($action=="")
{
$col_back="&nbsp;";	
}
//Form::clearValues("{$modul}add"); 
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
/*
if(file_exists("$small_pic/".$d['thumbnail']) and $d['thumbnail']!='')
{
$thumbimage="$small_url/".$d['thumbnail'];
$form->addElement(new Element_HTML('<div><img src="'.$thumbimage.'" /></div>'));
}
 $form->addElement(new Element_File(_THUMBNAIL, "filename"));
*/ 
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
//$form_search=form_search($keyword);
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
$sql="SELECT m.id,m.allow_class,m.tanggal,m.tanggal_expired,date_format(m.tanggal,'%d/%m/%Y') exam_date,date_format(m.tanggal,'%H:%i') exam_time,
date_format(m.tanggal_expired,'%d/%m/%Y') exam_date_expired,date_format(m.tanggal_expired,'%H:%i') exam_time_expired,
m.is_late,q.code,q.title_id,q.duration,q.is_random,q.is_random_option,q.kkm,(select count(*) from quiz_detail q WHERE q.quiz_id=m.quiz_id  ) soal, m.modified_date,m.created_date	 FROM $modul m LEFT JOIN quiz_master q ON m.quiz_id=q.id ";
$sql.=" WHERE m.is_deleted=0 ";
if( $action=="today"){
	$sql.=" AND ('$hariini' BETWEEN  date_format(m.tanggal,'%Y-%m-%d') AND date_format(m.tanggal_expired,'%Y-%m-%d')";
	$sql.=" OR  date_format(m.tanggal,'%Y-%m-%d') ='$hariini')";
}

if($action=="search"){
$sql.=" AND title_id LIKE '%$keyword%' ";
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

";
//<th>"._THUMBNAIL."</th>
echo "<th>".orderBy("tanggal",_TANGGAL,$sort_order,$sort_by)."</th>";
echo "<th>Kadaluarsa</th>";
echo "<th>Tepat waktu</th>";

echo "<th>".orderBy("title_id",_JUDUL,$sort_order,$sort_by)."</th>";
echo "<th>Kelas</th>";
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
$r_allow_class=explode(",",$d["allow_class"]);
$allow_class=join(", ",$r_allow_class);
echo "<td>".$d["exam_date"]." Pukul: ".$d["exam_time"]."</td>";
echo "<td>".$d["exam_date_expired"]." Pukul: ".$d["exam_time_expired"]."</td>";
echo "<td>".($d["is_late"]==1?"Y":"N")."</td>";
echo "<td>[".$d["code"]."]&nbsp;&nbsp;&nbsp;".$d["title_id"]." <br/>(".$d["soal"]." Soal, ".$d["duration"]." Menit,KKM ".$d["kkm"].($d["is_random"]==1?", Soal Acak":"")."".($d["is_random_option"]==1?", Pilihan Acak":"").")</td>";
echo "<td>".$allow_class."</td>";
$ar_action=array("edit"=>$d['id']);
if($_SESSION['s_level']>=1)
{
$ar_action["del"]=$d['id'];
}
//<a class='button_action' href='".backendurl("quiz_schedule/copy/".$d['id'])."'><i class='icon-copy'></i></a>
echo "<td>";
echo "<a class='button_action' href='".backendurl("quiz_dashboard/view/".$d['id'])."'><i class='icon-dashboard'></i></a>";
echo button_action($ar_action);
//echo '<a class="button_action  action-schedule-remove" title="Proses hasil ujian" data-toggle="modal" href="'.backendurl("quiz_schedule/del/".$d['id']).'"><i class="icon-flag"></i></a>';
echo "</td>";

echo "</tr>";
$no++;
}
echo "</tbody>";
}

echo "</table>
</form>";

}

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
