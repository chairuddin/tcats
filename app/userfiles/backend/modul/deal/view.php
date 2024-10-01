<?php

if($action=="add" OR $action=="edit")
{
	if($action=='add') {
		//cek if exist deal_id from prospek_list
		$q_prospek_list_id_exist=$mysql->query("SELECT * FROM deal WHERE prospek_list_id=$id");
		if($q_prospek_list_id_exist and $mysql->num_rows($q_prospek_list_id_exist)) {
			$deal_data=$mysql->fetch_assoc($q_prospek_list_id_exist);
			$deal_id=$deal_data['id'];
			header("location:".backendurl("$modul/edit/$deal_id"));
			exit();
		}
	}	
$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$deal_id=$id;

if($action=="edit") {
	$_POST['nominal_deal']=currency($_POST['nominal_deal']);
	$_POST['tanggal']=ymd_to_dmy($_POST['tanggal']);
}
if($action=="add") {
	$tanggal_deal=$mysql->get1value(" SELECT last_fu FROM prospek_followup WHERE prospek_list_id=$id ");
	$prospek_id=$mysql->get1value(" SELECT prospek_id FROM prospek_list WHERE id=$id ");
	$harga_produk=$mysql->get1value(" SELECT harga FROM produk WHERE id IN ( SELECT produk_id FROM prospek WHERE id=$prospek_id ) ");


	$_POST['tanggal']=$_POST['tanggal']==""?ymd_to_dmy($tanggal_deal):ymd_to_dmy($_POST['tanggal']);
	$_POST['nominal_deal']=$_POST['nominal_deal']==""?currency($harga_produk):currency($_POST['nominal_deal']);
}
$option_kota=array(
	''=>'Pilih Kota',
	'1'=>'Buat dulu bos pilihan kotanya pakai select2',
);

$option_kelamin=array(
	''=>'Pilih Jenis Kelamin',
	'1'=>'Laki-laki',
	'2'=>'Perempuan',
);
$option_termin=array(
	0=>'Pilih Termin',
	1=>'1',
	2=>'2',
	3=>'3',
	4=>'4',
	5=>'5',
	6=>'6',
	7=>'7',
	8=>'8',
	9=>'9',
	10=>'10',

);


$form_termin=$form->element_Select("Jumlah Termin","termin",$option_termin,array("onchange"=>"change_termin()"),$mode=array('label'=>4,'input'=>8));
$form_tanggal=$form->element_Textbox("Tanggal Deal","tanggal",array('class'=>'tanggal'),$mode=array('label'=>4,'input'=>8));
$form_nominal_deal=$form->element_Textbox("Nominal Deal","nominal_deal",array('class'=>'format-angka'),$mode=array('label'=>4,'input'=>8));


$form_termin_1=$form->element_Textbox("Termin 1 (%)","termin_1",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_1')"),$mode=array('label'=>4,'input'=>4));
$form_termin_2=$form->element_Textbox("Termin 2 (%)","termin_2",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_2')"),$mode=array('label'=>4,'input'=>4));
$form_termin_3=$form->element_Textbox("Termin 3 (%)","termin_3",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_3')"),$mode=array('label'=>4,'input'=>4));
$form_termin_4=$form->element_Textbox("Termin 4 (%)","termin_4",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_4')"),$mode=array('label'=>4,'input'=>4));
$form_termin_5=$form->element_Textbox("Termin 5 (%)","termin_5",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_5')"),$mode=array('label'=>4,'input'=>4));
$form_termin_6=$form->element_Textbox("Termin 6 (%)","termin_6",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_6')"),$mode=array('label'=>4,'input'=>4));
$form_termin_7=$form->element_Textbox("Termin 7 (%)","termin_7",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_7')"),$mode=array('label'=>4,'input'=>4));
$form_termin_8=$form->element_Textbox("Termin 8 (%)","termin_8",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_8')"),$mode=array('label'=>4,'input'=>4));
$form_termin_9=$form->element_Textbox("Termin 9 (%)","termin_9",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_9')"),$mode=array('label'=>4,'input'=>4));
$form_termin_10=$form->element_Textbox("Termin 10 (%)","termin_10",array('class'=>'format-angka','onkeyup'=>"hitung_termin('termin_10')"),$mode=array('label'=>4,'input'=>4));


if($action=='edit') {
	$info_prospek=info_prospek($d['prospek_list_id']);

}
if($action=='add') {
	$info_prospek=info_prospek($id);
}
$html_info='
	
	<h5 class="mb-sm-3">Target </h5>
	<div class="data-container">
    		<div class="data-item">
      			<span class="data-label pl-3"><strong class="text-dark mr-5">Produk</strong></span> <span>'.$info_prospek['produk_nama'].'</span>
    		</div>
  	</div>
	<hr/>	
	<h5 class="mb-sm-3">Lembaga </h5>	 		
	  <div class="data-container">
		  <div class="data-item">
				<span class="data-label pl-3"><strong class="text-dark mr-5">Nama</strong></span> <span>'.$info_prospek['lembaga_nama'].'</span>
		  </div>
		<div class="data-item">
			<span class="data-label pl-3"><strong class="text-dark mr-5">Alamat</strong></span> <span>'.$info_prospek['lembaga_alamat'].'</span>
		</div>
		<div class="data-item">
				<span class="data-label pl-3"><strong class="text-dark mr-5">Telp</strong></span> <span>'.$info_prospek['lembaga_telp'].'</span>
		</div>
		<div class="data-item">
				<span class="data-label pl-3"><strong class="text-dark mr-5">Email</strong></span> <span><a href="mailto:'.$info_prospek['lembaga_email'].'">'.$info_prospek['lembaga_email'].'</a></span>
		</div>
 	 </div>
	  <hr/>
	  <h5 class="mb-sm-3">PIC </h5>	 		
	  <div class="data-container">
		  <div class="data-item">
				<span class="data-label pl-3"><strong class="text-dark mr-5">Nama</strong></span> <span>'.$info_prospek['pic_nama_lengkap'].'</span>
		  </div>
		<div class="data-item">
			<span class="data-label pl-3"><strong class="text-dark mr-5">Panggilan</strong></span> <span>'.$info_prospek['pic_nama_panggilan'].'</span>
		</div>
		<div class="data-item">
				<span class="data-label pl-3"><strong class="text-dark mr-5">Jabatan</strong></span> <span>'.$info_prospek['pic_jabatan'].'</span>
		</div>
		<div class="data-item">
			<span class="data-label pl-3"><strong class="text-dark mr-5">Agama</strong></span> <span>'.$info_prospek['pic_agama'].'</span>
		</div>
		<div class="data-item">
			<span class="data-label pl-3"><strong class="text-dark mr-5">Whatsapp</strong></span> <span><a href="https://wa.me/'.zeroto62($info_prospek['pic_whatsapp']).'">'.$info_prospek['pic_whatsapp'].'</a></span>
		</div>
		<div class="data-item">
			<span class="data-label pl-3"><strong class="text-dark mr-5">Email</strong></span> <span><a href="mailto:'.$info_prospek['pic_email'].'">'.$info_prospek['pic_email'].'</a></span>
		</div>
 	 </div>
	';
	



$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Deal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" class="yona-form" autocomplete="off" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
				<div class="row">
				<div class="col-md-4">
				
					<div class="form-group row">
						$form_tanggal
					</div>
					<div class="form-group row">
						$form_nominal_deal
					</div>
					<div class="form-group row">
						$form_termin
					</div>
					<div class="form-group row termin-1">
						$form_termin_1
						<span id="termin_1_nominal" class="pl-3 mt-3 
						"></span>
					</div>
					<div class="form-group row termin-2">
						$form_termin_2
						<span id="termin_2_nominal" class="pl-3 mt-3"></span>
					</div>
					<div class="form-group row termin-3">
						$form_termin_3
						<span id="termin_3_nominal" class="pl-3 mt-3" ></span>
					</div>
					<div class="form-group row termin-4">
						$form_termin_4
						<span id="termin_4_nominal" class="pl-3 mt-3"></span>
					</div>
					<div class="form-group row termin-5">
						$form_termin_5
						<span id="termin_5_nominal" class="pl-3 mt-3"></span>
					</div>
				
					<div class="form-group row termin-6">
						$form_termin_6
						<span id="termin_6_nominal" class="pl-3 mt-3"></span>
					</div>
					<div class="form-group row termin-7">
						$form_termin_7
						<span id="termin_7_nominal" class="pl-3 mt-3"></span>
					</div>
					<div class="form-group row termin-8">
						$form_termin_8
						<span id="termin_8_nominal" class="pl-3 mt-3"></span>
					</div>
					<div class="form-group row termin-9">
						$form_termin_9
						<span id="termin_9_nominal" class="pl-3 mt-3"></span>
					</div>
					<div class="form-group row termin-10">
						$form_termin_10
						<span id="termin_10_nominal" class="pl-3 mt-3"></span>
					</div>
					
					
					
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6">
				$html_info
				</div>
				</div>
		
				 
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
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
		  <h3 class="card-title">Deal</h3>
		 
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Lembaga</th>
				<th>Nominal</th>
				<th>Termin</th>
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
	
	$column_order = array('b.id','b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$column_search = array('b.lembaga_nama','b.lembaga_telp','b.lembaga_email');
	$order = array('b.nama' => 'ASC');
	
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
	
	$sql=" SELECT d.id,d.kode,b.lembaga_nama,d.nominal_deal,d.termin,(select count(id) FROM invoice where deal_id=d.id) jml_invoice FROM deal d LEFT JOIN lembaga b  ON d.lembaga_id=b.id ";
	
	$sql.=" WHERE 1=1  ";

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
		$row[]=$d['lembaga_nama'];
		$row[]=currency($d['nominal_deal']);
		$row[]=$d['jml_invoice']."/".$d['termin'];
		
		//$action_edit='<a  title="Invoice" href="'.backendurl("invoice/add?deal_id=".$d['id']).'"><i class="fa fa-folder-open" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		//$action_edit='<a  title="Dashboard" href="'.backendurl("deal/dokumen/".$d['id']).'"><i class="fa fa-folder-open" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_edit=btn_folder(backendurl("deal/dokumen/".$d['id']),array('title'=>'Kelola invoice, dokumen SPK dan MoU '));
		if($daftar_hak[$modul]['edit']==1) {
		//	$action_edit.='<a  title="Edit Lembaga" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
		$action_edit.=btn_edit(backendurl("$modul/edit/".$d['id']));	
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

if($action=='dokumen') {
$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
$deal_id=$id;






$info_prospek=info_prospek($d['prospek_list_id']);


echo '
<div class="card">
	<div class="card-body">
	<div class="row">
		<div class="col-md-6">
			<h4 class="mb-sm-3">Produk </h4>	 
			<div class="data-container mb-3">
				<div class="data-item">
					<span class="data-label"><strong class="text-dark mr-5">Produk</strong></span> <span>'.$info_prospek['produk_nama'].'</span>
				</div>
			</div>	
			<h4 class="mb-sm-3">Lembaga </h4>	 
			<div class="data-container">
				<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Nama</strong></span> <span>'.$info_prospek['lembaga_nama'].'</span>
				</div>
				<div class="data-item">
					<span class="data-label"><strong class="text-dark mr-5">Alamat</strong></span> <span>'.$info_prospek['lembaga_alamat'].'</span>
				</div>
				<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Telp</strong></span> <span>'.$info_prospek['lembaga_telp'].'</span>
				</div>
				<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Email</strong></span> <span><a href="mailto:'.$info_prospek['lembaga_email'].'">'.$info_prospek['lembaga_email'].'</a></span>
				</div>
			</div>	
		</div>
		<div class="col-md-6">
		
			<h4 class="mb-sm-3">PIC </h4>	 		
			<div class="data-container">
					<div class="data-item">
							<span class="data-label"><strong class="text-dark mr-5">Nama</strong></span> <span>'.$info_prospek['pic_nama_lengkap'].'</span>
					</div>
					<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Panggilan</strong></span> <span>'.$info_prospek['pic_nama_panggilan'].'</span>
					</div>
					<div class="data-item">
							<span class="data-label"><strong class="text-dark mr-5">Jabatan</strong></span> <span>'.$info_prospek['pic_jabatan'].'</span>
					</div>
					<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Agama</strong></span> <span>'.$info_prospek['pic_agama'].'</span>
					</div>
					<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Whatsapp</strong></span> <span><a href="https://wa.me/'.zeroto62($info_prospek['pic_whatsapp']).'">'.$info_prospek['pic_whatsapp'].'</a></span>
					</div>
					<div class="data-item">
						<span class="data-label"><strong class="text-dark mr-5">Email</strong></span> <span><a href="mailto:'.$info_prospek['pic_email'].'">'.$info_prospek['pic_email'].'</a></span>
					</div>
			</div>
			
		</div>
	</div>
	
	  
</div>
</div>
	';






//link mou
$display_link_mou='style="display:none;"';
if(file_exists(filepath("deal/".$d['doc_mou'])) && strlen($d['doc_mou'])>0) {
	$display_link_mou='';
}
$download_link_mou=	fileurl("deal/".$d['doc_mou']);
$link_mou=<<<END
<a href="$download_link_mou" $display_link_mou target="_BLANK" id="doc_mou_link"><button type="button" class="btn mb-1 btn-rounded btn-success"><span class="btn-icon-left"><i class="fa fa-download color-warning"></i> </span>Download MOU</button></a>
END;	
 
$display_link_spk='style="display:none;"';
if(file_exists(filepath("deal/".$d['doc_spk']))  && strlen($d['doc_spk'])>0) {
	$display_link_spk='';
}
$download_link_spk=	fileurl("deal/".$d['doc_spk']);
$link_spk=<<<END
<a href="$download_link_spk" $display_link_spk target="_BLANK" id="doc_spk_link"><button type="button" class="btn mb-1 btn-rounded btn-success"><span class="btn-icon-left"><i class="fa fa-download color-warning"></i> </span>Download SPK</button></a>	
END;	

$document_mou= <<<END
<div class="card">
			<div class="card-body pb-0 d-flex justify-content-between">
				<div>
					<h4 class="mb-1">MOU</h4>
				</div>
	
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<label class="btn mb-1 btn-rounded btn-success">
						<span class="btn-icon-left"><i class="fa fa-upload color-success"></i> </span>Upload<input type="file" id="doc_mou" style="display:none;" onchange="uploadFile('doc_mou','$deal_id')"/>
						</label>
					</div>
					<div class="col-md-6 text-right link-donload-mou">
						$link_mou
					</div>
					<div class="col-md-12">

						<div class="progress mt-3" style="display: none;" id="doc_mou_progress">
							<div id="doc_mou_progressBar" class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
	
					</div>
				</div>
		</div>
</div>		

END;



$document_spk= <<<END
<div class="card">
			<div class="card-body pb-0 d-flex justify-content-between">
				<div>
					<h4 class="mb-1">SPK</h4>
				</div>
	
			</div>
			
			<div class="card-body">

				<div class="row">
					<div class="col-md-6">

						<label class="btn mb-1 btn-rounded btn-success">
						<span class="btn-icon-left"><i class="fa fa-upload color-success"></i> </span>Upload<input type="file"  style="display:none;" id="doc_spk" onchange="uploadFile('doc_spk','$deal_id')"/>
						</label>
					</div>
					<div class="col-md-6 text-right link-donwload-spk">
						$link_spk
					</div>
					<div class="col-md-12">

						<div class="progress mt-3" style="display: none;" id="doc_spk_progress">
							<div id="doc_spk_progressBar" class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="0"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
</div>
		
END;



echo <<<END
<div class="row">
	<div class="col-md-6">$document_mou</div>
	<div class="col-md-6">$document_spk</div>
</div>
END;



$termin=$d['termin'];
$nominal_deal=$d['nominal_deal'];
$list_invoice='';
for($i=1;$i<=$termin;$i++) {

	$q=$mysql->query("SELECT i.*,m.alias metode_bayar FROM invoice i LEFT JOIN metode_bayar m ON m.id=i.metode_bayar WHERE i.deal_id=$id AND i.termin_ke=$i ");
	if($q and $mysql->num_rows($q)>0) {
		while($invoice=$mysql->fetch_assoc($q)) {

			$tombol_action='';
		//	$action_edit='<a  title="Calendar" href="'.backendurl("kegiatan/add/?invoice_id=".$invoice['id']).'"><i class="fa fa-calendar" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			$action_edit="";
			if($daftar_hak['invoice']['edit']==1) {
				//$action_edit.='<a  title="Edit Data" href="'.backendurl("invoice/edit/".$invoice['id']).'"><i class="fa fa-edit" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
				$action_edit=btn_edit(backendurl("invoice/edit/".$invoice['id']));
			}
			//if($d['printed_by']>0) {
			//$action_edit.='<a  title="Lunas" href="'.backendurl("antrian_cetak/edit/".$invoice['id']).'"><i class="fa fa-check" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			$action_edit=btn_done(backendurl("antrian_cetak/edit/".$invoice['id']),array('title'=>'Tandai sebagai lunas'));
			

			$action_print=btn_print_small(backendurl("antrian_cetak/pra_cetak/".$invoice['id']),array('title'=>'Cetak'))."&nbsp;&nbsp;&nbsp;";
			//} else {
			//$action_print="";
			//}
			
			if($daftar_hak['invoice']['del']==1) {
				if($invoice['status_lunas'] <=0 ) {
					$action_delete=btn_delete_swal(backendurl("invoice/del/".$invoice['id']));
				}
			}
			$tombol_action=$action_print.$action_edit.$action_delete;



		
			$list_invoice.='<tr>';
			$list_invoice.='<td>'.$i.'</td>';
			$list_invoice.='<td>'.$invoice['nomor'].'</td>';
			$list_invoice.='<td>'.ymd_to_dmy($invoice['tanggal']).'</td>';
			$list_invoice.='<td>'.ymd_to_dmy($invoice['tanggal_jatuh_tempo']).'</td>';
			$list_invoice.='<td>'.currency($invoice['total_harga'],"Rp ").'</td>';
			$list_invoice.='<td>'.($invoice['status_lunas']==1?'<span class="badge badge-success px-2">Lunas</span>':($invoice['status_lunas']==2?'<span class="badge badge-error px-2">Batal</span>':'')).'</td>';
			$list_invoice.='<td>'.$invoice['metode_bayar'].'</td>';
			$list_invoice.='<td>'.$tombol_action.'</td>';
			$list_invoice.='</tr>';
		}
	} else {
		$list_invoice.='<tr>';
		$list_invoice.='<td>'.$i.'</td>';
		$list_invoice.='<td colspan="6">';
		$list_invoice.='<a class="btn btn-success" href="'.backendurl("invoice/add?deal_id=".$d['id']."&termin=".$i).'"><i class="fa fa-plus"></i>&nbsp; Buat invoice termin ke '.$i.' sebesar '.$d['termin_'.$i].'%</a>';
		$list_invoice.='</td>';
		$list_invoice.='</tr>';
	}
	


}

echo <<<END
<div class="card">
	<div class="card-body pb-0 d-flex justify-content-between">
		<div>
			<h4 class="mb-1">INVOICE</h4>
		</div>
	</div>
	<div class="card-body">
	<div class="table-reponsive">
	<table class="table table-striped">
		<tr>
			<th>No.</th>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>Jatuh Tempo</th>
			<th>Nominal</th>
			<th>Status</th>
			<th>Via</th>
			<th>Action</th>
		</tr>
		$list_invoice
	</table>
	</div>
	</div>
</div>
END;



}
?>
