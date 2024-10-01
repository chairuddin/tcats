<?php

if($action=="add" OR $action=="edit")
{

$r=$mysql->query("SELECT * from $table where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

if($action=='edit') {
	$r_peluang_tercipta=explode(',',$_POST['peluang_tercipta']);
}
if($action=='add') {
	$r_peluang_tercipta=$_POST['peluang_tercipta'];
}

$_POST['target_deal']=($_POST['target_deal']=='' or $_POST['target_deal']=='0000-00-00')?date("d/m/Y"):ymd_to_dmy($_POST['target_deal']);
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";


$list_produk=option_list_produk();
$option_produk=array();
$option_produk[]='Pilih Produk';
foreach($list_produk as $i => $v) {
	$option_produk[$v['id']]=$v['nama'];
}


$form_produk=$form->element_Select("Produk","produk_id",$option_produk);
$form_keterangan=$form->element_Textbox("Keterangan","keterangan");
$form_target_deal=$form->element_Textbox("Target Deal","target_deal",array('class'=>'tanggal'));


if($id>0) {
	$produk_terpilih=produk_terpilih($id);
} else {
	$produk_terpilih=array();
}
$peluang_list=peluang_list();
$form_peluang_tercipta='';
foreach($peluang_list as $i =>$v) {
	$checked_field='';
	$checked_value='';
	if(in_array($i,$r_peluang_tercipta)) {
		$checked_field='checked';
		$checked_value='checked';
	}
	$form_peluang_tercipta.='<div class="form-group">'.$form->element_Checkbox($v,"peluang_tercipta[]",array("value"=>$i,'id'=>'peluang'.$id,$checked_field=>$checked_value)).'</div>';
}



$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Prospek</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" method="POST" action="$do_action" class="yona-form" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
				 <div class="form-group row">
					$form_produk
				  </div>	
                  <div class="form-group row">
                   	$form_target_deal
                  </div>		
			
				  <div class="form-group row">
				  	$form_keterangan
				  </div>
				  <div class="form-group row">

				  <label class="col-lg-2 col-form-label">
				  		<a href="#">Peluang Tercipta</a>
				  </label>
				  <div class="col-lg-8">
						$form_peluang_tercipta
				  </div>
			  
			  	   </div>		
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-dark" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;


}

if($action=="view" or $action=="")
{
$btn_tambah=button_add("$modul/add");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Prospek</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Produk</th>
				<th>Target Deal</th>
				<th>Keterangan</th>
				<th>Progress</th>
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
	
	$column_order = array('b.id','b.kode','p.nama','b.target_deal','b.keterangan');
	$column_search = array('b.kode','p.nama','b.target_deal','b.keterangan');

	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		
		$order_by = " ORDER BY b.id DESC ";
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
	
	$sql=" SELECT b.id,b.kode,b.produk_id,p.nama produk_nama,b.target_deal,b.keterangan FROM $table b LEFT JOIN produk p ON p.id=b.produk_id  ";
	
	$sql.=" WHERE 1=1 ";

	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	$result2 = $mysql->query($sql);
	
	$data = array();
	
	
	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];

	$list_id=array();
	while($d2 = $mysql->fetch_assoc($result2)) {
		$list_id[]=$d2['id'];
	}
	$join_list_id=join(",",$list_id);
	$prospek_list_q=$mysql->query("SELECT prospek_id,count(id) total,sum(if(status=1 OR status=5,1,0)) done FROM prospek_list WHERE prospek_id IN ($join_list_id) GROUP BY prospek_id");
	$prospek_data=array();
	while($prospek_list_d=$mysql->fetch_assoc($prospek_list_q)) {
		$prospek_data[$prospek_list_d['prospek_id']]=$prospek_list_d['done']."/".$prospek_list_d['total'];
	}
	
	while($d = $mysql->fetch_assoc($result)) {
		
		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['kode'];
		$row[]=$d['produk_nama'];
		$row[]=tgl_indo_short($d['target_deal']);
		$row[]=$d['keterangan'];
		$row[]=$prospek_data[$d['id']]!=''?'<a href="'.backendurl("$modul/progress_list/".$d['id']).'" title="Daftar Prospek"><span class="label gradient-1 btn-rounded">'.$prospek_data[$d['id']].'</span></a>':'';
	//	$row[]="<div class='text-right'>".currency($d['harga'])."</div>";
		//$action_add='<a  title="Tambah calon prospek" href="'.backendurl("$modul/prospek_list/".$d['id']).'"><i class="fa fa-users aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_add=btn_group(backendurl("$modul/prospek_list/".$d['id']),array('title'=>'Tambah data prospek'));
		if($daftar_hak[$modul]['edit']==1) {
			//$action_edit='<a  title="Edit Prospek" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']));
		}
		if($daftar_hak[$modul]['del']==1) {
		$action_delete=btn_delete_swal(backendurl("$modul/del/".$d['id']));
		}
		$row[]=$action_add.$action_edit.$action_delete;
		
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


if($action=='filter_list') {

	$r_option_lembaga_jenis=option_lembaga_jenis();
	$option_lembaga_jenis='';
	foreach($r_option_lembaga_jenis as $i =>$v) {
		$option_lembaga_jenis.='<option value="'.$i.'">'.$v.'</option>';
	}

	$r_option_list_produk=option_list_produk();
	$option_list_produk='';
	foreach($r_option_list_produk as $i =>$v) {
		$option_list_produk.='<option value="'.$i.'">'.$v['kode'].' '.$v['nama'].'</option>';
	}
	$kode=$mysql->get1value(" SELECT kode FROM prospek WHERE id=$id");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Prospek > Daftar Prospek #$kode> Filter Prospek</h3>		
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		
		<div class="form-group row">
			<label class="col-lg-2 col-form-label" for="lembaga_jenis">Segmen</label>
		  	 <div class="col-lg-3">
		   		<select  id="lembaga_jenis" class="form-control" name="lembaga_jenis">
		   			<option value="">Semua Segmen</option>
		   			$option_lembaga_jenis
		   		</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label" for="">Status Beli</label>
		  	 <div class="col-lg-3">
			   <label for="sudah" >
					<input type="radio" id="sudah" name="is_buy" value="1"> Sudah Membeli
				</label> &nbsp;&nbsp;&nbsp;
				<label for="belum" >
					<input type="radio" id="belum" name="is_buy" value="2" checked="checked"> Belum Membeli
				</label>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label" for="">Produk</label>
		  	 <div class="col-lg-3">
			   <select id="produk_id" name="produk_id" class="form-control"><option value="">Semua Produk</option>$option_list_produk</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label" for="">Kurun Waktu (bulan)</label>
		  	 <div class="col-lg-3">
			   <input type="text" name="kurun_waktu" id="kurun_waktu" class="form-control" style="width:150px;" placeholder="tanpa batas"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label" for="">Urut berdasar</label>
		  	 <div class="col-lg-3">
			   <label for="urut_customer2" >
			   <input type="radio" id="new" name="urut_customer" value="new" checked="checked"> Customer Baru
				</label> &nbsp;&nbsp;&nbsp;
				<label for="urut_customer1" >
					<input type="radio" id="old" name="urut_customer" value="old"> Customer Lama
				</label>
			</div>
		</div>
		<div class="form-group row">
			
		  	 <div class="col-lg-12">
		  	  <button type="button" class="btn btn-dark" onclick="history.back(-1);">Kembali</button>&nbsp;
			   <button class="btn btn-success" id="filter">Filter</button>
			</div>
		</div>
		
				<table id="filter-datalist-prospek" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Telp</th>
				<th>Email</th>
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

if($action=="filter-data-prospek") {

/*
	var is_buy=$("input[name='is_buy']:checked").val();
	var urut_customer=$("input[name='urut_customer']:checked").val();
	var produk_id=$('#produk_id option:selected').val();
	var kurun_waktu=$('#kurun_waktu').val();
	var lembaga_jenis=$('#lembaga_jenis option:selected').val();
*/
	$is_buy=cleanInput($_GET['is_buy']);
	$urut_customer=cleanInput($_GET['urut_customer']);
	$produk_id=cleanInput($_GET['produk_id']);
	$kurun_waktu=cleanInput($_GET['kurun_waktu']);
	$lembaga_jenis=cleanInput($_GET['lembaga_jenis']);
	



	$column_order = array('b.id','b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$column_search = array('b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$order = array('b.lembaga_nama' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.lembaga_nama ASC ";
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
	
	$sql=" SELECT b.id,b.lembaga_nama,b.lembaga_telp,b.lembaga_email FROM lembaga b  ";
	
	$sql.=" WHERE 1=1  ";

	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	if($lembaga_jenis) {
		$sql.=" AND b.lembaga_jenis='$lembaga_jenis' ";
	}



	$sql_r=array();
	if($kurun_waktu>0) {
		$sql_r[]=' t.tanggal <= DATE_SUB(NOW(), INTERVAL 7 MONTH) ';
	}
	if($produk_id>0) {
		$sql_r[]= "d.produk_id=$produk_id ";
	}
	$sql_lanjutan='';
	if(count($sql_r)>0) {
		$sql_lanjutan.=' AND '.join(' AND ',$sql_r);
	}
	

	if($is_buy==1) {
		$sql.=" AND b.id IN ( SELECT t.lembaga_id FROM invoice t INNER JOIN invoice_detail d ON t.id=d.invoice_id WHERE 1=1 $sql_lanjutan) ";
	}
	if($is_buy==2) {
		$sql.=" AND b.id NOT IN ( SELECT t.lembaga_id FROM invoice t INNER JOIN invoice_detail d ON t.id=d.invoice_id WHERE 1=1 $sql_lanjutan ) ";
	}
	
	//sembunyikan customer yang sudah masuk list
	$sql.=" AND b.id NOT IN (SELECT lembaga_id FROM prospek_list WHERE prospek_id=$id) ";

	if($urut_customer=='new') {
		$order_by=' ORDER BY b.id DESC';
	}
	if($urut_customer=='old') {
		$order_by=' ORDER BY b.id ASC';
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
		$row[]=$d['lembaga_telp'];
		$row[]=$d['lembaga_email'];
		$action_edit='<div class="m-0"><a class="btn btn-outline-success m-1" onclick="show_data('.$d['id'].');"><i class="fa fa-eye"></i>&nbsp;Lihat Penawaran</a>';
		$action_edit.='<a class="btn btn-add-prospek btn-outline-success m-1" onclick="add_prospek('.$d['id'].','.$id.');" title="Tambahkan ke daftar prospek">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Jadi Prospek</a></div>';
		
		$row[]=$action_add.$action_edit.$action_delete;
		
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



if($action=='prospek_list') {

	
$btn_tambah=button_add("$modul/filter_list/$id");
$kode=$mysql->get1value("SELECT kode FROM prospek WHERE id=$id");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Prospek > Daftar Prospek #$kode</h3>		
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		
				<table id="datalist-prospek" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Telp</th>
				<th>Email</th>
				<th>Status</th>
				<th>Action</th>
				</tr>
				</thead>
				</table>
				 <button type="button" class="btn btn-dark" onclick="history.back(-1);">Kembali</button>
		</div>
		
		<!-- /.card-body -->
	  </div>
</div>
END;
}

if($action=="data-prospek") {

	$column_order = array('b.id','b.lembaga_nama','b.lembaga_telp','b.lembaga_email','pl.status');
	$column_search = array('b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$order = array('b.lembaga_nama' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.lembaga_nama ASC ";
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
	
	$sql=" SELECT b.id,b.lembaga_nama,b.lembaga_telp,b.lembaga_email,pl.status FROM prospek_list pl LEFT JOIN lembaga b ON pl.lembaga_id=b.id ";
	
	$sql.=" WHERE prospek_id=$id ";

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
		$row[]=$d['lembaga_telp'];
		$row[]=$d['lembaga_email'];
		$row[]=$d['status']>0?badge_color($d['status']):'';
		$action_edit='';
		if($d['status']<=0) { 
			$action_edit='<span class="text-center"><a class="btn btn-danger btn-remove-prospek btn-xs" onclick="remove_prospek('.$d['id'].','.$id.')" title="Hapus dari daftar prospek" href="#"><i class="fa fa-remove fa-1x" aria-hidden="true"></i></a></span>';
		} else {
			$action_edit='';
		}
		$row[]=$action_add.$action_edit.$action_delete;
		
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

if($action=='progress_list') {
list($prospek_data)=$mysql->query_data("SELECT b.id,b.kode,b.produk_id,p.nama produk_nama,b.target_deal,b.keterangan FROM prospek b LEFT JOIN produk p ON p.id=b.produk_id WHERE b.id=$id ");
$produk_nama=$prospek_data['produk_nama'];
$target_deal=tgl_indo_short($prospek_data['target_deal']);

echo <<<END
<div class="row">
		<div class="col-md-12">
		
			<div class="card">
				<div class="card-body">
				<h5>$produk_nama</h5>
				<h5>Target Deal $target_deal </h5>
						<table class="table" id="progress_list_data" class="table table-bordered table-striped responsive no-wrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Lembaga</th>
									<th>Terakhir</th>
									<th>Via</th>
									<th>Berikutnya</th>
									<th>Catatan</th>
									<th>Admin</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
						
						</table>
	
				</div>
			</div>
		</div>
	</div>
END;
}

if($action=='progress_list_data') {

	$column_order = array('p.id','l.lembaga_nama','p.last_fu','p.next_fu','p.catatan','p.status');
	$column_search = array('l.lembaga_nama','p.next_fu','p.catatan');
	$order = array('b.lembaga_nama' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY l.lembaga_nama ASC ";
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
	
	$sql="
	SELECT 
    p.id,pr.kode produk_kode,pr.nama produk_nama,l.lembaga_nama,l.lembaga_telp,l.lembaga_email,l.pic_nama_lengkap,l.pic_nama_panggilan,l.pic_whatsapp,l.pic_email,p.next_fu,p.last_fu,p.status,p.catatan,u.username admin,p.fu_via
    FROM 
    prospek_list p
    INNER JOIN  lembaga l 
    ON l.id=p.lembaga_id
    LEFT JOIN prospek pp ON pp.id=p.prospek_id
    LEFT JOIN produk pr ON pr.id=pp.produk_id
    LEFT JOIN user u ON p.created_by=u.id

	";
	
	$sql.=" WHERE prospek_id=$id ";

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
		$action_button=btn_call(backendurl('dashboard/fu_prospek/'.$d['id'])."?from=prospek/progress_list/$id");
		$action_deal=btn_deal(backendurl('deal/add/'.$d['id']));
		$badge=$d['status']>0?badge_color($d['status']):'';

		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['lembaga_nama'];
		$row[]=(($d['last_fu']=='0000-00-00 00:00:00' or v['last_fu']=='')?'':tgl_indo_short(date("Y-m-d",strtotime($d['last_fu']))));
		$row[]=fu_info($d['fu_via']);
		$row[]=($d['next_fu']=='0000-00-00'?'':tgl_indo_short($d['next_fu']));
		$row[]=$d['catatan'];
		$row[]=$d['admin'];
		$row[]=$badge;
		$action_edit=$action_button.($d['status']=='1'?$action_deal:'');
		$row[]=$action_add.$action_edit.$action_delete;
		
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

?>
