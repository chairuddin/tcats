<?php

if($action=="add" OR $action=="edit")
{

$r=$mysql->query("SELECT * from $modul where id=$id");
$d=$mysql->assoc($r);
foreach($d as $field => $value) {
	$_POST[$field]=$_POST[$field]==''?$value:$_POST[$field];
}

$_POST['expired']=($_POST['expired']=='' or $_POST['expired']=='0000-00-00')?date("d/m/Y"):ymd_to_dmy($_POST['expired']);
$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
$label_action=$action=="add"?"Tambah":"Edit";

$option_project=option_project();;

if($action=="edit") {
	//$_POST['harga']=currency($_POST['harga']);
}

//$_POST['deadline']=date("Y-m-d H:i:s");
if($action=='add') {

	//$_POST['deadline']=$_POST['deadline']!=''?$_POST['deadline']:date("Y-m-d 09:00",strtotime('+1 days'));
	$_POST['start_date']=$_POST['start_date']!=''?$_POST['start_date']:date("Y-m-d");
	$_POST['end_date']=$_POST['end_date']!=''?$_POST['end_date']:date("Y-m-d");
}

	
	//$form_last_fu=$form->element_Textbox("FU Terakhir","last_fu",array('class'=>'tanggal'),$mode=array('label'=>6,'input'=>6));
	//$form_next_fu=$form->element_Textbox("FU Berikutnya","next_fu",array('class'=>'tanggal'),$mode=array('label'=>6,'input'=>6));

$option_user=option_user();
$option_task_type=option_task_type();
$option_task_status=option_task_status();
$option_priority=option_priority();

$form_jenis=$form->element_Select("Project","project_id",$option_project,array('class'=>''),$mode=array('label'=>12,'input'=>12));
$form_title=$form->element_Textbox("Task","title");
$form_estimation=$form->element_Time("Estimation(Hours)","estimation",array('class'=>''),$mode=array('label'=>6,'input'=>6));
$form_assign_to=$form->element_Select("Assign To","assign_to",$option_user,array('class'=>''),$mode=array('label'=>12,'input'=>12));
$form_prioritas=$form->element_Select("Priority","priority",$option_priority,array('class'=>''),$mode=array('label'=>12,'input'=>12));
$form_task_type=$form->element_Select("Task Type","task_type_id",$option_task_type,array('class'=>''),$mode=array('label'=>12,'input'=>12));
$form_task_status=$form->element_Select("Status","status",$option_task_status,array('class'=>''),$mode=array('label'=>12,'input'=>12));
$form_start_date=$form->element_Date("Start Date","start_date",array('class'=>''),$mode=array('label'=>12,'input'=>12));
$form_end_date=$form->element_Date("End Date","end_date",array('class'=>''),$mode=array('label'=>12,'input'=>12));

//$form_harga=$form->element_Textbox("Harga","harga",array('class'=>'format-angka','style'=>'width:150px;'));

$do_action=backendurl("$modul/".($action=="add"?"save":"update"));
echo <<<END
  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Task</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" autocomplete="off" class="yona-form" method="POST" action="$do_action" enctype="multipart/form-data">
				<input type="hidden" name="id" value="$id" />
                <div class="card-body">
				 <div class="form-group row " >
				  	<div class="col-md-3" >
						$form_jenis
				  	</div>
					<div class="col-md-6" >
						$form_title
				  	</div>
				  </div>	
               	 <div class="form-group row " >
				  	<div class="col-md-3" >
						$form_start_date
				  	</div>
					<div class="col-md-3" >
						$form_end_date
				  	</div>
					<div class="col-md-3" >
						$form_estimation
				  	</div>
				  </div>	
				 <div class="form-group row " >
				  	<div class="col-md-3" >
						$form_assign_to
				  	</div>
					<div class="col-md-3" >
						$form_prioritas
				  	</div>
					<div class="col-md-3" >
						$form_task_type
				  	</div>
				  </div>
				  <div class="form-group row " >
				    <div class="col-md-3" >
						$form_task_status
				  	</div>
					<div class="col-md-3" >
						
				  	</div>
				  </div>	
				 	
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-dark" onclick="history.back(-1);">Batal</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="submit" value="1">Submit</button>
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
		  <h3 class="card-title">Task</h3>
		  <div class="float-right">$btn_tambah</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
				<table id="datalist" class="table table-bordered table-striped responsive no-wrap">
				<thead>
				<tr>
				<th>No</th>
				<th>Project</th>
				<th>Task</th>
				<th>Assign To</th>
				<th>Deadline</th>
				<th>Estimation (H)</th>
				<th>Priority</th>
				<th>Status</th>
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
	
	$column_order = array('b.id','b.title');
	$column_search = array('b.title');
	$order = array('b.id' => 'DESC');
	
	if(isset($_POST['order'])) { // here order processing
		$order_by = " ORDER BY {$column_order[$_POST['order']['0']['column']]} {$_POST['order']['0']['dir']}";
	} else {
		$order = $order;
		
		$order_by = " ORDER BY b.id DESC ";
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
	SELECT b.id,b.title,u.username,u.fullname,p.title project_title,tt.title task_type_title,b.start_date,b.end_date,b.estimation,b.priority,b.status FROM task b 
	LEFT JOIN project p ON p.id=b.project_id
	LEFT JOIN user u ON u.id=b.assign_to
	LEFT JOIN task_type tt ON tt.id=b.task_type_id
	 ";
	
	//$sql.=" WHERE status= ";

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
		$row[]=$d['project_title'];
		$row[]=$d['title'];
		$row[]=$d['username'];
		$row[]=$d['end_date'];
		$row[]=$d['estimation'];
		$row[]=$d['priority'];
		$row[]=$d['status'];
		//$row[]="<div class='text-right'>".currency($d['harga'])."</div>";
		$action_edit='';
		if($daftar_hak[$modul]['edit']==1) {
			//$action_edit='<a  title="Edit Tugas" href="'.backendurl("$modul/edit/".$d['id']).'"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
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
