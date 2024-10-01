<?php
function booking_code($str)
{
	$alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
	$newName = '';
	do {
		$str--;
		$limit = floor($str / 26);
		$reminder = $str % 26;
		$newName = $alpha[$reminder].$newName;
		$str=$limit;
	} while ($str >0);
	return $newName;
}
function generate_booking_code($i,$now) {
	$date=date('my',strtotime($now));
	$second=date('s',strtotime($now));
	$string=str_pad($i,3,"0",STR_PAD_RIGHT).str_pad($second,2,"0",STR_PAD_RIGHT).$date;
	$alphanumeric = booking_code($string);
	return strtoupper($alphanumeric);
}
$hari_ini=date("Y-m-d H:i:s");
b_load_lib("YonaForm");
$form = new YonaForm();
$validation = new YonaValidation();
$validation->set_validation(array('var'=>'id_cabang','label'=>'Cabang'))->required();
$validation->set_validation(array('var'=>'kode_otorisasi','label'=>'Kode Otorisasi'))->required();
if($_POST['id_cabang']!='' AND $_POST['kode_otorisasi']!='') {
	$id_cabang=cleanInput($_POST['id_cabang']);
	$otorisasi=cleanInput($_POST['kode_otorisasi']);
	$cek=$mysql->query("SELECT * FROM master_cabang WHERE otorisasi='$otorisasi' AND id=$id_cabang");
	if($cek and $mysql->num_rows($cek)<=0) {
		$validation->set_validation(array('var'=>'kode_otorisasi','label'=>'Kode Otorisasi'))->custom_msg(true,"Kode otorisasi salah");
	}
}
$validation->set_validation(array('var'=>'nama_lengkap','label'=>'Nama Lengkap'))->minlength(3)->required();
$validation->set_validation(array('var'=>'nama_panggilan','label'=>'Nama Panggilan'))->minlength(3)->required();
$validation->set_validation(array('var'=>'email','label'=>'Email'))->email();
$validation->set_validation(array('var'=>'tempat_lahir','label'=>'Tempat Lahir'))->required();
$validation->set_validation(array('var'=>'tanggal_lahir','label'=>'Tanggal Lahir'))->required();
$validation->set_validation(array('var'=>'sekolah_asal','label'=>'Sekolah Asal'))->required();
$validation->set_validation(array('var'=>'sekolah_jenjang','label'=>'Jenjang'))->required();
$validation->set_validation(array('var'=>'nomor_hp','label'=>'Nomor handphone siswa'))->required();
$validation->set_validation(array('var'=>'nomor_hp_ortu','label'=>'Nomor handphone orang tua'))->required();
$validation->set_validation(array('var'=>'id_paket','label'=>'Program yang akan diikuti'))->required();
$validation->set_validation(array('var'=>'masa_program','label'=>'Daftar untuk program'))->required();
$validation->set_validation(array('var'=>'pola_hari','label'=>'Pola hari'))->required();
$validation->set_validation(array('var'=>'form_check','label'=>'Cek data valid '))->required();
$validation->generate_js_validation();

$action=$_POST['submit']==1?"save":"";
if($action=="save") {
	
	$valid=true;
	$mysql->autocommit(false);
	$id=$_POST['id'];
	if($_POST['tanggal_lahir']!='') {
		list($d,$m,$y)=explode("/",$_POST['tanggal_lahir']);
		$_POST['tanggal_lahir']="$y-$m-$d";
	}
	
	
		
	if($validation->valid()) {
		$r_post=array(
		'id_cabang',
		'nama_lengkap',
		'nama_panggilan',
		'email',
		'tempat_lahir',
		'tanggal_lahir',
		'alamat',
		'sekolah_asal',
		'sekolah_jenjang',
		'nomor_hp',
		'nomor_hp_ortu',
		'info',
		'id_paket',
		'masa_program',
		'pola_hari'
		);
		
		$sql_r = array();
		
		if($action=="save") {
			$sql_r[]="created_date='$hari_ini'";
		}
		
		
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$sql_r[]="$v = '$post'";
		}
		
		
			
		//INSERT MEMBER
		$sql=" INSERT INTO formulir SET ".join(" ,",$sql_r);
		$q=$mysql->query($sql);
		$last_id=$mysql->insert_id();
		$booking_code=generate_booking_code($last_id,$hari_ini);
		$update_code=$mysql->query("UPDATE formulir SET kode='$booking_code' WHERE id=$last_id ");
		if(!$q) {
			$valid=false;
		} 
		
	} else {
		$valid=false;
	}
	
	if($valid){
		$form->release_data();
		$_SESSION['formulir_terakhir']=$last_id;
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success","Selamat registrasi berhasil",fronturl("berhasil"));
	} else {
		$mysql->rollback();
		sweetalert2($type="warning","Registrasi gagal silahkan cek ulang data anda",fronturl("$modul"));
	}
	
}
?>
