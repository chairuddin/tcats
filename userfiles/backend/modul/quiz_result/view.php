<?php
$col_back="&nbsp;";	

if($action=="del_confirm")
{
list($schedule_data)=$mysql->query_data("SELECT * FROM quiz_schedule WHERE id=$id ");
//var_dump($schedule_data);
$quiz_info=json_decode($schedule_data['quiz_info'],true);
$sql="SELECT id FROM quiz_done_arsip WHERE schedule_id=$id AND is_done=1 ";

$q=$mysql->query($sql);
if($q and $mysql->numrows($q)>0){
	$total_ujian=$mysql->numrows($q);
	
	$d=$mysql->assoc($q);
	if($total_ujian>0){
	echo
	'
	<div class="del_confirm">
	<div class="del_confirm_title">
	Apakah anda yakin mau menghapus arsip ujian  <b>'.$quiz_info['title_id'].'</b> dengan total  '.$total_ujian.' peserta?
	</div>
	<div class="del_confirm_button">
	<a class="btn btn-danger" href="'.backendurl("$modul/del/$id").'">Hapus</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="btn btn-inverse" href="'.backendurl("$modul").'">Batal</a>
	</div>
	</div>
	';
	}else{
	header("location:".backendurl("$modul/del/$id"));
	exit();
	}	
}else{
	header("location:".backendurl("$modul/del/$id"));
	exit();
}
}

if($action=="view" or $action=="" or $action=="search" or $action=="today")
{
Form::clearValues("update{$modul}");
Form::clearValues("{$modul}add"); 
Form::clearValues("{$modul}save_as"); 	

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
m.is_late,q.code,q.title_id,q.duration,q.is_random,q.is_random_option,q.kkm,(select count(*) from quiz_detail q WHERE q.quiz_id=m.quiz_id  ) soal, m.modified_date,m.created_date FROM quiz_schedule_arsip m LEFT JOIN quiz_master q ON m.quiz_id=q.id ";
$sql.=" WHERE m.is_deleted=1 ";
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
<th>Token</th>
";
echo "<th>".orderBy("tanggal",_TANGGAL,$sort_order,$sort_by)."</th>";
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


$class=$mysql->get1value("SELECT GROUP_CONCAT(DISTINCT(member_class)) class_gabungan FROM quiz_done_arsip WHERE schedule_id='".$d['id']."' AND is_done=1");
if($class!=""){
	$d['allow_class']=$class;
	$r_allow_class=explode(",",$d["allow_class"]);
	if(count($r_allow_class)>0){
		foreach($r_allow_class as $x =>$v){
			$r_allow_class[$x]="<a class='button_download_excel' title='Download $v dalam bentuk Excel' href='".backendurl("$modul/download_excel/?schedule_id=".$d['id'])."&class=$v'><img alt=\"Download Excel\" border=\"0\" src=\"".backendurl("images/excel_l.gif")."\">&nbsp;".$v."</a>&nbsp;&nbsp;&nbsp;";
		}
	}
	else{
		if($d['allow_class']=="ALL"){
		$class=$mysql->get1value("SELECT GROUP_CONCAT(DISTINCT(member_class)) FROM quiz_done_arsip WHERE schedule_id='".$d['id']."'");
		$d['allow_class'].=",".$class;
		}
	}
}
else{
	$r_allow_class=explode(",",$d["allow_class"]);
	foreach($r_allow_class as $x =>$v){
		$r_allow_class[$x]="<a class='button_download_excel' title='Download Excel $v'>".$v."</a>";
	}
}
//jika tidak ada sama sekali

$allow_class="<span class='class_option'>".join("</span><span class='class_option'>",$r_allow_class)."</span>";


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
$ar_action=array("del_confirm"=>$d['id']);

//if($_SESSION['s_level']>=1)
//{
//$ar_action["del"]=$d['id'];
//}
//<a class='button_action' href='".backendurl("$modul/copy/".$d['id'])."'><i class='icon-copy'></i></a>
echo "<td>";
//echo "<a class='button_action' href='".backendurl("quiz_dashboard/view/".$d['id'])."'><i class='icon-dashboard'></i></a>";
echo button_action($ar_action);
//echo '<a class="button_action  action-schedule-remove" title="Arsipkan" data-toggle="modal" href="'.backendurl("$modul/del/".$d['id']).'"><i class="icon-flag"></i></a>';
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
$q=$mysql->query("SELECT id,allow_class,quiz_info,date_format(tanggal,'%Y-%m-%d-%H-%i') tanggal,date_format(tanggal_expired,'%Y-%m-%d-%H-%i') tanggal_expired FROM quiz_schedule_arsip ORDER BY tanggal");

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
