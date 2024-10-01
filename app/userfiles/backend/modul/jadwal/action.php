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
	/*
	
array(6) {
  ["produk_id"]=>
  string(1) "8"
  ["kegiatan_jenis_id"]=>
  string(1) "3"
  ["jumlah_peserta"]=>
  string(2) "22"
  ["tanggal_mulai"]=>
  string(10) "2023-11-10"
  ["tanggal_selesai"]=>
  string(10) "2023-11-11"
  ["schedule"]=>
  array(2) {
    [2]=>
    array(4) {
      ["date"]=>
      string(10) "2023-11-10"
      ["start_time"]=>
      string(5) "10:00"
      ["end_time"]=>
      string(5) "22:00"
      ["coaches"]=>
      array(1) {
        [0]=>
        string(1) "6"
      }
    }
    [3]=>
    array(4) {
      ["date"]=>
      string(10) "2023-11-11"
      ["start_time"]=>
      string(5) "10:00"
      ["end_time"]=>
      string(5) "20:22"
      ["coaches"]=>
      array(1) {
        [0]=>
        string(1) "7"
      }
    }
  }
}	
	*/


	
	$kegiatan_id=$_POST['kegiatan_id']=$_REQUEST['kegiatan_id'];
	$_POST['kegiatan_judul']=$mysql->get1value("SELECT nama FROM produk WHERE id='".$_POST['produk_id']."'");
	$id=cleanInput($_REQUEST['id']);
	$r_sql=array();
	
				
		$r_post=array(
			'kegiatan_id',
			'kegiatan_judul',
			'kegiatan_jenis_id',
			'jumlah_peserta',
			'produk_id',
			'tanggal_mulai',
			'tanggal_selesai'
		);
		
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
		} else {
			$jadwal_id=$id;
			$hapus_coach=$mysql->query(" DELETE FROM jadwal_harian WHERE  jadwal_id=$jadwal_id ");
		}
		if(count($_POST['schedule'])>0) {

					/*
					["date"]=>
					string(10) "2023-11-11"
					["start_time"]=>
					string(5) "10:00"
					["end_time"]=>
					string(5) "20:22"
					["coaches"]=>
					array(1) {
					[0]=>
					string(1) "7"
					}
					*/
					
					foreach($_POST['schedule'] as $i =>$val) {
						$tanggal=$val['tanggal'];
						$jam_mulai=$tanggal." ".$val['jam_mulai'];
						$jam_selesai=$tanggal." ".$val['jam_selesai'];
						
						$q_jadwal=$mysql->query("INSERT INTO jadwal_harian SET jadwal_id=$jadwal_id,jam_mulai='$jam_mulai',jam_selesai='$jam_selesai'");
					//	echo "INSERT INTO jadwal_harian SET jadwal_id=$jadwal_id,jam_mulai='$jam_mulai',jam_selesai='$jam_selesai'<br/>";
						$jadwal_harian_id=$mysql->insert_id();
						
		
						$coaches=$val['coaches'];
						foreach($coaches as $coach_id) {
						//	echo "INSERT INTO jadwal_coach SET jadwal_harian_id=$jadwal_harian_id,coach_id=$coach_id <br/>";
							$q_coach=$mysql->query("INSERT INTO jadwal_coach SET jadwal_harian_id=$jadwal_harian_id,coach_id=$coach_id");
						}
					} 
		}
		//die('a');
		/*
		$clear=$mysql->query("DELETE FROM jadwal_coach WHERE jadwal_id=$jadwal_id ");
		for($i=0;$i<count($coach);$i++) {
			if($coach[$i]!=="") {
				$mysql->query("INSERT INTO jadwal_coach SET jadwal_id=$jadwal_id,coach_id=".$coach[$i]);
			}
		}
		*/
		
	
	$response=array();
	if($q){
		//$response=array('success'=>1,'msg'=>'Sukses');
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Jadwal berhasil",backendurl("$modul/list?kegiatan_id=$kegiatan_id"));
	} else {
		//$response=array('success'=>0,'msg'=>'Gagal');
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Jadwal gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")."?kegiatan_id=$kegiatan_id"));
	}
//	echo json_encode($response);
	die();
	
}

/**SAVE FROM AJAX POPUP 
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
 * END SAVE FROM AJAX POPUP */
if($action=="del")
{
$id=cleanInput($id,'numeric');
$kegiatan_id=$mysql->get1value("SELECT kegiatan_id FROM jadwal WHERE id=$id");
$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus jadwal berhasil",backendurl("jadwal/list/?kegiatan_id=$kegiatan_id"));
	} else {
		sweetalert2($type="warning",$msg="Jadwal tidak bisa dihapus karena sudah ada peserta yang terdaftar.",backendurl("jadwal/list/?kegiatan_id=$kegiatan_id"));
	}
	
}

if($action=="load") {
	$kegiatan_id=$_GET['kegiatan_id'];
	$jadwal_terakhir=date("Y-m-d",strtotime("-12 Months"));
	$q=$mysql->query(" SELECT j.kegiatan_judul,k.kode,j.kegiatan_id,k.produk_id,jh.jam_mulai,jh.jam_selesai FROM jadwal_harian jh 
	INNER JOIN jadwal j ON j.id=jh.jadwal_id 
	INNER JOIN kegiatan k ON k.id=j.kegiatan_id
	WHERE DATE_FORMAT(jh.jam_mulai,'Y-m-d')>'$jadwal_terakhir'");
	$events=array();
	if($q and $mysql->num_rows($q)>0) {
		while($d=$mysql->fetch_assoc($q)) {
			$coach=array();
			$q_coach=$mysql->query("SELECT coach_id FROM jadwal_coach WHERE jadwal_harian_id=".$d['jadwal_harian_id']);
			if($q_coach and $mysql->num_rows($q_coach)>0 ) {
				while($d_coach=$mysql->fetch_assoc($q_coach)) {
					$coach[]=$d_coach['coach_id'];
				}
			}
			/*
			$disabled=1;
			$bg='bg-warning';
			if($d['kegiatan_id']==$kegiatan_id) {
				$disabled=0;
				$bg='bg-success';
			}
			*/
			$bg='bg-success';
			$event = [
				'id' => $d['id'],
				'title' => $d['kode']."-".$d['kegiatan_judul'],
				'start' => $d['jam_mulai'],
				'end' => $d['jam_selesai'],
				'className'=>$bg,
				'color'=> '#000000',
				'jadwal_id' => $d['id'],
				'kegiatan_id' =>$d['kegiatan_id'],
				'produk_id'=>$d['produk_id'],
				'waktu_mulai' => $d['jam_mulai'],
				'waktu_selesai' => $d['jam_selesai'],
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

if($action=="selesai_update") {
	
	$id=$_POST['id'];
	$kegiatan_id=$mysql->get1value("SELECT kegiatan_id FROM jadwal WHERE id=$id");

	$r_sql=array();
	
				
	$r_post=array(
		'status_jumlah_peserta',
		'status_selesai',
		'status_laporan',
		'status_sertifikat'
	);
	
	foreach($r_post as $i => $v) {
		$post=cleanInput($_POST[$v]);
		$r_sql[]="$v = '$post'";
	}
	

	$sql=" UPDATE jadwal SET ";
	
	$r_sql[]="modified_by='$admin_id'";
	$r_sql[]="modified_at='$hari_ini'";
	
	
	
	$sql.=join(",",$r_sql);
	
	$sql.=" WHERE id=$id ";
	
	$q=$mysql->query($sql);
	

	
	if($q){
		sweetalert2($type="success",$msg=($action=="selesai_update"?"Update Status":"Tambah")." jadwal berhasil",backendurl("jadwal/list/?kegiatan_id=$kegiatan_id"));
	} else {
		sweetalert2($type="warning",$msg=($action=="selesai_update"?"Update Status":"Tambah")." jadwal gagal. ",backendurl("jadwal/list/?kegiatan_id=$kegiatan_id"));
	}
	
	
}
if($action=='get_personal_id') {
	$keyword=cleanInput($_GET['q']);
	
	$data=find_personal($keyword);
	$yourData = array();
	if(count($data)>0) {
		foreach($data as $i =>$personal) {
			$yourData[] = ['id' => $personal['id'], 'text' => $personal['whatsapp']."-". $personal['nama_lengkap']."-".$personal['lembaga_nama']];
		}
	}
	
	// Return the data as JSON
	header('Content-Type: application/json');
	echo json_encode($yourData);
	die();
}

if($action=='peserta') {
	$jadwal_id=$id;
	$personal_id=cleanInput($_POST['personal_id']);
	if($personal_id!="" AND $jadwal_id!="") {
		$enroll_date=date("Y-m-d H:i:s");
		$enroll_to_jadwal=$mysql->query("REPLACE INTO jadwal_peserta SET jadwal_id=$jadwal_id,personal_id=$personal_id,created_at='$enroll_date'");
		sweetalert2($type="success"," Tambah peserta berhasil",backendurl("jadwal/peserta/$jadwal_id"));
	}
}
if($action=='hapus_kepesertaan') {
	$jadwal_id=cleanInput($_GET['jadwal_id']);
	$personal_id=cleanInput($_GET['personal_id']);
	if($personal_id!="" AND $jadwal_id!="") {

		$hapus_peserta=$mysql->query("DELETE FROM  jadwal_peserta WHERE jadwal_id=$jadwal_id AND personal_id=$personal_id");
		sweetalert2($type="success"," Hapus kepesertaaan berhasil",backendurl("jadwal/peserta/$jadwal_id"));
	}
}
?>
