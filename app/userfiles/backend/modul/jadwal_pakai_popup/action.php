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

//$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	$post=file_get_contents("php://input");
	$_POST=json_decode($post,true);
	
	$id=$jadwal_id=$_POST['jadwal_id'];
	if($id!=="") $action="update";

	$coach=$_POST['coach'];
	$_POST['kegiatan_judul']=$mysql->get1value("SELECT nama FROM produk WHERE id='".$_POST['produk_id']."'");
	//$_POST['tanggal_mulai']=dmy_to_ymd($_POST['tanggal_mulai'],true);
	//$_POST['tanggal_selesai']=dmy_to_ymd($_POST['tanggal_selesai'],true);
	
	$r_sql=array();
	
				
		$r_post=array(
			'kegiatan_id',
			'kegiatan_judul',
			'produk_id',
			'waktu_mulai',
			'waktu_selesai'
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
		if($action=='save') {
			$jadwal_id=$mysql->insert_id();
		}
		$clear=$mysql->query("DELETE FROM jadwal_coach WHERE jadwal_id=$jadwal_id ");
		for($i=0;$i<count($coach);$i++) {
			if($coach[$i]!=="") {
				$mysql->query("INSERT INTO jadwal_coach SET jadwal_id=$jadwal_id,coach_id=".$coach[$i]);
			}
		}
		
		
	
	$response=array();
	if($q){
		$response=array('success'=>1,'msg'=>'Sukses');
		//sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Jadwal berhasil",backendurl("$modul"));
	} else {
		$response=array('success'=>0,'msg'=>'Gagal');
		//sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Jadwal gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	echo json_encode($response);
	die();
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Jenis berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Kategori tidak bisa dihapus karena ada buku yang menggunakan Jenis ini. Silahkan hapus buku tersebut terlebih dahulu.",backendurl("$modul"));
	}
	
}

if($action=="load") {
	$kegiatan_id=$_GET['kegiatan_id'];
	$jadwal_terakhir=date("Y-m-d",strtotime("-3 Months"));
	$q=$mysql->query(" SELECT * FROM jadwal where date_format(waktu_mulai,'Y-m-d')>'$jadwal_terakhir'");
	$events=array();
	if($q and $mysql->num_rows($q)>0) {
		while($d=$mysql->fetch_assoc($q)) {
			$coach=array();
			$q_coach=$mysql->query("SELECT coach_id FROM jadwal_coach WHERE jadwal_id=".$d['id']);
			if($q_coach and $mysql->num_rows($q_coach)>0 ) {
				while($d_coach=$mysql->fetch_assoc($q_coach)) {
					$coach[]=$d_coach['coach_id'];
				}
			}
			$disabled=1;
			$bg='bg-warning';
			if($d['kegiatan_id']==$kegiatan_id) {
				$disabled=0;
				$bg='bg-success';
			}
			$event = [
				'id' => $d['id'],
				'title' => $d['kegiatan_judul'],
				'start' => $d['waktu_mulai'],
				'end' => $d['waktu_selesai'],
				'className'=>$bg,
				'color'=> '#000000',
				'jadwal_id' => $d['id'],
				'kegiatan_id' =>$d['kegiatan_id'],
				'produk_id'=>$d['produk_id'],
				'waktu_mulai' => $d['waktu_mulai'],
				'waktu_selesai' => $d['waktu_selesai'],
				'coach'=>$coach,
				'disabled'=>$disabled
			 ];
			
			 array_push($events, $event);
		} 
	}
	echo json_encode($events);
	die();
}
if($action=='ringkasan_view') {
	$kegiatan_id=cleanInput($_GET['kegiatan_id']);
	echo ringkasan_view($kegiatan_id);
	die();
}
?>
