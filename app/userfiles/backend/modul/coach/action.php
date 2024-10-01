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
		

$validation->set_validation(array('var'=>'nama','label'=>'Nama'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'hp','label'=>'HP'))->minlength(8)->required();
//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();

$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	$_POST['hp']=cleanInput($_POST['hp']);
	$_POST['is_internal']=cleanInput($_POST['is_internal']);
	$_POST['id_trainer']=cleanInput($_POST['id_trainer']);
	$_POST['expired']=dmy_to_ymd($_POST['expired']);
	if($_POST['id_trainer']=="") {
		
		$tahun=date("y");
		$max_id=$mysql->get1value(" select max(substring(id_trainer,4)+0) max_id from coach ")+1;
		$_POST['id_trainer']=$tahun.$_POST['is_internal'].str_pad($max_id,2,"0",STR_PAD_LEFT);
	


	}


	if($action=="save"){
		$is_duplicate=$mysql->get1value("SELECT count(id) FROM coach WHERE hp='$hp' ");
	}
	if($action=="update") {
		$is_duplicate=$mysql->get1value("SELECT count(id) FROM coach WHERE hp='$hp' AND id<>$id ");
	}

	if($is_duplicate) {
		$validation->set_validation(array('var'=>'hp','label'=>'HP'))->custom_msg($is_duplicate,"Handphone sudah terdaftar");
	}
	
	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'nama',
			'is_internal',
			'id_trainer',
			'expired',
			'hp',
		);
		
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$r_sql[]="$v = '$post'";
		}
		
		/*
		if($_POST['password']!='') {
			$password_hash=md5("balda_".$_POST['password']);
			$r_sql[]="password = '$password_hash'";
		}
		*/

		if($action=="update") {
			$sql=" UPDATE $modul SET ";
		} else {
			$sql=" INSERT INTO $modul SET ";		
		}
		
		if($action=="save") {
			$r_sql[]="created_by='$admin_id'";
			$r_sql[]="created_at='$hari_ini'";

		}
		
		if($action=="update") {
			$r_sql[]="modified_by='$admin_id'";
			$r_sql[]="modified_at='$hari_ini'";
		}
		
		
		$sql.=join(",",$r_sql);
		
		if($action=="update") {
			$sql.=" WHERE id=$id ";
		}

		$q=$mysql->query($sql);
		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Coach gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Coach berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Coach gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Coach berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Kategori tidak bisa dihapus karena ada buku yang menggunakan Coach ini. Silahkan hapus buku tersebut terlebih dahulu.",backendurl("$modul"));
	}
	
}

?>
