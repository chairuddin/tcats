<?php

if($action=="add" OR $action=="edit")
{

if($action=='edit') {
	$q=$mysql->query("
	SELECT 
		id,
		nama
	FROM
		level WHERE id=$id
	");
	$d=$mysql->assoc($q);
	foreach($d as $field => $value) {
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
}

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$form_nama=$form->element_Textbox("Level","nama");

echo <<<END
  <div class="card card-primary">
	  <div class="card-header">
		<h3 class="card-title">$label_action Level</h3>
	  </div>
	  <!-- /.card-header -->
	  <!-- form start -->
	  <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
		<input type="hidden" name="id" value="$id" />
		<div class="card-body">
		  <div class="form-group">
			$form_nama                    
		  </div>
		<div class="card-footer">
		   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
		</div>
	  </form>
	</div>
	<!-- /.card -->
</div>
END;

}
if($action=="hak") 
{

echo '<div class="card">
              <div class="card-header">
                <h3 class="card-title">Hak Akses</h3>
              </div>';

echo '<div class="card-body p-30">';            
echo '<form role="form" method="POST" id="form-member" class="form-member" action="" novalidate="novalidate" enctype="multipart/form-data">';

foreach($master_hak_akses as $i => $v){
echo '<div class="row">';
echo '<div class="col-md-3">'.$v['title'].'</div>';
echo '<div class="col-md-9">';
echo '<div class="row">';
if(count($v['hak'])>0){
	foreach($v['hak'] as $x =>$y){
		$uniqid=uniqid();
		$ischecked=$mysql->get1value("SELECT id FROM hak_akses WHERE modul='".$v['modul']."' AND hak='$x' AND id_level='$id'");
		$checked=$ischecked>0?'checked="checked"':'';
		$id_element=$v['modul']."_".$x;
		echo '<div class="col-sm-2 ml-4">';
		echo '
		<div class="custom-control custom-switch">
		  <input type="checkbox" name="'.$v['modul'].'[]" id="'.$id_element.'" '.$checked.' value="'.$x.'" class="custom-control-input">
		  <label class="custom-control-label" for="'.$id_element.'">'.$y.'</label>
		</div>
		';
		echo '</div>';
	}
}
echo '</div>';
echo '</div>';
echo '</div>';
}

echo '<button type="submit" class="btn btn-primary" name="update_hak" value="1">Update Hak Akses</button>';
echo '</form>';

echo '</div>';
echo '</div>';

}
if($action=="view" or $action=="")
{
$btn_tambah=button_add("$modul/add");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Master Level</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Level</th>
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
	
	$column_order = array('id','nama');
	$column_search = array('nama');
	$order = array('nama' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY nama ASC ";
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
		id,
		nama
	FROM 
		level 
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
		$row[]=$d['nama'];
		
		
		/*
		 * $action_hak='<a href="'.backendurl("$modul/hak/".$d['id']).'"><i class="fas fa-user-lock" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_edit='<a href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fas fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_delete='<a class=""  title="Hapus buku"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus data" 
				data-body="Apakah anda yakin ingin menghapus data ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.backendurl("$modul/del/".$d['id']).'"
				data-btn1name="Hapus"
				>
				<i class="fas fa-trash"></i>
		</a>';
		*/
		
		$action_hak=$daftar_hak[$modul]['edit']==1?btn_access(backendurl("$modul/hak/".$d['id'])):'';
		$action_edit=$daftar_hak[$modul]['edit']==1?btn_edit(backendurl("$modul/edit/".$d['id'])):'';
		$action_delete=$daftar_hak[$modul]['del']==1?btn_delete(backendurl("$modul/del/".$d['id'])):'';
		$row[]='<div class="btn-group btn-group-sm">'.$action_hak.$action_edit.$action_delete.'</div>';
		
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
