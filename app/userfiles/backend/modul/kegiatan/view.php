<?php

if($action=="add" OR $action=="edit")
{

$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$_POST['tanggal_mulai']=($_POST['tanggal_mulai']=='' or $_POST['tanggal_mulai']=='0000-00-00')?date("d/m/Y H:i"):ymd_to_dmy($_POST['tanggal_mulai'],true);

$_POST['tanggal_selesai']=($_POST['tanggal_selesai']=='' or $_POST['tanggal_selesai']=='0000-00-00')?date("d/m/Y H:i"):ymd_to_dmy($_POST['tanggal_selesai'],true);

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$list_produk=option_list_produk();
$option_produk=array();
$option_produk[]='Pilih Produk';
foreach($list_produk as $i => $v) {
	$option_produk[$v['id']]=$v['nama'];
}

/*CUSTOMER*/
if($action=="edit") {
$kondisi=" WHERE id=".$_POST['lembaga_id'];
}
$option_lembaga=array();
$option_lembaga['']="Ketik nama lembaga";
$q=$mysql->query("SELECT id,lembaga_nama FROM lembaga $kondisi ORDER BY lembaga_nama ");
if($q and $mysql->num_rows($q)>0) {
	while($d=$mysql->fetch_assoc($q)) {
		$option_lembaga[$d['id']]=$d['lembaga_nama'];
	}
}

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

$form_produk=$form->element_Select("Produk","produk_id",$option_produk);
$form_lembaga=$form->element_Select("Penyelengara","lembaga_id",$option_lembaga,array('class'=>'js-customer'));
$form_coach=$form->element_Select("Coach","coach_id",$option_coach);
//$form_lokasi=$form->element_Textbox("Lokasi","lokasi");

$form_tanggal_mulai=$form->element_Textbox("Tanggal Mulai","tanggal_mulai",array('class'=>'tanggal-waktu'));
$form_tanggal_selesai=$form->element_Textbox("Tanggal Selesai","tanggal_selesai",array('class'=>'tanggal-waktu'));

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kegiatan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" class="yona-form" autocomplete="off" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
				  <div class="form-group row">
					$form_lembaga
				  </div>	
				
				 <div class="form-group row">
					$form_produk
				  </div>
					
					
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-dark" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit"  type="submit" name="submit" value="1"  class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;


$url_ajax=backendurl("$modul/get_lembaga");
$script_js.=<<<END
<script>

$(document).ready(function(){
	
	$('.js-customer').select2({
		  ajax: {
			url: '$url_ajax',
			delay:250,
			dataType: 'json',
			data: function (params) {

            var queryParameters = {
                term: params.term
            }
            return queryParameters;
			},
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							text: item.text,
							id: item.id
						}
					})
				};
			}
		  }
	});
	
	
	});
	
</script>
END;




}

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
				<th>Kode</th>
				<th>Penyelengara</th>
				<th>Kegiatan</th>		
				<!-- <th>Jadwal</th>		 -->				
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
	
	$column_order = array('b.id','b.kode','l.lembaga_nama');
	$column_search = array('l.lembaga_nama');
	$order = array('b.kode' => 'DESC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.kode DESC";
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
	
	$sql=" SELECT b.id,b.kode,l.lembaga_nama,p.nama produk_nama
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
		//cek jadwal
		list($pelaksanaan)=$mysql->query_data("SELECT min(waktu_mulai) mulai,max(waktu_selesai) akhir FROM jadwal WHERE kegiatan_id=".$d['id']);
		$row[]=$no;
		$row[]=$d['kode'];
		$row[]=$d['lembaga_nama'];
		$row[]=$d['produk_nama'];
		//$jadwal='<a  title="Tambah Jadwal" href="'.backendurl("jadwal/calendar/?kegiatan_id=".$d['id']).'"><i class="fa fa-calendar" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		//$jadwal.=ymd_to_dmy($pelaksanaan['mulai'],true)." s/d ".ymd_to_dmy($pelaksanaan['akhir'],true);
		//$jadwal=tanggal_jadwal($pelaksanaan['mulai'],$pelaksanaan['akhir']);
		//$row[]='';//$jadwal;
		$action_edit='';

		if($daftar_hak[$modul]['edit']==1) {
			$action_edit.=btn_jadwal(backendurl("jadwal/list/?kegiatan_id=".$d['id']));
			//$action_edit='<a  title="Edit Jenis" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			$action_edit.=btn_edit(backendurl("$modul/edit/".$d['id']));
			//$action_edit.='<a  title="Tandai selesai" href="'.backendurl("$modul/selesai/".$d['id']).'"><i class="fa fa-check" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
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

if($action=="selesai")
{

$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$do_action=backendurl("$modul/".($action=="selesai"?"selesai_update":"selesai_update"));
$label_action=$action=="selesai"?"Selesai":"Selesai";




$option_selesai=array();
$option_selesai[]='Pilih';
$option_selesai[1]='Selesai';
$option_selesai[2]='Batal';

$option_laporan=array();
$option_laporan[]='Pilih';
$option_laporan[1]='Sudah diberikan';
$option_laporan[2]='Tidak perlu';


$option_sertifikat=array();
$option_sertifikat[]='Pilih';
$option_sertifikat[1]='Sudah diberikan';
$option_sertifikat[2]='Tidak perlu';



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

$form_status_selesai=$form->element_Select("Status Kegiatan","status_selesai",$option_selesai);
$form_status_laporan=$form->element_Select("Status Laporan","status_laporan",$option_laporan);
$form_status_sertifikat=$form->element_Select("Status Sertifikat","status_sertifikat",$option_sertifikat);

$do_action=backendurl("$modul/".($action=="selesai"?"selesai_update":"selesai_update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kegiatan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" class="yona-form" autocomplete="off" method="POST" action="$do_action" enctype="multipart/form-data">
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
					
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
					
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;




}

?>
