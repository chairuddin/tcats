<?php
$periode_awal=$_GET['periode_awal']!=''?$_GET['periode_awal']:date('01/m/Y');
$periode_akhir=$_GET['periode_akhir']!=''?$_GET['periode_akhir']:date('d/m/Y');
list($d1,$m1,$y1)=explode("/",$periode_awal);
list($d2,$m2,$y2)=explode("/",$periode_akhir);
$tgl1="$y1-$m1-$d1";
$tgl2="$y2-$m2-$d2";

if($action=='excel' or $action=='cetak' or $action=='pdf') {
	if($_GET['jenis']!='') {
		$sql_r[]=" t.jenis='".$_GET['jenis']."' ";
	}
	$sql=" 
	SELECT 
		t.id,
		t.tanggal_selesai,
		t.nama,
		t.nomor,
		t.hp,
		t.status_tes,
		u.fullname petugas_swab
	FROM 
		invoice t LEFT join user u ON t.printed_by=u.id
	WHERE t.printed_by>0 AND t.id_cabang=$id_cabang AND date_format(t.tanggal_selesai,'%Y-%m-%d')  BETWEEN '$tgl1' AND '$tgl2'
	
	";
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
$data_hasil	= $mysql->query_data($sql);


	
}
if($action=='excel' and count($data_hasil)>0) {
	build_excel($data_hasil);
}

if(($_GET['submit']=='proses') and count($data_tracking)<=0) {
 sweetalert2($type="warning","Data tidak ditemukan","");
}


if($action=="" and $_GET['view']=='')
{

$tombol_download3=btn_download_xls("$modul/excel?periode_awal=$periode_awal&periode_akhir=$periode_akhir&submit=proses&jenis=".cleanInput($_GET['jenis']));
$tanggal_antar=tgl_hari($tanggal_antar);
$d_jenis=data_jenis_nota();
foreach($d_jenis as $id => $field) {
	$selected=$_GET['jenis']==$id?'selected="selected"':'';	
	$option_jenis.="<option  $selected value=\"".$id."\">".$field."</option>";
}

				
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Laporan</h3>  
		  <div class="float-right">$tombol_download1&nbsp;$tombol_download2&nbsp;$tombol_download3</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		<form method="GET" role="form" style="">
			<div class="container">
			<div class="row">
			<div class="col-xs-1">
			<select name="jenis"  class="form-control">
				<option value=''>Semua</option>
				$option_jenis
			</select>	 
			</div>
			<div class="col-xs-1">
				<div style="line-height:40px;text-align:center;width:30px;"></div>
			</div>
			<div class="col-xs-1">
				<input style="width:100px;text-align:center;" type="text" id="periode_awal" name="periode_awal" class="form-control" value="$periode_awal" /> 
			</div>
			<div class="col-xs-1">
				<div style="line-height:40px;text-align:center;width:30px;">-</div>
			</div>
			<div class="col-xs-1">
				<input style="width:100px;text-align:center;" type="text" id="periode_akhir" name="periode_akhir" class="form-control" value="$periode_akhir"/>
			</div>
			<div class="col-xs-1" style="line-height:40px;text-align:center;">
				&nbsp;&nbsp;<input type="submit" name="submit" value="OK" class="btn btn-primary" style="width:45px;"/>
			</div>
			</div>
			</div>
			<br/>
		</form>	
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>TANGGAL.</th>
				<th>No. Surat</th>
				<th>Nama</th>
				<th>No. Telp</th>
				<th>Hasil</th>
				<th>Petugas Swab</th>
				</tr>
				</thead>
				</table>
			
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
		<button class="btn btn-default" onclick="history.back();">Kembali</button>
		</div>
	  </div>
</div>
END;
$url_data=backendurl("$modul/data?periode_awal=$periode_awal&periode_akhir=$periode_akhir&jenis=".cleanInput($_GET['jenis']));

$script_js.=<<<END
<script>
$(document).ready(function(){
	// datatables
		$('#datalist').DataTable({
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'processing'  : true,
			'responsive'  :true,
			"ajax": {
				"url": '$url_data',
				"type": "POST"
			},
			"order": [[ 0, 'ASC' ]],
			"language": {
				"paginate": {
				  "previous": "<",
				  "next": ">"
				}
			  },
			   /*
			 "columnDefs": [
				{ responsivePriority: 1, targets: 3 },
		        { responsivePriority: 2, targets: 4 }
			  ],
			 
			  responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal( {
						header: function ( row ) {
							var data = row.data();
							return 'Details for '+data[0]+' '+data[1];
						}
					} ),
					renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
						tableClass: 'table'
					} )
				}
			  }
			  */
			
			
		});
		
});
</script>	
END;
}
if($action=="data") {
	
	$column_order = array();
	$column_search = array('t.tanggal','t.nomor','t.nama','t.hp','t.nik','t.pekerjaan','t.alamat');
	$order = array('t.id' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY t.id ASC ";
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
	if($_GET['jenis']!='') {
		$sql_r[]=" t.jenis=".$_GET['jenis'];
	}
	$sql=" 
	SELECT 
		t.id,
		t.tanggal_selesai,
		t.nama,
		t.nomor,
		t.hp,
		t.status_tes,
		u.fullname petugas_swab
	FROM 
		invoice t LEFT join user u ON t.printed_by=u.id
	WHERE t.printed_by>0 AND t.id_cabang=$id_cabang AND date_format(t.tanggal_selesai,'%Y-%m-%d')  BETWEEN '$tgl1' AND '$tgl2'
	
	";
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";

	$result = $mysql->query($sql);
	
	$data = array();
	
	$option_tes=data_hasil_tes();
	$gotopage = $_POST['start']/$_POST['length'];
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		
		$no++;
		$row = array();
		
		$row[]=$no;
		//$row[]=$d['awb'];	
		$row[]=tgl_indo_long(date("Y-m-d",strtotime($d['tanggal_selesai'])));
		$row[]=$d['nomor'];
		$row[]=$d['nama'];
		$row[]=$d['hp'];
		$row[]=$option_tes[$d['status_tes']];
		$row[]=$d['petugas_swab'];
		
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

$script_js.=<<<END
<script>
$(document).ready(function(){
		new GijgoDatePicker(document.getElementById("periode_awal"), { keyboardNavigation: true, modal: true, header: true, footer: true, format: 'dd/mm/yyyy',showRightIcon: false });
		new GijgoDatePicker(document.getElementById("periode_akhir"), { keyboardNavigation: true, modal: true, header: true, footer: true, format: 'dd/mm/yyyy',showRightIcon: false });	
							
});
</script>
END;
?>
