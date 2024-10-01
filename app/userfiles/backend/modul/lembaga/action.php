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
		
$validation->set_validation(array('var'=>'lembaga_jenis','label'=>'Segmen'))->minlength(1)->required();
$validation->set_validation(array('var'=>'lembaga_nama','label'=>'Nama Lembaga'))->minlength(1)->required();

//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();

$validation->generate_js_validation();


if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	//$jenis=cleanInput($_POST['jenis']);
	//$_POST['harga']=cleanInput($_POST['harga'],'money');
	if($_POST['lembaga_jenis']==4) {
		$tahun=date("y");
		$prefik="CSR-".$tahun."-";
		$max_id=$mysql->get1value(" select max(substring(kode,".(strlen($prefix)).")+0) max_id from lembaga WHERE lembaga_jenis=4 ")+1;
		$_POST['kode']=$prefik.str_pad($max_id,2,"0",STR_PAD_LEFT);
	}
	if($_POST['lembaga_jenis']==5) {
		$tahun=date("y");
		$prefik="NGO-".$tahun."-";
		$max_id=$mysql->get1value(" select max(substring(kode,".(strlen($prefix)).")+0) max_id from lembaga WHERE lembaga_jenis=4 ")+1;
		$_POST['kode']=$prefik.str_pad($max_id,2,"0",STR_PAD_LEFT);
	}
	if($action=='save') {
	    
	        if($_POST['lembaga_jenis']==2) {
    			$npsn=cleanInput($_POST['npsn']);
    			$q=$mysql->query("SELECT * FROM lembaga WHERE npsn='$npsn'");
    			if($q and $mysql->num_rows($q)>0) {
    				sweetalert2($type="warning","NPSN Sudah terdaftar",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
    			}
	        }
		
	}
	$from=cleanInput($_POST['from']);

	$param_from='';
	if($from!='') {
		$param_from='/?npsn='.$_POST['npsn'].'&lembaga_jenis='.$_POST['lembaga_jenis'].'&from=sinkronisasi_npsn_baru';
	}
	/*
	if($action=="save") {
		$kode_jenis=$mysql->get1value("SELECT kode FROM Lembaga_jenis WHERE id=$jenis ")."-";
		$panjang_kode=strlen($kode_jenis);
		$max_id=$mysql->get1value(" select max(substring(kode,".($panjang_kode+1).")+0) max_id from Lembaga WHERE left(kode,$panjang_kode)='$kode_jenis' ")+1;
		$_POST['kode']=$kode_jenis.str_pad($max_id,2,"0",STR_PAD_LEFT);
	}
	*/

	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'lembaga_jenis',
			'npsn',
			'npyp',
			'kode',
			'lembaga_nama',
			'lembaga_jenjang',
			'lembaga_status',
			'lembaga_alamat',
			'lembaga_telp',
			'lembaga_email',
			'lembaga_kota',
			'lembaga_website',
			'lembaga_tahun_berdiri',
			'lembaga_ulang_tahun',
			'lembaga_jumlah_siswa',
			'lembaga_biaya_spp',
			'lembaga_biaya_pendaftaran',
			'pic_nama_lengkap',
			'pic_nama_panggilan',
			'pic_whatsapp',
			'pic_email',
			'pic_kelamin',
			'pic_tanggal_lahir',
			'pic_agama',
			'pic_jabatan',
			'pic_tahun_menjabat',
	
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

		//update lembaga_id di tabel personal berdasarkan npsn dari lembaga exist
			$update_lembaga_id=$mysql->query("
			UPDATE personal p LEFT JOIN lembaga l ON p.npsn=l.npsn  SET p.lembaga_id=l.id
		");
		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Lembaga gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add"))).$param_from;
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Lembaga berhasil",backendurl("$modul/$from"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Lembaga gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add"))).$param_from;
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Lembaga berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Lembaga tidak dihapus karena terkait dengan data lain",backendurl("$modul"));
	}
	
}

if($action=="check_npsn") {
	$npsn=cleanInput($_GET['npsn']);
	list($data)=$mysql->query_data("SELECT * FROM sekolah WHERE npsn='$npsn'");
	$data=is_array($data)?$data:array();
	if($data['npsn']=='' or true) {
		//ambil semua data dari online 
				// Create a DOMDocument object and load the HTML content
		$html = file_get_contents('https://referensi.data.kemdikbud.go.id/pendidikan/npsn/'.$npsn); // You can replace 'your_html_file.html' with the HTML content
		$dom = new DOMDocument;
		@$dom->loadHTML($html);

		// Initialize an array to store the data
		$data = array();

		// Find the table containing the information
		$tables = $dom->getElementsByTagName('table');
		foreach ($tables as $table) {
			// Find the table that contains the data you need
			$rows = $table->getElementsByTagName('tr');
			foreach ($rows as $row) {
				$columns = $row->getElementsByTagName('td');
				if ($columns->length >= 4) {
					$key = trim($columns->item(1)->nodeValue);
					$value = trim($columns->item(3)->nodeValue);
					$data[$key] = $value;
				}
			}
		}

		// Extract the data from NPSN to Bentukan
		$output = array();
		$format = array();
		$start = false;
		
		foreach ($data as $key => $value) {
			if ($start) {
				$key2='';
				if($key=='Alamat') 					$key2='alamat_jalan';
				if($key=='Kab.-Kota/Negara (LN)') 	$key2='kabupaten_kota';
				if($key=='Status Sekolah') 			$key2='status';
				if($key=='Bentuk Pendidikan') 		$key2='bentuk';
				if($key=='Website') 				$key2='website';
				if($key=='Email') 					$key2='email';
				if($key=='Telepon') 				$key2='telp';
				if($key=='Tanggal SK. Pendirian') 	$key2='tahun_berdiri';
				
				if($key2=='') $key2=$key;

				if($key2=='tahun_berdiri'){
					list($tgl,$bln,$thn)=explode("-",$value);
					$value="$thn-$bln-$tgl";
				}

				if($key2=='kabupaten_kota') {
					$wilayah=wilayah_nama(trim($value));
					$output['kota_id'] = $wilayah['id'];
				}
				$output[$key2] = $value;
				
				if ($key === 'Website') {
					break;
				}
			}
			if ($key === 'Nama') {
				$start = true;
				$output['sekolah'] = $value;
			}
		}

		// Output the extracted data
		/*
		{
			"NPSN": "20411916",
			"Alamat": "Jl. Soekarno-Hatta no.05",
			"Desa\/Kelurahan": "MLAJAH",
			"Kecamatan\/Kota (LN)": "KEC. BANGKALAN",
			"Kab.-Kota\/Negara (LN)": "KAB. BANGKALAN",
			"Propinsi\/Luar Negeri (LN)": "PROV. JAWA TIMUR",
			"Status Sekolah": "NEGERI",
			"Bentuk Pendidikan": "MA"
		}
		*/

		echo json_encode($output, JSON_PRETTY_PRINT);

	} else {
		
		$wilayah=wilayah_nama($data['kabupaten_kota']);
		$data['kota_id'] = $wilayah['id'];
	
		echo json_encode($data);
	}
	
	
	die();
}

if($action=="upload_xls")
{

	$lembaga_jenis_by_nama=lembaga_jenis_by_nama();
	$lembaga_jenjang_by_nama=lembaga_jenjang_by_nama();
	$kota_by_nama=kota_by_nama();
	
	$sukses=true;
	$mysql->autocommit(false);
	
	$is_replace=cleanInput($_POST['replace']);
	
	$destination=filepath("temp/".$_FILES['filename']['name']);
	
	$filename=$_FILES['filename']['name'];
	if (!move_uploaded_file($_FILES['filename']['tmp_name'], $destination)) {
		$sukses=false;
		sweetalert2($type="warning","Gagal. silahkan cek permission",backendurl("$modul"));
		return _MAYBEPERMISSION;
	}else{
	
	
	
	$alamat=filepath("temp/$filename");
	$objPHPExcel = PHPExcel_IOFactory::load($alamat);
	
	
	$dataArr = array();
	 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		 
		for ($row = 1; $row <= $highestRow; ++ $row) {
			$cell_name = $worksheet->getCellByColumnAndRow(4, $row);
			$name = $cell_name->getValue();
			if($name=='') {
				continue;
			}
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
		$sql_r=array();
		$idx=0;
		
		$val[0]=find_lembaga_jenis_by_nama($lembaga_jenis_by_nama,$val[0]); //jenis
		$val[5]=find_lembaga_jenjang_by_nama($lembaga_jenjang_by_nama,$val[5]); //jenjang
		$val[6]=find_status_by_nama($val[6]); //status
		$val[11]=find_kota_by_nama($kota_by_nama,$val[11]); //kota
		$val[15]=find_jenis_kelamin($val[15]); //find_jenis_kelamin

		foreach($field as $field_table => $label) {
			$sql_r[]="$field_table='".addslashes($val[$idx])."'";
			$idx++;
		}
		$sql_r[]="created_by='$admin_id'";
		$sql_r[]="created_at='$hari_ini'";

		$join_field=join(" , ",$sql_r);
		$q=$mysql->query("
		INSERT INTO lembaga SET 
			$join_field
		");
		//ON DUPLICATE KEY UPDATE 
		//	$join_field
		if($q){
			$success_input[]=cleanInput($val[4]);
		}else{
			//$sukses=false;
			$already_exist[]=cleanInput($val[4]);
		}
		
	}



	if(count($success_input)>1){
		$join_msg="<ul><li>".count($success_input)." Lembaga</li></ul>";		
	}else{
		$join_msg="<ul><li>".join("</li><li>",$already_exist)."</li></ul>";	
	}
	/*
	if(count($already_exist)>1){
		$join_msg.="<ul><li>".count($success_input)." Lembaga</li></ul>";		
	}else{
		$join_msg.="<ul><li>".join("</li><li>",$already_exist)."</li></ul>";	
	}
	*/

	if($sukses) {
		$mysql->commit();
		$mysql->autocommit(true);
		sweetalert2($type="success","Berhasil tambah lembaga $join_msg ",backendurl("$modul"));
	} else {
		$mysql->rollback();
		$mysql->autocommit(true);
		sweetalert2($type="warning","Gagal tambah lembaga $join_msg",backendurl("$modul"));
	}
	}	
}

if($action=="sinkronisasi_npsn_baru")
{
	$tr_sinkronisasi_data_baru='';
	$no=1;
	$q=$mysql->query("SELECT DISTINCT p.npsn,s.sekolah FROM personal p LEFT JOIN sekolah s ON s.npsn=p.npsn WHERE p.npsn NOT IN (SELECT npsn FROM lembaga WHERE LENGTH(npsn)>0) AND LENGTH(p.npsn)>0 ");
	if($q and $mysql->num_rows($q)>0) {
		while($d = $mysql->fetch_assoc($q)) {
			$url=backendurl("lembaga/add/?npsn=".$d['npsn']."&lembaga_jenis=2&from=sinkronisasi_npsn_baru");
			$edit=btn_custom($url,$icon="fa fa-plus",$cls_btn="btn-info",$title="Tambahkan");
			$tr_sinkronisasi_data_baru.='<tr><td>'.$no.'</td><td>'.$d['npsn'].'<td><td>'.$d['sekolah'].'<td><td>'.$edit.'</td></tr>';
			$no++;
		}
	} else {
		$tr_sinkronisasi_data_baru.='<tr><td colspan="4">Tidak ada data NPSN yang perlu disinkronkan</td></tr>';
	}
}

if($action=="last_personal") {
	$npsn=cleanInput($_GET['npsn']);
	$q=$mysql->query("SELECT * FROM personal WHERE npsn='$npsn' ORDER BY id DESC LIMIT 1 ");
	if($q and $mysql->num_rows($q)>0) {
		$d=$mysql->fetch_assoc($q);
		$d['success']=1;
	} else {
		$d['success']=0;
	}
	echo json_encode($d);
	die();
}

?>
