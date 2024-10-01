<?php
/*
Catatan pakai yona-validation:
Form :
	Form menggunakan class yona-validation
	Tombol submit name=submit
Var  : nama element harus sama dengan var  
 * */
$hari_ini=date("Y-m-d H:i:s");
//$admin_id=$_SESSION['s_id'];
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

if($action=="save") {
	$id=$_POST['id'];
	if(!$validation->valid()){
		sweetalert2($type="warning","Registrasi gagal data tidak valid",fronturl("$modul/form/$id"));
		die();
	}
	//cek validasi apakah user sudah ada
	$pic_whatsapp=cleanInput($_POST['pic_whatsapp']);
	$pic_email=cleanInput($_POST['pic_email']);
	
	$q=$mysql->query("SELECT id FROM personal WHERE whatsapp='$pic_whatsapp' OR email='$pic_email' ");
	if($q and $mysql->num_rows($q)>0) {
		sweetalert2($type="warning","Maaf akun anda sudah terdaftar silakan login",fronturl("$modul/form/$id"));
		die();
	}
	

	$valid=true;
	$mysql->autocommit(false);

	$r=$mysql->query("SELECT * from jadwal where concat(md5(concat(kegiatan_id,'G')),'-',md5(concat(id,'G')))='$id' AND status_selesai=0 ");
	if($r and $mysql->num_rows($r)>0) {

	} else {
		//redirect to page link broken
		sweetalert2($type="warning","Link broken",fronturl("$modul/form/$id"));
		die();
	}
	$jadwal=$mysql->assoc($r);

	
	$jadwal_id=$jadwal['id'];
	$kegiatan_id=$jadwal['kegiatan_id'];
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
	if($action=='save') {
			$is_lembaga_exist=false;
			$npsn=cleanInput($_POST['npsn']);
			$lembaga_id=0;
			$q=$mysql->query("SELECT * FROM lembaga WHERE npsn='$npsn'");
			if($q and $mysql->num_rows($q)>0) {
				$lembaga_r=$mysql->fetch_assoc($q);
				$lembaga_id=$lembaga_r['id'];
				$is_lembaga_exist=true;
			}
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
			
			/*
			if($_POST['password']!='') {
				$password_hash=md5("balda_".$_POST['password']);
				$r_sql[]="password = '$password_hash'";
			}
			*/

			if($action=="update") {
				$sql=" UPDATE lembaga SET ";
			} else {
				$sql=" INSERT INTO lembaga SET ";		
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
			sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Personal berhasil",fronturl("$modul/berhasil"));
		} else {
			sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Personal berhasil",fronturl("$modul/berhasil"));
		}
	} else {
		$mysql->rollback();
		sweetalert2($type="warning","Registraasi gagal",fronturl("$modul/$id"));
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


?>
