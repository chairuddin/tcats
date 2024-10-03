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
		

//$validation->set_validation(array('var'=>'category_id','label'=>'Category'))->required();
$validation->set_validation(array('var'=>'title','label'=>'Judul'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'content','label'=>'Isi Course'))->required();
$validation->generate_js_validation();

if($action=="save" or $action=="update") {

	$id=$_POST['id'];
	
	if($validation->valid()){
		$r_post=array(
		'title',
		'category_id'
		);
		
		$sql_r = array();
		
		if($action=="save") {
			$sql_r[]="created_by='$admin_id'";
			$sql_r[]="created_date='$hari_ini'";
		}
		
		if($action=="update") {
			$sql_r[]="modified_by='$admin_id'";
			$sql_r[]="modified_date='$hari_ini'";
		}
		
		if ($_FILES['thumbnail']['name'] != '') {
			//upload image
				 $temp = explode('.', $_FILES['thumbnail']['name']);
				$extension = strtolower($temp[count($temp) - 1]);	
				$destdir=filepath("$modul");
				$filename_only=uniqid();
				$filename=$filename_only.".".$extension;
				$upload=upload('thumbnail', $destdir, $filename_only, $maxsize=30000000, $allowedtypes = "gif,jpg,jpeg,png",$quality="70");
				if(!$upload) {
					sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Gagal upload gambar. $upload ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
					die();
				} else {
					//die('aaa'.$upload);
				}
			
				$sql_r[]="thumbnail='$filename'";
		}

		
		foreach($r_post as $i => $v) {
			if($v!='content') {
				$post=cleanInput($_POST[$v]);
			} else {
				$post=$_POST[$v];
			}
			$sql_r[]="$v = '".addslashes($post)."'";
		}
		
		if($action=="save") {
			$sql=" INSERT INTO app_course SET ".join(" ,",$sql_r);
			$q=$mysql->query($sql);
			$last_id=$mysql->insert_id();
			$id=$last_id;
		}
		
		if($action=="update") {
			$sql=" UPDATE app_course SET ".join(" ,",$sql_r)." WHERE id=$id ";
			$q=$mysql->query($sql);
		}
		
		$category_id=$mysql->get1value("SELECT category_id FROM app_course WHERE id=$id ");
			
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Kategori gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add"))."?category_id=$category_id");
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Kategori berhasil",backendurl("$modul")."?category_id=$category_id");
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Kategori gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add"))."?category_id=$category_id");
	}
	
}
if($action=="del")
{
	$id=cleanInput($id,'numeric');

	$valid=true;
	$mysql->autocommit(false);
	
	$category_id=$mysql->get1value("SELECT category_id FROM app_course WHERE id=$id ");
	
	
	$sql="DELETE FROM app_course WHERE id='$id'";
	$r=$mysql->query($sql);

	if($r and $valid){
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success",$msg="Hapus Kategori berhasil",backendurl("$modul")."?category_id=$category_id");
	} else {
		$mysql->rollback();	
		sweetalert2($type="warning",$msg="Hapus Kategori gagal, terdapat data kompetensi didalamnya!",backendurl("$modul")."?category_id=$category_id");
	}
	
}
