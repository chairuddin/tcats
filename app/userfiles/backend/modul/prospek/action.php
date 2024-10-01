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
		

$validation->set_validation(array('var'=>'produk_id','label'=>'Produk'))->required();
//$validation->set_validation(array('var'=>'hp','label'=>'HP'))->minlength(8)->required();
//$validation->set_validation(array('var'=>'alamat','label'=>'Alamat'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kecamatan','label'=>'kecamatan'))->minlength(1)->required();
//$validation->set_validation(array('var'=>'kota','label'=>'kota'))->minlength(1)->required();

$validation->generate_js_validation();
if($action=="save" or $action=="update") {
	
	$id=$_POST['id'];
	//$jenis=cleanInput($_POST['jenis']);
	//$_POST['harga']=cleanInput($_POST['harga'],'money');
	$_POST['target_deal']=dmy_to_ymd($_POST['target_deal']);
	$peluang_tercipta=join(",",$_POST['peluang_tercipta']);

	if($action=="save") {
		$prefik="PR".date("m")."";
		$panjang_kode=strlen($prefik);
		$max_id=$mysql->get1value(" select max(substring(kode,".($panjang_kode+1).")+0) max_id from prospek WHERE left(kode,$panjang_kode)='$prefik' ")+1;
		$_POST['kode']=$prefik.str_pad($max_id,3,"0",STR_PAD_LEFT);
	}
	

	$r_sql=array();
	if($validation->valid()){
				
		$r_post=array(
			'target_deal',
			'produk_id',
			'keterangan',
		);
		if($action=='save') {
			$r_post[]='kode';
		}
		
		foreach($r_post as $i => $v) {
			$post=cleanInput($_POST[$v]);
			$r_sql[]="$v = '$post'";
		}
		$r_sql[]="peluang_tercipta='$peluang_tercipta'";
		/*
		if($_POST['password']!='') {
			$password_hash=md5("balda_".$_POST['password']);
			$r_sql[]="password = '$password_hash'";
		}
		*/

		if($action=="update") {
			$sql=" UPDATE $table SET ";
		} else {
			$sql=" INSERT INTO $table SET ";		
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
		
		if($action=="save") {
			$id=$mysql->insert_id();
		}
		

		
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Prospek gagal, data tidak valid",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	if($q){
		sweetalert2($type="success",$msg=($action=="update"?"Update":"Tambah")." Prospek berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg=($action=="update"?"Update":"Tambah")." Prospek gagal. ",backendurl("$modul".($action=="update"?"/edit/$id":"/add")));
	}
	
	
}
if($action=="del")
{
$id=cleanInput($id,'numeric');

$sql="DELETE FROM $modul WHERE id='$id' ";
$r=$mysql->query($sql);

	if($r){
		sweetalert2($type="success",$msg="Hapus Prospek berhasil",backendurl("$modul"));
	} else {
		sweetalert2($type="warning",$msg="Prospek tidak bisa dihapus karena ada list customer",backendurl("$modul"));
	}
	
}

if($action=='add_prospek') {
	$raw=file_get_contents('php://input');
	$_POST=json_decode($raw,true);
	$lembaga_id=$_POST['lembaga_id'];
	$prospek_id=$_POST['prospek_id'];
	$hari_ini=date("Y-m-d H:i:s");
	$admin_id=$_SESSION['s_id'];
	$insert=$mysql->query(" INSERT INTO prospek_list SET prospek_id=$prospek_id,lembaga_id=$lembaga_id,created_at='$hari_ini',created_by='$admin_id' ON duplicate key update  prospek_id=$prospek_id ,lembaga_id=$lembaga_id  ");
	if($insert) {
		$response=array('success'=>1,'msg'=>'Berhasil');
	} else {
		$response=array('success'=>0,'msg'=>'Gagal');
	}
	echo json_encode($response);
	die();
}
if($action=='remove_prospek') {
	$raw=file_get_contents('php://input');
	$_POST=json_decode($raw,true);
	$lembaga_id=$_POST['lembaga_id'];
	$prospek_id=$_POST['prospek_id'];
	$insert=$mysql->query(" DELETE FROM prospek_list WHERE  prospek_id=$prospek_id AND lembaga_id=$lembaga_id ");
	if($insert) {
		$response=array('success'=>1,'msg'=>'Berhasil');
	} else {
		$response=array('success'=>0,'msg'=>'Gagal');
	}
	echo json_encode($response);
	die();
}
if($action=='history') {
	$id=cleanInput($id);
	$q=$mysql->query("SELECT p.id,u.nickname sales,pl.id,pl.status,pl.catatan,date_format(pl.last_fu,'%Y-%m-%d') last_fu,pl.next_fu,pr.nama produk_nama FROM prospek_list pl 
	INNER JOIN prospek p ON p.id=pl.prospek_id 
	LEFT JOIN produk pr ON pr.id=p.produk_id
	LEFT JOIN user u on u.id=p.created_by
	WHERE pl.lembaga_id=$id
	ORDER BY pl.last_fu DESC
	");
	if($q and $mysql->num_rows($q)) {
		echo '<div class="table-responsive">';
		echo '<table class="table table-striped">';
		echo '<tr>
		<th style="font-size:10pt;">No</th>
		<th style="font-size:10pt;">Produk</th>
		<th style="font-size:10pt;">Tanggal</th>
		<th style="font-size:10pt;">Catatan</th>
		<th style="font-size:10pt;">Status</th>
		<th style="font-size:10pt;">Sales</th>
		</tr>';
		$no=1;
		while($d=$mysql->fetch_assoc($q)) {
		echo '	<tr>
				<td style="font-size:10pt;">'.$no.'</td>
				<td style="font-size:10pt;text-align:left;">'.$d['produk_nama'].'</td>
				<td style="font-size:10pt;">'.($d['last_fu']!='0000-00-00'?tgl_indo_short($d['last_fu']):'').'</td>
				<td style="font-size:10pt;">'.$d['catatan'].'</td>
				<td style="font-size:10pt;">'.badge_color($d['status']).'</td>
				<td style="font-size:10pt;">'.$d['sales'].'</td>
				</tr> ';
				$no++;
		}
		echo '</table>';
		echo '</div>';
	} else {
		echo 'Tidak ada riwayat penawaran';
	}
	
	die();
}
?>
