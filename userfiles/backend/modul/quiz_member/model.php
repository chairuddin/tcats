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
		

$validation->set_validation(array('var'=>'username','label'=>'Kode Login'))->minlength(1)->required();
$validation->set_validation(array('var'=>'fullname','label'=>'Nama Lengkap'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'class','label'=>'Kelas'))->minlength(1)->required();
$validation->generate_js_validation();
if($action=="save" or $action=="update") {

	$id=$_POST['id'];
	$kode=$_POST['username'];
	if($action=="save"){
		$is_duplicate=$mysql->get1value("SELECT count(id) FROM quiz_member WHERE username='$kode' ");
	}
	if($action=="update") {
		$is_duplicate=$mysql->get1value("SELECT count(id) FROM quiz_member WHERE username='$kode' AND id<>$id ");
	}
	
	if($is_duplicate) {
		$validation->set_validation(array('var'=>'username','label'=>'Kode Login'))->custom_msg($is_duplicate,"Kode Login harus unik");
	}
	
	//inject kelas ambil dari organization unit
	$_POST['class']=$_POST['organization_unit'];
	
	if($validation->valid()){
		$r_post=array(
		'username',
		'fullname',
		'class',
		'grade',
		'jurusan',
		'ruang',
		'email',
		'status',
		'level',
		'organization_unit_code',
		'organization_unit',
		'position_code',
		'position',
		'direct_supervisor_indeks',
		'direct_supervisor_name',
		'2nd_supervisor_indeks',
		'2nd_supervisor_name',
		'manager_indeks',
		'manager_name'
		);
		
		$sql_r = array();
		/*
		if($action=="save") {
			$sql_r[]="created_by='$admin_id'";
			$sql_r[]="created_date='$hari_ini'";
		}
		
		if($action=="update") {
			$sql_r[]="modified_by='$admin_id'";
			$sql_r[]="modified_date='$hari_ini'";
		}
		*/
		$sql_r[]="lastmodify='$hari_ini'";
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$sql_r[]="$v = '$post'";
		}
		
		if($_POST['password']!='') {
			$password_hash=md5("quizroom_".$_POST['password']);
			$sql_r[]="password = '$password_hash'";
		}
		if($action=="save") {
			$sql=" INSERT INTO quiz_member SET ".join(" ,",$sql_r);
			$q=$mysql->query($sql);
			$last_id=$mysql->insert_id();
		}
		
		if($action=="update") {
			$sql=" UPDATE quiz_member SET ".join(" ,",$sql_r)." WHERE id=$id ";
			$q=$mysql->query($sql);
		}
		
			
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Peserta gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Peserta berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Peserta gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');
/*
$r=$mysql->query("SELECT thumbnail,ebook from buku WHERE id='$id'");
list($file_thumbnail,$file_ebook)=$mysql->row($r);
//del gambar 
if(file_exists("$path_thumbnail/$file_thumbnail"))
{
	unlink("$path_thumbnail/$file_thumbnail");
}
//del pdf 
if(file_exists("$path_thumbnail/$file_ebook"))
{
	unlink("$path_thumbnail/$file_ebook");
}
*/ 
//update log
	$valid=true;
	$mysql->autocommit(false);
	
	$sql="DELETE FROM quiz_member WHERE id='$id'";
	$r=$mysql->query($sql);

	if($r and $valid){
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success",$msg="Hapus peserta berhasil",backendurl("$modul"));
	} else {
		$mysql->rollback();	
		sweetalert2($type="warning",$msg="Hapus peserta gagal",backendurl("$modul"));
	}
	
}

if($action=="upload_xls")
{
	$sukses=true;
	$mysql->autocommit(false);
	
	$is_replace=cleanInput($_POST['replace']);
	
	$destination=filepath("user/".$_FILES['filename']['name']);
	
	$filename=$_FILES['filename']['name'];
	if (!move_uploaded_file($_FILES['filename']['tmp_name'], $destination)) {
		$sukses=false;
		sweetalert2($type="warning","Gagal. silahkan cek permission",backendurl("$modul"));
		return _MAYBEPERMISSION;
	}else{
	
	if($is_replace){
		$q=$mysql->query("DELETE FROM quiz_member");
		if(!$q){$sukses=false;}
	}
	
	$alamat=filepath("user/$filename");
	$objPHPExcel = PHPExcel_IOFactory::load($alamat);
	
	
	$dataArr = array();
	 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		 
		for ($row = 1; $row <= $highestRow; ++ $row) {
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				$dataArr[$row][$col] = $val;
			}
		}
	}
	unset($dataArr[1]);
	$already_exist=array();
	$success_input=array();
	$class=array();
	foreach($dataArr as $val){
		$sandi="";
		if($val[5]!="") {
			$sandi_hash=md5("quizroom_".$val[5]);
			$sandi=",password='".$sandi_hash."'";
		}
		if(cleanInput($val[2])!="") {
			$class[cleanInput($val[2])]=1;
		}
		/*

		     ->setCellValue('A1',"Kode Login")0
            ->setCellValue('B1',"Nama Lengkap")1
			->setCellValue('C1',"Sandi")2
            ->setCellValue('D1',"Email")3
			->setCellValue('E1',"Organization Unit Code")4
			->setCellValue('F1',"Organization Unit")5
			->setCellValue('G1',"Position Code")6
			->setCellValue('H1',"Position")7
			->setCellValue('I1',"Direct Supervisor Indeks")8
			->setCellValue('J1',"Direct Supervisor Name")9
			->setCellValue('K1',"2nd Supervisor Indeks")10
			->setCellValue('L1',"2nd Supervisor Name")11
			->setCellValue('M1',"Manager Indeks")12
			->setCellValue('N1',"Manager Name");13


		organization_unit_code,
		organization_unit,
		position_code,
		position,
		direct_supervisor_indeks,
		direct_supervisor_name,
		2nd_supervisor_indeks,
		2nd_supervisor_name,
		manager_indeks,
		manager_name

		jurusan='".cleanInput($val[3])."',
		ruang='".cleanInput($val[4])."',

		jurusan='".cleanInput($val[3])."',
		ruang='".cleanInput($val[4])."',

		*/
		$q=$mysql->query("
		INSERT INTO quiz_member set 
		username='".cleanInput($val[0])."',
		fullname='".cleanInput($val[1])."',
		class='".cleanInput($val[4])."',
		email='".cleanInput($val[3])."',
		organization_unit_code='".cleanInput($val[4])."',
		organization_unit='".cleanInput($val[5])."',
		position_code='".cleanInput($val[6])."',
		position='".cleanInput($val[7])."',
		direct_supervisor_indeks='".cleanInput($val[8])."',
		direct_supervisor_name='".cleanInput($val[9])."',
		2nd_supervisor_indeks='".cleanInput($val[10])."',
		2nd_supervisor_name='".cleanInput($val[11])."',
		manager_indeks='".cleanInput($val[12])."',
		manager_name='".cleanInput($val[13])."',
		status=1,lastmodify='".$hari_ini."' 
		$sandi
		ON DUPLICATE KEY UPDATE 
		fullname='".cleanInput($val[1])."',
		class='".cleanInput($val[4])."',
		email='".cleanInput($val[6])."',
		organization_unit_code='".cleanInput($val[4])."',
		organization_unit='".cleanInput($val[5])."',
		position_code='".cleanInput($val[6])."',
		position='".cleanInput($val[7])."',
		direct_supervisor_indeks='".cleanInput($val[8])."',
		direct_supervisor_name='".cleanInput($val[9])."',
		2nd_supervisor_indeks='".cleanInput($val[10])."',
		2nd_supervisor_name='".cleanInput($val[11])."',
		manager_indeks='".cleanInput($val[12])."',
		manager_name='".cleanInput($val[13])."',
		lastmodify='".$hari_ini."' $sandi
		");
		if($q){
			$success_input[]=cleanInput($val[1]);
		}else{
			$sukses=false;
			$already_exist[]=cleanInput($val[1]);
		}
    }
    foreach($class as $nama_class => $v) {
		$insert_class=$mysql->query("INSERT IGNORE INTO quiz_class SET nama='$nama_class',created_by='$id_user',created_date='$hari_ini' ");
	}
	if(count($success_input)>10){
		$join_msg="<ul><li>".count($success_input)." Peserta</li></ul>";		
	}else{
		$join_msg="<ul><li>".join("</li><li>",$already_exist)."</li></ul>";	
	}
	
	if($sukses) {
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success","Berhasil tambah peserta $join_msg",backendurl("$modul"));
	} else {
		$mysql->rollback();
		$mysql->autocommit(true);
		sweetalert2($type="warning","Gagal tambah peserta tambah peserta $join_msg",backendurl("$modul"));
	}

	
	}
	
	
}
if($_POST['bulk_delete']) {
	$list_id="";
	if(count($_POST['mark_delete'])>0) {
		$list_id=join(",",$_POST['mark_delete']);
	}
	$sql="DELETE FROM $modul WHERE id IN($list_id)";
	$r=$mysql->query($sql);
	if($r)
	{
		sweetalert2($type="success","Berhasil hapus peserta",backendurl("$modul"));
	}
	else
	{
		sweetalert2($type="warning","Gagal hapus peserta",backendurl("$modul"));
	}

}
?>
