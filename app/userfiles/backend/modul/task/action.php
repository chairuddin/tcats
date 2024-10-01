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
		

$validation->set_validation(array('var'=>'title','label'=>'Task Title'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'hp','label'=>'HP'))->minlength(8)->required();
//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();

$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	$project_id=cleanInput($_POST['project_id']);
	//$_POST['harga']=cleanInput($_POST['harga'],'money');
	/*
	if($action=="save") {
		$kode_jenis=$mysql->get1value("SELECT kode FROM Task_jenis WHERE id=$jenis ")."-";
		$panjang_kode=strlen($kode_jenis);
		$max_id=$mysql->get1value(" select max(substring(kode,".($panjang_kode+1).")+0) max_id from Tugas WHERE left(kode,$panjang_kode)='$kode_jenis' ")+1;
		$_POST['kode']=$kode_jenis.str_pad($max_id,2,"0",STR_PAD_LEFT);
	}
		*/

	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'project_id',
			'title',
			'task_type_id',
			'priority',
			'assign_to',
			'estimation',
			'start_date',
			'end_date',
			'status'
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
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Task gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Task berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Task gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";

$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Task berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Task tidak bisa dihapus.",backendurl("$modul"));
	}
	
}

?>
