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
		

//$validation->set_validation(array('var'=>'lokasi','label'=>'Lokasi'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'hp','label'=>'HP'))->minlength(8)->required();
//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();
$validation->set_validation(array('var'=>'lembaga_id','label'=>'Penyelenggara'))->minlength(1)->required();
$validation->set_validation(array('var'=>'produk_id','label'=>'Produk'))->minlength(1)->required();

$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	
	//$_POST['tanggal_mulai']=dmy_to_ymd($_POST['tanggal_mulai'],true);
	//$_POST['tanggal_selesai']=dmy_to_ymd($_POST['tanggal_selesai'],true);
	if($action=="save") {
		$prefik="J".date("ym");
		$panjang_kode=strlen($prefik);
		$max_id=$mysql->get1value(" select max(substring(kode,".($panjang_kode+1).")+0) max_id from kegiatan WHERE left(kode,$panjang_kode)='$prefik' ")+1;
		$kode=$prefik.str_pad($max_id,3,"0",STR_PAD_LEFT);
		
	}
	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'produk_id',
			'lembaga_id'
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
			$r_sql[]="kode='$kode'";
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
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Kegiatan gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Kegiatan berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Kegiatan gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Jenis berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Tidak bisa dihapus. Sudah ada jadwal yang dibuat.",backendurl("$modul"));
	}
	
}

if($action=="selesai_update") {
	
	$id=$_POST['id'];
	

	$r_sql=array();
	
				
	$r_post=array(
		'status_selesai',
		'status_laporan',
		'status_sertifikat'
	);
	
	foreach($r_post as $i => $v) {
		$post=cleanInput($_POST[$v]);
		$r_sql[]="$v = '$post'";
	}
	

	$sql=" UPDATE $modul SET ";
	
	$r_sql[]="modified_by='$admin_id'";
	$r_sql[]="modified_at='$hari_ini'";
	
	
	
	$sql.=join(",",$r_sql);
	
	$sql.=" WHERE id=$id ";
	
	$q=$mysql->query($sql);
	

	
	if($q){
		sweetalert2($type="success",$msg=($action=="selesai_update"?"Update Status":"Tambah")." Kegiatan berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="selesai_update"?"Update Status":"Tambah")." Kegiatan gagal. ",backendurl("$modul".($action=="update"?"/update_selesai/$id":"/add")));
	}
	
	
}

?>
