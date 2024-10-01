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
		

$validation->set_validation(array('var'=>'tanggal','label'=>'Tanggal Deal'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'hp','label'=>'HP'))->minlength(8)->required();
//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();

$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	//$jenis=cleanInput($_POST['jenis']);
	$_POST['nominal_deal']=cleanInput($_POST['nominal_deal'],'money');
	$_POST['tanggal']=dmy_to_ymd($_POST['tanggal']);
	$_POST['prospek_list_id']=$id;
	$_POST['prospek_id']=$mysql->get1value(" SELECT prospek_id FROM prospek_list WHERE id=$id ");	
	$_POST['lembaga_id']=$mysql->get1value(" SELECT lembaga_id FROM prospek_list WHERE id=$id ");	

	if($action=="save") {
		$prefik="D".date("y");
		$panjang_kode=strlen($prefik);
		$max_id=$mysql->get1value(" select max(substring(kode,".($panjang_kode+1).")+0) max_id from deal WHERE left(kode,$panjang_kode)='$prefik' ")+1;
		$_POST['kode']=$prefik.str_pad($max_id,3,"0",STR_PAD_LEFT);
	}
	

	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'tanggal',
			'nominal_deal',
			'termin',
			'termin_1',
			'termin_2',
			'termin_3',
			'termin_4',
			'termin_5',
			'termin_6',
			'termin_7',
			'termin_8',
			'termin_9',
			'termin_10',
	
		);
		
		if($action=='save') {
			$r_post[]='kode';
			$r_post[]='prospek_id';
			$r_post[]='prospek_list_id';
			$r_post[]='lembaga_id';
		}
		if($action=='update') {
			
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
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Deal gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Deal berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Deal gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');
$id_invoice=$mysql->get1value("SELECT id FROM invoice WHERE deal_id=$id LIMIT 1");
if($id_invoice>0) {
	sweetalert2($type="warning",$msg="Data tidak bisa dihapus, sudah ada invoice yang dibuat pada data ini.",backendurl("$modul"));
} else {
	$sql="DELETE FROM $modul WHERE id='$id' ";
	$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus deal berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Data tidak bisa dihapus, sudah ada invoice yang dibuat pada data ini.",backendurl("$modul"));
	}
}

}


if($action=='upload_berkas') {
	
	$uploadDir = filepath("deal/");  // Directory where you want to save the uploaded files
	$doc_type=cleanInput($_GET['doc_type']);
	$deal_id=cleanInput($_GET['deal_id'],'numeric');
	list($deal_data)=$mysql->query_data("SELECT kode,lembaga_id FROM deal WHERE id=$deal_id");
	list($lembaga_data)=$mysql->query_data("SELECT lembaga_nama FROM lembaga WHERE id='".$deal_data['lembaga_id']."'");
	$lembaga_nama = cleanInput($lembaga_data['lembaga_nama'],'alphanumeric');
	$reponse=array();
	if (!file_exists($uploadDir)) {
		mkdir($uploadDir, 0777, true);  // Create the directory if it doesn't exist
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
		$file = $_FILES['file'];

		// Check if the file was uploaded without errors
		if ($file['error'] === UPLOAD_ERR_OK) {
			//$fileName = basename($file['name']);
			
			$file_info = pathinfo($file['name']);
			// Get the file extension
			$file_extension = $file_info['extension'];
			$fileName=$doc_type."-".$deal_data['kode']."_".$lembaga_nama.".$file_extension";
			
			$targetPath = $uploadDir . $fileName;

			// Move the file to the specified directory
			$upload=move_uploaded_file($file['tmp_name'], $targetPath);
		
			if ($upload) {
				if($doc_type=='doc_mou' || $doc_type=='doc_spk')
				$update_name=$mysql->query("UPDATE deal SET $doc_type='$fileName'");

				$response=array('success'=>1,'msg'=>'Berhasil upload','url'=>fileurl("deal/$fileName"));
			} else {
				$response=array('success'=>0,'msg'=>'Failed to upload file.'.error_get_last()['message']);
			}
		} else {
			$response=array('success'=>0,'msg'=>'Error during file upload: ' . $file['error']);
		}
	} else {
		$response=array('success'=>0,'msg'=>'Invalid request.');
	}
	echo json_encode($response);
	die();
}
?>
