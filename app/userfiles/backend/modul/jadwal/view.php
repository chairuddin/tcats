<?php

if($action=="add" or $action=="edit")
{
$r_option_coach=array();

$q=$mysql->query("SELECT id,nama FROM coach ORDER BY nama ");
if($q and $mysql->num_rows($q)>0) {
	while($d=$mysql->fetch_assoc($q)) {
		$r_option_coach[$d['id']]=$d['nama'];
	}
}

if($action=='edit') {
	list($jadwal)=$mysql->query_data("SELECT * FROM jadwal WHERE id=$id");
	$kegiatan_id=$jadwal['kegiatan_id'];
	$kegiatan_nama=$mysql->get1value(" SELECT nama FROM produk WHERE id IN (SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id)");	
	$parent_id=$mysql->get1value(" SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id ");	
	$is_paket=$mysql->get1value(" SELECT is_paket FROM produk WHERE id=$parent_id ");

	$jadwal_body='';
	$harian_q=$mysql->query("SELECT * FROM jadwal_harian WHERE jadwal_id=".$id);
	if($harian_q && $mysql->num_rows($harian_q)) {
		$dayIndex=2;
		while($harian_d = $mysql->fetch_assoc($harian_q)) {
			$tanggal=date("Y-m-d",strtotime($harian_d['jam_mulai']));
			$jam_mulai=date("H:i",strtotime($harian_d['jam_mulai']));
			$jam_selesai=date("H:i",strtotime($harian_d['jam_selesai']));

			$coach_terpilih=array();
			$coach_terpilih_q= $mysql->query("SELECT coach_id FROM jadwal_coach WHERE jadwal_harian_id=".$harian_d['id']);
			if($coach_terpilih_q and $mysql->num_rows($coach_terpilih_q)>0) {
				while($coach_terpilih_d = $mysql->fetch_assoc($coach_terpilih_q)) {
					$coach_terpilih[]=$coach_terpilih_d['coach_id'];
				}
			}


			$option_coach='';
			foreach($r_option_coach as $coach_id =>$coach_nama) {
				$selected = in_array($coach_id,$coach_terpilih)?'selected="selected"':'';
				$option_coach .='<option value="'.$coach_id.'" '.$selected.'>'.$coach_nama.'</option>';
			}

			$jadwal_body.='
			<tr>
			<td>'.($dayIndex-1).'</td>
			<td><input type="date" class="form-control" id="day'.$dayIndex.'Date" name="schedule['.$dayIndex.'][tanggal]" required value="'.$tanggal.'"></td>
			<td><input type="time"  class="form-control" id="day'.$dayIndex.'StartTime" name="schedule['.$dayIndex.'][jam_mulai]" required value="'.$jam_mulai.'">`</td>
			<td><input type="time"  class="form-control" id="day'.$dayIndex.'EndTime" name="schedule['.$dayIndex.'][jam_selesai]" required value="'.$jam_selesai.'">`</td>
			<td><select id="day'.$dayIndex.'Coaches" name="schedule['.$dayIndex.'][coaches][]" multiple class="js-select2 form-control">'.$option_coach.'</select></td>
			</tr>
			';
			$dayIndex++;	
		}
	}
} else {
	$kegiatan_id=cleanInput($_GET['kegiatan_id']);
	$kegiatan_nama=$mysql->get1value(" SELECT nama FROM produk WHERE id IN (SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id)");	
	$parent_id=$mysql->get1value(" SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id ");	
	$is_paket=$mysql->get1value(" SELECT is_paket FROM produk WHERE id=$parent_id ");	

}

if($is_paket) {
	$kondisi=" WHERE id IN (SELECT produk_id FROM produk_paket WHERE parent_id=$parent_id) ";
} else {
	$kondisi=" WHERE id=".$parent_id;	
}

$option_produk="";
	
$q=$mysql->query("SELECT id,nama FROM produk $kondisi ORDER BY nama ");
if($q and $mysql->num_rows($q)>0) {
	if($mysql->num_rows($q)>1) {
		$option_produk.='<option value="">Pilih Produk</option>';
	}
	while($d=$mysql->fetch_assoc($q)) {
		$selected=($action=='edit' and $jadwal['produk_id']==$d['id'])?'selected="selected"':''; 
		$option_produk.='<option value="'.$d['id'].'" '.$selected.'>'.$d['nama'].'</option>';
	}
}

$list_kegiatan_jenis=list_kegiatan_jenis();

$option_kegiatan_jenis='<option value="">Pilih Jenis Kegiatan</option>';
foreach($list_kegiatan_jenis as $jenis_id => $val) {
	$selected=($action=='edit' and $jadwal['kegitan_jenis_id']==$d['id'])?'selected="selected"':''; 
	$option_kegiatan_jenis.='<option value="'.$jenis_id.'" '.$selected.'>'.$val.'</option>';
}

$action_save=backendurl("$modul/".($action=='add'?'save':'update'));
echo <<<END
<div class="card">
<div class="card-body">
<h4>Jadwalkan Kegiatan</h4>
<form id="eventForm" method="post" action="$action_save">
	<input type="hidden" name="id" value="$id" />
	<input type="hidden" name="kegiatan_id" value="$kegiatan_id" />
	<div class="form-group row">
		<label class="col-lg-2 col-form-label" for="produk_id">Kegiatan</label>
		<div class="col-lg-4">
			<select name="produk_id" class="form-control" id="produk_id">$option_produk</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label" for="kegiatan_jenis_id">Jenis Kegiatan</label>
		<div class="col-lg-4">
			<select name="kegiatan_jenis_id" class="form-control" id="kegiatan_jenis_id">$option_kegiatan_jenis</select>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2 col-form-label" for="jumlah_peserta">Jumlah Peserta</label>
		<div class="col-lg-4">
			<input type="number" class="form-control" name="jumlah_peserta" value="$jadwal[jumlah_peserta]">
		</div>
	</div>

	

	<h5>Jadwal Perhari:</h5>
	<table id="scheduleContainer" class="table" border="0" cellpadding="5" cellspacing="0">
		<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Coach</th>	
		</tr>
		$jadwal_body
	</table>
	<button type="button" onclick="addDay()" class="btn btn-default">(+) Tambah Hari</button><br>
	<div class="mt-5">&nbsp;</div>
	<button type="submit" class="btn btn-success">Simpan</button>
</form>
</div>
</div>
END;
}

if($action=="data") {
	
	$column_order = array('b.id','l.lembaga_nama');
	$column_search = array('l.lembaga_nama');
	$order = array('b.id' => 'DESC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.id DESC";
	}
	if ($_POST['length'] != -1 AND $_POST['length']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['length']}";
	}
	$i = 0;
	$sql_search=array();
	foreach ($column_search as $item) { // loop column 
		
		if($_POST['search']['value']) { // if datatable send POST for search
			
			$sql_search[]= " $item LIKE '%{$_POST['search']['value']}%' ";
		}
		$i++;
	}
	
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	
	$sql=" SELECT b.id,l.lembaga_nama,p.nama produk_nama
	FROM $modul b 
	LEFT JOIN lembaga l ON l.id=b.lembaga_id
	LEFT JOIN produk p ON p.id=b.produk_id
	
	 ";
	$sql.=" WHERE 1=1 ";

	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	
	$data = array();
	
	
	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		
		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['lembaga_nama'];
		$row[]=$d['produk_nama'];
		$row[]='<a  title="Tambah Jadwal" href="'.backendurl("jadwal/add/?kegiatan_id=".$d['id']).'"><i class="fa fa-calendar" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_edit='';
		if($daftar_hak[$modul]['edit']==1) {
			$action_edit='<a  title="Edit Jenis" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		}
	
		if($daftar_hak[$modul]['del']==1 ) {
		
			$action_delete=btn_delete_swal(backendurl("$modul/del/".$d['id']));
		}
		$row[]=$action_jadwal.$action_add.$action_edit.$action_delete;
		
		$data[] = $row;
	}
	
	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $total,
		"recordsFiltered" => $total,
		"data" => $data
	);
	die(json_encode($output));
}

if($action=="get_lembaga") {
	$query=cleanInput($_GET['term']);

	if($query!="") {
		$r_query = explode(" ",$query);
		$r_search=array();
		$r_poin=array();
		$r_keyword=array();
		$poin=0;
		foreach ( $r_query as $i => $keyword) {
			$poin++;
			$r_keyword[]=$keyword;
			$join_keyword=join(" ",$r_keyword);
			$r_search[]=" ( lembaga_nama like '%$join_keyword%' ) ";
			$r_poin[]="  IF(lembaga_nama like '%$join_keyword%',$poin,0)  "	;
			$r_search[]=" ( npsn like '%$join_keyword%' ) ";
			$r_poin[]="  IF(npsn like '%$join_keyword%',$poin,0)  "	;
			$r_search[]=" ( npyp like '%$join_keyword%' ) ";
			$r_poin[]="  IF(npyp like '%$join_keyword%',$poin,0)  "	;
			$r_search[]=" ( kode like '%$join_keyword%' ) ";
			$r_poin[]="  IF(kode like '%$join_keyword%',$poin,0)  "	;
		}
		$join_poin="(".join(" + ",$r_poin).") poin";
		$join_search="(".join(" or ",$r_search).") ";
		
		$sql=" SELECT * FROM (SELECT id,lembaga_nama,npsn,npyp,kode,$join_poin FROM lembaga WHERE $join_search ) x ORDER BY x.poin desc ";
		$q=$mysql->query($sql);
		$data=array();
		if($q and $mysql->num_rows($q)>0) {
			while($d=$mysql->fetch_assoc($q)){
			  $data[]=array('id'=>$d['id'],'text'=>$d['lembaga_nama']);
			}
		}
	}

echo json_encode($data);
die();
}
if($action=="list") {
$kegiatan_id=cleanInput($_GET['kegiatan_id']);

$kegiatan_nama=$mysql->get1value(" SELECT nama FROM produk WHERE id IN (SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id)");	
$kegiatan_kode=$mysql->get1value(" SELECT kode FROM kegiatan WHERE id=$kegiatan_id ");
$parent_id=$mysql->get1value(" SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id ");	
$is_paket=$mysql->get1value(" SELECT is_paket FROM produk WHERE id=$parent_id ");	

	if($is_paket) {
		$kondisi=" WHERE id IN (SELECT produk_id FROM produk_paket WHERE parent_id=$parent_id) ";
	} else {
		$kondisi=" WHERE id=".$parent_id;	
	}
	
	$option_produk="";
	
	$q=$mysql->query("SELECT id,nama FROM produk $kondisi ORDER BY nama ");
	if($q and $mysql->num_rows($q)>0) {
		if($mysql->num_rows($q)>1) {
			$option_produk.='<option value="">Pilih Produk</option>';
		}
		while($d=$mysql->fetch_assoc($q)) {
			$option_produk.='<option value="'.$d['id'].'">'.$d['nama'].'</option>';
		}
	}

	$r_option_coach=array();
	
	$q=$mysql->query("SELECT id,nama FROM coach ORDER BY nama ");
	if($q and $mysql->num_rows($q)>0) {
		while($d=$mysql->fetch_assoc($q)) {
			$r_option_coach[$d['id']]=$d['nama'];
		}
	}

	$tr_coach='';
	for($i=1;$i<=5;$i++) {
		$select_coach='<select name="coach[]" class="form-control m-b-4" id="coach_'.$id.'">';
		$select_coach.='<option value="">Pilih Coach</option>';
		foreach($r_option_coach as $coach_id =>$coach_nama) {
			$select_coach.='<option value="'.$coach_id.'">'.$coach_nama.'</option>';
		}
		$select_coach.='</select> ';

		$tr_coach.='<tr class="p-b-5"><td>Coach '.$i.'</td><td>'.$select_coach.'</td></tr>';
	}

	
$ringkasan_view=ringkasan_view($kegiatan_id);
$btn_tambah=button_add("$modul/add?kegiatan_id=$kegiatan_id");
echo <<<END

    <div class="card">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-title">[$kegiatan_kode] $kegiatan_nama</h3>
				<div class="float-right">$btn_tambah</div>
			</div>
		</div>
		<div class="card-body">
		
			<div class="col-md-12">

			<!--
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEventModal">
				Tambah Jadwal
			</button>
			-->
			<!-- <div id="calendar"></div> -->
			<br/>
			<br/>

			<div id="ringkasan_jadwal">$ringkasan_view</div>
			
				<div id="createEventModal" class="modal" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Tambah Jadwal</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="createEventForm">
						<input type="hidden" name="kegiatan_id" id="kegiatan_id" value="$kegiatan_id" />	
						<input type="hidden" name="jadwal_id" id="jadwal_id" value="" />	
						<div class="form-group">
							<label for="kegiatan_judul">Kegiatan</label>
							<select class="form-control" id="produk_id" name="produk_id" required>$option_produk</select>
						</div>
						<div class="form-group">
							<label for="eventStart">Event Start</label>
							<input type="datetime-local" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
						</div>
						<div class="form-group">
							<label for="eventEnd">Event End</label>
							<input type="datetime-local" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
						</div>
						<div class="form-group">
							<label for="eventEnd">Coach</label>
							<div>
									<table class="table">
									$tr_coach
									</table>
							</div>
						</div>
						

						<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

END;

}

if($action=="selesai")
{

$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$do_action=backendurl("$modul/".($action=="selesai"?"selesai_update":"selesai_update"));
$label_action=$action=="selesai"?"Selesai":"Selesai";

$option_selesai=option_selesai();


$option_laporan=option_laporan();


$option_sertifikat=option_sertifikat();


/*
$option_coach=array();
$option_coach['']="Pilih";
$q=$mysql->query("SELECT id,nama FROM coach  ORDER BY nama ");
if($q and $mysql->num_rows($q)>0) {
	while($d=$mysql->fetch_assoc($q)) {
		$option_coach[$d['id']]=$d['nama'];
	}
}
*/

/*
  <div class="form-group row">
					$form_coach
	</div>

 <div class="form-group row">
					$form_tanggal_mulai
				  </div>	
                  <div class="form-group row">
                   	$form_tanggal_selesai
                  </div>	

*/

$form_jumlah_peserta=$form->element_Textbox("Jumlah Peserta","status_jumlah_peserta",array(),$mode=array('label'=>2,'input'=>3));
$form_status_selesai=$form->element_Select("Status Kegiatan","status_selesai",$option_selesai,array(),$mode=array('label'=>2,'input'=>3));
$form_status_laporan=$form->element_Select("Status Laporan","status_laporan",$option_laporan,array(),$mode=array('label'=>2,'input'=>3));
$form_status_sertifikat=$form->element_Select("Status Sertifikat","status_sertifikat",$option_sertifikat,array(),$mode=array('label'=>2,'input'=>3));

$do_action=backendurl("$modul/".($action=="selesai"?"selesai_update":"selesai_update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kegiatan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
			
				<div class="form-group row">
					$form_status_selesai
				</div> 
				<div class="form-group row">
					$form_status_laporan
				</div>
				<div class="form-group row">
					$form_status_sertifikat
				</div>
				<div class="form-group row">
					$form_jumlah_peserta
				</div

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
					
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;

}

if($action=="peserta") {
	$kegiatan_id=$mysql->get1value("SELECT kegiatan_id FROM jadwal WHERE id=$id");
	$tabel_list_peserta=tabel_list_peserta($id);
	$info_jadwal=$mysql->get1value("SELECT kegiatan_judul FROM jadwal WHERE id=$id");
	$link_input_peserta=backendurl("personal/add/?jadwal_id=$id");
	$bagikan_link=fronturl("registrasi/form/".md5($kegiatan_id."G")."-".md5($id."G"));
	echo <<<END
  <div class="card card-primary">
			
				<div class="card-header">
					<h3 class="card-title">Daftar Peserta $info_jadwal</h3>
				
				</div>
                <div class="card-body">
					<form method="post" action="" >
					<h5>Cari dari database personal</h5>
					<div class="form-group row mb-30">
						<label class="col-lg-3 col-form-label" for="personal_id">Cari Nama/ Nomor HP dari database</label>
						<div class="col-lg-3">
							<select name="personal_id" id="personal_id" class="form-control"></select>
						</div>
						<div class="col-lg-2">
							<button type="submit" name="btn_tambah" id="btn_tambah" class="form-control btn btn-success">Tambahkan</button>
						</div>
					</div>	
					</form>
					<hr/>
					<h5>Belum terdaftar</h5>
					<div class="form-group row mb-30">
						<label class="col-lg-3 col-form-label" for="personal_id">Peserta belum terdaftar </label>
						<div class="col-lg-3">
						
						</div>
						<div class="col-lg-2">
							<a href="$link_input_peserta"><button type="button" name="btn_tambah" id="btn_tambah" class="form-control btn btn-success">Baru</button></a>
						</div>
					</div>	
					<hr/>
					<h5>Bagikan link</h5>
					<div class="form-group row mb-30">
						<label class="col-lg-3 col-form-label" for="personal_id">Bagikan link kepada peserta untuk input secara mandiri </label>
						<div class="col-lg-3">
						<input type="text" name="bagikan_link" id="bagikan_link" value="$bagikan_link" />
						<p id="copyMessage"></p>
						</div>
						<div class="col-lg-2">
							<button type="button" onclick="copyToClipboard()" name="btn_tambah" id="btn_tambah" class="form-control btn btn-success">Copy Link</button>
						
						</div>
					</div>	
					<hr/>
					<h5>Daftar Peserta</h5>
					$tabel_list_peserta
                </div>
                <!-- /.card-body -->

              </div>
            <!-- /.card -->

END;
}

if($action=="") {
	echo <<<END
  <div class="card card-primary">
              
              
                <div class="card-body">
					<div id="calendar"></div>
                </div>
                <!-- /.card-body -->

              </div>
            <!-- /.card -->

END;
}

?>
