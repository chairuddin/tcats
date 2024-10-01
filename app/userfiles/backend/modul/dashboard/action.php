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
		

$validation->set_validation(array('var'=>'last_fu','label'=>'last_fu'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'hp','label'=>'HP'))->minlength(8)->required();
//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();

$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	
	$_POST['prospek_list_id']=$id;
	//$_POST['last_fu']=dmy_to_ymd($_POST['last_fu']);
	//$_POST['next_fu']=dmy_to_ymd($_POST['next_fu']);
	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'last_fu',
			'next_fu',
			'status',
			'fu_via',
			'catatan',
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
			$sql=" UPDATE prospek_followup SET ";
		} else {
			$sql=" INSERT INTO prospek_followup SET ";		
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
			//$sql.=" WHERE id=$id ";
		}
		$sql.=",prospek_list_id=$id ";

		$q=$mysql->query($sql);

		//update parent
		$r_sql=array();
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$r_sql[]="$v = '$post'";
		}
		$update=$mysql->query(" UPDATE prospek_list SET ".join(",",$r_sql)."  WHERE id=$id ");
		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Follow Up gagal, data tidak valid",backendurl("$modul".($action=="update"?"/fu_prospek/$id":"/fu_prospek/$id")));
	}
	
	if($q){
		if($_GET['from']!='') {
			sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Follow Up berhasil",backendurl($_GET['from']));
		} else {
			sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Follow Up berhasil",backendurl("$modul"));
		}
		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Follow Up gagal. ",backendurl("$modul".($action=="update"?"/fu_prospek/$id":"/fu_prospek/$id")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$id_prospek=$mysql->get1value("SELECT prospek_list_id FROM prospek_followup WHERE id=$id ");
$sql="DELETE FROM prospek_followup WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		//reset data sesuai terakhir
		$r_field=array('last_fu','fu_via','status','catatan','next_fu','created_by','created_at');
		$join_field=join(",",$r_field);
		$q1=$mysql->query(" SELECT prospek_list_id,$join_field FROM prospek_followup WHERE prospek_list_id=$id_prospek ORDER BY last_fu DESC LIMI 1 ");
		$d1=$mysql->fetch_assoc($q1);
		$history=array();
		foreach($r_field as $field) {
			$history[$field]=$d1[$field];
		}

		//update parent
		$r_sql=array();
		foreach($history as $field => $value) {
			$post=$history[$field];
			$r_sql[]="$field = '$value'";
		}
		$update=$mysql->query(" UPDATE prospek_list SET ".join(",",$r_sql)."  WHERE id=$id_prospek ");



		sweetalert2($type="success",$msg="Hapus Followup berhasil",backendurl("$modul/fu_prospek/$id_prospek"));
	} else {
		sweetalert2($type="warning",$msg="Kategori tidak bisa dihapus karena ada buku yang menggunakan Lembaga ini. Silahkan hapus buku tersebut terlebih dahulu.",backendurl("$modul/fu_prospek/$id_prospek"));
	}
	
}

?>
