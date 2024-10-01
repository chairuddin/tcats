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
	$mysql->autocommit(false);	
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
	${"token"}=cleanInput($_POST["token"]);
	
	
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
	$schedule_id=$mysql->insert_id();	
	if($token==""){
		$token=generate_token_jadwal($schedule_id);
	}else{
		$cari_token=$mysql->query("SELECT id FROM quiz_schedule WHERE token='$token' ");
		if($cari_token and $mysql->numrows($cari_token)>0){
			$mysql->rollBack();
			$mysql->autocommit(true);
			msg_warning("Token sudah digunakan!","error");
			header("location:".backendurl("$modul/add"));
			exit();
		}
	}
	$update_token=$mysql->query("UPDATE quiz_schedule SET token='$token' WHERE id=$schedule_id");
	if(!$update_token){
		$mysql->rollBack();
		$mysql->autocommit(true);
			
		msg_warning(_GAGALADD,"error");
		header("location:".backendurl("$modul/add"));
		exit();
	}else{
		$mysql->commit();
		$mysql->autocommit(true);
		generate_soal_json($quiz_id);	
		msg_warning(_BERHASILTAMBAH,"success");
		Form::clearValues("{$modul}add"); 
		header("location:".backendurl("$modul/view"));
		exit();
	}
	
	}
	
	}
	else
	{
	$mysql->rollBack();
	$mysql->autocommit(true);
				
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
$is_arsip=$_GET['arsip'];	
$valid=true;
$mysql->autocommit(false);	
$field="	
token, uniqid, member_id, member_code, 
member_class, member_fullname, start_time,start_time_real,
end_time, check_point, answer, answer_temp,
schedule_id, quiz_id, quiz_duration, quiz_title_id,
quiz_code, benar, salah, tidak_jawab,
score_master, kkm, score, is_done,
ip_address, browser_key, acak, acak_pilihan";

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
if($r and $ada_peserta and $is_arsip){
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

if($action=="download_excel")
{

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
date_default_timezone_set('Asia/Jakarta');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("websuka.com")
							 ->setLastModifiedBy("websuka.com")
							 ->setTitle("Ujian Online Berbasis Komputer")
							 ->setSubject("Ujian Online Berbasis Komputer")
							 ->setDescription("Ujian Online Berbasis Komputer")
							 ->setKeywords("Ujian Online Berbasis Komputer")
							 ->setCategory("Ujian Online Berbasis KOmputer");



//AMBIL KUNCI JAWABAN

	$quiz_id=$mysql->get1value("SELECT quiz_id FROM quiz_done WHERE schedule_id='".cleanInput($_GET['schedule_id'])."'");
	$kunci=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
$join_kunci=join("",$kunci);	
//AMBIL KUNCI JAWABAN
/////////////////////////////////////////

$id=cleanInput($id);	
$sql="SELECT * FROM quiz_done  WHERE is_done=1 AND schedule_id='".$_GET['schedule_id']."'";
if($_GET['class']!="" AND $_GET['class']!="ALL"){
	$sql.=" AND member_class='".$_GET['class']."'";
}
$sql.="  order by member_code";

$r=$mysql->query($sql);

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',_UJIANMULAI)
            ->setCellValue('B1',_KODELOGIN)
            ->setCellValue('C1',_NAMALENGKAP)
            ->setCellValue('D1',_CLASS)
            ->setCellValue('E1',_KODESOAL)
            ->setCellValue('F1',_NAMASOAL)
            ->setCellValue('G1',_B)
            ->setCellValue('H1',_S)
            ->setCellValue('I1',_TIDAK_JAWAB)
            ->setCellValue('J1',_SCORE)
            ->setCellValue('K1',_KKM)
            ->setCellValue('L1',_KET);

$no=1;
$quiz_date=$quiz_code=$quiz_title="";
while($d=$mysql->assoc($r))
{
	$no++;
	$answer=str_replace("{","=",$d['answer']);
	$answer=str_replace("}","=",$answer);
	$temp_answer=json_decode($d['answer'],true);
		$r_answer=array();
		
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $idsoal){
				$index+=1;
				
				//BANDINGKAN JAWABAN
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					//BENAR
					$r_answer[]="".$temp_answer[$index]."";
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					//SALAH
					$r_answer[]="".$temp_answer[$index]."";
				}else{
					//TAK JAWAB
					$r_answer[]="".$temp_answer[$index]."";
				}
				//END BANDINGKAN JAWABAN
			}
			
		}

$json_answer=join("",$r_answer);	
	$ket=($d['score']>=$d['kkm']?_LULUS:_TIDAKLULUS);
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$no,$d['start_time'])
            ->setCellValue('B'.$no,$d['member_code'])
            ->setCellValue('C'.$no,$d['member_fullname'])
            ->setCellValue('D'.$no,$d['member_class'])
            ->setCellValue('E'.$no,$d['quiz_code'])
            ->setCellValue('F'.$no,$d['quiz_title_id'])
            ->setCellValue('G'.$no,$d['benar'])
            ->setCellValue('H'.$no,$d['salah'])
            ->setCellValue('I'.$no,$d['tidak_jawab'])
            ->setCellValue('J'.$no,$d['score'])
            ->setCellValue('K'.$no,$d['kkm'])
            ->setCellValue('L'.$no,$ket);
}

$q_schedule=$mysql->query("SELECT * FROM quiz_schedule WHERE id=".cleanInput($_GET['schedule_id']));
	if($q_schedule and $mysql->numrows($q_schedule)>0){
		while($d=$mysql->assoc($q_schedule)){
			$quiz_id=$d['id'];
			$quiz_info=json_decode($d['quiz_info'],true);
			$quiz_date=date("Ymd",strtotime($d['tanggal']));
			$quiz_code=$quiz_info['quiz_id'];
			$quiz_title=$quiz_info['title_id'];
		}
	}

$filename=$_GET['class']."_{$quiz_date}_{$quiz_code}_{$quiz_title}";
$filename=cleanInput($filename,"field_name");
$sheet_title="Nilai";
$sheet_title=cleanInput($sheet_title,"field_name");

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($sheet_title);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//

////////////////////////////////////////JAWABAN SISWA
$sheet = $objPHPExcel->getActiveSheet();
// Add new sheet
$objWorkSheet = $objPHPExcel->createSheet(1); //Setting index when creating
$objPHPExcel->setActiveSheetIndex(1);

//AMBIL KUNCI JAWABAN

	$quiz_id=$mysql->get1value("SELECT quiz_id FROM quiz_done WHERE schedule_id='".cleanInput($_GET['schedule_id'])."'");
	$kunci=array();
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=".$quiz_id);
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
	
$join_kunci=join("",$kunci);	

//AMBIL KUNCI JAWABAN

$rschedule=$mysql->query_data("SELECT quiz_info,date_format(tanggal,'%Y-%m-%d %H:%i') tanggal,date_format(tanggal_expired,'%Y-%m-%d %H:%i') tanggal_expired FROM quiz_schedule WHERE id='".cleanInput($_GET['schedule_id'])."' ");

$dschedule=json_decode($rschedule[0]['quiz_info'],true);

$dschedule['tanggal']=$rschedule[0]['tanggal'];
$dschedule['tanggal_expired']=$rschedule[0]['tanggal_expired'];
$sql="SELECT * FROM quiz_done  WHERE is_done=1 AND schedule_id='".cleanInput($_GET['schedule_id'])."'";
if($_GET['class']!=""){
$sql.=" AND member_class='".$_GET['class']."'";
}
$sql.="  order by member_code ";

$r=$mysql->query($sql);

$objWorkSheet->setCellValue('A1', 'No')
		   ->setCellValue('B1', _KODELOGIN)
		   ->setCellValue('C1', _NAMALENGKAP)
		   ->setCellValue('D1', _SCORE)
		   ->setCellValue('E1',"");


$panjang=count($kunci);

$kolom=kolom_excel($panjang,"F");
$nomor=1;
foreach($kolom as $a =>$k){
	$objWorkSheet->setCellValue($k.'1', $nomor);
	$objPHPExcel->getActiveSheet()->getStyle($k.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$nomor++;
}

$objWorkSheet->setCellValue('A2', '')
		   ->setCellValue('B2', '')
		   ->setCellValue('C2', '')
		   ->setCellValue('D2', '')
		   ->setCellValue('E2', '');

$i=0;		   
foreach($kunci as $a =>$k){
	$objWorkSheet->setCellValue($kolom[$i].'2', $k);
	$objPHPExcel->getActiveSheet()->getStyle($kolom[$i].'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$i++;
	
}

/*
foreach($kolom as $a =>$k){
	$objWorkSheet->setCellValue($k.'2', $kunci[$a]);
}
*/ 
 

$no=1;
$baris_excel=3;
$tandai_warna=array();
while($d=$mysql->assoc($r))
{
	
		$temp_answer=json_decode($d['answer'],true);
		$r_answer=array();
		$c_answer=array();
		if(count($kunci)>0){	
			$index=0;
			foreach($kunci as $idsoal => $kunci_abjad){
				$index+=1;
				
				//BANDINGKAN JAWABAN
				if($temp_answer[$index]!="" and $temp_answer[$index]==$kunci[$idsoal]){
					$c_answer[$index]="benar";
				
				}elseif($temp_answer[$index]!="" and $temp_answer[$index]!=$kunci[$idsoal]){
					$c_answer[$index]="salah";
				
				}else{
					$c_answer[$index]="salah";
				
				}
				$r_answer[$index]=$temp_answer[$index];
				//END BANDINGKAN JAWABAN
			}
			
			$objWorkSheet->setCellValue('A'.$baris_excel, $no)
		   ->setCellValue('B'.$baris_excel, $d['member_code'])
		   ->setCellValue('C'.$baris_excel, $d['member_fullname'])
		   ->setCellValue('D'.$baris_excel, $d['score'])
		   ->setCellValue('E'.$baris_excel, '');
		   
			$no++;

			$nomor=1;
			
			
			foreach($kolom as $a =>$k){
			//var_dump($k);	
				$objWorkSheet->setCellValue($k.$baris_excel, $r_answer[$a+1]);
				if($c_answer[$a+1]=="salah"){
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"FF0000");
				}else{
					//var_dump($c_answer[$a+1]);
					$tandai_warna[]=array("0"=>"{$k}$baris_excel","1"=>"00FF00");
				}
				$nomor++;
			}
			
			$baris_excel++;		
		}
}		


// Rename sheet
foreach($tandai_warna as $i =>$v){	
	//die($v[0]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF'.$v[1]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

$objWorkSheet->setTitle("Jawaban");

////////////////////////////////////////END JAWABAN SISWA


////////////////////////////////////////ANALISA
$sheet = $objPHPExcel->getActiveSheet();
// Add new sheet
$objWorkSheet = $objPHPExcel->createSheet(2); //Setting index when creating
$objPHPExcel->setActiveSheetIndex(2);


$schedule_id=cleanInput($_GET['schedule_id']);	
$member_salah=array();	
$data_member=array();
$final_salah=array();
$final_tidak_jawab=array();
$final_benar=array();
$kunci=array();

list($dschedule)=$mysql->query_data("SELECT * FROM quiz_schedule WHERE id=$schedule_id");

//AMBIL KUNCI JAWABAN	
	$qkey=$mysql->query("SELECT id,answer FROM quiz_detail WHERE quiz_id=$quiz_id");
	if($qkey and $mysql->numrows($qkey)>0){
		while($d=$mysql->assoc($qkey)){
			$kunci[$d['id']]=$d['answer'];
		}
	}
//END AMBIL KUNCI JAWABAN

$sql="SELECT * FROM quiz_done  WHERE is_done=1 AND schedule_id='".$schedule_id."' AND member_class='".cleanInput($_GET['class'])."' ORDER BY score DESC";

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
					$score_individu[$d['member_id']]+=0;
				}else{
					//TAK JAWAB
					$final_salah[$index]+=1;
					$final_tidak_jawab[$index]+=1;
					$member_salah[$index][]=$d['member_id'];
					$score_individu[$d['member_id']]+=0;
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


$objWorkSheet->setCellValue('A1', 'Item')
		   ->setCellValue('B1', 'A')
		   ->setCellValue('C1', 'B')
		   ->setCellValue('D1', 'C')
		   ->setCellValue('E1', 'D')
		   ->setCellValue('F1', 'E')
		   ->setCellValue('G1', '?')
		   ->setCellValue('H1', 'Daya Pembeda')
		   ->setCellValue('I1', 'Tingkat Kesulitan')
		   ->setCellValue('J1', 'Efektifitas Option')
		   ->setCellValue('K1', 'Status Soal');

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
$kunci_warna=array();

foreach($final_salah as $i => $v)
{
$r_mean=array();
$mean=0;
if(count($peta_biner[$i])>0){
	$jml_biner=count($peta_biner[$i]);
	foreach($peta_biner[$i] as $x => $member_id){
		$r_mean[]=$score_individu[$member_id];
	}
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

$jawab_prope[$i]["A"]=round($jawab[$i]["A"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["B"]=round($jawab[$i]["B"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["C"]=round($jawab[$i]["C"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["D"]=round($jawab[$i]["D"]/$jumlah_member_terpilih,2)*100;	
$jawab_prope[$i]["E"]=round($jawab[$i]["E"]/$jumlah_member_terpilih,2)*100;
$out=(($jumlah_member_terpilih-($jawab[$i]["A"]+$jawab[$i]["B"]+$jawab[$i]["C"]+$jawab[$i]["D"]+$jawab[$i]["E"]))/$jumlah_member_terpilih)*100;	

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


$objWorkSheet->setCellValue('A'.($i+1),"Pertanyaan $i")
		   ->setCellValue('B'.($i+1), $jawab_prope[$i]["A"]."%")
		   ->setCellValue('C'.($i+1), $jawab_prope[$i]["B"]."%")
		   ->setCellValue('D'.($i+1), $jawab_prope[$i]["C"]."%")
		   ->setCellValue('E'.($i+1), $jawab_prope[$i]["D"]."%")
		   ->setCellValue('F'.($i+1), $jawab_prope[$i]["E"]."%")
		   ->setCellValue('G'.($i+1), $jawab_prope[$i]["out"]."%")
		   ->setCellValue('H'.($i+1), $daya_pembeda)
		   ->setCellValue('I'.($i+1), $tingkat_kesulitan)
		   ->setCellValue('J'.($i+1), $efektifitas_option)
		   ->setCellValue('K'.($i+1), $status_soal);
		   
	if($kunci_nomor[$i]=="A"){$kunci_warna[]=array("0"=>"B".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="B"){$kunci_warna[]=array("0"=>"C".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="C"){$kunci_warna[]=array("0"=>"D".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="D"){$kunci_warna[]=array("0"=>"E".($i+1),1=>"FF00FF00");}	   
	if($kunci_nomor[$i]=="E"){$kunci_warna[]=array("0"=>"F".($i+1),1=>"FF00FF00");}	   
}
$reabilitas=round($jumlah_soal/($jumlah_soal-1)*(1-(array_sum($p_x_q)/pow($std_benar,2))),3);
foreach($kunci_warna as $i =>$v){	
	
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($v[1]);
	$objPHPExcel->getActiveSheet()->getStyle($v[0])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

// Rename sheet
$objWorkSheet->setTitle("Analisa");
////////////////////////////////////////END ANALISA

for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}

$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

$objPHPExcel->setActiveSheetIndex(1);
for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);


$objPHPExcel->setActiveSheetIndex(0);
for ($i = 'A'; $i <=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

}
?>
