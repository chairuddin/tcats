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
	$jenis=cleanInput($_POST['jenis']);
	$_POST['harga']=cleanInput($_POST['harga'],'money');
	$_POST['is_paket']=1;
	if($action=="save") {
		$kode_jenis=$mysql->get1value("SELECT kode FROM produk_jenis WHERE id=$jenis ")."-";
		$panjang_kode=strlen($kode_jenis);
		$max_id=$mysql->get1value(" select max(substring(kode,".($panjang_kode+1).")+0) max_id from produk WHERE left(kode,$panjang_kode)='$kode_jenis' ")+1;
		$_POST['kode']=$kode_jenis.str_pad($max_id,2,"0",STR_PAD_LEFT);
	}

	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'jenis',
			'nama',
			'harga',
			'is_paket',
		);
		if($action=='save') {
			$r_post[]='kode';
		}
		
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
			$sql=" UPDATE $table SET ";
		} else {
			$sql=" INSERT INTO $table SET ";		
		}
		/*
		if($action=="save") {
			$r_sql[]="created_by='$admin_id'";
			$r_sql[]="created_at='$hari_ini'";

		}
		
		if($action=="update") {
			$r_sql[]="modified_by='$admin_id'";
			$r_sql[]="modified_at='$hari_ini'";
		}
		*/
		
		$sql.=join(",",$r_sql);
		
		if($action=="update") {
			$sql.=" WHERE id=$id ";
		}
		
		$q=$mysql->query($sql);
		
		if($action=="save") {
			$id=$mysql->insert_id();
		}
		//input produk terpilih
		$list_produk=$_POST['list_produk'];

		//reset produk terpilih dari database
		$reset=$mysql->query(" DELETE FROM produk_paket WHERE parent_id=$id ");
		if(count($list_produk)>0) {
			foreach($list_produk as $i => $produk_id) {
				$insert=$mysql->query(" INSERT INTO produk_paket SET parent_id='$id',produk_id='$produk_id' ");
			}
		}

		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Produk gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Produk berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Produk gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM produk WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Produk Paket berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Gagal hapus produk paket",backendurl("$modul"));
	}
	
}

?>
