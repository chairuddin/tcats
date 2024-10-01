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
		


if($action=="update") {
	
	$id=$_POST['id'];
	$deal_id=$mysql->get1value(" SELECT deal_id FROM invoice WHERE id=$id ");
	$r_sql=array();
		
		if($action=="update") {
			$sql=" UPDATE invoice SET ";
		} else {
			//$sql=" INSERT INTO invoice SET ";		
		}

		$status_lunas=cleanInput($_POST['status_lunas']);
		$metode_bayar=cleanInput($_POST['metode_bayar']);
		

		
		if($action=="update") {
			$r_sql[]="status_lunas=$status_lunas";
			
			$r_sql[]="metode_bayar=$metode_bayar";

			$r_sql[]="printed_by='$admin_id'";
			$r_sql[]="printed_at='$hari_ini'";
		}
		
		
		$sql.=join(",",$r_sql);
		
		if($action=="update") {
			$sql.=" WHERE id=$id ";
		}

		$q=$mysql->query($sql);
		
	
	
	if($q){
		sweetalert2($type="success","Persiapan cetak",backendurl("deal/dokumen/$deal_id"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Update lunas gagal ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	
}


?>
