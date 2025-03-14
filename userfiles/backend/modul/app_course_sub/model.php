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
		

$validation->set_validation(array('var'=>'course_id','label'=>'Course ID'))->required();
$validation->set_validation(array('var'=>'title','label'=>'Judul'))->minlength(3)->required();
$validation->set_validation(array('var'=>'content','label'=>'Isi Sub Course'))->required();
$validation->generate_js_validation();

if($action=="save" or $action=="update") {

	$id=$_POST['id'];
	$course=$_POST['course_id'];
	
	if($validation->valid()){

		/*

		$r_allow_class=$_POST["allow_class"];
		if(count($r_allow_class)>0){
			$allow_class=join(",",$r_allow_class);
		}else{
			sweetalert2($type="warning"," Kelas harus dipilih. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
			die();
		}
		*/
		
		$_POST['allow_class']=$allow_class;

		$r_post=array(
		'title',
		'content',
		'course_id',
		'allow_class',
		'publish'
		);

		$pretest_quiz=$_POST['pretest_quiz'];
		$posttest_quiz=$_POST['posttest_quiz'];
	
		$sql_r = array();

		if ($_FILES['image']['name'] != '') {
		//upload image
		 	$temp = explode('.', $_FILES['image']['name']);
        	$extension = strtolower($temp[count($temp) - 1]);	
			$destdir=filepath("$modul");
			$filename_only=uniqid();
			$filename=$filename_only.".".$extension;
			$upload=upload('image', $destdir, $filename_only, $maxsize=30000000, $allowedtypes = "gif,jpg,jpeg,png",$quality="70");
			if(!$upload) {
				sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Gagal upload gambar. $upload ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
				die();
			} else {
				//die('aaa'.$upload);
			}
		
			$sql_r[]="image='$filename'";
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
			if($v!='content') {
				$post=cleanInput($_POST[$v]);
			} else {
				$post=$_POST[$v];
			}
			$sql_r[]="$v = '".addslashes($post)."'";
		}
		$course_sub_id='';
		if($action=="save") {
			$sql=" INSERT INTO app_course_sub SET ".join(" ,",$sql_r);
			$q=$mysql->query($sql);
			$last_id=$mysql->insert_id();
			$course_sub_id=$last_id;
		}
		
		if($action=="update") {
			$sql=" UPDATE app_course_sub SET ".join(" ,",$sql_r)." WHERE id=$id ";
			$q=$mysql->query($sql);
			$course_sub_id=$id;
		}
		
		//create prestest
		$pretest_id=$mysql->get1value("SELECT id FROM app_course_material WHERE quiz_type='pretest' AND course_sub_id=$course_sub_id");
		
		$now=date("Y-m-d H:i:s");
		if($pretest_id=='') {
			
			$pretest_insert=$mysql->query("
			INSERT INTO 
				app_course_material 
			SET 
				course_sub_id=$course_sub_id,
				type='quiz',
				quiz_id=$pretest_quiz,
				quiz_type='pretest',
				created_date='$now',
				is_free=1	 
			");
		} else {
			$pretest_insert=$mysql->query("
			UPDATE  
				app_course_material 
			SET 
				quiz_id=$pretest_quiz,
				modified_date='$now' 
			WHERE id=$pretest_id
			");
		}


		//create posttest
		$posttest_id=$mysql->get1value("SELECT id FROM app_course_material WHERE quiz_type='posttest' AND course_sub_id=$course_sub_id");
		$now=date("Y-m-d H:i:s");
		if($posttest_id=='') {
			
			$posttest_insert=$mysql->query("
			INSERT INTO 
				app_course_material 
			SET 
				course_sub_id=$course_sub_id,
				type='quiz',
				quiz_id=$posttest_quiz,
				quiz_type='posttest',
				created_date='$now',
				is_free=1	 
			");
		} else {
			$posttest_insert=$mysql->query("
			UPDATE  
				app_course_material 
			SET 
				quiz_id=$posttest_quiz,
				modified_date='$now' 
			WHERE id=$posttest_id
			");
		}
			
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Kompetensi gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add"))."?course=$course");
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Kompetensi berhasil",backendurl("$modul")."?course=$course");
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Kompetensi gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add"))."?course=$course");
	}
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

	$valid=true;
	$mysql->autocommit(false);
	
	$course_id=$mysql->get1value("SELECT course_id FROM app_course_sub WHERE id=$id");
	$sql="DELETE FROM app_course_sub WHERE id='$id'";
	$r=$mysql->query($sql);

	if($r and $valid){
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success",$msg="Hapus data berhasil",backendurl("$modul")."?course=$course_id");
	} else {
		$mysql->rollback();	
		sweetalert2($type="warning",$msg="Hapus data gagal, ada materi yang terkait!",backendurl("$modul")."?course=$course_id");
	}
	
}

