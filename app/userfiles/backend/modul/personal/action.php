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
		
$validation->set_validation(array('var'=>'npsn','label'=>'NPSN'))->minlength(8)->required();	
$validation->set_validation(array('var'=>'status_pekerjaan','label'=>'Status saat ini'))->minlength(1)->required();	
$validation->set_validation(array('var'=>'pic_nama_lengkap','label'=>'Nama Lengkap'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_nama_panggilan','label'=>'Nama Panggilan'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_kelamin','label'=>'Jenis Kelamin'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_whatsapp','label'=>'Whatsapp'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_email','label'=>'Email'))->minlength(1)->required()->email();
$validation->set_validation(array('var'=>'pic_tanggal_lahir','label'=>'Tanggal Lahir'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_agama','label'=>'Agama'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_jabatan','label'=>'Jabatan'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_tahun_menjabat','label'=>'Tahun Menjabat'))->minlength(1)->required();


$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	$valid=true;
	$mysql->autocommit(false);
	$id=$_POST['id'];
	$jadwal_id=$_POST['jadwal_id'];
	$_POST['lembaga_jenis']=2;//sekolah
	
	//$jenis=cleanInput($_POST['jenis']);
	//$_POST['harga']=cleanInput($_POST['harga'],'money');
	/*
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
	*/
	if($action=='update') {
		$is_lembaga_change=false;
		$npsn=cleanInput($_POST['npsn']);
		$lembaga_id=0;
		$q=$mysql->query("SELECT * FROM personal WHERE npsn='$npsn' AND id=$id ");
		if($q and $mysql->num_rows($q)>0) {
			$is_lembaga_change=true;
		}
	}
	
	$is_lembaga_exist=false;
	$npsn=cleanInput($_POST['npsn']);
	$lembaga_id=0;
	$q=$mysql->query("SELECT * FROM lembaga WHERE npsn='$npsn'");
	if($q and $mysql->num_rows($q)>0) {
		$lembaga_r=$mysql->fetch_assoc($q);
		$lembaga_id=$lembaga_r['id'];
		$is_lembaga_exist=true;
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
		//SIMPAN LEMBAGA START
		if(!$is_lembaga_exist) {
			$r_post=array(
				'lembaga_jenis',
				'npsn',
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

	
			$sql=" INSERT INTO lembaga SET ";		
			
			
		
			$r_sql[]="created_by='$admin_id'";
			$r_sql[]="created_at='$hari_ini'";

		
			$sql.=join(",",$r_sql);
			$q_insert_lembaga=$mysql->query($sql);
			if(!$q_insert_lembaga) {$valid=false;}
			else {
				$lembaga_id=$mysql->insert_id();
			}
		}
		
		//END SIMPAN LEMBAGA 
		
		//SIMPAN PERSONAL

		$sql_personal=array();
		$sql_personal[]="status_pekerjaan='".cleanInput($_POST['status_pekerjaan'])."'";
		$sql_personal[]="nama_lengkap='".cleanInput($_POST['pic_nama_lengkap'])."'";
		$sql_personal[]="nama_panggilan='".cleanInput($_POST['pic_nama_panggilan'])."'";
		$sql_personal[]="whatsapp='".cleanInput($_POST['pic_whatsapp'])."'";
		$sql_personal[]="email='".cleanInput($_POST['pic_email'])."'";
		$sql_personal[]="kelamin='".cleanInput($_POST['pic_kelamin'])."'";
		$sql_personal[]="tanggal_lahir='".cleanInput($_POST['pic_tanggal_lahir'])."'";
		$sql_personal[]="agama='".cleanInput($_POST['pic_agama'])."'";
		$sql_personal[]="jabatan='".cleanInput($_POST['pic_jabatan'])."'";
		$sql_personal[]="tahun_menjabat='".cleanInput($_POST['pic_tahun_menjabat'])."'";
		$sql_personal[]="lembaga_id='".$lembaga_id."'";
		$sql_personal[]="npsn='".cleanInput($_POST['npsn'])."'";

		if($action=="save") {
			$sql_personal[]="created_by='$admin_id'";
			$sql_personal[]="created_at='$hari_ini'";

		}
		
		if($action=="update") {
			$sql_personal[]="modified_by='$admin_id'";
			$sql_personal[]="modified_at='$hari_ini'";
		}
		
		if($action=="update") {
			$sql_personal_query=" UPDATE personal SET ";
		} else {
			$sql_personal_query=" INSERT INTO personal SET ";		
		}
		
		$sql_personal_query.=join(",",$sql_personal);
		
		if($action=="update") {
			$sql_personal_query.=" WHERE id=$id ";
		}
		$q_personal=$mysql->query($sql_personal_query);	
		
		
		//END SIMPAN PERSONAL
	} else {
		$valid=false;
	}
	


	if($q_personal){
		if($jadwal_id>0 and $action=='save') {
				$personal_id=$mysql->insert_id();
				$enroll_date=date("Y-m-d H:i:s");
				$enroll_to_jadwal=$mysql->query("REPLACE INTO jadwal_peserta SET jadwal_id=$jadwal_id,personal_id=$personal_id,created_at='$enroll_date'");
				if(!$enroll_to_jadwal) {
					$valid=false;
				}
		}
	}  else {
		$valid=false;
	}
	

	if($valid) {
		$mysql->commit();
		$mysql->autocommit(true);
		if($jadwal_id>0 and $action=='save') {
			sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Personal berhasil",backendurl("jadwal/peserta/$jadwal_id"));
		} else {
			sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Personal berhasil",backendurl("$modul"));
		}
	} else {
		$mysql->rollback();
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Personal gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add".($jadwal_id!=''?'?jadwal_id='.$jadwal_id:''))));
	}
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus personal berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="personal tidak bisa dihapus karena sudah terhubung dengan  transaksi",backendurl("$modul"));
	}
	
}

if($action=="check_npsn") {
	$npsn=cleanInput($_GET['npsn']);
	$is_lembaga_exist=0;
	$q_cek_lembaga=$mysql->query("SELECT * FROM lembaga WHERE npsn='$npsn' ");
	if($q_cek_lembaga and $mysql->num_rows($q_cek_lembaga)>0) {
		$is_lembaga_exist=1;
	}
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
		$output['is_lembaga_exist']=$is_lembaga_exist;
		echo json_encode($output, JSON_PRETTY_PRINT);

	} else {
		
		$wilayah=wilayah_nama($data['kabupaten_kota']);
		$output['is_lembaga_exist']=$is_lembaga_exist;
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
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				$dataArr[$row][$col] = $val;
			}
		}
	}
	unset($dataArr[1]);
	$already_exist=array();
	$problem_data=array();
	$success_input=array();
	$class=array();
	
	$npsn_r=array();
	foreach($dataArr as $val){
		$sql_r=array();
		$idx=0;
		
		/*
		$val[0]=find_lembaga_jenis_by_nama($lembaga_jenis_by_nama,$val[0]); //jenis
		$val[5]=find_lembaga_jenjang_by_nama($lembaga_jenjang_by_nama,$val[5]); //jenjang
		$val[6]=find_status_by_nama($val[6]); //status
		$val[11]=find_kota_by_nama($kota_by_nama,$val[11]); //kota
		*/
		if(strlen($val['5'])<=0 or strlen($val['6'])<=0) {
	
			$problem_data[]=$val[4]." Whatsapp atau email kosong";
;			continue;
		}
		$npsn_r[$val[0]]=1;
		$val[1]=find_pekerjaan_by_nama($val[1]); //find id pekerjaan
		$val[4]=find_jenis_kelamin($val[4]); //find_jenis_kelamin

		foreach($field as $field_table => $label) {
			$sql_r[]="$field_table='".$val[$idx]."'";
			$idx++;
		}
		$sql_r[]="created_by='$admin_id'";
		$sql_r[]="created_at='$hari_ini'";

		$join_field=join(" , ",$sql_r);
		$q=$mysql->query("
		INSERT INTO personal SET 
			$join_field
		");
		//ON DUPLICATE KEY UPDATE 
		//	$join_field
		if($q and $mysql->affected_rows()>0){
			$success_input[]=cleanInput($val[4]);
		}else{
			$sukses=false;
			$already_exist[]=cleanInput($val[4]);
		}
	}
	/*
	var_dump($success_input);
	echo '<hr/>';
	var_dump($problem_data);
	echo '<hr/>';
	var_dump($already_exist);
	die();
	*/

	//update lembaga berdasarkan npsn dari lembaga exist
	$update_lembaga_id=$mysql->query("
		UPDATE personal p LEFT JOIN lembaga l ON p.npsn=l.npsn  SET p.lembaga_id=l.id
	");
	
	
	//cari data npsn yang belum  belum terdaftar didatabase lembaga
	$npsn_belum_terdaftar=0;
	foreach($npsn_r as $npsn => $no) {
		$find_npsn=$mysql->query("SELECT id FROM lembaga WHERE npsn='$npsn' ");
		if(!$find_npsn OR $mysql->num_rows($find_npsn)<=0) {
			$npsn_belum_terdaftar++;
		}
		/*
		//next find data from api or database
		$lembaga_jenis=2;//sekolah
	
		$database_sekolah=$mysql->query("SELECT *  FROM sekolah where npsn='$npsn' ");
		if($cek_database_sekolah and $mysql->num_rows($cek_database_sekolah)) {
			$database_sekolah=$mysql->fetch_assoc($cek_database_sekolah);
			$lembaga_nama=find_kota_by_nama($kota_by_nama,$database_sekolah['sekolah']);
			$lembaga_kota=find_kota_by_nama($kota_by_nama,$database_sekolah['kabupaten_kota']);
			$lembaga_jenjang=find_lembaga_jenjang_by_nama($lembaga_jenjang_by_nama,$database_sekolah['bentuk']);
			$lembaga_status=find_status_by_nama($database_sekolah['status']); //status
			$lembaga_email=find_status_by_nama($database_sekolah['status']); //status
		} else {
			
		}
		$sql_lembaga_r=array();
		$sql_lembaga_r[]="lembaga_jenis='$lembaga_jenis'";
		$sql_lembaga_r[]="lembaga_status='$lembaga_status'";
		$sql_lembaga_r[]="npsn='$npsn'";
		$sql_lembaga_r[]="lembaga_nama='$lembaga_nama'";
		$sql_lembaga_r[]="lembaga_jenjang='$lembaga_jenjang'";
		$sql_lembaga_r[]="lembaga_alamat='$lembaga_alamat'";
		$sql_lembaga_r[]="lembaga_telp='$lembaga_telp'";
		$sql_lembaga_r[]="lembaga_email='$lembaga_email'";
		$sql_lembaga_r[]="lembaga_kota='$lembaga_kota'";
		$sql_lembaga_r[]="lembaga_website='$lembaga_website'";
		$sql_lembaga_r[]="lembaga_tahun_berdiri='$lembaga_tahun_berdiri'";
		$sql_lembaga_r[]="lembaga_ulang_tahun='$lembaga_ulang_tahun'";
		$sql_lembaga_r[]="lembaga_telp='$lembaga_telp'";
		$sql_lembaga_r[]="lembaga_telp='$lembaga_telp'";
		$sql_lembaga_join=join(",",$sql_lembaga_r);
		$sql_insert_lembaga="INSERT INTO lembaga SET ".$sql_lembaga_join;
		$insert_lembaga=$mysql->query($sql_insert_lembaga);
		$lembaga_id=$mysql->insert_id();
		if($lembaga_id>0) {
			$update_personal_lembaga_id=$mysql->query("UPDATE personal SET lembaga_id=$lembaga_id WHERE npsn='$npsn'");
		}
		*/
	}
	
	$join_msg="<ul>";
	if(count($success_input)) {
		$join_msg.="<li>Berhasil input ".count($success_input)." data personal</li>";		
	}  
	/*
	if(count($already_exist)) {
		$join_msg.="<li>".join("</li><li>",$already_exist)." duplikat</li>";	
	}
	if($npsn_belum_terdaftar>0) {
		$link_sinkronsisasi_npsn=backendurl('lembaga/sinkronisasi_npsn_baru');
		$join_msg.='<li>Ada $npsn_belum_terdaftar NPSN belum terdaftar di CRM Kuanta, Klik <a href="'.$link_sinkronsisasi_npsn.'">disini<a> untuk sinkronisasi data dengan API</li>';		
	}
	*/
	$join_msg.="</ul>";

	if(count($success_input) or count($already_exist)) {
		
		$mysql->commit();
		$mysql->autocommit(true);
		if(count($success_input)<=0 AND count($already_exist)>0 and $npsn_belum_terdaftar<=0)
		{
			sweetalert2($type="warning","Tidak ada data baru",backendurl("$modul"));
		}
		if(count($success_input)<=0 AND count($already_exist)>0 and $npsn_belum_terdaftar>0) {
			sweetalert2($type="warning","Tidak ada data personal baru, namun ada data NPSN yang perlu disinkronisasikan ",backendurl("lembaga/sinkronisasi_npsn_baru"));
		}
		sweetalert2($type="success","$join_msg",backendurl("$modul"),5000);
	} else {
		$mysql->rollback();
		$mysql->autocommit(true);
		sweetalert2($type="warning","Gagal tambah personal $join_msg",backendurl("$modul"));
	}

	
	}
	
	
}
?>
