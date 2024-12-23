<?php
/*
Catatan pakai yona-validation:
Form :
	Form menggunakan class yona-validation
	Tombol submit name=submit
Var  : nama element harus sama dengan var  
 * */
$hari_ini=date("Y-m-d H:i:s");
$admin_id=$_SESSION['s_id'];

if($action=="update_kd")
{
	$id=cleanInput($_POST['id']);
	$title_id=cleanInput($_POST['title_id']);
	$nomor_soal=cleanInput($_POST['nomor_soal']);
	$score_max=cleanInput($_POST['score_max']);
	$kkm=cleanInput($_POST['kkm']);
	
	$r_nomor_soal=explode(",",$nomor_soal);
	$r_nomor_soal=array_map(hanyaAngka,$r_nomor_soal);
	
	$nomor_soal=join(",",$r_nomor_soal);
	$quiz_id=cleanInput($_POST['quiz_id']);
	if($quiz_id=="")
	{
		msg_warning("Master soal tidak ada","error");
		header("location:".backendurl("$modul"));
		exit();
	}
	
	$sql="
	UPDATE quiz_kd SET 
		title_id='$title_id',
		nomor_soal='$nomor_soal',
		score_max='$score_max',
		kkm='$kkm'
	WHERE id=$id AND quiz_id=$quiz_id
	";
	$r=$mysql->query($sql);
	if($r)
	{
		$form->release_data();
		msg_warning("Berhasil ubah kompentensi dasar","success");
		header("location:".backendurl("$modul/kd?id_soal=$quiz_id"));
		exit();
	} else {
		msg_warning("Gagal ubah kompetensi dasar","error");
		header("location:".backendurl("$modul/kd?id_soal=$quiz_id"));
		exit();
	}
}
if($action=="save_kd")
{

	$title_id=cleanInput($_POST['title_id']);
	$nomor_soal=cleanInput($_POST['nomor_soal']);
	$score_max=cleanInput($_POST['score_max']);
	$kkm=cleanInput($_POST['kkm']);
	$r_nomor_soal=explode(",",$nomor_soal);
	$r_nomor_soal=array_map("hanyaAngka",$r_nomor_soal);
	$nomor_soal=join(",",$r_nomor_soal);
	$quiz_id=cleanInput($_POST['quiz_id']);
	if($quiz_id=="")
	{
		msg_warning("Master soal tidak ada","error");
		header("location:".backendurl("$modul"));
		exit();
	}
	$uniqid=uniqid();
	$sql="INSERT INTO quiz_kd(quiz_id,title_id,nomor_soal,score_max,kkm,created_by,created_date) values ('$quiz_id','$title_id','$nomor_soal','$score_max','$kkm','".$_SESSION['s_id']."','$hari_ini')";
	$r=$mysql->query($sql);
	if($r)
	{
		$form->release_data();
		msg_warning("Berhasil tambah kompentensi dasar","success");
		header("location:".backendurl("$modul/kd?id_soal=$quiz_id"));
		exit();
	} else {
		msg_warning("Gagal tambah kompetensi dasar","error");
		header("location:".backendurl("$modul/kd?id_soal=$quiz_id"));
		exit();
	}
}
if($action=="del_kd")
{
$quiz_id=$mysql->get1value("SELECT quiz_id FROM quiz_kd WHERE id=$id");	
$sql="DELETE FROM quiz_kd WHERE id='$id'";

$r=$mysql->query($sql);
if($r)
{
	msg_warning("Berhasil hapus KD","success");
	header("location:".backendurl("$modul/kd?id_soal=$quiz_id"));
	exit();
}
else
{
	msg_warning("Gagal hapus KD","error");
	header("location:".backendurl("$modul/kd?id_soal=$quiz_id"));
	exit();
}

}

if(in_array($action,array("add","edit","update","save"))) {
//$validation->set_validation(array('var'=>'grade','label'=>'Grade'))->required();
$validation->set_validation(array('var'=>'code','label'=>'Kode Soal'))->minlength(3)->required();
$validation->set_validation(array('var'=>'title_id','label'=>'Nama Soal'))->minlength(2)->required();
$validation->set_validation(array('var'=>'duration','label'=>'Durasi'))->min(1)->required();
//$validation->set_validation(array('var'=>'pg_total','label'=>'Jumlah soal pilihan ganda'))->min(1)->required();
//$validation->set_validation(array('var'=>'essay_total','label'=>'Jumlah soal essay'))->min(1)->required();
$validation->set_validation(array('var'=>'score','label'=>'Skor (maksimal)'))->min(1)->required();
//$validation->set_validation(array('var'=>'score_essay','label'=>'Skor (maksimal)'))->min(1)->required();
//$validation->set_validation(array('var'=>'id_sylabus','label'=>'Silabus'))->min(1)->required();
$validation->set_validation(array('var'=>'kkm','label'=>'Durasi'))->min(1)->required();
$validation->set_validation(array('var'=>'is_random','label'=>'Acak Soal'))->required();
$validation->set_validation(array('var'=>'is_random_option','label'=>'Acak Pilihan Jawaban'))->required();
//$validation->set_validation(array('var'=>'created_by','label'=>'Guru MAPEL'))->required();
$validation->generate_js_validation();
}
if($action=="save" or $action=="update") {
	$valid=true;
	$id=$_POST['id'];
	$code=$_POST['code'];
	
	if($action=="save"){
		$is_duplicate=$mysql->get1value("SELECT count(id) FROM quiz_master WHERE code='$code' ");
	}
	if($action=="update") {
		$is_duplicate=$mysql->get1value("SELECT count(id) FROM quiz_master WHERE code='$code' AND id<>$id ");
	}
	
	if($is_duplicate) {
		$validation->set_validation(array('var'=>'code','label'=>'Kode Soal'))->custom_msg($is_duplicate,"Kode Soal harus unik");
	}
	
	if($validation->valid()){
		$r_post=array(
		'grade',
		'code',
		'title_id',
		'keterangan',
		'duration',
		'score',
		'score_essay',
		'pg_total',
		'essay_total',
		'kkm',
		'is_random',
		'is_random_option',
		'custom_score',
		'id_sylabus'
		);
		
		/* 'created_by  */
		
		$sql_r = array();
		
		foreach($pilihan_ganda as $pil_gan) {
			$sql_r[]="poin_$pil_gan='".$_POST["poin_$pil_gan"]."'";
		}
		
		if($action=="save") {
			
			$sql_r[]="created_by='$admin_id'";
			$sql_r[]="created_date='$hari_ini'";
		}
		
		if($action=="update") {
			$sql_r[]="modified_by='$admin_id'";
			$sql_r[]="modified_date='$hari_ini'";
		}
		
		
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$sql_r[]="$v = '$post'";
		}
		
		if($action=="save") {
			$sql=" INSERT INTO quiz_master SET ".join(" ,",$sql_r);
			$q=$mysql->query($sql);
			if(!$q) {
				$valid=false;
			}
			$last_id=$mysql->insert_id();
		}
		
		if($action=="update") {
			$sql=" UPDATE quiz_master SET ".join(" ,",$sql_r)." WHERE id=$id ";
			$q=$mysql->query($sql);
			if(!$q) {
				$valid=false;
			}
		}
			
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Master Soal gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($valid){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Master Soal berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Master Soal gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
}
if($action=="del")
{
	$valid=true;
	$mysql->autocommit(false);	
	$id=cleanInput($id,'numeric');
	$folder_guru=$mysql->get1value("SELECT username FROM user WHERE id IN(SELECT created_by FROM quiz_master WHERE id='".$id."')");	
	$folder_soal=$folder_guru."/dir_".$id;

	remove_soal_json($id);

	$sql="DELETE FROM quiz_master WHERE id='$id'";
	$r=$mysql->query($sql);
	if(!$r){$valid=false;}
	$sql="DELETE FROM quiz_detail WHERE quiz_id='$id'";
	$r=$mysql->query($sql);
	if(!$r){$valid=false;}
	$sql="DELETE FROM quiz_essay WHERE quiz_id='$id'";
	$r=$mysql->query($sql);
	if(!$r){$valid=false;$option_msg=", Soal essay sudah digunakan untuk ujian tidak bisa dihapus ";}
	
	//update log
	if($valid) 
	{
		
		if($folder_guru!="" and $id!="")
		{
			if(file_exists(DIR_IMAGES."/source/$folder_guru")){
				if(file_exists(DIR_IMAGES."/source/$folder_soal")){
					delete_files(DIR_IMAGES."/source/$folder_soal");
				}			
			}
		}

	}
	
	if($valid){
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success",$msg="Hapus soal berhasil",backendurl("$modul"));
	} else {
		$mysql->rollback();	
		sweetalert2($type="warning",$msg="Hapus soal gagal $option_msg",backendurl("$modul"));
	}
	
}

?>
