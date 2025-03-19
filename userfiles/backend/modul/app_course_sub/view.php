<?php
if($action=="del_import") {
	$course_sub_id=$mysql->get1value("SELECT course_sub_id FROM app_competency_excel_log WHERE id=$id ");
	$del=$mysql->query("DELETE FROM app_competency_excel_log WHERE id=$id ");
	if($del) {

	sweetalert2($type="success","Data berhasil dihapus",backendurl("app_course_sub/import/$course_sub_id"));
} else {
	
	sweetalert2($type="warning","Data gagal dihapus. ",backendurl("app_course_sub/import/$course_sub_id"));

}
}
if($action=='save_excel') {
$sukses=true;
$mysql->autocommit(false);
$now=date("Y-m-d H:i:s");
$file_hash=$_SESSION['data_excel']['file_hash'];
$course_sub_id=$_SESSION['data_excel']['course_sub_id'];
$kompetensi_judul=$mysql->get1value("SELECT title FROM app_course_sub WHERE id=$course_sub_id");
$sql="INSERT INTO app_competency_excel_log SET course_sub_id=$course_sub_id,kompetensi='$kompetensi_judul',created_at='$now',file_hash='".$file_hash."',created_by='$admin_id'";

$mysql->query($sql);
$message=array();

$excel_log_id=$mysql->insert_id();
if(!$excel_log_id) {
	$sukses=false;
}
echo $sql."<br/>";
foreach($_SESSION['data_excel']['data_ujian'] as $i =>$data) {

	$indeks=$data['biodata']['indeks'];
	$nama=$data['biodata']['nama'];
	$jadwal=$data['biodata']['jadwal'];
	$kkm_total=$data['biodata']['kkm_total'];
	$sql1="INSERT INTO app_competency_excel SET kompetensi='$kompetensi_judul',course_sub_id=$course_sub_id,indeks='$indeks',nama='$nama',jadwal='$jadwal',kkm_total='$kkm_total',excel_log_id='$excel_log_id',created_at='$now',created_by='$admin_id'";
	$q=$mysql->query($sql1);
	if(!$q) {
		$sukses=false;
		$message[]="Data $nama terdapat masalah";
	}
	//echo $sql1."<br/>";
	$competency_excel_id=$mysql->insert_id();
	
	//$biodata=
	
	
	foreach($data['hasil'] as $i => $data_kompetensi) {
		$kompetensi=$data_kompetensi['kompetensi'];
		$nilai=$data_kompetensi['nilai'];
		$kkm=$data_kompetensi['kkm'];
		$kompetensi_indeks=$i;
		$sql2="INSERT INTO app_competency_excel_detail SET kompetensi_indeks='$kompetensi_indeks',kompetensi='$kompetensi',nilai='$nilai',kkm='$kkm',competency_excel_id=$competency_excel_id";
		$q2=$mysql->query($sql2);
		if(!$q2) {
			$message[]="Nilai Kompetensi $nama bermasalah";
			$sukses=false;
		}
		//echo $sql2."<br/>";
	}
	
	
	
	
}	

if($sukses) {
	$mysql->commit();
	$mysql->autocommit(true);
	sweetalert2($type="success","Data berhasil disimpan",backendurl("app_course_sub/import/$course_sub_id"));
} else {
	$mysql->rollback();
	sweetalert2($type="warning","Data gagal disimpan. ",backendurl("app_course_sub/import/$course_sub_id"));

}

}
if($action=="parse_excel")
{
	
	$id=$_POST['id'];
	$kkm_total=$_POST['kkm_total'];
	$field_patent_label=array('No','Indeks / KIT','Nama','Kompetensi','Jadwal');
	$field_patent_column=array(); //ini untuk mencatat index untuk no, indeks, nama, kompetensi, jadwal
	$field_kompetensi_field=array(); //nama kolom kompetensi
	
	//var_dump($_POST);	
	//tentukan kompetensi dan kkm terlebih dahulu
	//kemudian insert data dengan kkm sekalian
	$data_kompetensi=array();
	for($i=0;$i<count($_POST['kompetensi']);$i++) {
		$data_kompetensi[$_POST['kompetensi'][$i]]=$_POST['kkm'][$i];
	}
	
	
	$destination=filepath("user/".$_POST['filename']);
	$filename=$_POST['filename'];
	$alamat=filepath("user/$filename");
	
	$file_hash = md5_file($alamat);
	
	$objPHPExcel = PHPExcel_IOFactory::load($alamat);
	
	 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		// Ambil baris pertama sebagai header
		for ($col = 0; $col < $highestColumnIndex; $col++) {
			$cell = $worksheet->getCellByColumnAndRow($col, 1);
			$headers[$col] = $cell->getValue();
		}
		
		foreach($headers as $col => $value){
			if(in_array($value,$field_patent_label)) {
				$index = array_search($value, $field_patent_label);
				if ($index !== false) {
					$field_patent_column[$index]=$col;
				}
			}
			if($data_kompetensi[$col]>0) {
				$field_kompetensi_field[$col]=$value;
			}
		}
		
		//definisi kolom
		$kolom_no=$field_patent_column[0];
		$kolom_indeks=$field_patent_column[1];
		$kolom_nama=$field_patent_column[2];
		$kolom_kompetensi=$field_patent_column[3];
		$kolom_jadwal=$field_patent_column[4];
		
		
		$data_ujian=array();
		
		for ($row = 2; $row <= $highestRow; ++ $row) {
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				
				
				$kolom_indeks==$col?$data_ujian[$row]['biodata']['indeks']=$val:'';
				$kolom_nama==$col?$data_ujian[$row]['biodata']['nama']=$val:'';
				$kolom_kompetensi==$col?$data_ujian[$row]['biodata']['kompetensi']=$val:'';
				
				if ($kolom_jadwal==$col) {
					 if (is_numeric($val)) {
						$val = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($val));
					 }
				}
				$kolom_jadwal==$col?$data_ujian[$row]['biodata']['jadwal']=$val:'';
				
				$data_ujian[$row]['biodata']['kkm_total']=$kkm_total;
				
				if($data_kompetensi[$col]>0) {
					$data_ujian[$row]['hasil'][]=array('kompetensi'=>$field_kompetensi_field[$col],'nilai'=>$val,'kkm'=>$data_kompetensi[$col]);
				}
				//$dataArr[$row][$col] = $val;
			}
		}
	}
	$_SESSION['data_excel']['file_hash']=$file_hash;
	$_SESSION['data_excel']['data_ujian']=$data_ujian;
	$_SESSION['data_excel']['course_sub_id']=$id;
	
	$url_action=backendurl("$modul/simpan_excel");
	echo '<div class="card card-navy">
		  <div class="card-header">
			<h3 class="card-title">Pratinjau Data Kompetensi Dari Excel</h3>
		  </div>
		  <div class="card-body">
		   ';
	echo '<form method="POST" action="'.$url_action.'"   novalidate enctype="multipart/form-data">';	 
	echo '<input type="hidden" name="sub_action" value="parse_excel">';
	echo '<input type="hidden" name="id" value="'.$id.'">';
	echo '<input type="hidden" name="filename" value="'.$filename.'">';

	echo '<table class="table table-bordered">';
	echo '<tr>
	<th>Indeks / KIT</th>
	<th>Nama</th>
	<th>Kompetensi</th>
	<th>Jadwal</th>';
	foreach($field_kompetensi_field as $i =>$judul) {
		echo '<th>'.$judul.'</th>';
	}
	echo '</tr>';
	foreach($data_ujian as $i => $data){
		
	echo '<tr>
		<td>'.$data['biodata']['indeks'].'</td>
		<td>'.$data['biodata']['nama'].'</td>
		<td>'.$data['biodata']['kompetensi'].'</td>
		<td>'.$data['biodata']['jadwal'].'</td>';
	foreach($data['hasil'] as $i =>$d) {
		$color=$d['nilai']<$d['kkm']?'style="background-color:red;color:black;"':'';
		echo '<td '.$color.'">'.$d['nilai'].'</td>';
	}
	
	echo '</tr>';
	}
	echo '</table>';
	echo '<a  href="'.backendurl("app_course_sub/save_excel").'" class="btn btn-success">Simpan</a>';
	echo '</form>';	   
	echo '</div>';
	echo '</div>';
	
	
}
if($action=="upload_xls")
{
	$id=$_POST['id'];
	
	$destination=filepath("user/".$_FILES['filename']['name']);
	$file_hash = md5_file($destination);
	
	//cari apakah file ini pernah diupload sebelumnya?
	$kompetensi_ditemukan=$mysql->get1value(" SELECT kompetensi FROM app_competency_excel_log WHERE file_hash='$file_hash' ");
	
	$filename=$_FILES['filename']['name'];
	if (!move_uploaded_file($_FILES['filename']['tmp_name'], $destination)) {
		die('Permission');
	}else {
	
	$alamat=filepath("user/$filename");
	$objPHPExcel = PHPExcel_IOFactory::load($alamat);
	
	$headers = [];
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$highestColumn = $worksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		// Ambil baris pertama sebagai header
		for ($col = 0; $col < $highestColumnIndex; $col++) {
			$cell = $worksheet->getCellByColumnAndRow($col, 1);
			$headers[$col] = $cell->getValue();
		}
	}
	$url_action=backendurl("$modul/parse_excel");
	$skip=array('No','Indeks / KIT','Nama','Kompetensi','Jadwal');
	
	echo '<div class="card card-navy">
		  <div class="card-header">
			<h3 class="card-title">Penyesuaian Kompetensi dan KKM</h3>
		  </div>
		  <div class="card-body">
		   ';
		   
	if(strlen($kompetensi_ditemukan)>0) {
		echo '<div class="alert alert-danger">File ini pernah diupload sebelumnya untuk kompetensi '.$kompetensi_ditemukan.' dan sepertinya tidak ada perubahan data. Jika anda yakin ingin tetap upload file ini silakan lanjutkan dengan memilih dan mengisi form dibawah dan dilanjutkan tekan tombol proses dibawah. </div>';
	}		
	echo '<form method="POST" action="'.$url_action.'"  enctype="multipart/form-data">';	 
	echo '<input type="hidden" name="sub_action" value="parse_excel">';
	echo '<input type="hidden" name="id" value="'.$id.'" />';
	echo '<input type="hidden" name="filename" value="'.$filename.'">';
	echo ' KKM Keseluruhan <input type="text" style="width:50px;" id="kkm_total"  name="kkm_total"  value=""><br/><br/>';
	echo '<p>Pilih Kolom Kompetensi Dasar Post Test:<p>';
	echo '<table class="table table-bordered">';
	echo '<tr>
	<th><input type="checkbox" name="check_all" id="check_all" onclick="toggleCheckboxes(this)" /></th>
	<th>Kompetensi</th>
	<th>KKM</th>
	</tr>';
	foreach($headers as $col => $value){
		if(!in_array($value,$skip)) {
			echo '<tr>
			<td style="width:50px;"><input type="checkbox" name="kompetensi[]" id="kompetensi_'.$col.'" value="'.$col.'" /></td>
			<td>'.$value.'</td>
			<td><input type="text" style="width:60px;" name="kkm[]" id="kkm_'.$col.'" value="" /></td>
			</tr>';
		}
	}
	echo '</table>';
	echo '<button type="submit" class="btn btn-success">Proses</button>';
	echo '</form>';	   
	echo '</div>';
	echo '</div>';
	
	
	
	/*
	$dataArr = array();
	 
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle     = $worksheet->getTitle();
		$highestRow         = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		 
		for ($row = 1; $row <= $highestRow; ++ $row) {
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow($col, $row);
				$val = $cell->getValue();
				$dataArr[$row][$col] = $val;
			}
		}
	}
	unset($dataArr[1]);
	$already_exist=array();
	$success_input=array();
	foreach($dataArr as $val){
	
    }
	*/
	/*
	if(count($already_exist)>0){
	$join_error="<ul><li>".join("</li><li>",$already_exist)."</ul></li>";
	redirecto("Gagal tambah user berikut karena username sudah terdaftar:<br/>$join_error","error","view");
	}
	else
	{
	$join_msg="<ul><li>".join("</li><li>",$success_input)."</ul></li>";	
	redirecto("Sukses menambahkan user:<br/>$join_msg","success","view");	
	}
	*/
	}
	
	$script_js.=<<<end
	<script>
	function toggleCheckboxes(source) {
		document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
			if (checkbox !== source) {
				checkbox.checked = source.checked;
			}
		});
	}
	
	document.querySelectorAll('input[name="kkm[]"], input[name="kompetensi[]"], input[name="kkm_total"]').forEach(input => {
    input.addEventListener('input', function () {
        let tr = this.closest('tr'); // Dapatkan elemen <tr> terdekat jika ada
        let checkbox = tr ? tr.querySelector('input[name="kompetensi[]"]') : null; 
        let kkm = tr ? tr.querySelector('input[name="kkm[]"]') : null;

        // Validasi KKM per baris
        if (checkbox && kkm) {
            if (checkbox.checked && kkm.value.trim() !== '') {
                tr.style.backgroundColor = 'lightgreen';
            } else {
                tr.style.backgroundColor = ''; // Kembalikan ke warna default
            }

            // Jika KKM diisi, hilangkan warna merah
            if (kkm.value.trim() !== '') {
                kkm.style.setProperty('background-color', '', 'important');
            }
        }

        // Validasi untuk kkm_total
        if (this.name === "kkm_total" && this.value.trim() !== '') {
            this.style.setProperty('background-color', '', 'important');
        }
    });
});

// Validasi saat form disubmit

document.querySelector('form').addEventListener('submit', function (event) {
    let isValid = true;

    // Validasi KKM yang dicentang
    document.querySelectorAll('input[name="kkm[]"]').forEach(kkm => {
        let tr = kkm.closest('tr'); 
        let checkbox = tr.querySelector('input[name="kompetensi[]"]');

        if (checkbox.checked && kkm.value.trim() === '') {
            kkm.style.setProperty('background-color', 'red', 'important');
            isValid = false;
        }
    });

    // Validasi kkm_total
    let kkmTotal = document.querySelector('input[name="kkm_total"]');
	
    if (kkmTotal.value.trim() === '') {
        kkmTotal.style.setProperty('background-color', 'red', 'important');
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault(); // Hentikan submit jika ada yang tidak valid
        alert("Mohon isi semua KKM yang dicentang dan pastikan KKM Total terisi!");
    } 
});


	</script>
end;
	
	
}


if($action=="import") {
$kompetensi_judul=$mysql->get1value("SELECT title FROM app_course_sub WHERE id=$id");
$url_upload=backendurl("$modul/upload_xls");

echo <<<END
  <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">Import Hasil Ujian Kompetensi $kompetensi_judul</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			 
              <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$url_upload"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
					 <p>Ini adalah halaman untuk import hasil ujian tanpa melalui sistem CBT</p>
					 <br/>
					File Excel (*.xls) <input type="file" accept="xlsx/*" name="filename" required="required">
							
                </div>  
                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;



echo <<<END
<div class="card card-navy">
		<div class="card-header">
		  <h3 class="card-title">History Import Kompetensi $kompetensi_judul</h3>
		  <div class="float-right"></div>
		</div>
		
		<div class="card-body">
				<table id="datalist-import" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<td style="widtd:40px;">No</td>
				<td>Dibuat</td>
				<td>File Hash</td>
				<td>Jumlah</td>
				<td style="widtd:80px;">Action</td>
				</tr>
				</thead>
				</table>
		</div>
		
	  
</div>
END;

$url=backendurl("$modul/data_import/$id"); 
$script_js=<<<end
<script>
$(document).ready(function(){

$('#datalist-import').DataTable({
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			'autoWidth'   : false,
			"ajax": {
				"url": '$url',
				"type": "POST"
			},
			order:[[1, 'desc']],
		});

});
</script>
end;
}

if($action=="view_import") {

	$course_sub_id=$mysql->get1value("SELECT course_sub_id FROM app_competency_excel_log WHERE id=$id ");
	$field_kompetensi_field=array();
	$data_ujian=array();
	$q=$mysql->query("SELECT id,indeks,nama,jadwal FROM app_competency_excel WHERE excel_log_id=$id ");
	$row=1;
	while ($biodata = $mysql->fetch_assoc($q)) {
		
		$data_ujian[$row]['biodata']['indeks']=$biodata['indeks'];
		$data_ujian[$row]['biodata']['nama']=$biodata['nama'];
		$data_ujian[$row]['biodata']['jadwal']=$biodata['jadwal'];
		
		$q1=$mysql->query("SELECT id,kompetensi_indeks,kompetensi,nilai,kkm FROM app_competency_excel_detail WHERE competency_excel_id=".$biodata['id']." ORDER BY kompetensi_indeks ASC");
			
		while ($hasil = $mysql->fetch_assoc($q1)) {
		$field_kompetensi_field[$hasil['kompetensi_indeks']]=$hasil['kompetensi'];
		$data_ujian[$row]['hasil'][]=array('kompetensi'=>$hasil['kompetensi'],'nilai'=>$hasil['nilai'],'kkm'=>$hasil['kkm']);
	
			//$dataArr[$row][$col] = $val;
		}
		$row++;	
	}



echo '<div class="card card-navy">
		  <div class="card-header">
			<h3 class="card-title">Daftar Nilai </h3>
		  </div>
		  <div class="card-body">
		   ';
	echo '<table class="table table-bordered">';
	echo '<tr>
	<th>Indeks / KIT</th>
	<th>Nama</th>
	<th>Jadwal</th>';
	
	foreach($field_kompetensi_field as $i =>$judul) {
		echo '<th>'.$judul.'</th>';
	}
	echo '</tr>';
	

	
	foreach($data_ujian as $i => $data){
		
	echo '<tr>
		<td>'.$data['biodata']['indeks'].'</td>
		<td>'.$data['biodata']['nama'].'</td>
		<td>'.$data['biodata']['jadwal'].'</td>';
	foreach($data['hasil'] as $i =>$d) {
		$color=$d['nilai']<$d['kkm']?'style="background-color:red;color:black;"':'';
		echo '<td '.$color.'">'.$d['nilai'].'</td>';
	}
	
	echo '</tr>';
	}
	echo '</table>';
	echo '<br/><a  href="'.backendurl("app_course_sub/import/$course_sub_id").'" class="btn btn-info">Kembali</a>';
	echo '</form>';	   
	echo '</div>';
	echo '</div>';
}
if($action=="add" OR $action=="edit")
{
$course_id=$_GET['course'];
$url_image="#";
if($action=='edit') {

	$q=$mysql->query("
	SELECT 
		id,
		title,
		content,
		course_id,
		allow_class,
		publish,
		image
	FROM
		app_course_sub WHERE id=$id
	");
	$d=$mysql->assoc($q);
	
	foreach($d as $field => $value) {
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
	$course_id=$d['course_id'];
	if($d['image']!='') {
		$url_image=fileurl("$modul/".$d['image']);
	}

	$r_allow_class=$d['allow_class'];
	foreach($d as $field => $value) {
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
	$_POST['allow_class']=explode(",",$r_allow_class);


	$_POST['pretest_quiz']=$mysql->get1value("SELECT quiz_id FROM app_course_material WHERE quiz_type='pretest' AND course_sub_id=$id");
	$_POST['posttest_quiz']=$mysql->get1value("SELECT quiz_id FROM app_course_material WHERE quiz_type='posttest' AND course_sub_id=$id ");
	
}

$option_soal=[];
$q=$mysql->query("SELECT id,concat(code,' ',title_id) title_id FROM quiz_master $kondisi2 ORDER BY code,title_id ");
if($q and $mysql->num_rows($q)>0) {
	while($d=$mysql->fetch_assoc($q)) {
		$option_soal[$d['id']]=$d['title_id'];
	}
}

$option_class= $mysql->get_assoc('class','class','quiz_member',"class","class<>''",'class');

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$form_course_id=$form->element_Hidden("course_id",$course_id);
$form_title=$form->element_Textbox("Judul","title");
$form_content=$form->element_Textarea("Isi","content",array('class'=>'usetiny'));
$form_quiz_pretest=$form->element_Select("Soal Pre Test",'pretest_quiz',$option_soal,array('class'=>'select2'));
$form_quiz_postest=$form->element_Select("Soal Post Test",'posttest_quiz',$option_soal,array('class'=>'select2'));

//$form_class=$form->element_Select2Multi("Pilih Kelas",'allow_class[]',$option_class,array('class'=>'select2','multiple'=>"multiple","value"=>$_POST['allow_class']));
$form_status=$form->element_bootstrapSwitch("Status Aktif","publish",array("value"=>"1",'data-off-color'=>"danger",'data-on-color'=>"success",'data-on-text'=>"Aktif", 'data-off-text'=>"Tidak Aktif"));

echo <<<END
  <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">$label_action $course_title</h3>
              </div>
              <!-- /.card-header -->
			   <div class="card-body">
              <!-- form start -->
              <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
					$form_course_id  
					<div class="form-group">
						<label for="imageUpload">Choose an image</label>
						<input type="file" class="form-control-file" id="imageUpload" name="image" accept="image/*">
						
					</div>
					<div class="form-group">
						<img id="imagePreview" src="$url_image" alt="Image Preview" class="img-tdumbnail" style="max-widtd: 300px;">
					  </div>
					<div class="form-group">
					$form_title                
					</div>
					<div class="form-group">
					$form_content                    
					</div>
					<!--
					<div class="form-group">
					$form_class                    
					</div>
					-->
					<div class="form-group">
					$form_quiz_pretest                    
					</div>
					<div class="form-group">
					$form_quiz_postest                    
					</div>
					<div class="form-group">
					$form_status                    
					</div>
					<div class="card-footer">
					   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
					</div>
              </form>
            </div>
		</div>
</div>		
            <!-- /.card -->

END;
$script_js=<<<END
<script>
$(document).ready(function(){

			
		 $('#imageUpload').change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                }
            });
});
</script>
END;
}
if($action=="view" or $action=="")
{
$btn_tambah=button_add("$modul/add?course=".$_GET['course']);
echo <<<END
<div class="card card-navy">
		<div class="card-header">
		  <h3 class="card-title">$course_title</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		
		<div class="card-body">
				<table id="datalist-data" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<td style="widtd:40px;">No</td>
				<td>Judul</td>
				<td style="widtd:80px;">Action</td>
				</tr>
				</thead>
				</table>
		</div>
		
	  
</div>
END;

$url=backendurl("$modul/data?course=".($_GET['course']!=""?$_GET['course']:'')); 
$script_js=<<<end
<script>
$(document).ready(function(){

$('#datalist-data').DataTable({
			"pageLength": 100,
			'lengthChange': false,
			'searching'   : true,
			'ordering'    : true,
			'info'        : false,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			'autoWidth'   : false,
			"ajax": {
				"url": '$url',
				"type": "POST"
			},
			order:[[1, 'asc']],
		});

});
</script>
end;

}
if($action=="data") {
	$column_order = array('a.id','a.title','c.title');
	$column_search = array('a.title','c.title');
	$order = array('id' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY id ASC ";
	}
	if ($_POST['lengtd'] != -1 AND $_POST['lengtd']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['lengtd']}";
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
	
	$course=$_GET['course']!=""?$_GET['course']:'';
	
	$sql=" 
	SELECT 
		a.id,
		a.title,
		a.content,
		a.course_id,
		c.title course
	FROM 
		app_course_sub a
	LEFT JOIN app_course c ON c.id=course_id
		";
	
	$sql.=" WHERE course_id=".$course." ";

	$sql_r=array();
	
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	
	$data = array();
	
	//$gotopage = $_POST['start']/$_POST['length'];
	
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['title'];
	
		//$action_add=btn_add(backendurl("app_course_material/add?course_sub_id=".$d['id']));
		$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']));
		$action_delete=btn_delete(backendurl("$modul/del/".$d['id']));
		$url_import=backendurl("$modul/import/".$d['id']);
		$btn_import='<a class="btn btn-info" href="'.$url_import.'"><i class="fas fa-upload"></i></a>';
		$row[]='<div class="btn-group btn-group-sm">'.$btn_import.$action_add.$action_edit.$action_delete.'</div>';
		
		$data[] = $row;
		
		/*
		$qsub=$mysql->query("SELECT id,title FROM app_course_material WHERE course_sub_id=".$d['id']);
		if($qsub) {
			$index=0;
			while($dsub = $mysql->fetch_assoc($qsub)) {
				$row = array();
				$index++;
				$row[]="";
				$row[]="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$no.".".$index."&nbsp;".$dsub['title'];
		
				$action_edit=btn_edit(backendurl("app_course_material/edit/".$dsub['id']."?course_sub_id=".$d['id']));
				$action_delete=btn_delete(backendurl("app_course_material/del/".$dsub['id']."?course_sub_id=".$d['id']));
		
				$row[]='<div class="btn-group btn-group-sm">'.$action_edit.$action_delete.'</div>';
				
					
				$data[] = $row;
		
			}
		}
		*/
	
		
	}
	
	
	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $total,
		"recordsFiltered" => $total,
		"data" => $data
	);
	die(json_encode($output));
}
if($action=="data_import") {
	$column_order = array('id','created_at');
	$column_search = array('created_at');
	$order = array('id' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY id DESC ";
	}
	if ($_POST['lengtd'] != -1 AND $_POST['lengtd']!="") {
		$where_limit = "LIMIT {$_POST['start']}, {$_POST['lengtd']}";
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
	
	$course=$_GET['course']!=""?$_GET['course']:'';
	
	$sql=" 
	SELECT id,created_at,created_by,file_hash FROM app_competency_excel_log 
		";
	
	$sql.=" WHERE course_sub_id=$id ";

	$sql_r=array();
	
	if(count($sql_r)>0){
		$sql.=" AND  (".join(" OR ",$sql_r).") ";
	}
	
	$result_total = $mysql->query($sql);
	$total=$mysql->num_rows($result_total);
	$sql .= " $order_by $where_limit";
	
	$result = $mysql->query($sql);
	
	$data = array();
	
	//$gotopage = $_POST['start']/$_POST['length'];
	
	$no = $_POST['start'];
	while($d = $mysql->fetch_assoc($result)) {
		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['created_at'];
		$row[]=$d['file_hash'];
		$row[]=$mysql->get1value("SELECT count(id) FROM app_competency_excel WHERE excel_log_id=".$d['id']);
	
		//$action_add=btn_add(backendurl("app_course_material/add?course_sub_id=".$d['id']));
		
		$action_delete=btn_delete(backendurl("$modul/del_import/".$d['id']));
		$action_eye=btn_eye(backendurl("$modul/view_import/".$d['id']));
	
		$row[]='<div class="btn-group btn-group-sm">'.$action_eye.$action_delete.'</div>';
		
		$data[] = $row;
		
		/*
		$qsub=$mysql->query("SELECT id,title FROM app_course_material WHERE course_sub_id=".$d['id']);
		if($qsub) {
			$index=0;
			while($dsub = $mysql->fetch_assoc($qsub)) {
				$row = array();
				$index++;
				$row[]="";
				$row[]="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$no.".".$index."&nbsp;".$dsub['title'];
		
				$action_edit=btn_edit(backendurl("app_course_material/edit/".$dsub['id']."?course_sub_id=".$d['id']));
				$action_delete=btn_delete(backendurl("app_course_material/del/".$dsub['id']."?course_sub_id=".$d['id']));
		
				$row[]='<div class="btn-group btn-group-sm">'.$action_edit.$action_delete.'</div>';
				
					
				$data[] = $row;
		
			}
		}
		*/
	
		
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
