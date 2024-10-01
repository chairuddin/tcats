<?php

if($action=="view" or $action=="")
{
$btn_tambah=button_add("$modul/add");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Kegiatan</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Penyelengara</th>
				<th>Kegiatan</th>		
				<th>Jadwal</th>						
				<th>Action</th>
				</tr>
				</thead>
				</table>
		</div>
		<!-- /.card-body -->
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
	
		if($daftar_hak[$modul]['del']==1) {
		
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
if($action=="calendar") {
$kegiatan_id=cleanInput($_GET['kegiatan_id']);
$kegiatan_nama=$mysql->get1value(" SELECT nama FROM produk WHERE id IN (SELECT produk_id FROM kegiatan WHERE id=$kegiatan_id)");	
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
	
echo <<<END

    <div class="card">
		<div class="card-body">
			<div class="card-title">
				<h4>Jadwal $kegiatan_nama</h4>
			</div>
			<div class="col-md-12">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEventModal">
				Tambah Jadwal
			</button>
			<div id="calendar"></div>
			<br/>
			<br/>
			<h4>Ringkasan Jadwal</h4>
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
?>
