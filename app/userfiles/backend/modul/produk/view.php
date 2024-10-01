<?php

if($action=="add" OR $action=="edit")
{

$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$_POST['expired']=($_POST['expired']=='' or $_POST['expired']=='0000-00-00')?date("d/m/Y"):ymd_to_dmy($_POST['expired']);
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$option_jenis=option_list_jenis();;

if($action=="edit") {
	$_POST['harga']=currency($_POST['harga']);
}

$form_jenis=$form->element_Select("Jenis","jenis",$option_jenis);
$form_nama=$form->element_Textbox("Nama","nama");
$form_harga=$form->element_Textbox("Harga","harga",array('class'=>'format-angka','style'=>'width:150px;'));

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" class="yona-form" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
				 <div class="form-group row">
					$form_jenis
				  </div>	
                  <div class="form-group row">
                   	$form_nama
                  </div>		
				  <div class="form-group row ">
				  	$form_harga
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
		  <h3 class="card-title">Produk</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama</th>
				<th>Harga</th>
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
	
	$column_order = array('b.id','b.kode','b.nama','b.harga');
	$column_search = array('b.kode','b.nama','b.harga');
	$order = array('b.nama' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.nama ASC ";
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
	
	$sql=" SELECT b.id,b.kode,b.nama,harga FROM $modul b  ";
	
	$sql.=" WHERE is_paket=0 ";

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
		$row[]=$d['kode'];
		$row[]=$d['nama'];
		$row[]="<div class='text-right'>".currency($d['harga'])."</div>";
		$action_edit='';
		if($daftar_hak[$modul]['edit']==1) {
			//$action_edit='<a  title="Edit Produk" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
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
?>
