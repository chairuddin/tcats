<?php

if($_GET['download_template']==2)
{
ob_start();
error_reporting(0);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);
// Create new PHPExcel object

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("quizroom.id")
 ->setLastModifiedBy("quizroom.id")
 ->setTitle("Ujian Online Berbasis Komputer")
 ->setSubject("Ujian Online Berbasis Komputer")
 ->setDescription("Ujian Online Berbasis Komputer")
 ->setKeywords("Ujian Online Berbasis Komputer")
 ->setCategory("Ujian Online Berbasis KOmputer");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1',"Kode Login")
            ->setCellValue('B1',"Nama Peserta")
            ->setCellValue('C1',"Kelas")
            ->setCellValue('D1',"Jurusan")
            ->setCellValue('E1',"Ruang")
            ->setCellValue('F1',"Sandi")
            ->setCellValue('G1',"Email");

/*
organization_unit_code',
		'organization_unit',
		'position_code',
		'position',
		'direct_supervisor_indeks',
		'direct_supervisor_name',
		'2nd_supervisor_indeks',
		'2nd_supervisor_name',
		'manager_indeks',
		'manager_name'
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
	
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$no,"TKJ1001")
			->setCellValue('B'.$no,"Romli")
			->setCellValue('C'.$no,"TKJ-A")
			->setCellValue('D'.$no,"TEKNIK KOMPUTER DAN JARINGAN")
			->setCellValue('E'.$no," 01")
			->setCellValue('F'.$no,"123456")
			->setCellValue('G'.$no,"youremail@example.com");
			
	$objPHPExcel->getActiveSheet()
	->getStyle("E$no")
	->getNumberFormat()
	->setFormatCode(
		PHPExcel_Style_NumberFormat::FORMAT_GENERAL
	);   	
		
$filename="Template Import Peserta";
$sheet_title="Daftar Peserta";

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
if($action=="import_excel") {
$url_download =backendurl("$modul/import_excel?download_template=2");
$do_action=backendurl("$modul/upload_xls");
echo <<<END
  <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Import data peserta</h3>
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
                    <p><input type="checkbox" name="replace" value="1" />&nbsp;&nbsp;Hapus semua data peserta ganti dengan data baru ?</p>
                  </div>
     
                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;
                   <button type="submit" name="submit" value="1" class="btn btn-primary">Upload Peserta</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;
}
if($action=="add" OR $action=="edit")
{

	/*
	ALTER TABLE `quiz_member`
ADD `organization_unit_code` varchar(50) NOT NULL,
ADD `organization_unit` varchar(50) NOT NULL AFTER `organization_unit_code`,
ADD `position_code` varchar(50) NOT NULL AFTER `organization_unit`,
ADD `position` varchar(50) NOT NULL AFTER `position_code`,
ADD `direct_supervisor_indeks` varchar(50) NOT NULL AFTER `position`,
ADD `direct_supervisor_name` varchar(100) NOT NULL AFTER `direct_supervisor_indeks`,
ADD `manager_indeks` varchar(50) NOT NULL AFTER `direct_supervisor_name`,
ADD `manager_name` varchar(100) NOT NULL AFTER `manager_indeks`;

	*/
if($action=='edit') {
	$q=$mysql->query("
	SELECT 
		id,
		username,
		fullname,
		class,
		grade,
		jurusan,
		ruang,
		email,
		status,
		level,
		organization_unit_code,
		organization_unit,
		position_code,
		position,
		direct_supervisor_indeks,
		direct_supervisor_name,
		2nd_supervisor_indeks,
		2nd_supervisor_name,
		manager_indeks,
		manager_name
		
	FROM
		quiz_member WHERE id=$id
	");
	$d=$mysql->assoc($q);
	foreach($d as $field => $value) {
		if($field=="password" or $_POST['password']!='') {
			continue;
		}
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
}

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$form_username=$form->element_Textbox("Kode Login","username");
$form_fullname=$form->element_Textbox("Nama Lengkap","fullname");
$form_class=$form->element_Textbox("Kelas","class");
//$form_grade=$form->element_Textbox("Grade","grade");
$form_jurusan=$form->element_Textbox("Jurusan","jurusan");
$form_ruang=$form->element_Textbox("Ruang","ruang");
$form_email=$form->element_Textbox("Email","email");
$form_password=$form->element_Password("Password","password",array("placeholder"=>"**********","autocomplete"=>"off"));
$form_status=$form->element_bootstrapSwitch("Status Aktif","status",array("value"=>"1",'data-off-color'=>"danger",'data-on-color'=>"success",'data-on-text'=>"Aktif", 'data-off-text'=>"Tidak Aktif"));

$form_pengawas=$form->element_bootstrapSwitch("Status Member","level",array("value"=>"1",'data-off-color'=>"danger",'data-on-color'=>"success",'data-on-text'=>"Pengawas", 'data-off-text'=>"Staff"));


$form_organization_unit_code=$form->element_Textbox("Organization Unit Code","organization_unit_code");
$form_organization_unit=$form->element_Textbox("Organization Unit","organization_unit");
$form_position_code=$form->element_Textbox("Position Code","position_code");
$form_position=$form->element_Textbox("Position","position");
$form_direct_supervisor_indeks=$form->element_Textbox("Direct Supervisor Indeks","direct_supervisor_indeks");
$form_direct_supervisor_name=$form->element_Textbox("Direct Supervisor Name","direct_supervisor_name");
$form_2nd_supervisor_indeks=$form->element_Textbox("2nd Supervisor Indeks","2nd_supervisor_indeks");
$form_2nd_supervisor_name=$form->element_Textbox("2nd Supervisor Name","2nd_supervisor_name");
$form_manager_indeks=$form->element_Textbox("Manager Indeks,","manager_indeks");
$form_manager_name=$form->element_Textbox("Manager Name","manager_name");

echo <<<END
  <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">$label_action Peserta</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
                  <div class="row">
				 	<div class="col-md-6">
						<div class="form-group">
						$form_username        
						</div>
						<div class="form-group">
							$form_password
							<small id="passwordHelp" class="form-text text-muted">Biarkan kosong bila tidak ingin merubah Password</small>                 
						</div>
						<div class="form-group">
							$form_fullname                
						</div>
						<div class="form-group" style="display:none;">
							$form_class                    
						</div>
						<div class="form-group">
							$form_email                   
						</div>
						<div class="form-group">
							$form_organization_unit_code
						</div>
						<div class="form-group">
							$form_organization_unit                
						</div>
						<div class="form-group">
							$form_position_code                    
						</div>
						<div class="form-group">
							$form_position                    
						</div>
						<div class="form-group">
							$form_pengawas
						</div>
						<div class="form-group">
							$form_status
						</div>
				  	</div>
				  	<div class="col-md-6">			
						<div class="form-group">
							$form_direct_supervisor_indeks                   
						</div>
						<div class="form-group">
							$form_direct_supervisor_name
						</div>
						<div class="form-group">
							$form_2nd_supervisor_indeks
						</div>
						<div class="form-group">
							$form_2nd_supervisor_name
						</div>
						<div class="form-group">
							$form_manager_indeks
						</div>
						<div class="form-group">
							$form_manager_name
						</div>
					</div> 
				  </div>
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
if($_SESSION['s_level']>0){	
$btn_tambah=button_add("$modul/add");
$btn_excel=button_excel("$modul/import_excel");
}
echo <<<END
<div class="card card-navy">
		<div class="card-header">
		  <h3 class="card-title">Peserta Ujian</h3>
		  <div class="float-right">$btn_excel&nbsp;&nbsp;$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
		<form method="post" action="">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Kode Peserta</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Ruang</th>
				<th style="width:80px;">Action</th>
				</tr>
				</thead>
				</table>
		<button type="submit" name="bulk_delete" value="1">Bulk Delete</button>		
		</form>		
		</div>
		<!-- /.card-body -->
	  </div>
</div>
END;
}
if($action=="data") {
	
	$column_order = array('id','username','fullname','class','jurusan','ruang');
	$column_search = array('username','grade','class','jurusan','ruang','fullname');
	$order = array('username' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY username ASC ";
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
		username,
		fullname,
		class,
		grade,
		jurusan,
		ruang,
		organization_unit_code,
		organization_unit,
		position_code,
		position,
		direct_supervisor_indeks,
		direct_supervisor_name
		manager_indeks,
		manager_name
	FROM 
		quiz_member
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
		
		$row[]=$no."&nbsp;<input type='checkbox' name='mark_delete[]'  value='".$d['id']."'/>";
		$row[]=$d['username'];
		$row[]=$d['fullname'];
		$row[]=$d['class'];
		$row[]=$d['ruang'];
		
		$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']));
		$action_delete=btn_delete(backendurl("$modul/del/".$d['id']));
		/*
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
		if($_SESSION['s_level']>0){
			$row[]='<div class="btn-group btn-group-sm">'.$action_view.$action_edit.$action_delete.'</div>';
		} else {
			$row[]='<div class="btn-group btn-group-sm">'.$action_edit.'</div>';
		}
		
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
