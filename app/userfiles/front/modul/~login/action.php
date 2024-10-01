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
$validation->set_validation(array('var'=>'pic_whatsapp','label'=>'Whatsapp'))->minlength(1)->required();
$validation->set_validation(array('var'=>'pic_tanggal_lahir','label'=>'Tanggal Lahir'))->minlength(1)->required();


$validation->generate_js_validation();

if($action=="save") {
	$id=$_POST['id'];
	if(!$validation->valid()){
		sweetalert2($type="warning","Data login data tidak valid",fronturl("$modul/form/$id"));
		die();
	}

	//cek validasi apakah user sudah ada
	$npsn=cleanInput($_POST['npsn']);
	$pic_whatsapp=cleanInput($_POST['pic_whatsapp']);
	$pic_tanggal_lahir=cleanInput($_POST['pic_tanggal_lahir']);
	
	$is_registered=false;
	$q=$mysql->query("SELECT id FROM personal WHERE whatsapp='$pic_whatsapp' AND tanggal_lahir='$pic_tanggal_lahir' AND npsn='$npsn' ");
	if($q and $mysql->num_rows($q)<=0) {
		sweetalert2($type="warning","Maaf akun anda tidak ditemukan silakan cek data dengan benar",fronturl("$modul/form/$id"));
		die();
	} else {
		$is_registered=true;
		$r_personal=$mysql->fetch_assoc($q);
		$personal_id=$r_personal['id'];
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
	if($valid){

		if($jadwal_id>0 and $is_registered) {
		
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
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Login berhasil",fronturl("$modul/berhasil"));
		
	} else {
		$mysql->rollback();
		sweetalert2($type="warning","Login gagal",fronturl("$modul/form/$id"));
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
