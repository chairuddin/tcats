<?php
if($id=="quiz_info")
{
	$quiz_id=cleanInput($_POST['quiz_id']);
	
	$quiz_data=$mysql->query_data("SELECT * FROM quiz_master WHERE id='$quiz_id' ");
	list($quiz_data)=$quiz_data;
	echo "
	<table>
	<tr><td>Kode</td><td>:</td><td>".$quiz_data['code']."</td></tr>
	<tr><td>Soal</td><td>:</td><td>".$quiz_data['title_id']."</td></tr>
	<tr><td>Durasi</td><td>:</td><td>".$quiz_data['duration']."</td></tr>
	<tr><td>KKM</td><td>:</td><td>".$quiz_data['kkm']."</td></tr>
	<tr><td>Acak Soal</td><td>:</td><td>".($quiz_data['is_random']==1?"Ya":"Tidak")."</td></tr>
	<tr><td>Acak Pilihan</td><td>:</td><td>".($quiz_data['is_random_option']==1?"Ya":"Tidak")."</td></tr>
	</table>
	";
	

}
if($id=="set_kadaluarsa")
{
	$quiz_id=$_POST["quiz_id"];
	$exam_date=cleanInput($_POST["exam_date"]);
	$exam_time=cleanInput($_POST["exam_time"]);
	
	list($xd,$xm,$xy)=explode("/",$exam_date);
	$tanggal="$xy-$xm-$xd $exam_time:00";
	
	$quiz_duration=$mysql->get1value("SELECT duration FROM quiz_master WHERE id='$quiz_id'");
	$quiz_duration= ($quiz_duration*60);
	
	$tanggal_expired=strtotime($tanggal)+$quiz_duration;
	$tanggal_expired=date("Y-m-d H:i:s",$tanggal_expired);
	$jam_expired=date("H:i",strtotime($tanggal_expired));
	echo $jam_expired;

}
exit();
?>
