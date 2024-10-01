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
		

$validation->set_validation(array('var'=>'tanggal','label'=>'Tanggal'))->minlength(1)->required();


$validation->generate_js_validation();

if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	  if($action=='save') {
	    $deal_id=$_POST['deal_id'];
	list($deal_data)=$mysql->query_data("SELECT * FROM deal WHERE id=$deal_id");
	}
	if($action=="update") {
		$deal_id=$mysql->get1value("SELECT deal_id FROM invoice WHERE id=$id ");
		list($deal_data)=$mysql->query_data("SELECT * FROM deal WHERE id=$deal_id");
	}
	/*
	array(22) { ["id"]=> string(1) "6" ["kode"]=> string(6) "D10001" ["tanggal"]=> string(10) "2023-10-06" ["prospek_id"]=> string(1) "7" ["prospek_list_id"]=> string(2) "17" ["lembaga_id"]=> string(1) "2" ["nominal_deal"]=> string(8) "20000000" ["termin"]=> string(1) "3" ["termin_1"]=> string(2) "70" ["termin_2"]=> string(2) "10" ["termin_3"]=> string(2) "20" ["termin_4"]=> string(1) "0" ["termin_5"]=> string(1) "0" ["termin_6"]=> string(1) "0" ["termin_7"]=> string(1) "0" ["termin_8"]=> string(1) "0" ["termin_9"]=> string(1) "0" ["termin_10"]=> string(1) "0" ["created_at"]=> string(4) "2023" ["created_by"]=> string(1) "1" ["modified_by"]=> string(1) "1" ["modified_at"]=> string(19) "2023-10-06 21:38:18" }
	*/

	//var_dump($deal_data);

	//data lembaga
	list($lembaga_data)=$mysql->query_data("SELECT * FROM lembaga WHERE id='".$deal_data['lembaga_id']."'");
	

	$deskripsi=$_POST['deskripsi'];
	//$nominal=$_POST['nominal'];
	$dp=$_POST['dp']=cleanInput($_POST['dp'],'money');
	$diskon=$_POST['diskon']=cleanInput($_POST['diskon'],'money');

	$_POST['tanggal']=dmy_to_ymd($_POST['tanggal']);
	$_POST['tanggal_jatuh_tempo']=dmy_to_ymd($_POST['tanggal_jatuh_tempo']);
	$_POST['alamat']=nl2br($lembaga_data['lembaga_alamat']);
	$_POST['perusahaan']=nl2br($lembaga_data['lembaga_nama']);
	/*
	list($data_customer) = $mysql->query_data("SELECT nik,nama,hp,alamat,jenis_kelamin,pekerjaan FROM master_customer WHERE nik=".$_POST['nik']);
	
	$_POST['nama']=$data_customer['nama'];
	$_POST['hp']=$data_customer['hp'];
	$_POST['alamat']=$data_customer['alamat'];
	$_POST['jenis_kelamin']=$data_customer['jenis_kelamin'];
	$_POST['nik']=$data_customer['nik'];
	$_POST['pekerjaan']=$data_customer['pekerjaan'];
	*/

	//simpan customer
	//$_POST['id_customer']=insert_customer($_POST['hp']);
	
	if($action=="save") {
		$prefix=date("y");
		$year=date("Y");
		$urut=generate_urut_invoice($prefix,5,"invoice");
		$nomor_urut=str_replace($prefix,"",$urut);
		$nomor=$nomor_urut."/INV/".bulan_romawi(date("m"))."/$year";
		$termin_ke=cleanInput($_POST['termin_ke']);
		
		
	}
	$r_sql=array();
	if($validation->valid()){
		$r_post=array(
			'tanggal',
			'template',
			'tanggal_jatuh_tempo',
			'dp',
			'diskon',
		);
		
	
		if($action=='save') {
			$r_post[]='nama';
			$r_post[]='perusahaan';
			$r_post[]='alamat';
			$r_post[]='lembaga_id';
			$r_post[]='hp';
			$r_post[]='termin_ke';
		}
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$r_sql[]="$v = '$post'";
		}
		
		if($action=="update") {
			$sql=" UPDATE $modul SET ";
		} else {
			$sql=" INSERT INTO $modul SET ";		
		}
		
		if($action=="save") {
	
			$r_sql[]="index_nota='".intval($nomor_urut)."'";
			$r_sql[]="urut='$urut'";
			$r_sql[]="nomor='$nomor'";
			$r_sql[]="deal_id='$deal_id'";
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
		if($action=="update") {
			$id_invoice = $id;
		} else {
			$id_invoice = $mysql->insert_id();
		}
		
		/*UPDATE DETAIL*/
		$total=0;
		$hapus_detail=$mysql->query("DELETE FROM invoice_detail WHERE invoice_id=$id_invoice");
		if(count($_POST['deskripsi'])>0) {
			foreach($_POST['deskripsi'] as $i => $deskripsi) {
				$deskripsi=cleanInput(nl2br($deskripsi));
				$nominal=cleanInput($_POST['nominal'][$i],'money');
				$produk_id=$_POST['produk'][$i];
				$total+=$nominal;
				$insert_detail=$mysql->query("INSERT INTO invoice_detail SET invoice_id=$id_invoice,produk_id=$produk_id,deskripsi='$deskripsi',nominal='$nominal'");
			}
		}
		

		$update_subtotal_invoice=$mysql->query(" UPDATE invoice SET subtotal='$total' WHERE id=$id_invoice ");
		$total=$total-$dp;
		$total=$total-$diskon;
		$update_total_invoice=$mysql->query(" UPDATE invoice SET total_harga='$total' WHERE id=$id_invoice ");
		
		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Data gagal, data tidak valid",backendurl("invoice".($action=="update"?"/edit/$id":"/add?deal_id=$id&termin=$termin_ke")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Data berhasil",backendurl("deal/dokumen/$deal_id"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Data gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add?deal_id=$id&termin=$termin_ke")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');
$deal_id=$mysql->get1value("SELECT deal_id FROM invoice WHERE id=$id");
$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Data berhasil",backendurl("deal/dokumen/$deal_id"));
	} else {
		sweetalert2($type="warning",$msg="Data tidak bisa dihapus.",backendurl("deal/dokumen/$deal_id"));
	}
	
}

?>
