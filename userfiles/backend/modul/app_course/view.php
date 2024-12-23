<?php
$url_image="#";
if($action=="add" OR $action=="edit")
{

if($action=='edit') {
	$q=$mysql->query("
	SELECT 
		id,
		title,
		content,
		category_id,
		thumbnail
	FROM
		app_course WHERE id=$id
	");
	$d=$mysql->assoc($q);
	if($d['thumbnail']!='') {
		$url_image=fileurl("$modul/".$d['thumbnail']);
	}
	foreach($d as $field => $value) {
		$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
	}
	
}

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$option_category=$mysql->get_assoc('id','title','app_category',"title"); 

$form_title=$form->element_Textbox("Judul","title");
//$form_content=$form->element_Textarea("Isi","content",array('class'=>'usetiny'));
//$form_category=$form->element_Select("Category","category_id",$option_category);
$form_category=$form->element_Hidden("category_id","$category_id");

echo <<<END
  <div class="card card-navy">
              <div class="card-header">
                <h3 class="card-title">$label_action $course_title</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" id="form-member"  class="form-member yona-validation" action="$do_action"  novalidate enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
             		<div class="form-group">
						<label for="imageUpload">Choose an image</label>
						<input type="file" class="form-control-file" id="imageUpload" name="thumbnail" accept="image/*">
					</div>
					 <div class="form-group">
                		<img id="imagePreview" src="$url_image" alt="Image Preview" class="img-thumbnail" style="max-width: 300px;">
          			  </div>
                  <div class="form-group">
                    $form_category                
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
$btn_tambah=button_add("$modul/add?category_id=$category_id");

echo <<<END
<div class="card card-navy">
		<div class="card-header">
		  <h3 class="card-title">$course_title</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Judul</th>
				<th style="width:100px;">Action</th>
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
	
	$category_id=$_GET['category_id'];	
	$column_order = array('a.id','a.title');
	$column_search = array('a.title');
	$order = array('id' => 'DESC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY id DESC ";
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
	$sql_r=array();
	if(count($sql_search)>0){
	$sql_r[]=" ".join(" OR ",$sql_search)." ";
	}
	
	$sql=" 
	SELECT 
		a.id,
		a.title,
		a.content
	FROM 
		app_course a

		";
	
	$sql.=" WHERE 1=1 "; //a.category_id=$category_id 

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
		$row[]=$d['title'];
		$action_info=btn_folder(backendurl("app_course_sub/?course=".$d['id']));
		$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']."?category_id=$category_id"));
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
		$row[]='<div class="btn-group btn-group-sm">'.$action_info.$action_edit.$action_delete.'</div>';
		
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
