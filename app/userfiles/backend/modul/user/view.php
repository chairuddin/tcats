<?php
if($action=="add" OR $action=="edit")
{
if($action=="edit") {	
$r=$mysql->query("SELECT * from user where id=$id");
$d=$mysql->assoc($r);
extract($d);
} else {
$d=$_POST;
extract($d);
}
$select_level.='<select id="level" name="level" class="form-control">';
$select_level.='<option value="">Pilih Level</option>';
foreach($options_level as $i => $level) {
		$selected=$i==$d['level']?'selected="selected"':'';
		$select_level.='<option '.$selected.' value="'.$i.'">'.$level.'</option>';
}
$select_level.='</select>';

if($action=="add") {
	$d['status']=1;
}
$select_status.='<select id="status" name="status" class="form-control">';
foreach($options_status as $i => $status) {
		$selected=$i==$d['status']?'selected="selected"':'';
		$select_status.='<option '.$selected.' value="'.$i.'">'.$status.'</option>';
}
$select_status.='</select>';

$hak_cabang=array();
if($action=="edit") {
	$q_hak_cabang=$mysql->query("SELECT id_cabang FROM hak_cabang WHERE id_user=$id ");
	if($q_hak_cabang and $mysql->num_rows($q_hak_cabang)>0) {
		while($d_hak_cabang = $mysql->fetch_assoc($q_hak_cabang)) {
			$hak_cabang[]=$d_hak_cabang['id_cabang'];
		}
	}
}
$cabang=$mysql->r_assoc("master_cabang","id,nama");
$input_cabang='<select id="cabang" name="cabang[]" class="form-control">';
$input_cabang.='<option>Pilih Cabang</option>';
foreach($cabang as $idx => $r_cabang) {
	$selected=in_array($r_cabang['id'],$hak_cabang)?'selected="selected"':'';
	$input_cabang.='<option '.$selected.' value="'.$r_cabang['id'].'" />'.$r_cabang['nama'].'</option>'; 
}
$input_cabang.='</select>';

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$form_user=$action=='add'?'<div class="form-group">
				<label for="namauser">Username</label>
				<input type="text" class="form-control" id="namauser" placeholder="" autocomplete="off" name="username" value="'.$username.'">
			  </div>':'<div class="form-group">
				<label for="namauser">Nama Login</label>
				'.$username.'
			  </div>';
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Master User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
                  $form_user
                  <div class="form-group">
                    <label for="kunci">Password</label>
                    <input type="password" class="form-control" id="kunci" placeholder="*****" autocomplete="off" name="password" value="">
                  </div>
                  <div class="form-group">
                    <label for="kunci2">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="kunci2" placeholder="*****" autocomplete="off" name="password2" value="">
                  </div>
                  <div class="form-group">
                    <label for="namauser">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namauser" placeholder="Nama Lengkap" name="fullname" value="$fullname">
                  </div>
				  <div class="form-group">
				  <label for="panggilan">Nama Panggilan</label>
				  <input type="text" class="form-control" id="panggilan" placeholder="Nama Panggilan" name="nickname" value="$nickname">
				</div>
                  <div class="form-group">
                    <label for="level">Level</label>
                    $select_level
                  </div>
                  <div class="form-group">
                    <label for="level">Status</label>
                    $select_status
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="level">Lokasi</label>
                    $input_cabang
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Submit</button>
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
		  <h3 class="card-title">Master User</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Username</th>
				<th>Fullname</th>
				<th>Level</th>
				<th>Status</th>
				<th style="width:80px;">Action</th>
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
	
	$column_order = array('b.id','b.username','b.fullname','b.level','c.nama');
	$column_search = array('b.username','b.username','b.fullname');
	$order = array('b.username' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.username ASC ";
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
	b.id,b.username,b.fullname,b.status,b.level,c.nama cabang FROM user b 
	LEFT JOIN hak_cabang h ON h.id_user=b.id 
	LEFT JOIN master_cabang c ON c.id=h.id_cabang
	
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
		$row[]=$d['username'];
		$row[]=$d['fullname'];
		$row[]=$q=$mysql->get1value("SELECT nama FROM level WHERE id=".$d['level']);
		$row[]=$d['status']==1?'Aktif':'Tidak Aktif';
		
		/*(
		$action_edit='<a href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fas fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_delete='<a class=""  title="Hapus Kategori"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus user" 
				data-body="Apakah anda yakin ingin menghapus user ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.backendurl("$modul/del/".$d['id']).'"
				data-btn1name="Hapus"
				>
				<i class="fas fa-trash"></i>
		</a>';
		*/
		$action_edit=$daftar_hak[$modul]['edit']==1?btn_edit(backendurl("$modul/edit/".$d['id'])):'';
		$action_delete=$daftar_hak[$modul]['del']==1?btn_delete_swal(backendurl("$modul/del/".$d['id'])):'';
		$row[]='<div class="btn-group btn-group-sm">'.$action_view.$action_edit.$action_delete.'</div>';
		
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
