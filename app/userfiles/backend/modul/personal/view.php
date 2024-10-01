<?php
if($action=='download_template') {
ob_start();
error_reporting(0);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
// Create new PHPExcel object

//																						created_at	created_by	modified_at	modified_by	deleted_at	deleted_by
$objPHPExcel = new PHPExcel();


// Set document properties
$objPHPExcel->getProperties()->setCreator("Kuanta")
 ->setLastModifiedBy("Kuanta")
 ->setTitle("Template import personal")
 ->setSubject("Template import personal")
 ->setDescription("Template import personal")
 ->setKeywords("Template import personal")
 ->setCategory("Template import personal");


 $jumlah_field=count($field);
 $kolom=kolom_excel($jumlah_field,$mulai="A");
$idx=0;
 foreach($field as $id_field => $label) {
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($kolom[$idx].'1',$label);
	$idx++;
}
 /*
  $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',"Lembaga Jenis")
            ->setCellValue('B1',"NPSN")
            ->setCellValue('C1',"NPYP")
            ->setCellValue('D1',"Jurusan")
            ->setCellValue('E1',"Ruang")
            ->setCellValue('F1',"Sandi");
	*/
	/*
	$q=$mysql->query("SELECT * FROM user WHERE level<=1 ");
	$no=2;
	while($d=$mysql->assoc($q))
	{
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$no,$d['username'])
			->setCellValue('B'.$no,$d['password'])
			->setCellValue('C'.$no,$d['fullname']);
	$no++;		
	}      
	*/      
	
	$no=2;
	/*
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$no,"TKJ1001")
			->setCellValue('B'.$no,"Romli")
			->setCellValue('C'.$no,"TKJ-A")
			->setCellValue('D'.$no,"TEKNIK KOMPUTER DAN JARINGAN")
			->setCellValue('E'.$no," 01")
			->setCellValue('F'.$no,"123456");
	*/

	$objPHPExcel->getActiveSheet()
	->getStyle("E$no")
	->getNumberFormat()
	->setFormatCode(
		PHPExcel_Style_NumberFormat::FORMAT_GENERAL
	);   	
		
$filename="Template Import personal";
$sheet_title="Daftar personal";

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($sheet_title);
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

die();

}

if($action=="add" OR $action=="edit")
{

$r=$mysql->query("SELECT 
npsn,
nama_lengkap pic_nama_lengkap, 
nama_panggilan pic_nama_panggilan,
whatsapp pic_whatsapp,
email pic_email,
agama pic_agama,
status_pekerjaan,
tanggal_lahir pic_tanggal_lahir,
kelamin pic_kelamin,
jabatan pic_jabatan,
tahun_menjabat pic_tahun_menjabat
from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$_POST['expired']=($_POST['expired']=='' or $_POST['expired']=='0000-00-00')?date("d/m/Y"):ymd_to_dmy($_POST['expired']);
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$option_lembaga_jenis=option_lembaga_jenis();
$option_lembaga_jenjang=option_lembaga_jenjang();
$option_lembaga_status=array(
	''=>'Pilih Status',
	'N'=>'Negeri',
	'S'=>'Swasta'
);

if($action=="edit") {
	$_POST['harga']=currency($_POST['harga']);
}

$option_kota=array();
$list_kota=list_kota();
$option_kota[]='Pilih';
foreach($list_kota as $index =>$r_kota) {
	$option_kota[$r_kota['id']]=$r_kota['nama'];
}

$option_kelamin=array(
	''=>'Pilih Jenis Kelamin',
	'1'=>'Laki-laki',
	'2'=>'Perempuan',
);

$option_status_pekerjaan=array(
	''=>'Pilih ',
	'1'=>'Pengurus yayasan',
	'2'=>'GTK/PTK',
);

$form_lembaga_jenjang=$form->element_Select("Jenjang Lembaga","lembaga_jenjang",$option_lembaga_jenjang,array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_status=$form->element_Select("Status","lembaga_status",$option_lembaga_status,array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_kota=$form->element_Select("Kota","lembaga_kota",$option_kota,array('class'=>'select2'),$mode=array('label'=>4,'input'=>8));

$form_npsn=$form->element_Textbox("NPSN","npsn",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_nama=$form->element_Textbox("Nama Lembaga","lembaga_nama",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_alamat=$form->element_Textarea("Alamat","lembaga_alamat",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_telp=$form->element_Textbox("Telp","lembaga_telp",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_email=$form->element_Textbox("Email","lembaga_email",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_website=$form->element_Textbox("Website","lembaga_website",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_tahun_berdiri=$form->element_Textbox("Tahun Berdiri","lembaga_tahun_berdiri",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_ulang_tahun=$form->element_Textbox("Ulang Tahun","lembaga_ulang_tahun",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_jumlah_siswa=$form->element_Textbox("Jumlah Siswa","lembaga_jumlah_siswa",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_biaya_spp=$form->element_Textbox("Biaya SPP Sekolah","lembaga_biaya_spp",array(),$mode=array('label'=>4,'input'=>8));
$form_lembaga_biaya_pendaftaran=$form->element_Textbox("Biaya Pendaftaran","lembaga_biaya_pendaftaran",array(),$mode=array('label'=>4,'input'=>8));
$form_status_pekerjaan=$form->element_Select("Status saat ini","status_pekerjaan",$option_status_pekerjaan,array('class'=>'select2'),$mode=array('label'=>4,'input'=>8));

$form_pic_nama_lengkap=$form->element_Textbox("Nama Lengkap","pic_nama_lengkap",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_nama_panggilan=$form->element_Textbox("Nama Panggilan","pic_nama_panggilan",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_kelamin=$form->element_Select("Jenis Kelamin","pic_kelamin",$option_kelamin,array(),$mode=array('label'=>4,'input'=>8));
$form_pic_whatsapp=$form->element_Textbox("Whatsapp","pic_whatsapp",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_email=$form->element_Textbox("Email","pic_email",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_tanggal_lahir=$form->element_Date("Tanggal Lahir","pic_tanggal_lahir",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_agama=$form->element_Textbox("Agama","pic_agama",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_jabatan=$form->element_Textbox("Jabatan","pic_jabatan",array(),$mode=array('label'=>4,'input'=>8));
$form_pic_tahun_menjabat=$form->element_Textbox("Tahun Menjabat","pic_tahun_menjabat",array(),$mode=array('label'=>4,'input'=>8));
$jadwal_id=cleanInput($_GET["jadwal_id"]);
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Personal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" class="yona-validation" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
				<input type="hidden" name="jadwal_id" value="$jadwal_id" />
                <div class="card-body">
				<div class="row">
				<div class="col-md-5">
					<h5>Data Lembaga</h5>
					<div class="form-group row">
						$form_lembaga_jenis
					</div>	
				
					<div class="form-group row field-sekolah">
						$form_npsn
					</div>	
					
					<div class="form-group row field-yayasan field-lembaga" >
						$form_npyp
					</div>
					<div class="form-group row field-ngo field-lembaga" >
						$form_kode
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_nama
					</div>		
					<div class="form-group row field-lembaga">
						$form_lembaga_jenjang
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_status
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_alamat
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_kota
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_telp
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_email
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_website
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_tahun_berdiri
					</div>	
					<div class="form-group row field-lembaga">
						$form_lembaga_ulang_tahun
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_jumlah_siswa
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_biaya_spp
					</div>
					<div class="form-group row field-lembaga">
						$form_lembaga_biaya_pendaftaran
					</div>	
					
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-5">
				<h5>Data Personal</h5>
					<div class="form-group row">
					$form_status_pekerjaan
					</div>	
					<div class="form-group row">
					$form_pic_nama_lengkap
					</div>		
					<div class="form-group row">
					$form_pic_nama_panggilan
					</div>
					<div class="form-group row">
					$form_pic_kelamin
					</div>
					<div class="form-group row">
					$form_pic_whatsapp
					</div>
					<div class="form-group row">
					$form_pic_email
					</div>
					<div class="form-group row">
					$form_pic_tanggal_lahir
					</div>
					<div class="form-group row">
					$form_pic_agama
					</div>
					<div class="form-group row">
					$form_pic_jabatan
					</div>
					<div class="form-group row">
					$form_pic_tahun_menjabat
					</div>
					
				</div>
				</div>
				 
				  
				  
					
				
				 
				
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-dark" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;

}
if($action=="import_excel")
{
$url_download =backendurl("$modul/download_template");
$do_action=backendurl("$modul/upload_xls");
echo <<<END
	  <div class="card card-navy">
				  <div class="card-header">
					<h3 class="card-title">Import data personal</h3>
				  </div>
				  <!-- /.card-header -->
				  <!-- form start -->
				  <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
					<input type="hidden" name="id" value="$id" />
					<div class="card-body">
					  <div class="form-group">
						<p>Langkah langkah import peserta :</p>
						<p>1. Silahkan download template(.xls)
						<br/><a href="$url_download" class="btn btn-success">Download Template Excel</a>
						</p>
						<p>2. Silahkan isi template yang sudah di download dengan format yang sesuai</p>
						<p>3. Silahkan upload kembali template yang sudah terisi</p>
						<p>Pilih template yang sudah terisi <br/><input type="file" required="required" name="filename" accept="xls/*"  /></p>
						
					  </div>
		 
					<div class="card-footer">
					   <button type="button" class="btn btn-dark" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;
					   <button type="submit" name="submit" value="1" class="btn btn-primary">Upload Peserta</button>
					</div>
				  </form>
				</div>
				<!-- /.card -->
	
END;

}
if($action=="view" or $action=="")
{

$btn_tambah=button_add("$modul/add");
$link_import_excel=backendurl("personal/import_excel");
echo <<<END
<div class="card">
		<div class="card-header">
		  <h3 class="card-title">Personal</h3>
		  <div class="float-right">$btn_tambah &nbsp;<a class="btn btn-success" href="$link_import_excel">Import Excel</a></div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Whatsapp</th>
				<th>Email</th>
				<th>Lembaga</th>
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
	
	$column_order = array('b.id','b.nama_lengkap','b.email','b.whatsapp','l.lembaga_nama');
	$column_search = array('l.lembaga_nama','b.nama_lengkap','b.email','b.whatsapp');
	$order = array('b.nama_lengkap' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.nama_lengkap ASC ";
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
	
	$sql=" SELECT b.id,l.lembaga_nama,b.nama_lengkap,b.email,b.whatsapp FROM $modul b LEFT JOIN lembaga l ON l.id=b.lembaga_id  ";
	
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
		$row[]=$d['nama_lengkap'];
		$row[]=$d['whatsapp'];
		$row[]=$d['email'];
		$row[]=$d['lembaga_nama'];
		$action_edit='';
		if($daftar_hak[$modul]['edit']==1) {
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
