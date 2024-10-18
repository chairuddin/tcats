<?php
if($action=="qrcode") {
	echo generateQRCode(md5($id));
	die();
}
if($action=="print_detail" and $id!='') {
	include "cetak_kartu.php";
	die();
}
if($action=="print")
{
	
	echo '
	<div class="card card-navy">
       <div class="card-body p-15" style="min-height:100vh;">
		<div>
		<button type="button" class="btn btn-default btn-sm" onclick="frames[\'frame\'].print()" style="margin-top:10px; margin-bottom:4px"><i class="glyphicon glyphicon-print"></i> Cetak</button>
		</div>
		<iframe style="width:100%;height:100vh !important;" src="'.backendurl("cetak_kartu/print_detail/$id").'"  name="frame"></iframe>
	  </div>
	  <!-- /.card-body -->
	</div>
	';
	
	
}
if($action=="add" OR $action=="edit")
{

if($action=='edit') {
	$q=$mysql->query("
	SELECT 
		id,
		date_format(tanggal,'%d/%m/%Y') tanggal,
		title,
		content
	FROM
		pengumuman WHERE id=$id
	");
	$d=$mysql->assoc($q);
	
	foreach($d as $field => $value) {
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
}

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$form_tanggal=$form->element_Textbox("Tanggal","tanggal");
$form_title=$form->element_Textbox("Judul","title");
$form_content=$form->element_Textarea("Isi Pengumuman","content",array('class'=>'usetiny'));

echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">$label_action Pengumuman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
                  <div class="form-group">
                    $form_tanggal                 
                  </div>
                  <div class="form-group">
                    $form_title                
                  </div>
                  <div class="form-group">
                    $form_content                    
                  </div>
                <div class="card-footer">
                   <button type="button" class="btn btn-default" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

END;
$script_js=<<<END
<script>
$(document).ready(function(){

		
		new GijgoDatePicker(document.getElementById("tanggal"), { keyboardNavigation: true, modal: true, header: true, footer: true, format: 'dd/mm/yyyy' });
							
});
</script>
END;
}
if($action=="view" or $action=="")
{
echo <<<END
<div class="card card-navy">
		<div class="card-header">
		  <h3 class="card-title">Competency Card</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Kelas</th>
				<th>Jumlah</th>
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
	
		
	$sql=" 
	SELECT 
		count(id) jumlah,class
	FROM 
		quiz_member
	GROUP BY class
	ORDER BY class
	";
	
	
	
	$result = $mysql->query($sql);
	
	$data = array();
	

	
	while($d = $mysql->fetch_assoc($result)) {
		$no++;
		$row = array();
		
		$row[]=$no;
		$row[]=$d['class'];
		$row[]=$d['jumlah'];
		$action_print=btn_print(backendurl("$modul/print/".$d['class']));
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
		$row[]='<div class="btn-group btn-group-sm">'.$action_print.'</div>';
		
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
