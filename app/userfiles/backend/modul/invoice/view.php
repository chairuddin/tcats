<?php

if($action=="get_customer_detail") {
	$id_customer=cleanInput($_GET['id_customer']);
	$q_customer = $mysql->query("SELECT id,perusahaan,nama,hp,pekerjaan,alamat FROM master_customer WHERE id=$id_customer ");
	if($q_customer and $mysql->num_rows($q_customer)) {
		echo json_encode($mysql->fetch_assoc($q_customer));
	} else {
		echo json_decode(array('id'=>'','perusahaan'=>'','perusahaan'=>'','hp'=>'','alamat'=>''));
	}
	die();
}
if($action=="get_customer_transaction") {
	$id_customer=cleanInput($_GET['id_customer']);
	echo get_customer_transaction_html($id_customer);
	die();
}
if($action=="get_customer") {
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
			$r_search[]=" ( nama like '%$join_keyword%' ) ";
			$r_poin[]="  IF(nama like '%$join_keyword%',$poin,0)  "	;
			$r_search[]=" ( hp like '%$join_keyword%' ) ";
			$r_poin[]="  IF(hp like '%$join_keyword%',$poin,0)  "	;
			$r_search[]=" ( perusahaan like '%$join_keyword%' ) ";
			$r_poin[]="  IF(perusahaan like '%$join_keyword%',$poin,0)  "	;
		}
		$join_poin="(".join(" + ",$r_poin).") poin";
		$join_search="(".join(" or ",$r_search).") ";
		
		$sql=" SELECT * FROM (SELECT id,perusahaan,nama,hp,pekerjaan,alamat,$join_poin FROM master_customer WHERE $join_search ) x ORDER BY x.poin desc ";
		$q=$mysql->query($sql);
		$data=array();
		if($q and $mysql->num_rows($q)>0) {
			while($d=$mysql->fetch_assoc($q)){
			  $data[]=array('id'=>$d['id'],'text'=>$d['hp']." | ".$d['nama']." | ".$d['perusahaan']);
			}
		}
	}

echo json_encode($data);
die();
}
if($action=="add" OR $action=="edit")
{
	
	if($action=="edit") {
		$r=$mysql->query("SELECT * from $modul where id=$id");
		$d=$mysql->assoc($r);
		foreach($d as $field => $value) {
			$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
		}
		$_POST['tanggal']=ymd_to_dmy(date("Y-m-d",strtotime($d['tanggal'])));
		$_POST['tanggal_jatuh_tempo']=ymd_to_dmy(date("Y-m-d",strtotime($d['tanggal_jatuh_tempo'])));
		$_POST['alamat']=br2nl($d['alamat']);
	}
	if($action=='add') {
		$_POST['dp']=$_POST['dp']==""?"0":$_POST['dp'];
		$_POST['diskon']=$_POST['diskon']==""?"0":$_POST['diskon'];
		$_POST['tanggal']=$_POST['tanggal']==""?date("d/m/Y"):$_POST['tanggal'];
		$_POST['tanggal_jatuh_tempo']=$_POST['tanggal_jatuh_tempo']==""?date("d/m/Y",strtotime(' + 7 days', strtotime(date("Y-m-d")))):$_POST['tanggal'];
	}
	
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$list_produk=option_list_produk();
$option_produk='<option value="">Pilih Produk</option>';
foreach($list_produk as $i => $v) {
	$option_produk.='<option value="'.$v['id'].'">'.$v['nama'].'</option>';
}
$option_template=array();

$option_template['0']='Tanpa tanda tangan';
$option_template['1']='Pakai tanda tangan';

$form_template=$form->element_Select("Template","template",$option_template,array(),$mode=array('label'=>4,'input'=>8));
$form_tanggal=$form->element_Textbox("Tanggal Order","tanggal",array('class'=>'tanggal'),$mode=array('label'=>4,'input'=>8));
$form_dp=$form->element_Textbox("Down Payment","dp",array('class'=>'format-angka'),$mode=array('label'=>4,'input'=>3));
$form_diskon=$form->element_Textbox("Diskon","diskon",array('class'=>'format-angka'),$mode=array('label'=>4,'input'=>3));
$form_tanggal_jatuh_tempo=$form->element_Textbox("Jatuh Tempo","tanggal_jatuh_tempo",array('class'=>'tanggal'),$mode=array('label'=>4,'input'=>8));
$tabel_transaksi='
<table id="table_list_transaksi" class="table table-bordered table-striped responsive no-wrap">
	<tr><th style="">Produk</th><th style="">Deskripsi</th><th style="width:150px;">Nominal</th><th style="width:100px;">Action</th></tr>
';

$q_detail=$mysql->query("SELECT id,produk_id,deskripsi,nominal FROM invoice_detail WHERE invoice_id='$id'");
if($q_detail and $mysql->num_rows($q_detail)>0) {
	while($d_detail = $mysql->fetch_assoc($q_detail)) {

		$list_produk_detail=option_list_produk();
		$option_produk_detail='<option value="">Pilih Produk</option>';
		foreach($list_produk_detail as $i => $v) {
			$selected=$d_detail['produk_id']==$v['id']?'selected="selected"':'';
			$option_produk_detail.='<option value="'.$v['id'].'" '.$selected.'>'.$v['nama'].'</option>';
		}


		$input_produk='<select class="class_product form-control product-select2" id="produk_'.uniqid().'" name="produk[]">'.$option_produk_detail.'</select>';
		$input_deskripsi='<textarea class="class_deskripsi form-control" name="deskripsi[]">'.br2nl($d_detail['deskripsi']).'</textarea>';
		$input_nominal='<input class="class_nominal format-angka form-control" type="text" name="nominal[]" value="'.$d_detail['nominal'].'">';
		$tabel_transaksi.='
		<tr id="row_'.$d_detail['id'].'">
		<td>'.$input_produk.'</td>
		<td>'.$input_deskripsi.'</td>
		<td>'.$input_nominal.'</td>
		<td>
		<a class="" href="#" onclick="hapus_detail(this);" data-row="row_'.$d_detail['id'].'"><i class="fa fa-trash fa-1x"></i></a>
		</tr>';
	}
} else {
	if($action=="add") {
		$deal_id=cleanInput($_GET['deal_id'],'numeric');
		$prospek_id=$mysql->get1value(" SELECT prospek_id FROM deal WHERE id=$deal_id ");
		$produk_id=$mysql->get1value(" SELECT  produk_id FROM prospek WHERE id=$prospek_id  ");
		$termin=cleanInput($_GET['termin']);
		$nilai_termin=$mysql->get1value("SELECT termin_$termin FROM deal WHERE id=$deal_id");
		//$harga_produk=$mysql->get1value(" SELECT harga FROM produk WHERE id=$produk_id ");
		$harga_produk=$mysql->get1value(" SELECT nominal_deal FROM deal WHERE id=$deal_id ");
		
		$harga_produk=$harga_produk*($nilai_termin/100);
		
		$nama_produk=$mysql->get1value(" SELECT nama FROM produk WHERE id=$produk_id  ");

		
		$list_produk_detail=option_list_produk();
		$option_produk_detail='<option value="">Pilih Produk</option>';
		foreach($list_produk_detail as $i => $v) {
			$selected=$produk_id==$v['id']?'selected="selected"':'';
			$option_produk_detail.='<option value="'.$v['id'].'" '.$selected.'>'.$v['nama'].'</option>';
		}


		$input_produk='<select class="class_product form-control product-select2" id="produk_'.uniqid().'" name="produk[]">'.$option_produk_detail.'</select>';
		$input_deskripsi='<textarea class="class_deskripsi form-control" name="deskripsi[]">'.$nama_produk.'</textarea>';
		$input_nominal='<input class="class_nominal format-angka form-control" type="text" name="nominal[]" value="'.$harga_produk.'">';
		$tabel_transaksi.='
		<tr id="row_'.$d_detail['id'].'">
		<td>'.$input_produk.'</td>
		<td>'.$input_deskripsi.'</td>
		<td>'.$input_nominal.'</td>
		<td>
		<a class="" href="#" onclick="hapus_detail(this);" data-row="row_'.$d_detail['id'].'"><i class="fa fa-trash fa-1x"></i></a>
		</tr>';
	}
}
$tabel_transaksi.='</table>';
$deal_id=cleanInput($_GET['deal_id']);
$termin_ke=cleanInput($_GET['termin'],'numeric');
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" class="yona-form" action="$do_action" class="yona-validation" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
				<input type="hidden" name="deal_id" value="$deal_id" />
				<input type="hidden" name="termin_ke" value="$termin_ke" />
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
							$form_template
							</div>
							<div class="form-group">
							$form_tanggal 
							</div>
							<div class="form-group">
							$form_tanggal_jatuh_tempo
							</div>
							
						</div>
				
						<div class="col-md-12">
							<div id="list-transaksi-container">
							
								<div id="list_transaksi" class="p-3" >
									$tabel_transaksi
								</div>	
								<div class="form-group pl-3">
									<button type="button" class="btn btn-info" data-toggle="modal" data-judul="Tambah item" data-tombol="Simpan" data-mode="add" data-target="#transaksiModal"><i class="fa fa-plus"></i> Item</button>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							$form_dp
							</div>
							<div class="form-group">
							$form_diskon
							</div>
							<h3  id="total" class="m-0 mb-3 text-right">0</h3>
						
						</div>
					</div>
		
			
				 </div>
                <!-- /.card-body -->
				<br/><br/><br/>
                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

	</div>
		<div class="modal fade" id="transaksiModal"  data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="transaksiModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="transaksiModalLabel">Tambah item</h5>
				<button type="button" class="close" onclick="clear_form();" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<form>
				 <input type="hidden" id="input_mode" name="input_mode" value="" />
				 <input type="hidden" id="row_id" name="row_id" value="" />
				 <div class="form-group">
				 <label for="produk" class="col-form-label">Produk:</label>
				 <select class="form-control select2modal" id="produk">$option_produk</select>
				   </div>
				  <div class="form-group">
					<label for="transaksi_item" class="col-form-label">Deskripsi:</label>
					<textarea class="form-control" id="transaksi_item"></textarea>
				  </div>
				  <div class="form-group">
					<label for="transaksi_nominal" class="col-form-label">Nominal:</label>
					<input type="text" class="form-control format-angka" id="transaksi_nominal">
				  </div>
				
				</form>
			  </div>
			  <div class="modal-footer">
				<button id="close_button" type="button" onclick="clear_form();" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="tombol_update" class="btn btn-primary" onclick="simpan()">Tambah</button>
			  </div>
			</div>
		  </div>
		</div>


END;

$url_ajax=backendurl("$modul/get_customer");
$url_ajax_detail_customer=backendurl("$modul/get_customer_detail");
$url_ajax_transaction_customer=backendurl("$modul/get_customer_transaction");
$script_js.=<<<END
<script>
function get_transaction(id_customer) {
	$.get( "$url_ajax_transaction_customer?id_customer="+id_customer, function( data ) {
			
			if(data.length>0) {
				$("#info_transaction").html(data);
			
			} else {
				$("#info_transaction").html('');
				alert('Data tidak ditemukan');
			}
		});
}
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
	
	$('.js-customer').on('select2:select', function (e) {
	  data = e.params.data;
	    id_customer=data.id;
		$.get( "$url_ajax_detail_customer?id_customer="+id_customer, function( data ) {
			
			if(data.length>0) {
				
				var obj = JSON.parse(data);
				$("#perusahaan").val(obj.perusahaan);
				$("#nama").val(obj.nama);
				$("#hp").val(obj.hp);
				$("#alamat").html(obj.alamat);
				$("#info_customer").html('');
				
		
			
			} else {
				$("#info_customer").html('');
				alert('tidak ditemukan');
			}
		});
	  
	});
	
	
});
</script>
END;

}

if($action=="")
{
$btn_tambah=button_add("$modul/add");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Data transaksi</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Nomor</th>
				<th>Perusahaan</th>
				<th>HP</th>
				<th>PIC</th>
				<th style="width:150px;">Action</th>
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
	
	$column_order = array('b.created_at','b.perusahaan','b.nama','b.hp');
	$column_search = array('b.tanggal','b.nomor','b.nama','b.hp','b.perusahaan','b.alamat');
	$order = array('b.tanggal' => 'DESC');
	/*
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY B.tanggal DESC,b.created_date DESC ";
	}
	*/
	$order_by = " ORDER BY b.tanggal DESC,b.created_at DESC ";
	if ($_POST['length'] != -1 AND $_POST['length']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['length']}";
	}
	$i = 0;
	$sql_search=array();
	foreach ($column_search as $item) { // loop column 
		
		if($_POST['search']['value']) { // if datatable send POST for search
			
			$sql_search[]= " $item LIKE '%".addslashes($_POST['search']['value'])."%' ";
		}
		$i++;
	}
	
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	
	$sql=" SELECT b.id,b.nomor,date_format(b.tanggal,'%d/%m/%Y') tanggal,b.nama,b.perusahaan,b.status_lunas,b.kota,b.hp,b.printed_by FROM $modul b  ";
	
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
		$row[]=$d['status_lunas']==0?'<span style="color:#ff0000">'.$d['tanggal'].'</span>':$d['tanggal'];
		$row[]=$d['perusahaan'];
		$row[]=$d['hp'];
		$row[]=$d['nama'];
	//	$action_add=btn_general(backendurl("$modul/pdf-invoice/".$d['id']),'fa-file-invoice-dollar');
	//	$action_add.=btn_general(backendurl("$modul/pdf-list/".$d['id']),'fa-archive');
		if($daftar_hak[$modul]['edit']==1 AND $d['printed_by']<=0) {
			$action_edit='<a  title="Edit Data" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		//if($d['printed_by']>0) {
		$action_print=btn_print_small(backendurl("antrian_cetak/pra_cetak/".$d['id']))."&nbsp;&nbsp;&nbsp;";
		//} else {
		//$action_print="";
		//}
		if($daftar_hak[$modul]['del']==1) {
		$action_delete='<a class=""  title="Hapus Kategori"
				data-toggle="modal" 
				data-target="#modal-default" 
				data-title="Hapus Data" 
				data-body="Apakah anda yakin ingin menghapus Data ini?"
				data-btn2=""
				data-btn2name=""
				data-btn1="'.backendurl("$modul/del/".$d['id']).'"
				data-btn1name="Hapus"
				>
				<i class="fa fa-trash"></i>
		</a>';
		}
		$row[]=$action_print.$action_edit.$action_delete;
		
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
if($action=="view") {
	list($data_invoice)=$mysql->query_data("
	 SELECT * FROM invoice WHERE id=$id
	");
	echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
				<div class="card-body">
					
				 </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Submit</button>
                </div>
           
            </div>
            <!-- /.card -->

END;

}

if($action=="pdf-list") {

list($data)=$mysql->query_data("SELECT * FROM invoice WHERE id=$id");
$detail=$mysql->query_data("
	SELECT 
		m.id,m.awb,m.jml_koli,m.jenis_kiriman,m.satuan,m.jenis_harga,m3,total_m3,kg,total_kg,harga_m3,harga_kg,m.total_harga
		FROM 
			invoice_detail d 
		LEFT JOIN master_data m ON m.id=d.id_master_data
	WHERE d.id_invoice=$id
");

b_load_lib("TCPDF-master/tcpdf");
//$pageLayout = array($width=10, $height=6); //  or array($height, $width) 
//$pdf = new TCPDF('L', 'cm', $pageLayout, true, 'UTF-8', false);
$pageLayout = A4; //  or array($height, $width) 
$pdf = new TCPDF('P', 'mm', $pageLayout, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('balda');
$pdf->SetTitle('balda');
$pdf->SetSubject('balda');
$pdf->SetKeywords('balda');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(8,10,8, false); // set the margins 

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);
$pdf->setListIndentWidth(4);

// Add a page
// This method has several options, check the source code documentation for more information.
//$pdf->AddPage('L', array(140,210));
//$pdf->AddPage('P','A4');
$pdf->AddPage();
ob_start();

?>
	<table>
		<tr>
			<td style="width:55%;">
				<img style="height:60px" src="<?php echo fileurl("asset/")?>logo.jpg">
			</td>
			<td  style="width:45%;text-align:center;font-size:11pt">
				<h1 style="font-size:20pt;text-align:right;line-height:0.9">PACKING LIST</h1>
			</td>
		</tr>
	</table>
	<p style="line-height:0">&nbsp;</p>
	<table cellpadding="5" style="font-size:11pt">
		<tr>
			<td width="50%">
				<table cellpadding="2">
					<tr>
						<td width="35%">Terima Dari</td>
						<td width="5%">:</td>
						<td width="60%"><?php echo $data['nama']?></td>
					</tr>
					<tr>
						<td>Nahkoda</td>
						<td>:</td>
						<td><?php echo $data['kapal_nahkoda']?></td>
					</tr>
					<tr>
						<td>No. Cont.</td>
						<td>:</td>
						<td><?php echo $data['kontainer_no']?></td>
					</tr>
					<tr>
						<td>No. Konosemen</td>
						<td>:</td>
						<td><?php echo $data['konosemen_no']?></td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table cellpadding="2">
					<tr>
						<td width="35%">Diangkut Kapal</td>
						<td width="5%">:</td>
						<td width="60%"><?php echo $data['kapal_nama']?></td>
					</tr>
					<tr>
						<td>VOY</td>
						<td>:</td>
						<td><?php echo $data['voy']?></td>
					</tr>
					<tr>
						<td>Kondisi</td>
						<td>:</td>
						<td><?php echo $data['kondisi']?></td>
					</tr>
					<tr>
						<td>Bayar di</td>
						<td>:</td>
						<td><?php echo $data['bayar_di']?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<p style="line-height:0">&nbsp;</p>
	<table cellpadding="5" style="font-size:11pt;border-bottom:1px solid #000">
		<tr style="border:1px solid #000">
			<td width="20%" style="border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">Code</td>
			<td width="8%" align="center" style="border-top:1px solid #000;border-bottom:1px solid #000;">Jumlah</td>
			<td width="10%" align="center" style="border-top:1px solid #000;border-bottom:1px solid #000;">Satuan</td>
			<td width="42%" style="border-top:1px solid #000;border-bottom:1px solid #000;">Uraian Barang</td>
			<td width="10%" align="center" style="border-top:1px solid #000;border-bottom:1px solid #000;">M3</td>
			<td width="10%" align="center" style="border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">TON</td>
		</tr>
		<?php foreach($detail as $i => $detail_data):?>
		<?php 
		$total_kubik+=$detail_data['total_m3'];
		$total_kg+=$detail_data['total_kg'];
		$total_koli+=$detail_data['jml_koli'];
		?>
		<tr>
			<td><?php echo $detail_data['awb']?></td>
			<td align="center"><?php echo $detail_data['jml_koli']?></td>
			<td align="center"><?php echo $detail_data['satuan']?></td>
			<td><?php echo $detail_data['jenis_kiriman']?></td>
			<td align="right"><?php echo format_angka($detail_data['total_m3'])?></td>
			<td align="right"><?php echo format_angka($detail_data['total_kg'])?></td>
		</tr>
		<?php endforeach;?>
		
		<tr id="total">
			<td></td>
			<td align="center" style="border-top:1px solid #000"><?php echo format_angka($total_koli);?></td>
			<td align="center" colspan="2">TOTAL</td>
			<td align="right" style="border-top:1px solid #000"><?php echo format_angka($total_kubik);?></td>
			<td align="right" style="border-top:1px solid #000"><?php echo format_angka($total_kg);?></td>
		</tr>
	</table>
	<p style="line-height:0">&nbsp;</p>
	<table cellpadding="5">
		<tr>
			<td width="40%">
				<table cellpadding="10" style="border:1px solid #f00;font-size:9pt">
					<tr>
						<td>
							Shipper wajib mengasuransukan barang. Kami tidak menggati kerusakan yang
						</td>
					</tr>
				</table>
			</td>
			<td width="25%">
			</td>
			<td width="35%">
				<table style="font-size:11pt">
					<tr>
						<td width="37%">Surabaya,</td>
						<td width="63%" align="right"><?php echo tgl_indo_long($data['tanggal'])?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php
$html=ob_get_clean();
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$filename='Data '.date("Y-m-d H:i:s").'.pdf';

$pdf->Output($filename, 'I');

die('');

}
?>
