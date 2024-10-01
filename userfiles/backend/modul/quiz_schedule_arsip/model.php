<?php
$hariini=date("Y-m-d");
$hariini_long=date("Y-m-d H:i:s");
if($action=="download"){
	include ("mysql_backup.php");
	
	$backup_obj = new MySQL_Backup();
	$backup_obj->server = $host[$_SERVER['HTTP_HOST']]['db_host'];
	$backup_obj->username = $host[$_SERVER['HTTP_HOST']]['db_user'];
	$backup_obj->password = $host[$_SERVER['HTTP_HOST']]['db_pass'];
	$backup_obj->database = $host[$_SERVER['HTTP_HOST']]['db_name'];
	
	if (!$backup_obj->_Connect())
	{
	$sukses=false;
	$msg_status=alert(_ERROR,'Gagal konek');
	}
	mysqli_autocommit($backup_obj->link_id,false);
	
	$r_id=$_POST['id_schedule'];
	if(count($r_id)>0){
		$id_selected=join(",",$r_id);
	}else{
		msg_warning("Pilih jadwal yang ingin di download","error");
		header("location:".backendurl("$modul/view"));
		exit();
	}
	$backup_obj->queries['quiz_schedule']="select * from quiz_schedule WHERE id in ($id_selected)";
	$backup_obj->comments = false;
		
		//Directory on the server where the backup file will be placed. Used only if task parameter equals MSB_SAVE.
		$backup_obj->backup_dir = $config['userdir'].'backend/modul/quiz_schedule/backup';
			
		//Default file name format.
		$backup_obj->fname_format = 'd_m_Y';
	//--------------------- END - OPTIONAL PREFERENCE VARIABLES ---------------------

		//Use GZip compression 
		$backup_obj->use_gzip = true;
		$backup_obj->stand_in_view = false;
		
	//--------------------- END - REQUIRED EXECUTE VARIABLES ----------------------

	  $filename="JADWAL_UJIAN_QUIZROOM_".date("Ymd-His");
	  $backup_obj->nama_simpan =$filename;
	  $backup_obj->Execute($filename);
	  $backup_obj->Download();
	


}
if($action=="upload"){

		$fname=$_FILES['filename']['tmp_name'];
		$oname=$_FILES['filename']['name'];
		
		include_once ("mysql_backup.php");
		//----------------------- EDIT - REQUIRED SETUP VARIABLES -----------------------
		$backup_obj = new MySQL_Backup();
		$backup_obj->server = $host[$_SERVER['HTTP_HOST']]['db_host'];
		$backup_obj->username = $host[$_SERVER['HTTP_HOST']]['db_user'];
		$backup_obj->password = $host[$_SERVER['HTTP_HOST']]['db_pass'];
		$backup_obj->database = $host[$_SERVER['HTTP_HOST']]['db_name'];
		//------------------------ END - REQUIRED SETUP VARIABLES -----------------------

		$backup_obj->Restore($fname);
		$sukses=$backup_obj->status_commit;
		
		if($sukses)
		{	
			unlink($fname);
			msg_warning("Jadwal berhasil diupload","success");
			header("location:".backendurl("$modul/view"));
			exit();
		}
		else
		{
			msg_warning($backup_obj->message,"error");
			header("location:".backendurl("$modul/view"));
			exit();
		}		
}
if($action=="save_as")
{
	if(Form::isValid("{$modul}save_as",false) and $_POST['form']=="{$modul}save_as") 
	{
	$id=cleanInput($_POST['id'],'numeric');
	$modifiedfilename="";	
//	$uniqid=uniqid();	
	$r_allow_class=$_POST["allow_class"];
	if(count($r_allow_class)>0){
		$allow_class=join(",",$r_allow_class);
	}
	${"quiz_id"}=cleanInput($_POST["quiz_id"]);
	${"exam_date"}=cleanInput($_POST["exam_date"]);
	${"exam_time"}=cleanInput($_POST["exam_time"]);
	${"is_late"}=cleanInput($_POST["is_late"]);${"is_late"}=${"is_late"}==""?0:${"is_late"};
	list($xd,$xm,$xy)=explode("/",$exam_date);
	$tanggal="$xy-$xm-$xd $exam_time";
	
	if($is_late){
	$quiz_duration=$mysql->get1value("SELECT duration FROM quiz_master WHERE id='$quiz_id'");
	$quiz_duration= ($quiz_duration*60);
	$tanggal_expired=strtotime($tanggal)+$quiz_duration;
	$tanggal_expired=date("Y-m-d H:i:s",$tanggal_expired);
	}else
	{
	${"exam_date_expired"}=cleanInput($_POST["exam_date_expired"]);
	${"exam_time_expired"}=cleanInput($_POST["exam_time_expired"]);
	list($xd,$xm,$xy)=explode("/",$exam_date_expired);
	$tanggal_expired="$xy-$xm-$xd $exam_time_expired";
	}
	
	/*VALIDASI*/
	$r=$mysql->query("SELECT id FROM quiz_schedule WHERE quiz_id='$quiz_id' AND allow_class='$allow_class'  AND 
	(tanggal<='$tanggal_expired'  AND tanggal_expired>='$tanggal') and is_deleted<>1
	");
	if($r and $mysql->numrows($r)>0)
	{
	/*	
	Form::setError("{$modul}save_as","Jadwal uji untuk soal terpilih  sudah ada");
	header("location:".backendurl("$modul/copy/$id"));
	exit();
	*/
	msg_warning("Jadwal uji untuk soal terpilih  sudah ada","error");
	header("location:".backendurl("$modul/copy/$id"));
	exit();
	 
	}
	/*END VALIDASI*/
	$qi=$mysql->query("SELECT code,title_id,duration,is_random,is_random_option,kkm FROM quiz_master WHERE id='$quiz_id'");
	$qi_d=$mysql->assoc($qi);	
	$quiz_info=json_encode($qi_d);	
	$created_by=$_SESSION['s_id'];
	$created_date=date("Y-m-d H:i:s");
	
		
	$sql="INSERT INTO $modul (";
	$sql.="id";
	$sql.=",tanggal";
	$sql.=",tanggal_expired";
	$sql.=",quiz_id";
	$sql.=",quiz_info";
	$sql.=",is_late";
	$sql.=",created_by";
	$sql.=",created_date";
	$sql.=",allow_class";
//	$sql.=",uniq_id";
	$sql.=")";
	
	$sql.=" values (";
	$sql.="null";
	
	$sql.=",'$tanggal'";	
	$sql.=",'$tanggal_expired'";	
	$sql.=",'$quiz_id'";	
	$sql.=",'$quiz_info'";	
	$sql.=",'$is_late'";	
	$sql.=",'$created_by'";	
	$sql.=",'$created_date'";	
	$sql.=",'$allow_class'";	
//	$sql.=",'$uniqid'";	
	
	$sql.=")";


	$r=$mysql->query($sql);
	
	if($r)
	{
	msg_warning(_BERHASILTAMBAH,"success");
	Form::clearValues("{$modul}save_as"); 
	header("location:".backendurl("$modul/view"));
	exit();
	}
	
	}
	else
	{
	Form::clearValues("{$modul}save_as"); 	
	msg_warning(_GAGALADD,"error");
	header("location:".backendurl("$modul/copy/$id"));
	exit();
	}
	
}
if($action=="save")
{
	if(Form::isValid("{$modul}add",false) and $_POST['form']=="{$modul}add") 
	{
	${"is_late"}=cleanInput($_POST["is_late"]);${"is_late"}=${"is_late"}==""?0:${"is_late"};	
	$r_allow_class=$_POST["allow_class"];
	if(count($r_allow_class)>0){
		$allow_class=join(",",$r_allow_class);
	}else{
		msg_warning("Kelas harus dipilih!","error");
		header("location:".backendurl("$modul/add"));
		exit();
	}
	
	${"quiz_id"}=cleanInput($_POST["quiz_id"]);
	${"exam_date"}=cleanInput($_POST["exam_date"]);
	${"exam_time"}=cleanInput($_POST["exam_time"]);
	
	
	list($xd,$xm,$xy)=explode("/",$exam_date);
	$tanggal="$xy-$xm-$xd $exam_time";
	
	if ($is_late) { 
		$quiz_duration=$mysql->get1value("SELECT duration FROM quiz_master WHERE id='$quiz_id'");
		$quiz_duration= ($quiz_duration*60);
		$tanggal_expired=strtotime($tanggal)+$quiz_duration;
		$tanggal_expired=date("Y-m-d H:i:s",$tanggal_expired);
	} else {
		${"exam_date_expired"}=cleanInput($_POST["exam_date_expired"]);
		${"exam_time_expired"}=cleanInput($_POST["exam_time_expired"]);
		list($xd,$xm,$xy)=explode("/",$exam_date_expired);
		$tanggal_expired="$xy-$xm-$xd $exam_time_expired";
	}
	
	/*VALIDASI*/
	$ketemu=false;
	foreach($r_allow_class as $i =>$v){
		$r=$mysql->query("SELECT id FROM quiz_schedule WHERE quiz_id='$quiz_id' AND (FIND_IN_SET('$v',allow_class) or allow_class='ALL')  AND 
		(tanggal<='$tanggal_expired'  AND tanggal_expired>='$tanggal') and is_deleted<>1");	
		if($r and $mysql->numrows($r)>0)
		{	
			$ketemu=true;
		}
	}
	if($ketemu){
		msg_warning("Jadwal uji untuk soal terpilih  sudah ada","error");
		header("location:".backendurl("$modul/add"));
		exit();
	}if($tanggal == $tanggal_expired ){
		msg_warning("Tanggal ujian dan kadaluarsa tidak boleh sama","error");
		header("location:".backendurl("$modul/add"));
		exit();
	}
		 
	/*END VALIDASI*/
	$qi=$mysql->query("SELECT code,title_id,duration,is_random,is_random_option,kkm FROM quiz_master WHERE id='$quiz_id'");
	$qi_d=$mysql->assoc($qi);	
	$quiz_info=json_encode($qi_d);
	
	$created_by=$_SESSION['s_id'];
	$created_date=date("Y-m-d H:i:s");
	
		
	$sql="INSERT INTO $modul (";
	$sql.="id";
	$sql.=",tanggal";
	$sql.=",tanggal_expired";
	$sql.=",quiz_id";
	$sql.=",quiz_info";
	$sql.=",is_late";
	$sql.=",created_by";
	$sql.=",created_date";
	$sql.=",allow_class";
	$sql.=")";
	
	$sql.=" values (";
	$sql.="null";
	
	$sql.=",'$tanggal'";	
	$sql.=",'$tanggal_expired'";	
	$sql.=",'$quiz_id'";	
	$sql.=",'$quiz_info'";	
	$sql.=",'$is_late'";	
	$sql.=",'$created_by'";	
	$sql.=",'$created_date'";	
	$sql.=",'$allow_class'";	
	
	$sql.=")";
	
	$r=$mysql->query($sql);
	if($r)
	{
	generate_soal_json($quiz_id);	
	msg_warning(_BERHASILTAMBAH,"success");
	Form::clearValues("{$modul}add"); 
	header("location:".backendurl("$modul/view"));
	exit();
	}
	
	}
	else
	{
	msg_warning(_GAGALADD,"error");
	header("location:".backendurl("$modul/add"));
	exit();
	}
	
}

if($action=="update")
{
	$id=cleanInput($_POST['id'],'numeric');
	$r_allow_class=$_POST["allow_class"];
	if(count($r_allow_class)>0){
		$allow_class=join(",",$r_allow_class);
	}else{
	msg_warning("Kelas harus dipilih!","error");
	header("location:".backendurl("$modul/edit/$id"));
	exit();
	}
	${"quiz_id"}=cleanInput($_POST["quiz_id"]);
	${"exam_date"}=cleanInput($_POST["exam_date"]);
	${"exam_time"}=cleanInput($_POST["exam_time"]);
	${"is_late"}=cleanInput($_POST["is_late"]);${"is_late"}=${"is_late"}==""?0:${"is_late"};
	list($xd,$xm,$xy)=explode("/",$exam_date);
	$tanggal="$xy-$xm-$xd $exam_time";
	
	if($is_late){
		$quiz_duration=$mysql->get1value("SELECT duration FROM quiz_master WHERE id='$quiz_id'");
		$quiz_duration= ($quiz_duration*60);
		$tanggal_expired=strtotime($tanggal)+$quiz_duration;
		$tanggal_expired=date("Y-m-d H:i:s",$tanggal_expired);
	} else {

		${"exam_date_expired"}=cleanInput($_POST["exam_date_expired"]);
		${"exam_time_expired"}=cleanInput($_POST["exam_time_expired"]);
		list($xd,$xm,$xy)=explode("/",$exam_date_expired);
		$tanggal_expired="$xy-$xm-$xd $exam_time_expired";

	}
	if($tanggal == $tanggal_expired ){
		msg_warning("Tanggal ujian dan kadaluarsa tidak boleh sama","error");
		header("location:".backendurl("$modul/add"));
		exit();
	}
	
	/*VALIDASI*/
	$r=$mysql->query("SELECT id FROM quiz_schedule WHERE id<>$id AND quiz_id='$quiz_id' AND allow_class='$allow_class'  AND 
	(tanggal<='$tanggal_expired'  AND tanggal_expired>='$tanggal') and is_deleted<>1");
	if($r and $mysql->numrows($r)>0)
	{
	msg_warning("Jadwal uji untuk soal terpilih  sudah ada","error");
	header("location:".backendurl("$modul/edit/$id"));
	exit();
	
	/*	
	Form::setError("update{$modul}","Jadwal uji untuk soal terpilih  sudah ada");
	header("location:".backendurl("$modul/edit/$id"));
	exit();
	*/ 
	}
	/*END VALIDASI*/

	$qi=$mysql->query("SELECT code,title_id,duration,is_random,is_random_option,kkm FROM quiz_master WHERE id='$quiz_id'");
	$qi_d=$mysql->assoc($qi);	
	$quiz_info=json_encode($qi_d);
	
	$modified_by=$_SESSION['s_id'];
	$modified_date=date("Y-m-d H:i:s");
	
	/*	
	$sql="INSERT INTO $modul (";
	$sql.="id";
	$sql.=",tanggal";
	$sql.=",quiz_id";
	$sql.=",is_late";
	$sql.=",created_by";
	$sql.=",created_date";
	$sql.=")";
	*/
	
	
	if(!Form::isValid("update{$modul}",false) or $_POST['form']!="update{$modul}") 
	{
		redirecto(_GAGALUPDATE,"error","edit/$id");
	}
	$modifiedfilename="";
	
	$sql_r=array();
	$sql="
	UPDATE $modul SET ";
	$sql_r[]="quiz_id='".${"quiz_id"}."'";	
	$sql_r[]="quiz_info='".${"quiz_info"}."'";	
	$sql_r[]="tanggal='".${"tanggal"}."'";	
	$sql_r[]="tanggal_expired='".${"tanggal_expired"}."'";	
	$sql_r[]="is_late='".${"is_late"}."'";	
	$sql_r[]="modified_by='".${"modified_by"}."'";	
	$sql_r[]="modified_date='".${"modified_date"}."'";	
	$sql_r[]="allow_class='".${"allow_class"}."'";	
	
	$sql.=join(",",$sql_r);
	$sql.="	WHERE id=$id";
	$r=$mysql->query($sql);
	if($r)
	{
	generate_soal_json($quiz_id);		
	Form::clearValues("update{$modul}"); 
	msg_warning(_BERHASILUPDATE,"success");
	header("location:".backendurl("$modul/view"));
	exit();
	}
	else
	{
	msg_warning(_GAGALUPDATE,"error");
	header("location:".backendurl("$modul/edit/$id"));
	exit();
	}
	
}
if($action=="del")
{
$valid=true;
$mysql->autocommit(false);	
$field="	
token,
uniqid,
member_id,
member_code,
member_class,
member_fullname,
start_time,
start_time_real,
end_time,
check_point,
answer,
answer_temp,
schedule_id,
quiz_id,
quiz_duration,
quiz_title_id,
quiz_code,
benar,
salah,
tidak_jawab,
score_master,
kkm,
score,
is_done,
ip_address,
browser_key,
acak,
acak_pilihan";

$id=cleanInput($id,'numeric');
$sql="SELECT id FROM quiz_done WHERE schedule_id='$id'";
$q=$mysql->query($sql);
$ada_peserta=false;
if($q and $mysql->numrows($q)>0){
$ada_peserta=true;
$sql="UPDATE $modul set is_deleted=1 WHERE id='$id' ";
}else{
$sql="DELETE FROM $modul WHERE id='$id'";
}
$r=$mysql->query($sql);
if($r and $ada_peserta){
	/*Pindahkan jawaban ke arsip*/	
	$sql="INSERT INTO quiz_done_arsip($field) SELECT $field FROM quiz_done WHERE schedule_id='$id' ";
	$q=$mysql->query($sql);
	if(!$q){
		$valid=false;
	}else{
		$sql="DELETE FROM quiz_done WHERE schedule_id='$id'";
		$q=$mysql->query($sql);
		if(!$q){
		$valid=false;
		}	
	}
	/*END Pindahkan jawaban ke arsip*/	

	/*Pindahkan jadwal ke arsip*/	
	$sql="INSERT INTO quiz_schedule_arsip SELECT * FROM quiz_schedule WHERE id='$id' ";
	$q=$mysql->query($sql);
	if(!$q){
	$valid=false;
	}else{
	$sql="DELETE FROM quiz_schedule WHERE id='$id'";
		$q=$mysql->query($sql);
		if(!$q){
		$valid=false;
		}		
	}
}
if($valid)
{
	$mysql->commit();
	Form::clearValues("update{$modul}");
	msg_warning(_BERHASILHAPUS,"success");
	header("location:".backendurl("$modul/view"));
	exit();
}
else
{
	$mysql->rollback();
	msg_warning(_GAGALHAPUS,"error");
	header("location:".backendurl("$modul/view"));
	exit();
}
}
if($action=="sortitem")
{
$list=$_POST['list'];
for($i=1;$i<=count($list);$i++)
{
$idlist=cleanInput($list[$i-1],'numeric');

$q=$mysql->query("UPDATE $modul set urutan=$i WHERE id='$idlist'");

}
exit();
}
?>
