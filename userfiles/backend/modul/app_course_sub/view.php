<?php

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
                		<img id="imagePreview" src="$url_image" alt="Image Preview" class="img-thumbnail" style="max-width: 300px;">
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
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th style="width:40px;">No</th>
				<th>Judul</th>
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
	
	$column_order = array('a.id','a.title','c.title');
	$column_search = array('a.title','c.title');
	$order = array('id' => 'ASC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY id ASC ";
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
		a.id,
		a.title,
		a.content,
		a.course_id,
		c.title course
	FROM 
		app_course_sub a
	LEFT JOIN app_course c ON c.id=course_id
		";
	
	$sql.=" WHERE course_id=".$_GET['course']." ";

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
	
		//$action_add=btn_add(backendurl("app_course_material/add?course_sub_id=".$d['id']));
		$action_edit=btn_edit(backendurl("$modul/edit/".$d['id']));
		$action_delete=btn_delete(backendurl("$modul/del/".$d['id']));
	
		$row[]='<div class="btn-group btn-group-sm">'.$action_add.$action_edit.$action_delete.'</div>';
		
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
